<?php

$app->post('/city/add', function () use ( $app, $city, $main, $user ) {

	$name           = $app->request()->post('name');
	$province_id    = $app->request()->post('province_id');
	$priority       = $app->request()->post('priority');
	$created_by     = $app->request()->post('created_by');
	
	$city->set( 'name', $name );
	$city->set( 'province_id', $province_id );
	$city->set( 'priority', $priority );
	$city->set( 'created_by', $created_by );

	$dItem = $city->get_detail_by_name();
	if( !isset($dItem['id']) ){
		$city->add();
		echo $main->toJsonData( 200, 'success', null );
	}else{
		echo $main->toJsonData( 403, 'Tên này đã tồn tại.', null );
	}
	
});

$app->post('/city/list_by', function () use ( $app, $city, $main, $user ) {
	$province_id    = $app->request()->post('province_id');
	
	$city->set( 'province_id', $province_id );
	$lItems = $city->list_by();

	array_unshift($lItems, array("id"=>"", "name"=>"Quận/ Huyện", "province_id"=>"$province_id", "deleted"=>"0", "priority"=>"0", "created_by"=>"1"));
	echo $main->toJsonData( 200, 'success', $lItems );

	unset( $lItems );
});
