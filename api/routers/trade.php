<?php

//danh sách BDS đang treo bán
$app->post('/trade/market', function () use ( $app, $trade, $main, $user, $setup ) {

	$keyword     	= $app->request()->post('keyword');
	$page          = $app->request()->post('page');

	if( $page < 1 ) $page = 1;

	$limit = $setup['perpage'];
	$ofset = ($page - 1)*$limit;

	$kq['lItems']   = $trade->market( $keyword, $ofset, $limit );
	$kq['total']    = $trade->market_count( $keyword );

	echo $main->toJsonData( 200, 'success', $kq );
	unset( $kq );

});

//Lịch sử BDS đã treo của investor
$app->post('/trade/history', function () use ( $app, $dInvestor, $trade, $main, $user, $setup ) {
	$page         = $app->request()->post('page')+0;

	if( $page < 1 ) $page = 1;
	$limit = $setup['perpage'];
	$ofset = ($page - 1)*$limit;

	$trade->set( 'investor_id', $dInvestor['id'] );
	$kq['lItems'] = $trade->list_history( $ofset, $limit );
	$kq['total'] = $trade->list_history_count();
	
	echo $main->toJsonData( 200, 'success', $kq );

	unset( $kq );
});

//Mua BDS đang treo
/*
- Ko được mua của chính mình
- Số lượng mua phải còn lại tối thiếu
*/
$app->post('/trade/buy', function () use ( $app, $dInvestor, $product_history, $trade, $province, $main, $user ) {

	$trade_id         				= $app->request()->post('trade_id');
	$cyclos_transaction_id         	= $app->request()->post('cyclos_transaction_id');
	$amount           				= $app->request()->post('amount', 'number');
	
	$trade->set('id', $trade_id );
	$dT = $trade->get_detail();
	if( !isset($dT['id']) || $dT['status'] != 0 ){
		echo $main->toJsonData( 403, 'Giao dịch không tồn tại.', null );
	}else{

		$status_code             = 403;
		$result = $api->exeAPIAdmin( 'GET', '/transactions/'.$cyclos_transaction_id, '', $status_code );

		if( $status_code != 200 ){
			if( $status_code == 401 ){
				echo $main->toJsonData( 403, 'Lỗi! Không tìm thấy thông tin của giao dịch chuyển khoản #'.$cyclos_transaction_id.'.', null );
			}else{
				echo $main->toJsonData( 403, 'Lỗi! Thông tin của giao dịch chuyển khoản #'.$cyclos_transaction_id.' không đúng.', null );
			}
		}else{
			//thực hiện chuyển suất:
			$data = json_decode($result, true);

			if( !$data ){
				echo $main->toJsonData( 403, 'Lỗi! Dữ liệu giao dịch không đúng định dạng.', null );
			}else{
				if(
					 isset($data['fromUser']['shortDisplay']) && $data['fromUser']['shortDisplay'] == $dT['username']
					 && isset($data['toUser']['shortDisplay']) && $data['toUser']['shortDisplay'] == $dInvestor['username']
					 && $data['amount'] == ( $dT['amount']*$dT['price'] )
					 && substr($data['date'], 0, 10 ) == date('Y-m-d')
				 ){

					//Thực hiện chuyển suất cho người mua
					$available_dT = $dT['amount'] - $dT['sold'];//số lượng available tại record trade này thôi
					if( $amount < 0 || $amount > $available_dT ){
						echo $main->toJsonData( 403, 'Số lượng cần mua không hợp lệ.', null );
					}else{

						$product_history->set('product_id', $dT['product_id'] );
						$product_history->set('username', $dT['username'] );
						$available_of_user = $product_history->summary_bought_available();//avilable of username

						if( $amount <= $available_of_user ){// double check amount much <= available of the user

							$trade->set('id', $trade_id );
							$trade->set('sold', $dT['sold'] + $amount );
							$trade->update_sold();

							//thực hiện hủy item của thằng bán + cập nhật lại số lượng hủy ( có thể phải xử lý trên nhiều giao dịch của thằng user bán này )
							$product_history->set('username', $dT['username']);
							$product_history->set('product_id', $dT['product_id']);
							$lAvailable = $product_history->list_bought_available_by_id_and_investor();
							
							$left_amount = $amount;
							foreach ( $lAvailable as $key => $it ) {
								if( $left_amount > 0 ){
									if(  $left_amount >= $it['slots'] ){
										//Delete record product sold history

										$product_history->set('id', $it['id']);
										$product_history->set('cyclos_transaction_id_principal', '');
										$product_history->update_delete_transaction();
										
										$left_amount = $left_amount - $it['slots'];
									}else{
										//Update record product sold history
										//tạo record xóa với thông tin từ record mẹ: sau khi refund
										$product_history->set('cyclos_transaction_id_principal', '');
										$product_history->set('product_id', $it['product_id'] );
										$product_history->set('username', $it['username'] );
										$product_history->set('fullname', $it['fullname'] );
										$product_history->set('price', $it['price'] );
										$product_history->set('slots', $left_amount );// tổng số trả nhưng lại nhỏ hơn nên hủy rồi thêm cho ng mua
										$product_history->set('cyclos_transaction_id', $it['id'] );
										$product_history->add_cancel_record();//tạo ra record xóa/ hủy

										//cập nhật lại số lượng của record xóa: sau khi refund
										$product_history->set('id', $it['id']);
										$product_history->set('slots', $it['slots'] - $left_amount );
										$product_history->update_slots_transaction();

										$left_amount = 0;
									}
								}
							}

							//Không cần thực hiện trừ mà chỉ trừ dựa trên giao diện app
							//Trừ tiền của thằng mua bằng với số lượng tiền $amount*$dT['price] vào tk thằng bán

							//Tạo 1 giao dịch với số lượng đã hủy ở trên cho thằng mua
							$product_history->set('product_id', $dT['product_id'] );
							$product_history->set('username', $dInvestor['username'] );
							$product_history->set('fullname', $dInvestor['fullname'] );
							$product_history->set('price', $dT['price'] );
							$product_history->set('slots', $amount );
							$product_history->set('cyclos_transaction_id', $cyclos_transaction_id );
							$product_history->set('total', $dT['price']*$amount );
							$product_history->add();

							echo $main->toJsonData( 200, 'success', null );
						}else{
							echo $main->toJsonData( 403, 'Số lượng bán còn lại không đủ.', null );
						}
					}

				}else{
					echo $main->toJsonData( 403, 'Lỗi! Giao dịch chuyển khoản không hợp lệ.', null );
				}
			}
		}

	}
	
});

