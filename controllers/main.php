<?php

class main_controller extends system_controller{
	public function start_form($s){
		$bml = new BAEHTMLlib();
		$this->view_data['s'] = "MVC is work";
		$this->view_data['s'].= $bml->br().
					$bml->b(" test BAEHTMLlib").
					$bml->make_baef_link("Help","help","show_help").
					$bml->br();
		$this->make_view("main/start_form");
	}
}