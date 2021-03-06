<?php
class sms_string {
    private $bank = array('Eximbank','LPB', 'Vietcombank', 'MBBANK','BIDV','SCB', 'VPBank','Sacombank', 'AGRIBANK','Techcombank','ACB', 'VietinBank', 'VIB');
	private $phone;
	private $text_received;
	private $link;
	private $data;

	// set value with paramater
	public function set( $parameter, $val) {
		$this->$parameter = $val;
		return true;
	}
	// get value with paramater
	public function get( $parameter ) {
		return $this->$parameter;
	}

	public function check_bank( $phone ){//so dien thoai gui co dung ko
        if ( in_array( $phone, $this->bank ) )
            return true;
        return false;
    }

    public function get_info(){// noi dung
		
		$phone 				= $this->get('phone');
		$text_received_in 	= $this->get('text_received');
		$start_key 			= 'KYQUY HD';
		
        if( !$this->check_bank($phone) ){
            return false;
        }else{

            $type           = 0;
            $amount         = 0;
            
            $text_received = str_replace("  ", " ", strtoupper($text_received_in));
            $a = explode(" ", $text_received);
			if( COUNT($a) == 1 ) return false;
			
			$tim_code 	= explode($start_key, strtoupper($text_received_in));
			if( COUNT($tim_code) == 1 ) return false;
			$strcode 	= explode(' ', $tim_code[1]);
			$doan_1     = preg_replace('/\D/', '', $strcode[0]);

			$doan_2 = '';
			if( isset($strcode[1]) ){
				$doan_temp =  explode('.', $strcode[1]);
				$doan_2     = $doan_temp[0];
			}
            
            switch ($phone) {
				case 'Techcombank':
				case 'TECHCOMBANK':

            		$a = explode("SO TIEN GD:", $text_received);
					if( COUNT($a) != 2 ){
						return false;
					}else{
						$a = explode("\n", $a[1]);
						$amount_text  = $a[0];
						if((strpos($amount_text, '-'))>0 )
							$type = -1;
						else
							$type = 1;
						$amount = preg_replace('/\D/', '', $amount_text);
					}
					break;
					
				case 'BIDV':
					$amount_text  = $a[3];
					if(substr($amount_text, 0, 1) == '-')
					{
						$type = -1;
						$a2 = str_replace(',', '', $amount_text);
						$amount = (int)$a2;					
						$amount = substr($amount, 1);
					}
					else
					{
						$type = 1;
						$a2 = str_replace(',', '', $amount_text);
						$amount = (int)$a2;					
					}
					break;
					
				case 'ACB':
					$amount_text  = $a[4];
					if($a[3] == '-')
						$type = -1;
					else
						$type = 1;
					$a2 = str_replace(',', '', $amount_text);
					$amount = (int)$a2;					
					break;

				case 'Vietcombank':
				case 'VIETCOMBANK':
					$amount_text  = $a[3];
					if(substr($amount_text, 0, 1) == '-')
					{
						$type = -1;
						$amount = substr($amount_text, 1);
					}
					else
					{
						$type = 1;				
						$a2 = str_replace(',', '', $amount_text);
						$amount = (int)$a2;		
					}
					break;
				case 'MBBank':
				case 'MBBANK':
					$amount_text  = $a[2];
					if(substr($amount_text, 0, 1) == '-')
						$type = -1;
					else
						$type = 1;
					
					$a2 = str_replace(',', '', $amount_text);
					$amount = (int)$a2;		
					break;
					
				case 'VIB':
					$amount_text  = $a[3];
					if(substr($amount_text, 0, 1) == '-')
						$type = -1;
					else
						$type = 1;
					$a2 = str_replace(',', '', $amount_text);
					$amount = (int)$a2;					
					break;
				
				case 'AGRIBANK':
					$amount_text  = $a[5];
					if(substr($amount_text, 0, 1) == '-')
						$type = -1;
					else
						$type = 1;
					$amount = preg_replace('/\D/', '', $amount_text);
					$amount = (int)$amount;					
					break;

				case 'Sacombank':
				case 'SACOMBANK':
					$amount_text  = $a[4];
					if($a[3] == 'rut')
						$type = -1;
					else
						$type = 1;
					
					$a2 = str_replace(',', '', $amount_text);
					$amount = (int)$a2;					
					break;

				case 'VPBank':
				case 'VPBANK':

					$a = explode("VPB TANG ", $text_received);//ch??? b???t t??ng
					if( COUNT($a) != 2 ){
						return false;
					}else{
						$a = explode("VND", $a[1]);
						$amount_text  = $a[0];
						// if((strpos($amount_text, '-'))>0 )
						// 	$type = -1;
						// else
							$type = 1;
						$amount = preg_replace('/\D/', '', $amount_text);
					}
					break;

					$amount_text  = $a[5];
					if($a[4] == 'giam')
						$type = -1;
					else
						$type = 1;
					$a2 = str_replace(',', '', $amount_text);
					$amount = (int)$a2;					
					break;

				case 'SCB':
					$amount_text  = $a[9];
					if($a[8] == 'GIAM')
						$type = -1;
					else
						$type = 1;
					$a2 = str_replace(',', '', $amount_text);
					$amount = (int)$a2;					
					break;

				case 'Eximbank':
				case 'EXIMBANK':
					$amount_text  = $a[9];
					if(substr($amount_text, 0, 1) == '-')
						$type = -1;
					else
						$type = 1;
					$a2 = str_replace(',', '', $amount_text);
					$amount = (int)$a2;					
					break;
				
				case 'LPB':
					$amount_text  = $a[4];
					if(substr($amount_text, 0, 1) == '-')
						$type = -1;
					else
						$type = 1;
					$amount = preg_replace('/\D/', '', $amount_text);
					$amount = (int)$amount;					
					break;	

				case 'VietinBank':
					$text_utf8 = str_replace("|", " ", $text_utf8);
					$a = explode(" ", $text_utf8);
					$amount_text  = $a[3];
					if((strpos($amount_text, '+'))>0 )
						$type = 1;
					else
						$type = -1;
					$amount = preg_replace('/\D/', '', $amount_text);
					$amount = (int)$amount;				
					break;					

                default:
					$type = 0;
					$amount = 0;
                    break;
                    
            }

			$amount  = (int)preg_replace('/[^A-Za-z0-9-]/', '', $amount);
			// if( $doan_2 != '')
			// 	$memo = "$start_key$doan_1";
			// else
				$memo = "$start_key$doan_1 $doan_2";
            
            return array( 'bank' => $phone, 'type'=>$type, 'memo' => $memo, 'amount' => $amount, 'id' => $doan_1 );
        }

    }
    
