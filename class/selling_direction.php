<?php
class selling_direction extends model{

    protected $class_name = 'selling_direction';
    protected $id;
    protected $name;

    public function add(){
        global $db;

        $arr['name']                = $this->get('name');
        $arr['root_id']             = $this->get('root_id');

        $db->record_insert( $db->tbl_fix.$this->class_name, $arr );

        return $db->mysqli_insert_id();
    }

    public function list_by_root(){
        global $db;

        $root_id = $this->get('root_id');

        $sql = "SELECT * FROM $db->tbl_fix$this->class_name WHERE `root_id` = '$root_id' ORDER BY `name` ";
        $result = $db->executeQuery_list( $sql );

        return $result;

    }

    public function opt_by_root(){//by province: grouped
        global $db;

        $l = $this->list_by_root();
        $opt = '';
        foreach ($l as $key => $it) {
            $opt .= '<option name="'.$it['id'].'">'.$it['name'].'</option>';
        }
        
        return $opt;
    }
    
}
$selling_direction =  new selling_direction();