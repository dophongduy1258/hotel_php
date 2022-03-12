<?php
/*
- Bản lịch sử nạp rút tiền của admin cho nhà đầu tư, thực hiện bằng lệnh admin; rút tiền từ admin để chuyển khoản cho nó
*/
class transfer_history extends model{

    protected $class_name = 'transfer_history';
    protected $id;
    protected $related_name;
    protected $related_account;
    protected $related_id;
    protected $amount;
    protected $fee;
    protected $is_deposit;
    protected $description;
    protected $cyclos_transaction_id;
    protected $created_at;
    protected $created_by;

    public function add(){
        global $db;

        $arr['related_name']                = $this->get('related_name');
        $arr['related_account']             = $this->get('related_account');
        $arr['related_id']                  = $this->get('related_id');
        $arr['amount']                      = $this->get('amount');
        $arr['fee']                         = $this->get('fee');
        $arr['is_deposit']                  = $this->get('is_deposit');
        $arr['description']                 = $this->get('description');
        $arr['cyclos_transaction_id']       = $this->get('cyclos_transaction_id');
        $arr['created_at']                  = time();
        $arr['created_by']                  = $this->get('created_by');

        $db->record_insert( $db->tbl_fix.$this->class_name, $arr );

        return $db->mysqli_insert_id();
    }

    public function filter( $keyword, $from, $to, $ofset='', $limit ='') {
        global $db;

        if( $limit != '' ) $limit = " LIMIT $ofset, $limit ";
        
        $is_deposit = $this->get('is_deposit');
        if( $is_deposit != '' ) $is_deposit = " AND trans_history.`is_deposit` = '$is_deposit' ";
        $from_to = '';
		if( $from > 0 ) $from_to = " AND '$from' < trans_history.`created_at` AND trans_history.`created_at` < '$to'  ";
        if( $keyword != '' ) $keyword = " AND (trans_history.`related_name` LIKE '%$keyword%' OR trans_history.`related_account` LIKE '%$keyword%') ";
        $sql = "SELECT trans_history.*, u.fullname as create_by_admin FROM `" . $this->class_name . "` trans_history
                INNER JOIN user u ON trans_history.created_by = u.id
                WHERE
                1
                $keyword
                $from_to
                $is_deposit
                ORDER BY `id` DESC $limit";
        echo $sql;
		$result = $db->executeQuery_list( $sql );
        
		return $result;
    }

    public function filter_count( $keyword, $from, $to ) {
        global $db;

        $is_deposit = $this->get('is_deposit');
        if( $is_deposit != '' ) $is_deposit = " AND `is_deposit` = '$is_deposit' ";
        
        $sql = "SELECT COUNT(*) total
                FROM `". $this->class_name ."`
                WHERE '$from' < `created_at` AND `created_at` < '$to'
                $is_deposit";
        
		$result = $db->executeQuery( $sql, 1 );

		return $result['total']+0;
    }

    public function filter_total( $keyword, $from, $to ) {
        global $db;

        $is_deposit = $this->get('is_deposit');
        if( $is_deposit != '' ) $is_deposit = " AND `is_deposit` = '$is_deposit' ";
        
        $sql = "SELECT SUM(`amount`) total
                FROM `". $this->class_name ."`
                WHERE '$from' < `created_at` AND `created_at` < '$to'
                $is_deposit";
        
		$result = $db->executeQuery( $sql, 1 );

		return $result['total']+0;
    }
    
}
$transfer_history =  new transfer_history();