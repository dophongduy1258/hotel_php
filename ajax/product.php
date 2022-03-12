<?php
$nod        = $main->get('nod');
if( $act == 'idx' ){
    if( $nod == 'initial' ){
        //opt_province

        $kq['opt_province'] = '<option selected value="">Tất cả tỉnh/ thành</option>'.$province->opt_all();
        $kq['opt_full_city'] = $city->opt_all_by();
        
        echo 'done##',$main->toJsonData( 200, 'success', $kq );
        unset( $kq );

    }else if( $nod == 'filter' ){

        $keyword        = $main->post('keyword');
        $province_id    = $main->post('province_id');
        $city_id        = $main->post('city_id');
        $status         = $main->post('status');
        $page           = $main->post('page');

        $product->set('province_id', $province_id);
        $product->set('city_id', $city_id);
        $product->set('status', $status);

        if( $page < 1) $page = 1;

        $limit = $setup['perpage'];
        $ofset = ($page -1)*$limit;

        $l = $product->list_by( $keyword, $ofset, $limit );

        echo 'done##',$main->toJsonData( 200, 'success', $l );

        unset( $l );


    }else if( $nod == 'list_investor' ){
        $product_id    			= $main->post('product_id');
        
        $product_history->set('product_id', $product_id);
        $l = $product_history->list_bought_by_product_id();

        echo  'done##',$main->toJsonData( 200, 'success', $l );
        unset( $l );

    }else if( $nod == 'detail' ){
        $id    			= $main->post('product_id');
        
        $product->set('id', $id);
        $d = $product->get_detail();

        $d['images'] = explode( ';', $d['images']);
        unset($d['images'][COUNT($d['images'])-1]);
        
        echo  'done##',$main->toJsonData( 200, 'success', $d );
        unset( $d );

    }else if( $nod == 'load_city' ){

        $province_id    			= $main->post('province_id');

        $city->set('province_id', $province_id);
        $kq['opt_city'] = '<option selected value="">Tất cả quận/ huyện</option>'.$city->opt_by();

        echo 'done##',$main->toJsonData( 200, 'success', $kq );
        unset( $kq );
        
    }else if( $nod == 'delete' ){
        
        $id    			= $main->post('id');

        $product->set('id', $id);
        $product->delete();

        echo  'done##',$main->toJsonData( 200, 'success', null );
    }else if( $nod == 'top' ){
        
        $id    			= $main->post('id');
        
        $product->set('id', $id);
        $product->update_top();

        echo  'done##',$main->toJsonData( 200, 'success', null );
        
    }else{
        echo 'Missing nod';
        $db->close();
        exit(); 
    }
}else if( $act == 'product_history' ){
    if( $nod == 'detail' ){

        $id = $main->post('id');

        $product_history->set('id', $id);
        $dProHis = $product_history->get_detail();

        if( isset($dProHis['id']) && ($dProHis['status'] == 0 || $dProHis['status'] == 1) ){

            // $product_history->set( 'username', $dProHis['username'] );
            // $product_history->set( 'product_id', $dProHis['product_id'] );
            // $dSum = $product_history->summary_bought_by();

            $kq['username']     = $dProHis['username'];
            $kq['fullname']     = $dProHis['fullname'];
            $kq['slots']        = $dProHis['slots'];
            $kq['total']        = $dProHis['total'];
            $kq['price']        = $dProHis['price'];

            $status_code             = 403;
	        $result = $api->exeAPIAdmin( 'GET', $dProHis['username'].'/accounts/?fields=id,number,status.balance,status.availableBalance,currency.name,currency.symbol', '', $status_code );

            if( $status_code == 200 ){
                
                //thành công
                $result = json_decode( $result, true );
                foreach( $result as $key=>$item ){
                    if( isset( $item['currency']['symbol'] ) && $item['currency']['symbol'] == $setup['main_current'] ){
                        $kq['balance'] = $item['status']['availableBalance'];
                    }
                }

                echo  'done##',$main->toJsonData( 200, 'success', $kq );

            }else{
                echo  'done##',$main->toJsonData( 403, 'Lỗi kết nối đến ngân hàng Cyclos!', $result );
            }

        }else{
            echo  'done##',$main->toJsonData( 403, 'Không tìm thấy giao dịch này', null );
        }

    }else if( $nod == 'modify' ){

        //modify and delete
        $id         = $main->post('id');
        $amount     = $main->post('amount', 'number');
        $is_delete  = $main->post('is_delete');

        $product_history->set('id', $id);
        $dProHis = $product_history->get_detail();

        if( isset($dProHis['id']) && ($dProHis['status'] == 0 || $dProHis['status'] == 1) ){
            if( $amount == $dProHis['slots'] ) $is_delete = 1;
            
            $product->set('id', $dProHis['product_id']);
            $dProduct = $product->get_detail();

            if( $is_delete == 0 ){
                //modify: tạo record mới với số lượng xóa và update lại record cũ
                if( $amount > 0 && $amount < $dProHis['slots'] ){
                    //modify

                    //tiến hành refund trước
                    $status                 = 403;
                    $post['amount']         = $dProHis['price']*$amount;
                    $post['description']    = 'Nhận tiền trả lại '.$amount.' suất từ giao dịch: #'.$dProHis['id'].' của bất động sản #'.$dProHis['product_id'];
                    $post['subject']        = $dProHis['username'];//user nhận fund
                    $result = $api->exeAPIPaymentbBetween2User( $setup['cyclos_payment_type_for_deposit'], $dProduct['receive_fund_account'], $post, $status );

                    if( $status == 201 ){

                        $dt = json_decode( $result, true );
                        if( $dt ){

                            //tạo record xóa với thông tin từ record mẹ: sau khi refund
                            $product_history->set('cyclos_transaction_id_principal', $dt['transactionNumber']);
                            $product_history->set('product_id', $dProHis['product_id'] );
                            $product_history->set('username', $dProHis['username'] );
                            $product_history->set('fullname', $dProHis['fullname'] );
                            $product_history->set('price', $dProHis['price'] );
                            $product_history->set('slots', $amount );
                            $product_history->set('cyclos_transaction_id', $dProHis['id'] );
                            $product_history->add_cancel_record();

                            //cập nhật lại số lượng của record xóa: sau khi refund
                            $product_history->set('id', $dProHis['id']);
                            $product_history->set('slots', $dProHis['slots'] - $amount );
                            $product_history->update_slots_transaction();
                            
                            //update slots lại cho product
                            $product->set('id', $dProHis['product_id']);
                            $product->update_refund_slots( $amount );

                        }
                        unset( $dt );

                        echo  'done##',$main->toJsonData( 200, 'success', null );

                    }else{
                        echo  'done##',$main->toJsonData( 403, 'Lỗi trả lại tiền từ ngân hàng Cyclos!', null );
                    }

                }else{
                    //lỗi số lượng hủy không hợp lệ
                    echo  'done##',$main->toJsonData( 403, 'Số lượng cần hủy không hợp lệ! Số lượng tối đa được hủy là: '. $dProHis['amount'], null );
                }

            }else{
                
                //delete => chuyển trạng thái record sang hủy và refund lại tiền
                $status                 = 403;
                $post['amount']         = $dProHis['total'];
                $post['description']    = 'Nhận tiền trả lại từ giao dịch: #'.$dProHis['id'].' của bất động sản #'.$dProHis['product_id'];
                $post['subject']        = $dProHis['username'];//user nhận fund
                $result = $api->exeAPIPaymentbBetween2User( $setup['cyclos_payment_type_for_deposit'], $dProduct['receive_fund_account'], $post, $status );

                if( $status == 201 ){

                    $dt = json_decode( $result, true );
                    if( $dt ){
                        $product_history->set('id', $dProHis['id']);
                        $product_history->set('cyclos_transaction_id_principal', $dt['transactionNumber']);
                        $product_history->update_delete_transaction();
                    }
                    unset( $dt );

                    echo  'done##',$main->toJsonData( 200, 'success', null );

                }else{
                    echo  'done##',$main->toJsonData( 403, 'Lỗi trả lại tiền từ ngân hàng Cyclos!', null );
                }

            }
        }else{
            echo  'done##',$main->toJsonData( 403, 'Không tìm thấy giao dịch này', null );
        }


    }else if( $nod == 'detail_investor' ){

        $product_id = $main->post('product_id');
        $username   = $main->post('username');

        $product->set('id', $product_id);
        $dPro = $product->get_detail();

        if( isset($dPro['id'])  ){

            $investor->set('username', $username);
            $kq['fullname'] = $investor->get_fullname();

            $product_history->set( 'username', $username );
            $product_history->set( 'product_id', $product_id );
            $dSum = $product_history->summary_bought_by();
            
            $kq['slots'] =  0;
            $kq['value'] =  0;
            $kq['price'] =  $dPro['price'];

            if( isset($dSum[0]['slots']) ){
                $kq['slots'] = $dSum[0]['slots'];
                $kq['value'] = $dSum[0]['value'];
            }

            $status_code             = 403;
	        $result = $api->exeAPIAdmin( 'GET', $username.'/accounts/?fields=id,number,status.balance,status.availableBalance,currency.name,currency.symbol', '', $status_code );

            if( $status_code == 200 ){
                
                //thành công
                $result = json_decode( $result, true );
                foreach( $result as $key=>$item ){
                    if( isset( $item['currency']['symbol'] ) && $item['currency']['symbol'] == $setup['main_current'] ){
                        $kq['balance'] = $item['status']['availableBalance'];
                    }
                }

                echo  'done##',$main->toJsonData( 200, 'success', $kq );

            }else{
                echo  'done##',$main->toJsonData( 403, 'Lỗi kết nối đến ngân hàng Cyclos!', $result );
            }

        }else{
            echo  'done##',$main->toJsonData( 403, 'Không tìm thấy giao dịch này', null );
        }

    }else if( $nod == 'search_investor' ){

        $keyword            = $main->post('keyword');

        // $status_code        = 403;
        // $post['']           = $keyword;
        // $result             = $api->exeAPIAdmin( 'GET','' , '', $status_code );
        $l = $investor->list_by( $keyword, '', '' );

        echo  'done##',$main->toJsonData( 200, 'success', $l );
    
    }else if( $nod == 'new_record' ){

        $id                 = $main->post('product_id');
        $slots              = $main->post('amount', 'number') + 0;
        $total              = $main->post('total', 'number') +0;
        $username           = $main->post('username');
        $fullname           = $main->post('fullname');

        if( $slots > 0 ){
            $product->set( 'id', $id );
            $dItem = $product->get_detail();
            if( isset($dItem['id']) ){
                //Thêm vào lịch sử record mới cho user này

                if( ($dItem['slots_total'] - $dItem['slots_sold']) >= $slots ){

                    $status                 = 403;
                    $post['amount']         = $total;
                    $post['description']    = 'Bạn đã đầu tư thành công '.$slots.' suất vào '.$dItem['title'];
                    $post['subject']        = $dItem['receive_fund_account'];//user nhận fund: khi user nhận suất đầu tư
                    $result = $api->exeAPIPaymentbBetween2User( $setup['cyclos_payment_type_for_deposit'], $username, $post, $status );
                    
                    if( $status == 201 ){

                        $dt = json_decode($result, true);
                        $cyclos_transaction_id = '';
                        if( $dt ){
                            $cyclos_transaction_id = $dt['transactionNumber'];
                        }

                        $product_history->set('product_id', $id );
                        $product_history->set('username', $username );
                        $product_history->set('fullname', $fullname );
                        $product_history->set('price', $dItem['price'] );
                        $product_history->set('slots', $slots );
                        $product_history->set('cyclos_transaction_id', $cyclos_transaction_id );
                        $product_history->set('total', $dItem['price']*$slots );
                        $product_history->add();
                        
                        $product->set( 'id', $id );
                        $product->set( 'slots_sold', $dItem['slots_sold']+$slots );
                        $product->update_slots_sold();

                        $subject = 'Đầu tư thành công';
                        $content = 'Bạn đã đầu tư thành công '.$slots.' suất vào '.$dItem['title'];
                        $notification->set('to', $dInvestor['username'].';');
                        $notification->set('subject', $subject );
                        $notification->set('content', $content);
                        $notification->set('created_by', 0);
                        $notification_id = $notification->add();

                        $p['to'] = '/topics/username_'.$dInvestor['username'];
                        $p['priority']  = 'high';
                        $p['notification_id']  = $notification_id;
                        $ii['title']  = $subject;
                        $ii['body']   = $content;
                        $p['notification'] = $ii;
                        $main->sendFCM( $p );
                        
                        echo 'done##',$main->toJsonData( 200, 'success', null );

                    }else{
                        echo 'done##',$main->toJsonData( 403, 'Lỗi thanh toán từ ngân hàng Cyclos!', null );
                    }

                }else{
                    echo 'done##',$main->toJsonData( 403, 'Bạn đang mua vượt quá số lượng còn lại là '.($dItem['slots_total'] - $dItem['slots_sold']).'.', null );
                }

            }else{
                echo 'done##',$main->toJsonData( 403, 'Không tìm thấy sản phẩm này.', null );
            }
        }else{
            echo 'done##',$main->toJsonData( 403, 'Số lượng mua phải lớn hơn không.', null );
        }
    

    }else{
        echo 'Missing nod';
        $db->close();
        exit();
    }
}else if( $act == 'delete' ){
    
    if( $nod == 'delete' ){
        
        $id    			= $main->post('id');

        $product->set('id', $id);
        $product->delete();

        echo  'done##',$main->toJsonData( 200, 'success', null );
        
    }else{
       echo 'Missing nod';
        $db->close();
        exit(); 
    }
}else if( $act == 'clone' ){
    
    if( $nod == 'clone' ){
        
        $id    			= $main->post('id');
        $created_by     = $dUserLogin['id'];

        $product->set('id', $id);
        $product->set('created_by', $created_by );
        $product->clonex();

        echo  'done##',$main->toJsonData( 200, 'success', null );
        
    }else{
       echo 'Missing nod';
        $db->close();
        exit(); 
    }

}else if( $act == 'hidden' ){
    
    if( $nod == 'hidden' ){
        
        $id    			= $main->post('id');
        $created_by     = $dUserLogin['id'];

        $product->set('id', $id);
        $product->update_is_hidden();
        
        echo  'done##',$main->toJsonData( 200, 'success', null );
        
    }else{
       echo 'Missing nod';
        $db->close();
        exit(); 
    }

}else if( $act == 'ROI' ){

    if( $nod == 'execute_ROI_principal' ){//chia lãi và trả gốc:delivery

        // if( $dUserLogin['gid'] == '0' ){

            $product_id    			= $main->post('product_id');
            $password    			= $main->post('password');

            $password = md5(md5($password).$dUserLogin['salt']);
            
            if( $password == $dUserLogin['password'] ){
                $product->set('id', $product_id);
                $d = $product->get_detail();

                $product_history->set('product_id', $product_id);
                $l = $product_history->list_by();
                
                $fail1[]       = array();
                $fail2[]       = array();
                foreach ($l as $key => $item) {
                    $status                 = 403;
                    $post['amount']         = $item['total'];
                    $post['description']    = 'Nhận lại gốc dự án: #'.$d['code'];
                    $post['subject']        = $item['username'];//user nhận fund
                    $result = $api->exeAPIPayment( $setup['cyclos_payment_type_for_deposit'], $post, $status );

                    if( $status != 200 ){

                        $dt = json_decode($result, true);
                        if( $dt ){
                            $product_history->set('id', $item['id']);
                            $product_history->set('cyclos_transaction_id_principal', $dt['transactionNumber']);
                            $product_history->update_done_transaction();
                        }
                        unset( $dt );

                        $fail1[]       = array( 'id'             =>$item['id'],
                                                'total'         => $item['total'],
                                                'username'      => $item['username'],
                                                'fullname'      => $item['fullname']
                                                );
                    }

                    $status                 = 403;
                    $post['amount']         = (int)($item['total']*$d['ROI']);
                    $post['description']    = 'Nhận lãi dự án: #'.$d['code'];
                    $post['subject']        = $item['username'];//user nhận fund
                    $result = $api->exeAPIPayment( $setup['cyclos_payment_type_for_deposit'], $post, $status );

                    if( $status != 200 ){

                        $dt = json_decode($result, true);
                        if( $dt ){
                            $product_history->set('id', $item['id']);
                            $product_history->set('cyclos_transaction_id_ROI', $dt['transactionNumber']);
                            $product_history->update_done_transaction();
                        }
                        unset( $dt );

                        $fail2[]       = array( 'id'             =>$item['id'],
                                                'total'         => $item['total'],
                                                'username'      => $item['username'],
                                                'fullname'      => $item['fullname']
                                                );
                    }
                }
                
                echo  'done##',$main->toJsonData( 200, 'success', array($fail1, $fail2) );
                unset( $l );
            }else{
                echo  'done##',$main->toJsonData( 403, 'Mật khẩu xác nhận chưa đúng!', null );
            }
        // }else{
        //     echo  'done##',$main->toJsonData( 403, 'Chỉ Admin mới được thực hiện thao tác này.', null );
        // }

    }else if( $nod == 'execute_ROI' ){//chia lãi

        // if( $dUserLogin['gid'] == '0' ){

            $product_id    			= $main->post('product_id');
            $password    			= $main->post('password');

            $password = md5(md5($password).$dUserLogin['salt']);
            
            if( $password == $dUserLogin['password'] ){
                $product->set('id', $product_id);
                $d = $product->get_detail();

                $product_history->set('product_id', $product_id);
                $l = $product_history->list_by();
                
                $fail[]       = array();
                foreach ($l as $key => $item) {
                    $status                 = 403;
                    
                    $post['amount']         = (int)($item['total']*$d['ROI']);
                    $post['description']    = 'Nhận lãi dự án: #'.$d['code'];
                    $post['subject']        = $item['username'];//user nhận fund
                    $result = $api->exeAPIPayment( $setup['cyclos_payment_type_for_deposit'], $post, $status );

                    if( $status != 200 ){

                        $dt = json_decode($result, true);
                        if( $dt ){
                            $product_history->set('id', $item['id']);
                            $product_history->set('cyclos_transaction_id_ROI', $dt['transactionNumber']);
                            $product_history->update_done_transaction();
                        }
                        unset( $dt );

                        $fail[]       = array( 'id'             =>$item['id'],
                                                'total'         => $item['total'],
                                                'username'      => $item['username'],
                                                'fullname'      => $item['fullname']
                                                );
                    }
                }

                echo  'done##',$main->toJsonData( 200, 'success', $fail );
                unset( $l );
            }else{
                echo  'done##',$main->toJsonData( 403, 'Mật khẩu xác nhận chưa đúng!', null );
            }
        // }else{
        //     echo  'done##',$main->toJsonData( 403, 'Chỉ Admin mới được thực hiện thao tác này.', null );
        // }

    }else if( $nod == 'execute_principal' ){//trả gốc 

        // if( $dUserLogin['gid'] == '0' ){

            $product_id    			= $main->post('product_id');
            $password    			= $main->post('password');

            $password = md5(md5($password).$dUserLogin['salt']);
            
            if( $password == $dUserLogin['password'] ){
                $product->set('id', $product_id);
                $d = $product->get_detail();

                $product_history->set('product_id', $product_id);
                $l = $product_history->list_by();
                
                $fail[]       = array();
                foreach ($l as $key => $item) {
                    $status                 = 403;
                    
                    $post['amount']         = $item['total'];
                    $post['description']    = 'Nhận lại gốc dự án: #'.$d['code'];
                    $post['subject']        = $item['username'];//user nhận fund
                    $result = $api->exeAPIPayment( $setup['cyclos_payment_type_for_deposit'], $post, $status );

                    if( $status != 200 ){

                        $dt = json_decode($result, true);
                        if( $dt ){
                            $product_history->set('id', $item['id']);
                            $product_history->set('cyclos_transaction_id_principal', $dt['transactionNumber']);
                            $product_history->update_done_transaction();
                        }
                        unset( $dt );
                        
                        $fail[]       = array( 'id'       =>$item['id'],
                                            'total'     => $item['total'],
                                            'username'  => $item['username'],
                                            'fullname'  => $item['fullname']
                                            );
                    }
                }

                echo  'done##',$main->toJsonData( 200, 'success', $fail );
                unset( $l );
            }else{
                echo  'done##',$main->toJsonData( 403, 'Mật khẩu xác nhận chưa đúng!', null );
            }
        // }else{
        //     echo  'done##',$main->toJsonData( 403, 'Chỉ Admin mới được thực hiện thao tác này.', null );
        // }
    }else{
       echo 'Missing nod';
        $db->close();
        exit(); 
    }

}else if( $act == 'edit' ){

    if( $nod == 'edit' ){

        $id    			    = $main->post('id');
        $code    			= $main->post('code');
        $city_id        	= $main->post('city_id');
        $title        		= $main->post('title');
        $description        = $main->post('description');
        $price        		= $main->post('price', 'number');
        $slots_sold        	= $main->post('slots_sold', 'number');
        $status        		= $main->post('status');
        $slots_total        = $main->post('slots_total', 'number');
        $price_sold        	= $main->post('price_sold', 'number');
        $fee_total        	= $main->post('fee_total', 'number');
        $fee_detail        	= $main->post('fee_detail');
        $images        		= $main->post('images');
        $receive_fund_account 	= $main->post('receive_fund_account');
        $receive_fund_fullname 	= $main->post('receive_fund_fullname');
        $created_by        	= $dUserLogin['id'];

        $price				= $main->number($price);
        $slots_total		= $main->number($slots_total);
        $price_sold			= $main->number($price_sold);
        $fee_total			= $main->number($fee_total);

        //get province_id
        $city->set('id', $city_id);
        $dCity = $city->get_detail();

        $product->set( 'id', $id );
        $product->set( 'code', $code );
        $product->set( 'province_id', $dCity['province_id'] ); unset( $dCity );
        $product->set( 'city_id', $city_id );
        $product->set( 'title', $title );
        $product->set( 'description', $description );
        $product->set( 'price', $price );
        $product->set( 'slots_sold', $slots_sold );
        $product->set( 'status', $status );
        $product->set( 'slots_total', $slots_total );
        $product->set( 'price_sold', $price_sold );
        $product->set( 'fee_total', $fee_total );
        $product->set( 'fee_detail', $fee_detail );
        $product->set( 'images', $images );
        $product->set( 'receive_fund_account', $receive_fund_account );
        $product->set( 'receive_fund_fullname', $receive_fund_fullname );
        $product->set( 'created_by', $created_by );

        $dProByID = '';
        if( $id != '' )
            $dProByID = $product->get_detail();
        
        if( !isset($dProByID['id']) ){
            //add product
            $dProCode = $product->get_detail_by_code();
            if( !isset($dProCode['id']) ){
                // $product->add();
                echo  'done##',$main->toJsonData( 200, 'success', null );
            }else{
                echo  'done##',$main->toJsonData( 403, 'Mã sản phẩm này đã tồn tại.', null );
                unset( $dProCode );
            }
        }else{
            //update product
            $dProCode = $product->get_detail_by_code();
            if( !isset($dProCode['id']) || $dProCode['id'] == $id ){
                $product->update();
                echo  'done##',$main->toJsonData( 200, 'success', null );
            }else{
                echo  'done##',$main->toJsonData( 403, 'Mã sản phẩm này đã tồn tại.', null );
                unset( $dProCode );
            }
        }
    }else{
       echo 'Missing nod';
        $db->close();
        exit(); 
    }
}else if( $act == 'add' ){

   if( $nod == 'add' ){

        $id    			    = $main->post('id');
        $code    			= $main->post('code');
        $city_id        	= $main->post('city_id');
        $title        		= $main->post('title');
        $description        = $main->post('description');
        $price        		= $main->post('price', 'number');
        $slots_sold        	= $main->post('slots_sold', 'number');
        $status        		= $main->post('status');
        $slots_total        = $main->post('slots_total', 'number');
        $price_sold        	= $main->post('price_sold', 'number');
        $fee_total        	= $main->post('fee_total', 'number');
        $fee_detail        	= $main->post('fee_detail');
        $images        		= $main->post('images');
        $receive_fund_account 	= $main->post('receive_fund_account');
        $receive_fund_fullname 	= $main->post('receive_fund_fullname');
        $created_by        	= $dUserLogin['id'];

        $price				= $main->number($price);
        $slots_total		= $main->number($slots_total);
        $price_sold			= $main->number($price_sold);
        $fee_total			= $main->number($fee_total);

        //get province_id
        $city->set('id', $city_id);
        $dCity = $city->get_detail();

        $product->set( 'id', $id );
        $product->set( 'code', $code );
        $product->set( 'province_id', $dCity['province_id'] ); unset( $dCity );
        $product->set( 'city_id', $city_id );
        $product->set( 'title', $title );
        $product->set( 'description', $description );
        $product->set( 'price', $price );
        $product->set( 'slots_sold', $slots_sold );
        $product->set( 'status', $status );
        $product->set( 'slots_total', $slots_total );
        $product->set( 'price_sold', $price_sold );
        $product->set( 'fee_total', $fee_total );
        $product->set( 'fee_detail', $fee_detail );
        $product->set( 'images', $images );
        $product->set( 'receive_fund_account', $receive_fund_account );
        $product->set( 'receive_fund_fullname', $receive_fund_fullname );
        $product->set( 'created_by', $created_by );

        $dProByID = '';
        if( $id != '' )
            $dProByID = $product->get_detail();
        
        if( !isset($dProByID['id']) ){
            //add product
            $dProCode = $product->get_detail_by_code();
            if( !isset($dProCode['id']) ){
                $product->add();
                echo  'done##',$main->toJsonData( 200, 'success', null );
            }else{
                echo  'done##',$main->toJsonData( 403, 'Mã sản phẩm này đã tồn tại.', null );
                unset( $dProCode );
            }
        }else{
            //update product
            $dProCode = $product->get_detail_by_code();
            if( !isset($dProCode['id']) || $dProCode['id'] == $id ){
                // $product->update();
                echo  'done##',$main->toJsonData( 200, 'success', null );
            }else{
                echo  'done##',$main->toJsonData( 403, 'Mã sản phẩm này đã tồn tại.', null );
                unset( $dProCode );
            }
        }
    }else{
       echo 'Missing nod';
        $db->close();
        exit(); 
    }
}else if( $act == 'province' ){

    if( $nod == 'province_add' ){
        $name       = $main->post('name');

        $province->set('name', $name);
        $province->set('created_by', $dUserLogin['id']);
        $id = $province->add();
        
        $province->set('id', $id);
        $d = $province->get_detail();

        echo 'done##',$main->toJsonData( 200, 'success', $d );
        unset( $d );
    }else if( $nod == 'province_save' ){

        $id         = $main->post('id');
        $name       = $main->post('name');

        $province->set('id', $id);
        $province->set('name', $name);
        $province->update();

        echo 'done##',$main->toJsonData( 200, 'success', null );

    }else if( $nod == 'province_delete' ){

        $id         = $main->post('id');

        $province->set('id', $id);
        $province->delete();
        
        echo 'done##',$main->toJsonData( 200, 'success', null );

    }else{
       echo 'Missing nod';
        $db->close();
        exit(); 
    }

}else if( $act == 'city' ){

    if( $nod == 'city_add' ){

        $province_id    = $main->post('province_id');
        $name           = $main->post('name');

        $city->set('province_id', $province_id);
        $city->set('name', $name);
        $id = $city->add();

        $city->set('id', $id);
        $d = $city->get_detail();

        echo 'done##',$main->toJsonData( 200, 'success', $d );
        unset( $d );

    }else if( $nod == 'city_save' ){

        $id         = $main->post('id');
        $name       = $main->post('name');

        $city->set('id', $id);
        $city->set('name', $name);
        $city->update();

        echo 'done##',$main->toJsonData( 200, 'success', null );

    }else if( $nod == 'city_delete' ){

        $id         = $main->post('id');

        $city->set('id', $id);
        $city->delete();
        
        echo 'done##',$main->toJsonData( 200, 'success', null );

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