<?php
/*
- Chuyển khoản suất qua lại nhưng có tiền; kiểu mua bán đảm bảo
*/
class transfer extends model{

    protected $class_name = 'transfer';
    protected $id;
    protected $product_id;
    protected $from_investor_username;
    protected $from_investor_name;
    protected $amount;
    protected $price;
    protected $note;
    protected $to_investor_username;
    protected $to_investor_name;
    protected $to_investor_paid_at;
    protected $cyclos_transaction_id;
    protected $cylos_note;
    protected $status;//status =0 pending; =1 done; -1 cancel
    protected $created_at;

    public function add(){
        global $db;
        
        $arr['product_id']                  = $this->get('product_id');
        $arr['from_investor_username']      = $this->get('from_investor_username');
        $arr['from_investor_name']          = $this->get('from_investor_name');
        $arr['amount']                      = $this->get('amount');
        $arr['price']                       = $this->get('price');
        $arr['note']                        = $this->get('note');
        $arr['to_investor_username']        = $this->get('to_investor_username');
        $arr['to_investor_name']            = $this->get('to_investor_name');
        $arr['to_investor_paid_at']         = 0;
        $arr['cyclos_transaction_id']       = '';
        $arr['cylos_note']                  = '';
        $arr['status']                      = '0';
        $arr['created_at']                  = time();

        $db->record_insert( $db->tbl_fix.$this->class_name, $arr );

        return $db->mysqli_insert_id();
    }

    public function update(){
        global $db;

        $id                                 = $this->get('id');

        $arr['from_investor_username']      = $this->get('from_investor_username');
        $arr['from_investor_name']          = $this->get('from_investor_name');
        $arr['amount']                      = $this->get('amount');
        $arr['price']                       = $this->get('price');
        $arr['note']                        = $this->get('note');
        $arr['to_investor_username']        = $this->get('to_investor_username');
        $arr['to_investor_name']            = $this->get('to_investor_name');
        $arr['cyclos_transaction_id']       = $this->get('cyclos_transaction_id');
        $arr['cylos_note']                  = $this->get('cylos_note');
        $arr['status']                      = $this->get('status');
        $arr['note']                        = $this->get('note');

        $db->record_update( $db->tbl_fix.$this->class_name, $arr, " `id` = '$id' " );

        return true;
    }

    public function update_done(){
        global $db;

        $id                                 = $this->get('id');
        $arr['to_investor_paid_at']         = time();
        $arr['cyclos_transaction_id']       = $this->get('cyclos_transaction_id');
        $arr['cylos_note']                  = $this->get('cylos_note');
        $arr['status']                      = 1;

        $db->record_update( $db->tbl_fix.$this->class_name, $arr, " `id` = '$id' " );

        return true;
    }

    public function cancel(){
        global $db;

        $id                         = $this->get('id');
        
        $arr['status']               = -1;

        $db->record_update( $db->tbl_fix.$this->class_name, $arr, " `id` = '$id' " );

        return true;
    }
    
    public function sum_pending() {
        //tính tổng suất đang có đối với sản phẩm này đang được chuyển khoản
        global $db;
        
        $to_investor_username           = $this->get('to_investor_username');
        $product_id                     = $this->get('product_id');
        
		$sql = "SELECT SUM(`t`.amount) total
                FROM ".$db->tbl_fix."`". $this->class_name ."` t
                WHERE `to_investor_username` = '$to_investor_username' AND t.`status` = '0' AND t.`product_id` = '$product_id' ";

		$result = $db->executeQuery( $sql, 1 );

		return $result['total']+0;
    }
    
    public function list_history( $type, $ofset = 0, $limit = '' ) {
        global $db;
        
        $to_investor_username   = $this->get('to_investor_username');
        $status                 = $this->get('status');
        
        if( $type != '' ){
            if( $type == 'sender' ){
                $type = "AND ( `from_investor_username` = '$to_investor_username' )";
            }else{
                $type = "AND ( `to_investor_username` = '$to_investor_username' )";
            }
        }else{
            $type = "AND ( `to_investor_username` = '$to_investor_username' OR   `from_investor_username` = '$to_investor_username') ";
        }

        if( $status != '' ) $status = "AND `status` = '$status' ";
		if( $limit != '' ) $limit = " LIMIT $ofset, $limit ";
		
		$sql = "SELECT * FROM `". $this->class_name ."`  WHERE 1 $status $type ORDER BY `created_at` DESC $limit ";

		$result = $db->executeQuery_list( $sql );

		return $result;
	}

	public function list_history_count( $type ){
        global $db;
        
        $to_investor_username = $this->get('to_investor_username');
        $status             = $this->get('status');
        
        if( $type != '' ){
            if( $type == 'sender' ){
                $type = "AND ( `from_investor_username` = '$to_investor_username' )";
            }else{
                $type = "AND ( `to_investor_username` = '$to_investor_username' )";
            }
        }else{
            $type = "AND ( `to_investor_username` = '$to_investor_username' OR   `from_investor_username` = '$to_investor_username') ";
        }

        
        if( $status != '' ) $status = "AND `status` = '$status' ";
		if( $limit != '' ) $limit = " LIMIT $ofset, $limit ";

		$sql = "SELECT COUNT(*) total FROM `". $this->class_name ."` WHERE 1 $status $type  ";

		$result = $db->executeQuery( $sql, 1 );

		return $result['total']+0;
    }
    
    public function filter( $keyword, $from, $to, $ofset = 0, $limit = '' ) {
        global $db;
        
        $status                 = $this->get('status');
        if( $status != '' ) $status = "AND  `status` = '$status' ";
		if( $limit != '' ) $limit = " LIMIT $ofset, $limit ";
        if( $keyword != '' ) $keyword = "AND ( `to_investor_username` = '$keyword'  OR `from_investor_username` = '$keyword'  OR `from_investor_name` = '$keyword' OR `from_investor_name` = '$keyword' ) ";
        
		$sql = "SELECT
                * FROM `". $this->class_name ."`
                WHERE
                '$from' < `created_at` AND `created_at` < '$to'
                $status $keyword
                ORDER BY `created_at` DESC
                $limit ";
		$result = $db->executeQuery_list( $sql );

		return $result;
	}

	public function filter_info( $keyword, $from, $to ){
        global $db;

        $status             = $this->get('status');
        
        if( $status != '' ) $status = "AND `status` = '$status' ";
        if( $keyword != '' ) $keyword = "AND ( `to_investor_username` = '$keyword'  OR `from_investor_username` = '$keyword'  OR `from_investor_name` = '$keyword' OR `from_investor_name` = '$keyword' ) ";
		if( $limit != '' ) $limit = " LIMIT $ofset, $limit ";
        
        $sql = "SELECT COUNT(*) total_record, SUM(`amount`*`price`) total_sum FROM `". $this->class_name ."`
                WHERE '$from' < `created_at` AND `created_at` < '$to' $keyword
                $status";
        
		$result = $db->executeQuery( $sql, 1 );

		return $result;
	}

}
$transfer =  new transfer();