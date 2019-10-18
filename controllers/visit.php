<?php
class Visit extends Controller{
	protected function Index(){
		$viewmodel = new VisitModel();
		$this->returnView($viewmodel->Index(), true);
	}

	protected function add(){
		if(!isset($_SESSION['is_logged_in'])) {
			header("Location: ".ROOT_URL.'visit');
		}
		$viewmodel = new VisitModel();
		$this->returnView($viewmodel->add(), true);
	}

	protected function history(){
		$viewmodel = new VisitModel();
		$this->returnView($viewmodel->history(), true);
	}

	protected function people(){
		if(!isset($_SESSION['user_data']['level']) || $_SESSION['user_data']['level'] < ADMIN_LEVEL){return http_response_code(403);}
		$viewmodel = new VisitModel();
		$this->returnView($viewmodel->people(), false);
	}

	protected function option(){
		$viewmodel = new VisitModel();
		$this->returnView($viewmodel->getUnUsedVisitorCards(), false);
	}

	protected function delete(){
		if(!isset($_SESSION['is_logged_in'])) {
			header("Location: ".ROOT_URL.'visit');
		}
		$viewmodel = new VisitModel();
		$this->returnView($viewmodel->delete(), false);
	}
}
