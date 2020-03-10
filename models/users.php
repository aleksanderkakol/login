<?php
class UserModel extends Model{
	public function Index(){
		$this->query("SELECT * FROM opr WHERE opr_isdel = 'false' ORDER BY opr_id");
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
		$opr_id = $_GET['id'];
		$this->query("SELECT * FROM zewng.opr WHERE opr_id = :opr_id");
		$this->bind(':opr_id', $opr_id);
		$result = $this->single();
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		if($post['submit']){
			$new_password = md5($post['new_password']);
			$confirm_password = md5($post['confirm_password']);
			if($post['new_password'] == '' || $post['confirm_password'] == ''){
				Messages::setMsg('Proszę wypełnić wszystkie pola', 'error');
				return;
			} else if($post['new_password'] != $post['confirm_password']){
				Messages::setMsg('Hasła nie są identyczne', 'error');
				return;
			} else if($post['new_password'] && $post['confirm_password'] && $new_password == $confirm_password){
				$this->query("UPDATE zewng.opr SET opr_pwd = :opr_pwd WHERE opr_id = :opr_id");
				$this->bind(':opr_pwd', $new_password);
				$this->bind(':opr_id', $opr_id);
				$this->rowCount();
				if($this->rowCount()){
					Messages::setMsg('Hasło użytkownika '.$result['opr_login'].' zostało zmienione', 'success');
					if($result['opr_login']==$_SESSION['user_data']['login']) {
						header('Location: '.ROOT_URL.'logout');
					} 
				}
			}
		}
		return $result;
	}

	public function register(){
		if(!isset($_SESSION['user_data']['level']) || $_SESSION['user_data']['level'] < ADMIN_LEVEL){return header('Location: '.ROOT_URL);}
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
			}
			// Insert into SQL
			$this->query('INSERT INTO opr(opr_login, opr_pwd, opr_level) VALUES(:name, :password, :level)');
			$this->bind(':name', $post['opr_name']);
			$this->bind(':password', $password);
			$this->bind(':level', $post['opr_level']);
			$this->execute();
			// Verify
			if($this->lastInsertId()){
				Messages::setMsg('Dodano nowego użytkownika', 'success');
			}
		}
		return;
	}
	public function delete(){
		if($_SESSION['user_data']['level'] < ADMIN_LEVEL){return header('Location: '.ROOT_URL);}
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		$this->query("UPDATE zewng.opr SET opr_isdel = true WHERE opr_id = :opr_id");
		$this->bind(':opr_id', $post['yes']);
		$this->rowCount();
		if($this->rowCount()){
			Messages::setMsg('Użytkownik '.$post['opr_login'].' został usunięty', 'success');
		}
		header('Location: '.ROOT_URL.'users');
		return;
	}
}
