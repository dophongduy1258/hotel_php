<?php

$nod        = $main->get('nod');
if( $act == 'idx' ){

    if( $nod == 'get_detail' ){
        $service_id = $main->post('service_id');

        $service->set('service_id',$service_id);

        $l = $service->get_detail_service();
        // print_r($l);
        // exit();
        echo 'done##',$main->toJsonData( 200, 'success', $l );
        // unset( $l );

        
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