<?php
class product extends model{

    protected $class_name = 'product';
    protected $id;
    protected $code;
    protected $province_id;
    protected $city_id;
    protected $title;
    protected $description;
    protected $price;
    protected $slots_total;
    protected $slots_sold;
    protected $price_sold;//giá bán cuối cùng
    protected $fee_total;//Tổng chi phí phát sinh
    protected $fee_detail;//Chi tiết chi phí
    protected $ROI;//Lợi nhuận đầu tư
    protected $status;//=0 là đang chờ bán; = 1 là đã bán
    protected $images;//img1;img2;
    protected $receive_fund_account;
    protected $receive_fund_fullname;
    protected $created_by;
    protected $top;
    protected $created_at;
    protected $is_hidden;

    public function add(){
        global $db;

        $arr['code']                = $this->get('code');
        $arr['province_id']         = $this->get('province_id');
        $arr['city_id']             = $this->get('city_id');
        $arr['title']               = $this->get('title');
        $arr['description']         = $this->get('description');
        $arr['price']               = $this->get('price');//price per unit
        $arr['slots_total']         = $this->get('slots_total');
        $arr['slots_sold']          = $this->get('slots_sold');
        $arr['price_sold']          = $this->get('price_sold');//price sold total
        $arr['fee_total']           = $this->get('fee_total');
        $arr['fee_detail']          = $this->get('fee_detail');//json string
        $arr['ROI']                 = $arr['price_sold'] > 0  ?( ( $arr['price_sold'] - $arr['slots_total']*$arr['price'] - $arr['fee_total'] )/($arr['slots_total']*$arr['price']) ):0;
        $arr['status']              = 0;
        $arr['images']              = $this->get('images');
        $arr['receive_fund_account'] = $this->get('receive_fund_account');
        $arr['receive_fund_fullname'] = $this->get('receive_fund_fullname');
        $arr['created_by']          = $this->get('created_by');
        $arr['is_hidden']           = 0;
        $arr['top']                 = time();
        $arr['created_at']          = time();

        $db->record_insert( $db->tbl_fix.$this->class_name, $arr );

        return $db->mysqli_insert_id();
    }

    public function update(){
        global $db;
        
        $id                         = $this->get('id');
        
        $arr['code']                = $this->get('code');
        $arr['province_id']         = $this->get('province_id');
        $arr['city_id']             = $this->get('city_id');
        $arr['title']               = $this->get('title');
        $arr['description']         = $this->get('description');
        $arr['price']               = $this->get('price');//price per unit
        $arr['slots_total']         = $this->get('slots_total');
        $arr['slots_sold']          = $this->get('slots_sold');
        $arr['price_sold']          = $this->get('price_sold');//price sold total
        $arr['fee_total']           = $this->get('fee_total');
        $arr['fee_detail']          = $this->get('fee_detail');//json string
        $arr['ROI']                 = $arr['price_sold'] > 0  ?( ( $arr['price_sold'] - $arr['slots_total']*$arr['price'] - $arr['fee_total'] )/($arr['slots_total']*$arr['price']) ):0;
        $arr['status']              = $this->get('status');
        $arr['images']              = $this->get('images');
        $arr['receive_fund_account'] = $this->get('receive_fund_account');
        $arr['receive_fund_fullname'] = $this->get('receive_fund_fullname');
        // $arr['created_by']          = $this->get('created_by');

        $db->record_update( $db->tbl_fix.$this->class_name, $arr, " `id` = '$id' " );
        return true;
    }

    public function update_top(){
        global $db;
        
        $id                         = $this->get('id');
        $arr['top']                 = time();

        $db->record_update( $db->tbl_fix.$this->class_name, $arr, " `id` = '$id' " );
        return true;
    }

    public function update_refund_slots( $slots_refund ){
        global $db;
        
        $id                         = $this->get('id');
        
        $slots_refund += 0;

        $sql = "UPDATE ". $db->tbl_fix.$this->class_name . " SET `slots_total` = (`slots_total` - '$slots_refund'), `slots_sold` = (`slots_sold` + '$slots_refund') WHERE `id` = '$id'  ";
        
		$result = $db->executeQuery( $sql  );
        return true;
    }
    
    public function delete(){
        global $db, $product_history;
        
        $id                         = $this->get('id');

        $arr['status']              = -1;
        $db->record_update( $db->tbl_fix.$this->class_name, $arr, " `id` = '$id' " );

        $product_history->set('product_id', $id);
        $product_history->delete();

        return true;
    }

