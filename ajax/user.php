<?php

$nod = $main->get('nod');

if( $act == 'idx' ){
    if( $nod == 'change_password' ){
        $old = $main->post('old');
        $new = $main->post('new');
        $pass_old = md5(md5($old).$dUserLogin['salt']);
        if( $pass_old == $dUserLogin['password'] ){
            
            $user->set('id', $dUserLogin['id']);
            $user->set('password', $new );
            $user->update_password();

            echo 'done##',$main->toJsonData( 200, 'success', null );

        }else{
            echo 'done##',$main->toJsonData( 403, 'Mật khẩu cũ không đúng.', null );
        }

    }else if( $nod == '' ){

    }
}else{

}