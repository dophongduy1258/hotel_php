<?php

$nod        = $main->get('nod');
if( $act == 'idx' ){
    if( $nod == 'filter' ){

        $l = $product_suggest->list_all();
        echo 'done##',$main->toJsonData( 200, 'success', $l );
        
        unset( $l );

    }else if( $nod == 'delete' ){

        $id = $main->post('id');

        $product_suggest->set('id', $id);
        $product_suggest->delete();

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