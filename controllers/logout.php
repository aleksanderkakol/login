<?php
class Logout extends Controller{
	protected function Index(){
		$viewmodel = new LogoutModel();
		$this->returnView($viewmodel->Index(), false);
		unset($_SESSION['is_logged_in']);
		unset($_SESSION['user_data']);
		session_destroy();
		header("Location: ".ROOT_URL);
	}
}
