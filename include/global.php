<?php
class main {
	
	public function redirect($link) {
		echo "<script>window.location = '" . $link . "' </script>";
	}

	public function alert($alert) {
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\"><script>alert('" . $alert . "') </script>";
	}

	public function log($alert) {
		if( is_array($alert) )
			echo print_r($alert);
		else
			echo $alert;
		return true;
	}

	function clean($string) {
	   $str = strip_tags($string);
	   $str = preg_replace("/(\:|\;|\`|\'|\"|\~|\!|\#|\%|\^|\&|\*|\,|\/|\(|\))/", '', $str);
	   $str = preg_replace("/(,)/", ' ', $str);
	   return $str;
	}
	
	function no_sign($str) {
		$str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
		$str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
		$str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
		$str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
		$str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
		$str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
		$str = preg_replace("/(đ)/", 'd', $str);
		$str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
		$str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
		$str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
		$str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
		$str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
		$str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
		$str = preg_replace("/(Đ)/", 'D', $str);
		$str = preg_replace("/(,)/", ' ', $str);
		$str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
		$str = preg_replace("/(\:|\;|\`|\'|\"|\~|\!|\@|\#|\%|\^|\&|\*|\,|\/|\(|\)|\.)/", ' ', $str);
		return $str;
	}

	function only_number($str) {
		$str = preg_replace('/\D/', '', $str);
		return $str;
	}
	
	function number($str) {
		$str = preg_replace("/(\:|\;|\`|\'|\"|\~|\!|\@|\#|\%|\^|\&|\*|\,|\/|\(|\))/", '', $str);
		return $str;
	}

	function zero_sign($str) {	
		if($str == '0' || $str == '0.00'){
			$str = '-';
		}
		return $str;		
	}
	
	function convert_strdate($date){//strdate format d/m/Y
		$str = explode("/",$date);
		return sprintf("%02d",$str['1']).'/'.sprintf("%02d",$str['0']).'/'.$str['2'];
	}

	public function number_to_words($number){
		$number = floatval($number);
		$dictionary  = array(
			'0'                   => 'Không',
			'1'                   => 'Một',
			'2'                   => 'Hai',
			'3'                   => 'Ba',
			'4'                   => 'Bốn',
			'5'                   => 'Năm',
			'6'                   => 'Sáu',
			'7'                   => 'Bảy',
			'8'                   => 'Tám',
			'9'                   => 'Chín',
		);

		$len = strlen($number);
		
		if($len < 4 ){
			return $this->doi3so($number,$dictionary,'1');
		}else if( $len < 7){
			
			return $this->doi3so(substr($number, 0 , $len - 3),$dictionary).' Ngàn '.$this->doi3so(substr($number, $len-3),$dictionary,'1');
		
		}else  if( $len < 10 ){
			
			$string = $this->doi3so(substr($number, $len-6,3),$dictionary).' Ngàn '.$this->doi3so(substr($number, $len-3),$dictionary,'1');
			$string = $this->doi3so(substr($number, 0 , $len - 6),$dictionary).' Triệu '.$string;
			return $string;
			
		}else  if( $len < 13 ){
		
			$string = $this->doi3so(substr($number, $len-6,3),$dictionary).' Ngàn '.$this->doi3so(substr($number, $len-3),$dictionary,'1');
			$string = $this->doi3so(substr($number, $len-9,3),$dictionary).' Triệu '.$string;
			$string = $this->doi3so(substr($number, 0, $len - 9 ),$dictionary).' Tỷ '.$string;
			return $string;
			
		}else{
			return 'Out of limit';
		}
	}

	private function doi3so($number,$dictionary,$doc=''){//#$doc khi giá trị là 1 thì đọc còn ko thì trả về rỗng
		$number = floatval($number);
		if($number==0){
			if($doc=='1'){
				return '';
			}else{
				return 'Không';
			}
		}else if($number<100){
			return $this->doi2so($number,$dictionary);
		}else{		
			if($number==100){
				return 'Một Trăm';
			}else if(substr($number,1,1) == 0){
				if(substr($number,2,1) == 0){
					return $dictionary[substr($number,0,1)].' Trăm ';
				}else{
					return $dictionary[substr($number,0,1)].' Trăm Lẻ '.$this->doi2so(substr($number, 1),$dictionary);
				}
			}else{
				return $dictionary[substr($number,0,1)].' Trăm '.$this->doi2so(substr($number, 1),$dictionary);
			}
		}
	}

