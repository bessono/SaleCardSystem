<?php

class main_model extends system_model{

	public function check_card($card_id){
		$link = $this->connect();
			$query = mysqli_query($link,"SELECT * FROM customers WHERE card_id = '".$card_id."'");
			$res = mysqli_fetch_array($query);
			if(isset($res['id'])){
				$this->get_customer_data_form();
			} else {
				$this->set_customer_data_form();
			}
		$this->disconnect($link);
		
	}
	
	public function get_customer_data_form(){
		$bml = new BAEHTMLlib();
		$out = $bml->br().$bml->b("Запрос по карте ".$_POST['card_id']." вернул результат:");
		$link = $this->connect();
			$query = mysqli_query($link,"SELECT * FROM customers WHERE card_id=".$_POST['card_id']);
			$result = mysqli_fetch_array($query);
				
			if((!isset($result['bonuses'])) || ($result['bonuses'] == "")) {
				$result['bonuses'] = 0;
				$bonuses_button = "";
			} else {
				$bonuses_button = $bml->input("type='button' value='Покупатель хочет использовать бонусы' onclick='spendBonuses(".$result['bonuses'].")'").$bml->br();
			}
			if((!isset($result['percent'])) || ($result['percent'] == "")) {
                        	$result['percent'] = 0;
				$percent_button = "";
                        } else {
				$percent_button = $bml->input("type='button' value='Покупатель хочет использовать процент'").$bml->br();
			}
			if((isset($result['percent'])) && ($result['percent'] <= 4)){
				$add_percent_button = $bml->input("type='button' value='Произвести покупку с увеличением процента'").$bml->br();
			} 
			
			$table_array = array();
			array_push($table_array,"ФИО",$result['name'],
						"Телефон",$result['phone'],
						"e-mail",$result['phone'],
						"Процент на скидку",$result['percent'],
						"Начислено бонусов",$result['bonuses']);
			$out .= $bml->tableCreate("2",$table_array,"style='border:solid 1px silver; margin:auto;'","style='border:1px solid silver;'");
		$this->disconnect($link);
		$out .= $bml->br().$bml->br();
		$operation_div = $bml->divOpen("class='panel' style='margin-top:30px;'")."Покупатель произвёл покупку на сумму:".
			$bml->input("type='text' id='buy_summ' value='0'").
			$bml->br().
			$bonuses_button.
			$percent_button.
			$bml->input("type='button' value='Произвести покупку с увеличением бонусов'").$bml->br().	
			$add_percent_button.
			$bml->divClose();
		print $out.$operation_div;
	}
	
	public function set_customer_data_form(){
		$bml = new BAEHTMLlib();
		$form_content = $bml->b("Карта не активированна!","style='color:red;'");
		$form_elements = array(
			"Ф.И.О. Нового владельца:",$bml->input("type='text' id='name' style='width:300px;'"),
			"Телефон:",$bml->input("type='text' id='phone'"),
			"E-mail:",$bml->input("type='text' id='email'"),
			"Адрес:",$bml->input("type='text' id='address'")
		);
		$form_content .= $bml->tableCreate(2,$form_elements,"style='margin:auto;'");
		$form_content .= $bml->input("type='button' value='Активировать карту' onclick='setCardActive();'");
		$form_content = $bml->divWrapped($form_content,"class='panel'");
		print $form_content;
	}
	
	public function set_card_active($card_id,$name,$phone,$email,$address){
		$link = $this->connect();
			if(!mysqli_query($link,"INSERT INTO customers SET card_id='".$card_id."', name='".$name."', email='".$email."', phone='".$phone."'")){
				print "Ошибка регистрации карты, обратитесь к разработчику";
			} else {
				print "Карта зарегистрированна на ".$name;
			}
		$this->disconnect($link);
	}

}
