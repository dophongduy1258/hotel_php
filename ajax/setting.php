<?php
$nod        = $main->get('nod');
if( $act == 'idx' ){
    if( $nod == 'save' ){
        
        $data = $main->post('data');

        $data = json_decode( $data, true );
        if( $data ){
            foreach ($data as $key => $item) {
                $opt->setvarname($item['varname']);
                $opt->setvalue($item['value']);
                $opt->update();
            }
        }

        echo 'done##',$main->toJsonData( 200, 'success', null );

    // }else if( $nod == 'delete' ){

    //     // $id       = $main->post('id');
    //     // $notification->set('id', $id);
    //     // $notification->delete();

    //     echo 'done##',$main->toJsonData( 200, 'success', null );

    }else if( $nod == 'save_fee' ){

        $data = $main->post('data');

        $data = json_decode( $data, true );
        if( $data ){
            foreach ($data as $key => $item) {

                $fees->set('id', $item['id']);
                $fees->set('amount_status', $item['amount_status']);
                $fees->set('amount_value', $item['amount_value']);
                $fees->set('percent_status', $item['percent_status']);
                $fees->set('percent_value', $item['percent_value']);
                $fees->set('script_status', $item['script_status']);
                $fees->set('script_value', $item['script_value']);
                $fees->update();
                
            }
        }

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