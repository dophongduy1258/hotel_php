<?php

$nod        = $main->get('nod');
if( $act == 'idx' ){

    if( $nod == 'get_all' ){
        //  lấy key của filter loại khách sạn
        $idxKey = $main->post('idxKey');
        $hotel->set('category_id',$idxKey);
        // echo $idxKey;
        // exit();
        $l = $hotel->get_all();
        echo 'done##',$main->toJsonData( 200, 'success', $l );
        // unset( $l );


    }else if( $nod == 'detail_hotel' ){

        $id = $main->post('hotel_id');
        $hotel->set('hotel_id',$id);        

        // $hotel->set('hotel_id', $id);
        $d = $hotel->get_detail_hotel();
        // echo $d['hotel_id'];
        // exit();
        if( isset($d['hotel_id']) ){
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
        if($nod == 'save_hotel'){
            $hotel_id = $main->post('hotel_id');
            $hotel_name = $main->post('hotel_name');
            $address = $main->post('address');
            $description = $main->post('description');
            $category_id = $main->post('category_id');


            $hotel->set('hotel_id',$hotel_id);
            $hotel->set('hotel_name',$hotel_name);
            $hotel->set('address',$address);
            $hotel->set('description',$description);
            $hotel->set('category_id',$category_id);

            // check id đã tồn tại chưa 
            // echo $hotel_id;
            // exit();
            if($hotel_id!=''){
                $hotel->update_hotel();
                echo 'done##',$main->toJsonData( 200, 'success', null );
                
                // echo 'update';
                // exit();
            }else{
                // echo 'add';
                // exit();
                $hotel->add_hotel();
                echo 'done##',$main->toJsonData( 200, 'success', null );

            }

            // echo 'done##',$main->toJsonData( 200, 'success', $d );
            
        }else{
            echo 'Missing nod';
            $db->close();
            exit();
        }

}else if($act == "delete"){
    if($nod == "delete_hotel"){
        $hotel_id = $main->post('hotel_id');
        $hotel->set('hotel_id',$hotel_id);
        $hotel->delete_hotel();
        
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