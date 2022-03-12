<?php
class log {
	private $id;
	private $user_create;
	private $date_create;
	private $content;
	private $action;
	
	// set value with paramater
	public function set($parameter,$val) {
		if($parameter=='id'){
			$this->id = $val;
		}else if($parameter=='user_create'){
			$this->user_create = $val;
		}else if($parameter=='date_create'){
			$this->date_create = $val;
		}else if($parameter=='content'){
			$this->content = $val;
		}else if($parameter=='action'){
			$this->action = $val;
		}else{
			exit("Lỗi: 001. Tham biến truyền vào cho phương thức log::set không tìm thấy.");
		}
		return true;
	}
	// get value with paramater
	public function get( $parameter ) {
		if($parameter=='id'){
			return $this->id;
		}else if($parameter=='user_create'){
			return $this->user_create;
		}else if($parameter=='date_create'){
			return $this->date_create;
		}else if($parameter=='content'){
			return $this->content;
		}else if($parameter=='action'){
			return $this->action;
		}else{
			exit("Lỗi: 002. Tham biến lấy giá trị cho phương thức log::get không tìm thấy.");
		}
	}

	public function add( $content, $action, $username = '' ){
		global $db;

		$arr['content'] = $content;
		$arr['action'] = $action;
		$arr['user_create'] = $username;

		$arr['date_create'] = time();
		$arr['date_char'] = date("d/m/Y H:i:s");
		
		$db->record_insert( $db->tbl_fix."log", $arr );
		
		return true;
	}
	
}
$log = new log();
