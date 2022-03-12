<?php
$nod        = $main->get('nod');
if( $act == 'idx' ){
    if( $nod == 'filter' ){

        $keyword        = $main->post('keyword');
        $page           = $main->post('page');
        
        if ( $page == '' || $page < 0 ) $page = 1;
        $paging->limit = $limit = $setup['perpage'];
        $ofset = ($page-1)*$paging->limit;
        $paging->page = $page;
        $paging->total = $investor->list_by_count( $keyword );
        $kq['page_html'] = $paging->display_ajax3();

        $kq['l'] = $investor->list_by( $keyword, $ofset, $limit );
        $kq['total'] = $paging->total;

        echo 'done##',$main->toJsonData( 200, 'success', $kq );

        unset(  $l );

    }else if( $nod == 'detail' ){

        $id       = $main->post('id');
        
        $investor->set('id', $id);
        $d = $investor->get_detail();

        unset( $d['sessionToken'] );

        echo 'done##',$main->toJsonData( 200, 'success', $d );       
    
    }else if( $nod == 'sync_point' ){
        $status = 403;
        $l = $investor->list_by( '', '', '' );
        foreach($l as $key => $item){
            $investorSyncPoint = new investor();
            $result = $api->exeAPIAdmin( 'GET', $item['id'].'/accounts/?fields=id,number,status.balance,status.availableBalance,currency.name,currency.symbol', '', $status );
            $result = json_decode($result, true );
            foreach($result as $key => $value){
                $investorSyncPoint->set('id', $item['id']);
            if( isset( $value['currency']['symbol'] ) && $value['currency']['symbol'] == 'VSG' ){
                @$investorSyncPoint -> set('VSG', $value['status']['availableBalance']);
            }else if( isset( $value['currency']['symbol'] ) && $value['currency']['symbol'] == 'VND' ){
                @$investorSyncPoint -> set('VND', $value['status']['availableBalance']);
            }else if( isset( $value['currency']['symbol'] ) && $value['currency']['symbol'] == 'VNDC' ){
                @$investorSyncPoint -> set('VNDC', $value['status']['availableBalance']);
            }else if( isset( $value['currency']['symbol'] ) && $value['currency']['symbol'] == 'BRS' ){
                @$investorSyncPoint -> set('BRS', $value['status']['availableBalance']);
            }
            
        }
        $investorSyncPoint->update_sync_point();
    }
        echo 'done##',$main->toJsonData( 200, 'success', $test );

    }else if( $nod == 'filter_sort_point' ){
        
        $keyword        = $main->post('keyword');
        $page           = $main->post('page');

        if ( $page == '' || $page < 0 ) $page = 1;
        $paging->limit = $limit = $setup['perpage'];
        $ofset = ($page-1)*$paging->limit;
        $paging->page = $page;
        $paging->total = $investor->list_by_count( $keyword );
        $kq['page_html'] = $paging->display_ajax3();

        $kq['l'] = $investor->list_by_sort_point( $keyword, $ofset, $limit );

        echo 'done##',$main->toJsonData( 200, 'success', $kq );

        unset(  $l );
        unset(  $kq );

    }else if( $nod == 'sync' ){

        $status = 403;
        $l = $api->exeAPIAdmin( 'GET', 'users?groups='.$setup['group_register'], '', $status );

        $l = json_decode($l, true );

        if( $l ){
            foreach($l as $item ){
                $investorSync = new investor();
                $rsave = $api->exeAPIAdmin( 'GET', 'users/'.$item['id'].'?fields=id,name,username,email,phones,status', '', $status );

                $rsave = json_decode($rsave, true);

                if( $rsave ){

                    //thực hiện tạo hoặc update sessionToken
                    $investorSync->set('id', $item['id'] );
                    
                    @$investorSync->set('fullname', $rsave['name'] );
                    @$investorSync->set('username', $rsave['username'] );
                    foreach($rsave['phones'] as $value){
                        @$investorSync->set('mobile', $value['number'] );
                    }
                    @$investorSync->set('email', $rsave['email'] );

                    $investorSync->set('activate', $rsave['status'] == 'active' ? '1':'0' );
                    
                    $dInvestor = $investorSync->get_detail();
                    if( isset($dInvestor['id']) ){
                        //update
                        $investorSync->update_sync();
                    }else{
                        //add
                        if( $rsave['id'] != '' )
                            $investorSync->add_sync();
                    }
                    
                }
                unset($investorSync);

            }
        }

        // $s = 0;
        // echo $api->exeAPIAdmin( 'GET', 'users/huanln8', '', $s );

        echo 'done##',$main->toJsonData( 200, 'success', null );

    }else{
       echo 'Missing nod';
        $db->close();
        exit(); 
    }
}else if( $act == 'suspend' ){

    if( $nod == 'suspend' ){

        // $id       = $main->post('id');
        
        // $notification->set('id', $id);
        // $notification->delete();

        echo 'done##',$main->toJsonData( 200, 'success', null );

    
    }else{
       echo 'Missing nod';
        $db->close();
        exit(); 
    }
}else if( $act == 'save' ){

    if( $nod == 'save' ){

        $id                 = $main->post('id');
        $username           = $main->post('username');
        $name               = $main->post('name');
        $email              = $main->post('email');
        $mobilePhone        = $main->post('mobilePhone');
        $activate           = $main->post('activate');
        $diachi             = $main->post('diachi');
        $bankaccnum         = $main->post('bankaccnum');
        $beneficiary        = $main->post('beneficiary');
        $bankname           = $main->post('bankname');
        $branch             = $main->post('branch');
        
        $investor->set('username', $username);
        $investor->set('fullname', $name);
        $investor->set('email', $email);
        $investor->set('mobile', $mobilePhone);
        $investor->set('activate', $activate);
        $investor->set('diachi', $diachi);
        $investor->set('bankaccnum', $bankaccnum);
        $investor->set('beneficiary', $beneficiary);
        $investor->set('bankname', $bankname);
        $investor->set('branch', $branch);

        $investor->set('id', $id);
        $d = $investor->get_detail();
        if( $id != '' && isset($d['id']) ){

            $investor->set('username', $d['username']);
            $investor->update();
            
            // {
            // "name": "Lê Ngọc Huân 2",
            // "username": "lengochuan",
            // "email": "lengochuan@yopmail.com",
            // "mobilePhone": "0905094280",
            // "customValues": {
            //     "bankname": "VCB",
            //     "bankaccnum": "123456781",
            //     "beneficiary": "123456781",
            //     "branch": "HCM2",
            //     "diachi": "268 Trần Hưng Đạo, Quận 5 2"
            //     },
            // "version": 11
            // }

            $jsonData = array();

            $jsonData['name'] = $name;
            $jsonData['username'] = $d['username'];
            $jsonData['email'] = $email;
            $jsonData['mobilePhone'] = $mobilePhone;
            $jsonData['email'] = $email;
            $jsonData['customValues'] = array(
                                            'bankname' => $bankname,
                                            'bankaccnum' => $bankaccnum,
                                            'beneficiary' => $beneficiary,
                                            'branch' => $branch,
                                            'diachi' => $diachi
                                            );
            
            $status_code = 403;
	        $version = $api->exeAPIAdmin( 'GET', 'users/'.$d['username'].'/data-for-edit-profile?fields=user.version', '', $status_code );
            
            if( $status_code == 200 ){
                
                $version = json_decode( $version, true );
                $jsonData['version'] = $version['user']['version'];
                //đồng bộ sang cyclos
                $status_code = 403;
                $api->exeAPIAdmin( 'PUT', 'users/'.$d['username'], $jsonData, $status_code );
                
                echo 'done##',$main->toJsonData( 200, 'success', null);
            }else{
                echo 'done##',$main->toJsonData( 403, 'Không thể đồng bộ thông tin', null);
            }
        }else{

            $jsonData = array();

            $jsonData['name'] = $name;
            $jsonData['username'] = $username;
            $jsonData['email'] = $email;
            $jsonData['mobilePhone'] = $mobilePhone;
            $jsonData['email'] = $email;
            $jsonData['group'] = $setup['group_register'];
            $jsonData['customValues'] = array(
                                            'bankname' => $bankname,
                                            'bankaccnum' => $bankaccnum,
                                            'beneficiary' => $beneficiary,
                                            'branch' => $branch,
                                            'diachi' => $diachi
                                            );
            $jsonData['passwords'][]      = array(
                                            'type' => 'login',
                                            'value' => $setup['default_password'],
                                            'checkConfirmation' => true,
                                            'confirmationValue' => $setup['default_password'],
                                            'forceChange' => false
                                            );
            
            $status_code = 403;
	        $version = $api->exeAPIAdmin( 'POST', '/users?fields=user.id', $jsonData, $status_code );
            
            if( $status_code == 201 ){
                
                $version                = json_decode( $version, true );
                $id                     = $version['user']['id'];
                
                //Thêm vào user mới
                $investor->set('id', $id);
                $investor->set('sessionToken', '');
                $investor->add();

                echo 'done##',$main->toJsonData( 200, 'register success', $version );

            }else{
                echo $status_code.'done##',$main->toJsonData( 403, 'Không thể đồng bộ thông tin', $version );
            }

        }
    
    }else{
       echo 'Missing nod';
        $db->close();
        exit(); 
    }

}else if( $act == 'delete' ){
    if( $nod == 'delete' ){

        // $id       = $main->post('id');
        
        // $notification->set('id', $id);
        // $notification->delete();

        echo 'done##',$main->toJsonData( 200, 'success', null );

    
    }else{
       echo 'Missing nod';
        $db->close();
        exit(); 
    }
}else if( $act == 'password_reset' ){
    if( $nod == 'reset' ){
        
        $id       = $main->post('id');
        
        $investor->set('id', $id);
        $d = $investor->get_detail();

        if( isset($d['id']) ){

            $status_code = 403;
            $api->exeAPIAdmin( 'POST', $d['username'].'/passwords/login/reset-and-send', array(), $status_code );

            if( $status_code == 204 ){
                echo 'done##',$main->toJsonData( 200, 'success', null );
            }else {
                echo 'done##',$main->toJsonData( 403, 'Lỗi kết nối đến hệ thống Cyclos.', null );
            }
        }else{
            echo 'done##',$main->toJsonData( 403, 'Không tìm thấy nhà đầu tư này.', null );
        }
    
    }else{
       echo 'Missing nod';
        $db->close();
        exit(); 
    }
}else if( $act == 'password_unblock' ){
    if( $nod == 'unblock' ){
        
        $id       = $main->post('id');
        
        $investor->set('id', $id);
        $d = $investor->get_detail();

        if( isset($d['id']) ){

            $status_code = 403;
            $api->exeAPIAdmin( 'POST', $d['username'].'/passwords/login/unblock', array(), $status_code );
            
            if( $status_code == 204 ){
                echo 'done##',$main->toJsonData( 200, 'success', null );
            }else {
                echo 'done##',$main->toJsonData( 403, 'Lỗi kết nối đến hệ thống Cyclos.', null );
            }
        }else{
            echo 'done##',$main->toJsonData( 403, 'Không tìm thấy nhà đầu tư này.', null );
        }
    
    }else{
       echo 'Missing nod';
        $db->close();
        exit(); 
    }
}else if( $act == 'password_enable' ){
    if( $nod == 'enable' ){
        
        $id       = $main->post('id');
        
        $investor->set('id', $id);
        $d = $investor->get_detail();

        if( isset($d['id']) ){

            $status_code = 403;
            $api->exeAPIAdmin( 'POST', $d['username'].'/passwords/login/enable', array(), $status_code );

            if( $status_code == 204 ){
                echo 'done##',$main->toJsonData( 200, 'success', null );
            }else {
                echo 'done##',$main->toJsonData( 403, 'Lỗi kết nối đến hệ thống Cyclos.', null );
            }
        }else{
            echo 'done##',$main->toJsonData( 403, 'Không tìm thấy nhà đầu tư này.', null );
        }
    
    }else{
       echo 'Missing nod';
        $db->close();
        exit(); 
    }
}else if( $act == 'password_disable' ){
    if( $nod == 'disable' ){
        
        $id       = $main->post('id');
        
        $investor->set('id', $id);
        $d = $investor->get_detail();

        if( isset($d['id']) ){

            $status_code = 403;
            $api->exeAPIAdmin( 'POST', $d['username'].'/passwords/login/disable', array(), $status_code );

            if( $status_code == 204 ){
                echo 'done##',$main->toJsonData( 200, 'success', null );
            }else {
                echo 'done##',$main->toJsonData( 403, 'Lỗi kết nối đến hệ thống Cyclos.', null );
            }
            
        }else{
            echo 'done##',$main->toJsonData( 403, 'Không tìm thấy nhà đầu tư này.', null );
        }
    
    }else{
       echo 'Missing nod';
        $db->close();
        exit(); 
    }
}else{
    echo 'Missing action';
    $db->close();
    exit();
}