    public function exeAPI(){// noi dung
		
		$link 			= $this->get('link');
		$data 			= $this->get('data');
		
        $fields = json_encode( $data );

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $link );
		curl_setopt($curl, CURLOPT_TIMEOUT, 30);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: '.strlen($fields)));
		curl_setopt($curl, CURLOPT_POSTFIELDS, $fields);
		$res = curl_exec($curl);
		curl_close($curl);
		
		return $res;

    }

}

// $phone           = $_POST["sender"];
// $text_received   = rawurldecode($_POST["body"]);


//cho app load config
// $app->post('/sms_bank/bigone', function () use ( $app, $client, $withdraw, $transaction_history, $bank_change, $main, $notification, $setup ) {
    
//     $sms                = new sms_string();
//     $payment_function   = new payment_function();
//     $phone              = $app->request()->post('sender');
// 	$text_received      = rawurldecode($app->request()->post('body'));//utf8

//     $sms->set('link', 'https://api.fpage.vn/activate');
//     $sms->set('phone', $phone );
//     $sms->set('text_received', $text_received );
//     $data = $sms->get_info();

//     // print_r($phone);
//     // print_r($text_received);

//     $bank_change->set('transaction_funding_id', 0);
//     $bank_change->set('sender', $phone);
//     $bank_change->set('content', $text_received);
//     $bank_change->add();

//     if( !$data || !isset($data['id']) ){
//         echo $main->toJsonData( 403, 'S??? ??i???n tho???i/ n???i dung tin nh???n kh??ng h???p l???', null );
//     }else{
//         // $data['api_key'] = '5d2b56e774196bb1aadf81c2dcc7cd8f';
//         // $sms->set('data', $data );
//         // $data['response'] = $sms->exeAPI();
//         //x??? l?? n???p ??i???m ??? ????y

