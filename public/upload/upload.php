<?php
//error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
date_default_timezone_set("Asia/Ho_Chi_minh");
include "../define.php";
include "../m/global.php";
if(isset($_FILES['files']["name"])){
	$_FILES['files']["name"] = $_SERVER['REMOTE_ADDR']."-CitiPOS.vn.".substr($_FILES["files"]["name"], -3);
	$kq = $main->upimg($_FILES['files'],"../uploads/temp/",300);//avatar
	echo '{"files":[{"name":"'.$kq.'","protected":"CitiPOS.vn license"}]}';
}else{
	echo $_FILES['files']["name"];
}
?>