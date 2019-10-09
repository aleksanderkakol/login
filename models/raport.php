<?php
class RaportModel extends Model{
	public function Index() {
	}

	public function download() {
		// Sanitize POST
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		if($post['submit']){
			if ($post['event'] == 'all'){
				$event = 'NOT NULL';
			} else if ($post['event'] == 'alarms'){
				$event = 'true';
			} if ($post['event'] == 'access'){
				$event = 'false';
			}

			($post['raport_username'] === '') ? $raport_username = '%': $raport_username = '%'.$post['raport_username'].'%';
			($post['raport_doorname'] === '') ?  $raport_doorname = '%': $raport_doorname = '%'.$post['raport_doorname'].'%';

			if($post['event']==='hours'){
				$this->query("SELECT user_name AS imie_nazwisko, enter_time AS godzina_wejscia, REPLACE((SELECT 'Budynek')::text || ' ' || REPLACE(door_name,'/',' drzwi '), 'Budynek Bramka', 'Bramka') AS drzwi_wejscia, exit_time AS godzina_wyjscia, REPLACE((SELECT 'Budynek')::text || ' ' || REPLACE(exit_door,'/',' drzwi '), 'Budynek Bramka', 'Bramka') AS drzwi_wyjscia, work_time AS liczba_godzin FROM zewng.user_in_out WHERE user_name ilike '$raport_username' AND door_name ilike '$raport_doorname' AND enter_time >= :start and enter_time <= :end ORDER BY user_name");	
			}else if ($post['event']==='alarms'){
				$this->query("SELECT evt_salto_ts AS data, evt_salto_user_name AS uzytkownik, evd.evd_dsc AS zdarzenie, REPLACE((SELECT 'Budynek')::text || ' ' || REPLACE(evt_salto_door_name,'/',' drzwi '), 'Budynek Bramka', 'Bramka') AS drzwi, evt_ack.ack_cmt AS komentarz FROM zewng.evt JOIN zewng.evt_ack ON evt_id = ack_evt_id JOIN zewng.evd ON evt.evt_evd_id = evd.evd_id WHERE evt_salto_user_name ilike '$raport_username' AND evt_salto_door_name ilike '$raport_doorname' AND evt_evd_id IN (select evd_id from zewng.evd WHERE evd_isalarm IS $event) AND evt_date >= :start AND evt_date <= :end ORDER BY evt_salto_ts");
			}else{
				$this->query("SELECT evt_salto_ts AS data, evt_salto_user_name AS uzytkownik, evd.evd_dsc AS zdarzenie, REPLACE((SELECT 'Budynek')::text || ' ' || REPLACE(evt_salto_door_name,'/',' drzwi '), 'Budynek Bramka', 'Bramka') AS drzwi FROM zewng.evt JOIN zewng.evd ON evt.evt_evd_id = evd.evd_id WHERE evt_salto_user_name ilike '$raport_username' AND evt_salto_door_name ilike '$raport_doorname' AND evt_evd_id IN (select evd_id from zewng.evd WHERE evd_isalarm IS $event) AND evt_date >= :start AND evt_date <= :end ORDER BY evt_salto_ts");
			}
			if($post['start']===$post['end']){echo $post['end'];}
			
			$this->bind(':start', $post['start']);
			$this->bind(':end', $post['end']);
			$rows = $this->resultSet();
			return $rows;
		}
	}

	public function people() {
		$this->query("SELECT DISTINCT evt_salto_user_name FROM zewng.evt WHERE evt_salto_user_type = 0 AND evt_salto_ts >= '2019-09-04' AND evt_salto_user_name != ''");
		$rows = $this->resultSet();
		$result=array();
		foreach($rows as $key => $value) {
  			array_push($result,$value['evt_salto_user_name']);
		}
		return print_r(json_encode($result));
	}

	public function doors() {
		$this->query("SELECT DISTINCT evt_salto_door_name FROM zewng.evt WHERE evt_salto_door_name != '' AND evt_salto_door_name NOT ILIKE '%Liczba%'");
		$rows = $this->resultSet();
		$result=array();
		foreach($rows as $key => $value) {
  			array_push($result,$value['evt_salto_door_name']);
		}
		return print_r(json_encode($result));
	}
}
