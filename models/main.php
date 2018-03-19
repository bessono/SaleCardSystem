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
		include("models/settings.php");
		$settings_model = new settings_model();
		$settings = $settings_model->get_settings();
		
		$out = $bml->br().$bml->b("Запрос по карте ".$_POST['card_id']." вернул результат:");
		$link = $this->connect();
			$query = mysqli_query($link,"SELECT * FROM customers WHERE card_id=".$_POST['card_id']);
			$result = mysqli_fetch_array($query);
				
			if((!isset($result['bonuses'])) || ($result['bonuses'] == "")) {
				$result['bonuses'] = 0;
				$bonuses_button = "";
			} else {
				$bonuses_button = $bml->input("type='button' value='Покупатель хочет использовать бонусы' onclick='spendBonuses(".$result['bonuses'].",".$result['id'].")'").$bml->br();
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
						"e-mail",$result['email'],
						"Процент на скидку",$result['percent'],
						"Начислено бонусов",$result['bonuses'],
						"История",$bml->a("Просмотреть","target='blank' href='/?mode=main&method=history&param=".$result['id']."'"));
			$out .= $bml->tableCreate("2",$table_array,"style='border:solid 1px silver; margin:auto;'","style='border:1px solid silver;'");
		$this->disconnect($link);
		$out .= $bml->br().$bml->br();
		$operation_div = "Сумма покупки:".
			$bml->input("type='hidden' id='id' value='".$result['id']."'").
			$bml->input("type='text' id='buy_summ' value='0' onkeyup='showOperationButtons();'").
			$bml->divOpen("class='panel' id='operation_buttons' style='margin-top:30px; display:none;'").
			$bml->br().
			$bonuses_button.
			$percent_button.
			$bml->input("type='button' value='Произвести покупку с увеличением бонусов на ".$settings['bonus_percent']."% от суммы' onclick='riseBonuses(".$settings['bonus_percent'].")'").$bml->br().	
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
				$date = strtotime(date("d-m-Y H:i:s"));
				mysqli_query($link,"INSERT INTO log_report SET date_time=".$date.", operation='Активизированна карта ".$card_id."', summ=, summ=0");
			}
		$this->disconnect($link);
	}

	public function rise_bonuses($id,$bonuses,$summ){
		$link = $this->connect();
		$date = strtotime(date("d-m-Y H:i:s")); 
		if((mysqli_query($link, "UPDATE customers SET bonuses=bonuses+".$bonuses." WHERE id=".$id)) && (mysqli_query($link,"INSERT INTO log_report SET date_time=".$date.", operation='Покупка с увеличением бонуса', customer_id=".$id.", summ=".$summ." "))){
			return "Операция проведена";
		} else {
			return "Ошибкап проведения операции";
		}
		$this->disconnect($link);
	}
	
	public function get_history($id){
		$link = $this->connect();
		$bml = new BAEHTMLlib();
		if($query = mysqli_query($link,"SELECT * FROM log_report WHERE customer_id=".$id)){

		 
			$data_table = array();
			array_push($data_table,"Дата","Операция","Сумма");
			while($result = mysqli_fetch_array($query)){
				array_push($data_table,date("d-m-Y H:i:s",$result['date_time'])
							,$result['operation']
							,$result['summ']);
			}
			$this->view_data['content'] = $bml->tableCreate(3,$data_table,"style='margin:auto;'","style='border:1px silver solid;'","true");
			$this->make_view("main/get_history"); 
		}
		$this->disconnect($link);
	}

	public function spend_bonuses($summ,$bonuses,$id){
		$link = $this->connect();
		$date = strtotime(date("d-m-Y H:i:s"));
		if($summ > $bonuses){
			$n_summ = $summ-$bonuses;
			mysqli_query($link,"UPDATE customers SET bonuses=0 WHERE id=".$id);
			mysqli_query($link,"INSERT INTO log_report SET date_time=".$date.", operation='Покупка с использованием ".$bonuses." бонусов: ".$bonuses."-".$summ."=".$n_summ."(к оплате)', summ=".$summ.", customer_id=".$id);
		} else {
			$n_bonuses = $bonuses-$summ;
			$n_summ = 0;
			//exit("INSERT INTO log_report SET date_time=".$date.", operation='Покупка с использованием ".$bonuses." бонусов: ".$bonuses."-".$summ."=".$n_summ."', summ='".$summ."'");
			mysqli_query($link,"UPDATE customers SET bonuses=".$n_bonuses." WHERE id=".$id);
                        mysqli_query($link,"INSERT INTO log_report SET date_time=".$date.", operation='Покупка с использованием ".$bonuses." бонусов: ".$bonuses."-".$summ."=".$n_summ."(к оплате)', summ=".$summ.", customer_id=".$id);
		}
		print "Операция проведенна";
		$this->disconnect($link);
	}
}
