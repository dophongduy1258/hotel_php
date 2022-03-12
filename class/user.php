<?php
class user extends model {

	protected $class_name = 'user';
	protected $id;
	protected $gid;
	protected $password;
	protected $salt;
	protected $mobile;
	protected $email;
	protected $address;
	protected $note;
	protected $status;
	protected $lang;
	protected $fullname;
	protected $sex;
	protected $day;
	protected $month;
	protected $year;
	protected $avatar;
	protected $last_login_at;
	protected $permission;
	protected $created_at;

	public function add(){
		global $db;
		
		$arr['gid'] 		= $this->get('gid');
		$salt 				= $this->randString(10);
		$password 			= $this->get('password');
		$pass 				= md5(md5($password).$salt);
		$arr['password'] 	= $pass;
		$arr['salt'] 		= $salt;

		$arr['mobile'] 		= $this->get('mobile');
		$arr['address'] 	= $this->get('address');
		$arr['email'] 		= $this->get('email');
		$arr['note'] 		= $this->get('note');
		$arr['status'] 		= 'Active';
		$arr['lang'] 		= 'vi';
		$arr['fullname'] 	= $this->get('fullname');
		$arr['sex'] 		= $this->get('sex')+0;
		$arr['day'] 		= date('d');
		$arr['month'] 		= date('m');
		$arr['year'] 		= date('Y');
		$arr['avatar'] 		= $this->get('avatar');
		$arr['permission'] 	= $this->get('permission').'';
		$arr['last_login_at'] = 0;
		$arr['created_at'] 	=  time();
		
		$db->record_insert( $db->tbl_fix.'`user`', $arr );
		
		return $db->mysqli_insert_id();
	}

	public function update(){
		global $db;
				
		$id = $this->get('id');

		$arr['gid'] 		= $this->get('gid');
		$password 			= $this->get('password');

		if( $password != '' ){
			$salt 				= $this->randString(10);
			$pass 				= md5(md5($password).$salt);
			$arr['password'] 	= $pass;
			$arr['salt'] 		= $salt;
		}
		
		$arr['mobile'] 		= $this->get('mobile');
		$arr['address'] 	= $this->get('address');
		$arr['email'] 		= $this->get('email');
		$arr['fullname'] 	= $this->get('fullname');
		$arr['avatar'] 		= $this->get('avatar');
		$arr['permission'] 	= $this->get('permission').'';

		$db->record_update( $db->tbl_fix.'`user`', $arr, " `id` = '$id' " );
		unset( $arr );

		return true;
	}

	public function check_login() {
		global $db;
		
		$id = $this->get('id');
		$password = $this->get('password');
		
		$rows = array();
		$id = str_replace(' ', '_', $id );
		$id = str_replace('#', '_', $id );
		$id = str_replace('/', '_', $id );
		$id = str_replace('\\', '_', $id );

		$sql = "SELECT * FROM " . $db->tbl_fix . "`user` WHERE `password` = '$password' AND `status`='Active' AND `id` = '$id' limit 0,1";
		$rows = $db->executeQuery ( $sql, 1 );
		
		return $rows;
	}

	public function get_fullname() {
		global $db;
		
		$id = $this->get('id');
		
		$sql = "SELECT `fullname` FROM " . $db->tbl_fix . "`user` WHERE `id` = '$id' LIMIT 1";
		$rows = $db->executeQuery ( $sql, 1 );
		
		return $rows['fullname'];
	}
	
	//get username width deactive status
	public function check_deactive() {
		global $db;
		
		$mobile = $this->get('mobile');
		$password = $this->get('password');
		
		$rows = array();
		$mobile = str_replace(' ', '_', $mobile );
		$mobile = str_replace('#', '_', $mobile );
		$mobile = str_replace('/', '_', $mobile );
		$mobile = str_replace('\\', '_', $mobile );
		
		if( preg_match('/^[ \w]+$/',  $mobile ) ){

			$sql = "SELECT * FROM " . $db->tbl_fix . "`user` WHERE (`mobile` = '$mobile' OR `email` = '$mobile') AND `password` = '$password' AND `status`= 'Deactive' limit 0,1";

			$rows = $db->executeQuery ( $sql, 1 );
			
		}
		
		return $rows;
	}
	
	public function get_salt_by_user(){
		global $db, $main;
		
		$email = $this->get('email');
		$mobile = $this->get('mobile');
		
		$rows = array();
		
		if( preg_match('/^[ \w]+$/',  $email ) || $main->isEmail( $email ) ){

			$sql = "SELECT id,password,salt,status FROM " . $db->tbl_fix . "user WHERE `email`='$email' OR `mobile`='$mobile' LIMIT 1";

			$rows = $db->executeQuery ( $sql, 1 );
			if( isset($rows['id']) ){
				return $rows;
			}else{
				$sql = "SELECT id,password,salt,status FROM " . $db->tbl_fix . "user WHERE `username`='$email'  LIMIT 1";
				$rows = $db->executeQuery ( $sql, 1 );
				return $rows;
			}
			
		}

		return $rows;
	}

