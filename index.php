<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('display_startup_errors', true);
date_default_timezone_set( 'Asia/Ho_Chi_Minh' );

include 'define.php';
$title 	= '';
$m 		= $main->get('m');
$act 	= $main->get('act');

if ( $m == '' )
	$m = 'index';
if ( $act == '' )
	$act = 'report';

if( !isset($_SESSION['id']) || !isset($_SESSION['password']) ){

	if(isset($_COOKIE['id']) && isset($_COOKIE['password'])  ){
		$dUser = $user->get_detail( $_COOKIE['id'] );
		if( isset( $dUser['status'] ) && $dUser['status'] == 'Active' && $dUser['password'] == $_COOKIE['password'] ){
			
			$_SESSION["id"] 		= $dUser["id"];
			$_SESSION["password"] 	= $dUser["password"];

			setcookie("id", $_SESSION["id"], time() + 640000);
			setcookie("password", $_SESSION["password"], time() + 640000);
		}
	}else{
		if( $m != 'user' ){
			$m 		= 'user';
			$act 	= 'login';
		}
	}
	
}

include 'lang/vi/home.php';
$_SESSION['lang'] = 'vi';

$stemp = 'm/'.$m.'.php';
$temp = $m . '/' . $act . '.tpl';

include $stemp;

$st->assign( 'temp', $temp );
$st->assign( 'm', $m );
$st->assign( 'act', $act );
$st->assign( 'session', $_SESSION );
$st->assign( 'title', $title );
$st->assign( 'brumbar', $title );
$st->assign( 'version', 'v='.$setup['version'].time() );
$st->assign( 'domain', $domain );
$st->assign( 'lang', $lang );
$st->assign( 'setup', $setup );

// $status_code             = 403;
// $result = $api->exeAPIAdmin( 'GET', '/tannt2103/transactions', '', $status_code );
// print_r( $status_code );
// print_r( $result );
// exit();

// $status_code             = 403;
// $result = $api->exeAPIAdmin( 'GET', '/transactions/6277729707763103646', '', $status_code );
// 	print_r( $status_code );
// 	print_r( $result );
// 	exit();

unset( $lang);
unset( $setup);

$st->display( 'master.tpl');

$db->close();
