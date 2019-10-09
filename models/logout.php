<?php
class LogoutModel extends Model{
	public function Index(){
		$this->query("UPDATE opr SET opr_status = false WHERE opr_login = :opr_login AND opr_id = :opr_id");
		$this->bind(':opr_login', $_SESSION['user_data']['login']);
		$this->bind(':opr_id', $_SESSION['user_data']['id']);
		$this->execute();
		return;
	}
}
