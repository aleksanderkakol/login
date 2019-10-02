<?php
class Home extends Controller{
	protected function Index(){
		$viewmodel = new HomeModel();
		$this->returnView($viewmodel->Index(), true);
	}

	protected function Count(){
		$viewmodel = new HomeModel();
		$this->returnView($viewmodel->Count(), false);
	}

	protected function Exe(){
		$viewmodel = new HomeModel();
		$this->returnView($viewmodel->Exe(), false);
	}
}
