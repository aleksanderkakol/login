<?php
class LoginModel extends Model{
	public function Index(){
		return;
	}

	public function getUsers(){
		$this->query('SELECT * FROM peoplecnt WHERE user_type = 0');
		$rows = $this->resultSet();
		return $rows;
	}
}
