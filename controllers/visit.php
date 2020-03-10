<?php
class Visit extends Controller{
	protected function Index(){
		if(!isset($_SESSION['is_logged_in'])) {return header("Location: ".ROOT_URL);}
		$viewmodel = new VisitModel();
		$this->returnView($viewmodel->Index(), true);
	}

	protected function Date(){
		if(!isset($_SESSION['is_logged_in'])) {return http_response_code(403);}
		$visitor = new VisitModel();
		$visitor->date();
	}

	protected function add(){
		if(!isset($_SESSION['is_logged_in'])) {return header("Location: ".ROOT_URL);}
		$viewmodel = new VisitModel();
		$this->returnView($viewmodel->add(), true);
	}

	protected function history(){
		if(!isset($_SESSION['is_logged_in'])) {return header("Location: ".ROOT_URL);}
		$viewmodel = new VisitModel();
		$this->returnView($viewmodel->history(), true);
	}

	protected function option(){
		if(!isset($_SESSION['is_logged_in'])) {return http_response_code(403);}
		$visitor = new VisitModel();
		$visitor->getUnUsedVisitorCards();
	}

	protected function delete(){
		if(!isset($_SESSION['is_logged_in'])) {return http_response_code(403);}
		$visitor = new VisitModel();
		$visitor->delete();
	}
}
