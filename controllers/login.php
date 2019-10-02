<?php
class Login extends Controller{
	protected function Index(){
		$viewmodel = new LoginModel();
		$this->returnView($viewmodel->Index(), true);
	}

	protected function getUsers(){
		if(!isset($_SESSION['is_logged_in'])) {
			header("Location: ".ROOT_URL.'login');
		}
		$viewmodel = new LoginModel();
		$this->returnView($viewmodel->getUsers(), false);
	}
}
