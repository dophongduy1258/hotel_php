<?php
class investor extends model{

    protected $class_name = 'investor';
    protected $id;
    protected $fullname;
    protected $username;
    protected $commission;//float
    protected $parent;
    protected $mobile;
    protected $email;
    protected $diachi;
    protected $beneficiary;
    protected $bankname;
    protected $branch;
    protected $bankaccnum;
    protected $version;
    protected $joined_at;
    protected $last_logined_at;
    protected $sessionToken;
    protected $VND;
    protected $VNDC;
    protected $VSG;
    protected $BRS;

    public function add(){
        global $db, $mlm_detail, $main;

        $arr['id']                  = $this->get('id');
        $arr['sessionToken']        = $this->get('sessionToken');

        $arr['fullname']            = $this->get('fullname');
        $arr['username']            = $this->get('username');
        $arr['commission']          = 0;
        $arr['parent']              = $parent = $this->get('parent');
        $arr['mobile']              = $main->only_number( $this->get('mobile') );
        $arr['email']               = $this->get('email');
        $arr['diachi']              = $this->get('diachi');
        $arr['beneficiary']         = $this->get('beneficiary');
        $arr['bankname']            = $this->get('bankname');
        $arr['branch']              = $this->get('branch');
        $arr['bankaccnum']          = $this->get('bankaccnum');
        $arr['version']             = $this->get('version');
        $arr['joined_at']           = time();
        $arr['last_logined_at']     = time();
        $arr['activate']            = 1;
        
        $db->record_insert( $db->tbl_fix.$this->class_name, $arr );

        if( $arr['parent'] != '' ){
            $this->set('username', $parent);
            $dP = $this->get_by_info();
            if( isset($dP['id']) ){
                $mlm_detail->set('username', $this->get('username'));
                $mlm_detail->set('parent', $dP['username']);
                $mlm_detail->new_username();
            }
        }
        
        return $db->mysqli_insert_id();
    }
    
    public function update(){
        global $db;

        $id                         = $this->get('id');
        $arr['sessionToken']        = $this->get('sessionToken');
        
        $arr['fullname']            = $this->get('fullname');
        $arr['username']            = $this->get('username');
        $arr['mobile']              = $this->get('mobile');
        $arr['email']               = $this->get('email');
        $arr['diachi']              = $this->get('diachi');
        $arr['beneficiary']         = $this->get('beneficiary');
        $arr['bankname']            = $this->get('bankname');
        $arr['branch']              = $this->get('branch');
        $arr['bankaccnum']          = $this->get('bankaccnum');
        $arr['version']             = $this->get('version');
        $arr['last_logined_at']     = time();
        $arr['activate']            = 1;

        $db->record_update( $db->tbl_fix.$this->class_name, $arr, " `id` = '$id' " );
        
        return true;
    }

    public function update_sync_point(){
        global $db;

        $id                         = $this->get('id');
        $arr['VND']            = $this->get('VND');
        $arr['VNDC']                 = $this->get('VNDC');
        $arr['VSG']                 = $this->get('VSG');
        $arr['BRS']                 = $this->get('BRS');

        $db->record_update( $db->tbl_fix.$this->class_name, $arr, " `id` = '$id' " );
        
        return true;
    }

    public function check_sessionToken() {
		global $db;
		
		$sessionToken = $this->get('sessionToken');
		
		$sessionToken = str_replace('\'', '',     $sessionToken );
	    $sessionToken = str_replace(' ', '_',     $sessionToken );
	    $sessionToken = str_replace('#', '_',     $sessionToken );
	    $sessionToken = str_replace('/', '_',     $sessionToken );
	    $sessionToken = str_replace('\\', '_',    $sessionToken );
        
        $sql = "SELECT * FROM " .$db->tbl_fix.$this->class_name . " WHERE `sessionToken` = '$sessionToken' AND `activate`='1' LIMIT 1";
        
		$rows = $db->executeQuery ( $sql, 1 );
		
		return $rows;
    }
    