	private function doi2so($number,$dictionary){
		$number = floatval($number);
		if($number==0){
			return 'Không';
		}else if($number<10){
			return $dictionary[$number];
		}else if($number==10){
			return 'Mười';
		}else if($number<20){
			$num_2 = substr($number, 1,1);
			if($num_2==5){
				return 'Mười Lăm';
			}else{
				return 'Mười '.$dictionary[$num_2];
			}
		}else{
			$num_2 = substr($number, 1,1);
			
			if($num_2==0){
				$str2 = '';
			}else if($num_2==1){
				$str2 = 'Mốt';
			}else if($num_2==5){
				$str2 = 'Lăm';
			}else{
				$str2 = $dictionary[$num_2];
			}
			return $dictionary[substr($number, 0,1)].' Mươi '.$str2;			
		}
	}
	
	
	function upimg($file,$dir, $x = ''){
		$handle = new upload($file);
		header('Content-type: ' . $handle->file_src_mime);
	  	if ($handle->uploaded) {
	      	
	      	$handle->image_text            = '';
			$handle->image_text_color      = '#0000FF';
			$handle->image_text_background = '#FFFFFF';
			$handle->image_text_position   = 'BR';
			$handle->image_text_padding_x  = 10;
			$handle->image_text_padding_y  = 2;			
			  
			if( $x != '' ){
				if($handle->image_src_x > $handle->image_src_y){
					$handle->image_resize         = true;
					$handle->image_x              = $x;//x=600
					$handle->image_ratio_y        = true;
				}else{
					$handle->image_resize         = true;
					$handle->image_y              = $x;
					$handle->image_ratio_x        = true;
				}
			}
	      	@$handle->process($dir);			
		    if ($handle->processed) {
		        return $handle->file_dst_name;
		    }
			
		    $handle->clean();
	  	} else {
	  		echo $handle->error;
	  	}
	}

	function url($str) {
		$str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
		$str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
		$str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
		$str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
		$str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
		$str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
		$str = preg_replace("/(đ)/", 'd', $str);
		$str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
		$str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
		$str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
		$str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
		$str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
		$str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
		$str = preg_replace("/(Đ)/", 'D', $str);
		$str = preg_replace("/(,)/", ' ', $str);
		$str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
		$str = preg_replace("/(\:|\;|\`|\'|\"|\~|\!|\@|\#|\%|\^|\&|\*|\,|\/|\(|\)|\.)/", ' ', $str);

		$str = str_replace("\\", "", $str);
		$str = str_replace("$", "", $str);		
		$str = str_replace(" ", "-", $str);
		$str = str_replace("  ", "-", $str);
		$str = str_replace("---", "-", $str);
		$str = str_replace("--", "-", $str);
		$str = str_replace("___", "-", $str);
		$str = str_replace("__", "-", $str);
		$str = str_replace("_", "-", $str);
		
		return $str;
	}
	
	function upfile($file,$dir){
		$handle = new upload($file);
	  	if ($handle->uploaded) {
	  		$handle->allowed = array('application/*','application/msexcel', 'image/*');
	      	$handle->process($dir);
		    if ($handle->processed) {
		        return $handle->file_dst_name;		        
		    } else {
		    	echo $handle->error;
		    }
		    $handle->clean();
	  	} else {
	  		echo $handle->error;
	  	}
	}
	public function toJsonData($status,$message,$data){
		$kq['status'] = $status;
		$kq['message'] = $message;
		$kq['data'] = $data;
		return json_encode($kq);
	}

	public function successJsonData($data = null ){
		$kq['status'] = '200';
		$kq['message'] = 'success';
		$kq['data'] = $data;
		return json_encode($kq);
	}

	public function failJsonData($message){
		$kq['status'] = '403';
		$kq['message'] = $message;
		$kq['data'] = null;
		return json_encode($kq);
	}

