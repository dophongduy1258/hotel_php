<?php
class product_sold_history extends model{

    protected $class_name = 'product_sold_history';
    protected $id;
    protected $username;
    protected $fullname;
    protected $slots;
    protected $price;
    protected $total;
    protected $product_id;
    protected $status;
    protected $cyclos_transaction_id;
    protected $cyclos_transaction_id_principal;
    protected $cyclos_transaction_id_ROI;
    protected $created_at;

    public function add(){
        global $db;

        $arr['username']            = $this->get('username');
        $arr['fullname']            = $this->get('fullname');
        $arr['price']               = $this->get('price');
        $arr['slots']               = $this->get('slots');
        $arr['total']               = $arr['price']*$arr['slots'];
        $arr['product_id']          = $this->get('product_id');
        $arr['cyclos_transaction_id'] = $this->get('cyclos_transaction_id');
        $arr['cyclos_transaction_id_principal']             = '';
        $arr['cyclos_transaction_id_ROI']                   = '';
        $arr['status']              = 0;
        $arr['created_at']          = time();

        $db->record_insert( $db->tbl_fix.$this->class_name, $arr );
        
        return $db->mysqli_insert_id();
    }

    public function add_cancel_record(){
        global $db;

        $arr['username']            = $this->get('username');
        $arr['fullname']            = $this->get('fullname');
        $arr['price']               = $this->get('price');
        $arr['slots']               = $this->get('slots');
        $arr['total']               = $arr['price']*$arr['slots'];
        $arr['product_id']          = $this->get('product_id');
        $arr['cyclos_transaction_id_principal'] = $this->get('cyclos_transaction_id_principal');
        $arr['cyclos_transaction_id_principal']             = '';
        $arr['cyclos_transaction_id_ROI']                   = '';
        $arr['status']              = -1;
        $arr['created_at']          = time();
        
        $db->record_insert( $db->tbl_fix.$this->class_name, $arr );
        
        return $db->mysqli_insert_id();
    }

    public function update_done_transaction(){
        global $db;
        
        $id                                 = $this->get('id');
        $cyclos_transaction_id_principal    = $this->get('cyclos_transaction_id_principal');
        $cyclos_transaction_id_ROI          = $this->get('cyclos_transaction_id_ROI');

        if( $cyclos_transaction_id_principal != '' )
            $arr['cyclos_transaction_id_principal'] = $cyclos_transaction_id_principal;

        if( $cyclos_transaction_id_ROI != '' )
            $arr['cyclos_transaction_id_ROI'] = $cyclos_transaction_id_ROI;
        
        // $arr['status']              = 1;
        if( isset($arr['cyclos_transaction_id_principal']) || isset($arr['cyclos_transaction_id_ROI']) )
            $db->record_update( $db->tbl_fix.$this->class_name, $arr, " `id` = '$id' " );
        
        return true;
    }

    public function update_delete_transaction(){
        global $db;
        
        $id                                     = $this->get('id');
        $cyclos_transaction_id_principal        = $this->get('cyclos_transaction_id_principal');
        $arr['cyclos_transaction_id_principal'] = $cyclos_transaction_id_principal;
        $arr['status']                          = -1;

        $db->record_update( $db->tbl_fix.$this->class_name, $arr, " `id` = '$id' " );

        return true;
    }

     public function update_slots_transaction(){
        global $db;
        
        $id                                     = $this->get('id');
        $arr['slots']                          = $this->get('slots');
        $arr['total']                          = $this->get('total');

        $db->record_update( $db->tbl_fix.$this->class_name, $arr, " `id` = '$id' " );
        
        return true;
    }

    public function delete(){
        global $db;
        
        $product_id                         = $this->get('product_id');

        $arr['status']              = -1;
        $db->record_update( $db->tbl_fix.$this->class_name, $arr, " `id` = '$product_id' " );
        
        return true;
    }

    public function list_by( ) {
        global $db;
        
        $product_id        = $this->get('product_id');
        
		$sql = "SELECT *
                FROM ".$db->tbl_fix."`". $this->class_name ."`
                WHERE `product_id` = '$product_id' AND `status` = 0
                ORDER BY `id` DESC";

		$result = $db->executeQuery_list( $sql );

		return $result;
    }

    public function list_investor_by_product_id( ) {
        global $db;
        
        $product_id        = $this->get('product_id');

		$sql = "SELECT `username`, `fullname`
                FROM ".$db->tbl_fix."`". $this->class_name ."`
                WHERE `product_id` = '$product_id' AND `status` = 0
                GROUP BY `username`
                ORDER BY `fullname`";

		$result = $db->executeQuery_list( $sql );

		return $result;
    }
    
    public function list_bought_by_product_id( ) {
        global $db;
        
        $product_id        = $this->get('product_id');

		$sql = "SELECT hs.*, pro.`title`, pro.`code`, pro.`status` pro_status, pro.`ROI`
                FROM ".$db->tbl_fix."`". $this->class_name ."` hs
                INNER JOIN ".$db->tbl_fix."`product` pro ON hs.product_id = pro.id
                WHERE hs.`product_id` = '$product_id' AND ( hs.`status` = 0 OR hs.`status` = -1 )
                ORDER BY hs.`created_at` DESC";
        
		$result = $db->executeQuery_list( $sql );

		return $result;
    }

