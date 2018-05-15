<?php
include("models/settings.php");

class main_model extends system_model{

	public function check_card($card_id){
		
		$settings_model = new settings_model();
		$settings = $settings_model->get_settings();
		$link = $this->connect();
			$query = mysqli_query($link,"SELECT * FROM customers WHERE card_id = '".$card_id."'");
			$res = mysqli_fetch_array($query);
			if(isset($res['id'])){
				if($settings['percent_system'] == "old"){
					$this->get_customer_data_form_old_system();
				} else {
					$this->get_customer_data_form_new_system($card_id);
				}
			
			} else {
				$this->set_customer_data_form();
			}
		$this->disconnect($link);
		
	}
	
        function get_customer_data_form_new_system($card_id){
            $bml = new BAEHTMLLib();
            $link = $this->connect();
            if($query = mysqli_query($link, "SELECT * FROM customers WHERE card_id=".$card_id)){
                $result = mysqli_fetch_array($query);
                $table_array = $this->get_table($result);
                $out = $bml->tableCreate(2, $table_array, "class='center'", "", true).
                $bml->divOpen("class='panel center'").
                "Укажите сумму покупки:".
                $bml->input(" type='text' name='summ' id='summ' onkeyup='getNewSystemButtons(this.value)' ").
                $bml->input(" type='hidden' name='id' id='id' value='".$result['id']."' ").
                $bml->divClose().
                $bml->divOpen("id='container'").$bml->divClose();
                
            } else {
                $out = "Ошибка возврата данных по этой карте.";
            }
            $this->disconnect($link);
            
            
            print $out;
            
        }
        
        private function get_current_percent_by_card_id($card_id){
            $link = $this->connect();
            $query = mysqli_query($link,"SELECT percent FROM customers WHERE card_id=".$card_id);
            $result = mysqli_fetch_array($query);
            $this->disconnect($link);
            return $result[0];
        }
        
        public function get_new_system_buttons($summ,$card_id){
            $current_percent = $this->get_current_percent_by_card_id($card_id);
            $settings_model = new settings_model();
            $bml = new BAEHTMLLib();
            $settings = $settings_model->get_settings();
            $out = "Сумма покупки = ".$summ;
            $t_summ = 0;
            
            
            if($summ >= $settings['percent_step']){
                        $out .= $bml->br()."Сумма ".$bml->b("привышает","style='color:red;'")." порог начисления +1% пожизненого процента".
                        $bml->br()." После покупки будет начислен процент +1% ";
                        $button = $bml->input("type='button' value='Провести покупку' onclick='setNewSystemBuy(".$summ.",1,".$card_id.",".$t_summ.");'");
            
                        if($current_percent > 0){
                            $t_summ = ($summ * $current_percent)/100;
                            $t_summ = $summ - $t_summ;
                            $out .= "Клиент имеет ".$current_percent."% пожизненой скидки. ";
                            $button = $bml->input("type='button' value='Провести покупку' onclick='setNewSystemBuy(".$summ.",1,".$card_id.",".$t_summ.");'");
                            $out .= "К оплате ".$t_summ;
                
                        }
            } else {
                        $out .= $bml->br()."Сумма ".$bml->b("не привышает")." порог начисления +1% пожизненого процента ";
                        $button = $bml->input("type='button' value='Провести покупку' onclick='setNewSystemBuy(".$summ.",0,".$card_id.",".$t_summ.");'");
                        $out .= "К оплате ".$summ;
                        if($current_percent > 0){
                            $t_summ = ($summ * $current_percent)/100;
                            $t_summ = $summ - $t_summ;
                            $out .= "Клиент имеет ".$current_percent."% пожизненой скидки. ";
                            $button = $bml->input("type='button' value='Провести покупку' onclick='setNewSystemBuy(".$summ.",0,".$card_id.",".$t_summ.");'");
                            $out .= "К оплате ".$t_summ;
                
                        }
            }
            $out .= $bml->divOpen("class='panel center' style='width:200px;'");
            $out .= $bml->divClose();
            $out .= $bml->br().$button;
                
            print $out;
        }
        