	public function get_by_email_or_mobile(){
		global $db, $main;

		$email = $this->get('email');
		
		$email = str_replace(' ', '_', $email );
		$email = str_replace('#', '_', $email );
		$email = str_replace('/', '_', $email );
		$email = str_replace('\\', '_', $email );

		$rows = array();
		if( preg_match('/^[ \w]+$/',  $email ) || $main->isEmail( $email ) ){

			$sql = "SELECT id,password,salt,status,email FROM " . $db->tbl_fix . "`user` WHERE 
					(`email`='$email' OR `mobile`='".$main->only_number($email)."') AND `email` <> '' AND `mobile` <> '' LIMIT 1";
			$rows = $db->executeQuery ( $sql, 1 );
			
		}
		
		return $rows;
	}

	public function update_password() {
		global $db;

		$id 		= $this->get('id');
		$password 	= $this->get('password');
		
		$salt 				= $this->randString(10);
		$pass 				= md5(md5($password).$salt);
		$arr['password'] 	= $pass;
		$arr['salt'] 		= $salt;
		
		$db->record_update( $db->tbl_fix."user", $arr," `id` = '$id' ");
		
		return true;
	}

	public function update_permission_by_gid() {
		global $db;

		$gid 				= $this->get('gid');
		$permission 		= $this->get('permission');
		
		$arr['permission'] 	= $permission;

		$db->record_update( $db->tbl_fix."user", $arr," `gid` = '$gid' ");

		unset( $arr );
		
		return true;
	}

	public function update_new_password() {
		global $db;

		$id = $this->get('id');
		$password = $this->get('password');

		$salt = $this->randString(10);
		$pass = md5(md5($password).$salt);
		$arr['password'] = $pass;
		$arr['salt'] = $salt;
		
		$db->record_update( $db->tbl_fix."user", $arr," `id` = '$id' ");
		
		return true;
	}
	
	public function update_lang(){
		global $db;

		$id = $this->get('id');

		$arr['lang'] = $this->get('lang');
		$db->record_update( $db->tbl_fix."`user`", $arr, " `id` = '$id' ");
		unset($arr);
		
		return true;
	}

	public function update_status($id, $status, $note) {
		global $db;

		$id = $this->get('id');

		$arr['status'] = $this->get('status');
		$arr['note'] = $this->get('note');
		
		$db->record_update( $db->tbl_fix."user", $arr," `id` = '$id' ");

		return false;
	}
		
	public function update_last_login(){
		global $db;
		
		$id = $this->get('id');

		$arr['last_login_at'] = time();
		
		$db->record_update( $db->tbl_fix.'`user`', $arr, " `id` = '$id' " );
		unset( $arr );

		return true;
	}
	
	public function reset_password(){
		global $db;
		
		$id = $this->get('id');
		$password = $this->get('password');

		$salt = $this->randString( 10 );
		$pass = md5(md5($password).$salt);
		$arr['password'] = $pass;
		$arr['salt'] = $salt;
		
		$db->record_update( $db->tbl_fix.'`user`', $arr, " `id`='$id' " );
		return true;
	}

	public function email_exist(){
		global $db;

		$email = $this->get('email');

		$email = str_replace(' ', '_', $email );
		$email = str_replace('#', '_', $email );
		$email = str_replace('/', '_', $email );
		$email = str_replace('\\', '_', $email );

		$sql = "SELECT `id` FROM " . $db->tbl_fix . "`user` WHERE `email` = '$email' AND `email` <> '' ";
		$result = $db->executeQuery( $sql, 1 );

		if( isset($result['id']) )
			return true;
		else
			return false;

	}

	public function get_by_access_key(){
		global $db;

		$access_key = $this->get('access_key');
		$access_key = str_replace(' ', '_', $access_key );
		$access_key = str_replace('#', '_', $access_key );
		$access_key = str_replace('/', '_', $access_key );
		$access_key = str_replace('\\', '_', $access_key );


		$email = $this->get('email');
		$email = str_replace(' ', '_', $email );
		$email = str_replace('#', '_', $email );
		$email = str_replace('/', '_', $email );
		$email = str_replace('\\', '_', $email );

		$sql = "SELECT * FROM " . $db->tbl_fix . "`user` WHERE `access_key` = '$access_key' AND `access_key` <> '' AND `email` <> '' AND `email` = '$email' LIMIT 1";
		return $db->executeQuery( $sql, 1 );
		
	}

