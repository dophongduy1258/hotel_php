<?php
class mlm_level extends model{

    protected $class_name = 'mlm_level';
    protected $id;
    protected $name;
    protected $commission;//float

    // public function list_all_for_setting() {
	// 	global $db;
		
	// 	$sql = "SELECT *
    //             FROM `". $this->class_name ."`
    //             WHERE 1
	// 			ORDER BY `created_at` DESC";

	// 	$result = $db->executeQuery_list( $sql );

	// 	return $result;
	// }

}
$mlm_level =  new mlm_level();