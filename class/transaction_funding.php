<?php
class transaction_funding extends model{

    protected $class_name = 'transaction_funding';
    protected $id;
    protected $bank_code;
    protected $bank_name;
    protected $bank_account;
    protected $bank_account_name;
    protected $amount;
    protected $username;
    protected $fullname;
    protected $type;//deposit|withdraw
    protected $status;//trạng thái giao dịch: = 0 waiting; = 1 done; = -1 cancellation
    protected $approved_by;//người approved
    protected $branch;
    protected $note;
    protected $cyclos_transaction_id;
    protected $created_at;
    
    public function add(){
        global $db;

        $arr['bank_code']           = $this->get('bank_code');
        $arr['bank_name']           = $this->get('bank_name');
        $arr['bank_account']        = $this->get('bank_account');
        $arr['bank_account_name']   = $this->get('bank_account_name');
        $arr['amount']              = $this->get('amount');
        $arr['username']            = $this->get('username');
        $arr['fullname']            = $this->get('fullname');
        $arr['type']                = $this->get('type');//deposit|withdraw
        $arr['status']              = 0;//pending, approved =1, = -1 cancellation
        $arr['approved_by']         = 0;
        $arr['branch']              = $this->get('branch');
        $arr['note']                = $this->get('note');
        $arr['cyclos_transaction_id'] = $this->get('cyclos_transaction_id');
        $arr['created_at']          = time();

        $db->record_insert( $db->tbl_fix.$this->class_name, $arr );

        return $db->mysqli_insert_id();
    }

    public function update(){
        global $db;

        $id                         = $this->get('id');

        $arr['bank_code']           = $this->get('bank_code');
        $arr['bank_name']           = $this->get('bank_name');
        $arr['bank_account']        = $this->get('bank_account');
        $arr['bank_account_name']   = $this->get('bank_account_name');
        $arr['amount']              = $this->get('amount');
        $arr['username']            = $this->get('username');
        $arr['fullname']            = $this->get('fullname');
        $arr['type']                = $this->get('type');
        $arr['status']              = $this->get('status');
        $arr['approved_by']         = $this->get('approved_by');
        $arr['cyclos_transaction_id'] = $this->get('cyclos_transaction_id');
        $arr['created_at']          = $this->get('created_at');
        
        $db->record_update( $db->tbl_fix.$this->class_name, $arr, " `id` = '$id' " );

        return true;
    }

    public function cancel(){
        global $db;

        $id                         = $this->get('id');
        $arr['status']              = -1;
        $arr['approved_by']         = $this->get('approved_by')+0;
        $arr['cyclos_transaction_id'] = $this->get('cyclos_transaction_id').'';
        
        $db->record_update( $db->tbl_fix.$this->class_name, $arr, " `id` = '$id' " );
        return true;
    }

    public function update_done(){
        global $db;

        $id                         = $this->get('id');
        $arr['status']              = 1;
        $arr['approved_by']         = $this->get('approved_by');
        
        if( $this->get('cyclos_transaction_id') != '' )
            $arr['cyclos_transaction_id']         = $this->get('cyclos_transaction_id');

        $db->record_update( $db->tbl_fix.$this->class_name, $arr, " `id` = '$id' " );
        return true;
    }

    public function list_by() {//by username
        global $db;

        $username   = $this->get('username');
        $type       = $this->get('type');
        
		$sql = "SELECT * FROM `". $this->class_name ."` WHERE `username` = '$username' AND `type` = '$type' AND `status` >= 0 ORDER BY `created_at` DESC";

		$result = $db->executeQuery_list( $sql );

		return $result;
    }

    public function filter( $keyword, $from, $to, $ofset, $limit ) {//by username
        global $db, $user;
        
        $type       = $this->get('type');

        if( $limit != '' ) $limit = " LIMIT $ofset, $limit ";
        if( $keyword != '' ) $keyword = " AND (trans.`bank_account` LIKE '%$keyword%' OR trans.`fullname` LIKE '%$keyword%' OR trans.`username` LIKE '%$keyword%' ) ";

		$sql = "SELECT trans.*
                FROM `". $this->class_name ."` trans
                WHERE 
                `type` = '$type'
                AND '$from' < `created_at`
                AND `created_at` < '$to'
                $keyword
                ORDER BY `created_at` DESC
                $limit";

        $result = $db->executeQuery( $sql );
        
        $kq = array();
        while( $row = mysqli_fetch_assoc($result) ){
            $user->set('id', $row['approved_by']);
            $row['approved_by'] = $user->get_fullname().'' != '' ? $user->get_fullname().'':'-';
            $kq[] = $row;
        }

		return $kq;
    }

    public function filter_count( $keyword, $from, $to ) {//by username
        global $db;
        
        $type       = $this->get('type');
        if( $keyword != '' ) $keyword = " AND (trans.`bank_account` LIKE '%$keyword%' OR trans.`fullname` LIKE '%$keyword%' OR trans.`username` LIKE '%$keyword%' ) ";

		$sql = "SELECT COUNT(*) total
                FROM `". $this->class_name ."` trans
                WHERE 
                `type` = '$type'
                AND '$from' < `created_at`
                AND `created_at` < '$to'
                $keyword
                ";

		$result = $db->executeQuery( $sql, 1 );

		return $result['total']+0;
    }
    
}
$transaction_funding =  new transaction_funding();