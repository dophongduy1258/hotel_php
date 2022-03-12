<?php
    class general_service extends model {
        protected $class_name = 'general_service';
        protected $id;
        protected $booking_id;
        protected $service_id;
        protected $quantity;
        protected $note;
        protected $total;
        protected $create_at;

        protected $is_booked_service;
        protected $is_edit_service;

        protected $valFilterByTime;

        public function get_all(){
           global $db;
           $current_time = time();
        //    ,s.name,s.price,bs.title

        // echo $this->get('valFilterByTime');
        // exit();
        $condition = '';
            if($this->get('valFilterByTime') == 1){
                // lịch sử đặt dịch vụ
                $condition = "AND ".$current_time." > b.date_checkin AND ".$current_time." > b.date_checkout";
            }elseif($this->get('valFilterByTime') == 2){
                //  Lịch đặt phòng hôm nay
                $condition = "AND ".$current_time." > b.date_checkin AND ".$current_time." > b.date_checkout";
            }

        $sql = "SELECT gs.*,b.customer_name,b.phone_number,r.room_number FROM `general_service` gs
            INNER JOIN `booking` b ON b.`booking_id` = gs.`booking_id`
            INNER JOIN `room` r ON r.`room_id` = b.`room_id`
            INNER JOIN `service` s ON s.`service_id` = gs.`service_id`
            INNER JOIN `booking_status` bs ON bs.`booking_status_id` = gs.`booking_status_id`
            WHERE 1 ".$condition."
            GROUP BY gs.booking_id
            ";
        // echo $sql;
        // exit();
        $result = $db->executeQuery_list($sql);

        return $result;

        }

        public function history_booked_service(){
            global $db;
            $condtion = '';
            // echo $this->get('is_booked_service');
            // echo '======';
            // echo $this->get('is_edit_service');
            // exit();


            // if($this->get('is_booked_service') == 1){
            //     $condtion = " AND gs.`booking_status_id` = 7";
            // }elseif($this->get('is_edit_service') == 1){
            //     $condtion = " AND gs.`booking_status_id` > 7";
            // }
            // echo $$this->get('is_edit_service');

            $sql = "SELECT gs.*,r.room_number FROM `general_service` gs
            -- INNER JOIN `service` s ON s.`service_id` = gs.`service_id`
            -- INNER JOIN `booking_status` bs ON bs.`booking_status_id` = gs.`booking_status_id`
            LEFT JOIN (
                    SELECT booking_id, customer_name,phone_number,room_id FROM `booking` 
                    WHERE 1 AND 1646896892 > date_checkin AND 1646896892 > date_checkout
                ) AS b
            ON b.booking_id = gs.booking_id 
            
            INNER JOIN `booking` b ON b.`booking_id` = gs.`booking_id`
            INNER JOIN `room` r ON r.`room_id` = b.`room_id`";
            // -- WHERE gs.`booking_id` = ".$this->get('booking_id').$condtion;

            $result = $db->executeQuery_list($sql);

            return $result;
        }

        public function get_all_service_booked(){
            global $db;
            $condtion = '';
            // echo $this->get('is_booked_service');
            // echo '======';
            // echo $this->get('is_edit_service');
            // exit();


            if($this->get('is_booked_service') == 1){
                $condtion = " AND gs.`booking_status_id` = 7";
            }elseif($this->get('is_edit_service') == 1){
                $condtion = " AND gs.`booking_status_id` > 7";
            }
            // echo $$this->get('is_edit_service');

            $sql = "SELECT gs.*,s.`name`,s.`price`,bs.`title`,r.room_number,r.room_id FROM `general_service` gs
            INNER JOIN `service` s ON s.`service_id` = gs.`service_id`
            INNER JOIN `booking_status` bs ON bs.`booking_status_id` = gs.`booking_status_id`
            INNER JOIN `booking` b ON b.`booking_id` = gs.`booking_id`
            INNER JOIN `room` r ON r.`room_id` = b.`room_id`
            WHERE gs.`booking_id` = ".$this->get('booking_id').$condtion;

            $result = $db->executeQuery_list($sql);

            return $result;
        }

        public function get_detail_service(){
            global $db;
            $id = $this->get("id");
            $sql_condition = '';
            if($this->get('service_id') != '' && $this->get('booking_id') != ''){
                $sql_condition = " 
                AND
                    gs.service_id = ".$this->get('service_id')."
                AND
                    gs.booking_id = ".$this->get('booking_id')
                ;
            }else{
                $sql_condition = "AND gs.`id` = $id";
            }


            $sql = "SELECT gs.*,s.price FROM `".$this->get('class_name')."` gs
                    INNER JOIN `service` s ON gs.`service_id` = s.`service_id` 
                    WHERE 1 $sql_condition";
            $result = $db->executeQuery($sql,1);
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


        // Lấy ra tất cả các phòng hiện tại đang được khách ở 
        public function list_room_booked() {
            // echo $this->get('room_id');
            // exit();
            $current_time = time();
            global $db;
            $sql = "SELECT b.*,r.room_number FROM `booking` b
            INNER JOIN `room` r ON r.room_id = b.room_id 
            WHERE   ( b.date_checkin <= ".$current_time." AND ".$current_time." <= b.date_checkout ) 
            ";
            // AND 
            // ( b.booking_status_id != 3 AND b.booking_status_id != 6 )
            
            // echo $current_time;
            // exit();
            $result = $db->executeQuery_list( $sql);
            // print_r($result);
            // exit();
            return $result;
        }

    
        public function update_booking(){
            global $db;
            $arr['customer_name'] = $this->get('customer_name');
            $arr['cmnd'] = $this->get('cmnd');
            $arr['phone_number'] = $this->get('phone_number');
            $arr['email'] = $this->get('email');
            $arr['hotel_id'] = $this->get('hotel_id');
            $arr['room_id'] = $this->get('room_id');
            $arr['price'] = $this->get('price');
            $arr['booking_status_id'] = $this->get('booking_status_id');
            $arr['is_payment'] = $this->get('is_payment');
            $arr['total'] = $this->get('total');
            $arr['date_checkin'] = $this->get('date_checkin');
            $arr['date_checkout'] = $this->get('date_checkout');
    
            $booking_id = $this->get('booking_id');
            // $arr['create_at']  = time();

            // echo 'update';
            // print_r($arr);
            // exit();
            $db->record_update($db->tbl_fix.' `booking` ',$arr," `booking_id` = '$booking_id' ");
            unset($arr);
            return true;
            
            
        }

        public function add_booking(){
            global $db;

            
            $arr['customer_name'] = $this->get('customer_name');
            $arr['cmnd'] = $this->get('cmnd');
            $arr['phone_number'] = $this->get('phone_number');
            $arr['email'] = $this->get('email');
            $arr['hotel_id'] = $this->get('hotel_id');
            $arr['room_id'] = $this->get('room_id');
            $arr['price'] = $this->get('price');
            $arr['booking_status_id'] = $this->get('booking_status_id');
            $arr['is_payment'] = $this->get('is_payment');
            $arr['total'] = $this->get('total');
            $arr['date_checkin'] = $this->get('date_checkin');
            $arr['date_checkout'] = $this->get('date_checkout');
            $arr['create_at'] = time();
            // print_r($arr);
            // exit();
            // echo 'add';
            $db->record_insert($db->tbl_fix.'`booking`',$arr);
            return $db->mysqli_insert_id();
        }

        
        public function delete_booking(){
            global $db;

            $result = $db->record_delete($this->class_name," `booking_id` = '".$this->get('booking_id')." ' ");
            return $result;

        }


        public function cancel_booking(){
            global $db;
            $arr['booking_status_id'] = 3;
            $result = $db->record_update($this->class_name,$arr," `booking_id` = '".$this->get('booking_id')." ' ");
            return $result;

        }


       
        public function add_service(){
            global $db;
            
            // echo 'service_id : '.$this->get('service_id');
            // echo 'booking_id'.$this->get('booking_id');
            // exit();
            $arr['service_id'] = $this->get('service_id');
            $arr['booking_id'] = $this->get('booking_id');
            $arr['booking_status_id'] = 7;
            $arr['quantity'] = 1;
            $arr['note'] = '';
            $arr['total'] = $this->get('total');
            $arr['create_at'] = time();
            // print_r($arr);
            // exit();
            $db->record_insert($db->tbl_fix.'`general_service`',$arr);
            return $db->mysqli_insert_id();
        }

        public function update_service(){
            global $db;

            // if($this->get('quantity') < 1){

            // }
            $arr['id'] = $this->get('id');
            $arr['booking_id'] = $this->get('booking_id');
            $arr['service_id'] = $this->get('service_id');
            $arr['quantity'] = $this->get('quantity');
            $arr['note'] = $this->get('note');
            $arr['booking_status_id'] = $this->get('booking_status_id');
            $arr['total'] = $this->get('total');
            $arr['create_at'] = time();
            // print_r($arr['quantity']);
            // echo('====');
            // print_r($arr['total']);
            // exit();
            $result = $db->record_update($this->class_name,$arr," `id` = '".$this->get('id')." ' ");
            return $result;
        
        }
        public function order_service(){
            global $db;
            $arr['booking_status_id'] = 8;

            $result = $db->record_update($this->class_name,$arr," `booking_id` = '".$this->get('booking_id')." ' ");
            return $result;
        }

        public function delete_service_booked(){

        }

    }



    $general_service = new general_service();