<?php 

class log_model extends system_model{

	public function get_history_by_id($id){
                $link = $this->connect();
                $bml = new BAEHTMLlib();
                if($query = mysqli_query($link,"SELECT * FROM log_report WHERE customer_id=".$id)){


                        $data_table = array();
                        array_push($data_table,"Дата","Операция","Сумма","К оплате");
                        while($result = mysqli_fetch_array($query)){
                                array_push($data_table,date("d-m-Y H:i:s",$result['date_time'])
                                                        ,$result['operation']
                                                        ,$result['summ'],$result['t_summ']);
                        }
                        $this->view_data['content'] = $bml->tableCreate(4,$data_table,"style='margin:auto;'","style='border:1px silver solid;'","true");
                        $this->make_view("main/get_history");
                }
                $this->disconnect($link);
        }
	
	public function ajax_get_log_by_date($month,$year){
		$date_in = "01-".$month."-".$year." 00:00:00";
		$date_out = date("t-").$month."-".$year." 23:59:59";
		$out = "Период с ".$date_in." по ".$date_out;
		$date_in = strtotime($date_in);
		$date_out = strtotime($date_out);
		$link = $this->connect();
		$bml = new BAEHTMLLib();
		//exit("SELECT * FROM log_report WHERE date_time>=".$date_in." and date_time<=".$date_out."");
		$query = mysqli_query($link,"SELECT * FROM log_report WHERE date_time>=".$date_in." and date_time<=".$date_out."");
		$table_data = array("Дата","Операция","Сумма покупки","К оплате");
		while($result = mysqli_fetch_array($query)){
			array_push($table_data,date("d-m-Y h:i:s",$result['date_time']),
						$result['operation'],
						$result['summ'],$result['t_summ']
						);
		}	
		$out .= $bml->tableCreate(4,$table_data,"style='margin:auto'","style='border:1px silver solid;'",true);
		$this->disconnect($link);
		print $out;	
	}

}
