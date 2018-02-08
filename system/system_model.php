<?php 

class system_model {
	
	public $view_data = array();
	public function make_view($view_name){
		$view_data = $this->view_data;
                include("./views/system_view/header.php");
		include("./views/".$view_name.".php");
		include("./views/system_view/footer.php");
		
	}

	public function connect(){
		$link = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
		return $link;
	}
	
	public function disconnect($link){
		mysqli_close($link);
	}
}