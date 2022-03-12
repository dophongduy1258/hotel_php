<?php

$nod        = $main->get('nod');
if( $act == 'idx' ){

    if( $nod == 'get_all' ){

        // $keyword = $main->post('keyword');

        // $l = $user->list_all( $keyword );

        // echo 'done##',$main->toJsonData( 200, 'success', $l );
        // unset( $l );

        $l = $room->get_all();
        echo 'done##',$main->toJsonData( 200, 'success', $l );
        unset( $l );


    }else if( $nod == 'detail_room' ){

        $id = $main->post('room_id');
        $room->set('room_id',$id);        

        // $hotel->set('hotel_id', $id);
        $d = $room->get_detail_room();
        // echo $d['room_id'];
        // exit();
        if( isset($d['room_id']) ){
            echo 'done##',$main->toJsonData( 200, 'success', $d );
            unset( $d );
        }else {
            echo 'done##',$main->toJsonData( 403, 'Không tìm thấy khách sạn này', null );
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
        if($nod == 'save_room'){
            $room_id = $main->post('room_id');
            $room_number = $main->post('room_number');
            $hotel_id = $main->post('hotel_id');
            $price = $main->post('price');
            $benefit_room = $main->post('benefit_room');
            $img_rooms = $main->post('img_rooms'); 
            $number_of_member = $main->post('number_of_member'); 
            $size_room = $main->post('size_room');
            $category_room_id = $main->post('category_room_id');
            $bed = $main->post('bed');
            $description = $main->post('description');
            $breakfast = $main->post('breakfast');
            $wifi = $main->post('wifi');
            $refund = $main->post('refund'); 
            $reschedule = $main->post('reschedule');
            

            $room->set('room_id',$room_id);
            $room->set('room_number',$room_number);
            $room->set('hotel_id',$hotel_id);
            $room->set('price',$price);
            $room->set('benefit_room',$benefit_room);
            $room->set('img_rooms',$img_rooms); 
            $room->set('number_of_member',$number_of_member); 
            $room->set('size_room',$size_room);
            $room->set('category_room_id',$category_room_id);
            $room->set('bed',$bed);
            $room->set('description',$description);
            $room->set('breakfast',$breakfast);
            $room->set('wifi',$wifi);
            $room->set('refund',$refund); 
            $room->set('reschedule',$reschedule);

            $d = $room->get_detail_room();
            // check id đã tồn tại chưa 
            if(isset($d['room_id'])){
                $room->update_room();
                echo 'done##',$main->toJsonData( 200, 'success', null );
                // echo $img_rooms;
                // echo $benefits;
                // exit();
                // echo $category_id,$hotel_id,$hotel_name,$address,$description;
                
            }else{
                // echo 'add';
                // echo $benefits;
                // exit();
                $room->add_room();
                echo 'done##',$main->toJsonData( 200, 'success', null );

            }

            // echo 'done##',$main->toJsonData( 200, 'success', $d );
            
        }else{
            echo 'Missing nod';
            $db->close();
            exit();
        }

}else if($act == "delete"){
    if($nod == "delete_room"){
        $room_id = $main->post('room_id');
        $room->set('room_id',$room_id);
        $room->delete_room();
        
        echo 'done##',$main->toJsonData( 200, 'success', null );
        // echo 'delete hotel';
        // exit();
    }
    elseif($nod == "delete_img"){
        $room_id = $main->post('room_id');
        $img_rooms = $main->post('img_rooms');

        $room->set('room_id',$room_id);
        $room->set('img_rooms',$img_rooms);

        $room->delete_img();
        echo 'done##',$main->toJsonData( 200, 'success', null );


    }
    else{
            echo 'Missing nod';
            $db->close();
            exit();
        }
}else{
    echo 'Missing action';
    $db->close();
    exit();
}