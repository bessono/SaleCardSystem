
function update_pins(){
	var pinAdmin = jQuery("#pin_manager").val();
	var pinManager = jQuery("#pin_admin").val();
	jQuery.post("/?mode=settings&method=update_pins",
				{pin_admin:pinAdmin,
				 pin_manager:pinManager},
				 function(data){
					alert(data);
				 });
}

function checkCard(){
	var cardId = jQuery("#card_id").val();
	jQuery.post("/?mode=main&method=check_card",
				{card_id:cardId},
				function(data){
					jQuery("#content").html(data);
				});
}

function setCardActive(){
	var cCardId = jQuery("#card_id").val();
	var cName = jQuery("#name").val();
	var cPhone = jQuery("#phone").val();
	var cEmail = jQuery("#email").val();
	var cAddress = jQuery("#address").val();
	if(cCardId == ""){ alert("Номер карты не может быть пустым!"); return 0;}
	if(cName == ""){ alert("ФИО не может быть пустым!"); return 0;}
	if(cPhone == ""){ alert("Телефон не может быть пустым!"); return 0;}
	
	jQuery.post("/?mode=main&method=set_card_active",
		{card_id:cCardId,
		 name:cName,
		 phone:cPhone,
		 email:cEmail,
		 address:cAddress},
		 function data(data){
			alert(data);
			document.location = '/';
		 }
	);
}

function updateBonusPercent(){
	var bonusPercent = jQuery("#bonus_percent").val();
	jQuery.post("/?mode=settings&method=set_bonus_percent",
			{bonus_percent:bonusPercent},
			function(data){
				alert(data);
			}
			);
}

function spendBonuses(cBonuses,cID){
	var cSumm = jQuery("#buy_summ").val();
	cBonuses = parseFloat(cBonuses);
	cID = parseInt(cID);
	cSumm = parseInt(cSumm);
	var newSumm = cSumm-cBonuses;
	if(confirm("Вы точно желаете провести операцию "+cSumm+"-"+cBonuses+"="+newSumm)){
		jQuery.post("/?mode=main&method=spend_bonuses",{
					summ:cSumm,
					bonuses:cBonuses,
					id:cID
					}, function(data){ alert(data); location.href="/";});	
	} else {
		return 0;
	}
}

function spendPercent(cPercent,cID){
        var cSumm = jQuery("#buy_summ").val();
        cPercent = parseFloat(cPercent);
        cID = parseInt(cID);
        cSumm = parseInt(cSumm);
	var percent = (cSumm * cPercent) / 100;
        var newSumm = cSumm-percent;
        if(confirm("Вы точно желаете провести операцию "+cSumm+"-"+cPercent+"%="+newSumm)){
                jQuery.post("/?mode=main&method=spend_percent",{
                                        summ:cSumm,
                                        percent:cPercent,
                                        id:cID
                                        }, function(data){ alert(data); location.href="/";});
        } else {
                return 0;
        }
}


function showOperationButtons(){
	jQuery("#operation_buttons").slideDown();
}

function riseBonuses(bPercent){
	var bSumm = jQuery("#buy_summ").val();
	var ID = jQuery("#id").val();
	var bSumm = jQuery("#buy_summ").val();
	bSumm = parseInt(bSumm);
	bPercent = parseInt(bPercent);
	bBonus = (bSumm * bPercent) / 100;
	if(confirm("Вы уверены что желаете провести накопительную операцию на "+bBonus+" бонусов?")){
		jQuery.post("/?mode=main&method=rise_bonuses"
			,{bonus:bBonus, id:ID, summ:bSumm}
			,function(data){
				alert(data);
				if(bSumm < 3000) {location.href = "/";}
				});
		if(bSumm > 3000){
		jQuery.post("/?mode=main&method=rise_percent"
			,{id:ID, summ:bSumm}
			,function(data){
				alert(data);
				location.href = "/";
			}
			);
		}
		
	} else {
		return 0;
	}
}

function getLogRecordByDate(){
	var sYear = jQuery("#year").val();
	var sMonth = jQuery("#month").val();
	jQuery.post("/?mode=log&method=ajax_get_log_by_date",{year:sYear, month:sMonth},
		function(data){
			jQuery("#container").html(data);
		}
	);
}

function setPercentSystem(){
	var percentSystem = "new";
	var percentStep = jQuery("#percent_step").val();
	if(document.getElementById("percent_system_old").checked){
			percentSystem = "old";
	}
	jQuery.post("/?mode=settings&method=ajax_set_percent_system",
							{percent_system:percentSystem,
							 percent_step:percentStep	
							}, function(data){alert(data);});
}

function setNewSystemBuy(oSumm,plusPercent,cardId,tSumm){
    tSumm = parseInt(tSumm);
    var ID = jQuery("#id").val();
    jQuery.post("/?mode=main&method=set_new_system_buy",{
        id:ID,
        summ:oSumm,
        add_percent:plusPercent,
        card_id:cardId,
        t_summ:tSumm
    },function(data){
        alert(data);
        location.href = '/';
    });
}

function getNewSystemButtons(oSumm){
    if(oSumm == ""){ jQuery("#container").html(""); return 0;}
    oSumm = parseInt(oSumm);
    var cardID = jQuery("#card_id").val();
	var ID = jQuery("#id").val();
    jQuery.post("/?mode=main&method=get_new_system_buttons",{summ:oSumm,card_id:cardID,id:ID},
        function(data){
            jQuery("#container").html(data);
        }
    );
}