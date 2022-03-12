<?php
$nod        = $main->get('nod');
if( $act == 'idx' ){
    if( $nod == 'save' ){
        $data = $main->post('data');

        $data = json_decode( $data, true );
        if( $data ){
            foreach ($data as $key => $item) {
                if( isset($item['id']) ){
                    $bank->set('id', $item['id']);
                    $bank->set('bank_name', $item['bank_name']);
                    $bank->set('bank_code', $item['bank_code']);
                    $bank->set('bank_account', $item['bank_account']);
                    $bank->set('bank_account_name', $item['bank_account_name']);
                    $bank->set('url',   $item['url']);
                    $bank->update();
                }else{
                    
                }
            }
        }

        echo 'done##',$main->toJsonData( 200, 'success', null );
    }else  if( $nod == 'add' ){
        $data = $main->post('data');

        $item = json_decode( $data, true );
        if( $item ){
            $bank->set('bank_name', $item['bank_name']);
            $bank->set('bank_code', $item['bank_code']);
            $bank->set('bank_account', $item['bank_account']);
            $bank->set('bank_account_name', $item['bank_account_name']);
            $bank->set('url',   $item['url']);
            $bank->add();
        }

        $l = $bank->list_all();

        echo 'done##',$main->toJsonData( 200, 'success', $l );
        unset($l);

    }else if( $nod == 'filter' ){

	    $l = $bank->list_all();
        
        echo 'done##',$main->toJsonData( 200, 'success', $l );
        unset( $l );

        
    }else if( $nod == 'delete' ){

        $id       = $main->post('id');
        
        $bank->set('id', $id);
        $bank->delete();

        $l = $bank->list_all();
        
        echo 'done##',$main->toJsonData( 200, 'success', $l );
        unset($l);
    
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