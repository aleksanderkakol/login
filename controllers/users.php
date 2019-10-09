<?php
class Users extends Controller{
	protected function Index() {
		$viewmodel = new UserModel();
		$this->returnView($viewmodel->Index(), true);
	}

	protected function level() {
		$viewmodel = new UserModel();
		$this->returnView($viewmodel->level(), false);
	}

	protected function password() {
		$viewmodel = new UserModel();
		$this->returnView($viewmodel->password(), true);
	}

	protected function register() {
		$viewmodel = new UserModel();
		$this->returnView($viewmodel->register(), true);
	}

	protected function delete() {
		$viewmodel = new UserModel();
		$this->returnView($viewmodel->delete(), false);
	}
}
