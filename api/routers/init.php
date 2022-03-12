<?php
//cho app load config
$app->post('/init', function () use ( $app, $app_setting, $setup, $main ) {
    
    $opt = array(   'username'  => '',
                    'password'  => '',
                    'is_self_selling'               => $setup['is_self_selling'],//Đã đăng nhập: Trạng thái dùng sản phẩm tự chợ hay từ kho hàng tổng: =0 là sử dụng sp kho hàng tổng; = 1 là sản phẩm từ chính nó: selling/list và link webview = ?m=user&act=selling&id=selling_id
                    'is_self_selling_without_login' => $setup['is_self_selling_without_login'],//Trạng thái dùng sản phẩm tự chợ hay từ kho hàng tổng: =0 là sử dụng sp kho hàng tổng; = 1 là sản phẩm từ chính nó: selling/list và link webview = ?m=user&act=selling&id=selling_id => chưa đăng nhập
                    'api_key_store_kht'             => $setup['api_key_store_kht'],//API key store của kho hàng tổng EK63CQMB^l@65Vd6
                    'link_domain'                   => $setup['link_domain'],
                    'payment_type_deposit'          => $setup['cyclos_payment_type_for_deposit'],
                    'payment_type_withdraw'         => $setup['cyclos_payment_type_for_withdraw'],
                    'payment_type_investor'         => $setup['cyclos_payment_type_for_investor'],
                    'payment_type_transfer'         => $setup['cyclos_payment_type_for_transfer'],
                    'payment_type_deposit_info'     => $setup['cyclos_payment_type_for_deposit_info'],
                    'app_description'               => $setup['app_description'],
                    'main_current'      => $setup['main_current'],
                    'group_register'    => $setup['group_register'],
                    'link_api'  => $setup['link_API'],
                    'link_api_external'  => $setup['link_API_external'],
                    'receive_fund_account'  => $setup['receive_fund_account'],//'ctycpblockreal01',
                    'receive_fund_fullname' => $setup['receive_fund_fullname'],//'Cty CP BlockReal Việt Nam',
                    'receive_deposit_info_account' => $setup['receive_deposit_info_account'],//Tài khoản nhận cọc/mua BDS
                    'fixed_deposit' => $setup['fixed_deposit'],//Tài khoản nhận cọc/mua BDS
                    'payment'   => array(
                                    'user_opt'  => $setup['opt_status'] == 'true' ? true:false,
                                    'type'      => $setup['opt_type'],//login - otp
                                    'description' => 'Giá trị của type: login = sử dụng mật khẩu login để thanh toán làm mật khẩu confirm, ko cần gọi api tạo OTP
                                                    ; otp = dùng API để tạo OTP mật khẩu 1 lần để dùng'
                    ),
                    'list_app_items' => $app_setting->list_all_for_app()
            );
    
    echo $main->toJsonData( 200, 'success',  $opt );
    unset( $opt );
    
});

//cho app load config
$app->post('/init/market', function () use (  $app, $trade, $main, $user, $setup ) {
    
    $keyword     = $app->request()->post('keyword');
	$page          = $app->request()->post('page');

    if( $page < 1 ) $page = 1;

    $limit = $setup['perpage'];
    $ofset = ($page - 1)*$limit;

    $kq['lItems']   = $trade->market( $keyword, $ofset, $limit );
    $kq['total']    = $trade->market_count( $keyword );

    echo $main->toJsonData( 200, 'success', $kq );
    unset( $kq );

});

//cho app load config
$app->post('/init/selling/list', function () use (  $app, $selling, $main, $user, $setup ) {
    
    $province_id    = $app->request()->post('province_id');
	$city_id        = $app->request()->post('city_id');
    $keyword        = $app->request()->post('keyword');
	$page           = $app->request()->post('page');
    
    if( $page < 1 ) $page = 1;

    $limit = $setup['perpage'];
    $ofset = ($page - 1)*$limit;
    
    $selling->set('province_id', $province_id);
    $selling->set('city_id', $city_id);
    
    $kq['lItems']   = $selling->market( $keyword, $ofset, $limit );
    $kq['total']    = $selling->market_count( $keyword );
    
    echo $main->toJsonData( 200, 'success', $kq );

    unset( $kq );

});

//cho app load config về phí
$app->post('/init/fee', function () use ( $app, $fees, $setup, $main ) {
    
    $fee = $fees->list_all();    
    echo $main->toJsonData( 200, 'success',  $fee );
    unset( $fee );
    
});

