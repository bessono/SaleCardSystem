<?php
class system_controller {
    public $view_data = array();
	public function make_view($view_name){
		$view_data = $this->view_data;
                include("./views/system_view/header.php");
		include("./views/".$view_name.".php");
		include("./views/system_view/footer.php");
		
	}
}