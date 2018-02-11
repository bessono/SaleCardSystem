<?php
class system_controller {
    public $view_data = array();
	public function make_view($view_name){
		$view_data = $this->view_data;
		include("./views/system_view/header.php");
		include("./views/system_view/menu.php");
		include("./views/".$view_name.".php");
		include("./views/system_view/footer.php");
		
	}
	
	public function auth(){
		$model = new system_model();
		$auth_level = $model->auth();
		switch($auth_level['level']){
			case "admin":
				$_SESSION['level'] = "admin";
				$_SESSION['login'] = 1;
				break;
			case "manager":
				$_SESSION['level'] = "manager";
				$_SESSION['login'] = 1;
				break;
		}
	}
}
