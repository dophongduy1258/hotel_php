<?php
$app->post('/transaction/deposit', function () use ( $app, $dInvestor, $transaction_funding, $main, $user ) {
    
    $username                   = $dInvestor['username'];//Tài khoản nạp
    $fullname                   = $dInvestor['fullname'];//
    
	$bank_code                  = $app->request()->post('bank_code');
	$bank_name                  = $app->request()->post('bank_name');
	$bank_account               = $app->request()->post('bank_account');
	$bank_account_name          = $app->request()->post('bank_account_name');
	$amount                     = $app->request()->post('amount');//số lượng nạp
    $branch                     = $app->request()->post('branch');//
    $note                       = $app->request()->post('note');//
	$cyclos_transaction_id      = $app->request()->post('cyclos_transaction_id');//
    
    $transaction_funding->set('bank_code', $bank_code);
    $transaction_funding->set('bank_name', $bank_name);
    $transaction_funding->set('bank_account', $bank_account);
    $transaction_funding->set('bank_account_name', $bank_account_name);
    $transaction_funding->set('amount', $main->number($amount));
    $transaction_funding->set('username', $username);
    $transaction_funding->set('fullname', $fullname);
    $transaction_funding->set('branch', $branch);
    $transaction_funding->set('note', $note);
    $transaction_funding->set('cyclos_transaction_id', $cyclos_transaction_id);
    $transaction_funding->set('type', 'deposit');
    $id = $transaction_funding->add();

    $transaction_funding->set('id', $id );
    $dTrans = $transaction_funding->get_detail();
    
    echo $main->toJsonData( 200, 'success', $dTrans );
    unset( $dTrans );
    
});

$app->post('/transaction/withdraw', function () use ( $app, $dInvestor, $transaction_funding, $main, $user ) {
    
    $username                   = $dInvestor['username'];//Tài khoản nạp
    $fullname                   = $dInvestor['fullname'];//

	$bank_code                  = $app->request()->post('bank_code');
	$bank_name                  = $app->request()->post('bank_name');
	$bank_account               = $app->request()->post('bank_account');
	$bank_account_name          = $app->request()->post('bank_account_name');
	$amount                     = $app->request()->post('amount');//số lượng nạp
	$branch                     = $app->request()->post('branch');//
	$note                       = $app->request()->post('note');//
	$cyclos_transaction_id      = $app->request()->post('cyclos_transaction_id');//
    
    $transaction_funding->set('bank_code', $bank_code);
    $transaction_funding->set('bank_name', $bank_name);
    $transaction_funding->set('bank_account', $bank_account);
    $transaction_funding->set('bank_account_name', $bank_account_name);
    $transaction_funding->set('amount', $main->number($amount));
    $transaction_funding->set('username', $username);
    $transaction_funding->set('fullname', $fullname);
    $transaction_funding->set('branch', $branch);
    $transaction_funding->set('note', $note);
    $transaction_funding->set('cyclos_transaction_id', $cyclos_transaction_id);
    $transaction_funding->set('type', 'withdraw');
    $id = $transaction_funding->add();
    
    $transaction_funding->set('id', $id );
    $dTrans = $transaction_funding->get_detail();
    
    echo $main->toJsonData( 200, 'success', $dTrans );
    unset( $dTrans );
    
});

$app->post('/transaction/cancel', function () use ( $app, $dInvestor, $transaction_funding, $main, $user ) {
    
    $id   = $app->request()->post('id');
    
    $transaction_funding->set('id', $id);
    $d = $transaction_funding->get_detail();
    
    if( isset($d['id']) && $d['username'] == $dInvestor['username'] ){
        if( $d['status'] == 0 ){
            if( $d['type'] == 'withdraw' ){
                
                // thực hiện lệnh topup tiền lên trong hệ thống
                $status                 = 403;
                $post['amount']         = $d['amount'];
                $post['description']    = 'Trả lại tiền, lệnh rút  #HD'.$d['id'].' bị hủy: '.$d['note'];
                $post['subject']        = $d['username'];//user nhận fund
                $result = $api->exeAPIPayment( $setup['cyclos_payment_type_for_deposit'], $post, $status );
                
                if( $status == 201 ){
                    $data = json_decode( $result, true );
                    if( $data ){

                        $transaction_funding->set( 'id', $id );
                        $transaction_funding->set( 'approved_by', $dUserLogin['id'] );
                        $transaction_funding->set( 'cyclos_transaction_id', $data['transactionNumber']);
                        $transaction_funding->cancel();
                        
                        echo 'done##',$main->toJsonData( 200, 'success', null );
                    }else{
                        echo 'done##',$main->toJsonData( 403, 'Lỗi thực hiện parse dữ liệu, vui lòng kiểm tra.', $data );
                    }

                }else{
                    echo 'done##',$main->toJsonData( 403, 'Lỗi thực hiện thanh toán, vui lòng kiểm tra.', $result );
                }

            }else if( $d['type'] == 'deposit' ){

                $transaction_funding->cancel();
                echo $main->toJsonData( 200, 'success', null );
                unset( $dTrans );

            }else{
                echo $main->toJsonData( 403, 'Không xác định được loại giao dịch.', null );
            }
            
        }else if( $d['status'] == -1 ){
            echo $main->toJsonData( 403, 'Giao dịch đã được hủy.', null );
        }else{
            echo $main->toJsonData( 403, 'Giao dịch đã hoàn thành không thể được hủy.', null );
        }
    }else{
        echo $main->toJsonData( 403, 'Bạn không được quyền hủy giao dịch này, vì nó không thuộc về bạn.', null );
    }
    
});

$app->post('/transaction/detail', function () use ( $app, $dInvestor, $transaction_funding, $main, $user ) {
    
    $id   = $app->request()->post('id');
    
    $transaction_funding->set('id', $id);
    $d = $transaction_funding->get_detail();

    if( isset($d['id']) && $d['username'] == $dInvestor['username'] ){
        echo $main->toJsonData( 200, 'success', $d );
        unset( $d );
    }else{
        echo $main->toJsonData( 403, 'Bạn không được quyền truy cập giao dịch này, vì nó không thuộc về bạn.', null );
    }
    
    
});

$app->post('/transaction/history', function () use ( $app, $dInvestor, $transaction_funding, $main, $user ) {
    
	$type                  = $app->request()->post('type');//withdraw|deposit
	$username              = $dInvestor['username'];
    
    $transaction_funding->set('username', $username);
    $transaction_funding->set('type', $type);
    $l = $transaction_funding->list_by();
    
    echo $main->toJsonData( 200, 'success', $l );
    unset( $l );
    
});