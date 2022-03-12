<?php
//cho app load config
$app->post('/deposit/sms_received', function () use ( $app, $bank_change, $main, $global_api_key_deposit, $setup ) {

    $sms                = new sms_string();
    $phone              = $app->request()->post('sender');
	$text_received      = rawurldecode($app->request()->post('body'));//utf8

    $sms->set('link', 'https://api.fpage.vn/activate');
    $sms->set('phone', $phone );
    $sms->set('text_received', $text_received );
    $data = $sms->get_info();

    $bank_change->set('transaction_funding_id', 0);
    $bank_change->set('sender', $phone);
    $bank_change->set('content', $text_received);
    $bank_change_id = $bank_change->add();

    if( !$data || !isset($data['id']) ){
        echo $main->toJsonData( 403, 'Số điện thoại/ nội dung tin nhắn không hợp lệ', null );
    }else{

        $id     = $data['id'];
        $phone  = $data['bank'];
        $type   = $data['type'];
        $memo   = $data['memo'];
        $amount = $data['amount'];
        
        return $app->redirect($app->urlFor( 'deposit_sms_content' ) .'?apikey='.$global_api_key_deposit."&bank=$phone&memo=$memo&amount=$amount&type=$type&id=$id&bank_change_id=$bank_change_id" , 200);
    }

});

$app->get('/deposit/sms_content', function () use ( $app, $api, $bank_change, $transaction_funding, $setup, $notification, $main ) {

	$id         = $app->request()->get('id');
	$type       = $app->request()->get('type');
	$bank       = $app->request()->get('bank');
	$memo       = $app->request()->get('memo');
	$bank_change_id = $app->request()->get('bank_change_id');
	$amount     = $app->request()->get('amount', 'number');
    
    $content = explode(' ', $memo);

    if( COUNT($content) > 2 && $content[0] == 'KYQUY' ){

        $n                  = $content[1];
        $transaction_id     = substr( $n, 2 );
        $username           = str_replace(' ', '', $content[2]);
        
        $transaction_funding->set('id', $transaction_id );
        $d = $transaction_funding->get_detail();

        if( isset( $d['id'] ) && $d['status'] == '0' && $d['type'] == 'deposit' ){
            if( strtolower($d['username']) == strtolower($username) && $username != '' ){
                
                if( $amount == $d['amount'] &&  $d['amount'] > 0 ){

                    $status                 = 403;
                    $post['amount']         = $d['amount'];
                    $post['description']    = 'Nạp tiền vào tài khoản của giao dịch nạp tiền: #'.$d['id'].' - '.$d['note'];
                    $post['subject']        = $d['username'];//user nhận fund
                    $result = $api->exeAPIPayment( $setup['cyclos_payment_type_for_deposit'], $post, $status );
                    
                    if( $status == 201 ){
                        $data = json_decode( $result, true );
                        
                        if( $data ){

                            //thanh toán thành công
                            $transaction_funding->set('approved_by', 0);
                            $transaction_funding->set('cyclos_transaction_id', $data['transactionNumber']);
                            $transaction_funding->update_done();

                            $subject = 'Nạp tiền thành công';
                            $content = 'Giao dịch nạp tiền #HD'.$d['id'].' với số tiền '.number_format($d['amount'], 0, '.', ',').' của bạn đã hoàn tất.';
                            $notification->set('to', $d['username'].';');
                            $notification->set('subject', $subject );
                            $notification->set('content', $content);
                            $notification->set('created_by', 0);
                            $notification->set('force_read', 0);
                            $notification_id = $notification->add();

                            $p['to'] = '/topics/username_'.$d['username'];
                            $p['priority']  = 'high';
                            $p['notification_id']  = $notification_id;
                            $ii['title']  = $subject;
                            $ii['body']   = $content;
                            $p['notification'] = $ii;
                            $main->sendFCM( $p );

                            $msg = 'success';
                            $bank_change->set('id', $bank_change_id );
                            $bank_change->set('content', $msg);
                            $bank_change->update_content();
                            echo $main->toJsonData( 200, $msg, null );
                            
                        }else{
                            $msg = 'Lỗi thực hiện parse dữ liệu, vui lòng kiểm tra.';
                            $bank_change->set('id', $bank_change_id );
                            $bank_change->set('content', $msg);
                            $bank_change->update_content();
                            echo $main->toJsonData( 403, $msg, $data );
                        }

                    }else{
                        $msg = 'Lỗi thực hiện thanh toán, vui lòng kiểm tra.';
                        $bank_change->set('id', $bank_change_id );
                        $bank_change->set('content', $msg);
                        $bank_change->update_content();
                        echo $main->toJsonData( 403, $msg, $result );
                    }

                }else{
                    $msg = 'Số tiền không đúng với mã giao dịch này.';
                    $bank_change->set('id', $bank_change_id );
                    $bank_change->set('content', $mgs);
                    $bank_change->update_content();
                    echo $main->toJsonData( 403, $msg, null );
                }
                
            }else{
                $msg = 'Giao dịch này thuộc về một người dùng khác.';
                $bank_change->set('id', $bank_change_id );
                $bank_change->set('content', $msg);
                $bank_change->update_content();
                echo $main->toJsonData( 403, $msg,  null );
            }

        }else if( isset( $d['id'] ) && $d['status'] == '1' ) {
            $msg = 'Trạng thái giao dịch đã thai đổi.';
            $bank_change->set('id', $bank_change_id );
            $bank_change->set('content', $msg);
            $bank_change->update_content();
            echo $main->toJsonData( 403, $msg,  null );
        }else {
            $msg = 'Không tìm thấy giao dịch có nội dung này.';
            $bank_change->set('id', $bank_change_id );
            $bank_change->set('content', $msg);
            $bank_change->update_content();
            echo $main->toJsonData( 403, $msg,  null );
        }

    }else {
        $msg = 'Nội dung chuyển tiền không đúng định dạng.';
        $bank_change->set('id', $bank_change_id );
        $bank_change->set('content', $msg);
        $bank_change->update_content();
        echo $main->toJsonData( 403, $msg,  null );
    }

    
})->name("deposit_sms_content");