    public function clonex(){
        global $db;

        $arr                        = $this->get_detail();
        unset($arr['id']);
        
        $arr['status']              = 0;
        $arr['slots_sold']          = 0;
        $arr['created_by']          = $this->get('created_by');
        $arr['code']                = $arr['code'].'-copy';
        $arr['top']                 = time();
        $arr['created_at']          = time();

        $db->record_insert( $db->tbl_fix.$this->class_name, $arr );

        return $db->mysqli_insert_id();
    }

    public function update_is_hidden(){
        global $db;

        $id                        = $this->get('id');
        
        $sql = "UPDATE $db->tbl_fix$this->class_name SET `is_hidden` = IF( `is_hidden` = 0, 1, 0) WHERE `id` = '$id' ";
        echo $sql;
		$result = $db->executeQuery( $sql );

        return true;
    }

    public function update_slots_sold(){
        global $db;

        $id                         = $this->get('id');
        $arr['slots_sold']          = $this->get('slots_sold');
        $db->record_update( $db->tbl_fix.$this->class_name, $arr, " `id` = '$id' " );

        return true;
    }

    public function get_detail_by_code() {
        global $db;
        
        $code        = $this->get('code');
		$sql = "SELECT *
                FROM ".$db->tbl_fix."`". $this->class_name ."`
                WHERE `code` = '$code'
                LIMIT 1";

		$result = $db->executeQuery( $sql, 1 );

		return $result;
	}
    
    //Danh sách bất động sản đang chờ bán suất cho nhà đầu tư
    public function init_static() {
        global $db;
        
        $username = $this->get('username');
        $sql = "SELECT SUM(price*total) total_invested_received_profit, SUM(ROI) ROI, COUNT(*) time_count
                FROM( 
                        SELECT pro.`ROI`, pro.`price`, SUM(psh.`slots`) total FROM `product_sold_history` psh
                        INNER JOIN `product` pro ON psh.`product_id` = pro.`id`
                        WHERE pro.`status` = 1 and psh.`username` = '$username'
                        GROUP BY pro.`id` 
                ) nTB";

        $result = $db->executeQuery( $sql, 1 );
        $kq = array();
        
        if( isset($result['total_invested_received_profit']) ){
            $kq['profit_percent']           =  $result['ROI']/$result['time_count'];
            $kq['total_profit_received']    =  $result['total_invested_received_profit']*$kq['profit_percent'];
        }else{
            $kq['total_profit_received']    =  0;
            $kq['profit_percent']           =  0;
        }

        $sql = "SELECT SUM(total_invested) total_invested, COUNT(*) total_product_invested
                FROM( 
                        SELECT SUM((`pro`.price*`psh`.slots)) `total_invested`
                        FROM `product_sold_history` psh
                        INNER JOIN `product` pro ON psh.`product_id` = pro.`id`
                        WHERE psh.`username` = '$username'
                        GROUP BY pro.`id` 
                ) nTB";

        $result = $db->executeQuery( $sql, 1 );
        
        if( isset( $result['total_invested'] ) ){
            $kq['total_invested']           =  $result['total_invested']+0;
            $kq['total_product_invested']   =  $result['total_product_invested']+0;
        }else{
            $kq['total_invested']           =  0;
            $kq['total_product_invested']   =  0;
        }

		return $kq;
    }

    public function list_investor_all_by_product() {
        global $db, $product_history;
        
       $lA = $this->list_all();
       $kq = array();
       foreach ($lA as $key => $it) {
           $k['code'] = $it['code'];
           $product_history->set('product_id', $it['id']);
           $k['list_investor'] = $product_history->list_investor_by_product_id();
           $kq[] = $k;
       }

       return $kq;
    }
    //Danh sách bất động sản đang chờ bán suất cho nhà đầu tư
    public function list_invested( $ofset = 0, $limit = '' ) {
        global $db;
        
        if( $limit != '' ) $limit = " LIMIT $ofset, $limit ";
        
        $status = $this->get('status');
        $status = " AND pro.`status` = '$status' ";

        $username = $this->get('username');
        if( $username != '' ) $username = " AND psh.`username` = '$username' ";

		$sql = "SELECT pro.*, SUM(psh.`slots`) slots_own
                FROM ".$db->tbl_fix."`". $this->class_name ."` pro
                INNER JOIN ".$db->tbl_fix."`product_sold_history` psh ON psh.product_id = pro.id
                WHERE
                psh.`slots` > 0
                $status
                $username
                GROUP BY pro.id
                $limit ";
        
        $result = $db->executeQuery( $sql );
        
        $kq = array();
        while ($row = mysqli_fetch_assoc( $result )) {
            $row['images'] = explode(';', $row['images']);
            unset($row['images'][COUNT($row['images'])-1]);
            if( $row['fee_detail'] == '' )
                $row['fee_detail'] = array();
            else{
                $row['fee_detail'] = json_decode($row['fee_detail'], true);
                if( !is_array($row['fee_detail']) ) $row['fee_detail'] = array();
            }
            $kq[] = $row;
        }
        mysqli_free_result( $result );

		return $kq;
    }
    