	public function union_tables($table_name, $from, $to){
		global $db;

		$sql = '';
		//lay gio bat dau cua he thong nay
		$opt = new option();
		$setup = $opt->showall();

		if( $from <= $setup['begin_time']){
			$from = $setup['begin_time'];
		}elseif( $from > time() ){
			$from = time();
		}
		
		if( $to <= $setup['begin_time'] ){
			$to = $setup['begin_time']+1;
		}else if( $to > time() ){
			$to = time();
		}

		// exit( date('d/m/Y H:i', $from).'@@'.date('d/m/Y H:i', $from) );

		if( date("Ym", $from) == date("Ym", $to - 1) ){
			return $db->tbl_fix.$table_name.'_'.date('Ym', $from);
		}else{

			$sql .= "SELECT * FROM ".$db->tbl_fix.$table_name."_".date('Ym', $from);
			$from = strtotime( date("Y-m-d", $from) . " +1 month" );

			while ( strtotime(date('m/01/Y',$from)) < $to ) {
				$sql .= " UNION SELECT * FROM ".$db->tbl_fix.$table_name."_".date('Ym', $from);
				$from = strtotime( date("Y-m-d", $from) . " +1 month" );
			}
			
			return '( '.$sql.' )';
		}
	}

	public function union_tables_posHP( $shop_id, $table_name, $from, $to ){
		global $db;

		$sql = '';
		//lay gio bat dau cua he thong nay
		$opt = new option();
		$setup = $opt->showall();

		if( $from <= $setup['begin_time']){
			$from = $setup['begin_time'];
		}elseif( $from > time() ){
			$from = time();
		}
		
		if( $to <= $setup['begin_time'] ){
			$to = $setup['begin_time']+1;
		}else if( $to > time() ){
			$to = time();
		}

		if( date("Y", $from) == date("Y", $to - 1) ){
			return $db->tbl_fix.$table_name.'_'.$shop_id.'_'.date('Y', $from);
		}else{

			$sql .= "SELECT * FROM ".$db->tbl_fix.$table_name.'_'.$shop_id.'_'.date('Y', $from);
			$from = strtotime( date("Y-m-d", $from) . " +1 month" );

			while ( strtotime(date('m/01/Y',$from)) < $to ) {
				$sql .= " UNION SELECT * FROM ".$db->tbl_fix.$table_name."_".$shop_id."_".date('Y', $from);
				$from = strtotime( date("Y-m-d", $from) . " +1 month" );
			}
			
			return '( '.$sql.' )';
		}
	}

	public function union_tables_quick($table_name, $from, $to, $begin_time){
		global $db;

		$sql = '';
		// echo( date('d/m/Y H:i', $from).'@@'.date('d/m/Y H:i', $to) );
		if( $from <= $begin_time ){
			$from = $begin_time;
		}elseif( $from > time() ){
			$from = time();
		}
		
		if( $to <= $begin_time ){
			$to = $begin_time;
		}elseif( $to > time() ){
			$to = time();
		}
		
		if( date("Ym", $from) == date("Ym", $to) ){

			return $db->tbl_fix.$table_name.'_'.date('Ym', $from);
		}else{

			$sql .= "SELECT * FROM ".$db->tbl_fix.$table_name."_".date('Ym', $from);
			$from = strtotime( date("Y-m-d", $from) . " +1 month" );

			while ( strtotime(date('m/01/Y',$from)) < $to ) {
				$sql .= " UNION SELECT * FROM ".$db->tbl_fix.$table_name."_".date('Ym', $from);
				$from = strtotime( date("Y-m-d", $from) . " +1 month" );
			}

			return '( '.$sql.' )';
		}
	}

