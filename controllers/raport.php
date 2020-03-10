<?php
class Raport extends Controller{
	protected function Index(){
		if(!isset($_SESSION['user_data']['level']) || $_SESSION['user_data']['level'] < ADMIN_LEVEL){return header('Location: '.ROOT_URL.FORBIDDEN_PATH);}
		$viewmodel = new RaportModel();
		$this->returnView($viewmodel->Index(), true);
	}

	protected function download(){
		if(!isset($_SESSION['user_data']['level']) || $_SESSION['user_data']['level'] < ADMIN_LEVEL){return header('Location: '.ROOT_URL.FORBIDDEN_PATH);}
		$viewmodel = new RaportModel();
		$this->returnView($viewmodel->download(), false);
	}

	protected function people(){
		if(!isset($_SESSION['user_data']['level']) || $_SESSION['user_data']['level'] < ADMIN_LEVEL){return header('Location: '.ROOT_URL.FORBIDDEN_PATH);}
		$viewmodel = new RaportModel();
		$this->returnView($viewmodel->people(), false);
	}
}
