<?php

$app->post('/province/add', function () use ( $app, $province, $main, $user ) {

	$name           = $app->request()->post('name');
	$priority       = $app->request()->post('priority');
	$created_by     = $app->request()->post('created_by');
	
	$province->set( 'name', $name );
	$province->set( 'priority', $priority );
	$province->set( 'created_by', $created_by );
	
	$dItem = $province->get_detail_by_name();
	if( !isset($dItem['id']) ){
		$province->add();
		echo $main->toJsonData( 200, 'success', null );
	}else{
		echo $main->toJsonData( 403, 'Tên này đã tồn tại.', null );
	}
	
});

$app->post('/province/all', function () use ( $app, $province, $main, $user ) {
    
	$lItems = $province->list_all();
	
	array_unshift($lItems, array("id"=>"", "name"=>"Tỉnh/ Thành Phố", "deleted"=>"0", "priority"=>"0", "created_by"=>"1"));
	echo $main->toJsonData( 200, 'success', $lItems );

	unset( $lItems );
});

$app->post('/province/all_city', function () use ( $app, $province, $city, $main, $user ) {
    
	$lProvince = $province->list_all();
	foreach ($lProvince as $key => $item) {
		$city->set('province_id', $item['id']);
		$lProvince[$key]['lCity'] = $city->list_by();
	}
	
	echo $main->toJsonData( 200, 'success', $lProvince );
	unset( $lProvince );
	
});
