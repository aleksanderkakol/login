<?php
class HomeModel extends Model{
	public function Index() {
		// Sanitize POST
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		$password = md5($post['opr_password']);

		if($post['submit']){
			// COMPARE SQL
			$this->query('SELECT * FROM opr WHERE opr_login = :name AND opr_pwd = :password AND opr_isdel = false');
			$this->bind(':name', $post['opr_name']);
			$this->bind(':password', $password);
			$row = $this->single();

			if($row) {
				// if($ip === $ip_backup && $row['opr_level'] >= ADMIN_LEVEL) {
					// header('Location: '.ROOT_URL.'ping.php');
					// $cmd='C:\Server\test.exe"';function execInBackground($cmd){if(substr(php_uname(),0,7)=="Windows"){pclose(popen("start /B ".$cmd,"r"));}else{exec($cmd." > /dev/null &");}}execInBackground($cmd);
					// return;
				// } else if($ip === $ip_backup && $row['opr_level'] < ADMIN_LEVEL) {
					// session_destroy();
					// Messages::setMsg('Serwer nie działa, sprawdź połączenie', 'error');
					// return;
				// }
				$this->query("UPDATE opr SET opr_status = true WHERE opr_login = :opr_login AND opr_id = :opr_id");
				$this->bind(':opr_login', $row['opr_login']);
				$this->bind(':opr_id', $row['opr_id']);
				$this->execute();

				$_SESSION['is_logged_in'] = true;
				$_SESSION['user_data'] = array(
					"id" => $row['opr_id'],
					"login" => $row['opr_login'],
					"level" => $row['opr_level']
				);
				// Redirect
				session_write_close();
				header('Location: '.ROOT_URL.'login');
			} else {
				Messages::setMsg('Nieprawidłowy login lub hasło', 'error');
			}
		}
		return;
	}
}
