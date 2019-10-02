<?php
class Raport extends Controller{
	protected function Index(){
		$viewmodel = new RaportModel();
		$this->returnView($viewmodel->Index(), true);
	}

	protected function download(){
		$viewmodel = new RaportModel();
		$this->returnView($viewmodel->download(), false);
	}

	protected function people(){
		$viewmodel = new RaportModel();
		$this->returnView($viewmodel->people(), false);
	}

	protected function doors(){
		$viewmodel = new RaportModel();
		$this->returnView($viewmodel->doors(), false);
	}
}