//API dùng để nhận nội dung của sms và push về để xử lý nạp tiền tự động ko liên quan phần đặc cọc
// $app->post('/deposit/sms_received', function () use ( $app, $main, $global_api_key_deposit ) {
    
//     $phone      = $app->request()->post('sender');
// 	$text_utf8  = rawurldecode($app->request()->post('body'));
    
// 	$bank = array('Eximbank','LPB', 'Vietcombank', 'MBBANK','BIDV','SCB', 'VPBank','Sacombank', 'AGRIBANK','Techcombank','ACB', 'VietinBank', 'VIB');
	
// 	if( in_array($phone, $bank) ) // phone có trong danh bạ -> update đơn hàng
// 	{
        
//         $text_utf8 = str_replace("  ", " ", strtoupper($text_utf8));
// 		$a = explode(" ", $text_utf8);

//         $findKey = explode("KYQUY", $text_utf8);
//         $findKey = explode(" ", $findKey[1]);
// 		$order_code = preg_replace('/\s+/', '', $findKey[1]);
//         $order_code = preg_replace('/\s+/', '', $findKey[1]);
//         $findUser = $findKey[2];
//         $findUser = explode(".", $findUser);
// 		$user = strtolower( preg_replace('/\s+/', '', $findUser[0]) );
         
//         //xử lý theo từng trường hợp bank format lấy ra username amount và meno
//  		switch ($phone) {
//             case 'Techcombank':
//             case 'TECHCOMBANK':
//                 $amount_text  = $a[3];
//                 if((strpos($amount_text, '-'))>0 )
//                     $type = 2;
//                 else
//                     $type = 1;
                
//                 $amount = preg_replace('/\D/', '', $amount_text);
//                 break;
                
//             case 'BIDV':
//                 $amount_text  = $a[3];
//                 if(substr($amount_text, 0, 1) == '-')
//                 {
//                     $type = 2;
//                     $a2 = str_replace(',', '', $amount_text);
//                     $amount = (int)$a2;					
//                     $amount = substr($amount, 1);
//                 }
//                 else
//                 {
//                     $type = 1;
//                     $a2 = str_replace(',', '', $amount_text);
//                     $amount = (int)$a2;					
//                 }
//                 break;
                
//             case 'ACB':
//                 $amount_text  = $a[4];
//                 if($a[3] == '-')
//                     $type = 2;
//                 else
//                     $type = 1;
//                 $a2 = str_replace(',', '', $amount_text);
//                 $amount = (int)$a2;					
//                 break;

