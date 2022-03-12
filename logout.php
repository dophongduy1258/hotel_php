<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('display_startup_errors', true);

include 'define.php';

unset($_COOKIE['id']);
unset($_COOKIE['password']);
unset($_COOKIE['fullname']);
unset($_COOKIE['gid']);

setcookie( 'id', '44', time() - 3600);
setcookie( 'password', '44', time() - 3600);
setcookie( 'fullname', '44', time() - 3600);
setcookie( 'gid', '44', time() - 3600);

unset($_SESSION['id']);
unset($_SESSION['password']);
unset($_SESSION['fullname']);
unset($_SESSION['gid']);
session_destroy ();

$main->redirect ( $domain.'/?m=user&act=login' );
