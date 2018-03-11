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
	cardId = jQuery("#card_id").val();
	jQuery.post("/?mode=main&method=check_card",
				{card_id:cardId},
				function(data){
					jQuery("#content").html(data);
				});
}

function setCardActive(){
	cCardId = jQuery("#card_id").val();
	cName = jQuery("#name").val();
	cPhone = jQuery("#phone").val();
	cEmail = jQuery("#email").val();
	cAddress = jQuery("#address").val();
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
	bonusPercent = jQuery("#bonus_percent").val();
	jQuery.post("/?mode=settings&method=set_bonus_percent",
			{bonus_percent:bonusPercent},
			function(data){
				alert(data);
			}
			);
}

function spendBonuses(){
	alert("debug");
}
