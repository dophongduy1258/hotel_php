<?php
@$user->set( 'id', $_SESSION['id'] );
@$user->set( 'password', $_SESSION['password'] );	
$dUserLogin = $user->check_login();

$permiss = -1;
$permiss = strpos($dUserLogin['permission'] , ':'.$m.$act.':');
if( !isset( $dUserLogin['id'] ) || !isset( $dUserLogin['password'] ) ){
	unset($_SESSION['id']);
	unset($_SESSION['password']);
	$main->redirect($domain.'/?m=user&act=login');
	$db->close();
	exit();
}else if( ( $dUserLogin['gid'] != '1' &&  $permiss === false ) ){
	unset( $dUserLogin );
	$main->alert("Bạn không có quyền truy cập chức năng này.");
	$main->redirect($domain.'/?m=user&act=login');
	$db->close();
	exit();
}

// $st->assign('str_permission', $dUserLogin['per mission']);
$st->assign('str_gid', $dUserLogin['gid']);

if( $act == 'index' ){
	//default is index
	$title = 'Index do nothing';

}else if( $act == 'investor' ){
	$title = 'Quản lý nhà đầu tư';

}else if( $act == 'deposit' ){
	$title = 'Quản lý đặt cọc và mua nhà';
	
}else if( $act == 'bank' ){
	$title = 'Danh sách tài khoản ngân hàng để người dùng nạp tiền';

}else if( $act == 'app-setting' ){
	$title = 'Cấu hình giao diện chính các chức năng của APP';

}else if( $act == 'mlm' ){
	$title = 'Quản lý hoa hồng';

	$st->assign('lLevel', $mlm_level->list_all());
	
}else if( $act == 'product' ){
	$title = 'Quản lý sản phẩm bất động sản';
	
	$status_code = 403;
	$lBuildingCode = $api->exeAPIAdmin( 'GET', 'users?groups='.$setup['cyclos_group_building'], '', $status_code );
	$opt_build_code = '';
	
	if( $status_code == 200 ){
		$lBuildingCode = json_decode( $lBuildingCode, true);
		foreach($lBuildingCode as $building ){
			$opt_build_code .= '<option value="'.$building['shortDisplay'].'">'.$building['display'].'</option>';
		}
		unset( $lBuildingCode );
	}

	$lProvince = $province->list_all();
	foreach ($lProvince as $key => $item) {
		$city->set('province_id', $item['id']);
		$lProvince[$key]['lCity'] = $city->list_by();
	}
	
	$st->assign( 'opt_build_code', $opt_build_code );
	$st->assign( 'lProvince', $lProvince );
	unset( $lProvince );

}else if( $act == 'report' ){
	$title = 'Báo cáo';

}else if( $act == 'staff' ){
	$title = 'Quản lý nhân sự';
	$permission =  new permission();

	$lPermission = $permission->list_all();
	$st->assign( 'lPermission', $lPermission );
	$st->assign( 'lGid', $gid->list_all() );
	// print_r($permission->list_all());

	unset( $lPermission );

}else if( $act == 'notification' ){
	$title = 'Notification';

}else if( $act == 'setting' ){
	$title = 'Cài đặt';
	
	$st->assign( 'setting', $opt->listall() );
	$st->assign( 'fees', $fees->list_all());
	
}else if( $act == 'suggested' ){
	$title = 'ất động sản được đề xuất bởi thành viên';
	
}else if( $act == 'transaction' ){
	$title = 'Transaction Management';
	
}else if( $act == 'transactiondetails' ){
	$title = 'Chi tiết giao dịch';

}else if( $act == 'bank-change' ){
	$title = 'Thay đổi số dư của ngân hàng';
	
}else if( $act == 'listing' ){
	$title = 'Listing Management';

}else if( $act == 'transfer' ){
	$title = 'Quản lý chuyển nhượng suất đầu tư';
	
}else if( $act == 'selling' ){
	$title = 'Quản lý sản phẩm đang bán';

	$lProvince = $province->list_all();
	foreach ($lProvince as $key => $item) {
		$city->set('province_id', $item['id']);
		$lProvince[$key]['lCity'] = $city->list_by();
	}
	
	$st->assign( 'lProvince', $lProvince );
	$st->assign( 'opt_selling_direction', $selling_direction->list_option_all('id', 'name', 'id', 'ASC') );

	$selling_type->set('root_id', '');
	$st->assign( 'opt_selling_type_id', $selling_type->opt_all() );
	$st->assign( 'opt_selling_unit_id', $selling_unit->opt_all() );
	$selling_type->set('root_id', 0);
	$st->assign( 'opt_selling_type', $selling_type->opt_by_root('id', 'name', 'name', 'ASC') );
	unset( $lProvince );

}elseif($act == 'home'){
	$title = 'trang chủ';
	
}elseif($act == 'hotel'){
	$title = 'Quản lý khách sạn';
	$st->assign('lCategory',$category_hotel->list_all());

	
}elseif($act == 'room'){
	$title = 'Quản lý phòng';
	$st->assign('lHotel',$hotel->list_all());
	// $st->assign('lBenefit',$benefit->list_all());
	$st->assign('lRBenefit',$room_benefit->list_all());
	$st->assign('lRCategory',$category_room->list_all());
	
}
elseif($act == 'category'){
	$title = 'Quản lý Loại khách sạn';
	
}
elseif($act == 'booking'){
	$title = 'Quản lý đặt phòng';
	$st->assign('lHotel',$hotel->list_all());
	$st->assign('lBookingStatus',$booking_status->list_all());
	// $st->assign('lstRoom',$booking->filter_booking());
	// $st->assign('lStatus',$hotel->list_all());

}elseif($act == 'general_service'){
	$title = 'Dịch vụ chung';
	$st->assign('lRoomBooked',$general_service->list_room_booked());
	$st->assign('lService',$service->list_all());

}
elseif($act == 'service'){
	$title = 'Dịch vụ ';
	// $st->assign('lHotel',$hotel->list_all());
	// $st->assign('lBookingStatus',$booking_status->list_all());

}




