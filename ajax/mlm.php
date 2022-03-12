<?php
$nod        = $main->get('nod');
if( $act == 'idx' ){

    if( $nod == 'get_detail' ){
        //only get detail investor
        $username   = $main->post('username');

        $investor->set('username', $username);
        $dUser = $investor->get_detail_by_username();
        
        echo 'done##',$main->toJsonData( 200, 'success', $dUser );
    }else if( $nod == 'change_parent' ){
        
        $parent     = $main->post('new_parent');
        $username   = $main->post('username');
        
        //xóa tất cả các kết nối đang của của user này
        $mlm_detail->set('username', $username );
        $mlm_detail->delete_all();

        //Tạo kết nối mới
        $mlm_detail->set('username', $username );
        $mlm_detail->set('parent', $parent );
        $mlm_detail->new_username();

        //cập nhật nhanh parent của user này
        $investor->set('parent', $parent);
        $investor->set('username', $username);
        $investor->update_parent();
        
        echo 'done##',$main->toJsonData( 200, 'success', null );

    }else if( $nod == 'get_detail_by' ){
        //get_detail_by: get more info from parent of the investor or user
        
        $username   = $main->post('username');

        $investor->set('username', $username);
        $dUser = $investor->get_detail_by_username();
        
        $item['username'] = $dUser['username'];
        $item['name'] = $dUser['fullname'];
        $item['email'] = $dUser['email'];
        $item['mobile'] = $dUser['mobile'];

        $item['parent_username'] = '';
        $item['parent_name'] = '';
        $item['parent_email'] = '';
        $item['parent_mobile'] = '';

        if( $dUser['parent'] != '' ){
            $investor->set('username',  $dUser['parent'] );
            $dParent = $investor->get_detail_by_username();

            $item['parent_username'] = $dParent['username'];
            $item['parent_name'] = $dParent['fullname'];
            $item['parent_email'] = $dParent['email'];
            $item['parent_mobile'] = $dParent['mobile'];
        }

        echo 'done##',$main->toJsonData( 200, 'success', $item );

        unset( $dParent );
        unset( $dUser );

    }else if( $nod == 'searching' ){
        $keyword   = $main->post('keyword');

        $l = $investor->searching( $keyword );
        echo 'done##',$main->toJsonData( 200, 'success', $l );
        unset( $l );
        
    }else if( $nod == 'filter' ){

        $username           = $main->post('username');
        $mlm_level_id       = $main->post('level_id');
        $page               = $main->post('page');

        $mlm_detail->set('username', $username );
        $mlm_detail->set('mlm_level_id', $mlm_level_id );
        $l = $mlm_detail->filter( $ofset, $limit);

        if ( $page == '' || $page < 0 ) $page = 1;
        $paging->limit = $limit = $setup['perpage'];
        $ofset = ($page-1)*$paging->limit;
        $paging->page = $page;
        $paging->total = $mlm_detail->filter_count();
        $page_html = $paging->display_ajax3();

        $lLevel = $mlm_level->list_all();
        $lTotal = array();
        foreach( $lLevel as $item ){

            $r = array();
            $mlm_detail->set('mlm_level_id', $item['id']);

            $r['id'] = $item['id'];
            $r['total'] = $mlm_detail->filter_count();

            $lTotal[] = $r;

        }

        $kq['lItems']       = $l;
        $kq['page_html']    = $page_html;
        $kq['lTotal']       = $lTotal;

        echo 'done##',$main->toJsonData( 200, 'success', $kq );

        unset( $l );
        unset( $page_html );
        unset( $lTotal );
        unset( $kq );

    }else{
       echo 'Missing nod';
        $db->close();
        exit(); 
    }
}else if( $act == 'commission' ){
    if( $nod == 'update' ){

        $commission             = $main->post('commission', 'number');
        $mlm_level_id           = $main->post('level_id');

        $mlm_level->set('id', $mlm_level_id);
        $mlm_level->set('commission', $commission);
        $mlm_level->update_field('commission');

        echo 'done##',$main->toJsonData( 200, 'success', null );

    }else{
       echo 'Missing nod';
        $db->close();
        exit(); 
    }
}else if( $act == 'delivery_commission' ){
    if( $nod == 'commission_history_list' ){
        
        $id           = $main->post('id');

        $mlm_commission_history->set('mlm_commission_id', $id);
        $l = $mlm_commission_history->list_by();

        echo 'done##',$main->toJsonData( 200, 'success', $l );
        
    }else if( $nod == 'commission_history' ){

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

                $l = $mlm_commission->filter( $strfromday, $strtoday, $ofset, $limit );

                if ( $page == '' || $page < 0 ) $page = 1;
                $paging->limit = $limit = $setup['perpage'];
                $ofset = ($page-1)*$paging->limit;
                $paging->page = $page;
                $paging->total = $mlm_commission->filter_count( $strfromday, $strtoday );
                $page_html = $paging->display_ajax2();

                $kq['lItems']       = $l;
                $kq['page_html']    = $page_html;

                echo 'done##',$main->toJsonData( 200, 'success', $kq );

                unset( $l );
                unset( $page_html );
                unset( $kq );

             }else{
                echo 'done##',$main->toJsonData( 403, 'Chọn ngày không hợp lệ', null );
            }

		}else{
            echo 'done##',$main->toJsonData( 403, 'Chọn ngày không hợp lệ', null );
        }


    }else if( $nod == 'delivery' ){

        $amount                 = $main->post('amount', 'number');
        $note                   = $main->post('note');
        $username               = $main->post('username');// người phát sinh ra hoa hồng không được hưởng

        //Tạo lịch sử chia
        $mlm_commission->set('amount', $amount);
        $mlm_commission->set('source', 'backoffice_delivery');
        $mlm_commission->set('created_by', $dUserLogin['id']);
        $mlm_commission->set('commission_from_user', $username);
        $mlm_commission->set('note', $note);
        $mlm_commission_id = $mlm_commission->add();

        $total_delivered = 0;

        $lLevel = $mlm_level->list_all();
        foreach ($lLevel as $key => $dLevel) {
            if( $dLevel['commission'] > 0 ){
                
                $mlm_detail->set('username', $username);
                $mlm_detail->set('mlm_level_id', $dLevel['id']);
                $dmlm = $mlm_detail->get_detail_by_level();
                if( isset($dmlm['id']) ){

                    $commission = $amount * ($dLevel['commission']/100);

                    //update hoa hồng cho user cấp trên: số này có thể convert ra tiền
                    $investor->set('username', $dmlm['parent']);
                    $investor->set('commission', $commission);
                    $investor->update_commission_plus();

                    //số này update chỉ để thống kê
                    $mlm_detail->set('id', $dmlm['id']);
                    $mlm_detail->set('total_commission', $commission );
                    $mlm_detail->update_commission_plus();

                    //Ghi nhận lịch sử
                    $mlm_commission_history->set('mlm_commission_id', $mlm_commission_id);
                    $mlm_commission_history->set('username', $dmlm['parent']);
                    $mlm_commission_history->set('commission', $commission );
                    $mlm_commission_history->set('mlm_level_id', $dLevel['id']);
                    $mlm_commission_history->add();

                    $total_delivered += $commission;

                }

            }
        }


        //cập nhật tổng số hoa hồng đã sử dụng
        $mlm_commission->set('total_delivered', $total_delivered);
        $mlm_commission->set('id', $mlm_commission_id);
        $mlm_commission->update_total_delivered();

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