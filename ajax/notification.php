<?php

$nod        = $main->get('nod');
if( $act == 'idx' ){
    if( $nod == 'filter' ){

        $page       = $main->post('page');

        if( $page < 1 ) $page = 1;

        $limit = $setup['perpage'];
        $ofset = ( $page - 1 )*$limit;

        //$notification->list_all_by_count();
        $l = $notification->list_all_by( $ofset, $limit );

        echo 'done##',$main->toJsonData( 200, 'success', $l );

        unset(  $l );

    }else if( $nod == 'detail' ){

        $id       = $main->post('id');
        
        $notification->set('id', $id);
        $d = $notification->get_detail();

        $user->set('id', $d['created_by']);
        $d['created_by_name'] = $user->get_fullname();

        echo 'done##',$main->toJsonData( 200, 'success', $d );
        
        unset(  $d );

    }else if( $nod == 'initial' ){
        //load default searching

        $kq['list_all']         = $investor->list_all();
        $kq['list_by_product']  = $product->list_investor_all_by_product();

        echo 'done##',$main->toJsonData( 200, 'success', $kq );
        unset( $kq );

    }else if( $nod == 'searching' ){
        //load default searching
        $keyword        = $main->post('keyword');

        $kq['keyword']  = '';

        echo 'done##',$main->toJsonData( 200, 'success', $kq );
        unset( $kq );
        
    }else{
       echo 'Missing nod';
        $db->close();
        exit(); 
    }

}else if( $act == 'delete' ){
    if( $nod == 'delete' ){

        $id       = $main->post('id');
        
        $notification->set('id', $id);
        $notification->delete();

        echo 'done##',$main->toJsonData( 200, 'success', null );
    }else{
       echo 'Missing Nod';
        $db->close();
        exit(); 
    }

}else if( $act == 'save' ){

    if( $nod == 'save' ){
        
        $to             = $main->post('to');
        $subject        = $main->post('subject');
        $content        = $main->post('content');
        
        $notification->set('to', $to);
        $notification->set('subject', $subject);
        $notification->set('content', $content);
        $notification->set('created_by', $dUserLogin['id']);
        $notification_id = $notification->add();

        //send notification to all
        $lTo = explode(';', $to);
        $con = '';
        foreach ($lTo as $key => $it) {
            if( $it != '' )
                $con .= "'username_$it' in topics || ";
        }
        
        if( $con != '' ){
            
            $con = substr($con, 0, -3);
            $post['condition'] = $con;
            // $post['to'] = "/topics/username_lengochuan";
            $post['priority']  = 'high';
            $post['notification_id']  = $notification_id;
            $ii['title']  = $subject;
            $ii['body']   = strip_tags($content);
            $post['notification'] = $ii;
            $main->sendFCM( $post );

            print_r( $post );
            unset( $con );
            unset( $post );
            unset( $ii );
        }

        echo 'done##',$main->toJsonData( 200, 'success', null );
    }else{
       echo 'Missing Nod';
        $db->close();
        exit(); 
    }
}else{
    echo 'Missing action';
    $db->close();
    exit();
}