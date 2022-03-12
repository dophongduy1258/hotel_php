<?php
$nod        = $main->get('nod');
if( $act == 'idx' ){
    if( $nod == 'save' ){
        $data = $main->post('data');

        $data = json_decode( $data, true );
        if( $data ){
            foreach ($data as $key => $item) {
                if( isset($item['id']) ){
                    $app_setting->set('id', $item['id']);
                    $app_setting->set('title', $item['title']);
                    $app_setting->set('link', $item['link']);
                    $app_setting->set('img', $item['img']);
                    $app_setting->set('is_hidden', $item['is_hidden']);
                    $app_setting->update();
                }else{
                    
                }
            }
        }

        echo 'done##',$main->toJsonData( 200, 'success', null );
    }else  if( $nod == 'update_center_icon' ){

        $id         = $main->post('id');
        
        $app_setting->set('id', $id);
        $app_setting->update_center_icon();

        echo 'done##',$main->toJsonData( 200, 'success', null );

    }else  if( $nod == 'add' ){
        $data = $main->post('data');

        $item = json_decode( $data, true );
        if( $item ){
            $app_setting->set('title', $item['title']);
            $app_setting->set('link', $item['link']);
            $app_setting->set('img', $item['img']);
            $app_setting->set('is_hidden', 0);
            $app_setting->add();
        }
        
        $l = $app_setting->list_all_for_setting();

        echo 'done##',$main->toJsonData( 200, 'success', $l );
        unset($l);

    }else if( $nod == 'filter' ){

	    $l = $app_setting->list_all_for_setting();
        
        echo 'done##',$main->toJsonData( 200, 'success', $l );
        unset( $l );

        
    }else if( $nod == 'delete' ){

        $id       = $main->post('id');
        
        $app_setting->set('id', $id);
        $app_setting->update_deleted();

        $l = $app_setting->list_all_for_setting();
        
        echo 'done##',$main->toJsonData( 200, 'success', $l );
        unset($l);

    }else if( $nod == 'top' ){

        $id       = $main->post('id');
        
        $app_setting->set('id', $id);
        $app_setting->update_top();

        $l = $app_setting->list_all_for_setting();
        
        echo 'done##',$main->toJsonData( 200, 'success', $l );
        unset($l);
    
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