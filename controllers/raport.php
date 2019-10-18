<?php
class Raport extends Controller{
	protected function Index(){
		if(!isset($_SESSION['user_data']['level']) || $_SESSION['user_data']['level'] < ADMIN_LEVEL){return http_response_code(403);}
		$viewmodel = new RaportModel();
		$this->returnView($viewmodel->Index(), true);
	}

	protected function download(){
		if(!isset($_SESSION['user_data']['level']) || $_SESSION['user_data']['level'] < ADMIN_LEVEL){return http_response_code(403);}
		$viewmodel = new RaportModel();
		$this->returnView($viewmodel->download(), false);
	}

	protected function people(){
		if(!isset($_SESSION['user_data']['level']) || $_SESSION['user_data']['level'] < ADMIN_LEVEL){return http_response_code(403);}
		$viewmodel = new RaportModel();
		$this->returnView($viewmodel->people(), false);
	}

	protected function doors(){
		if(!isset($_SESSION['user_data']['level']) || $_SESSION['user_data']['level'] < ADMIN_LEVEL){return http_response_code(403);}
		$viewmodel = new RaportModel();
		$this->returnView($viewmodel->doors(), false);
	}
}
