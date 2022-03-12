<?php

//danh sách BDS đang treo bán
$app->post('/selling/list', function () use ( $app, $selling, $main, $user, $setup ) {

	$province_id    = $app->request()->post('province_id');
    $city_id        = $app->request()->post('city_id');
    
	$keyword        = $app->request()->post('keyword');
	$page           = $app->request()->post('page');
    
    if( $page < 1 ) $page = 1;

    $limit = $setup['perpage'];
    $ofset = ($page - 1)*$limit;

    $selling->set('province_id', $province_id);
    $selling->set('city_id', $city_id);
    
    $kq['lItems']   = $selling->market( $keyword, $ofset, $limit );
    $kq['total']    = $selling->market_count( $keyword );
    
    echo $main->toJsonData( 200, 'success', $kq );

    unset( $kq );

});