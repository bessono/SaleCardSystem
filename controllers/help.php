<?php

class help_controller extends system_controller{
	public function show_help(){
		$this->view_data['content'] = "Help content";
		$this->make_view("help/help");
	}
}