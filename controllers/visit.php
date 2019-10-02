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
