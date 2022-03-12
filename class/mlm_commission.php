<?php
class mlm_commission extends model{

    protected $class_name = 'mlm_commission';
    protected $id;
    protected $amount;
    protected $total_delivered;
    protected $source;//key where this come from
    protected $created_by;
    protected $commission_from_user;
    protected $note;
    protected $created_at;
    
    public function add() {
        global $db;
        
        $arr['amount']                  = $this->get('amount');
        $arr['total_delivered']         = 0;
        $arr['source']                  = $this->get('source');
        $arr['note']                    = $this->get('note');
        $arr['created_by']              = $this->get('created_by');
        $arr['commission_from_user']    = $this->get('commission_from_user');
        $arr['created_at']              = time();
        
        $db->record_insert( "`". $this->class_name ."`", $arr );

		return $db->mysqli_insert_id();
    }

    public function update_total_delivered() {
        global $db;
        
        $id                             = $this->get('id');
        $arr['total_delivered']         = $this->get('total_delivered');
        
        $db->record_update( "`". $this->class_name ."`", $arr, " `id` = '$id' " );

		return true;
    }

    public function filter( $from, $to, $ofset = 0, $limit = '' ) {
        global $db, $user;
        
		if( $limit != '' ) $limit = " LIMIT $ofset, $limit ";
		
		$sql = "SELECT tt.*, inv.`fullname` as fullname
                FROM `". $this->class_name ."` tt
                INNER JOIN `investor` inv  ON inv.username = tt.commission_from_user
                WHERE  tt.`created_at` > '$from' AND tt.`created_at` < '$to'
				$limit";

        $result = $db->executeQuery( $sql );
        
        $kq     = array();
        while( $row = mysqli_fetch_assoc($result) ){
            
            $user->set('id', $row['created_by']);
            $row['created_by_fullname'] = $user->get_fullname();
            $kq[] = $row;

        }
        mysqli_free_result($result);

		return $kq;
	}

	public function filter_count(  $from, $to ){
        global $db;
        

		$sql = "SELECT COUNT(*) total
                FROM `". $this->class_name ."` tt
                WHERE  tt.`created_at` > '$from' AND tt.`created_at` < '$to'
                ";
        
		$result = $db->executeQuery( $sql, 1 );

		return $result['total']+0;
    }
    

}
$mlm_commission =  new mlm_commission();