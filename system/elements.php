<?php
class elements {

	public function  select_years($select_name){
		$out = "<select name='".$select_name."' id='".$select_name."' style='width:90px;'>";
		for($x = 2018; $x <= 2019; $x ++){
			if(date("Y") == $x) { $selected="selected='selected'"; } else {$selected = "";}
			$out .= "<option ".$selected." value='".$x."'>".$x."</option>";
		} 
		$out .= "</select>";
		return $out;
	}

	public function select_month($select_name){
		$now_month = date("m");
		$month_array = array("","Янв","Фев","Мар","Апр","Май","Июнь","Июль","Авг","Сен","Окт","Ноя","Дек");
		$out = "<select name='".$select_name."' id='".$select_name."' style='width:90px;'>";
		for($x = 1; $x <= 12; $x++){
			$i = $x;
			if($i < 10) {$i = "0".$i;}
			if($i == $now_month) { $selected="selected='selected'"; } else {$selected = "";}
			$out .= "<option ".$selected." value='".$i."'>".$month_array[$x]."</option>";
		}
		$out .= "</select>";
		return $out;
	}
	public function select_days($select_name){
		$now_day = date("d");
		$out = "<select name='".$select_name."' id='".$select_name."' style='width:50px;'>";
		for($x = 1; $x <= 31; $x++ ){
			if($x < 10) {$x = "0".$x;}
			if($now_day == $x) { $selected="selected='selected'"; } else {$selected = "";}
			$out .= "<option ".$selected." value='".$x."'>".$x."</option>";
		}
		$out .= "</select>";
		return $out;
	}

}