//         $withdraw->set('id', $data['id']);
//         $dDeposit = $withdraw->get_detail();

//         if( !isset( $dDeposit['id']) ){
//             echo $main->toJsonData( 403, 'Kh??ng t??m th???y giao d???ch n??y', null );
//         }else if( $dDeposit['status'] != 0 ){
//             echo $main->toJsonData( 403, 'Giao d???ch ???? b??? thay ?????i tr?????c khi n???p.', null );
//         }else if( $data['amount'] <= 0){
//             echo $main->toJsonData( 403, 'S??? c???n n???p kh??ng ????ng.', null );
//         }else if( $data['amount'] > 300000000){//Ko cho ph??p n???p nhi???u h??n 300tr
//             echo $main->toJsonData( 403, 'S??? c???n n???p v?????t qu?? s??? l?????ng cho ph??p x??? l?? t??? ?????ng.', null );
//         }else if( $data['type'] == -1 ){//Ko cho ph??p n???p nhi???u h??n 300tr
//             echo $main->toJsonData( 403, 'Giao d???ch tr??? ti???n, ch??? ch???p nh???n giao d???ch c???ng ti???n.', null );
//         }else if( !in_array( $data['bank'], array('Techcombank', 'VPBank', 'BIDV', 'Vietcombank') ) ){//ch??? cho ph??p nh???ng ng??n h??ng n??y ?????u v??o
//             echo $main->toJsonData( 403, 'Ng??n h??ng kh??ng h??? tr???.'.$data['bank'], null );
//         }else{

//             if( $dDeposit['type'] == 3){
//                 //x??? l?? n???p ti???n cho upload bill

//                 $client_id      = $dDeposit['client_id'];
//                 $amount         = $data['amount'];//real transfer

//                 $client->set('id', $client_id);
//                 $dClient = $client->get_detail();

//                 if( !isset( $dClient['id']) ){
//                     echo $main->toJsonData( 403, 'Kh??ng t??m th???y client n??y', null );
//                 }else{

//                     /*
//                     - BEGIN gi???ng c??? api v?? ajax
//                     */

//                     $withdraw->set('id', $dDeposit['id'] );
//                     $withdraw->set('status', 1);
//                     $withdraw->process_request();
                    
//                     $commission_NTD_upload_bill     = $setup['vtd_pending_commission'];//20% ph???i tr??? v???i bill upload
//                     $commission_NTD_vtl             = ( (100-$commission_NTD_upload_bill) / $commission_NTD_upload_bill);//h??? s??? v???i ph???n c??n l???i
//                     $amount_vtl                     = $amount*$commission_NTD_vtl;

//                     //BIG GATE WAY t???o transaction v??o v?? ti??u d??ng c???a client
//                     $client->set('id', 1);
//                     $dBigGateWay = $client->get_detail();

//                     $payment_type   = 'BIGVTD';
//                     $note           = $dDeposit['client_name'].' n???p ??i???m BIG v??o v?? ti??u d??ng s??? #HD'.$dDeposit['id'];
//                     $transaction_history->set('from_client', 1);
//                     $transaction_history->set('from_client_fullname', $dBigGateWay['fullname']);
//                     $transaction_history->set('to_client', $dClient['id']);
//                     $transaction_history->set('to_client_fullname', $dClient['fullname']);
//                     $transaction_history->set('amount', $amount);
//                     $transaction_history->set('note', $note);
//                     $transaction_history->set('payment_type', $payment_type);
//                     $transaction_history->set('executed_by_admin', 0);
//                     $id_nap_vtd = $transaction_history->add();

//                     //BIG GATE WAY t???o transaction v??o v?? t??ch l??y c???a client
//                     $payment_type   = 'BIGVTL';
//                     $note           = $dDeposit['client_name'].' nh???n ??i???m BIG v??o v?? t??ch l??y s??? #HD'.$dDeposit['id'];
//                     $transaction_history->set('from_client', 1);
//                     $transaction_history->set('from_client_fullname', $dBigGateWay['fullname']);
//                     $transaction_history->set('to_client', $dClient['id']);
//                     $transaction_history->set('to_client_fullname', $dClient['fullname']);
//                     $transaction_history->set('amount', $amount_vtl);
//                     $transaction_history->set('note', $note);
//                     $transaction_history->set('payment_type', $payment_type);
//                     $transaction_history->set('executed_by_admin', 0);
//                     $id = $transaction_history->add();
                    
