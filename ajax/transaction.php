<?php
//{{domain}}/api/self/accounts/?fields=id,number,status.balance,status.availableBalance,currency.name,currency.symbol
$nod        = $main->get('nod');
if( $act == 'idx' ){

    if( $nod == 'filter' ){

        $keyword            = $main->post('keyword');
        $from               = $main->post('from');
        $to                 = $main->post('to');
        $is_deposit         = $main->post('is_deposit');
        $page               = $main->post('page');

        $check_period   = true;
        $msg            = '';
        $strfromday     = 0;
        $strtoday       = 0;
        if ($from != '') {

            if ($to == '')
                $to = date('d/m/Y');

            $strfromday = strtotime($main->convert_strdate($from));
            $strtoday = strtotime($main->convert_strdate($to));
            $strtoday += 86399;

            if (!$main->validateDate($from, 'd/m/Y') || !$main->validateDate($to, 'd/m/Y')) {
                $check_period = false; //có vấn đề trong chọn thời gian
                $msg = "Chọn ngày không hợp lệ";
            } else if ($strfromday > $strtoday) {
                $check_period = false; //có vấn đề trong chọn thời gian
                $msg = "Chọn ngày không hợp lệ";
            }
        }

        if (!$check_period) {
            //Vượt qua kiểm tra dữ liệu đầu vào
            echo 'done##', $main->toJsonData(403, $msg, null); //Lỗi trong loạt kiểm tra các điều kiện dữ liệu đầu vào
        } else {
            $total = $transfer_history->filter_count($keyword, $strfromday, $strtoday, $ofset, $limit);

            if ($page == '' || $page < 0) $page = 1;
            $paging->limit = $limit = $setup['perpage'];
            $ofset = ($page - 1) * $paging->limit;
            $paging->page = $page;
            $paging->total = $total;
            $page_html = $paging->display_ajax3();

            $transfer_history->set('is_deposit', $is_deposit);
            $l = $transfer_history->filter($keyword, $strfromday, $strtoday, $ofset, $limit);

            $sum = $transfer_history->filter_total($keyword, $strfromday, $strtoday, $ofset, $limit);

            $kq['lItems']       = $l;
            $kq['records']      = $total;
            $kq['sum']          = $sum;
            $kq['page_html']    = $page_html;

            echo 'done##', $main->toJsonData(200, 'success', $kq);

            unset($l);
            unset($kq);
            unset($page_html);
        }
    }else if( $nod == 'detail_investor' ){

        $username   = $main->post('username');

        $status_code             = 403;
        $result = $api->exeAPIAdmin( 'GET', $username.'/accounts/?fields=id,number,status.balance,status.availableBalance,currency.name,currency.symbol', '', $status_code );

        if( $status_code == 200 ){
            
            $investor->set('username', $username);
            $kq['fullname'] = $investor->get_fullname();

            //thành công
            $result = json_decode( $result, true );
            foreach( $result as $key=>$item ){
                if (isset($item['currency']['symbol']) && $item['currency']['symbol'] == 'VND') {
                    $kq['VND'] = $item['status']['availableBalance'];
                }
                // if( isset( $item['currency']['symbol'] ) && $item['currency']['symbol'] == 'BRS' ){
                //     $kq['balance'] = $item['status']['availableBalance'];
                // }else if( isset( $item['currency']['symbol'] ) && $item['currency']['symbol'] == 'VND' ){
                //     $kq['balance'] = $item['status']['availableBalance'];
                // }else if( isset( $item['currency']['symbol'] ) && $item['currency']['symbol'] == 'VNDC' ){
                //     $kq['balance'] = $item['status']['availableBalance'];
                // }else if( isset( $item['currency']['symbol'] ) && $item['currency']['symbol'] == 'VSG' ){
                //     $kq['balance'] = $item['status']['availableBalance'];
                // }
            }

            echo  'done##',$main->toJsonData( 200, 'success', $kq );

        }else{
            echo  'done##',$main->toJsonData( 403, 'Lỗi kết nối đến ngân hàng Cyclos!', $result );
        }

       
    }else if( $nod == 'dpoint_investor' ){

        $id   = $main->post('id');

        $status_code             = 403;
        $result = $api->exeAPIAdmin( 'GET', $id.'/accounts/?fields=id,number,status.balance,status.availableBalance,currency.name,currency.symbol', '', $status_code );

        if( $status_code == 200 ){
            
            $investor->set('id', $id);
            $kq['fullname'] = $investor->get_fullname_by_id();

            //thành công
            $result = json_decode( $result, true );
            foreach( $result as $key=>$item ){
                if( isset( $item['currency']['symbol'] ) && $item['currency']['symbol'] == 'VND' ){
                    $kq['VND'] = $item['status']['availableBalance'];
                }else if( isset( $item['currency']['symbol'] ) && $item['currency']['symbol'] == 'VNDC' ){
                    $kq['VNDC'] = $item['status']['availableBalance'];
                }else if( isset( $item['currency']['symbol'] ) && $item['currency']['symbol'] == 'BRS' ){
                    $kq['BRS'] = $item['status']['availableBalance'];
                }else if( isset( $item['currency']['symbol'] ) && $item['currency']['symbol'] == 'VSG' ){
                    $kq['VSG'] = $item['status']['availableBalance'];
                }
            }

            echo  'done##',$main->toJsonData( 200, 'success', $kq );

        }else{
            echo  'done##',$main->toJsonData( 403, 'Lỗi kết nối đến ngân hàng Cyclos!', $result );
        }

       
    }else if( $nod == 'search_investor' ){

        $keyword            = $main->post('keyword');

        // $status_code        = 403;
        // $post['']           = $keyword;
        // $result             = $api->exeAPIAdmin( 'GET','' , '', $status_code );
        $l = $investor->list_by( $keyword, '', '' );

        echo  'done##',$main->toJsonData( 200, 'success', $l );

    }else{
        echo 'Missing nod';
        $db->close();
        exit(); 
    }

}else if( $act == 'deposit' ){

    if( $nod == 'add' ){

        $username       = $main->post('username');
        $fullname       = $main->post('fullname');
        $user_id        = $main->post('user_id');
        $amount         = $main->post('amount', 'number');
        $description    = $main->post('description');
        // $type           = $main->post('type');

        // $payment_type = "";

        //         if ($type == "dBRS") {
        //             $payment_type = $setup['cyclos_payment_type_for_dcash_transfer'];
        //         } else if ($type == "dVND") {
        //             $payment_type = $setup['cyclos_payment_type_for_deposit'];
        //         } else if ($type == "dVNDC") {
        //             $payment_type = $setup['cyclos_payment_type_for_transfer_dss'];
        //         } else if ($type == "dVSG") {
        //             $payment_type = "";
        //         }

        $status                 = 403;
        $post['amount']         = $amount;
        $post['description']    = $description;
        $post['subject']        = $username;
        $result = $api->exeAPIPaymentbBetween2User( $setup['cyclos_payment_type_for_deposit'], $setup['transfer_fund_account'], $post, $status );
        
        if( $status == 201 ){

            $dt = json_decode($result, true);
            $cyclos_transaction_id = '';
            if( $dt ){
                $cyclos_transaction_id = $dt['transactionNumber'];
            }

            $transfer_history->set('related_name', $fullname);
            $transfer_history->set('related_account', $username);
            $transfer_history->set('related_id', $user_id);
            $transfer_history->set('amount', $amount);
            $transfer_history->set('is_deposit', 1);
            $transfer_history->set('fee', 0);
            $transfer_history->set('cyclos_transaction_id', $cyclos_transaction_id );
            $transfer_history->set('description', $description);
            $transfer_history->set('created_by', $dUserLogin['id']);
            $transfer_history_id = $transfer_history->add();

            $subject = 'Cộng tiền tài khoản';
            $content = 'Bạn vừa được cộng '.number_format( $amount, $setup['decimal'], '.', ',').'. Nội dung nạp: '.$description;
            $notification->set('to', $username.';');
            $notification->set('subject', $subject );
            $notification->set('content', $content);
            $notification->set('created_by', $dUserLogin['id']);
            $notification_id = $notification->add();

            $p['to']        = '/topics/username_'.$username;
            $p['priority']  = 'high';
            $p['notification_id']  = $notification_id;
            $ii['title']    = $subject;
            $ii['body']     = $content;
            $p['notification'] = $ii;
            $main->sendFCM( $p );

            $transfer_history->set('id', $transfer_history_id);
            $dT = $transfer_history->get_detail();
            
            echo 'done##',$main->toJsonData( 200, 'success', $dT );

            unset( $dT );

        }else{
            echo 'done##',$main->toJsonData( 403, 'Lỗi thanh toán từ ngân hàng Cyclos!', $result );
        }

    }else{
        echo 'Missing nod';
        $db->close();
        exit(); 
    }

}else if( $act == 'withdraw' ){

    if( $nod == 'add' ){

        $username       = $main->post('username');
        $fullname       = $main->post('fullname');
        $user_id        = $main->post('user_id');
        $amount         = $main->post('amount', 'number');
        $description    = $main->post('description');

        // $type           = $main->post('type');

        // $payment_type = "";

        //         if ($type == "wBRS") {
        //             $payment_type = $setup['cyclos_payment_type_for_dcash_transfer'];
        //         } else if ($type == "wVND") {
        //             $payment_type = $setup['cyclos_payment_type_for_deposit'];
        //         } else if ($type == "wVNDC") {
        //             $payment_type = $setup['cyclos_payment_type_for_transfer_dss'];
        //         } else if ($type == "wVSG") {
        //             $payment_type = "";
        //         }

        $status                 = 403;
        $post['amount']         = $amount;
        $post['description']    = $description;
        $post['subject']        = $setup['receive_fund_account'];
        $result = $api->exeAPIPaymentbBetween2User( $setup['cyclos_payment_type_for_deposit'], $username, $post, $status );
        
        if( $status == 201 ){

            $dt = json_decode($result, true);
            $cyclos_transaction_id = '';
            if( $dt ){
                $cyclos_transaction_id = $dt['transactionNumber'];
            }

            $transfer_history->set('related_name', $fullname);
            $transfer_history->set('related_account', $username);
            $transfer_history->set('related_id', $user_id);
            $transfer_history->set('amount', $amount);
            $transfer_history->set('is_deposit', 0);//withdraw
            $transfer_history->set('fee', 0);
            $transfer_history->set('cyclos_transaction_id', $cyclos_transaction_id );
            $transfer_history->set('description', $description);
            $transfer_history->set('created_by', $dUserLogin['id']);
            $transfer_history_id = $transfer_history->add();

            $subject = 'Trừ tiền tài khoản';
            $content = 'Tài khoản của bạn đã bị trừ '.number_format( $amount, $setup['decimal'], '.', ',').'. Nội dung trừ: '.$description;
            $notification->set('to', $username.';');
            $notification->set('subject', $subject );
            $notification->set('content', $content);
            $notification->set('created_by', $dUserLogin['id']);
            $notification_id = $notification->add();

            $p['to']        = '/topics/username_'.$username;
            $p['priority']  = 'high';
            $p['notification_id']  = $notification_id;
            $ii['title']    = $subject;
            $ii['body']     = $content;
            $p['notification'] = $ii;
            $main->sendFCM( $p );
            
            $transfer_history->set('id', $transfer_history_id);
            $dT = $transfer_history->get_detail();
            
            echo 'done##',$main->toJsonData( 200, 'success', $dT );

            unset( $dT );
        }else{
            echo 'done##',$main->toJsonData( 403, 'Lỗi thanh toán từ ngân hàng Cyclos!', $result );
        }

    }else{
        echo 'Missing nod';
        $db->close();
        exit(); 
    }

}else if( $act == 'vnd' ){
    if($nod = 'filter'){
        $id = $main->post('id');
        $status_code = 403;
        $result = $api->exeAPIAdmin( 'GET', $id.'/transactions', '', $status_code );
        if($status_code == 200){
            $result = json_decode( $result, true );
            foreach( $result as $key=>$item ){
                if($item['currency']=="vnd"){
                    $item['day'] = strtotime($item['date']);
                    $kq[] = $item;
                }
            }
            echo  'done##',$main->toJsonData( 200, 'success', $kq );    
        }else{
            echo  'done##',$main->toJsonData( 403, 'Lỗi kết nối đến ngân hàng Cyclos!', $result );
        }
    }

}else if( $act == 'vndc' ){

    if($nod = 'filter'){
        $id = $main->post('id');
        $status_code = 403;
        $result = $api->exeAPIAdmin( 'GET', $id.'/transactions', '', $status_code );
        if($status_code == 200){
            $result = json_decode( $result, true );
            foreach( $result as $key=>$item ){
                if($item['currency']=="vndc"){
                $item['day'] = strtotime($item['date']);
                $kq[] = $item;
                }
            }
            echo  'done##',$main->toJsonData( 200, 'success', $kq );    
        }else{
            echo  'done##',$main->toJsonData( 403, 'Lỗi kết nối đến ngân hàng Cyclos!', $result );
        }
    }

}else if( $act == 'brs' ){

    if($nod = 'filter'){
        $id = $main->post('id');
        $status_code = 403;
        $result = $api->exeAPIAdmin( 'GET', $id.'/transactions', '', $status_code );
        if($status_code == 200){
            $result = json_decode( $result, true );
            foreach( $result as $key=>$item ){
                if($item['currency']=="brs"){
                $item['day'] = strtotime($item['date']);
                $kq[] = $item;
                }
            }
            echo  'done##',$main->toJsonData( 200, 'success', $kq );    
        }else{
            echo  'done##',$main->toJsonData( 403, 'Lỗi kết nối đến ngân hàng Cyclos!', $result );
        }
    }

}else if( $act == 'vsg' ){

    if($nod = 'filter'){
        $id = $main->post('id');
        $status_code = 403;
        $result = $api->exeAPIAdmin( 'GET', $id.'/transactions', '', $status_code );
        if($status_code == 200){
            $result = json_decode( $result, true );
            foreach( $result as $key=>$item ){
                if($item['currency']=="vsg"){
                $item['day'] = strtotime($item['date']);
                $kq[] = $item;
                }
            }
            echo  'done##',$main->toJsonData( 200, 'success', $kq );    
        }else{
            echo  'done##',$main->toJsonData( 403, 'Lỗi kết nối đến ngân hàng Cyclos!', $result );
        }
    }

}else{
    echo 'Missing action';
    $db->close();
    exit(); 
}