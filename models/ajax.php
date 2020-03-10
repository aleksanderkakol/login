<?php
class AjaxModel extends Model{
	public function lista(){
		$this->query('SELECT * FROM peoplecnt WHERE user_type = 0');
		$rows = $this->resultSet();
		return print_r(json_encode($rows));
	}

	public function Count() {
		$this->query('SELECT SUM(quantity) FROM peoplecnt WHERE user_type = 0');
		$row = $this->single();
		return print_r(json_encode($row['sum']));
	  }

	  public function people() {
		$this->query("SELECT DISTINCT evt_salto_user_name FROM zewng.evt WHERE evt_salto_user_type = 0 AND evt_salto_ts >= '2019-09-04' AND evt_salto_user_name != '' AND evt_salto_user_name ILIKE '%[%]%' ORDER BY evt_salto_user_name");
		$rows = $this->resultSet();
		$result=array();
		foreach($rows as $key => $value) {
  			array_push($result,$value['evt_salto_user_name']);
		}
		return print_r(json_encode($result));
	}

	public function doors() {
		$this->query("SELECT DISTINCT evt_salto_door_name FROM zewng.evt WHERE evt_salto_door_name != '' AND evt_salto_door_name NOT ILIKE '%Liczba%' AND evt_evd_id != ALL(ARRAY[2500, 2501, 2510, 2511, 3000, 3001])");
		$rows = $this->resultSet();
		$result=array();
		foreach($rows as $key => $value) {
  			array_push($result,$value['evt_salto_door_name']);
		}
		return print_r(json_encode($result));
	}
}
