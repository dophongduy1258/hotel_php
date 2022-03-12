<?php
class city extends model{

    protected $class_name = 'city';
    protected $id;
    protected $name;
    protected $province_id;
    protected $deleted;
    protected $priority;
    protected $created_by;

    public function add(){
        global $db;

        $arr['name']                = $this->get('name');
        $arr['province_id']         = $this->get('province_id');
        $arr['deleted']             = 0;
        $arr['priority']            = $this->get('priority');
        $arr['created_by']          = $this->get('created_by');

        $db->record_insert( $db->tbl_fix.$this->class_name, $arr );

        return $db->mysqli_insert_id();
    }

    public function update(){
        global $db;

        $id                         = $this->get('id');

        $arr['name']                = $this->get('name');
        // $arr['province_id']         = $this->get('province_id');

        $db->record_update( $db->tbl_fix.$this->class_name, $arr, " `id` = '$id' " );

        return true;
    }

    public function get_detail_by_name() {
        global $db;
        
        $name        = $this->get('name');

		$sql = "SELECT *
                FROM ".$db->tbl_fix."`". $this->class_name ."`
                WHERE `name` = '$name'
                LIMIT 1";

		$result = $db->executeQuery( $sql, 1 );
        
		return $result;
    }
    
    public function list_by() {
        global $db;
        
        $province_id        = $this->get('province_id');
     
        $province_id        = " AND `province_id` = '$province_id' ";
        
		$sql = "SELECT *
                FROM ".$db->tbl_fix."`". $this->class_name ."`
                WHERE
                `deleted` = 0
                $province_id
                ORDER BY `priority`, `name` ";
        
		$result = $db->executeQuery_list( $sql );

		return $result;
    }

    public function opt_by(){
        global $db;
        $province_id  = $this->get('province_id');
		$l = $this->list_by();
        
        $opt = '';
        foreach($l as $key => $item ){
            $opt .= '<option value="'.$item['id'].'">'.$item['name'].'</option>';
        }
        
		return $opt;
	}

    public function opt_all_by(){//by province: grouped
        global $db, $province;
        $l = $province->list_all();
        $opt = '';
        foreach ($l as $key => $it) {
            $this->set('province_id', $it['id']);
            $opt .= '<optgroup label="'.$it['name'].'" data-subtext="optgroup subtext">
                        '.$this->opt_by().'
                    </optgroup>';
        }
        return $opt;

    }
    
}
$city =  new city();