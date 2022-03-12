<?php
class selling extends model{

    protected $class_name = 'selling';
    protected $id;
    protected $code;
    protected $title;
    protected $province_id;
    protected $city_id;
    protected $address;
    protected $selling_type_root;
    protected $selling_type_id;
    protected $selling_unit_id;
    protected $project_name;
    protected $acreage;
    protected $direction_house;
    protected $direction_balcony;
    protected $price;
    protected $unit;
    protected $no_room;
    protected $no_toilet;
    protected $contact_name;
    protected $contact_mobile;
    protected $description;
    protected $img;
    protected $created_by;
    protected $created_at;
    protected $top;

    public function add(){
        global $db;

        $arr['code']                = $this->get('code');
        $arr['title']               = $this->get('title');
        $arr['province_id']         = $this->get('province_id');
        $arr['city_id']             = $this->get('city_id');
        $arr['address']             = $this->get('address');
        $arr['selling_type_root']   = $this->get('selling_type_root');
        $arr['selling_type_id']     = $this->get('selling_type_id')+0;
        $arr['selling_unit_id']     = $this->get('selling_unit_id');
        $arr['project_name']        = $this->get('project_name');
        $arr['acreage']             = $this->get('acreage');
        $arr['direction_house']     = $this->get('direction_house');//price sold total
        $arr['direction_balcony']   = $this->get('direction_balcony');
        $arr['price']               = $this->get('price');//json string
        $arr['unit']                = '0';//$this->get('unit');
        $arr['no_room']             = $this->get('price');
        $arr['no_toilet']           = $this->get('no_toilet');
        $arr['contact_name']        = $this->get('contact_name');
        $arr['contact_mobile']      = $this->get('contact_mobile');
        $arr['description']         = $this->get('description');
        $arr['img']                 = $this->get('img');
        $arr['created_by']          = $this->get('created_by');
        $arr['top']                 = time();
        $arr['created_at']          = time();

        $db->record_insert( $db->tbl_fix.$this->class_name, $arr );

        return $db->mysqli_insert_id();
    }

