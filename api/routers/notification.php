<?php
/*
- Những vị trị cần đăng ký topics:

1. topics => đăng nhập là đăng ký topic tổng
2. topics/product_[product_id] => khi mua một sản phẩm đăng ký topic
3. topics/username_[username] => khi đăng nhập là đăng ký topic cá nhân này

*/

//get list of notification by
$app->post('/notification/list', function () use ( $app, $dInvestor, $main, $notification, $setup ) {
	
	$username   = $dInvestor['username'];
	$page       = $app->request()->post('page');

	if( $page < 1 ) $page = 1;
	$ofset = ($page-1)*$setup['perpage'];
    
	$notification->set('to', $username );
	$kq['list'] = $notification->list_all_by_user( $ofset, $setup['perpage'] );
	$kq['total'] = $notification->list_all_by_user_count();

	echo $main->successJsonData( $kq );
	unset( $kq );

});

//get detail notification
$app->post('/notification/detail', function () use ( $app,  $dInvestor, $main, $notification, $setup ) {
	
	$id             = $app->request()->post('id');
	$username   	= $dInvestor['username'];
	
	$notification->set('id', $id);
	$dNoti = $notification->get_detail();
	
	if( isset($dNoti['id']) ){

		if( !strpos( $dNoti['read_status'], $username.';' ) ){
			$notification->set('id', $id);
			$read_status 	= $dNoti['read_status'].$username.';';
			$notification->set('read_status', $read_status );
			$notification->update_read();
		}
		
		// $dNoti['content']	= str_replace('  ', '', strip_tags($dNoti['content']));
		
		echo $main->successJsonData( $dNoti );
		unset( $dNoti );
	}else{
		echo $main->failJsonData( $lang['lb_notFoundImage'] );
	}
	
});

//get detail notification
$app->post('/notification/unread', function () use ( $app, $dInvestor, $main, $notification, $setup ) {
	$username   	= $dInvestor['username'];

	$unread = $notification->count_un_read( $username );
	echo $main->successJsonData( $unread );
	unset( $unread );
	
});

//delete notification by user
$app->post('/notification/delete', function () use ( $app, $dInvestor, $main, $notification, $setup ) {
    $id             = $app->request()->post('id');
	$username   	= $dInvestor['username'];

	$notification->set('id', $id);
	$notification->delete_notification( $username );
	
	echo $main->successJsonData();
});
