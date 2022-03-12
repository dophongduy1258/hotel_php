<?php
    class service extends model {
        protected $class_name = 'service';
        protected $service_id;
        protected $customer_name;
        protected $cmnd;
        protected $phone_number;
        protected $email;
        protected $hotel_id;
        protected $room_id;
        protected $price;
        protected $service_status_id;  // trạng thái của đơn đặt phòng : đã nhận đơn , đã xử lý , hủy đơn,....
        protected $is_payment;
        protected $total;
        protected $date_checkin;
        protected $date_checkout;
        protected $create_at;

        protected $slBed;

        protected $idxStatus;

        // public function get_all(){
        //     global $db;

        //     $sql = "SELECT b.*, h.`hotel_name`,r.`room_number`,bs.`title` FROM `service` b
        //         INNER JOIN `hotel` h ON b.`hotel_id` = h.`hotel_id`
        //         INNER JOIN `room` r ON b.`room_id` = r.`room_id`
        //         INNER JOIN `service_status` bs ON bs.`service_status_id` = b.`service_status_id`
        //         WHERE 1 $sqlCondition
        //         ";
        //     $result = $db->executeQuery_list($sql);

        // return $result;

        // }

        public function sl_room(){
            global $db;

            $hotel_id = $this->get('hotel_id');

            if($hotel_id != ''){
                $sql = "SELECT * FROM `room` WHERE `hotel_id` = $hotel_id";
                $result = $db->executeQuery_list($sql);
                return $result;
            }else{
                return false;
            }
            


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
        public function get_detail_service() {
            // echo $this->get('room_id');
            // exit();
            global $db;
            // $sql = "SELECT * FROM `". $this->class_name ."` WHERE `id` = '".$this->get('id')."'";
            $sql = "SELECT s.* FROM `". $this->class_name."` s 
                    WHERE s.`service_id` = ".$this->get('service_id');
            // echo $sql;
            // exit();
            $result = $db->executeQuery( $sql, 1);
            // print_r($result);
            // exit();
            return $result;
        }

    
        public function update_service(){
            global $db;
            $arr['customer_name'] = $this->get('customer_name');
            $arr['cmnd'] = $this->get('cmnd');
            $arr['phone_number'] = $this->get('phone_number');
            $arr['email'] = $this->get('email');
            $arr['hotel_id'] = $this->get('hotel_id');
            $arr['room_id'] = $this->get('room_id');
            $arr['price'] = $this->get('price');
            $arr['service_status_id'] = $this->get('service_status_id');
            $arr['is_payment'] = $this->get('is_payment');
            $arr['total'] = $this->get('total');
            $arr['date_checkin'] = $this->get('date_checkin');
            $arr['date_checkout'] = $this->get('date_checkout');
    
            $service_id = $this->get('service_id');
            // $arr['create_at']  = time();

            // echo 'update';
            // print_r($arr);
            // exit();
            $db->record_update($db->tbl_fix.' `service` ',$arr," `service_id` = '$service_id' ");
            unset($arr);
            return true;
            
            
        }

        public function add_service(){
            global $db;

            
            $arr['customer_name'] = $this->get('customer_name');
            $arr['cmnd'] = $this->get('cmnd');
            $arr['phone_number'] = $this->get('phone_number');
            $arr['email'] = $this->get('email');
            $arr['hotel_id'] = $this->get('hotel_id');
            $arr['room_id'] = $this->get('room_id');
            $arr['price'] = $this->get('price');
            $arr['service_status_id'] = $this->get('service_status_id');
            $arr['is_payment'] = $this->get('is_payment');
            $arr['total'] = $this->get('total');
            $arr['date_checkin'] = $this->get('date_checkin');
            $arr['date_checkout'] = $this->get('date_checkout');
            $arr['create_at'] = time();
            // print_r($arr['create_at']);
            
            // echo 'add';
            $db->record_insert($db->tbl_fix.'`service`',$arr);
            return $db->mysqli_insert_id();
        }

        
        public function delete_service(){
            global $db;

            $result = $db->record_delete($this->class_name," `service_id` = '".$this->get('service_id')." ' ");
            return $result;

        }


        public function cancel_service(){
            global $db;
            $arr['service_status_id'] = 3;
            $result = $db->record_update($this->class_name,$arr," `service_id` = '".$this->get('service_id')." ' ");
            return $result;

        }

        public function filter_service($check_in,$check_out, $status){
            global $db;

            $current_date = time();
            
            $date = " $current_date == `date_checkin` OR  $current_date <= `date_checkout` ";
            if($check_in != '' && $check_out != '' )  $date = " $check_in <= `date_checkin` <= $check_out OR $check_in <= `date_checkout` <= $check_out";


            $status = "AND `status` = $status";

            $sql =  "SELECT * from `service`
                WHERE 1 $date $status
            ";
            $result = $db->executeQuery_list($sql);
            // print_r($result);
            return $result;
    
        }


    }



    $service = new service();