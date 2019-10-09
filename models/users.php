<?php
class UserModel extends Model{
	public function Index(){
		$this->query('SELECT * FROM opr ORDER BY opr_level');
		$rows = $this->resultSet();
		return $rows;
	}

	public function level(){
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		$this->query('UPDATE opr SET opr_level = :opr_level WHERE opr_id = :opr_id');
		$this->bind(':opr_id', $post['opr_id']);
		$this->bind(':opr_level', $post['opr_level']);
		$result = $this->execute();
		print_r(json_encode($result));
		return;
	}

	public function password(){
		$opr_id = $_SESSION['user_data']['id'];
		$opr_login = $_SESSION['user_data']['login'];
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		$password = md5($post['opr_password']);
		$new_password = md5($post['new_password']);
		$confirm_password = md5($post['confirm_password']);
		if($post['submit']){
			$this->query("SELECT * FROM zewng.opr WHERE opr_id = :opr_id AND opr_login = '$opr_login'");
			$this->bind(':opr_id', $opr_id);
			$result = $this->single();
			$old_password = $result['opr_pwd'];
			if($post['opr_password'] == '' || $post['new_password'] == '' || $post['confirm_password'] == ''){
				Messages::setMsg('Proszę wypełnić wszystkie pola', 'error');
				return;
			} else if($post['new_password'] != $post['confirm_password']){
				Messages::setMsg('Hasła nie są identyczne', 'error');
				return;
			} else if($password!=$old_password){
				Messages::setMsg('Hasło jest nie prawidłowe', 'error');
				return;
			} else if($post['opr_password'] && $post['new_password'] && $post['confirm_password'] && $password == $old_password && $new_password == $confirm_password){
				Messages::setMsg('Hasło użytkownika '.$_SESSION['user_data']['login'].' zostało zmienione', 'success');			
			} else {
				Messages::setMsg('Błąd', 'error');
				return;
			}
			$this->query("UPDATE zewng.opr SET opr_pwd = :opr_pwd WHERE opr_id = :opr_id AND opr_login = :opr_login");
			$this->bind(':opr_pwd', $new_password);
			$this->bind(':opr_id', $opr_id);
			$this->bind(':opr_login', $opr_login);
			$this->execute();
			header('Location: '.ROOT_URL.'logout');
		}
	}

	public function register(){
		// Sanitize POST
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		$password = md5($post['opr_password']);

		if($post['submit']){
			if($post['opr_name'] == '' || $post['opr_level'] == '' || $post['opr_password'] == '' || $post['confirm_password'] == ''){
				Messages::setMsg('Proszę wypełnij wszystkie pola', 'error');
				return;
			} else if($post['opr_password'] != $post['confirm_password']){
				Messages::setMsg('Hasła nie są identyczne', 'error');
				return;
			}else {
				Messages::setMsg('Dodano nowego użytkownika', 'success');
			}
			// Insert into SQL
			$this->query('INSERT INTO opr(opr_login, opr_pwd, opr_level) VALUES(:name, :password, :level)');
			$this->bind(':name', $post['opr_name']);
			$this->bind(':password', $password);
			$this->bind(':level', $post['opr_level']);
			$this->execute();
			// Verify
			if($this->lastInsertId()){
				// header('Location: '.ROOT_URL.'users');
			}
		}
		return;
	}
	public function delete(){
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		Messages::setMsg('Użytkownik '.$post['opr_login'].' został usunięty', 'success');
		$this->query("DELETE FROM zewng.opr WHERE opr_id = :opr_id");
		$this->bind(':opr_id', $post['yes']);
		$this->execute();
		header('Location: '.ROOT_URL.'users');
		return;
	}
}
