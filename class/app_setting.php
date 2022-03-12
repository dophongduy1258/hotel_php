<?php
class app_setting extends model{

    protected $class_name = 'app_setting';
    protected $id;
    protected $title;
    protected $link;
    protected $img;
    protected $is_hidden;
    protected $deleted;
    protected $is_center_icon;//main icon

    public function add(){
        global $db;

        $arr['title']           = $this->get('title');
        $arr['link']            = $this->get('link');
        $arr['img']             = $this->get('img');
        $arr['deleted']         = 0;
        $arr['is_hidden']       = 0;
        $arr['is_center_icon']  = 0;
        $arr['created_at']      = time();

        $db->record_insert( $db->tbl_fix.$this->class_name, $arr );

        return $db->mysqli_insert_id();
    }

    public function update(){
        global $db;

        $id                             = $this->get('id');

        $arr['title']           = $this->get('title');
        $arr['link']            = $this->get('link');
        $arr['img']             = $this->get('img');
        $arr['is_hidden']       = $this->get('is_hidden');
        
        $db->record_update( $db->tbl_fix.$this->class_name, $arr, " `id` = '$id' " );
        
        return true;
    }

    public function update_deleted(){
        global $db;

        $id                             = $this->get('id');

        $arr['deleted']            = 1;
        
        $db->record_update( $db->tbl_fix.$this->class_name, $arr, " `id` = '$id' " );
        
        return true;
    }

    public function update_center_icon(){
        global $db;
        
        $id                      = $this->get('id');
        $arr['is_center_icon']   = 0;
        $db->record_update( $db->tbl_fix.$this->class_name, $arr, " 1 " );

        $arr['is_center_icon']   = 1;
        $db->record_update( $db->tbl_fix.$this->class_name, $arr, " `id` = '$id' " );

        return true;
    }

    public function update_hidden(){
        global $db;

        $id                             = $this->get('id');

        $arr['is_hidden']            = 1;
        
        $db->record_update( $db->tbl_fix.$this->class_name, $arr, " `id` = '$id' " );
        
        return true;
    }
    public function update_top(){
        global $db;

        $id                             = $this->get('id');

        $arr['created_at']            = time();
        
        $db->record_update( $db->tbl_fix.$this->class_name, $arr, " `id` = '$id' " );
        
        return true;
    }

    public function list_all_for_app() {
		global $db;
		
		$sql = "SELECT *
                FROM `". $this->class_name ."`
                WHERE `is_hidden` = 0 AND `deleted` = 0
				ORDER BY `created_at` DESC";
        
		$result = $db->executeQuery_list( $sql );

		return $result;
    }
    
    public function list_all_for_setting() {
		global $db;
		
		$sql = "SELECT *
                FROM `". $this->class_name ."`
                WHERE `deleted` = 0
				ORDER BY `created_at` DESC";

		$result = $db->executeQuery_list( $sql );

		return $result;
	}

}
$app_setting =  new app_setting();