	public function getby_emailOrMobile( $email ){
		global $db, $main;
		
		$email = str_replace(' ', '_', $email );
		$email = str_replace('#', '_', $email );
		$email = str_replace('/', '_', $email );
		$email = str_replace('\\', '_', $email );

		$sql = "SELECT * FROM " . $db->tbl_fix . "`user` WHERE ( `email`='" . $email . "' OR `mobile` = '".$main->only_number( $email )."' ) AND `email` <> '' AND `mobile` <> '' LIMIT 1";

		$rows = $db->executeQuery ( $sql, 1 );

		return $rows;
	}

	public function get_by_email(){
		global $db, $main;
		$email = $this->get('email');

		$email = str_replace(' ', '_', $email );
		$email = str_replace('#', '_', $email );
		$email = str_replace('/', '_', $email );
		$email = str_replace('\\', '_', $email );

		$sql = "SELECT * FROM " . $db->tbl_fix . "`user` WHERE `email`='$email' AND `email` <> '' LIMIT 1";

		$rows = $db->executeQuery ( $sql, 1 );

		return $rows;
	}

	public function get_by_mobile(){
		global $db, $main;
		$mobile = $this->get('mobile');

		$mobile = str_replace(' ', '_', $mobile );
		$mobile = str_replace('#', '_', $mobile );
		$mobile = str_replace('/', '_', $mobile );
		$mobile = str_replace('\\', '_', $mobile );

		$sql = "SELECT * FROM " . $db->tbl_fix . "`user` WHERE `mobile` = '".$main->only_number( $mobile )."' AND `mobile` <> '' LIMIT 1";
		
		$rows = $db->executeQuery ( $sql, 1 );

		return $rows;
	}

	public function list_user_searching( $keyword ){
		global $db, $main;
		
		$sql = "SELECT * FROM `user`
				WHERE `first_name` LIKE '%$keyword%' OR `last_name` LIKE '%$keyword%' OR `email` LIKE '%$keyword%'
				OR `mobile` LIKE '%$keyword%'
				ORDER BY `joined_at` DESC
				LIMIT 50";
		
		$result = $db->executeQuery( $sql  );
		$kq = array();
		while ($row = mysqli_fetch_assoc($result) ) {

			$this->set('id', $row['id']);
			$row['level_1'] = $this->count_level_1(  );
			$row['level_2'] = $this->count_level_2();

			$kq[] = $row;
		}
		mysqli_free_result( $result );

		return $kq;
	}

	public function list_user_affiliate_searching( $root_user_id, $keyword ){
		global $db, $main;
		

		$sql = "SELECT * FROM `user`
				WHERE ( `first_name` LIKE '%$keyword%' OR `last_name` LIKE '%$keyword%' OR `email` LIKE '%$keyword%'
				OR `mobile` LIKE '%$keyword%')
				AND (`upline_id` = '$root_user_id' OR `up_upline_id` = '$root_user_id')
				ORDER BY `joined_at` DESC
				LIMIT 50";

		$result = $db->executeQuery( $sql  );
		$kq = array();
		while ($row = mysqli_fetch_assoc($result) ) {

			$this->set('id', $row['id']);
			$row['level_1'] = $this->count_level_1(  );
			$row['level_2'] = $this->count_level_2();

			$kq[] = $row;
		}
		mysqli_free_result( $result );

		return $kq;
	}

	public function list_user( $ofset = 0, $limit = '' ){
		global $db, $main, $combo;

		if( $limit != '' ) $limit = " LIMIT $ofset, $limit ";

		$sql = "SELECT * FROM `user`
				WHERE `gid` <> '0'
				ORDER BY `joined_at` DESC
				$limit";
		$result = $db->executeQuery( $sql  );
		$kq = array();
		while ($row = mysqli_fetch_assoc($result) ) {
			$combo->set('user_id', $row['id']);

			$this->set('id', $row['id']);
			$row['level_1'] = $this->count_level_1(  );
			$row['level_2'] = $this->count_level_2();
			$row['combo'] = $combo->get_all_combo_by_user_id();
			$kq[] = $row;

		}
		mysqli_free_result( $result );

		return $kq;
	}

	public function count_level_1(){
		global $db, $main;
		$id = $this->get('id');

		$sql = "SELECT COUNT(*) as total FROM `user` WHERE `upline_id` = '$id' ";
		$kq = $db->executeQuery( $sql, 1  );

		return $kq['total'] + 0;
	}

	public function count_level_2(){
		global $db, $main;
		$id = $this->get('id');
		
		$sql = "SELECT COUNT(*) as total FROM `user` WHERE `up_upline_id` = '$id' ";
		$kq = $db->executeQuery( $sql, 1  );
		
		return $kq['total'] + 0;
	}

	public function list_user_count(){
		global $db, $main;

		$sql = "SELECT COUNT(*) as total FROM `user` WHERE `gid` <> '0'";

		$kq = $db->executeQuery( $sql, 1  );

		return $kq['total'] + 0;
	}