	public function union_tables_quick_posHP( $shop_id, $table_name, $from, $to, $begin_time){
		global $db;

		$sql = '';
		if( $from <= $begin_time ){
			$from = $begin_time;
		}elseif( $from > time() ){
			$from = time();
		}
		
		if( $to <= $begin_time ){
			$to = $begin_time;
		}elseif( $to > time() ){
			$to = time();
		}
		
		if( date("Y", $from) == date("Y", $to) ){
			return $db->tbl_fix.$table_name.'_'.$shop_id.'_'.date('Y', $from);
		}else{

			$sql .= "SELECT * FROM ".$db->tbl_fix.$table_name."_".$shop_id."_".date('Y', $from);
			$from = strtotime( date("Y-m-d", $from) . " +1 month" );

			while ( strtotime(date('m/01/Y',$from)) < $to ) {
				$sql .= " UNION SELECT * FROM ".$db->tbl_fix.$table_name."_".$shop_id."_".date('Y', $from);
				$from = strtotime( date("Y-m-d", $from) . " +1 month" );
			}

			return '( '.$sql.' )';
		}
	}


	public function union_tables_incre($table_name, $from, $to, $begin_time){
		global $db;

		$sql = '';
		// echo( date('d/m/Y H:i', $from).'@@'.date('d/m/Y H:i', $to) );
		if( $from <= $begin_time ){
			$from = $begin_time;
		}elseif( $from > time() ){
			$from = time();
		}
		
		if( $to <= $begin_time ){
			$to = $begin_time + 1;
		}elseif( $to > time() ){
			$to = time()+1;
		}
		
		// exit( date('d/m/Y H:i', $from).'@@'.date('d/m/Y H:i', $to) );

		if( date("Ym", $from) == date("Ym", $to -1) ){
			return $db->tbl_fix.$table_name.'_'.date('Y', $from);
		}else{

			$sql .= "SELECT * FROM ".$db->tbl_fix.$table_name."_".date('Ym', $from);
			$from = strtotime( date("Y-m-d", $from) . " +1 month" );

			while ( strtotime(date('m/01/Y',$from)) < $to ) {
				$sql .= " UNION SELECT * FROM ".$db->tbl_fix.$table_name."_".date('Ym', $from);
				$from = strtotime( date("Y-m-d", $from) . " +1 month" );
			}
			return '( '.$sql.' )';
		}
	}

	public function union_tables_incre_posHP( $shop_id, $table_name, $from, $to, $begin_time){
		global $db;

		$sql = '';
		// echo( date('d/m/Y H:i', $from).'@@'.date('d/m/Y H:i', $to) );
		if( $from <= $begin_time ){
			$from = $begin_time;
		}elseif( $from > time() ){
			$from = time();
		}
		
		if( $to <= $begin_time ){
			$to = $begin_time + 1;
		}elseif( $to > time() ){
			$to = time()+1;
		}
		
		// exit( date('d/m/Y H:i', $from).'@@'.date('d/m/Y H:i', $to) );

		if( date("Y", $from) == date("Y", $to -1) ){
			return $db->tbl_fix.$table_name.'_'.$shop_id.'_'.date('Y', $from);
		}else{

			$sql .= "SELECT * FROM ".$db->tbl_fix.$table_name."_".$shop_id."_".date('Y', $from);
			$from = strtotime( date("Y-m-d", $from) . " +1 month" );

			while ( strtotime(date('m/01/Y',$from)) < $to ) {
				$sql .= " UNION SELECT * FROM ".$db->tbl_fix.$table_name."_".$shop_id."_".date('Y', $from);
				$from = strtotime( date("Y-m-d", $from) . " +1 month" );
			}
			return '( '.$sql.' )';
		}
	}

	public function get_option_month_year( $begin_time , $lang){
	
		$begin_year = @date('Y', $begin_time) - 1;
		$now_year = @date('Y');
		$lYear = '';
		$lMonth = '';
		for ( $i = $now_year; $i > $begin_year; $i--) { 
			if($i == date('Y') )
				$lYear .= "<option selected value='".$i."'>".$i."</option>";
			else
				$lYear .= "<option value='".$i."'>".$i."</option>";
		}
		for ( $i = 1; $i < 13; $i++ ) {
			if($i == date('m') )
				$lMonth .= "<option selected value='".$i."'>".$lang['lb_month_'.$i]."</option>";
			else
				$lMonth .= "<option value='".$i."'>".$lang['lb_month_'.$i]."</option>";
		}

		return array('optMonth' => $lMonth, 'optYear' => $lYear);
	}

