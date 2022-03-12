<?php

if( $act == 'login' ){

	$title = 'Đăng nhập';

	@$user->set('id', $_SESSION['id']);
	@$user->set('password', $_SESSION['password']);
	$dUserLogin = $user->check_login();
	
	if( isset( $dUserLogin['id'] ) && $dUserLogin['id'] != '' && $dUserLogin['password'] != '' ){

		if( in_array( $setup['lang'], array('vi','en') ) ){
			$_SESSION['lang'] = $setup['lang'];
		}else{
			$_SESSION['lang'] = 'vi';
		}


		if( strpos($dUserLogin['permission'] , ':indexreport:') !== false || $dUserLogin['gid'] == 1 )
			$main->redirect($domain);
		else if( strpos($dUserLogin['permission'] , ':indexproduct:') !== false )
			$main->redirect($domain.'/?act=product');
		else if( strpos($dUserLogin['permission'] , ':indexinvestor:') !== false )
			$main->redirect($domain.'/?act=investor');
		else if( strpos($dUserLogin['permission'] , ':indexstaff:') !== false )
			$main->redirect($domain.'/?act=staff');
		else if( strpos($dUserLogin['permission'] , ':indexnotification:') !== false )
			$main->redirect($domain.'/?act=notification');
		else if( strpos($dUserLogin['permission'] , ':indexbank:') !== false )
			$main->redirect($domain.'/?act=bank');
		else if( strpos($dUserLogin['permission'] , ':indexsetting:') !== false )
			$main->redirect($domain.'/?act=setting');
		else{
			unset($_SESSION['id']);
			unset($_SESSION['password']);
			unset($_SESSION['fullname']);
			unset($_SESSION['gid']);
			$main->redirect($domain.'/?m=user&act=empty');
		}
		$db->close();
		exit();
			

	}
	
}else if( $act == 'forgot_password' ){

}else if( $act == 'sb_login' ){

	if( isset( $_SESSION['id'] ) && isset( $_SESSION['password'] ) ){
		
		$user->set( 'id', $_SESSION['id'] );
		$user->set( 'password', $_SESSION['password'] );	
		$check_login = $user->check_login();
		
		if( isset( $check_login['id'] ) ){
			$main->redirect($domain);
			$db->close();
			exit();
		}
	}

	$username = $main->post('username');
	$password = $main->post('password');
	
	$user->set('email', $username);
	$dUserLogin = $user->get_by_email_or_mobile();
	
	if( isset( $dUserLogin['id'] ) && isset( $dUserLogin['password'] ) ){

		$pw = md5(md5($password).$dUserLogin['salt']);
		
		$user->set( 'id', $dUserLogin['id'] );
		$user->set( 'password', $pw );
		$dC = $user->check_login();

		if( isset($dC['id']) && isset($dC['password']) ){
			
			//đăng nhập thành công
			$_SESSION['id'] 		= $dC['id'];
			$_SESSION['password'] 	= $dC['password'];
			$_SESSION['gid'] 		= $dC['gid'];
			$_SESSION['fullname'] 	= $dC['fullname'];

		}else{
			$main->alert("Mật khẩu không đúng.");
			//đăng nhập thất bại
		}

		$main->redirect($domain.'/?m=user&act=login');
		$db->close();
		exit();
		
	}else{

		$main->alert("Tài khoản hoặc mật khẩu không đúng.");
		$main->redirect($domain.'/?m=user&act=login');
		$db->close();
		exit();
	}
}else if( $act == 'empty' ){
	$title = 'Không có chức năng được bật';

}else if( $act == 'product' ){
	$id = $main->get('id');

	$product->set('id', $id);
	$d = $product->get_detail();

	$description 	= $title = '';
	if( isset($d['id']) ){
		$title  = $d['title'];
		$description  = $d['description'];
	}
	
	$st->assign('description', $description);

}else if( $act == 'selling' ){

	$id = $main->get('id');

	$selling->set('id', $id);
	$d = $selling->get_detail();

	$description 	= $title = '';
	if( isset($d['id']) ){
		$title  = $d['title'];
		$description  = $d['description'];
	}

	$st->assign('description', $description);

}else if( $act == 'notification' ){

	$id = $main->get('id');

	$notification->set('id', $id);
	$d = $notification->get_detail();

	$description 	= $title = '';
	if( isset($d['id']) ){
		$title  = $d['subject'];
		$description  = $d['content'];
	}

	$st->assign('description', $description);
	


} else {
	$main->redirect($domain.'/?m=user&act=login');
}

