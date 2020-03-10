<?php
class CameraModel extends Model{
	public function Index(){
		$this->query('SELECT * FROM lpr ORDER BY lpr_id');
		$rows = $this->resultSet();
		return $rows;
	}

	public function list(){
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
			if($post['to_employee'] == 'true') {
				$company_name = 'GOS';	
			} else {
				$company_name = $post['company_name'];
			}
			// Insert into SQL
			$plate = strtoupper($post['lpr_plate']);
			$plate = preg_replace('/\s*/', '', $plate);
			$car = strtoupper($post['car_name']);

			
			$this->query("SELECT lpr_plate FROM lpr WHERE lpr_plate = :plate");
			$this->bind(':plate', $plate);
			$row = $this->single();
			if($row>=1){
				Messages::setMsg('Tablica jest już przypisana do innego użytownika', 'error');
				return;
			}
			$this->query('INSERT INTO lpr(lpr_user_name, lpr_plate, lpr_on_whitelist, lpr_car, lpr_company, lpr_gate, lpr_valid_to) VALUES(:name, :plate, :whlist, :car, :company, :gate, :valid_to)');
			$this->bind(':name', $post['lpr_name']);
			$this->bind(':plate', $plate);
			$this->bind(':car', $car);
			$this->bind(':valid_to', $post['valid_to']);
			$this->bind(':company', $company_name);
			$this->bind(':gate', $post['gate_name']);
			$this->bind(':whlist', $post['lpr_on_whitelist']);
			$this->execute();
			// Verify
			if($this->lastInsertId()){
				Messages::setMsg('Dodano nową tablicę', 'success');
				// header('Location: '.ROOT_URL.'camera');
			}
		}
		return;
	}

	public function update(){
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		$this->query('UPDATE zewng.lpr SET lpr_on_whitelist = :lpr_whlist, lpr_valid_to = :lpr_valid_to WHERE lpr_id = :lpr_id');
		$this->bind(':lpr_id', $post['lpr']);
		$this->bind(':lpr_whlist', $post['value']);
		$this->bind(':lpr_valid_to', $post['date']);
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
