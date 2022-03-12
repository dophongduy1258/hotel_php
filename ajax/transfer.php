<?php
//{{domain}}/api/self/accounts/?fields=id,number,status.balance,status.availableBalance,currency.name,currency.symbol
$nod        = $main->get('nod');
if( $act == 'idx' ){

    if( $nod == 'filter' ){

        $keyword            = $main->post('keyword');
        $status             = $main->post('status');
        $from               = $main->post('from');
        $to                 = $main->post('to');
        $page               = $main->post('page')+0;

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

                $transfer->set('status', $status);

                $kq             = $transfer->filter_info( $keyword, $strfromday, $strtoday );
                
                if ( $page == '' || $page < 0 ) $page = 1;
                $paging->limit = $limit = $setup['perpage'];
                $ofset = ($page-1)*$paging->limit;
                $paging->page = $page;
                $paging->total = $kq['total_record'];
                $page_html = $paging->display_ajax3();

                $l = $transfer->filter( $keyword, $strfromday, $strtoday, $ofset, $limit );
                
                $kq['lItems']       = $l;
                $kq['page_html']    = $page_html;

                echo 'done##',$main->toJsonData( 200, 'success', $kq );
                
                unset( $l );
                unset( $kq );
                unset( $page_html );
                
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

}else{
    echo 'Missing action';
    $db->close();
    exit(); 
}