<?php
class PhotoModel extends Model{
	public function Index(){
		$images = array();
		if(!isset($_SESSION['is_logged_in'])) {return header('Location: '.ROOT_URL);}
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		$password = md5($post['user_password']);
		if($post['submit']){
			$this->query('SELECT * FROM opr WHERE opr_login = :name AND opr_pwd = :password AND opr_isdel = false');
			$this->bind(':name', $_SESSION['user_data']['login']);
			$this->bind(':password', $password);
			$row = $this->single();
			if($row>=1) {				
				$this->query('INSERT INTO zewng.evt(evt_pnl_id,evt_evd_id,evt_salto_ts,evt_salto_is_exit, evt_salto_user_type, evt_salto_user_name, evt_salto_door_name) values(1,500,current_timestamp,false, :user_type, :opr_login, :door_name)');
				$this->bind(':user_type', 5);
				$this->bind(':opr_login', $row['opr_login']);
				$this->bind(':door_name', "");
				$this->execute();
				$directory = "upload";
				$images = glob($directory . "/*.jpg");
				
				
				if(isset($_GET['name']) && $_GET['name']!=''){
					return $this->search($images);
				}
				if(isset($_GET['page']) && $_GET['page']!=''){
					return $this->pagination($images);
				}
				
				return $images;
			} else {
				Messages::setMsg('Nieprawidłowe hasło!', 'error');
			}
		}
		return $images;
	}

	private function search($array){
		$names = str_replace("upload/","",$array);
		$names = preg_replace("/\..*/","",$names);
		$searching = $_GET['name'];
		$searching = strtolower($searching);
		$result = array();
		foreach($names as $key => $item){
			$item = strtolower($item);
			if(strpos($item, $searching)!==false){
				array_push($result,$array[$key]);
				$search_result = array(
					"images" => $result,
					"pages" => 0
				);
			}
		}
		
		return $search_result;
	}

	private function pagination($array){
		$items_on_page = 30;
		$end = $_GET['page']*$items_on_page;
		$start = $_GET['page']*$items_on_page-$items_on_page;
		if(count($array) > $items_on_page) {
			$pages = count($array)/$items_on_page;
			$images_per_page = array();
			$pages = ceil($pages);
			
			for($i=$start;$i<$end;$i++) {
				if (isset($array[$i])){
					array_push($images_per_page,$array[$i]);
				}
			}

			$page = $_GET["page"];
			$prev = $page - 1;
			$next = $page + 1;
			if($prev < 1) {
				$prev = 1;
			}
			if($next > $pages){
				$next = $pages;
			}
			
			$result = array(
				"images" => $images_per_page,
				"pages" => $pages,
				"prev" => $prev,
				"next" => $next
			);
			// return $images_per_page;

			return $result;
		} else {
			$images_on_page = array();
			for($i=0;$i<count($array);$i++) {
				if (isset($array[$i])){
					array_push($images_on_page,$array[$i]);
				}
			}
			$page = $_GET["page"];
			$pages = 1;
			$prev = $page - 1;
			$next = $page + 1;
			$result = array(
				"images" => $images_on_page,
				"pages" => $pages,
				"prev" => $prev,
				"next" => $next
			);
			// return $images_per_page;

			return $result;
		
		}
	}
}