    //Danh sách bất động sản đang chờ bán suất cho nhà đầu tư
    public function list_by( $keyword, $ofset = 0, $limit = '' ) {
        global $db;
        
        $province_id        = $this->get('province_id');
        $city_id            = $this->get('city_id');
        $status             = $this->get('status');
                
        if( $limit != '' ) $limit = " LIMIT $ofset, $limit ";
        
        if( $keyword != '' ) $keyword = " AND (pro.`code` LIKE '%$keyword%' OR pro.`title` LIKE '%$keyword%' ) ";

        $sqlProvince = '';
        if( $province_id != '' ){
            $lProvinces = explode(';', $province_id);
            foreach ($lProvinces as $key => $itp) {
                if( $itp != '' )
                    $sqlProvince .= " pro.`province_id` = '$itp' OR ";
            }
            unset( $lProvinces );
            unset( $itp );
            if( $sqlProvince != '' ){
                $sqlProvince = substr( $sqlProvince, 0, -3 );
                $sqlProvince = "AND ( $sqlProvince ) ";
            }
        }

        $sqlCity = '';
        if( $city_id != '' ){
            $lCities = explode(';', $city_id);
            foreach ($lCities as $key => $itp) {
                if( $itp != '' )
                    $sqlCity .= " pro.`city_id` = '$itp' OR ";
            }
            unset( $lCities );
            unset( $itp );
            if( $sqlCity != '' ){
                $sqlCity = substr( $sqlCity, 0, -3 );
                $sqlCity = "AND ( $sqlCity ) ";
            }
        }

        if( $status != '' ){
            $status = " pro.`status` = '$status' ";
        }else{
            $status = " pro.`status` <> -1 ";
        }
        
		$sql = "SELECT pro.*, IFNULL(`province`.name, 'Chưa có') province_name
                FROM ".$db->tbl_fix."`". $this->class_name ."` pro
                LEFT JOIN `province` ON province.id = pro.province_id
                WHERE
                $status
                $keyword
                $sqlProvince
                $sqlCity
                ORDER BY `top` DESC, `id` DESC
                $limit";
        
        $result = $db->executeQuery( $sql );
        
        $kq = array();
        while ($row = mysqli_fetch_assoc( $result )) {
            $row['images'] = explode(';', $row['images']);
            unset($row['images'][COUNT($row['images'])-1]);
            $kq[] = $row;
        }
        mysqli_free_result( $result );

		return $kq;
	}

	public function list_by_count( $keyword ) {
        global $db;
        
        $province_id        = $this->get('province_id');
        $city_id            = $this->get('city_id');
        $status             = $this->get('status');
        
        if( $keyword != '' ) $keyword = " AND (`code` LIKE '%$keyword%' OR `title` LIKE '%$keyword%' ) ";
        
        $sqlProvince = '';
        if( $province_id != '' ){
            $lProvinces = explode(';', $province_id);
            foreach ($lProvinces as $key => $itp) {
                if( $itp != '' )
                    $sqlProvince .= " `province_id` = '$itp' OR ";
            }
            unset( $lProvinces );
            unset( $itp );
            if( $sqlProvince != '' ){
                $sqlProvince = substr( $sqlProvince, 0, -3 );
                $sqlProvince = "AND ( $sqlProvince ) ";
            }
        }

        $sqlCity = '';
        if( $city_id != '' ){
            $lCities = explode(';', $city_id);
            foreach ($lCities as $key => $itp) {
                if( $itp != '' )
                    $sqlCity .= " `city_id` = '$itp' OR ";
            }
            unset( $lCities );
            unset( $itp );
            if( $sqlCity != '' ){
                $sqlCity = substr( $sqlCity, 0, -3 );
                $sqlCity = "AND ( $sqlCity ) ";
            }
        }

        if( $status != '' ){
            $status = "`status` = '$status' ";
        }else{
            $status = "`status` <> -1 ";
        }
		
        $sql = "SELECT COUNT(*) total
                FROM ".$db->tbl_fix."`". $this->class_name ."`
                WHERE
                $status
                $keyword
                $sqlProvince
                $sqlCity
                $limit ";
        $result = $db->executeQuery( $sql, 1 );

		return $result['total']+0;
    }

