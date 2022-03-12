<?php

$nod        = $main->get('nod');
if( $act == 'idx' ){

    if( $nod == 'get_all' ){
        //  lấy key của filter loại khách sạn
        $valFilterByTime = $main->post('valFilterbyTime');
        $general_service->set('valFilterByTime',$valFilterByTime);
        // echo $valFilterByTime;
        // exit();
        $l = $general_service->get_all();
        // print_r($l);
        // exit();
        echo 'done##',$main->toJsonData( 200, 'success', $l );
        // unset( $l );

        
    }
    else if( $nod == 'history_booked_service' ){
        // lịch sử các dịch vụ mà phòng đã đặt

        // $booking_id = $main->post('booking_id');
        // $is_booked_service = $main->post('is_booked_service');
        // $is_edit_service = $main->post('is_edit_service');

        
        // $lItem = json_decode($lItem, true);
        // foreach($lItem as $item){
        //     $general_service->set('booking_id',$booking_id);
        //     $general_service->set('is_booked_service',$is_booked_service);
        //     $general_service->set('is_edit_service',$is_edit_service);
        // }

        // $general_service->set('booking_id',$booking_id);
        // $general_service->set('is_booked_service',$is_booked_service);
        // $general_service->set('is_edit_service',$is_edit_service);


        $l = $general_service->history_booked_service();
        // print_r($l);
        // exit();
        echo 'done##',$main->toJsonData( 200, 'success', $l );
    }
    else if( $nod == 'room_booked_today' ){
        // lịch sử các dịch vụ mà phòng đã đặt

        // $booking_id = $main->post('booking_id');
        // $is_booked_service = $main->post('is_booked_service');
        // $is_edit_service = $main->post('is_edit_service');

        
        // $lItem = json_decode($lItem, true);
        // foreach($lItem as $item){
        //     $general_service->set('booking_id',$booking_id);
        //     $general_service->set('is_booked_service',$is_booked_service);
        //     $general_service->set('is_edit_service',$is_edit_service);
        // }

        // $general_service->set('booking_id',$booking_id);
        // $general_service->set('is_booked_service',$is_booked_service);
        // $general_service->set('is_edit_service',$is_edit_service);


        $l = $general_service->list_room_booked();
        // print_r($l);
        // exit();
        echo 'done##',$main->toJsonData( 200, 'success', $l );
    }
    else if( $nod == 'get_all_service_booked' ){
        $booking_id = $main->post('booking_id');
        $is_booked_service = $main->post('is_booked_service');
        $is_edit_service = $main->post('is_edit_service');

        
        // $lItem = json_decode($lItem, true);
        // foreach($lItem as $item){
        //     $general_service->set('booking_id',$booking_id);
        //     $general_service->set('is_booked_service',$is_booked_service);
        //     $general_service->set('is_edit_service',$is_edit_service);
        // }

        $general_service->set('booking_id',$booking_id);
        $general_service->set('is_booked_service',$is_booked_service);
        $general_service->set('is_edit_service',$is_edit_service);


        $l = $general_service->get_all_service_booked();
        // print_r($l);
        // exit();
        echo 'done##',$main->toJsonData( 200, 'success', $l );
    }
    else if( $nod == 'get_lst_room_booked' ){
        // $booking_id = $main->post('booking_id');
        // $is_booked_service = $main->post('is_booked_service');
        // $is_edit_service = $main->post('is_edit_service');

        // $general_service->set('booking_id',$booking_id);
        // $general_service->set('is_booked_service',$is_booked_service);
        // $general_service->set('is_edit_service',$is_edit_service);

        $l = $general_service->list_room_booked();
        // print_r($l);
        // exit();
        echo 'done##',$main->toJsonData( 200, 'success', $l );
    }
    else if( $nod == 'handel_quantity' ){
        $id = $main->post('id');
        $condition = $main->post('condition');
        
        $general_service->set('id',$id);
        
        $data = $general_service->get_detail_service();
        
        $update_quantity = $data['quantity'] + $condition;
        $update_total = $update_quantity * $data['price'];

        $general_service->set('booking_id', $data['booking_id']);
        $general_service->set('service_id', $data['service_id']);
        $general_service->set('quantity', $update_quantity);
        $general_service->set('booking_status_id', $data['booking_status_id']);
        $general_service->set('note', $data['note']);
        $general_service->set('total', $update_total);

        $general_service->update_service();


        $d = $general_service->get_all_service_booked();
        echo 'done##',$main->toJsonData( 200, 'success', $d );
    }
    else if( $nod == 'handel_note' ){
        $id = $main->post('id');
        $note = $main->post('note');
        
        $general_service->set('id',$id);
        
        $data = $general_service->get_detail_service();
        

        $general_service->set('booking_id', $data['booking_id']);
        $general_service->set('service_id', $data['service_id']);
        $general_service->set('quantity',  $data['quantity']);
        $general_service->set('booking_status_id', $data['booking_status_id']);
        $general_service->set('note', $note);
        $general_service->set('total', $data['total']);

        $general_service->update_service();


        $d = $general_service->get_all_service_booked();
        echo 'done##',$main->toJsonData( 200, 'success', $d );
    }
    else if( $nod == 'add_service' ){

        // $id = $main->post('id');
        $service_id = $main->post('service_id');
        $booking_id = $main->post('booking_id');
        // $quantity = $main->post('quantity');
        $price = $main->post('price');
        // $note = $main->post('note');
        // $booking_status_id = $main->post('booking_status_id');
        // $total = $main->post('total');
        
        $general_service->set('id',$id);
        $general_service->set('service_id',$service_id);        
        $general_service->set('booking_id',$booking_id); 
        $general_service->set('quantity',$quantity);
        // $general_service->set('note',$note);
        // $general_service->set('booking_status_id',$booking_status_id);  
        // $general_service->set('total',$price);     

        // $hotel->set('hotel_id', $id);
        $d = $general_service->get_detail_service();
        // echo 'book'.$d['booking_id'];
        // echo 'service'.$d['service_id'];
        // print_r($d);
        // exit();
        if( isset($d['service_id']) && isset($d['booking_id']) && $d['booking_status_id'] == 7  ){
            $new_quantity = $d['quantity'] + 1;
            $new_total = $d['total'] * $new_quantity;
            // echo $new_quantity;
            // echo ' == ';
            // echo $new_total;
            // exit();
            $general_service->set('id',$d['id']); 
            $general_service->set('quantity',$new_quantity);
            $general_service->set('booking_status_id',$d['booking_status_id']);
            $general_service->set('total',$new_total);
            // print_r($d);
            // echo 'update lại';
            // exit();
            $d = $general_service->update_service();
            echo 'done##',$main->toJsonData( 200, 'success', $d );
            unset( $d );
        }else {
            // thêm dịch vụ vào phòng này
            // echo 'thêm dịch vụ mới';
            // exit();
            $general_service->set('total',$price);
            $d = $general_service->add_service();
            echo 'done##',$main->toJsonData( 200, 'success', $d );
            unset( $d );
            // echo 'done##',$main->toJsonData( 403, 'Không tìm thấy khách sạn này', null );
        }

    }else if( $nod == 'load_permission_default' ){
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
        if($nod == 'save_order_service'){
            $booking_id = $main->post('booking_id');
            $is_booked_service = $main->post('is_booked_service');
            $is_edit_service = $main->post('is_edit_service');


            $general_service->set('booking_id',$booking_id);
            $general_service->set('is_booked_service',$is_booked_service);
            $general_service->set('is_edit_service',$is_edit_service);

            // echo 'àasfafgasg';
            // exit();
            $general_service->order_service();
            echo 'done##',$main->toJsonData( 200, 'success', null );
            // check id đã tồn tại chưa 
            // echo $hotel_id;
            // exit();
            // if($hotel_id!=''){
            //     $hotel->update_hotel();
            //     echo 'done##',$main->toJsonData( 200, 'success', null );
                
            //     // echo 'update';
            //     // exit();
            // }else{
            //     // echo 'add';
            //     // exit();
            //     $hotel->add_hotel();
            //     echo 'done##',$main->toJsonData( 200, 'success', null );

            // }

            // echo 'done##',$main->toJsonData( 200, 'success', $d );
            
        }else{
            echo 'Missing nod';
            $db->close();
            exit();
        }

}else if($act == "delete"){
    if($nod == "delete_service_booked"){
        $id = $main->post('general_service_id');
        $general_service->set('id',$id);

        $d = $general_service->get_detail_service();
        
        if($d['booking_status_id'] = 7){
            echo $d['booking_status_id'];
        }else{
            echo $d['booking_status_id'];
        }
        // khi trạng thái đơn đang ở là tạm ghi và đã đặt thì có thể hủy món

        // $general_service->delete_service_booked();
        exit();
        echo 'done##',$main->toJsonData( 200, 'success', null );
        // echo 'delete hotel';
        // exit();
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