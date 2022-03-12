<?php

$app->post('/products/add', function () use ( $app, $product, $main, $user ) {

	$code    			= $app->request()->post('code');
	$province_id    	= $app->request()->post('province_id');
	$city_id        	= $app->request()->post('city_id');
	$title        		= $app->request()->post('title');
	$description        = $app->request()->post('description');
	$price        		= $app->request()->post('price');
	$slots_sold        		= $app->request()->post('slots_sold');
	$slots_total        = $app->request()->post('slots_total');
	$price_sold        	= $app->request()->post('price_sold');
	$fee_total        	= $app->request()->post('fee_total');
	$fee_detail        	= $app->request()->post('fee_detail');
	$images        		= $app->request()->post('images');
	$receive_fund_account 	= $app->request()->post('receive_fund_account');
	$receive_fund_fullname 	= $app->request()->post('receive_fund_fullname');
	$created_by        	= $app->request()->post('created_by');

	$price				= $main->number('price');
	$slots_total		= $main->number('slots_total');
	$price_sold			= $main->number('price_sold');
	$fee_total			= $main->number('fee_total');

	$product->set( 'code', $code );
	$product->set( 'province_id', $province_id );
	$product->set( 'city_id', $city_id );
	$product->set( 'title', $title );
	$product->set( 'description', $description );
	$product->set( 'price', $price );
	$product->set( 'slots_sold', $slots_sold );
	$product->set( 'slots_total', $slots_total );
	$product->set( 'price_sold', $price_sold );
	$product->set( 'fee_total', $fee_total );
	$product->set( 'fee_detail', $fee_detail );
	$product->set( 'images', $images );
	$product->set( 'receive_fund_account', $receive_fund_account );
	$product->set( 'receive_fund_fullname', $receive_fund_fullname );
	$product->set( 'created_by', $created_by );

	$dProduct = $product->get_detail_by_code();
	if( !isset($dProduct['id']) ){
		$product->add();
		echo $main->toJsonData( 200, 'success', null );
	}else{
		echo $main->toJsonData( 403, 'Mã sản phẩm này đã tồn tại.', null );
	}
	
});

$app->post('/products/update', function () use ( $app, $product, $main, $user ) {

	$id    				= $app->request()->post('id');
	$code    			= $app->request()->post('code');
	$province_id    	= $app->request()->post('province_id');
	$city_id        	= $app->request()->post('city_id');
	$title        		= $app->request()->post('title');
	$description        = $app->request()->post('description');
	$price        		= $app->request()->post('price');
	$slots_sold        		= $app->request()->post('slots_sold');
	$slots_total        = $app->request()->post('slots_total');
	$slots_sold        	= $app->request()->post('slots_sold');
	$price_sold        	= $app->request()->post('price_sold');
	$ROI        		= $app->request()->post('ROI');
	$status        		= $app->request()->post('status');
	$fee_total        	= $app->request()->post('fee_total');
	$fee_detail        	= $app->request()->post('fee_detail');
	$images        		= $app->request()->post('images');
	$receive_fund_account 	= $app->request()->post('receive_fund_account');
	$receive_fund_fullname 	= $app->request()->post('receive_fund_fullname');
	$created_by        	= $app->request()->post('created_by');
	
	$price				= $main->number('price');
	$slots_total		= $main->number('slots_total');
	$slots_sold			= $main->number('slots_sold');
	$price_sold			= $main->number('price_sold');
	$fee_total			= $main->number('fee_total');

	$product->set( 'id', $id );
	$product->set( 'code', $code );
	$product->set( 'province_id', $province_id );
	$product->set( 'city_id', $city_id );
	$product->set( 'title', $title );
	$product->set( 'description', $description );
	$product->set( 'price', $price );
	$product->set( 'slots_sold', $slots_sold );
	$product->set( 'slots_total', $slots_total );
	$product->set( 'slots_sold', $slots_sold );
	$product->set( 'price_sold', $price_sold );
	$product->set( 'ROI', 	$ROI );
	$product->set( 'status', 	$status);
	$product->set( 'fee_total', $fee_total );
	$product->set( 'fee_detail', $fee_detail );
	$product->set( 'images', $images );
	$product->set( 'receive_fund_account', $receive_fund_account );
	$product->set( 'receive_fund_fullname', $receive_fund_fullname );
	$product->set( 'created_by', $created_by );

	$dProduct = $product->get_detail();
	if( isset($dProduct['id']) ){
		$product->update();
		echo $main->toJsonData( 200, 'success', null );
	}else{
		echo $main->toJsonData( 403, 'Mã sản phẩm này đã tồn tại.', null );
	}
	
});

