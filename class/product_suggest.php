<?php
class product_suggest extends model{

    protected $class_name = 'product_suggest';
    protected $id;
    protected $username;
    protected $fullname;
    protected $address;
    protected $price;
    protected $mobile;
    protected $province_id;
    protected $images;
    protected $description;
    protected $created_at;

    public function add(){
        global $db;

        $arr['username'] = $this->get('username');
        $arr['fullname'] = $this->get('fullname');
        $arr['address'] = $this->get('address');
        $arr['price'] = $this->get('price');
        $arr['mobile'] = $this->get('mobile');
        $arr['province_id'] = $this->get('province_id');
        $arr['images'] = $this->get('images');
        $arr['description'] = $this->get('description');
        $arr['created_at'] = time();

        $db->record_insert( $db->tbl_fix.$this->class_name, $arr );
        
        return $db->mysqli_insert_id();

    }

    public function list_all( $ofset = '', $limit = ''){
        global $db;
		
		if( $limit != '' ) $limit = " LIMIT $ofset, $limit ";
		
		$sql = "SELECT t.*, pro.`name` province_name
                FROM `". $this->class_name ."` t
                LEFT JOIN `province` pro ON pro.id = t.province_id
                WHERE 1
                $limit ";

		$result = $db->executeQuery_list( $sql );

		return $result;
    }

}

$product_suggest = new product_suggest();