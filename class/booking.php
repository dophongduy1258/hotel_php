<?php
    class booking extends model {
        protected $class_name = 'booking';
        protected $booking_id;
        protected $customer_name;
        protected $cmnd;
        protected $phone_number;
        protected $email;
        protected $hotel_id;
        protected $room_id;
        protected $price;
        protected $booking_status_id;  // trạng thái của đơn đặt phòng : đã nhận đơn , đã xử lý , hủy đơn,....
        protected $is_payment;
        protected $total;
        protected $date_checkin;
        protected $date_checkout;
        protected $create_at;

        protected $slBed;

        protected $idxStatus;

        public function get_all(){
            global $db;

            $hotel_id = $this->get('hotel_id');
            $status = $this->get('status');
            $is_payment = $this->get('is_payment');
            $booking_status_id = $this->get('booking_status_id');

            $sqlHotel = '';
            $sqlBookingStatus = '';
            $sqlIsPayment = '';
            $sqlCondition = '';
            // option lọc theo khách sạn
            if($sqlHotel != ''){
               $sqlCondition = " AND h.`hotel_id` = $hotel_id";
            }
            // lọc phiếu đặt theo trạng thái đơn đặt
            elseif($sqlBookingStatus != ''){
                $sqlCondition = " AND bs.`booking_status_id` = $booking_status_id";
             }
            // option lọc theo thanh toán
            elseif($sqlIsPayment != ''){
                $sqlCondition = " AND b.`is_payment` = $is_payment";
             }

        $sql = "SELECT b.*, h.`hotel_name`,r.`room_number`,bs.`title` FROM `booking` b
            INNER JOIN `hotel` h ON b.`hotel_id` = h.`hotel_id`
            INNER JOIN `room` r ON b.`room_id` = r.`room_id`
            INNER JOIN `booking_status` bs ON bs.`booking_status_id` = b.`booking_status_id`
            WHERE 1 $sqlCondition
            ";
        $result = $db->executeQuery_list($sql);

        return $result;

        }

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
        public function get_detail_booking() {
            // echo $this->get('room_id');
            // exit();
            global $db;
            // $sql = "SELECT * FROM `". $this->class_name ."` WHERE `id` = '".$this->get('id')."'";
            $sql = "SELECT b.*, r.`price` price_room, r.`room_number`,r.`number_of_member` FROM `". $this->class_name."` b 
                    INNER JOIN `room` r ON `b`.`room_id` = r.`room_id`"."
                    INNER JOIN `booking_status` bs ON `b`.`booking_status_id` = `bs`.`booking_status_id`
                    WHERE b.`booking_id` = ".$this->get('booking_id');
            // echo $sql;
            // exit();
            $result = $db->executeQuery( $sql, 1);
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
            // print_r($arr['create_at']);
            
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

        public function filter_booking($check_in,$check_out, $status){
            global $db;

            $current_date = time();
            
            $date = " $current_date == `date_checkin` OR  $current_date <= `date_checkout` ";
            if($check_in != '' && $check_out != '' )  $date = " $check_in <= `date_checkin` <= $check_out OR $check_in <= `date_checkout` <= $check_out";


            $status = "AND `status` = $status";

            $sql =  "SELECT * from `booking`
                WHERE 1 $date $status
            ";
            $result = $db->executeQuery_list($sql);
            // print_r($result);
            return $result;
    
        }

        public function filter_room(){
            global $db;
            
            // echo $this->get('slBed');
            // echo $this->get('date_checkin');
            // echo $this->get('date_checkout');
            // exit();
            $condition = '';
            if($this->get('slBed') != ''){
                $condition = "AND r.bed = ".$this->get('slBed');
            }

            $sql = "SELECT r.room_id, r.room_number,r.bed,b.room_id id, b.date_checkin,b.date_checkout
                    FROM `room` as r
                    LEFT JOIN (
                        SELECT room_id ,date_checkin, date_checkout
                        FROM `booking`
                        WHERE NOT(
                            ( ".$this->get('date_checkin')." < `date_checkin` AND ".$this->get('date_checkout')." < `date_checkin`) 
                            OR
                            ( `date_checkout` < ".$this->get('date_checkin')." AND `date_checkout` < ".$this->get('date_checkout')." )
                        )
                    ) as b 
                    ON b.room_id = r.room_id WHERE 1 $condition "."AND b.room_id IS NULL
            ";
            $result = $db->executeQuery_list($sql);
            return $result;
        }

    }



    $booking = new booking();