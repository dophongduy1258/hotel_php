<?php
//error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
date_default_timezone_set("Asia/Ho_Chi_minh");
include '../define.php';

if(isset($_FILES['files']["name"])){

	$_FILES['files']["name"] = $_SERVER['REMOTE_ADDR'].'-'.time().'-'.rand(1000, 100000000)."-blockreal.vn.".pathinfo($_FILES["files"]["name"], PATHINFO_EXTENSION);
	$kq = $main->upimg($_FILES['files'],"../uploads/product/images", 1024);//
    echo '{"files":[{"name":"'.$domain.'/uploads/product/images/'.$kq.'","protected":"blockreal.vn license"}]}';
    
}else{
	echo $_FILES['files']["name"];
}