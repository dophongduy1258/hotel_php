<?php
class contact extends model{

    protected $class_name = 'contact';
    protected $id;
    protected $investor_id;
    protected $hint;
    protected $username;
    protected $fullname;
    protected $mobile;
    protected $email;

    public function add(){
        global $db;

        $arr['investor_id']     = $this->get('investor_id');
        $arr['hint']            = $this->get('hint');
        $arr['username']        = $this->get('username');
        $arr['fullname']        = $this->get('fullname');
        $arr['mobile']          = $this->get('mobile');
        $arr['email']           = $this->get('email');
        
        $db->record_insert( $db->tbl_fix.$this->class_name, $arr );
        
        return $db->mysqli_insert_id();
    }

    public function update_done(){
        global $db;

        $id = $this->get('id');

        $arr['username']        = $this->get('username');
        $arr['hint']            = $this->get('hint');
        $arr['fullname']        = $this->get('fullname');
        $arr['mobile']          = $this->get('mobile');
        $arr['email']           = $this->get('email');

        $db->record_update( $db->tbl_fix.$this->class_name, $arr, " `id` = '$id' " );
        
        return true;
    }

    public function delete_by(){
        global $db;

        $id             = $this->get('id');
        $investor_id    = $this->get('investor_id');

        $db->record_delete( $db->tbl_fix.$this->class_name, " `id` = '$id' AND `investor_id` = '$investor_id' " );
        
        return true;
    }

    public function list_by( $ofset, $limit = '' ) {
        global $db;
        
        $investor_id        = $this->get('investor_id');
        if( $limit != '' ) $limit = "LIMIT $ofset, $limit";
		
        $sql = "SELECT * FROM `". $this->class_name ."`
                WHERE `investor_id` = '$investor_id'
                $limit";

		$result = $db->executeQuery_list( $sql );

		return $result;
    }
    
    public function auto_complete( $keyword ){
        global $db;

        $investor_id        = $this->get('investor_id');
		
        $sql = "SELECT * FROM `". $this->class_name ."`
                WHERE `investor_id` = '$investor_id' AND ( `hint` LIKE '%$keyword%' OR  `fullname` LIKE '%$keyword%' OR  `username` LIKE '%$keyword%' OR  `email` LIKE '%$keyword%' )
                LIMIT 10";

		$result = $db->executeQuery_list( $sql );

		return $result;
	}
    
}
$contact =  new contact();