	public function list_user_affiliate( $root_user_id, $level, $ofset = 0, $limit = '' ){
		global $db, $main;

		if( $limit != '' ) $limit = " LIMIT $ofset, $limit ";

		if( $level == '1' ){
			$level = "AND `upline_id` = '$root_user_id' ";
		}else if( $level == '2' ){
			$level = "AND `up_upline_id` = '$root_user_id' ";
		}else{
			$level = "AND (`up_upline_id` = '$root_user_id' OR `upline_id` = '$root_user_id') ";
		}

		$sql = "SELECT * FROM `user`
				WHERE `gid` <> '0' $level
				ORDER BY `joined_at` DESC
				$limit";
		
		$result = $db->executeQuery( $sql );

		$kq = array();
		while ($row = mysqli_fetch_assoc($result) ) {

			$this->set('id', $row['id']);
			$row['level_1'] = $this->count_level_1(  );
			$row['level_2'] = $this->count_level_2();

			$kq[] = $row;
		}
		mysqli_free_result( $result );

		return $kq;
	}

	public function list_user_affiliate_count( $root_user_id, $level ){
		global $db, $main;

		if( $level == '1' ){
			$level = "AND `upline_id` = '$root_user_id' ";
		}else if( $level == '2' ){
			$level = "AND `up_upline_id` = '$root_user_id' ";
		}else{
			$level = "AND `up_upline_id` = '$root_user_id' AND `up_upline_id` = '$root_user_id' ";
		}

		$sql = "SELECT COUNT(*) as total FROM `user` WHERE `gid` <> '0' $level ";

		$kq = $db->executeQuery( $sql, 1  );

		return $kq['total'] + 0;
	}

	public function mobile_exist(){
		global $db;

		$info = $this->get('mobile');

		$info = str_replace(' ', '_', $info );
		$info = str_replace('#', '_', $info );
		$info = str_replace('/', '_', $info );
		$info = str_replace('\\', '_', $info );

		$sql = "SELECT `id` FROM " . $db->tbl_fix . "`user` WHERE `mobile` = '$info' AND `mobile` <> '' ";

		$result = $db->executeQuery( $sql, 1 );
		if( isset($result['id']) )
			return true;
		else
			return false;
	}

	public function check_token(){
		global $db;

		$token = $this->get('token');

		$sql = "SELECT * FROM " . $db->tbl_fix . "`user` WHERE `token` = '$token' AND `token` <> ''";
		$dUser = $db->executeQuery( $sql, 1 );
		
		return $dUser;
	}

	public function get_report_by( $sex ){
		global $db;

		$joined_month = $this->get('joined_month');
		$joined_year = $this->get('joined_year');

		$sql = "SELECT COUNT(*) total FROM " . $db->tbl_fix . "`user` WHERE `sex` = '$sex' AND `joined_month` = '$joined_month' AND `joined_year` = '$joined_year' ";
		$item = $db->executeQuery( $sql, 1 );
		
		return $item['total']+0;
	}

	public function get_report_chart(){
		$year = date("Y");
		$this->set('joined_year', $year);

		$lable = [];
		$male = [];
		$female = [];

		for( $i = 1; $i < 13; $i++ ){
			$this->set('joined_month', sprintf("%02d",$i) );
			$lable[] = 'Tháng '.$this->get('joined_month');
			$male[] = $this->get_report_by( 1 );
			$female[] = $this->get_report_by( 0 );

		}

		return array(
					'label' => $lable,
					'male' => $male,
					'female' => $female,
					);
	}

	public function update_token(){
		global $db;

		$id = $this->get('id');
		$arr['token'] = $this->get('token');

		$db->record_update('`user`', $arr, " `id` = '$id' ");
		unset($arr);

		return true;
	}
	
	public function randString($length = 10) {
		$characters = 'w01s2345arbctvdeffg1hijklm4nop6789qrstuv3wxyz5AB675839CDEFGHIJ627g184g9gKLMfNdOPsQRSTfUVWgXdYsZ';
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $randomString;
	}
	
	private function covert_expire_date( $value ){
		return 60*86400;
	}

	public function list_all( $keyword = '', $extra = '' ) {
		global $db;

		if( $keyword != '' ) $keyword = " AND ( `email` LIKE '%$keyword%' OR `mobile` LIKE '%$keyword%' ) ";
		
		$sql = "SELECT user.*, `gid`.`name` gid_name
				FROM `". $this->class_name ."`
				INNER JOIN `gid` ON `gid`.id = `user`.gid
				WHERE user.`id` <> 1
				$keyword
				GROUP BY user.`id`
				$limit ";

		$result = $db->executeQuery_list( $sql );

		return $result;
	}
	
}
$user = new user();