//Treo bán BDS
/*

*/
$app->post('/trade/sell', function () use ( $dInvestor, $trade, $product_history, $app, $province, $main, $user ) {

	$product_id     = $app->request()->post('product_id');
	$amount         = $app->request()->post('amount');//amount to sell
	$price          = $app->request()->post('price');//Giá muốn bán
	$note           = $app->request()->post('note');//Ghi chú
	$contact_name   = $app->request()->post('contact_name');//Tên liên lạc
	$contact_mobile = $app->request()->post('contact_mobile');//Số điện thoại liên lạc
	
	$product_history->set('product_id', $product_id);
	$product_history->set('username', $dInvestor['username']);
	$available = $product_history->summary_bought_available();

	$trade->set('product_id', $product_id);
	$trade->set('username', $dInvestor['username']);
	$slots_on_order = $trade->sum_selling();//tổng đang bán
	$available -= $slots_on_order;

	if( $amount > 0 ){
		if( $available > 0 ){
			if( $amount <= $available ){

				$trade->set('investor_id', $dInvestor['id']);
				$trade->set('username', $dInvestor['username']);
				$trade->set('product_id', $product_id);
				$trade->set('amount', $amount);
				$trade->set('price', $price);
				$trade->set('note', $note);
				$trade->set('contact_name', $contact_name);
				$trade->set('contact_mobile', $contact_mobile);
				$id = $trade->add();

				$trade->set('id', $id);
				$d = $trade->get_detail();

				echo $main->toJsonData( 200, 'success', $d );
				unset( $d );

			}else{
				echo $main->toJsonData( 403, 'Số lượng còn lại không đủ để đăng bán. Bạn chỉ còn '.$available.' suất.', null );
			}
		}else{
			echo $main->toJsonData( 403, 'Bạn không còn suất để bán.', null );
		}
	}else{
		echo $main->toJsonData( 403, 'Số lượng cần bán tối thiểu là 1.', null );
	}
	
});

//Hủy bán BDS
/*

*/
$app->post('/trade/cancel', function () use ( $dInvestor,  $trade, $app, $province, $main, $user ) {

	$trade_id          = $app->request()->post('trade_id');
    
    $trade->set('id', $trade_id );
    $d = $trade->get_detail();

    if( isset($d['id']) && $d['status'] == 0 ){

        if( $d['investor_id'] == $dInvestor['id'] ){
            
            $trade->cancel();

            echo $main->toJsonData( 200, 'success', null );
        }else{
            echo $main->toJsonData( 403, 'Bạn không được phép hủy giao dịch này.', null );
        }

    }else{
        echo $main->toJsonData( 403, 'Không tìm thấy tin đăng', null );
    }

});

//chi tiết bán BDS
/*

*/
$app->post('/trade/detail', function () use ( $dInvestor,  $trade, $app, $province, $main, $user ) {

	$trade_id          = $app->request()->post('trade_id');
    
    $trade->set('id', $trade_id );
    $d = $trade->get_detail();
	
    if( isset($d['id']) ){
		echo $main->toJsonData( 200, 'success', $d );
    }else{
        echo $main->toJsonData( 403, 'Không tìm thấy tin đăng', null );
    }

});

//Danh sách BDS đang có
/*

*/
$app->post('/trade/assets', function () use ( $dInvestor, $product_history, $app, $province, $main, $user ) {

	$product_history->set('username', $dInvestor['username']);
	$l = $product_history->list_asset();
	echo $main->toJsonData( 200, 'success', $l );
	unset( $l );
	
});