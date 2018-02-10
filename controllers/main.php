<?php

class main_controller extends system_controller{
	public function start_form($s){
		$bml = new BAEHTMLlib();
		if(isset($_POST['auth_pin'])){
			$this->auth();
		}
		if((!isset($_SESSION['login'])) && ($_SESSION['login'] == 1)){
			$this->make_view("main/start_form");
		} else {
			$this->make_view("main/main_form");
		}
	}
}