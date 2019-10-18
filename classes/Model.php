<?php
abstract class Model{
	protected $dbh;
	protected $stmt;

	public function __construct(){
		global $ip;
		$this->dbh = new PDO("pgsql:host=".$ip.";port=".DB_PORT.";dbname=".DB_NAME, DB_USER, DB_PASS);
	}

	public function query($query){
		$this->stmt = $this->dbh->prepare($query);
	}

	//Binds the prep statement
	public function bind($param, $value, $type = null){
 		if (is_null($type)) {
  			switch (true) {
    			case is_int($value):
      				$type = PDO::PARAM_INT;
      				break;
    			case is_bool($value):
      				$type = PDO::PARAM_BOOL;
      				break;
    			case is_null($value):
      				$type = PDO::PARAM_NULL;
      				break;
    				default:
      				$type = PDO::PARAM_STR;
  			}
		}
		$this->stmt->bindValue($param, $value, $type);
	}

	public function execute(){
		$this->stmt->execute();
		$error = $this->stmt->errorInfo();
		$errorInfo = strstr($error[2], 'LINE', true);
		if($error[2]) {
			Messages::setMsg($errorInfo, 'error');
		}
	}

	public function resultSet(){
		$this->execute();
		$error = $this->stmt->errorInfo();
		$errorInfo = strstr($error[2], 'LINE', true);
		if($error[2]) {
			Messages::setMsg($errorInfo, 'error');
		}
		return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function lastInsertId(){
		$error = $this->stmt->errorInfo();
		$errorInfo = strstr($error[2], 'LINE', true);
		if($error[2]) {
			Messages::setMsg($errorInfo, 'error');
		}
		return $this->dbh->lastInsertId();
	}

	public function single(){
		$this->execute();
		$error = $this->stmt->errorInfo();
		$errorInfo = strstr($error[2], 'LINE', true);
		if($error[2]) {
			Messages::setMsg($errorInfo, 'error');
		}
		return $this->stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function rowCount() {
		$this->execute();
		$error = $this->stmt->errorInfo();
		$errorInfo = strstr($error[2], 'LINE', true);
		if($error[2]) {
			Messages::setMsg($errorInfo, 'error');
		}
		return $this->stmt->rowCount();
	}

	public function __destruct(){
		$this->dbh = null;
	}

}
