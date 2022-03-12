<?php

$app->post('/contact/save', function () use ( $app, $dInvestor, $contact, $main, $user ) {

	$hint            = $app->request()->post('hint');
	$username        = $app->request()->post('username');
	$fullname        = $app->request()->post('fullname');
	$mobile          = $app->request()->post('mobile');
	$email           = $app->request()->post('email');
	$investor_id     = $dInvestor['id'];
    
	$contact->set( 'hint', $hint );
	$contact->set( 'username', $username );
	$contact->set( 'fullname', $fullname );
	$contact->set( 'mobile', $mobile );
	$contact->set( 'email', $email );
	$contact->set( 'investor_id', $investor_id );
    $id = $contact->add();

	echo $main->toJsonData( 200, 'success', $id );
    
});

$app->post('/contact/search', function () use ( $app, $dInvestor, $contact, $main, $user ) {
	$keyword    = $app->request()->post('keyword');
	
	$contact->set( 'investor_id', $dInvestor['id'] );
	$lItems = $contact->auto_complete( $keyword );

	echo $main->toJsonData( 200, 'success', $lItems );
    unset( $lItems );
    
});

$app->post('/contact/list', function () use ( $app, $dInvestor, $contact, $main, $user ) {
    
    $page    = $app->request()->post('page');

    if( $page < 0 ) $page = 1;
    $limit = 20;
    $ofset = ($page -1)*$limit;

    $contact->set( 'investor_id', $dInvestor['id']);
    $lItems = $contact->list_by( $ofset, $limit );
	
	echo $main->toJsonData( 200, 'success', $lItems );

	unset( $lItems );
});

$app->post('/contact/delete', function () use ( $app, $dInvestor, $contact, $main, $user ) {
	$id    = $app->request()->post('id');
	
	$contact->set( 'id', $id );
	$contact->set( 'investor_id', $dInvestor['id'] );
	$contact->delete_by();

	echo $main->toJsonData( 200, 'success', null );

});