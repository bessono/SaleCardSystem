<?php

class log_controller extends system_controller{

	public function start_form(){
		$this->make_view("log/start_form");
	}

	public function ajax_get_log_by_date(){
		$_POST['year'] = intval($_POST['year']);
		if(strlen($_POST['month']) > 2) { exit("Данные пришедшие на сервер не соотвецтвуют шаблону");}
		$model = new log_model();
		$model->ajax_get_log_by_date($_POST['month'],$_POST['year']);
	}

}
