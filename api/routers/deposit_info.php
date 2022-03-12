<?php


//Tạo đạt cọc
$app->post('/deposit_info/add', function () use ( $app, $api, $deposit_info, $dInvestor, $investor, $setup, $notification, $main) {
    
	$value              = $app->request()->post('value', 'number');
	$type               = $app->request()->post('type');//== 0 cọc; == 1 mua
	$transaction_id     = $app->request()->post('transaction_id');
	$note               = $app->request()->post('note');
    $object             = $app->request()->post('object');//string
    
    $arrObj = json_decode($object, true);
    
    if( $arrObj ){

        $deposit_info->set('type', $type );
        $deposit_info->set('value', $value );
        $deposit_info->set('investor_id', $dInvestor['id'] );
        $deposit_info->set('username', $dInvestor['username'] );
        $deposit_info->set('fullname', $dInvestor['fullname'] );
        $deposit_info->set('web_product_id', $arrObj['id'] );
        $deposit_info->set('name', $arrObj['name'] );
        $deposit_info->set('transaction_id', $transaction_id );
        $deposit_info->set('note', $note );
        $deposit_info->set('link', $arrObj['link'] );
        $deposit_info->set('object', $object );
        
        $id = $deposit_info->add();

        echo $main->toJsonData( 200, 'success', $id );
    }else{
        echo $main->toJsonData( 403, 'Sản phẩm không đúng định dạng.', null );
    }
});

//Danh sách cọc
$app->post('/deposit_info/history', function () use ( $app, $api, $deposit_info, $dInvestor, $investor, $setup, $notification, $main) {
    $investor_id = $dInvestor['id'];

	$keyword     = $app->request()->post('keyword');

    $deposit_info->set('investor_id', $investor_id);
    $l = $deposit_info->list_by_investor( $keyword );

    echo $main->toJsonData( 200, 'success', $l );

});