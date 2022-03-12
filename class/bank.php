<?php
class bank extends model{

    protected $class_name = 'bank';
    protected $id;
    protected $bank_code;
    protected $bank_name;
    protected $bank_account;
    protected $bank_account_name;
    protected $url;

    public function add(){
        global $db;

        $arr['bank_code']               = $this->get('bank_code');
        $arr['bank_name']               = $this->get('bank_name');
        $arr['bank_account']            = $this->get('bank_account');
        $arr['bank_account_name']       = $this->get('bank_account_name');
        $arr['url']                     = $this->get('url');

        $db->record_insert( $db->tbl_fix.$this->class_name, $arr );

        return $db->mysqli_insert_id();
    }

    public function update(){
        global $db;

        $id                             = $this->get('id');

        $arr['bank_code']               = $this->get('bank_code');
        $arr['bank_name']               = $this->get('bank_name');
        $arr['bank_account']            = $this->get('bank_account');
        $arr['bank_account_name']       = $this->get('bank_account_name');
        $arr['url']                     = $this->get('url');

        $db->record_update( $db->tbl_fix.$this->class_name, $arr, " `id` = '$id' " );
        
        return true;
    }

}
$bank =  new bank();