//Những sản phẩm đã đầu tư
$app->post('/products/invested/list', function () use ( $app, $dInvestor, $product, $main, $user ) {

	$username      	= $dInvestor['username'];
	$status        	= $app->request()->post('status'); // status = 0 chờ bán; status =1 đã bán;
	$page      		= $app->request()->post('page'); //Phân trang
	
	if( $page < 1 ) $page = 1;

	$limit = 200;
	$ofset = ($page -1 )*$limit;

	$product->set( 'username', $username );
	$product->set( 'status', $status );
	$l = $product->list_invested( $ofset, $limit );

	echo $main->toJsonData( 200, 'success', $l );
	unset( $lItems );

});

$app->post('/products/list', function () use ( $app, $product, $main, $user ) {
	$province_id    = $app->request()->post('province_id');
	$city_id        = $app->request()->post('city_id');
	$keyword        = $app->request()->post('keyword');
	
	$product->set( 'province_id', $province_id );
	$product->set( 'city_id', $city_id );
	$product->set( 'status', 0 );
	$lItems = $product->list_by_client( $keyword, '', '' );

	echo $main->toJsonData( 200, 'success', $lItems );

	unset( $lItems );
	
});

$app->post('/products/detail', function () use ( $app, $product, $main, $user ) {
	$id    = $app->request()->post('product_id');

	$product->set( 'id', $id );
	$dItem = $product->get_detail();
	if( isset($dItem['id']) ){
		$dItem['images'] = explode( ';', $dItem['images']);
		unset($dItem['images'][COUNT($dItem['images'])-1]);
		echo $main->toJsonData( 200, 'success', $dItem );
	}else{
		echo $main->toJsonData( 403, 'Không tìm thấy sản phẩm này.', null );
	}

});

//user mua số lượng slots đầu tư
$app->post('/products/sell', function () use ( $app, $dInvestor, $product, $product_history, $notification, $main, $user ) {

	$username      	= $dInvestor['username'];
	$fullname    	= $dInvestor['fullname'];

	$id    			= $app->request()->post('product_id');
	$slots    		= $app->request()->post('slots');
	$cyclos_transaction_id    = $app->request()->post('cyclos_transaction_id');
	$slots			= $main->number( $slots )+0;

	if( $slots > 0 ){
		$product->set( 'id', $id );
		$dItem = $product->get_detail();
		if( isset($dItem['id']) ){
			//ghi vào lịch sử và trừ số lượng đã mua

			if( ($dItem['slots_total'] - $dItem['slots_sold']) >= $slots ){

				$product_history->set('product_id', $id );
				$product_history->set('username', $username );
				$product_history->set('fullname', $fullname );
				$product_history->set('price', $dItem['price'] );
				$product_history->set('slots', $slots );
				$product_history->set('cyclos_transaction_id', $cyclos_transaction_id );
				$product_history->set('total', $dItem['price']*$slots );
				$product_history->add();

				$product->set( 'id', $id );
				$product->set( 'slots_sold', $dItem['slots_sold']+$slots );
				$product->update_slots_sold();

				$subject = 'Đầu tư thành công';
				$content = 'Bạn đã đầu tư thành công '.$slots.' suất vào '.$dItem['title'];
				$notification->set('to', $dInvestor['username'].';');
				$notification->set('subject', $subject );
				$notification->set('content', $content);
				$notification->set('created_by', 0);
				$notification->set('force_read', 0);
				$notification_id = $notification->add();

				$p['to'] = '/topics/username_'.$dInvestor['username'];
				$p['priority']  = 'high';
				$p['notification_id']  = $notification_id;
				$ii['title']  = $subject;
				$ii['body']   = $content;
				$p['notification'] = $ii;
				$main->sendFCM( $p );
				
				echo $main->toJsonData( 200, 'success', null );
				
			}else{
				echo $main->toJsonData( 403, 'Bạn đang mua vượt quá số lượng còn lại là '.($dItem['slots_total'] - $dItem['slots_sold']).'.', null );
			}

		}else{
			echo $main->toJsonData( 403, 'Không tìm thấy sản phẩm này.', null );
		}
	}else{
		echo $main->toJsonData( 403, 'Số lượng mua phải lớn hơn không.', null );
	}

});


