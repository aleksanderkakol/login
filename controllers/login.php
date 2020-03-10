<?php
class Login extends Controller{
	protected function Index(){
		if(!isset($_SESSION['is_logged_in'])) {return header("Location: ".ROOT_URL);}
		if($_SESSION['user_data']['level'] < ADMIN_LEVEL){return header('Location: '.ROOT_URL.'login/user');}
		$viewmodel = new LoginModel();
		$this->returnView($viewmodel->Index(), true);
	}

	protected function User(){
		if(!isset($_SESSION['is_logged_in'])) {return header("Location: ".ROOT_URL);}
		if($_SESSION['user_data']['level'] <= DYSPOZYTOR){return header('Location: '.ROOT_URL.'login/dyspozytor');}
		$viewmodel = new LoginModel();
		$this->returnView($viewmodel->User(), true);
	}

	protected function dyspozytor(){
		if(!isset($_SESSION['is_logged_in'])) {header("Location: ".ROOT_URL);}
		if($_SESSION['user_data']['level'] > DYSPOZYTOR){return header('Location: '.ROOT_URL.'login/user');}
		$viewmodel = new LoginModel();
		$this->returnView($viewmodel->Dyspozytor(), true);
	}
}
