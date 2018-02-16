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
		print "OK";
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