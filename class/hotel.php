<?php
    class hotel extends model {
        protected $class_name = 'hotel';
        protected $hotel_id;
        protected $hotel_name;
        protected $description;
        protected $address;
        protected $category_id;



        public function get_all(){
            global $db;

            $category_id = $this->get('category_id');

            $sqlCategory = '';
            if($category_id != ''){
               $sqlCategory = " AND h.`category_id` = $category_id";
            }

        $sql = "SELECT h.*, ch.`name` FROM `hotel` h
            INNER JOIN `category_hotel` ch ON h.`category_id` = ch.`category_id`
            WHERE 1 $sqlCategory
            ";
        $result = $db->executeQuery_list($sql);

        return $result;

        }

            //  Lấy tất cả thông tin khách sạn trong bảng hotel
        // public function get_all(){
        //     global $db;
        //     $sql = "SELECT h.*, ch.`name` FROM `hotel` h
        //         INNER JOIN `category_hotel` ch ON h.`category_id` = ch.`category_id`
        //     ";
        //     $result = $db->executeQuery_list($sql);
            
        //     return $result;

        // }


        // lấy chi tiết thông tin 1 khách sạn
        public function get_detail_hotel() {
            global $db;
            
            // $sql = "SELECT * FROM `". $this->class_name ."` WHERE `id` = '".$this->get('id')."'";
            $sql = "SELECT * FROM `". $this->class_name ."` WHERE `hotel_id` = '".$this->get('hotel_id')."'";
            $result = $db->executeQuery( $sql, 1);
    
            return $result;
        }

    
        public function update_hotel(){
            global $db;
            $arr['hotel_name'] = $this->get('hotel_name');
            $arr['description'] = $this->get('description');
            $arr['address'] = $this->get('address');
            $arr['category_id'] = $this->get('category_id');
            $hotel_id = $this->get('hotel_id');


            $db->record_update($db->tbl_fix.' `hotel` ',$arr," `hotel_id` = '$hotel_id' ");
            unset($arr);
            return true;
            
            
        }

        public function add_hotel(){
            global $db;

            $arr['hotel_name'] = $this->get('hotel_name');
            $arr['description'] = $this->get('description');
            $arr['address'] = $this->get('address');
            $arr['category_id'] = $this->get('category_id');

            $db->record_insert($db->tbl_fix.'`hotel`',$arr);
            return $db->mysqli_insert_id();
        }


        public function delete_hotel(){
            global $db;

            $result = $db->record_delete($this->class_name," `hotel_id` = '".$this->get('hotel_id')." ' ");
            return $result;

        }


    }



    $hotel = new hotel();