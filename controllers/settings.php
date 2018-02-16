<?php

class settings_controller extends system_controller{
	public function start_form(){
		if($_SESSION['level'] != "admin") exit("Вы не администратор!!!");
		$model = new settings_model();
		$this->view_data['pins'] = $model->get_pins();
		$this->make_view("settings/start_form");
	}
	
	public function update_pins(){
		if((isset($_POST['pin_admin'])) && (isset($_POST['pin_manager']))){
			$model = new settings_model();
			$result = $model->update_pins($_POST['pin_admin'],$_POST['pin_manager']);
			print $result;
		}
	}
	
}
