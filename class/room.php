<?php

class room extends model{
    protected $class_name = 'room';
    protected $room_id;
    protected $room_number;
    protected $hotel_id;
    protected $price;
    protected $benefit_room;
    protected $img_rooms;
    protected $number_of_member;
    protected $size_room;
    protected $category_room_id;
    protected $bed;
    protected $description;
    protected $breakfast;
    protected $wifi;
    protected $refund;
    protected $reschedule;



    //  Lấy tất cả thông tin khách sạn trong bảng room
    public function get_all(){
        global $db;

        $sql = "SELECT r.*, h.`hotel_name` FROM `room` r
            INNER JOIN `hotel` h ON r.`hotel_id` = h.`hotel_id`
        ";
        $result = $db->executeQuery_list($sql);
        
        return $result;

    }



    public function get_detail_room() {
        global $db;
        
        // $sql = "SELECT * FROM `". $this->class_name ."` WHERE `id` = '".$this->get('id')."'";
        $sql = "SELECT * FROM `". $this->class_name ."` WHERE `room_id` = '".$this->get('room_id')."'";
        $result = $db->executeQuery( $sql, 1);

        return $result;
    }

    public function update_room(){
        global $db;
        $arr['room_number'] = $this->get('room_number');
        $arr['hotel_id'] = $this->get('hotel_id');
        $arr['price'] = $this->get('price');
        $arr['benefit_room'] = $this->get('benefit_room');
        $arr['img_rooms'] = $this->get('img_rooms'); 
        $arr['number_of_member'] = $this->get('number_of_member'); 
        $arr['size_room'] = $this->get('size_room');
        $arr['category_room_id'] = $this->get('category_room_id');
        $arr['bed'] = $this->get('bed');
        $arr['description'] = $this->get('description');
        $arr['breakfast'] = $this->get('breakfast');
        $arr['wifi'] = $this->get('wifi');
        $arr['refund'] = $this->get('refund'); 
        $arr['reschedule'] = $this->get('reschedule');  
        $room_id = $this->get('room_id');
        // print_r($arr['img_rooms']);
        // exit();
        $db->record_update($db->tbl_fix.' `room` ',$arr," `room_id` = '$room_id' ");
        unset($arr);
        return true;
        
        
    }

    public function add_room(){
        global $db;

        
        $arr['room_number'] = $this->get('room_number');
        $arr['hotel_id'] = $this->get('hotel_id');
        $arr['price'] = $this->get('price');
        $arr['benefit_room'] = $this->get('benefit_room');
        $arr['img_rooms'] = $this->get('img_rooms'); 
        $arr['number_of_member'] = $this->get('number_of_member'); 
        $arr['size_room'] = $this->get('size_room');
        $arr['category_room_id'] = $this->get('category_room_id');
        $arr['bed'] = $this->get('bed');
        $arr['description'] = $this->get('description');
        $arr['breakfast'] = $this->get('breakfast');
        $arr['wifi'] = $this->get('wifi');
        $arr['refund'] = $this->get('refund'); 
        $arr['reschedule'] = $this->get('reschedule');

        print_r($arr);
        exit();
        $db->record_insert($db->tbl_fix.'`room`',$arr);
        return $db->mysqli_insert_id();
    }


    public function delete_room(){
        global $db;


        $result = $db->record_delete($this->class_name," `room_id` = '".$this->get('room_id')." ' ");
        return $result;

    }

    public function delete_img(){

        global $db;
        $sql = 'UPDATE `room` 
                SET `img_rooms`="'.$this->get('img_rooms').'"
                WHERE `room_id`='.$this->get('room_id');
         $result = $db->executeQuery($sql);
         return $result;
    }


}



$room = new room();

