<?php
class UserModel extends Model{
	public function register(){
		// Sanitize POST
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

		$password = md5($post['opr_password']);

		if($post['submit']){
					if($post['opr_name'] == '' || $post['opr_level'] == '' || $post['opr_password'] == ''){
						Messages::setMsg('Please Fill In All Fields', 'error');
						return;
					}
			// Insert into SQL
			$this->query('INSERT INTO opr(opr_login, opr_pwd, opr_level) VALUES(:name, :password, :level)');
			$this->bind(':name', $post['opr_name']);
			$this->bind(':password', $password);
			$this->bind(':level', $post['opr_level']);
			$this->execute();
			// Verify
			if($this->lastInsertId()){
			}
		}
		return;
	}

	public function login() {
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
}
