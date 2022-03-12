<?php
//Chuyển khoản qua lai
/*

*/
$app->post('/transfer/add', function () use ( $dInvestor, $trade, $transfer, $product_history, $app, $province, $main, $user ) {

	$to_investor_username     	= $app->request()->post('to_investor_username');
	$to_investor_name     		= $app->request()->post('to_investor_name');
	$product_id     			= $app->request()->post('product_id');
	$amount         			= $app->request()->post('amount', 'number');//amount to sell
	$price          			= $app->request()->post('price', 'number');//Giá muốn bán
	$note           			= $app->request()->post('note');//Ghi chú
    
    //Tổng số suất đầu tư đang có
	$product_history->set('product_id', $product_id);
	$product_history->set('username', $dInvestor['username']);
	$available = $product_history->summary_bought_available();

    //Tống số suất đang treo bán
	$trade->set('product_id', $product_id);
	$trade->set('username', $dInvestor['username']);
	$slots_on_order = $trade->sum_selling();//tổng đang bán
    $available -= $slots_on_order;
    
    //Tổng đang pending transfer
    $transfer->set('product_id', $product_id);
	$transfer->set('to_investor_username', $dInvestor['username']);
	$slots_on_pending = $transfer->sum_pending();//tổng đang bán
    $available -= $slots_on_pending;
	
	if( $amount > 0 ){
		if( $available > 0 ){
			if( $amount <= $available ){

				$transfer->set('product_id', $product_id);
				$transfer->set('from_investor_username', $dInvestor['username']);
				$transfer->set('from_investor_name', $dInvestor['fullname']);
				$transfer->set('amount', $amount);
				$transfer->set('price', $price);
				$transfer->set('note', $note);
				$transfer->set('to_investor_username', $to_investor_username );
				$transfer->set('to_investor_name', $to_investor_name );
				$id = $transfer->add();

				$transfer->set('id', $id);
				$d = $transfer->get_detail();

				echo $main->toJsonData( 200, 'success', $d );
				unset( $d );

			}else{
				echo $main->toJsonData( 403, 'Số lượng còn lại không đủ để chuyển cho người dùng khác. Bạn chỉ còn '.$available.' suất.', null );
			}
		}else{
			echo $main->toJsonData( 403, 'Bạn không còn suất để chuyển.', null );
		}
	}else{
		echo $main->toJsonData( 403, 'Số lượng cần chuyển tối thiểu là một.', null );
	}
	
});


//Chuyển khoản qua lại các suất
/*

*/
$app->post('/transfer/completed', function () use ( $dInvestor, $trade, $transfer, $product_history, $app, $api, $main, $user ) {

	$transfer_id                    = $app->request()->post('transfer_id');
	$cyclos_transaction_id          = $app->request()->post('cyclos_transaction_id');
	$cylos_note          			= $app->request()->post('cylos_note');

	$transfer->set('id', $transfer_id);
	$dTrans = $transfer->get_detail();
	
	if( !isset( $dTrans['id'] ) || $dTrans['status'] ){
		echo $main->toJsonData( 403, 'Giao dịch này không tồn tại.', null );
	}else{
		//kiểm tra transaction cyclos đã có không hoặc đã hoàn thành không rồi mới tiến hành chuyển suất
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
					 isset($data['fromUser']['shortDisplay']) && $data['fromUser']['shortDisplay'] == $dTrans['from_investor_username']
					 && isset($data['toUser']['shortDisplay']) && $data['toUser']['shortDisplay'] == $dTrans['to_investor_username']
					 && $data['amount'] == ( $dTrans['amount']*$dTrans['price'] )
					 && substr($data['date'], 0, 10 ) == date('Y-m-d')
				 ){

					//thực hiện hủy item của thằng bán + cập nhật lại số lượng hủy ( có thể phải xử lý trên nhiều giao dịch của thằng user bán này )
					$product_history->set('username', $dTrans['from_investor_username']);
					$product_history->set('product_id', $dTrans['product_id']);
					$lAvailable = $product_history->list_bought_available_by_id_and_investor();
					
					$left_amount = $dTrans['amount'];
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

					$transfer->set( 'id', $transfer_id);
					$transfer->set( 'cyclos_transaction_id', $cyclos_transaction_id);
					$transfer->set( 'cylos_note', $cylos_note);
					$transfer->update_done();

					echo $main->toJsonData( 200, 'success', null );

				 }else{
					echo $main->toJsonData( 403, 'Lỗi! Giao dịch chuyển khoản không không hợp lệ.', null );
				 }
			}
		}
		
	}
	
});


//lịch sử giao dịch
$app->post('/transfer/history', function () use ( $dInvestor, $trade, $transfer, $product_history, $app, $main, $user ) {
	
	$status        = $app->request()->post('status');//=0;==1==-1==""
	$type          = $app->request()->post('type');//sender; reciever

	$transfer->set( 'to_investor_username', $dInvestor['username'] );
	$transfer->set( 'status', $status );
	$l = $transfer->list_history( $type );
	
	echo $main->toJsonData( 200, 'success', $l );

});
