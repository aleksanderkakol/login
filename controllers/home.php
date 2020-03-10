<?php
class Home extends Controller{
	protected function Index(){
		if(isset($_SESSION['is_logged_in'])){return header('Location: '.ROOT_URL.'login');}
		$viewmodel = new HomeModel();
		$this->returnView($viewmodel->Index(), true);
	}
}
