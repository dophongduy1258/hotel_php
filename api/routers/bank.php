<?php
$app->post('/bank/list', function () use ( $app, $bank, $main, $user ) {
    
    $l = $bank->list_all();
    echo $main->toJsonData( 200, 'success', $l );
    unset( $l );
    
});