	public function optTimeZones( $selectedzone = 'Asia/Ho_Chi_minh' )
	{
	  $lTimeZones =  array (
			    '(UTC-11:00) Midway Island' => 'Pacific/Midway',
			    '(UTC-11:00) Samoa' => 'Pacific/Samoa',
			    '(UTC-10:00) Hawaii' => 'Pacific/Honolulu',
			    '(UTC-09:00) Alaska' => 'US/Alaska',
			    '(UTC-08:00) Pacific Time (US &amp; Canada)' => 'America/Los_Angeles',
			    '(UTC-08:00) Tijuana' => 'America/Tijuana',
			    '(UTC-07:00) Arizona' => 'US/Arizona',
			    '(UTC-07:00) Chihuahua' => 'America/Chihuahua',
			    '(UTC-07:00) La Paz' => 'America/Chihuahua',
			    '(UTC-07:00) Mazatlan' => 'America/Mazatlan',
			    '(UTC-07:00) Mountain Time (US &amp; Canada)' => 'US/Mountain',
			    '(UTC-06:00) Central America' => 'America/Managua',
			    '(UTC-06:00) Central Time (US &amp; Canada)' => 'US/Central',
			    '(UTC-06:00) Guadalajara' => 'America/Mexico_City',
			    '(UTC-06:00) Mexico City' => 'America/Mexico_City',
			    '(UTC-06:00) Monterrey' => 'America/Monterrey',
			    '(UTC-06:00) Saskatchewan' => 'Canada/Saskatchewan',
			    '(UTC-05:00) Bogota' => 'America/Bogota',
			    '(UTC-05:00) Eastern Time (US &amp; Canada)' => 'US/Eastern',
			    '(UTC-05:00) Indiana (East)' => 'US/East-Indiana',
			    '(UTC-05:00) Lima' => 'America/Lima',
			    '(UTC-05:00) Quito' => 'America/Bogota',
			    '(UTC-04:00) Atlantic Time (Canada)' => 'Canada/Atlantic',
			    '(UTC-04:30) Caracas' => 'America/Caracas',
			    '(UTC-04:00) La Paz' => 'America/La_Paz',
			    '(UTC-04:00) Santiago' => 'America/Santiago',
			    '(UTC-03:30) Newfoundland' => 'Canada/Newfoundland',
			    '(UTC-03:00) Brasilia' => 'America/Sao_Paulo',
			    '(UTC-03:00) Buenos Aires' => 'America/Argentina/Buenos_Aires',
			    '(UTC-03:00) Georgetown' => 'America/Argentina/Buenos_Aires',
			    '(UTC-03:00) Greenland' => 'America/Godthab',
			    '(UTC-02:00) Mid-Atlantic' => 'America/Noronha',
			    '(UTC-01:00) Azores' => 'Atlantic/Azores',
			    '(UTC-01:00) Cape Verde Is.' => 'Atlantic/Cape_Verde',
			    '(UTC+00:00) Casablanca' => 'Africa/Casablanca',
			    '(UTC+00:00) Edinburgh' => 'Europe/London',
			    '(UTC+00:00) Greenwich Mean Time : Dublin' => 'Etc/Greenwich',
			    '(UTC+00:00) Lisbon' => 'Europe/Lisbon',
			    '(UTC+00:00) London' => 'Europe/London',
			    '(UTC+00:00) Monrovia' => 'Africa/Monrovia',
			    '(UTC+00:00) UTC' => 'UTC',
			    '(UTC+01:00) Amsterdam' => 'Europe/Amsterdam',
			    '(UTC+01:00) Belgrade' => 'Europe/Belgrade',
			    '(UTC+01:00) Berlin' => 'Europe/Berlin',
			    '(UTC+01:00) Bern' => 'Europe/Berlin',
			    '(UTC+01:00) Bratislava' => 'Europe/Bratislava',
			    '(UTC+01:00) Brussels' => 'Europe/Brussels',
			    '(UTC+01:00) Budapest' => 'Europe/Budapest',
			    '(UTC+01:00) Copenhagen' => 'Europe/Copenhagen',
			    '(UTC+01:00) Ljubljana' => 'Europe/Ljubljana',
			    '(UTC+01:00) Madrid' => 'Europe/Madrid',
			    '(UTC+01:00) Paris' => 'Europe/Paris',
			    '(UTC+01:00) Prague' => 'Europe/Prague',
			    '(UTC+01:00) Rome' => 'Europe/Rome',
			    '(UTC+01:00) Sarajevo' => 'Europe/Sarajevo',
			    '(UTC+01:00) Skopje' => 'Europe/Skopje',
			    '(UTC+01:00) Stockholm' => 'Europe/Stockholm',
			    '(UTC+01:00) Vienna' => 'Europe/Vienna',
			    '(UTC+01:00) Warsaw' => 'Europe/Warsaw',
			    '(UTC+01:00) West Central Africa' => 'Africa/Lagos',
			    '(UTC+01:00) Zagreb' => 'Europe/Zagreb',
			    '(UTC+02:00) Athens' => 'Europe/Athens',
			    '(UTC+02:00) Bucharest' => 'Europe/Bucharest',
			    '(UTC+02:00) Cairo' => 'Africa/Cairo',
			    '(UTC+02:00) Harare' => 'Africa/Harare',
			    '(UTC+02:00) Helsinki' => 'Europe/Helsinki',
			    '(UTC+02:00) Istanbul' => 'Europe/Istanbul',
			    '(UTC+02:00) Jerusalem' => 'Asia/Jerusalem',
			    '(UTC+02:00) Kyiv' => 'Europe/Helsinki',
			    '(UTC+02:00) Pretoria' => 'Africa/Johannesburg',
			    '(UTC+02:00) Riga' => 'Europe/Riga',
			    '(UTC+02:00) Sofia' => 'Europe/Sofia',
			    '(UTC+02:00) Tallinn' => 'Europe/Tallinn',
			    '(UTC+02:00) Vilnius' => 'Europe/Vilnius',
			    '(UTC+03:00) Baghdad' => 'Asia/Baghdad',
			    '(UTC+03:00) Kuwait' => 'Asia/Kuwait',
			    '(UTC+03:00) Minsk' => 'Europe/Minsk',
			    '(UTC+03:00) Nairobi' => 'Africa/Nairobi',
			    '(UTC+03:00) Riyadh' => 'Asia/Riyadh',
			    '(UTC+03:00) Volgograd' => 'Europe/Volgograd',
			    '(UTC+03:30) Tehran' => 'Asia/Tehran',
			    '(UTC+04:00) Abu Dhabi' => 'Asia/Muscat',
			    '(UTC+04:00) Baku' => 'Asia/Baku',
			    '(UTC+04:00) Moscow' => 'Europe/Moscow',
			    '(UTC+04:00) Muscat' => 'Asia/Muscat',
			    '(UTC+04:00) St. Petersburg' => 'Europe/Moscow',
			    '(UTC+04:00) Tbilisi' => 'Asia/Tbilisi',
			    '(UTC+04:00) Yerevan' => 'Asia/Yerevan',
			    '(UTC+04:30) Kabul' => 'Asia/Kabul',
			    '(UTC+05:00) Islamabad' => 'Asia/Karachi',
			    '(UTC+05:00) Karachi' => 'Asia/Karachi',
			    '(UTC+05:00) Tashkent' => 'Asia/Tashkent',
			    '(UTC+05:30) Chennai' => 'Asia/Calcutta',
			    '(UTC+05:30) Kolkata' => 'Asia/Kolkata',
			    '(UTC+05:30) Mumbai' => 'Asia/Calcutta',
			    '(UTC+05:30) New Delhi' => 'Asia/Calcutta',
			    '(UTC+05:30) Sri Jayawardenepura' => 'Asia/Calcutta',
			    '(UTC+05:45) Kathmandu' => 'Asia/Katmandu',
			    '(UTC+06:00) Almaty' => 'Asia/Almaty',
			    '(UTC+06:00) Astana' => 'Asia/Dhaka',
			    '(UTC+06:00) Dhaka' => 'Asia/Dhaka',
			    '(UTC+06:00) Ekaterinburg' => 'Asia/Yekaterinburg',
			    '(UTC+06:30) Rangoon' => 'Asia/Rangoon',
			    '(UTC+07:00) Bangkok' => 'Asia/Bangkok',
			    '(UTC+07:00) Ha Noi' => 'Asia/Ho_Chi_Minh',
			    '(UTC+07:00) Ho Chi Minh' => 'Asia/Ho_Chi_minh',
			    '(UTC+07:00) Jakarta' => 'Asia/Jakarta',
			    '(UTC+07:00) Novosibirsk' => 'Asia/Novosibirsk',
			    '(UTC+08:00) Beijing' => 'Asia/Hong_Kong',
			    '(UTC+08:00) Chongqing' => 'Asia/Chongqing',
			    '(UTC+08:00) Hong Kong' => 'Asia/Hong_Kong',
			    '(UTC+08:00) Krasnoyarsk' => 'Asia/Krasnoyarsk',
			    '(UTC+08:00) Kuala Lumpur' => 'Asia/Kuala_Lumpur',
			    '(UTC+08:00) Perth' => 'Australia/Perth',
			    '(UTC+08:00) Singapore' => 'Asia/Singapore',
			    '(UTC+08:00) Taipei' => 'Asia/Taipei',
			    '(UTC+08:00) Ulaan Bataar' => 'Asia/Ulan_Bator',
			    '(UTC+08:00) Urumqi' => 'Asia/Urumqi',
			    '(UTC+09:00) Irkutsk' => 'Asia/Irkutsk',
			    '(UTC+09:00) Osaka' => 'Asia/Tokyo',
			    '(UTC+09:00) Sapporo' => 'Asia/Tokyo',
			    '(UTC+09:00) Seoul' => 'Asia/Seoul',
			    '(UTC+09:00) Tokyo' => 'Asia/Tokyo',
			    '(UTC+09:30) Adelaide' => 'Australia/Adelaide',
			    '(UTC+09:30) Darwin' => 'Australia/Darwin',
			    '(UTC+10:00) Brisbane' => 'Australia/Brisbane',
			    '(UTC+10:00) Canberra' => 'Australia/Canberra',
			    '(UTC+10:00) Guam' => 'Pacific/Guam',
			    '(UTC+10:00) Hobart' => 'Australia/Hobart',
			    '(UTC+10:00) Melbourne' => 'Australia/Melbourne',
			    '(UTC+10:00) Port Moresby' => 'Pacific/Port_Moresby',
			    '(UTC+10:00) Sydney' => 'Australia/Sydney',
			    '(UTC+10:00) Yakutsk' => 'Asia/Yakutsk',
			    '(UTC+11:00) Vladivostok' => 'Asia/Vladivostok',
			    '(UTC+12:00) Auckland' => 'Pacific/Auckland',
			    '(UTC+12:00) Fiji' => 'Pacific/Fiji',
			    '(UTC+12:00) International Date Line West' => 'Pacific/Kwajalein',
			    '(UTC+12:00) Kamchatka' => 'Asia/Kamchatka',
			    '(UTC+12:00) Magadan' => 'Asia/Magadan',
			    '(UTC+12:00) Marshall Is.' => 'Pacific/Fiji',
			    '(UTC+12:00) New Caledonia' => 'Asia/Magadan',
			    '(UTC+12:00) Solomon Is.' => 'Asia/Magadan',
			    '(UTC+12:00) Wellington' => 'Pacific/Auckland',
			    '(UTC+13:00) Nuku\'alofa' => 'Pacific/Tongatapu'
			);

		$html = '';
		foreach ($lTimeZones as $key => $item) {
			$html .='<option '.( $selectedzone == $item ? 'selected="selected"':'').' value="'.$item.'">'.$key.'</option>';
		}

		return $html;
	}
	