    public function update(){
        global $db;
        
        $id                         = $this->get('id');
        
        $arr['code']                = $this->get('code');
        $arr['title']               = $this->get('title');
        $arr['province_id']         = $this->get('province_id');
        $arr['city_id']             = $this->get('city_id');
        $arr['address']             = $this->get('address');
        $arr['selling_type_root']   = $this->get('selling_type_root');
        $arr['selling_type_id']     = $this->get('selling_type_id');
        $arr['selling_unit_id']     = $this->get('selling_unit_id');
        $arr['project_name']        = $this->get('project_name');
        $arr['acreage']             = $this->get('acreage');
        $arr['direction_house']     = $this->get('direction_house');//price sold total
        $arr['direction_balcony']   = $this->get('direction_balcony');
        $arr['price']               = $this->get('price');//json string
        $arr['unit']                = 0;$this->get('unit');
        $arr['no_room']             = $this->get('price');
        $arr['no_toilet']           = $this->get('no_toilet');
        $arr['contact_name']        = $this->get('contact_name');
        $arr['contact_mobile']      = $this->get('contact_mobile');
        $arr['description']         = $this->get('description');
        $arr['img']                 = $this->get('img');
        $arr['is_hidden']           = 0;
        $arr['deleted']             = 0;
        $arr['created_by']          = $this->get('created_by');

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

    public function delete(){
        global $db;
        
        $id                         = $this->get('id');

        $arr['deleted']              = 1;
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
    
    public function clonex(){
        global $db;

        $arr                        = $this->get_detail();
        unset($arr['id']);
        
        $arr['is_hidden']             = 0;
        $arr['deleted']              = 0;
        $arr['created_by']          = $this->get('created_by');
        $arr['code']                = $arr['code'].'-copy';
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

    //Danh sách bất động sản đang chờ bán suất cho nhà đầu tư
    public function list_by( $keyword, $ofset = 0, $limit = '' ) {
        global $db;
        
        $province_id        = $this->get('province_id');
        $city_id            = $this->get('city_id');
        $selling_type_root          = $this->get('selling_type_root');
                
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

        if( $selling_type_root != '' ){
            $selling_type_root = " AND pro.`selling_type_root` = '$selling_type_root' ";
        }
        
		$sql = "SELECT pro.*, IFNULL(`province`.name, 'Chưa có') province_name
                FROM ".$db->tbl_fix."`". $this->class_name ."` pro
                LEFT JOIN `province` ON province.id = pro.province_id
                WHERE
                pro.deleted = '0'
                $selling_type_root
                $keyword
                $sqlProvince
                $sqlCity
                ORDER BY pro.`top` DESC, `pro`.id DESC
                $limit ";
        
        $result = $db->executeQuery_list( $sql );

		return $result;
	}

	public function list_by_count( $keyword ) {
        global $db;
        
        $province_id        = $this->get('province_id');
        $city_id            = $this->get('city_id');
        $selling_type_root             = $this->get('selling_type_root');
        
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

        if( $selling_type_root != '' ){
            $selling_type_root = " AND `selling_type_root` = '$selling_type_root' ";
        }
		
        $sql = "SELECT COUNT(*) total
                FROM ".$db->tbl_fix."`". $this->class_name ."`
                WHERE
                pro.deleted = '0'
                $selling_type_root
                $keyword
                $sqlProvince
                $sqlCity
                $limit ";
        $result = $db->executeQuery( $sql, 1 );

		return $result['total']+0;
    }

    //list filter to market
    public function market( $keyword, $ofset, $limit ) {//by username
        global $db, $province, $city, $selling_unit, $selling_type, $selling_direction;

        $city_id        = $this->get('city_id');
        $province_id    = $this->get('province_id');
        
        if( $city_id != '' ) $city_id = " AND t.`city_id` = '$city_id' ";
        if( $province_id != '' ) $province_id = " AND t.`province_id` = '$province_id' ";

        if( $limit != '' ) $limit = " LIMIT $ofset, $limit ";
        if( $keyword != '' ) $keyword = " AND ( t.`title` LIKE '%$keyword%' OR t.`code` LIKE '%$keyword%' ) ";

		$sql = "SELECT t.*
                FROM `". $this->class_name ."` t
                WHERE
                t.`deleted` = 0 AND t.`is_hidden` = 0
                $city_id
                $province_id
                $keyword
                ORDER BY t.`top` DESC, `t`.id DESC
                $limit";

        $result = $db->executeQuery( $sql );
        
        $kq = array();
        while( $row = mysqli_fetch_assoc($result) ){

            $province->set('id', $row['province_id']);
            $row['province_name'] = $province->get_by_field('name');

            $city->set('id', $row['city_id']);
            $row['city_name'] = $city->get_by_field('name');

            $selling_unit->set('id', $row['selling_unit_id']);
            $row['selling_unit_name'] = $selling_unit->get_by_field('name');

            $selling_type->set('id', $row['selling_type_root']);
            $row['selling_type_root_name'] = $selling_type->get_by_field('name');

            $selling_type->set('id', $row['selling_type_id']);
            $row['selling_type_id_name'] = $selling_type->get_by_field('name');

            $selling_direction->set('id', $row['direction_house']);
            $row['direction_house_name'] = $selling_direction->get_by_field('name');

            $selling_direction->set('id', $row['direction_balcony']);
            $row['direction_balcony_name'] = $selling_direction->get_by_field('name');
            
            $kq[] = $row;
        }

		return $kq;
    }

    public function market_count( $keyword ) {//by username
        global $db;
        
        $city_id        = $this->get('city_id');
        $province_id    = $this->get('province_id');
        
        if( $city_id != '' ) $city_id = " AND t.`city_id` = '$city_id' ";
        if( $province_id != '' ) $province_id = " AND t.`province_id` = '$province_id' ";

        if( $keyword != '' ) $keyword = " AND ( t.`title` LIKE '%$keyword%' OR t.`code` LIKE '%$keyword%' ) ";

		$sql = "SELECT COUNT(*) total
                FROM `". $this->class_name ."` t
                WHERE 
                t.`deleted` = 0 AND t.`is_hidden` = 0
                $city_id
                $province_id
                $keyword";

		$result = $db->executeQuery( $sql, 1 );

		return $result['total']+0;
    }
    
}
$selling =  new selling();