$app->post('/init/province/all', function () use ( $app, $province, $main, $user ) {
    
	$lItems = $province->list_all();
	
	array_unshift($lItems, array("id"=>"", "name"=>"Tỉnh/ Thành Phố", "deleted"=>"0", "priority"=>"0", "created_by"=>"1"));
	echo $main->toJsonData( 200, 'success', $lItems );

	unset( $lItems );
});

$app->post('/init/province/all_city', function () use ( $app, $province, $city, $main, $user ) {
    
	$lProvince = $province->list_all();
	foreach ($lProvince as $key => $item) {
		$city->set('province_id', $item['id']);
		$lProvince[$key]['lCity'] = $city->list_by();
	}
	
	echo $main->toJsonData( 200, 'success', $lProvince );
	unset( $lProvince );
	
});

$app->post('/init/city/list_by', function () use ( $app, $city, $main, $user ) {
	$province_id    = $app->request()->post('province_id');
	
	$city->set( 'province_id', $province_id );
	$lItems = $city->list_by();

	array_unshift($lItems, array("id"=>"", "name"=>"Quận/ Huyện", "province_id"=>"$province_id", "deleted"=>"0", "priority"=>"0", "created_by"=>"1"));
	echo $main->toJsonData( 200, 'success', $lItems );

	unset( $lItems );
});


//API đăng nhập
$app->post('/init/login', function () use ( $app, $api, $investor, $main, $opt ) {
    
    $username       = $app->request()->post('username');
    $password       = $app->request()->post('password');
    $parent         = $app->request()->post('referral');
    
    $headers[] =  'Authorization: Basic '.base64_encode($username.':'.$password);

    $status_code = 403;
    $result = $api->exeAPI( 'POST','auth/session', $headers, '', $status_code );
    unset( $headers );
    
    if( $status_code == 200 ){// đăng nhập thành công
        $rt       = json_decode( $result, true );

        if( isset($rt['sessionToken']) ){

            $status_code = 403;
            $headers[] =  'Session-Token: '.$rt['sessionToken'];
            $rs = $api->exeAPI( 'GET', 'users/self/data-for-edit-profile', $headers, '', $status_code );

            $rsave = json_decode(  $rs, true );

            if( $rsave && $status_code == 200 ){
                
                //thực hiện tạo hoặc update sessionToken
                $investor->set('id', $rt['user']['id'] );
                $investor->set('sessionToken', $rt['sessionToken'] );
                $investor->set('parent', $parent);

                @$investor->set('fullname', $rsave['user']['name'] );
                $investor->set('username', $rsave['user']['username'] );
                $investor->set('mobile', $main->only_number($rsave['mobilePhones'][0]['number']) );
                @$investor->set('email', $rsave['user']['email'] );
                @$investor->set('diachi', $rsave['customValues']['diachi'] );
                @$investor->set('beneficiary', $rsave['customValues']['beneficiary'] );
                @$investor->set('bankname', $rsave['customValues']['bankname'] );
                @$investor->set('branch', $rsave['customValues']['branch'] );
                @$investor->set('bankaccnum', $rsave['customValues']['bankaccnum'] );
                @$investor->set('version', $rsave['user']['version'] );
                
                // $opt->setvarname('opt_status');
                // if( isset($rsave['confirmationPasswordInput']) ){
                //     $opt->setvalue('true');
                //     $opt->update();
                    
                //     $opt->setvarname('opt_type');
                //     $opt->setvalue($rsave['confirmationPasswordInput']['internalName']);
                //     $opt->update();

                // }else{
                //     $opt->setvalue('false');
                //     $opt->update();
                // }

                $dInvestor = $investor->get_detail();
                
                if( isset($dInvestor['id']) ){
                    //update
                    $investor->update();
                }else{
                    //add
                    $investor->add();
                }

                echo $main->toJsonData( 200, 'success',  $rt );
            }else{
                echo $main->toJsonData( 403, 'Phiên đăng nhập lỗi mã xác thực truy cập.',  $result );
            }

        }else{
            echo $main->toJsonData( 403, 'Phiên đăng nhập lỗi mã xác thực.',  $result );
        }
        unset( $rt );

    }else if( $status_code == 403 ){
        echo $main->toJsonData( 403, 'Quá trình đăng nhập đang bị hạn chế.',  $result );
    }else if( $status_code == 401 ){
        echo $main->toJsonData( 403, 'Đăng nhập không thành công.',  $result );
    }else{
        echo $main->toJsonData( 403, 'Lỗi đăng nhập chưa xác định.',  $result );
    }
    
});
