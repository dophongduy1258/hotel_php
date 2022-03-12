<?php

// $server_sql 	    = 'localhost';
// $user_sql 		= 'citiposweb';
// $pass_sql 		= 'Pp4UCqK8YX4e';
// $database 		= 'blockreal_db';

$server_sql 	= 'localhost';
$user_sql 		= 'root';
$pass_sql 		= '';
$database 		= 'blockreal_db';

$db 			= new db ();
$db->setUsername ( $user_sql );
$db->setPassword ( $pass_sql );
$db->setServer 	 ( $server_sql );
$db->setDatabase ( $database );
$db->tbl_fix    = $database.'.';

//secrect key google: firebase cloud message: firebase notification:
//Cloud message: Project credentials: Server key
$fcm_secrect_key 		= 'AAAAE9F8mLs:APA91bFjo4afbvHgymOsjNrglOytFjYngne9gPnw3CXynTkIv4sYE2WvaaaKWU5H5FbOVvgo5W7CrCYkaOaDbawrj7OV7a8TaYetjv6fecNgKTHFkv2qRvE7UuLxyeRpIDSJlrvIxuE-';

// $domain 		= 'http://blockreal.local';
$domain 		= 'http://hotel.local';
$global_api_key = '0123kSKmsdfrtl234sd';

$global_api_key_deposit    = 'VSDQJH7128132KvKUWL09123VkLSKOIQ213';

$vnp_TmnCode        = 'TRUSTCAR';//Mã website tại VNPAY
$vnp_HashSecret     = 'LWDIAEWMWJSQJRQOSLEUTFTCCZSLOKQV';//Chuỗi bí mật
$vnp_Url            = 'http://sandbox.vnpayment.vn/paymentv2/vpcpay.html';
$vnp_Returnurl      = 'http://localhost/vnpay_php/vnpay_return.php';