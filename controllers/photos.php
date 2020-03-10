<?php
class Photos extends Controller{
	protected function Index() {
		if(!isset($_SESSION['user_data']['level']) || $_SESSION['user_data']['level'] <= DYSPOZYTOR){return header('Location: '.ROOT_URL.FORBIDDEN_PATH);}
		$viewmodel = new PhotoModel();
		$this->returnView($viewmodel->Index(), true);
	}
}