$app->post('/products/history', function () use ( $app, $product_history, $main, $user ) {

	$product_id    			= $app->request()->post('product_id');
	
	$product_history->set( 'product_id', $product_id );
	$lItems = $product_history->list_by();

	echo $main->toJsonData( 200, 'success', $lItems );
	unset( $lItems );

});

$app->post('/products/bought', function () use ( $app, $dInvestor, $product_history, $main, $user ) {

	$username      	= $dInvestor['username'];

	$product_history->set('username', $username );
	
	$l = $product_history->list_bought();

	echo $main->toJsonData( 200, 'success', $l  );

	unset( $l );

});

$app->post('/products/suggest', function () use ( $app, $dInvestor, $product_suggest, $main, $user ) {

	$username    			= $dInvestor['username'];
	$fullname    			= $dInvestor['fullname'];
	$address    			= $app->request()->post('address');
	$price    				= $app->request()->post('price');
	$mobile    				= $app->request()->post('mobile');
	$province_id    		= $app->request()->post('province_id');
	$images    				= $app->request()->post('images');//img1;img2;
	$description    		= $app->request()->post('description');
	
	$product_suggest->set('username', $username);
	$product_suggest->set('fullname', $fullname);
	$product_suggest->set('address', $address);
	$product_suggest->set('price', $price);
	$product_suggest->set('mobile', $mobile);
	$product_suggest->set('province_id', $province_id);
	$product_suggest->set('images', $images);
	$product_suggest->set('images', $images);
	$product_suggest->set('description', $description);
	$product_suggest->add();

	echo $main->toJsonData( 200, 'success', null  );

	unset( $l );

});

$app->post('/products/upload_photo', function () use ( $app, $main, $dInvestor, $domain, $lang, $setup ) {

	$img = $app->request()->post( 'img' );
	if( $img != '' ){
		$img = base64_decode( $img );

		// header('Content-Type: bitmap; charset=utf-8');
		$app->response()->header('Content-Type', 'bitmap; charset=utf-8');

		if ( !file_exists( '../uploads/order_photo/'.$dInvestor['id'].'/'.date('Y-m-d') ) ) {
			//tạo thư mục chứa file trên server
			@mkdir('../uploads/order_photo/'.$dInvestor['id'].'/'.date('Y-m-d'), 0777, true);
		}
		$url_file = '/uploads/order_photo/'.$dInvestor['id'].'/'.date("Y-m-d").'/'.$dInvestor['id'].'-'.date("His").'-'.rand(1,100).'.jpg';
		$link_f = '..'.$url_file;
		$file = fopen( $link_f, 'w');
		fwrite($file, $img);
		fclose($file);
		
		$app->response()->header('Content-Type', 'application/json; charset=utf-8');
		
		$img = $domain.$url_file;
		$kq['url'] = $img;
		echo $main->successJsonData( $kq );
		
		unset( $kq );
	}else{
		echo $main->successJsonData( 'Không có dữ liệu' );
	}
	
});