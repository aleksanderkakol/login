<?php
class Ajax extends Controller{
	protected function Index(){
		if(isset($_SESSION['is_logged_in'])){return header('Location: '.ROOT_URL.'login');}
		// $viewmodel = new HomeModel();
        // $this->returnView($viewmodel->Index(), true);
        $this->executeAction();
	}
	
	protected function lista(){
		if(!isset($_SESSION['is_logged_in'])){return http_response_code(403);}
		$ajax = new AjaxModel();
		return $ajax->lista();
	}
    
    protected function Count(){
		$ajax = new AjaxModel();
		return $ajax->Count();
	}

	protected function people(){
		if(!isset($_SESSION['is_logged_in'])){return http_response_code(403);}
		$ajax = new AjaxModel();
		return $ajax->people();
	}

	protected function doors(){
		if(!isset($_SESSION['is_logged_in'])){return http_response_code(403);}
		$ajax = new AjaxModel();
		return $ajax->doors();
	}
}
