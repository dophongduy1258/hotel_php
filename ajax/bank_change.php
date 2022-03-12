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
        $paging->total = $bank_change->filter_count( $keyword );
        $kq['page_html'] = $paging->display('paging_this');

        $kq['l'] = $bank_change->filter( $keyword, $ofset, $limit );
        
        echo 'done##',$main->toJsonData( 200, 'success', $kq );

        unset(  $kq );

    }else{
        echo 'Missing Nod';
    }
}else{
    echo 'Missing action';
}