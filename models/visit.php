<?php
class VisitModel extends Model{
	public function Index(){
		$this->query('SELECT * FROM visit JOIN doctype ON visit.doctype_id = doctype.doctype_id WHERE status = 1 ORDER BY ts2 DESC');
		$rows = $this->resultSet();
		return $rows;
	}

	public function getUnUsedVisitorCards() {
		$this->query('SELECT * FROM visitorcard WHERE id NOT IN (SELECT vcard_id FROM visit WHERE status = 1)');
		$visitorCards = $this->resultSet();
		$this->query('SELECT * FROM doctype ORDER BY doctype_id');
		$documentsNames = $this->resultSet();
		$result = array(
			"vcards" => $visitorCards,
			"docname" => $documentsNames
		);
		echo json_encode($result);
		return;
	}

	public function add(){
		// Sanitize POST
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		if($post['submit']){
			if($post['to_employee']=='true'){
				$post['name21'] = $post['name11'];
				$post['nadmiar1'] = 'GOS';
				$post['nadmiar3'] = 1;
			}
			if($post['vcard_id'] == '' || $post['name11'] == '' || $post['name21'] == '' || $post['doctype_id'] == '' || $post['doc_num'] == '' || $post['nadmiar1'] == '' || $post['nadmiar3'] == ''){
				Messages::setMsg('Proszę wypełnić wszystkie pola', 'error');
				return;
			}
			// Insert into SQL
			$this->query('INSERT INTO visit(vcard_id, name11, name21, doctype_id, doc_num, nadmiar1, nadmiar2, nadmiar3, ts1, status, to_employee) VALUES(:vcard_id, :name11, :name21, :doctype_id, :doc_num, :nadmiar1, :nadmiar2, :nadmiar3, current_timestamp, 1, :to_employee)');
			$this->bind(':vcard_id', $post['vcard_id']);
			$this->bind(':name11', $post['name11']);
			$this->bind(':name21', $post['name21']);
			$this->bind(':doctype_id', $post['doctype_id']);
			$this->bind(':doc_num', $post['doc_num']);
			$this->bind(':nadmiar1', $post['nadmiar1']);
			$this->bind(':nadmiar2', $post['nadmiar2']);
			$this->bind(':nadmiar3', $post['nadmiar3']);
			$this->bind(':to_employee', $post['to_employee']);
			$this->execute();
			$this->query('INSERT INTO zewng.evt(evt_pnl_id,evt_evd_id,evt_d1,evt_salto_ts,evt_salto_is_exit, evt_salto_user_type, evt_salto_user_name, evt_salto_door_name) values(1,3000,:nadmiarevt,current_timestamp,false, 1, :guest1, :quantity1)');
			$this->bind(':nadmiarevt', $post['nadmiar3']);
			$this->bind(':guest1', $post['vcard_id'].' GOSC');
			$this->bind(':quantity1', 'Liczba gości '.$post['nadmiar3']);
			$this->execute();
			// Verify
			if($this->lastInsertId()){
				// Redirect
				Messages::setMsg('Wizyta dodana pomyślnie', 'success');
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

	public function history(){
		$this->query('SELECT * FROM visit JOIN doctype ON visit.doctype_id = doctype.doctype_id WHERE status = 0 ORDER BY ts2 DESC');
		$rows = $this->resultSet();
		return $rows;
	}

	public function delete(){
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		if($post['submit']){
			if($post['delete'] == ''){
				Messages::setMsg('Błąd, wizyta zakończona', 'error');
				return;
			}
		}
		$this->query("INSERT INTO zewng.evt(evt_pnl_id,evt_evd_id,evt_salto_ts,evt_salto_is_exit, evt_salto_user_type, evt_salto_user_name, evt_salto_door_name) values(1,3001,current_timestamp, true, 0, :vcard_id, :number)");
		$this->bind(':vcard_id', $post['vcard'].' GOSC');
		$this->bind(':number', 'Liczba gości '.$post['number']);
		$this->execute();
		$this->query('UPDATE visit SET status = 0, ts2 = current_timestamp WHERE id = :id');
		$this->bind(':id', $post['delete']);
		$this->execute();
		$this->query("DELETE FROM zewng.peoplecnt WHERE user_name = :name11 OR user_name = :vcard_id AND quantity = :quantity");
		$this->bind(':name11', $post['name11']);
		$this->bind(':vcard_id', $post['vcard'].' GOSC');
		$this->bind(':quantity', $post['number']);
		$this->execute();
		if($this->lastInsertId()){
			Messages::setMsg('Wizyta zakończona', 'success');
		}
		header('Location: '.ROOT_URL.'visit');
		return;
	}
}
