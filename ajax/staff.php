<?php

$nod        = $main->get('nod');
if( $act == 'idx' ){

    if( $nod == 'filter' ){

        $keyword = $main->post('keyword');

        $l = $user->list_all( $keyword );

        echo 'done##',$main->toJsonData( 200, 'success', $l );
        unset( $l );

    }else if( $nod == 'detail_user' ){

        $id = $main->post('id');

        $user->set('id', $id);
        $d = $user->get_detail();

        if( isset($d['id']) ){
            echo 'done##',$main->toJsonData( 200, 'success', $d );
            unset( $d );
        }else {
            echo 'done##',$main->toJsonData( 403, 'Không tìm thấy nhân viên này', null );
        }

    }else if( $nod == 'load_permission_default' ){
        $id = $main->post('gid');
        
        $gid->set('id', $id);
        $d = $gid->get_detail();

        echo 'done##',$main->toJsonData( 200, 'success', $d['default_permission'] );
        unset( $d );


    
    }else if( $nod == 'gid_permission' ){
        //get detail default permission of the group
        $id = $main->post('id');
        
        $gid->set('id', $id);
        $d = $gid->get_detail();
        echo 'done##',$main->toJsonData( 200, 'success', $d['default_permission'] );
        unset( $d );
    }else{
        echo 'Missing nod';
        $db->close();
        exit();
    }

}else if( $act == 'reset_password' ){
    
    if( $nod == 'reset_password' ){

        $id                 = $main->post('id');
        
        $user->set('id', $id);
        $user->set('password', $setup['default_password']);
        $user->update_password();

        echo 'done##',$main->toJsonData( 200, 'success', null );
    }else{
        echo 'Missing nod';
        $db->close();
        exit();
    }

}else if( $act == 'delete' ){
    if( $nod == 'delete_user' ){

        $id                 = $main->post('id');
        
        $user->set('id', $id);
        $user->delete();

        echo 'done##',$main->toJsonData( 200, 'success', null );
    }else{
        echo 'Missing nod';
        $db->close();
        exit();
    }

}else if( $act == 'save' ){
    if( $nod == 'save_user' ){

        $id                 = $main->post('id');
        $fullname           = $main->post('fullname');
        $mobile             = $main->post('mobile');
        $email              = $main->post('email');
        $address            = $main->post('address');
        $password           = $main->post('password');
        // $permission         = $main->post('permission');
        $gid_user                = $main->post('gid');

        $gid->set('id', $gid_user);
        $dGID = $gid->get_detail();
        $permission         = $gid->get_string_permission( $dGID['default_permission'] );
        unset( $dGID );

        $user->set('fullname', $fullname);
        $user->set('mobile', $mobile);
        $user->set('email', $email);
        $user->set('address', $address);
        $user->set('password', $password);
        $user->set('permission', $permission);
        $user->set('gid', $gid_user);

        $user->set('id', $id);
        $d = $user->get_detail();

        if( isset($d['id']) ){
            //edit user

            //check mobile
            $dm = $user->get_by_mobile();
            if( isset($dm['id']) && $dm['id'] != $id ){
                unset( $dm );
                echo 'done##',$main->toJsonData( 403, 'Số điện thoại này đã được sử dụng.', null );
            }else{

                $de = $user->get_by_mobile();
                if( isset($de['id']) && $de['id'] != $id ){
                    unset( $de );
                    echo 'done##',$main->toJsonData( 403, 'Email này đã được sử dụng.', null );
                }else{
                    $user->update();
                    echo 'done##',$main->toJsonData( 200, 'success', null );
                    unset( $d );
                }
            }

        }else {
            //add user
            if( $mobile != '' && $user->mobile_exist() ){
                echo 'done##',$main->toJsonData( 403, 'Số điện thoại này đã được sử dụng.', null );
            }else if( $email != '' && $user->email_exist() ){
                echo 'done##',$main->toJsonData( 403, 'Email này đã được sử dụng.', null );
            }else{
                $user->add();
                echo 'done##',$main->toJsonData( 200, 'success', null );
            }
        }
    }else{
        echo 'Missing nod';
        $db->close();
        exit();
    }

}else if( $act == 'gid' ){

    if( $nod == 'gid_create' ){
        $name       = $main->post('name');

        $gid->set('name', $name );
        $gid->add();

        $kq['opt_gid'] = $gid->opt_all();
        echo 'done##',$main->toJsonData( 200, 'success', $kq );
        
        unset( $kq );
        
    }else if( $nod == 'gid_edit' ){
        
        $id                 = $main->post('id');
        $name               = $main->post('name');

        $gid->set('id', $id );
        $gid->set('name', $name );
        $gid->update_field('name');

        echo 'done##',$main->toJsonData( 200, 'success', null );

    }else if( $nod == 'gid_delete' ){
        $id             = $main->post('id');

        $gid->set('id', $id );
        $gid->delete();

        $kq['opt_gid'] = $gid->opt_all();

        echo 'done##',$main->toJsonData( 200, 'success', $kq );

        unset( $kq );
        
    }else if( $nod == 'gid_filter' ){

        $l = $gid->list_all();

        echo 'done##',$main->toJsonData( 200, 'success', $l );

        unset( $l );

    }else if( $nod == 'gid_save_permission' ){
        //save default permission

        $id             = $main->post('id');
        $permission     = $main->post('permission');
        
        $gid->set('id', $id);
        $gid->set('default_permission', $permission);
        $gid->set('default_report', '');
        $gid->update_permission();

        $strPermission         = $gid->get_string_permission( $permission );
        
        $user->set('gid', $id);
        $user->set('permission', $strPermission);
        $user->update_permission_by_gid();
        
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