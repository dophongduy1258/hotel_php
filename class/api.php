<?php

class api{
    
	public function exeAPI( $method_post = 'POST', $router/*Link tail*/,$headers, $post_data, &$status_code = 200 ){
        global $setup;
        
		$api = $setup['link_API'].'/'.$router;//$router = api/auth/session
		$ch = curl_init();

		$headers[] = 'Accept: application/json';
		$headers[] = 'Content-Type: application/json';
		
		curl_setopt($ch, CURLOPT_URL, $api);
		curl_setopt($ch, CURLOPT_TIMEOUT, 4);
		
		if( $method_post == 'POST' ){
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
			curl_setopt($ch, CURLOPT_POST, 1);
		}else if( $method_post == 'PUT' ){
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
			// curl_setopt($ch, CURLOPT_POST, 1);
		}else{
			curl_setopt($ch, CURLOPT_POST, 0);
		}
		
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		// curl_setopt($ch, CURLOPT_PROXY, '125.212.218.242:80');
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		// curl_setopt($ch, CURLOPT_CAINFO, '../permfile/cacert.pem');

		$kq = curl_exec($ch);

		$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		// print curl_error($ch);
		// $info = curl_getinfo($ch);
        // print_r($info);
        //  print_r($kq);
		
		curl_close($ch);
		return $kq;
	}
	
	public function exeAPIPayment( $payment_type, $post_data, &$status_code = 200 ){
		global $setup;
		
		// "amount": "10000",
		// "description": "Thanh toán cái quái gì đó",
		// "subject": "test09",
				
		if( isset($setup['transfer_fund_account']) && isset($setup['cyclos_admin_account']) && isset($setup['cyclos_admin_password']) ){
			
			$post_data['type']			= $payment_type;
			$post_data['scheduling']	= 'direct';

			$api = $setup['link_API'].'/'.$setup['transfer_fund_account'].'/payments';
			$ch = curl_init();

			$headers[] = 'Accept: application/json';
			$headers[] = 'Content-Type: application/json';
			$headers[] = 'Authorization: Basic '.base64_encode( $setup['cyclos_admin_account'].':'.$setup['cyclos_admin_password'] );
			
			curl_setopt($ch, CURLOPT_URL, $api);
			curl_setopt($ch, CURLOPT_TIMEOUT, 4);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			// curl_setopt($ch, CURLOPT_PROXY, '125.212.218.242:80');
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
			// curl_setopt($ch, CURLOPT_CAINFO, '../permfile/cacert.pem');

			$kq = curl_exec($ch);

			$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

			// print curl_error($ch);
			// $info = curl_getinfo($ch);
			// print_r($info);
			//  print_r($kq);
			
			curl_close($ch);
			return $kq;

		}else{
			return false;
		}
	}

	public function exeAPIPaymentbBetween2User( $payment_type, $from_user, $post_data, &$status_code = 200 ){
		global $setup;
		
		// "amount": "10000",
		// "description": "Thanh toán cái quái gì đó",
		// "subject": "test09",
				
		if( isset($setup['transfer_fund_account']) && isset($setup['cyclos_admin_account']) && isset($setup['cyclos_admin_password']) ){
			
			$post_data['type']			= $payment_type;
			$post_data['scheduling']	= 'direct';

			$api = $setup['link_API'].'/'.$from_user.'/payments';
			$ch = curl_init();

			$headers[] = 'Accept: application/json';
			$headers[] = 'Content-Type: application/json';
			$headers[] = 'Authorization: Basic '.base64_encode( $setup['cyclos_admin_account'].':'.$setup['cyclos_admin_password'] );
			
			curl_setopt($ch, CURLOPT_URL, $api);
			curl_setopt($ch, CURLOPT_TIMEOUT, 4);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			// curl_setopt($ch, CURLOPT_PROXY, '125.212.218.242:80');
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
			// curl_setopt($ch, CURLOPT_CAINFO, '../permfile/cacert.pem');

			$kq = curl_exec($ch);

			$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

			// print curl_error($ch);
			// $info = curl_getinfo($ch);
			// print_r($info);
			//  print_r($kq);
			
			curl_close($ch);
			return $kq;

		}else{
			return false;
		}
	}
	
	public function exeAPIAdmin( $method_post = 'POST', $router/*Link tail*/, $post_data, &$status_code = 200 ){
        global $setup;
        
		$api = $setup['link_API'].'/'.$router;//$router = api/auth/session

		$ch = curl_init();

		$headers[] = 'Accept: application/json';
		$headers[] = 'Content-Type: application/json';
		$headers[] = 'Authorization: Basic '.base64_encode( $setup['cyclos_admin_account'].':'.$setup['cyclos_admin_password'] );
		
		curl_setopt($ch, CURLOPT_URL, $api);
		curl_setopt($ch, CURLOPT_TIMEOUT, 4);

		if( $method_post == 'POST' ){
			// echo json_encode($post_data);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
			curl_setopt($ch, CURLOPT_POST, 1);
		}else if( $method_post == 'PUT' ){
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
			// curl_setopt($ch, CURLOPT_POST, 1);
		}else{
			curl_setopt($ch, CURLOPT_POST, 0);
		}
		
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		// curl_setopt($ch, CURLOPT_PROXY, '125.212.218.242:80');
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		// curl_setopt($ch, CURLOPT_CAINFO, '../permfile/cacert.pem');

		$kq = curl_exec($ch);

		$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		// print curl_error($ch);
		// $info = curl_getinfo($ch);
        // print_r($info);
        // print_r($kq);
		
		curl_close($ch);
		return $kq;
	}
    
}
$api = new api();