    //Danh sách bất động sản đang chờ bán suất cho nhà đầu tư
    public function list_by_client( $keyword, $ofset = 0, $limit = '' ) {
        global $db;
        
        $province_id        = $this->get('province_id');
        $city_id            = $this->get('city_id');
        $status             = $this->get('status');
                
        if( $limit != '' ) $limit = " LIMIT $ofset, $limit ";
        
        if( $keyword != '' ) $keyword = " AND (pro.`code` LIKE '%$keyword%' OR pro.`title` LIKE '%$keyword%' ) ";

        $sqlProvince = '';
        if( $province_id != '' ){
            $lProvinces = explode(';', $province_id);
            foreach ($lProvinces as $key => $itp) {
                if( $itp != '' )
                    $sqlProvince .= " pro.`province_id` = '$itp' OR ";
            }
            unset( $lProvinces );
            unset( $itp );
            if( $sqlProvince != '' ){
                $sqlProvince = substr( $sqlProvince, 0, -3 );
                $sqlProvince = "AND ( $sqlProvince ) ";
            }
        }

        $sqlCity = '';
        if( $city_id != '' ){
            $lCities = explode(';', $city_id);
            foreach ($lCities as $key => $itp) {
                if( $itp != '' )
                    $sqlCity .= " pro.`city_id` = '$itp' OR ";
            }
            unset( $lCities );
            unset( $itp );
            if( $sqlCity != '' ){
                $sqlCity = substr( $sqlCity, 0, -3 );
                $sqlCity = "AND ( $sqlCity ) ";
            }
        }

        if( $status != '' ){
            $status = " AND pro.`status` = '$status' ";
        }else{
            $status = " AND pro.`status` <> -1 ";
        }
        
		$sql = "SELECT pro.*, IFNULL(`province`.name, 'Chưa có') province_name
                FROM ".$db->tbl_fix."`". $this->class_name ."` pro
                LEFT JOIN `province` ON province.id = pro.province_id
                WHERE
                pro.is_hidden = '0'
                $status
                $keyword
                $sqlProvince
                $sqlCity
                ORDER BY `top` DESC, `id` DESC
                $limit ";
        
        $result = $db->executeQuery( $sql );
        
        $kq = array();
        while ($row = mysqli_fetch_assoc( $result )) {
            $row['images'] = explode(';', $row['images']);
            unset($row['images'][COUNT($row['images'])-1]);
            $kq[] = $row;
        }
        mysqli_free_result( $result );

		return $kq;
	}

	public function list_by_client_count( $keyword ) {
        global $db;
        
        $province_id        = $this->get('province_id');
        $city_id            = $this->get('city_id');
        $status             = $this->get('status');
        
        if( $keyword != '' ) $keyword = " AND (`code` LIKE '%$keyword%' OR `title` LIKE '%$keyword%' ) ";
        
        $sqlProvince = '';
        if( $province_id != '' ){
            $lProvinces = explode(';', $province_id);
            foreach ($lProvinces as $key => $itp) {
                if( $itp != '' )
                    $sqlProvince .= " `province_id` = '$itp' OR ";
            }
            unset( $lProvinces );
            unset( $itp );
            if( $sqlProvince != '' ){
                $sqlProvince = substr( $sqlProvince, 0, -3 );
                $sqlProvince = "AND ( $sqlProvince ) ";
            }
        }
        
        $sqlCity = '';
        if( $city_id != '' ){
            $lCities = explode(';', $city_id);
            foreach ($lCities as $key => $itp) {
                if( $itp != '' )
                    $sqlCity .= " `city_id` = '$itp' OR ";
            }
            unset( $lCities );
            unset( $itp );
            if( $sqlCity != '' ){
                $sqlCity = substr( $sqlCity, 0, -3 );
                $sqlCity = "AND ( $sqlCity ) ";
            }
        }

        if( $status != '' ){
            $status = " AND `status` = '$status' ";
        }else{
            $status = " AND `status` <> -1 ";
        }
		
        $sql = "SELECT COUNT(*) total
                FROM ".$db->tbl_fix."`". $this->class_name ."`
                WHERE
                pro.is_hidden = '0'
                $status
                $keyword
                $sqlProvince
                $sqlCity
                $limit ";
        $result = $db->executeQuery( $sql, 1 );

		return $result['total']+0;
    }
    
}
$product =  new product();