	public function get_customer_data_form_old_system(){
		$bml = new BAEHTMLlib();
		$settings_model = new settings_model();
		$settings = $settings_model->get_settings();
		$out = $bml->br().$bml->b(" Запрос по карте ".$_POST['card_id']." вернул результат: ");
		$link = $this->connect();
			$query = mysqli_query($link,"SELECT * FROM customers WHERE card_id=".$_POST['card_id']);
			$result = mysqli_fetch_array($query);
			$bonuses_button = "";
			$percent_button = "";	
			if((!isset($result['bonuses'])) || ($result['bonuses'] == 0)) {
				$result['bonuses'] = 0;
				$bonuses_button = "";
			} else {
				$bonuses_button = $bml->input("type='button' value='Использовать бонусы' onclick='spendBonuses(".$result['bonuses'].",".$result['id'].")'").$bml->br();
			}
			if((!isset($result['percent'])) || ($result['percent'] == 0)) {
                        	$result['percent'] = 0;
				$percent_button = "";
                        } else {
				$percent_button = $bml->input("type='button' value='Использовать процент' onclick='spendPercent(".$result['percent'].",".$result['id'].")'").$bml->br();
			}
			$process_button = "";
			if($result['percent'] == 0){
				$process_button = $bml->input("type='button' value='Провести покупку' onclick='riseBonuses(".$settings['bonus_percent'].")'").$bml->br();

			}
			
			$table_array = $this->get_table($result);
			$out .= $bml->tableCreate("2",$table_array,"style='border:solid 1px silver; margin:auto;'","style='border:1px solid silver;'");
			$this->disconnect($link);
			$out .= $bml->br().$bml->br();
			$operation_div = "Сумма покупки:".
			$bml->input("type='hidden' id='id' value='".$result['id']."'").
			$bml->input("type='text' id='buy_summ' value='0' onkeyup='showOperationButtons();'").
			$bml->divOpen("class='panel' id='operation_buttons' style='margin-top:30px; display:none;'").
			$bml->br().
			$process_button.	
			$bml->hr().
			$bonuses_button.
                        $percent_button.	
			$bml->divClose();
		print $out.$operation_div;
	}
	
	private function get_table($result){
		$table_array = array();
		$bml = new BAEHTMLlib();
		array_push($table_array,"ФИО",$result['name'],
						"Телефон",$result['phone'],
						"e-mail",$result['email'],
						"Процент на скидку",$result['percent'],
						"Начислено бонусов",$result['bonuses'],
						"История",$bml->a("Просмотреть","target='blank' href='/?mode=main&method=history&param=".$result['id']."'"));
		return $table_array;				
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

	public function rise_percent($id,$summ){
		$link = $this->connect();
		$date = strtotime(date("d-m-Y H:i:s"));
		$percent = 0;
                if($summ < 3000) return false;
		if($summ >= 3000) {$percent = 2;}
		if($summ >= 6000) {$percent = 3;}
		if($summ >= 9000) {$percent = 5;}
		//exit("UPDATE customers SET percent=percent+".$percent." WHERE id=".$id."  ---    INSERT INTO log_report SET date_time=".$date.", operation='Покупка с увеличением процента: ".$percent."%', customer_id=".$id.", summ=".$summ." ");
		if($percent != 0){
		if((mysqli_query($link,"UPDATE customers SET percent=percent+".$percent." WHERE id=".$id)) && (mysqli_query($link,"INSERT INTO log_report SET date_time=".$date.", operation='Покупка с увеличением процента', customer_id=".$id.", summ=".$summ." "))){
			print "Добавлен процент дисконта: ".$percent."%";
		} else {
			print "Ошибка добавления процента. Обратитесь к разработчику".mysqli_error();
		}
		}
		$this->disconnect($link);	
	}
        
        public function addOnePercent($id){
            $link = $this->connect();
            mysqli_query($link,"UPDATE customers SET percent=percent+1 WHERE id=".$id);
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
                $this->rise_percent($id, $summ);
		print "Операция проведенна";
		$this->disconnect($link);
	}

	public function spend_percent($summ,$percent,$id){
                
                $link = $this->connect();
                $date = strtotime(date("d-m-Y H:i:s"));
                        $n_percent = ($summ * $percent) / 100;
                        $n_summ = $summ - $n_percent;
                       
                        mysqli_query($link,"UPDATE customers SET percent=0 WHERE id=".$id);
                        mysqli_query($link,"INSERT INTO log_report SET date_time=".$date.", operation='Покупка с использованием процента: ".$summ."-".$n_percent."(".$percent."%)=".$n_summ."', summ=".$summ.", customer_id=".$id);
                
                print "Операция проведенна";
                $this->rise_percent($id, $summ);
                $this->disconnect($link);
        }
        
        public function spend_money($card_id,$summ,$t_summ,$id){
            $link = $this->connect();
                $date = strtotime(date("d-m-Y H:i:s"));
                if($t_summ == 0){
                    mysqli_query($link,"INSERT INTO log_report SET date_time=".$date.", summ=".$summ.", operation='Покупка на сумму ".$summ."', customer_id=".$id);
                } else {
                    mysqli_query($link,"INSERT INTO log_report SET date_time=".$date.", summ=".$summ.", operation='Покупка c использованием процента сумма=".$summ." к оплате ".$t_summ."', customer_id=".$id);
                }
                print "Операция проведена";
            $this->disconnect($link);
        }

}
