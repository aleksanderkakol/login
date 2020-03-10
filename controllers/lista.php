<?php
class Lista extends Controller{
	protected function Index(){
		if(!isset($_SESSION['is_logged_in'])) {return header("Location: ".ROOT_URL);}
		$viewmodel = new ListaModel();
		$this->returnView($viewmodel->Index(), true);
	}
}