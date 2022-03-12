<?php

$nod        = $main->get('nod');
if( $act == 'idx' ){

    if( $nod == 'get_all' ){

        $l = $category_hotel->list_all();
        echo 'done##',$main->toJsonData( 200, 'success', $l );
        unset( $l );


    }else if( $nod == 'detail_category' ){

        $id = $main->post('category_id');
        $category_hotel->set('category_id',$id);        

        // $hotel->set('hotel_id', $id);
        $d = $category_hotel->get_detail_category();
        // echo $d['hotel_id'];
        // exit();
        if( isset($d['category_id']) ){
            echo 'done##',$main->toJsonData( 200, 'success', $d );
            unset( $d );
        }else {
            echo 'done##',$main->toJsonData( 403, 'Không tìm thấy loại khách sạn này', null );
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
        if($nod == 'save_category'){
            $category_id = $main->post('category_id');
            $name = $main->post('name');
            $image = $main->post('image');
            $description = $main->post('description');


            $category_hotel->set('category_id',$category_id);
            $category_hotel->set('name',$name);
            $category_hotel->set('image',$image);
            $category_hotel->set('description',$description);

            $d = $category_hotel->get_detail_category();

            // check id đã tồn tại chưa 
            if(isset($d['category_id'])){
                $category_hotel->update_category();
                echo 'done##',$main->toJsonData( 200, 'success', null );
                
            }else{
                // echo $category_id,$hotel_id,$hotel_name,$address,$description;
                // exit();
                $category_hotel->add_category();
                echo 'done##',$main->toJsonData( 200, 'success', null );

            }

            // echo 'done##',$main->toJsonData( 200, 'success', $d );
            
        }else{
            echo 'Missing nod';
            $db->close();
            exit();
        }

}else if($act == "delete"){
    if($nod == "delete_category"){
        $category_id = $main->post('category_id');
        $category_hotel->set('category_id',$category_id);
        $category_hotel->delete_category();
        
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