//             case 'Vietcombank':
//             case 'VIETCOMBANK':
//                 $amount_text  = $a[3];
//                 if(substr($amount_text, 0, 1) == '-')
//                 {
//                     $type = 2;
//                     $amount = substr($amount_text, 1);
//                     $amount = $main->only_number($amount)*-1;
//                 }
//                 else
//                 {
//                     $type = 1;				
//                     $amount = substr($amount_text, 1);
//                     $amount = $main->only_number($amount)*1;
//                 }
//                 break;
                
//             case 'MBBank':
//             case 'MBBANK':
//                 $amount_text  = $a[2];
//                 if(substr($amount_text, 0, 1) == '-')
//                     $type = 2;
//                 else
//                     $type = 1;
                
//                 echo $amount_text." - ".$a[2]."<br/>";
                
//                 $a2 = str_replace(',', '', $amount_text);
//                 echo $a2."<br/>";
                
//                 $amount = (int)$a2;		
//                 echo $amount."<br/>";
                    
//                 //$amount = preg_replace('/\D/', '', $amount_text);
//                 //$amount = (int)$amount;					
//                 break;
                
//             case 'VIB':
//                 $amount_text  = $a[3];
//                 if(substr($amount_text, 0, 1) == '-')
//                     $type = 2;
//                 else
//                     $type = 1;
//                 $a2 = str_replace(',', '', $amount_text);
//                 $amount = (int)$a2;					
//                 break;
            
//             case 'AGRIBANK':
//                 $amount_text  = $a[5];
//                 if(substr($amount_text, 0, 1) == '-')
//                     $type = 2;
//                 else
//                     $type = 1;
//                 $amount = preg_replace('/\D/', '', $amount_text);
//                 $amount = (int)$amount;					
//                 break;

//             case 'Sacombank':
//             case 'SACOMBANK':
//                 $amount_text  = $a[4];
//                 if($a[3] == 'rut')
//                     $type = 2;
//                 else
//                     $type = 1;
                
//                 $a2 = str_replace(',', '', $amount_text);
//                 $amount = (int)$a2;					
//                 break;

//             case 'VPBank':
//             case 'VPBANK':
//                 $amount_text  = $a[5];
//                 if($a[4] == 'giam')
//                     $type = 2;
//                 else
//                     $type = 1;
//                 $a2 = str_replace(',', '', $amount_text);
//                 $amount = (int)$a2;					
//                 break;

//             case 'SCB':
//                 $amount_text  = $a[9];
//                 if($a[8] == 'GIAM')
//                     $type = 2;
//                 else
//                     $type = 1;
//                 $a2 = str_replace(',', '', $amount_text);
//                 $amount = (int)$a2;					
//                 break;

//             case 'Eximbank':
//             case 'EXIMBANK':
//                 $amount_text  = $a[9];
//                 if(substr($amount_text, 0, 1) == '-')
//                     $type = 2;
//                 else
//                     $type = 1;
//                 $a2 = str_replace(',', '', $amount_text);
//                 $amount = (int)$a2;					
//                 break;
            
//             case 'LPB':
//                 $amount_text  = $a[4];
//                 if(substr($amount_text, 0, 1) == '-')
//                     $type = 2;
//                 else
//                     $type = 1;
//                 $amount = preg_replace('/\D/', '', $amount_text);
//                 $amount = (int)$amount;					
//                 break;	

//             case 'VietinBank':
//                 $text_utf8 = str_replace("|", " ", $text_utf8);
//                 $a = explode(" ", $text_utf8);
//                 $amount_text  = $a[3];
//                 if((strpos($amount_text, '+'))>0 )
//                     $type = 1;
//                 else
//                     $type = 2;
//                 $amount = preg_replace('/\D/', '', $amount_text);
//                 $amount = (int)$amount;				
//                 break;					

//             default:
//                 $amount = 0;
//                 break;
// 		}
        
//         $amount  = (int)preg_replace('/[^A-Za-z0-9-]/', '', $amount);
        
//         $memo = 'KYQUY '.$order_code.' '.$user;
//         // echo $para_app = "memo=".$memo."&amount=".$amount."&bank=".$phone;

//         return $app->redirect($app->urlFor( 'deposit_sms_content' ) .'?apikey='.$global_api_key_deposit."&bank=$phone&memo=$memo&amount=$amount" , 200);
        
//         // echo $main->toJsonData( 200, 'success',  null );
// 	}
// 	else
// 	{
//         echo $main->toJsonData( 403, 'Nội dung SMS không hợp lệ.',  null );
//     }
    
// });
