<?php
class Camera extends Controller{
	protected function Index() {
		if(!isset($_SESSION['user_data']['level'])){
			return header('Location: '.ROOT_URL.FORBIDDEN_PATH);
		} else if ($_SESSION['user_data']['level'] < ADMIN_LEVEL){
			return header('Location: '.ROOT_URL.'camera\list');}
		$viewmodel = new CameraModel();
		$this->returnView($viewmodel->Index(), true);
	}

	protected function List() {
		if(!isset($_SESSION['user_data']['level'])){return header('Location: '.ROOT_URL.FORBIDDEN_PATH);}
		$viewmodel = new CameraModel();
		$this->returnView($viewmodel->list(), true);
	}

	protected function add() {
		if(!isset($_SESSION['user_data']['level']) || $_SESSION['user_data']['level'] < ADMIN_LEVEL){return header('Location: '.ROOT_URL.FORBIDDEN_PATH);}
		$viewmodel = new CameraModel();
		$this->returnView($viewmodel->add(), true);
	}

	protected function update() {
		if(!isset($_SESSION['user_data']['level']) || $_SESSION['user_data']['level'] < ADMIN_LEVEL){return http_response_code(403);}
		$lpr = new CameraModel();
		$lpr->update();
	}

	protected function delete() {
		if(!isset($_SESSION['user_data']['level']) || $_SESSION['user_data']['level'] < ADMIN_LEVEL){return http_response_code(403);}
		$lpr = new CameraModel();
		$lpr->delete();
	}
}