	public function writeToFile($filename, $strLog){
		if( !file_exists ( $filename ) ){
			$file = fopen($filename,"w");
			fclose($file);
		}
		$strLog = "\n\n****** ".date('m/d/y H:i:s')." ******".$strLog;
		file_put_contents( $filename, $strLog, FILE_APPEND);
		return true;
	}
	
	public function to_hour( $time_spent ){
		$time_spent = abs( $time_spent );
		if( $time_spent > 3600 ){
			return "> 60:00";
		}else{
			$time_spent = $time_spent % 3600;
			$min = $time_spent/60;
			$sec = $time_spent%60;
			return sprintf("%02d", $min).':'.sprintf("%02d", $sec);
		}
	}

	public function validateDate( $str_date, $format = 'd/m/Y')
	{
	    $d = DateTime::createFromFormat($format, $str_date);
	    return $d && $d->format($format) == $str_date;
	}

	public function truncateString( $text, $limit ) {
      if (str_word_count($text, 0) > $limit) {
          $words = str_word_count($text, 2);
          $pos = array_keys($words);
          $text = substr($text, 0, $pos[$limit]) . '...';
      }
      return $text;
    }

    public function post( $paramater, $filter = '' ){
		global $_POST;
		
		if( $filter == 'number' ){
			return $this->number( $_POST[$paramater] )+0;
		}else
		if( $filter == 'email' ){
			if( $this->isEmail( $_POST[$paramater] ) )
				return $_POST[$paramater];
			else{
				echo 'Error! FILTER_VALIDATE_EMAIL';
				exit();
			}
		}
		else
			if( isset($_POST[$paramater]) )
				return $_POST[$paramater];
			else
				return '';
	}

