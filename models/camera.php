<?php
class CameraModel extends Model{
	public function Index(){
		$this->query('SELECT * FROM lpr ORDER BY lpr_id');
		$rows = $this->resultSet();
		return $rows;
	}

	public function add(){
		// Sanitize POST
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

		if($post['submit']){
			if($post['lpr_name'] == '' || $post['lpr_plate'] == '' || $post['lpr_on_whitelist'] == ''){
				Messages::setMsg('Proszę wypełnić wszystkie pola', 'error');
				return;
			}
			// Insert into SQL
			$plate = strtoupper($post['lpr_plate']);
			$plate = preg_replace('/\s*/', '', $plate);
			$this->query('INSERT INTO lpr(lpr_user_name, lpr_plate, lpr_on_whitelist) VALUES(:name, :plate, :whlist)');
			$this->bind(':name', $post['lpr_name']);
			$this->bind(':plate', $plate);
			$this->bind(':whlist', $post['lpr_on_whitelist']);
			$this->execute();
			// Verify
			if($this->lastInsertId()){
				Messages::setMsg('Dodano nową tablicę', 'success');
			}
		}
		return;
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

	public function update(){
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		$this->query('UPDATE zewng.lpr SET lpr_on_whitelist = :lpr_whlist WHERE lpr_id = :lpr_id');
		$this->bind(':lpr_id', $post['lpr']);
		$this->bind(':lpr_whlist', $post['value']);
		$result = $this->execute();
		print_r(json_encode($result));
		return;
	}

	public function delete(){
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		$this->query("DELETE FROM zewng.lpr WHERE lpr_id = :lpr_id");
		$this->bind(':lpr_id', $post['yes']);
		if($this->rowCount()){
			Messages::setMsg('Tablica '.$post['lpr_plate'].' została usunięta', 'success');
		}
		header('Location: '.ROOT_URL.'camera');
		return;
	}
}
