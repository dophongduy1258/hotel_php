<?php

class category_hotel extends model{
    protected $class_name = 'category_hotel';
    protected $category_id;
    protected $name;
    protected $image;
    protected $description;

    public function get_detail_category() {
        global $db;
        
        // $sql = "SELECT * FROM `". $this->class_name ."` WHERE `id` = '".$this->get('id')."'";
        $sql = "SELECT * FROM `". $this->class_name ."` WHERE `category_id` = '".$this->get('category_id')."'";
        $result = $db->executeQuery( $sql, 1);

        return $result;
    }


    public function update_category(){
        global $db;
        $arr['name'] = $this->get('name');
        $arr['image'] = $this->get('image');
        $arr['description'] = $this->get('description');
        $category_id = $this->get('category_id');


        $db->record_update($db->tbl_fix.' `category_hotel` ',$arr," `category_id` = '$category_id' ");
        unset($arr);
        return true;
        
        
    }

    public function add_category(){
        global $db;

        $arr['name'] = $this->get('name');
        $arr['image'] = $this->get('image');
        $arr['description'] = $this->get('description');

        $db->record_insert($db->tbl_fix.'`category_hotel`',$arr);
        return $db->mysqli_insert_id();
    }


    public function delete_category(){
        global $db;


        $result = $db->record_delete($this->class_name," `category_id` = '".$this->get('category_id')." ' ");
        return $result;

    }



}



$category_hotel = new category_hotel();

