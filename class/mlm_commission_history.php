<?php
class mlm_commission_history extends model{
    
    protected $class_name = 'mlm_commission_history';
    protected $id;
    protected $mlm_commission_id;
    protected $username;
    protected $commission;
    protected $mlm_level_id;
    protected $created_at;
    
    public function add() {
        global $db;
        
        $arr['mlm_commission_id']       = $this->get('mlm_commission_id');
        $arr['username']                = $this->get('username');
        $arr['commission']                  = $this->get('commission');
        $arr['mlm_level_id']            = $this->get('mlm_level_id');
        $arr['created_at']              = time();
        
        $db->record_insert( "`". $this->class_name ."`", $arr );

		return true;
    }

    public function list_by( ) {
        global $db, $user;
        
        $mlm_commission_id       = $this->get('mlm_commission_id');
        
		$sql = "SELECT tt.*, inv.`fullname` as fullname, lev.`name` mlm_level_name
                FROM `". $this->class_name ."` tt
                INNER JOIN `investor` inv  ON inv.username = tt.username
                INNER JOIN `mlm_level` lev  ON lev.id = tt.mlm_level_id
                WHERE  tt.`mlm_commission_id` = '$mlm_commission_id' ORDER BY `id` ASC";

        $result = $db->executeQuery_list( $sql );

		return $result;
    }
    
}
$mlm_commission_history =  new mlm_commission_history();