<?php

$app->post('/investor/static', function () use ( $app, $dInvestor, $product, $main, $user ) {
    
    if( isset($dInvestor['id']) ){
        $username      	= $dInvestor['username'];
        
        $product->set('username', $username);
        $kq = $product->init_static();
        
        echo $main->toJsonData( 200, 'success', $kq );
        unset( $kq );
    }else{
        echo $main->toJsonData( 403, 'Không tìm thấy phiên đăng nhập này, vui lòng đăng nhập lại.',  null );
    }

});

$app->post('/investor/get_by', function () use ( $app, $dInvestor, $investor, $product, $main, $user ) {
    
    if( isset($dInvestor['id']) ){
	    $transfer_info       = $app->request()->post('transfer_info');
        
        $d = $investor->get_transfer_info( $main->clean( $transfer_info ) );
        
        if( isset($d['id']) ){
            echo $main->toJsonData( 200, 'success', $d );
         }else {
            echo $main->toJsonData( 403, 'Không tìm thấy thông tin chuyển khoản này', null );
        }
        unset( $d );
    }else{
        echo $main->toJsonData( 403, 'Không tìm thấy phiên đăng nhập này, vui lòng đăng nhập lại.',  null );
    }

});