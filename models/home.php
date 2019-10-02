<?php
class HomeModel extends Model{
	public function Index() {
		// Sanitize POST
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

		$password = md5($post['opr_password']);

		if($post['submit']){
			// COMPARE SQL
			$this->query('SELECT * FROM opr WHERE opr_login = :name AND opr_pwd = :password');
			$this->bind(':name', $post['opr_name']);
			$this->bind(':password', $password);

			$row = $this->single();

			if($row) {
				$_SESSION['is_logged_in'] = true;
				$_SESSION['user_data'] = array(
					"id" => $row['opr_id'],
					"login" => $row['opr_login']
				);
				// Redirect
				header('Location: '.ROOT_URL.'login');
			} else {
				Messages::setMsg('Incorrect Login', 'error');
			}
		}
		return;
	}

	public function Count() {
    $this->query('SELECT SUM(quantity) FROM peoplecnt WHERE user_type = 0');
	$row = $this->single();
	echo json_encode($row['sum']);
	return $row;
  }
	public function Exe() {
		$cmd = 'C:\zewng\monitoring\"ZewNG Monitoring.exe"';
		if (substr(php_uname(), 0, 7) == "Windows"){
			pclose(popen("start /B ". $cmd, "r"));
		}
		else {
			exec($cmd . " > /dev/null &");
		}
		echo json_encode('Zew open');
		return;
	}
}
