<?php
class Camera extends Controller{
	protected function Index() {
		$viewmodel = new CameraModel();
		$this->returnView($viewmodel->Index(), true);
	}

	protected function add() {
		$viewmodel = new CameraModel();
		$this->returnView($viewmodel->add(), true);
	}

	protected function update() {
		$viewmodel = new CameraModel();
		$this->returnView($viewmodel->update(), false);
	}

	protected function people(){
		$viewmodel = new CameraModel();
		$this->returnView($viewmodel->people(), false);
	}

	protected function delete() {
		$viewmodel = new CameraModel();
		$this->returnView($viewmodel->delete(), false);
	}
}
