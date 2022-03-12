<?php
define('PATH_ROOT', __DIR__);
define('PATH_APP', PATH_ROOT . '/routers');//modules
error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('display_startup_errors', true);
header('Content-Type: application/json');

/**
 * Step 1: Require the Slim Framework
 *
 * If you are not using Composer, you need to require the
 * Slim Framework and register its PSR-0 autoloader.
 *
 * If you are using Composer, you can skip this step.
 */
include '../define.php';
require_once __DIR__.'/../#drectthumuc/config.php';
require 'Slim/Slim.php';

include '../lang/vi/home.php';//load ngôn ngữ lên
$_SESSION['lang'] = 'vi';

$env = \Slim\Slim::registerAutoloader();
$env['slim.errors'] = fopen( PATH_ROOT . '/log.txt', 'a' );

/**
 * Step 2: Instantiate a Slim application
 *
 * This example instantiates a Slim application using
 * its default settings. However, you will usually configure
 * your Slim application now by passing an associative array
 * of setting names and values into the application constructor.
 */

$app = new \Slim\Slim();

//set json response
$app->response()->header('Content-Type', 'application/json; charset=utf-8');
/**
 * Step 3: Define the Slim application routes
 *
 * Here we define several Slim application routes that respond
 * to appropriate HTTP request methods. In this example, the second
 * argument for `Slim::get`, `Slim::post`, `Slim::put`, `Slim::patch`, and `Slim::delete`
 * is an anonymous function.
 */

$apikey = $app->request()->get('apikey');
$tokenPost = $app->request()->post('token');

if( $apikey == $global_api_key_deposit ){//api_key global api key: to deposit connect
	
	require PATH_APP . '/deposit.php';
	$app->run();

}else if( $apikey == $global_api_key ){//api_key global api key

	$module = $link_api = $app->request()->getResourceUri();// /investor/static
	$module = explode('/', $module);
	$module = $module['1'];

	if( $tokenPost != '' ){
		
		$investor->set( 'sessionToken', $tokenPost);
		$dInvestor = $investor->check_sessionToken();//Authen
		
		if( isset($dInvestor['id']) ){
			$routeFilePath = PATH_APP . '/' . $module.'.php';
			
			if( isset($module['1']) &&  is_file($routeFilePath) && preg_match('/^.*\.(php)$/i', $routeFilePath) ){
				
				require $routeFilePath;
				
				$app->run();

		 	}else{
		 		echo $main->toJsonData( 401, 'Yêu cầu kết nối không hợp lệ.', null);
		 	}
		}else{
			echo $main->toJsonData( 401, 'Không tìm thấy phiên đăng nhập. Yêu cầu đăng nhập lại.', null);
		}
		
	}else{
		$routeFilePath = PATH_APP . '/' . $module.'.php';

		if( isset($module['1']) &&  is_file($routeFilePath) && preg_match('/^.*\.(php)$/i', $routeFilePath) ){
			
			require PATH_APP . '/init.php';
			$app->run();

		}else{
			echo $main->toJsonData( 403, 'Yêu cầu kết nối không hợp lệ.', null);
		}

	}

}else{

	echo $main->toJsonData('502', 'Bad request.', '');
}

@$db->close();

// $filename = __DIR__.'/logs/log.'.date('Y-m-d-H').'.txt';
// $strLog = ob_get_contents();
// $strUser = '';
// if( isset($dUser['id']) ) $strUser = '[dUser]'.implode("|", $dUser);
// $main->writeToFile( $filename, $strUser.':[GET]:'.implode("|", $_GET).':[POST]:'.implode("|", $_POST).':\n'.$strLog );
// unset( $strLog );
// unset( $db );



