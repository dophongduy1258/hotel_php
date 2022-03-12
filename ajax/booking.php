<?php

$nod        = $main->get('nod');
if( $act == 'idx' ){

    if( $nod == 'get_all' ){
        $idxStatus = $main->post('idxStatus');
        $booking->set('idxStatus',$idxStatus);

        $l = $booking->get_all();


        echo 'done##',$main->toJsonData( 200, 'success', $l );
        unset( $l );


    }else if( $nod == 'detail_booking' ){

        $booking_id = $main->post('booking_id');
        $room_id = $main->post('room_id');
        // echo $room_id;
        // exit();
        $booking->set('booking_id',$booking_id);
        $booking->set('room_id',$room_id);        

        // $hotel->set('hotel_id', $id);
        $d = $booking->get_detail_booking();
        // echo $d['hotel_id'];
        // print_r($d);
        // exit();
        if( isset($d['booking_id']) ){
            echo 'done##',$main->toJsonData( 200, 'success', $d );
            unset( $d );
        }else {
            echo 'done##',$main->toJsonData( 403, 'Không tìm thấy đơn đặt phòng này', null );
        }

    }else if( $nod == 'handle_sl_hotel' ){
        $hotel_id = $main->post('hotel_id');
        $booking->set('hotel_id',$hotel_id);
        $d = $booking->sl_room();
        echo 'done##',$main->toJsonData( 200, 'success', $d );
        unset( $d );


    
    }
    // xử lý giá và tổng tiền khi có room và số lượng thành viên
    else if( $nod == 'handle_sl_room' ){
        $room_id = $main->post('room_id');
        // $number_of_member = $main->post('number_of_member');
        $room->set('room_id',$room_id);
        $d = $room->get_detail_room();
        
        // print_r($d);
        // echo 'sl room check';
        // exit();
        
        echo 'done##',$main->toJsonData( 200, 'success', $d );
        unset( $d );


    
    }else if( $nod == 'filter_room' ){
        $date_check_in = $main->post('date_check_in');
        $date_check_out = $main->post('date_check_out');
        $slBed = $main->post('slBed');

        $strfromday= strtotime($main->convert_strdate($date_check_in));
        $strtoday = strtotime($main->convert_strdate($date_check_out));
        // echo($strfromday).' == ';
        // echo($strtoday); 
        // exit();
        $booking->set('date_checkin',$strfromday);
        $booking->set('date_checkout',$strtoday);
        $booking->set('slBed',$slBed);

        $d = $booking->filter_room();

        echo 'done##',$main->toJsonData( 200, 'success', $d );
        unset( $d );
    }
    else if( $nod == 'load_permission_default' ){
        $id = $main->post('gid');
        
        $gid->set('id', $id);
        $d = $gid->get_detail();

        echo 'done##',$main->toJsonData( 200, 'success', $d['default_permission'] );
        unset( $d );


    
    }else if( $nod == 'gid_permission' ){
        //get detail default permission of the group
        $id = $main->post('id');
        
        $gid->set('id', $id);
        $d = $gid->get_detail();

        echo 'done##',$main->toJsonData( 200, 'success', $d['default_permission'] );
        unset( $d );
    }else{
        echo 'Missing nod';
        $db->close();
        exit();
    }
}else if($act == 'save'){
        if($nod == 'save_booking'){

            $booking_id = $main->post('booking_id');
            $customer_name = $main->post('customer_name');
            $cmnd = $main->post('cmnd');
            $phone_number = $main->post('phone_number');
            $email = $main->post('email');
            $hotel_id = $main->post('hotel_id');
            $room_id = $main->post('room_id');
            $price = $main->post('price');
            $booking_status_id = $main->post('booking_status_id');
            $is_payment = $main->post('is_payment');
            $total = $main->post('total');
            $date_checkin = $main->post('date_checkin');
            $date_checkout = $main->post('date_checkout');


            $formatDateCheckIn =strtotime($main->convert_strdate($date_checkin));
            $formatDateCheckOut =strtotime($main->convert_strdate($date_checkout));

            $booking->set('booking_id',$booking_id);
            $booking->set('customer_name',$customer_name);
            $booking->set('cmnd',$cmnd);
            $booking->set('phone_number',$phone_number);
            $booking->set('email',$email);
            $booking->set('hotel_id',$hotel_id);
            $booking->set('room_id',$room_id);
            $booking->set('price',$price);
            $booking->set('booking_status_id',$booking_status_id);
            $booking->set('is_payment',$is_payment);
            $booking->set('total',$total);
            $booking->set('date_checkin',$formatDateCheckIn);
            $booking->set('date_checkout',$formatDateCheckOut);

            $d = $booking->get_detail_booking();
            // print_r($d);
            // echo $booking_id;
            // echo 'ưqoiuhf';
            // exit();
            // check id đã tồn tại chưa 
            if($booking_id != ''){
                // echo 'update';
                // exit();
                $booking->update_booking();
                echo 'done##',$main->toJsonData( 200, 'success', null );
                
                // echo $booking_id,$customer_name,$cmnd,$phone_number,$email,$number_of_member,$price,$status,$hotel_id,$room_id;
                
            }else{
                // echo $booking_id,$customer_name,$cmnd,$phone_number,$email,$number_of_member,$price,$status,$hotel_id,$room_id;
                // echo 'add';
                // exit();
                $booking->add_booking();
                echo 'done##',$main->toJsonData( 200, 'success', null );

            }

            // echo 'done##',$main->toJsonData( 200, 'success', $d );
            
        }else{
            echo 'Missing nod';
            $db->close();
            exit();
        }

}else if($act == "delete"){
    if($nod == "delete_booking"){
        $booking_id = $main->post('booking_id');
        $booking->set('booking_id',$booking_id);
        $booking->delete_booking();
        
        echo 'done##',$main->toJsonData( 200, 'success', null );
        
    }else{
            echo 'Missing nod';
            $db->close();
            exit();
        }
}
else if($act == "cancel"){
    if($nod == "cancel_booking"){
        $booking_id = $main->post('booking_id');
        $booking->set('booking_id',$booking_id);
        $booking->cancel_booking();
        
        echo 'done##',$main->toJsonData( 200, 'success', null );
        
    }else{
            echo 'Missing nod';
            $db->close();
            exit();
        }
}else{
    echo 'Missing action';
    $db->close();
    exit();
}


