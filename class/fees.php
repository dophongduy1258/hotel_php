<?php
class fees extends model{

    protected $class_name = 'fees';
    protected $id;
    protected $type;
    protected $name;
    protected $amount_status;
    protected $amount_value;
    protected $percent_status;
    protected $percent_value;
    protected $script_status;
    protected $script_value;

    public function add(){
        global $db;
        
        $arr['type']                = $this->get('type');
        $arr['name']                = $this->get('name');
        $arr['amount_status']       = $this->get('amount_status');
        $arr['amount_value']        = $this->get('amount_value');
        $arr['percent_status']      = $this->get('percent_status');
        $arr['percent_status']      = $this->get('percent_status');
        $arr['script_status']       = $this->get('script_status');
        $arr['script_value']        = $this->get('script_value');

        $db->record_insert( $db->tbl_fix.$this->class_name, $arr );

        return $db->mysqli_insert_id();
    }

    public function update(){
        global $db;

        $id                         = $this->get('id');

        $arr['amount_status']       = $this->get('amount_status');
        $arr['amount_value']        = $this->get('amount_value');
        $arr['percent_status']      = $this->get('percent_status');
        $arr['percent_value']       = $this->get('percent_value');
        $arr['script_status']       = $this->get('script_status');
        $arr['script_value']        = $this->get('script_value');

        $db->record_update( $db->tbl_fix.$this->class_name, $arr, " `id` = '$id' " );

        return true;
    }

}
$fees =  new fees();