    public function deactivate(){
        global $db;
        
        $id                         = $this->get('id');

        $arr['activate']              = 0;
        $db->record_update( $db->tbl_fix.$this->class_name, $arr, " `id` = '$id' " );
        
        return true;
    }

    // update commission plus
	public function update_commission_plus() {
        global $db;
        
        $commission     = $this->get('commission');
        $username       = $this->get('username');
		
		$sql = "UPDATE `". $this->class_name ."` SET `commission` = (`commission` + $commission) WHERE `username` = '$username' ";
		$db->executeQuery( $sql );

        return true;
    }

    // update parent
	public function update_parent() {
        global $db;
        
        $username                  = $this->get('username');

        $arr['parent']              = $this->get('parent');
        $db->record_update( $db->tbl_fix.$this->class_name, $arr, " `username` = '$username' " );

        return true;
    }

    // get value with paramater
	public function get_fullname() {
		global $db;
		
		$sql = "SELECT `fullname` FROM `". $this->class_name ."` WHERE `username` = '".$this->get('username')."'";
		$result = $db->executeQuery( $sql, 1);

        if( isset( $result['fullname']) )
            return $result['fullname'];
        
        return '';
    }
    
    // get username parent
	public function get_parent_by_username() {
		global $db;
		
		$sql = "SELECT `parent` FROM `". $this->class_name ."` WHERE `username` = '".$this->get('username')."'";
		$result = $db->executeQuery( $sql, 1);

        if( isset( $result['parent']) )
            return $result['parent'];
        
        return '';
    }

    // get username parent
	public function get_detail_by_username() {
		global $db;
		
		$sql = "SELECT * FROM `". $this->class_name ."` WHERE `username` = '".$this->get('username')."'";
		$d = $db->executeQuery( $sql, 1);
        unset( $d['sessionToken'] );
        
        $this->set('username', $d['parent']);
        $d['parent_fullname'] = $this->get_fullname();

        return $d;
    }

    // get username parent
	public function get_by_info() {
		global $db, $main;
		
		$sql = "SELECT * FROM `". $this->class_name ."` WHERE `username` = '".$this->get('username')."' OR `mobile` = '".$main->only_number( $this->get('username') )."' OR `email` = '".$this->get('username')."' ";
		$d = $db->executeQuery( $sql, 1);
        unset( $d['sessionToken'] );

        return $d;
    }
    
    // get value with paramater
	public function get_transfer_info( $info ) {
		global $db;
		
        $sql = "SELECT `id`, `fullname`, `username`, `activate` FROM `". $this->class_name ."` WHERE `email` = '$info' LIMIT 1";
		$result = $db->executeQuery( $sql, 1);
        
        if( !isset( $result['fullname']) ){
            $sql = "SELECT `id`, `fullname`, `username`, `activate` FROM `". $this->class_name ."` WHERE `mobile` = '$info' LIMIT 1";
            $result = $db->executeQuery( $sql, 1);

            if( !isset( $result['fullname']) ){
                $sql = "SELECT `id`, `fullname`, `username`, `activate` FROM `". $this->class_name ."` WHERE `username` = '$info' LIMIT 1";
                $result = $db->executeQuery( $sql, 1);
            }
            
        }
        return $result;

    }
    
    public function searching( $keyword) {
        global $db;
        
		$sql = "SELECT inve.`fullname`, inve.`mobile`, inve.`username`, inve.`commission`, inve.`parent`
                FROM ".$db->tbl_fix."`". $this->class_name ."` inve
                WHERE (`username` LIKE '%$keyword%' OR `fullname` LIKE '%$keyword%' OR `mobile` LIKE '%$keyword%' OR `email` LIKE '%$keyword%' )
                ORDER BY `fullname`
                LIMIT 10";

        $result = $db->executeQuery( $sql );

        $kq = array();
        while( $row = mysqli_fetch_assoc($result) ){
            $this->set('username', $row['parent']);
            $row['parent_fullname'] = $this->get_fullname();
            $kq[] = $row;
        }
        mysqli_free_result($result);

		return $kq;
    }

