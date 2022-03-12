<?php
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', true);
ini_set('display_startup_errors', true);

date_default_timezone_set('Asia/Ho_Chi_minh');
include '../define.php';

$m 			= $main->get('m');
$act 		= $main->get('act');
$apikey 	= $main->get('apikey');

if( $apikey == $global_api_key ){
	if( isset($m['0']) ){
		
		//kiểm tra ngôn ngữ
		include '../lang/vi/home.php';
		
		@$user->set( 'id', $_SESSION['id'] );
		@$user->set( 'password', $_SESSION['password'] );	
		$dUserLogin = $user->check_login();

		$permiss = -1;
		$permiss = strpos($dUserLogin['permission'] , ':'.$m.$act.':');
		
		if( isset($dUserLogin['id']) && $dUserLogin['password'] !=  '' ){
			if( ( $dUserLogin['gid'] == '1' ||  $permiss !== false ) ){
				include $m.'.php';
			}else{
				echo 'done##',$main->toJsonData( 403, 'Bạn không được phép sử dụng chức năng này.', null);
				$db->close();
				exit();
			}
		}else{
			echo "<b>Chuyển đến trang đăng nhập ...</b>. <script> setTimeout(function(){window.location = '" .$domain. "/logout.php';},2000); </script>";
			$db->close();
			exit();
		}
		
	}else{
		echo $lang['er_003']." - index.ajax.";
		$db->close();
		exit();
	}

}else{
	$db->close();
	exit('Missing apikey request');
}
