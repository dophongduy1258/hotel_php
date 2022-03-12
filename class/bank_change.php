<?php
class bank_change extends model{

    protected $class_name = 'bank_change';
    protected $id;
    protected $transaction_funding_id;
    protected $sender;
    protected $content;
    protected $created_at;

    public function add(){
        global $db;

        $arr['transaction_funding_id']         = $this->get('transaction_funding_id');
        $arr['sender']                         = $this->get('sender');
        $arr['content']                        = $this->get('content');
        $arr['created_at']                     = time();
        
        $db->record_insert( $db->tbl_fix.$this->class_name, $arr );
        
        return $db->mysqli_insert_id();
    }

    public function update_content(){
        global $db;
        
        $id         = $this->get('id');
        $content    = $this->get('content');

        $sql = "UPDATE $db->tbl_fix`$this->class_name` SET `content` = CONCAT(`content`, '; $content') WHERE `id` = '$id' ";
        $db->executeQuery( $sql );

        return true;;
    }

    public function filter( $keyword = '', $ofset = '', $limit = '' ) {
        global $db;
        
        if( $keyword != '' ) $keyword = " WHERE `sender` LIKE '%$keyword%' OR  `content` LIKE '%$keyword%'";
        if( $limit != '' ) $limit = "LIMIT $ofset, $limit";
     
        $sql = "SELECT *
                FROM `$this->class_name` b
                $keyword
                ORDER BY `id` DESC
                $limit";

		$result = $db->executeQuery_list( $sql );

		return $result;
    }

    public function filter_count( $keyword = '') {
        global $db;
        
        if( $keyword != '' ) $keyword = " WHERE `sender` LIKE '%$keyword%' OR  `content` LIKE '%$keyword%'";
        $sql = "SELECT COUNT(*) total
                FROM `$this->class_name` b
                $keyword";

		$result = $db->executeQuery( $sql, 1 );

		return $result['total']+0;
    }
    
}
$bank_change =  new bank_change();