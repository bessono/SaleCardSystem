<?php

class settings_controller extends system_controller{
	public function __construct(){
		if($_SESSION['level'] != "admin"){
			exit("Вы не администратор!");
		}
	}

	public function start_form(){
		if($_SESSION['level'] != "admin") exit("Вы не администратор!!!");
		$model = new settings_model();
		$this->view_data['pins'] = $model->get_pins();
		$this->view_data['settings'] = $model->get_settings();
		$this->make_view("settings/start_form");
	}
	
	public function update_pins(){
		if((isset($_POST['pin_admin'])) && (isset($_POST['pin_manager']))){
			$model = new settings_model();
			$result = $model->update_pins($_POST['pin_admin'],$_POST['pin_manager']);
			print $result;
		}
	}

	public function set_bonus_percent(){
		$_POST['bonus_percent'] = intval($_POST['bonus_percent']);
		$model = new settings_model();
		$result = $model->set_bonus_percent($_POST['bonus_percent']);
		print $result;
	}	
}

