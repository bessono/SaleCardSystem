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
	
}