	public function isEmail( $string ){
		return filter_var( $string, FILTER_VALIDATE_EMAIL);
	}
	
	public function get( $paramater, $filter = '' ){
		global $_GET;

		if( $filter == 'number' ){
			return $this->number( $_GET[$paramater] )+0;
		}else
		if( $filter == 'email' ){
			if( $this->isEmail( $_GET[$paramater] ) )
				return $_GET[$paramater];
			else{
				echo 'Error! FILTER_VALIDATE_EMAIL';
				exit();
			}
		}
		else
			if( isset($_GET[$paramater]) )
				return $_GET[$paramater];
			else
				return '';
	}

	public function to_opt( $lItems, $setup, $lang ){
		$html = '';
		
		foreach ($lItems as $key => $item) {
			$html .= '<option value="'.$item['id'].'">'.$item['name'].'</option>';
		}
		
		return $html;
	}
	
	public function randString($length = 10) {
		$characters = 'ABCDEFGHIGKQWERTYUIOPASDFGHJKLZXCVBNM1234567890';
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $randomString;
	}

	public function globalSetup(){
		global $db_store;

		$sql = "SELECT * FROM " . $db_store->tbl_fix . "`setting`";
		$result = $db_store->executeQuery ( $sql );

		$res = array();
		while ( $rows = mysqli_fetch_assoc ( $result ) ) {

			$res[$rows['varname']] = $rows['value'];
		}
		return $res;
	}
	
	public function sendFCM( $post ){
		global $fcm_secrect_key;
		$ch = curl_init();

		//$post =  {
		//   "to" : /topics/foo-bar",
		//   "priority" : "high",
		//   "notification" : {
		//     "body" : "This is a Firebase Cloud Messaging Topic Message!",
		//     "title" : "FCM Message",
		//   }
		// }

		//to multiple topics
		//$post =  {
		//   "condition": "'dogs' in topics || 'cats' in topics",
		//   "priority" : "high",
		//   "notification" : {
		//     "body" : "This is a Firebase Cloud Messaging Topic Message!",
		//     "title" : "FCM Message",
		//   }
		// }
		
		$api = 'https://fcm.googleapis.com/fcm/send';
		$header = array(
					    'Content-Type: application/json',
					    'Authorization: key='.$fcm_secrect_key
					);

		curl_setopt($ch, CURLOPT_URL, $api);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post) );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		// curl_setopt($ch, CURLOPT_CAINFO, '../permfile/cacert.pem');

		$kq = curl_exec($ch);
		
		// print curl_error($ch);
		// $info = curl_getinfo($ch);
  		// print_r($info);
  		// print_r($kq);
		
		curl_close($ch);
		return $kq;
	}
	
}
$main = new main ();


