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
        $paging->total = $deposit_info->list_by_count( $keyword )+0;
        $page_html = $paging->display_ajax3();

        $l = $deposit_info->list_by( $keyword, $ofset, $limit );

        $kq['l']            = $l;
        $kq['page_html']    = $page_html;
        echo 'done##',$main->toJsonData( 200, 'success', $kq );
        
        unset(  $l );
        unset(  $kq );
        unset(  $page_html );

    }else{
       echo 'Missing nod';
        $db->close();
        exit(); 
    }

}else if( $act == 'done' ){

    if( $nod == 'done' ){

        $id = $main->post('id');

        $deposit_info->set('id', $id );
        $deposit_info->update_done();

        echo 'done##',$main->toJsonData( 200, 'success', null );
    
    }else{
       echo 'Missing nod';
        $db->close();
        exit(); 
    }

}else if( $act == 'refund' ){

    if( $nod == 'refund' ){

        $id = $main->post('id');

        $deposit_info->set('id', $id );
        $dI = $deposit_info->get_detail();
        
        if( isset($dI['id']) ){
            $status                 = 403;

            //thuc hien refund lai tien cho nha dau tu tai dau
            $post['amount']         = $dI['value'];
            $post['description']    = 'Nhận lại cọc của giao dịch: #'.$dI['id'];
            $post['subject']        = $dI['username'];//user nhận fund
            $result = $api->exeAPIPayment( $setup['cyclos_payment_type_for_deposit_info'], $post, $status );//Loại thanh toán nhận cọc/mua bds

            if( $status != 200 ){

                $dt = json_decode($result, true);
                if( $dt ){
                    $deposit_info->set('transaction_refund', $dt['transactionNumber'] );
                }
                unset( $dt );
                
                $fail[]       = array( 'id'       =>$item['id'],
                                    'total'     => $item['total'],
                                    'username'  => $item['username'],
                                    'fullname'  => $item['fullname']
                                    );
                $deposit_info->update_refund();
                echo 'done##',$main->toJsonData( 200, 'success', null );
                
            }else{
                echo 'done##',$main->toJsonData( 403, 'Lỗi trong quá trình thực hiện hoàn tiền', null );
            }

        }else{
            echo 'done##',$main->toJsonData( 403, 'Không tìm thấy giao dịch cần hoàn tiền', null );
        }
    
    }else{
       echo 'Missing nod';
        $db->close();
        exit(); 
    }

}else if( $act == 'delete' ){

    if( $nod == 'delete' ){

        $id = $main->post('id');
        $deposit_info->set('id', $id );
        $deposit_info->delete();

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