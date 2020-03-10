<?php
class Users extends Controller{
	protected function Index() {
		if(!isset($_SESSION['user_data']['level']) || $_SESSION['user_data']['level'] < ADMIN_LEVEL){return header('Location: '.ROOT_URL.FORBIDDEN_PATH);}
		$viewmodel = new UserModel();
		$this->returnView($viewmodel->Index(), true);
	}

	protected function level() {
		if(!isset($_SESSION['user_data']['level']) || $_SESSION['user_data']['level'] < ADMIN_LEVEL){return http_response_code(403);}
		$user = new UserModel();
		$user->level();
	}

	protected function password() {
		if(!isset($_SESSION['user_data']['level']) || $_SESSION['user_data']['level'] < ADMIN_LEVEL){return header('Location: '.ROOT_URL.FORBIDDEN_PATH);}
		$viewmodel = new UserModel();
		$this->returnView($viewmodel->password(), true);
	}

	protected function register() {
		if(!isset($_SESSION['user_data']['level']) || $_SESSION['user_data']['level'] < ADMIN_LEVEL){return header('Location: '.ROOT_URL.FORBIDDEN_PATH);}
		$viewmodel = new UserModel();
		$this->returnView($viewmodel->register(), true);
	}

	protected function delete() {
		if(!isset($_SESSION['user_data']['level']) || $_SESSION['user_data']['level'] < ADMIN_LEVEL){return http_response_code(403);}
		$user = new UserModel();
		$user->delete();
	}
}
