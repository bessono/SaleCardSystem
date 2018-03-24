<?php

class settings_model extends system_model{
	public function get_pins(){
		$link = $this->connect();
		$query = mysqli_query($link,"SELECT pin FROM pins WHERE level='admin'");
		$res = mysqli_fetch_array($query);
		$pins['admin'] = $res['pin'];
		$query = mysqli_query($link,"SELECT pin FROM pins WHERE level='manager'");
		$res = mysqli_fetch_array($query);
		$pins['manager'] = $res['pin'];
		$this->disconnect($link);
		return $pins;
	}

	public function get_settings(){
                $link = $this->connect();
                $query = mysqli_query($link,"SELECT * FROM settings");
                $res = mysqli_fetch_array($query);
                return $res;
        }
	
	public function update_pins($pin_admin,$pin_manager){
		$link = $this->connect();
		$out = "Обновление PIN-кодов: ";
		if(!mysqli_query($link,"UPDATE pins SET pin='".$pin_admin."' WHERE level='manager'")){
			$out = mysqli_error();
			exit();
		} else {
			$out .= "ok ";
		}
		if(!mysqli_query($link,"UPDATE pins SET pin='".$pin_manager."' WHERE level='admin'")){
			$out = mysqli_error();
			exit();
		} else {
			$out .= "ok";
		}
		$this->disconnect($link);
		return $out;
	}
	
	public function set_bonus_percent($bonus_percent){
		$link = $this->connect();
			if(!mysqli_query($link,"UPDATE settings SET bonus_percent=".$bonus_percent)){
				return "Ошибка сохранения обратитесь к разработчику";
			} else {
				return "Процент сохранён";
			}
		$this->disconnect();
	}
	
	public function ajax_set_percent_system($percent_system){
		$link = $this->connect();
			if(!mysqli_query($link,"UPDATE settings SET percent_system='".$percent_system."'")){
				print "Ошибка сохранения системы скидок ";
			} else {
				print "Система скидок сохранена ";
			}
		$this->disconnect($link);
	}
	
	public function ajax_set_percent_step($percent_step){
		$link = $this->connect();
			if(!mysqli_query($link,"UPDATE settings SET percent_step=".$percent_step)){
				print "Ошибка сохранения порога ";
			} else {
				print "Порог сохранён ";
			}
		$this->disconnect($link);
	}
}