    public function list_bought_available_by_id_and_investor( ) {//by id and username
        global $db;
        
        $product_id         = $this->get('product_id');
        $username           = $this->get('username');

		$sql = "SELECT hs.*, pro.`title`, pro.`code`, pro.`status` pro_status, pro.`ROI`
                FROM ".$db->tbl_fix."`". $this->class_name ."` hs
                INNER JOIN ".$db->tbl_fix."`product` pro ON hs.product_id = pro.id
                WHERE hs.`product_id` = '$product_id' AND hs.`status` = 0 AND `hs`.username = '$username' AND `hs`.username <> ''
                ORDER BY hs.`created_at` DESC";
        
		$result = $db->executeQuery_list( $sql );
        
		return $result;
    }

    public function summary_bought_by() {//by username, product_id
        //tính tổng suất đang có đối với sản phẩm này
        global $db;
        
        $username          = $this->get('username');
        $product_id        = $this->get('product_id');
        
		$sql = "SELECT SUM(`hs`.slots) slots, SUM(`hs`.total) `value`
                FROM ".$db->tbl_fix."`". $this->class_name ."` hs
                WHERE `username` = '$username' AND hs.`status` <> -1 AND `product_id` = '$product_id'
                ORDER BY `id` DESC";

		$result = $db->executeQuery_list( $sql );

		return $result;
    }
    
    public function summary_bought_available() {
        //tính tổng suất đang có đối với sản phẩm này
        global $db;
        
        $username          = $this->get('username');
        $product_id        = $this->get('product_id');
        
		$sql = "SELECT SUM(`hs`.slots) total
                FROM ".$db->tbl_fix."`". $this->class_name ."` hs
                WHERE `username` = '$username' AND hs.`status` = 0 AND `product_id` = '$product_id' ";

		$result = $db->executeQuery( $sql, 1 );

		return $result['total']+0;
	}
    
    public function list_asset( ) {
        global $db;

        $username        = $this->get('username');

		$sql = "SELECT pro.`id`, pro.`code`, nTB.`total_slots`, nTB.`created_at`
                FROM (
                        SELECT SUM(hs.`slots`) total_slots, hs.`product_id`, MIN(hs.`created_at`) `created_at`, hs.`username`, hs.`status`
                        FROM ".$db->tbl_fix."`". $this->class_name ."` hs
                        WHERE hs.`username` = '$username' AND hs.`status` = 0
                        GROUP BY `product_id`
                    ) nTB
                INNER JOIN ".$db->tbl_fix."`product` pro ON nTB.product_id = pro.id
                WHERE nTB.`username` = '$username' AND nTB.`status` = '0'
                ORDER BY pro.`code` ASC";
        
		$result = $db->executeQuery_list( $sql );

		return $result;
    }
    
    public function list_bought( ) {
        global $db;
        
        $username        = $this->get('username');

		$sql = "SELECT hs.*, pro.`title`, pro.`code`, pro.`status` pro_status, pro.`ROI`
                FROM ".$db->tbl_fix."`". $this->class_name ."` hs
                INNER JOIN ".$db->tbl_fix."`product` pro ON hs.product_id = pro.id
                WHERE `username` = '$username' AND hs.`status` = 0
                ORDER BY `id` DESC";

		$result = $db->executeQuery_list( $sql );

		return $result;
	}
    
    public function list_bought_by( $keyword, $from, $to, $ofset = '', $limit = '' ) {
        global $db;
        
        $status             = $this->get('status');//status product

        if( $limit != '' ) $limit = " LIMIT $ofset, $limit ";
        if( $keyword != '' ) $keyword = " AND (pro.`code` LIKE '%$keyword%' OR hs.`fullname` LIKE '%$keyword%' OR hs.`username` LIKE '%$keyword%' ) ";
        
        if( $status != '' )
            $status = " pro.`status` = '$status' ";
        else
            $status = " pro.`status` > -1 ";
        
		$sql = "SELECT hs.`id` product_history_id, hs.`created_at` purchased_at ,
                    pro.`title`, pro.`code`, hs.`slots` purchased_slots,
                    pro.`price`, pro.`status`, hs.`product_id`,
                    hs.`fullname`, hs.`username`, pro.`ROI`, pro.`status` pro_status
                FROM ".$db->tbl_fix."`". $this->class_name ."` hs
                LEFT JOIN ".$db->tbl_fix."`product` pro ON hs.product_id = pro.id
                WHERE 
                $status
                AND hs.`status` > -1
                AND '$from' < hs.created_at 
                AND hs.created_at < '$to'
                $keyword
                ORDER BY hs.`created_at` DESC
                $limit";

		$result = $db->executeQuery_list( $sql );

		return $result;
    }

   public function list_bought_by_count( $keyword, $from, $to ) {
        global $db;

        $status             = $this->get('status');//status product
        
        if( $keyword != '' ) $keyword = " AND (pro.`code` LIKE '%$keyword%' OR hs.`fullname` LIKE '%$keyword%' OR hs.`username` LIKE '%$keyword%' ) ";
        
        if( $status != '' )
            $status = " pro.`status` = '$status' ";
        else
            $status = " pro.`status` > -1 ";

		$sql = "SELECT COUNT(*) total
                FROM ".$db->tbl_fix."`". $this->class_name ."` hs
                LEFT JOIN ".$db->tbl_fix."`product` pro ON hs.product_id = pro.id
                WHERE 
                $status
                AND hs.`status` > -1
                AND '$from' < hs.created_at 
                AND hs.created_at < '$to'
                $keyword
                ";

		$result = $db->executeQuery( $sql, 1);
        
		return $result['total']+0;
    }
    
}
$product_history =  new product_sold_history();