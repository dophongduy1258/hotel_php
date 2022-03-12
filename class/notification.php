<?php
class notification extends model {
	
	protected $class_name = 'notification';

	protected $id;
	protected $subject;
	protected $content;
	protected $to;
	protected $read_status;
	protected $force_read;
	protected $created_at;
	protected $created_by;
	protected $deleted;//delete_user_id;delete_user_id;
	protected $regarding_product_id;
	
	public function add(){
		global $db;
		
		$arr['subject'] 	= $this->get('subject');
		$arr['content'] 	= $this->get('content');
		$arr['to'] 			= $this->get('to').'';
		$arr['read_status']	= $this->get('read_status').'';
		$arr['force_read'] 	= $this->get('force_read')+0;
		$arr['deleted'] 	= '';
		$arr['created_at'] 	= time();
		$arr['created_by'] 	= $this->get('created_by');
		$arr['regarding_product_id'] 	= $this->get('regarding_product_id')+0;
		
		$db->record_insert( $db->tbl_fix.'`'.$this->class_name.'`', $arr );
		return $db->mysqli_insert_id();
	}
	
	public function update(){
		global $db;
		$id = $this->get('id');
		
		$arr['subject'] 	= $this->get('subject');
		$arr['content'] 	= $this->get('content');
		$arr['to'] 			= $this->get('to');
		$arr['read_status'] = $this->get('read_status').'';
		$arr['force_read'] 	= $this->get('force_read')+0;
		
		$db->record_update( $db->tbl_fix.'`'.$this->class_name.'`', $arr, " `id` = '$id' " );
		return true;
	}

	public function update_read(){
		global $db;
		$id = $this->get('id');
		
		$arr['read_status'] = $this->get('read_status');
				
		$db->record_update( $db->tbl_fix.'`'.$this->class_name.'`', $arr, " `id` = '$id' " );
		return true;
	}
	
	public function list_all_by_user( $ofset = 0, $limit = '' ) {
		global $db;

		if( $limit != '' ) $limit = " LIMIT $ofset, $limit ";
		
		$to = $this->get('to');
		
		$sql = "SELECT *
				FROM `". $this->class_name ."`
				WHERE (`to` LIKE '%".$to.";%' OR `to` = '".$to."') AND `deleted` NOT LIKE '%".$to.";%'
				ORDER BY `id` DESC
				$limit";

		$result = $db->executeQuery( $sql );
		$kq = array();
		while($row = mysqli_fetch_assoc( $result )){
			$row['read_status'] = strpos($row['read_status'], $to.';') !== false ? '1':'0';
			// $row['content']	= str_replace('  ', '', strip_tags($row['content']));
			$kq[] = $row;
		}

		return $kq;
	}

	public function list_all_by_user_count() {
		global $db;
		
		$to = $this->get('to');
		
		$sql = "SELECT COUNT(*) as total
				FROM `". $this->class_name ."`
				WHERE ( `to` LIKE '%".$to.";%' OR `to` = '".$to."' ) AND `deleted` NOT LIKE '%".$to.";%' ";
				
		$result = $db->executeQuery( $sql, 1 );
		
		return $result['total']+0;
	}

	public function count_un_read( $to = '' ) {
		global $db;
		
		if( $to != '' ){
			$sql = "SELECT COUNT(*) as total
					FROM `". $this->class_name ."`
					WHERE `to` LIKE '%".$to.";%' AND `read_status` NOT LIKE '%".$to.";%' AND `deleted` NOT LIKE '%".$to.";%' ";
					
			$result = $db->executeQuery( $sql, 1 );
			
			return $result['total']+0;
		}else{
			return 0;
		}
	}

	public function delete_notification( $to = '' ) {
		global $db;
		
		$id = $this->get('id');

		$dNoti = $this->get_detail();
		
		$arr['deleted'] = $dNoti['deleted'].$to.';';
		
		$db->record_update( $db->tbl_fix.'`'.$this->class_name.'`', $arr, " `id` = '$id' " );

		unset( $arr );
		unset( $dNoti );
		
		return true;

	}

	public function list_all_by( $ofset = 0, $limit = '' ) {
		global $db;

		if( $limit != '' ) $limit = " LIMIT $ofset, $limit ";
		
		$sql = "SELECT * FROM `". $this->class_name ."` ORDER BY `id` DESC $limit ";

		$result = $db->executeQuery_list( $sql );

		return $result;
	}

	public function list_all_by_count() {
		global $db;

		$sql = "SELECT COUNT(*) total FROM `". $this->class_name ."` ";

		$result = $db->executeQuery( $sql, 1 );

		return $result['total']+0;
	}
	
}
$notification = new notification();