//                     $client->set( 'id', $dClient['id'] );
//                     $client->active_balance_bill( $amount, $commission_NTD_vtl );

//                     //BIG GATE WAY t???o giao d???ch chuy???n v??o v?? l???i nhu???n
//                     //BIG GATE WAY t???o giao d???ch chuy???n v??o v?? chia th?????ng
//                      //Th???c hi???n chuy???n ??i???m commission
                    
//                     // $origin_commission = intval($amount * ($commission_NTD_upload_bill / 100) );
//                     // $VLN = $origin_commission * ($setup['phan_tram_loi_nhuan_bigone_nhan']/100);
//                     // $VCT = $origin_commission - $VLN;

//                     // //Th??m transaction v?? l???i nhu???n
//                     // $transaction_history->set('from_client', 1);
//                     // $transaction_history->set('from_client_fullname', $dBigGateWay['fullname']);
//                     // $transaction_history->set('to_client', 2);
//                     // $client->set('id', 2);
//                     // $transaction_history->set('to_client_fullname', $client->get_fullname());
//                     // $transaction_history->set('amount', $VLN);
//                     // $transaction_history->set('commission', $origin_commission);
//                     // $transaction_history->set('note', 'Cho giao giao d???ch: #' . $id_nap_vtd);
//                     // $transaction_history->set('payment_type', 'BIGVLN');
//                     // $transaction_history->set('executed_by_admin', 0);
//                     // $transaction_history->add();

//                     // $client->set('id', 2);
//                     // $client->update_balance_plus('wallet_gateway', $VLN);

//                     // //Th??m transaction v?? l???i nhu???n
//                     // $transaction_history->set('from_client', 1);
//                     // $transaction_history->set('from_client_fullname', $dBigGateWay['fullname']);
//                     // $transaction_history->set('to_client', 3);
//                     // $client->set('id', 3);
//                     // $transaction_history->set('to_client_fullname', $client->get_fullname());
//                     // $transaction_history->set('amount', $VCT);
//                     // $transaction_history->set('note', 'Cho giao giao d???ch: #' . $id_nap_vtd);
//                     // $transaction_history->set('payment_type', 'BIGVCT');
//                     // $transaction_history->set('commission', $origin_commission);
//                     // $transaction_history->set('executed_by_admin', 0);
//                     // $transaction_history->add();

//                     // $client->set('id', 3);
//                     // $client->update_balance_plus('wallet_gateway', $VCT);

//                     $client->set('id', 1);
//                     // $client->update_balance_subtract('wallet_gateway', $amount + $VLN + $VCT + $amount_vtl );//tr??? v?? t???ng: s??? l?????ng n???p v??o v?? ti??u d??ng amount, v?? c??? s??? l?????ng chuy???n t??? vtl pending v??o
//                     $client->update_balance_subtract('wallet_gateway', $amount + $amount_vtl );//tr??? v?? t???ng: s??? l?????ng n???p v??o v?? ti??u d??ng amount, v?? c??? s??? l?????ng chuy???n t??? vtl pending v??o

//                     $subject = 'B???n nh???n ???????c BIG v??o v?? ti??u d??ng & v?? t??ch l??y';
//                     $content = 'T??i kho???n c???a b???n ???????c c???ng th??m '.number_format( $amount, $setup['decimal'], '.', ',').'BIG v??o v?? ti??u d??ng v?? '.number_format( $amount_vtl, $setup['decimal'], '.', ',').'BIG v??o v?? t??ch l??y';
//                     $notification->set('to', $dClient['id'].';');
//                     $notification->set('subject', $subject );
//                     $notification->set('content', $content);
//                     $notification->set('created_by', 0);
//                     $notification_id = $notification->add();

//                     $post['to']        = '/topics/username_'.$dClient['id'];
//                     $post['priority']  = 'high';
//                     $post['notification_id']  = $notification_id;
//                     $ii['title']    = $subject;
//                     $ii['body']     = $content;
//                     $post['notification'] = $ii;
//                     $post['data']['force_refresh'] = true;
//                     $post['data']['notify_id']     = $notification_id;
//                     $main->sendFCM( $post );

