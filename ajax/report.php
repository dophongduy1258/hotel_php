<?php
$nod        = $main->get('nod');
if( $act == 'idx' ){

    if( $nod == '' ){

    }else{
        echo 'Missing nod';
        $db->close();
        exit(); 
    }

}else if( $act == 'history' ){

    if( $nod == 'filter' ){

        $keyword        = $main->post('keyword');
        $from           = $main->post('from');
        $to             = $main->post('to');
        $page           = $main->post('page');

        if( $from == '' ){
			$from = date("d/m/Y");
		}
		if( $to == '' ){
			$to = date("d/m/Y");
		}

		if( $main->validateDate( $from, 'd/m/Y' ) && $main->validateDate( $to, 'd/m/Y' ) ){
			
			$strfromday = strtotime($main->convert_strdate( $from )); 
			$strtoday = strtotime($main->convert_strdate( $to )) + 86399;
			
			if( $strfromday < $strtoday ){
                
                if( $page < 1 ) $page = 1;

                $limit  = $setup['perpage'];
                $ofset  = ($page -1)*$limit;
                
                $product_history->set('status', '');
                $total_record = $product_history->list_bought_by_count( $keyword, $strfromday, $strtoday );

                $l = $product_history->list_bought_by( $keyword, $strfromday, $strtoday, $ofset, $limit );

                echo 'done##',$main->toJsonData( 200, 'success', $l );
                
                unset( $l );
            }else{
                echo 'done##',$main->toJsonData( 403, 'Chọn ngày không hợp lệ', null );
            }
		}else{
            echo 'done##',$main->toJsonData( 403, 'Chọn ngày không hợp lệ', null );
        }
        
    }else if( $nod == 'detail_investor' ){
        $username        = $main->post('username');

        $product->set('username', $username);
        $kq = $product->init_static();

        $product_history->set('username', $username);
        $kq['list_invested'] = $product_history->list_bought();

        echo 'done##',$main->toJsonData( 200, 'success', $kq );

        unset( $kq );
    }else if( $nod == 'detail' ){
        $id    			= $main->post('product_id');
        
        $product->set('id', $id);
        $d = $product->get_detail();

        $d['images'] = explode( ';', $d['images']);
        unset($d['images'][COUNT($d['images'])-1]);
        
        echo  'done##',$main->toJsonData( 200, 'success', $d );
        unset( $d );
    }else{
        echo 'Missing nod';
        $db->close();
        exit(); 
    }

}else if( $act == 'ROI' ){
    if( $nod == 'filter' ){

        $keyword        = $main->post('keyword');
        $from           = $main->post('from');
        $to             = $main->post('to');
        $status         = $main->post('status');
        $page           = $main->post('page');

        if( $from == '' ){
			$from = date("d/m/Y");
		}
		if( $to == '' ){
			$to = date("d/m/Y");
		}

		if( $main->validateDate( $from, 'd/m/Y' ) && $main->validateDate( $to, 'd/m/Y' ) ){
			
			$strfromday = strtotime($main->convert_strdate( $from )) - 100*10000000000; 
			$strtoday = strtotime($main->convert_strdate( $to )) + 86399;
			
			if( $strfromday < $strtoday ){
                
                if( $page < 1 ) $page = 1;

                $limit  = $setup['perpage'];
                $ofset  = ($page -1)*$limit;
                
                $product_history->set('status', $status);
                $total_record = $product_history->list_bought_by_count( $keyword, $strfromday, $strtoday );

                $l = $product_history->list_bought_by( $keyword, $strfromday, $strtoday, $ofset, $limit );

                echo 'done##',$main->toJsonData( 200, 'success', $l );
                
                unset( $l );
            }else{
                echo 'done##',$main->toJsonData( 403, 'Chọn ngày không hợp lệ', null );
            }
		}else{
            echo 'done##',$main->toJsonData( 403, 'Chọn ngày không hợp lệ', null );
        }
    }else{
        echo 'Missing nod';
        $db->close();
        exit(); 
    }   

}else if( $act == 'withdraw' ){
    if( $nod == 'filter' ){

        $keyword        = $main->post('keyword');
        $from           = $main->post('from');
        $to             = $main->post('to');
        $status         = $main->post('status');
        $page           = $main->post('page');
        $type           = 'withdraw';

        if( $from == '' ){
			$from = date("d/m/Y");
		}
		if( $to == '' ){
			$to = date("d/m/Y");
		}

		if( $main->validateDate( $from, 'd/m/Y' ) && $main->validateDate( $to, 'd/m/Y' ) ){
			
			$strfromday = strtotime($main->convert_strdate( $from )) - 100*10000000000; 
			$strtoday = strtotime($main->convert_strdate( $to )) + 86399;
			
			if( $strfromday < $strtoday ){
                
                if( $page < 1 ) $page = 1;

                $limit  = $setup['perpage'];
                $ofset  = ($page -1)*$limit;
                
                $transaction_funding->set('type', $type);
                // $total_record = $transaction_funding->filter_count( $keyword, $strfromday, $strtoday );

                $l = $transaction_funding->filter( $keyword, $strfromday, $strtoday, $ofset, $limit );

                echo 'done##',$main->toJsonData( 200, 'success', $l );
                
                unset( $l );
            }else{
                echo 'done##',$main->toJsonData( 403, 'Chọn ngày không hợp lệ', null );
            }
		}else{
            echo 'done##',$main->toJsonData( 403, 'Chọn ngày không hợp lệ', null );
        }

   

    }else{
       echo 'Missing nod';
        $db->close();
        exit(); 
    }

}else if( $act == 'withdraw_done' ){
    
    if( $nod == 'cancel' ){
        
        $id        = $main->post('id');

        $transaction_funding->set( 'id', $id );
        $d = $transaction_funding->get_detail();

        if( isset($d) ){
            if( $d['status'] == 0 ){
                
                if( $d['type'] == 'deposit' ){

                    // $transaction_funding->set( 'id', $id );
                    // $transaction_funding->set( 'approved_by', $dUserLogin['id'] );
                    // $transaction_funding->cancel();
                    echo 'done##',$main->toJsonData( 200, 'success', null );
                    // unset( $dTrans );
                    
                }else if( $d['type'] == 'withdraw' ){
                    //thực hiện lệnh rút tiền ra khỏi hệ thống qua API bên thứ 3
                    
                    // thực hiện lệnh topup tiền lên trong hệ thống
                    $status                 = 403;
                    $post['amount']         = $d['amount'];
                    $post['description']    = 'Trả lại tiền, lệnh rút  #HD'.$d['id'].' bị hủy: '.$d['note'];
                    $post['subject']        = $d['username'];//user nhận fund
                    $result = $api->exeAPIPayment( $setup['cyclos_payment_type_for_deposit'], $post, $status );
                    
                    if( $status == 201 ){
                        $data = json_decode( $result, true );
                        if( $data ){

                            //thanh toán thành công
                            $subject = 'Trả lại tiền, lệnh rút #HD'.$d['id'].' bị hủy.';
                            $content = 'Giao dịch rút tiền #HD'.$d['id'].' với số tiền '.number_format($d['amount'], 0, '.', ',').' được trả về tài khoản vì lệnh rút bị hủy.';
                            $notification->set('to', $d['username'].';');
                            $notification->set('subject', $subject );
                            $notification->set('content', $content);
                            $notification->set('created_by', $dUserLogin['id']);
                            $notification->set('force_read', 0);
                            $notification_id = $notification->add();

                            $p['to'] = '/topics/username_'.$d['username'];
                            $p['priority']  = 'high';
                            $p['notification_id']  = $notification_id;
                            $ii['title']  = $subject;
                            $ii['body']   = $content;
                            $p['notification'] = $ii;
                            $main->sendFCM( $p );
                            
                            $transaction_funding->set( 'id', $id );
                            $transaction_funding->set( 'approved_by', $dUserLogin['id'] );
                            $transaction_funding->set( 'cyclos_transaction_id', $data['transactionNumber']);
                            $transaction_funding->cancel();

                            echo 'done##',$main->toJsonData( 200, 'success', null );
                        }else{
                            echo 'done##',$main->toJsonData( 403, 'Lỗi thực hiện parse dữ liệu, vui lòng kiểm tra.', $data );
                        }

                    }else{
                        echo 'done##',$main->toJsonData( 403, 'Lỗi thực hiện trả lại tiền, vui lòng kiểm tra.', $result );
                    }
                    
                }

            }else{
                echo 'done##',$main->toJsonData( 403, 'Không tìm thấy giao dịch.', null );
            }
        }else{
            echo 'done##',$main->toJsonData( 403, 'Không tìm thấy giao dịch.', null );
        }

    }else if( $nod == 'done' ){
        $id        = $main->post('id');

        $transaction_funding->set( 'id', $id );
        $d = $transaction_funding->get_detail();

        if( isset($d) ){
            if( $d['status'] == 0 ){
                
                if( $d['type'] == 'deposit' ){
                    //thực hiện lệnh topup tiền lên trong hệ thống
                    // $status                 = 403;
                    // $post['amount']         = $d['amount'];
                    // $post['description']    = 'Nạp tiền vào tài khoản của giao dịch nạp tiền: #'.$d['id'].' - '.$d['note'];
                    // $post['subject']        = $d['username'];//user nhận fund
                    // $result = $api->exeAPIPayment( $setup['cyclos_payment_type_for_deposit'], $post, $status );
                    
                    // if( $status == 201 ){
                    //     $data = json_decode( $result, true );
                    //     if( $data ){

                    //         //thanh toán thành công
                    //         $transaction_funding->set('approved_by', $dUserLogin['id']);
                    //         $transaction_funding->set('cyclos_transaction_id', $data['transactionNumber']);
                    //         $transaction_funding->update_done();

                            echo 'done##',$main->toJsonData( 200, 'success', null );
                    //     }else{
                    //         echo 'done##',$main->toJsonData( 403, 'Lỗi thực hiện parse dữ liệu, vui lòng kiểm tra.', $data );
                    //     }

                    // }else{
                    //     echo 'done##',$main->toJsonData( 403, 'Lỗi thực hiện thanh toán, vui lòng kiểm tra.', $result );
                    // }

                }else if( $d['type'] == 'withdraw' ){
                    //thực hiện lệnh rút tiền ra khỏi hệ thống qua API bên thứ 3
                    
                    $transaction_funding->set('approved_by', $dUserLogin['id']);
                    $transaction_funding->update_done();

                    $subject = 'Rút tiền thành công';
                    $content = 'Giao dịch rút tiền #HD'.$d['id'].' với số tiền '.number_format($d['amount'], 0, '.', ',').' của bạn đã hoàn tất.';
                    $notification->set('to', $d['username'].';');
                    $notification->set('subject', $subject );
                    $notification->set('content', $content);
                    $notification->set('created_by', $dUserLogin['id']);
                    $notification_id = $notification->add();

                    $p['to'] = '/topics/username_'.$d['username'];
                    $p['priority']  = 'high';
                    $p['notification_id']  = $notification_id;
                    $ii['title']  = $subject;
                    $ii['body']   = $content;
                    $p['notification'] = $ii;
                    $main->sendFCM( $p );

                    echo 'done##',$main->toJsonData( 200, 'success', null );
                }


            }else{
                echo 'done##',$main->toJsonData( 403, 'Không tìm thấy giao dịch.', null );
            }
        }else{
            echo 'done##',$main->toJsonData( 403, 'Không tìm thấy giao dịch.', null );
        }

    }else{
       echo 'Missing nod';
        $db->close();
        exit(); 
    }

}else if( $act == 'deposit' ){
    if( $nod == 'filter' ){

        $keyword        = $main->post('keyword');
        $from           = $main->post('from');
        $to             = $main->post('to');
        $status         = $main->post('status');
        $page           = $main->post('page');
        $type           = 'deposit';

        if( $from == '' ){
			$from = date("d/m/Y");
		}
		if( $to == '' ){
			$to = date("d/m/Y");
		}

		if( $main->validateDate( $from, 'd/m/Y' ) && $main->validateDate( $to, 'd/m/Y' ) ){
			
			$strfromday = strtotime($main->convert_strdate( $from )) - 100*10000000000; 
			$strtoday = strtotime($main->convert_strdate( $to )) + 86399;
			
			if( $strfromday < $strtoday ){
                
                if( $page < 1 ) $page = 1;

                $limit  = $setup['perpage'];
                $ofset  = ($page -1)*$limit;
                
                $transaction_funding->set('type', $type);
                // $total_record = $transaction_funding->filter_count( $keyword, $strfromday, $strtoday );

                $l = $transaction_funding->filter( $keyword, $strfromday, $strtoday, $ofset, $limit );

                echo 'done##',$main->toJsonData( 200, 'success', $l );
                
                unset( $l );
            }else{
                echo 'done##',$main->toJsonData( 403, 'Chọn ngày không hợp lệ', null );
            }
		}else{
            echo 'done##',$main->toJsonData( 403, 'Chọn ngày không hợp lệ', null );
        }

    }else{
       echo 'Missing nod';
        $db->close();
        exit(); 
    }

}else if( $act == 'deposit_done' ){
    
    if( $nod == 'cancel' ){
        
        $id        = $main->post('id');

        $transaction_funding->set( 'id', $id );
        $d = $transaction_funding->get_detail();

        if( isset($d) ){
            if( $d['status'] == 0 ){
                
                if( $d['type'] == 'deposit' ){

                    $transaction_funding->set( 'id', $id );
                    $transaction_funding->set( 'approved_by', $dUserLogin['id'] );
                    $transaction_funding->cancel();
                    echo 'done##',$main->toJsonData( 200, 'success', null );
                    unset( $dTrans );

                }else if( $d['type'] == 'withdraw' ){
                    //thực hiện lệnh rút tiền ra khỏi hệ thống qua API bên thứ 3
                    
                    // $transaction_funding->set('approved_by', $dUserLogin['id']);
                    // $transaction_funding->update_done();

                    echo 'done##',$main->toJsonData( 200, 'success', null );
                }


            }else{
                echo 'done##',$main->toJsonData( 403, 'Không tìm thấy giao dịch.', null );
            }
        }else{
            echo 'done##',$main->toJsonData( 403, 'Không tìm thấy giao dịch.', null );
        }

    }else if( $nod == 'done' ){

        $id        = $main->post('id');

        $transaction_funding->set( 'id', $id );
        $d = $transaction_funding->get_detail();

        if( isset($d) ){
            if( $d['status'] == 0 ){
                
                if( $d['type'] == 'deposit' ){
                    // thực hiện lệnh topup tiền lên trong hệ thống
                    $status                 = 403;
                    $post['amount']         = $d['amount'];
                    $post['description']    = 'Nạp tiền vào tài khoản của giao dịch nạp tiền: #'.$d['id'].' '.$d['note'];
                    $post['subject']        = $d['username'];//user nhận fund
                    $result = $api->exeAPIPayment( $setup['cyclos_payment_type_for_deposit'], $post, $status );
                    
                    if( $status == 201 ){
                        $data = json_decode( $result, true );
                        if( $data ){

                            //thanh toán thành công
                            $transaction_funding->set('approved_by', $dUserLogin['id']);
                            $transaction_funding->set('cyclos_transaction_id', $data['transactionNumber']);
                            $transaction_funding->update_done();

                            $subject = 'Nạp tiền thành công';
                            $content = 'Giao dịch nạp tiền #HD'.$d['id'].' với số tiền '.number_format($d['amount'], 0, '.', ',').' của bạn đã hoàn tất.';
                            $notification->set('to', $d['username'].';');
                            $notification->set('subject', $subject );
                            $notification->set('content', $content);
                            $notification->set('created_by', $dUserLogin['id']);
                            $notification_id = $notification->add();

                            $p['to'] = '/topics/username_'.$d['username'];
                            $p['priority']  = 'high';
                            $p['notification_id']  = $notification_id;
                            $ii['title']  = $subject;
                            $ii['body']   = $content;
                            $p['notification'] = $ii;
                            $main->sendFCM( $p );

                            echo 'done##',$main->toJsonData( 200, 'success', null );
                        }else{
                            echo 'done##',$main->toJsonData( 403, 'Lỗi thực hiện parse dữ liệu, vui lòng kiểm tra.', $data );
                        }

                    }else{
                        echo 'done##',$main->toJsonData( 403, 'Lỗi thực hiện thanh toán, vui lòng kiểm tra.', $result );
                    }

                }else if( $d['type'] == 'withdraw' ){
                    //thực hiện lệnh rút tiền ra khỏi hệ thống qua API bên thứ 3
                    
                    // $transaction_funding->set('approved_by', $dUserLogin['id']);
                    // $transaction_funding->update_done();

                    echo 'done##',$main->toJsonData( 200, 'success', null );
                }


            }else{
                echo 'done##',$main->toJsonData( 403, 'Không tìm thấy giao dịch.', null );
            }
        }else{
            echo 'done##',$main->toJsonData( 403, 'Không tìm thấy giao dịch.', null );
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