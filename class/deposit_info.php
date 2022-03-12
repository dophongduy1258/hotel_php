<?php
class deposit_info extends model{

    protected $class_name = 'deposit_info';
    protected $id;
    protected $type;//loại = 0 cọc; = 1 mua
    protected $value;//giá trị xuất đặt cọc; mua
    protected $investor_id;
    protected $username;
    protected $fullname;
    protected $web_product_id;
    protected $name;
    protected $transaction_id;
    protected $transaction_refund;
    protected $note;
    protected $link;
    protected $object;
    protected $status;//=0 waiting; =1 done; = -1 refunded
    protected $created_at;

    public function add(){
        global $db;

        $arr['type']            = $this->get('type');
        $arr['value']           = $this->get('value');
        $arr['investor_id']     = $this->get('investor_id');
        $arr['username']        = $this->get('username');
        $arr['fullname']        = $this->get('fullname');
        $arr['web_product_id']  = $this->get('web_product_id');
        $arr['name']            = $this->get('name');
        $arr['transaction_id']  = $this->get('transaction_id');
        $arr['transaction_refund']  = '';
        $arr['note']            = $this->get('note');
        $arr['link']            = $this->get('link');
        $arr['object']          = $this->get('object');
        $arr['status']          = 0;
        $arr['created_at']      = time();

        $db->record_insert( $db->tbl_fix.$this->class_name, $arr );
        
        return $db->mysqli_insert_id();
    }

    public function update_done(){
        global $db;

        $id = $this->get('id');
        $arr['status']          = 1;

        $db->record_update( $db->tbl_fix.$this->class_name, $arr, " `id` = '$id' " );
        
        return true;
    }

    public function update_refund(){
        global $db;

        $id = $this->get('id');
        $arr['transaction_refund']          = $this->get('transaction_refund');
        $arr['status']                      = -1;

        $db->record_update( $db->tbl_fix.$this->class_name, $arr, " `id` = '$id' " );
        
        return true;
    }
    // public function update(){
    //     global $db;

    //     $id                         = $this->get('id');
    //     $arr['type']            = $this->get('type');
    //     $arr['value']           = $this->get('value');
    //     $arr['investor_id']     = $this->get('investor_id');
    //     $arr['username']        = $this->get('username');
    //     $arr['fullname']        = $this->get('fullname');
    //     $arr['web_product_id']  = $this->get('web_product_id');
    //     $arr['transaction_id']  = $this->get('transaction_id');
    //     $arr['note']            = $this->get('note');
    //     $arr['link']            = $this->get('link');
    //     $arr['object']          = $this->get('object');
    //     $arr['created_at']      = time();

    //     $db->record_update( $db->tbl_fix.$this->class_name, $arr, " `id` = '$id' " );
        
    //     return true;
    // }

    public function list_by_investor( $keyword ) {
        global $db;
        $investor_id = $this->get('investor_id');

        if( $keyword != '' ) $keyword = " `web_product_id` LIKE '%$keyword%' OR `object` LIKE '%$keyword%' ";

		$sql = "SELECT *
                FROM ".$db->tbl_fix."`". $this->class_name ."`
                WHERE 
                `investor_id` = '$investor_id'
                ORDER BY `created_at` DESC";
        
		$result = $db->executeQuery_list( $sql );

		return $result;
    }

    public function list_by( $keyword, $ofset = '', $limit = '' ) {
        global $db;
        
        if( $limit != '' ) $limit = " LIMIT $ofset, $limit ";
        if( $keyword != '' ) $keyword = " AND (`username` LIKE '%$keyword%' OR `fullname` LIKE '%$keyword%' OR `web_product_id` LIKE '%$keyword%' )";
        
		$sql = "SELECT *
                FROM ".$db->tbl_fix."`". $this->class_name ."`
                WHERE 
                1
                $keyword
                ORDER BY `created_at` DESC
                $limit";

		$result = $db->executeQuery_list( $sql );

		return $result;
    }
    
     public function list_by_count( $keyword ) {
        global $db;
        
        if( $keyword != '' ) $keyword = " AND (`username` LIKE '%$keyword%' OR `fullname` LIKE '%$keyword%' OR `web_product_id` LIKE '%$keyword%' )";
        
		$sql = "SELECT COUNT(*) total
                FROM ".$db->tbl_fix."`". $this->class_name ."`
                WHERE
                1
                $keyword";
        
		$result = $db->executeQuery( $sql, 1 );

		return $result['total']+0;
    }
    
}
$deposit_info =  new deposit_info();