//                     //c???p nh???t l???i dDeposit n???u s??? l?????ng kh??c
//                     if( $amount != $dDeposit['amount'] ){
//                         $withdraw->set('id', $dDeposit['id'] );
//                         $withdraw->set('amount', $amount );
//                         $withdraw->update_amount();
//                     }

//                     /*
//                     - End gi???ng c??? api v?? ajax
//                     */

//                     echo $main->toJsonData( 200, 'success', $data );

//                 }

//             }else if( $dDeposit['type'] == 2 ){
//                 //X??? l?? n???p ti???n tr???c ti???p VTD

//                 $client_id      = $dDeposit['client_id'];
//                 $amount         = $data['amount'];//real transfer

//                 $client->set('id', $client_id);
//                 $dClient = $client->get_detail();

//                 if( !isset( $dClient['id']) ){
//                     echo $main->toJsonData( 403, 'Kh??ng t??m th???y ng?????i d??ng n??y n??y', null );
//                 }else{

//                     /*
//                     - BEGIN BIGONE cho backoffice
//                     */

//                     $withdraw->set('id', $dDeposit['id'] );
//                     $withdraw->set('status', 1);
//                     $withdraw->process_request();
                    
//                     $commission_NTD_upload_bill    = $setup['vtl_direct_deposit_commission'];//20% hoa h???ng c???ng th??m khi n???p tr???c ti???p
//                     $amount_vtl = intval( $amount*(100+$commission_NTD_upload_bill)/100 );

//                     //BIG GATE WAY t???o transaction v??o v?? ti??u d??ng c???a client
//                     $client->set('id', 1);
//                     $dBigGateWay = $client->get_detail();

//                     $payment_type   = 'BIGVTD';
//                     $note           = $dDeposit['client_name'].' n???p ??i???m BIG v??o v?? ti??u d??ng s??? #HD'.$dDeposit['id'];
//                     $transaction_history->set('from_client', 1);
//                     $transaction_history->set('from_client_fullname', $dBigGateWay['fullname']);
//                     $transaction_history->set('to_client', $dClient['id']);
//                     $transaction_history->set('to_client_fullname', $dClient['fullname']);
//                     $transaction_history->set('amount', $amount);
//                     $transaction_history->set('note', $note);
//                     $transaction_history->set('payment_type', $payment_type);
//                     $transaction_history->set('executed_by_admin', 0);
//                     $id_nap_vtd = $transaction_history->add();

//                     //BIG GATE WAY t???o transaction v??o v?? t??ch l??y c???a client
//                     $payment_type   = 'BIGVTL';
//                     $note           = $dDeposit['client_name'].' nh???n ??i???m BIG v??o v?? t??ch l??y s??? #HD'.$dDeposit['id'];
//                     $transaction_history->set('from_client', 1);
//                     $transaction_history->set('from_client_fullname', $dBigGateWay['fullname']);
//                     $transaction_history->set('to_client', $dClient['id']);
//                     $transaction_history->set('to_client_fullname', $dClient['fullname']);
//                     $transaction_history->set('amount', $amount_vtl);
//                     $transaction_history->set('note', $note);
//                     $transaction_history->set('payment_type', $payment_type);
//                     $transaction_history->set('executed_by_admin', 0);
//                     $id = $transaction_history->add();


//                     //C???p nh???t balance client
//                     $client->set('id', $client_id);
//                     $client->update_balance_plus('wallet_vtd', $amount );
//                     $client->update_balance_plus('wallet_vtl', $amount_vtl );
//                     $client->update_spent( $amount );

                    
//                     //c???p nh???t balance v?? t???ng
//                     $client->set('id', 1);
//                     $client->update_balance_subtract('wallet_gateway', $amount + $amount_vtl );//tr??? v?? t???ng: s??? l?????ng n???p v??o v?? ti??u d??ng amount, v?? c??? s??? l?????ng chuy???n t??? vtl pending v??o


