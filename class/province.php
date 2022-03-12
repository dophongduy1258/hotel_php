<?php
class province extends model{

    protected $class_name = 'province';
    protected $id;
    protected $name;
    protected $deleted;
    protected $priority;
    protected $created_by;

    public function add(){
        global $db;

        $arr['name']                = $this->get('name');
        $arr['deleted']             = 0;
        $arr['priority']            = 0;
        $arr['created_by']          = $this->get('created_by');

        $db->record_insert( $db->tbl_fix.$this->class_name, $arr );

        return $db->mysqli_insert_id();
    }

    public function update(){
        global $db;

        $id                         = $this->get('id');

        $arr['name']                = $this->get('name');

        $db->record_update( $db->tbl_fix.$this->class_name, $arr, " `id` = '$id' " );

        return true;
    }

    public function get_detail_by_name() {
        global $db;
        
        $name        = $this->get('name');

		$sql = "SELECT *
                FROM ".$db->tbl_fix."`". $this->class_name ."`
                WHERE `name` = '$name'
                LIMIT 1";
        
		$result = $db->executeQuery( $sql, 1 );
        
		return $result;
    }

    public function list_all( $ofset='', $limit ='') {
        global $db;
		if( $limit != '' ) $limit = " LIMIT $ofset, $limit ";
        
		$sql = "SELECT * FROM `". $this->class_name ."` ORDER BY `priority`, `name` $limit";
        
		$result = $db->executeQuery_list( $sql );

		return $result;
    }
    
}
$province =  new province();