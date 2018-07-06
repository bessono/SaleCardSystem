<?php

class main_controller extends system_controller{
	public function start_form($s){
		$bml = new BAEHTMLlib();
		if(isset($_POST['auth_pin'])){
			$this->auth();
		}
		if((isset($_SESSION['login'])) && ($_SESSION['login'] == 1)){
			$this->make_view("main/main_form");
		} else {
			$this->make_view("main/start_form");
		}
	}

	public function log_out(){
		unset($_SESSION['login']);
		unset($_SESSION['level']);
		$this->make_view("main/exit_redirect");
	}
	
	public function rise_percent(){
		$_POST['id'] = intval($_POST['id']);
                $_POST['summ'] = floatval($_POST['summ']);
                $model = new main_model();
           	$model->rise_percent($_POST['id'],$_POST['summ']);
		}
	
	public function rise_bonuses(){
		$_POST['bonus'] = floatval($_POST['bonus']);
		$_POST['id'] = intval($_POST['id']);
		$_POST['summ'] = floatval($_POST['summ']);
		$model = new main_model();
		print $model->rise_bonuses($_POST['id'],$_POST['bonus'],$_POST['summ']);
	}

	public function history($id){
		$id = intval($id);
		include("models/log.php");
		$model = new log_model();
		$model->get_history_by_id($id);
	}
	
	public function check_card(){
		if(isset($_POST['card_id'])){
			$_POST['card_id'] = $this->kill_hack_code($_POST['card_id']);
			if($_POST['card_id'] != ""){
			$model = new main_model();
			$model->check_card($_POST['card_id']);
			}
		}
	}
	
	public function set_card_active(){
		$model = new main_model();
		$_POST['card_id'] = $this->kill_hack_code($_POST['card_id']);
		$_POST['name'] = $this->kill_hack_code($_POST['name']);
		$_POST['phone'] = $this->kill_hack_code($_POST['phone']);
		$_POST['email'] = $this->kill_hack_code($_POST['email']);
		$_POST['address'] = $this->kill_hack_code($_POST['address']);
		$model->set_card_active($_POST['card_id'],$_POST['name'],$_POST['phone'],$_POST['email'],$_POST['address']);
	}
	
	public function spend_bonuses(){
		$_POST['summ'] = floatval($_POST['summ']);
		$_POST['bonuses'] = floatval($_POST['bonuses']);
		$_POST['id'] = intval($_POST['id']); 
		$model = new main_model();
		$model->spend_bonuses($_POST['summ'],$_POST['bonuses'],$_POST['id']);
	}

	public function spend_percent(){
                $_POST['summ'] = floatval($_POST['summ']);
                $_POST['percent'] = floatval($_POST['percent']);
                $_POST['id'] = intval($_POST['id']);
                $model = new main_model();
                $model->spend_percent($_POST['summ'],$_POST['percent'],$_POST['id']);
        }
        
        public function get_new_system_buttons(){
                $model = new main_model();
                $model->get_new_system_buttons($_POST['summ'],$_POST['card_id'],$_POST['id']);
        }
        
        public function set_new_system_buy(){
            $model = new main_model();
            //var_dump($_POST);
            /*if($_POST['add_percent'] > 0){
                $model->addOnePercent($_POST['id']);
            } else {
                
            }*/
			
			$model->rise_bonuses2($_POST['id'], $_POST['summ']);
            $model->spend_money($_POST['card_id'], $_POST['summ'],$_POST['t_summ'],$_POST['id']);
            
        }
	
}