    public function list_by( $keyword, $ofset = '', $limit = '' ) {
        global $db;
        
        if( $limit != '' ) $limit = " LIMIT $ofset, $limit ";
        if( $keyword != '' ) $keyword = " AND (`username` LIKE '%$keyword%' OR `fullname` LIKE '%$keyword%' OR `mobile` LIKE '%$keyword%' OR `email` LIKE '%$keyword%' ) ";
        
		$sql = "SELECT *
                FROM ".$db->tbl_fix."`". $this->class_name ."`
                WHERE 
                1
                $keyword
                ORDER BY `fullname`
                $limit";

		$result = $db->executeQuery_list( $sql );

		return $result;
    }
    
     public function list_by_count( $keyword ) {
        global $db;
        
        if( $keyword != '' ) $keyword = " AND (`username` LIKE '%$keyword%' OR `fullname` LIKE '%$keyword%' OR `mobile` LIKE '%$keyword%' OR `email` LIKE '%$keyword%' ) ";
        
		$sql = "SELECT COUNT(*) total
                FROM ".$db->tbl_fix."`". $this->class_name ."`
                WHERE
                1
                $keyword";
        
		$result = $db->executeQuery( $sql, 1 );

		return $result['total']+0;
    }

    public function list_by_sort_point( $keyword, $ofset = '', $limit = '' ) {
        global $db;
        
        if( $limit != '' ) $limit = " LIMIT $ofset, $limit ";
        if( $keyword != '' ) $keyword = " AND (`username` LIKE '%$keyword%' OR `fullname` LIKE '%$keyword%' OR `mobile` LIKE '%$keyword%' OR `email` LIKE '%$keyword%') ";
        
		$sql = "SELECT *
                FROM ".$db->tbl_fix."`". $this->class_name ."`
                WHERE 
                1
                $keyword
                ORDER BY `VND` DESC
                $limit";

		$result = $db->executeQuery_list( $sql );

		return $result;
    }
    public function get_fullname_by_id() {
		global $db;
		
		$sql = "SELECT `fullname` FROM `". $this->class_name ."` WHERE `username` = '".$this->get('id')."'";
		$result = $db->executeQuery( $sql, 1);

        if( isset( $result['fullname']) )
            return $result['fullname'];
        
        return '';
    }
    public function add_sync(){
        global $db, $mlm_detail, $main;

        $arr['id']                  = $this->get('id');

        $arr['fullname']            = $this->get('fullname');
        $arr['username']            = $this->get('username');
        $arr['email']               = $this->get('email');
        $arr['mobile']              = $main->only_number( $this->get('mobile') );

        $arr['diachi']              = $this->get('diachi');
        $arr['beneficiary']         = $this->get('beneficiary');
        $arr['bankname']            = $this->get('bankname');
        $arr['branch']              = $this->get('branch');
        $arr['bankaccnum']          = $this->get('bankaccnum');

        $arr['version']             = '0';
        $arr['joined_at']           = time();
        $arr['last_logined_at']     = time();
        $arr['activate']            = $this->get('activate');
        
        $db->record_insert( $db->tbl_fix.$this->class_name, $arr );
        
        return $db->mysqli_insert_id();
    }
    
    public function update_sync(){
        global $db, $mlm_detail, $main;

        $id                         = $this->get('id');
        
        $arr['fullname']            = $this->get('fullname');
        $arr['username']            = $this->get('username');
        $arr['email']               = $this->get('email');
        $arr['mobile']              = $main->only_number( $this->get('mobile') );
        $arr['diachi']              = $this->get('diachi');
        $arr['beneficiary']         = $this->get('beneficiary');
        $arr['bankname']            = $this->get('bankname');
        $arr['branch']              = $this->get('branch');
        $arr['bankaccnum']          = $this->get('bankaccnum');

        $arr['activate']            = $this->get('activate');

        $db->record_update( $db->tbl_fix.$this->class_name, $arr, " `id` = '$id' " );
        
        return true;
    }
    
}
$investor =  new investor();