<?php
class mlm_detail extends model{

    protected $class_name = 'mlm_detail';
    protected $id;
    protected $username;//username con ở level
    protected $parent;//username cha ở level mlm_level_id
    protected $mlm_level_id;//int
    protected $total_commission;//int
    protected $created_at;//int
    
    public function add_record() {
        global $db;
        
        $arr['username']                = $this->get('username');
        $arr['parent']                  = $this->get('parent');
        $arr['mlm_level_id']            = $this->get('mlm_level_id');
        $arr['total_commission']        = 0;
        $arr['created_at']              = time();
        
        $db->record_insert( "`". $this->class_name ."`", $arr );

		return true;
    }

    public function update_record() {
        global $db;
        
        $arr['id']                      = $this->get('id');
        $arr['username']                = $this->get('username');
        $arr['parent']                  = $this->get('parent');
        $arr['mlm_level_id']            = $this->get('mlm_level_id');
        $arr['total_commission']        = 0;

        $db->record_update( "`". $this->class_name ."`", $arr, " `id` = '$id' " );

		return true;
    }
    
    public function new_username() {
        global $db, $mlm_level, $investor;

        $lLevel             = $mlm_level->list_all_sort_by_id( '', '', 'ASC' );
        $username_related   = $this->get('username');
        $parent             = $this->get('parent');
        
        foreach ( $lLevel as $key => $dLevel ) {
            if( $parent != '' ){

                $this->set('username', $username_related);
                $this->set('parent', $parent);
                $this->set('mlm_level_id', $dLevel['id']);
                $this->set('total_commission', 0);

                $dC = $this->get_detail_by_level();
                if( isset($dC['id']) ){
                    $this->set('id', $dC['id']);
                    $this->update_record();
                }else{
                    $this->add_record();
                }

                $investor->set('username', $parent);
                $parent = $investor->get_parent_by_username();
                
            }
        }
        
		return true;
    }

    // get value with paramater
	public function get_detail_by_level() {
		global $db;
		
        $sql = "SELECT * FROM `". $this->class_name ."`
                WHERE
                `username` = '".$this->get('username')."' AND
                `mlm_level_id` = '".$this->get('mlm_level_id')."'
                LIMIT 1
                ";
		$result = $db->executeQuery( $sql, 1);

		return $result;
    }

    // update commission plus
	public function update_commission_plus() {
        global $db;
        
        $total_commission       = $this->get('total_commission');
        $id                     = $this->get('id');
		
		$sql = "UPDATE `". $this->class_name ."` SET `total_commission` = (`total_commission` + $total_commission) WHERE `id` = '$id' ";
		$db->executeQuery( $sql );

        return true;
    }
    
    // get value with paramater
	public function delete_all() {
		global $db;
		
        $db->record_delete( "`". $this->class_name ."`", " `username` = '".$this->get('username')."' " );

		return $result;
	}
    
    public function filter( $ofset = 0, $limit = '' ) {
        global $db;
        
        $username = $this->get('username');
        $mlm_level_id = $this->get('mlm_level_id');
		if( $limit != '' ) $limit = " LIMIT $ofset, $limit ";
		
		$sql = "SELECT inv.`fullname`, inv.`username`, inv.`email`, inv.`mobile`, inv.`commission`, tt.`created_at`, tt.`total_commission`
                FROM `". $this->class_name ."` tt
                INNER JOIN `investor` inv  ON inv.username = tt.username
                WHERE tt.`parent` = '$username'
                AND tt.`mlm_level_id` = '$mlm_level_id'
				$limit ";

		$result = $db->executeQuery_list( $sql );

		return $result;
	}

	public function filter_count(){
        global $db;
        
        $username = $this->get('username');
        $mlm_level_id = $this->get('mlm_level_id');

		$sql = "SELECT COUNT(*) total
                FROM `". $this->class_name ."` tt
                WHERE  tt.`parent` = '$username'
                AND tt.`mlm_level_id` = '$mlm_level_id'
                ";
        
		$result = $db->executeQuery( $sql, 1 );

		return $result['total']+0;
	}

}
$mlm_detail =  new mlm_detail();