//                     $subject = 'B???n nh???n ???????c BIG v??o v?? ti??u d??ng & v?? t??ch l??y';
//                     $content = 'T??i kho???n c???a b???n ???????c c???ng th??m '.number_format( $amount, $setup['decimal'], '.', ',').'BIG v??o v?? ti??u d??ng v?? '.number_format( $amount_vtl, $setup['decimal'], '.', ',').'BIG v??o v?? t??ch l??y';
//                     $notification->set('to', $dClient['id'].';');
//                     $notification->set('subject', $subject );
//                     $notification->set('content', $content);
//                     $notification->set('created_by', 0);
//                     $notification_id = $notification->add();

//                     $post['to']        = '/topics/username_'.$dClient['id'];
//                     $post['priority']  = 'high';
//                     $post['notification_id']  = $notification_id;
//                     $ii['title']    = $subject;
//                     $ii['body']     = $content;
//                     $post['notification'] = $ii;
//                     $post['data']['force_refresh'] = true;
//                     $post['data']['notify_id']     = $notification_id;
//                     $main->sendFCM( $post );

//                     //c???p nh???t l???i dDeposit n???u s??? l?????ng kh??c
//                     if( $amount != $dDeposit['amount'] ){
//                         $withdraw->set('id', $dDeposit['id'] );
//                         $withdraw->set('amount', $amount );
//                         $withdraw->update_amount();
//                     }

//                     /*
//                     - BEGIN BIGONE cho backoffice
//                     */

//                     echo $main->toJsonData( 200, 'success', $data );

//                 }

//             //N???p ti???n c???a SHOP
//             }else if( $dDeposit['type'] == 1){
//                 /*
//                 -  X??? L?? CHO N???P TI???N C???A SHOP
//                 */
//                 $client_id      = $dDeposit['client_id'];
//                 $payment_type   = 'BIGSHOP';
//                 $note           = $dDeposit['client_name'].' n???p BIG t??? ?????ng s??? #HD'.$dDeposit['id'];
//                 $amount         = $data['amount'];//real transfer

//                 $client->set('id', $client_id);
//                 $dClient = $client->get_detail();

//                 if( !isset( $dClient['id']) ){
//                     echo $main->toJsonData( 403, 'Kh??ng t??m th???y client n??y', null );
//                 }else{

//                     $withdraw->set('id', $dDeposit['id'] );
//                     $withdraw->set('status', 1);
//                     $withdraw->process_request();

//                     $amount = ceil( ($amount/$dClient['commission'])*100 );//real deposit
                    
//                     //Th???c hi???n chuy???n ??i???m t??? v?? BIG t???ng sang V?? SHOP, V?? T??ch L??y SHOP v?? c??c v?? l???i nhu???n, v?? chia ??i???m
//                     $payment_function->transfer_to_shop( $dClient, $amount, $note, 0 );

//                     $subject = 'B???n nh???n ???????c BIG v??o v?? SHOP';
//                     $content = 'T??i kho???n c???a b???n ???????c c???ng th??m '.number_format( $amount, $setup['decimal'], '.', ',').( $note != '' ? ' BIG. N???i dung: '.$note:' BIG.' );
//                     $notification->set('to', $dClient['id'].';');
//                     $notification->set('subject', $subject );
//                     $notification->set('content', $content);
//                     $notification->set('created_by', 0);
//                     $notification_id = $notification->add();

//                     $post['to']        = '/topics/username_'.$dClient['id'];
//                     $post['priority']  = 'high';
//                     $post['notification_id']  = $notification_id;
//                     $ii['title']    = $subject;
//                     $ii['body']     = $content;
//                     $post['notification'] = $ii;
//                     $post['data']['force_refresh'] = true;
//                     $post['data']['notify_id']     = $notification_id;
//                     $main->sendFCM( $post );

//                     //c???p nh???t l???i dDeposit n???u s??? l?????ng kh??c
//                     if( $amount != $dDeposit['amount'] ){
//                         $withdraw->set('id', $dDeposit['id'] );
//                         $withdraw->set('amount', $amount );
//                         $withdraw->update_amount();
//                     }

//                     echo $main->toJsonData( 200, 'success', $data );
//                 }
//             }else{
//                 echo $main->toJsonData( 403, 'Lo???i n???p t??? chuy???n kho???n kh??ng ???????c ch???p nh???n', null );
//             }

//         }
//     }

// });
