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
	
	public function kill_hack_code($text){
		$text = strtolower($text);
		$text = str_replace("--","",$text);
		$text = str_replace("insert into","",$text);
		$text = str_replace("|","",$text);
		$text = str_replace("select","",$text);
		$text = str_replace("script","",$text);
		$text = str_replace("union","",$text);
		$text = mysql_escape_string($text);
		$text = strip_tags($text);
		$text = htmlspecialchars($text);
		return $text;
	}
}
