<?php
class trade extends model{

    protected $class_name = 'trade';
    protected $id;
    protected $product_id;
    protected $investor_id;
    protected $username;
    protected $amount;
    protected $sold;
    protected $price;
    protected $status;//=0 đang treo; = -1 là đã hủy
    protected $buyer_id;
    protected $contact_name;
    protected $contact_mobile;
    protected $note;
    protected $created_at;

    public function add(){
        global $db;
        
        $arr['product_id']           = $this->get('product_id');
        $arr['investor_id']          = $this->get('investor_id');
        $arr['username']             = $this->get('username');
        $arr['amount']               = $this->get('amount');
        $arr['sold']                 = 0;
        $arr['price']                = $this->get('price');
        $arr['status']               = $this->get('status');
        $arr['buyer_id']             = $this->get('buyer_id');
        $arr['contact_name']         = $this->get('contact_name');
        $arr['contact_mobile']       = $this->get('contact_mobile');
        $arr['note']                 = $this->get('note');
        $arr['created_at']           = time();

        $db->record_insert( $db->tbl_fix.$this->class_name, $arr );

        return $db->mysqli_insert_id();
    }

    public function update(){
        global $db;

        $id                          = $this->get('id');

        $arr['product_id']           = $this->get('product_id');
        $arr['amount']               = $this->get('amount');
        $arr['sold']                 = $this->get('sold');
        $arr['price']                = $this->get('price');
        $arr['status']               = 0;//=0 đang treo
        $arr['buyer_id']             = $this->get('buyer_id');
        $arr['contact_name']         = $this->get('contact_name');
        $arr['contact_mobile']       = $this->get('contact_mobile');
        $arr['note']                 = $this->get('note');

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

    public function update_sold(){
        global $db;

        $id                        = $this->get('id');
        $sold                      = $this->get('sold');
        
        $arr['sold']               = $sold;

        $db->record_update( $db->tbl_fix.$this->class_name, $arr, " `id` = '$id' " );

        return true;
    }
    
    public function sum_selling() {
        //tính tổng suất đang có đối với sản phẩm này
        global $db;
        
        $username          = $this->get('username');
        $product_id        = $this->get('product_id');
        
		$sql = "SELECT SUM(`t`.amount - `t`.sold) total
                FROM ".$db->tbl_fix."`". $this->class_name ."` t
                WHERE `username` = '$username' AND t.`status` = 0 AND `product_id` = '$product_id' ";

		$result = $db->executeQuery( $sql, 1 );

		return $result['total']+0;
    }
    
    public function list_history( $ofset = 0, $limit = '' ) {
		global $db;
        $investor_id = $this->get('investor_id');
		
		if( $limit != '' ) $limit = " LIMIT $ofset, $limit ";
		
		$sql = "SELECT * FROM `". $this->class_name ."`  WHERE `investor_id` = '$investor_id' ORDER BY `created_at` DESC $limit ";

		$result = $db->executeQuery_list( $sql );

		return $result;
	}

	public function list_history_count() {
        global $db;
        
        $investor_id = $this->get('investor_id');

		$sql = "SELECT COUNT(*) total FROM `". $this->class_name ."` WHERE `investor_id` = '$investor_id' ";

		$result = $db->executeQuery( $sql, 1 );

		return $result['total']+0;
	}

    //list filter to market
    public function market( $keyword, $ofset, $limit ) {//by username
        global $db, $user;
        
        if( $limit != '' ) $limit = " LIMIT $ofset, $limit ";
        if( $keyword != '' ) $keyword = " AND ( p.`title` LIKE '%$keyword%' OR p.`code` LIKE '%$keyword%' ) ";

		$sql = "SELECT t.`username`, t.`amount` trade_amount, t.`sold` trade_sold, t.`price` trade_price, t.`product_id`, p.`title`, p.`price` root_price
                        ,t.`contact_name`, t.`contact_mobile`, t.`id`, t.`created_at`, t.`note`, p.`images`
                FROM `". $this->class_name ."` t
                INNER JOIN `product` p ON t.product_id = p.id
                WHERE 
                t.`status` = 0
                AND t.amount > t.sold
                $keyword
                ORDER BY t.`created_at` DESC
                $limit";

                $result = $db->executeQuery( $sql );
        
        $kq = array();
        while( $row = mysqli_fetch_assoc($result) ){
            // $user->set('id', $row['id']);
            // $row['approved_by'] = $user->get_fullname().'' != '' ? $user->get_fullname().'':'-';
            $kq[] = $row;
        }

		return $kq;
    }

    public function market_count( $keyword ) {//by username
        global $db;
        
        if( $keyword != '' ) $keyword = " AND ( p.`title` LIKE '%$keyword%' OR p.`code` LIKE '%$keyword%' ) ";

		$sql = "SELECT COUNT(*) total
                FROM `". $this->class_name ."` t
                INNER JOIN `product` p ON t.product_id = p.id
                WHERE 
                t.`status` = 0
                AND t.amount > t.sold
                $keyword
                ORDER BY t.`created_at` DESC";

		$result = $db->executeQuery( $sql, 1 );

		return $result['total']+0;
    }

}
$trade =  new trade();