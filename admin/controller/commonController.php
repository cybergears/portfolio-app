<?php
//include('../../class/class.db.php');
class CommonController extends Query{
	var $image_save_folder ;
	var $table_name;
	var $table_id;
	function __construct($table='', $id=0 ,$image_save_folder='' ){
		$this->table_name = $table;
		$this->table_id = $id;
		$this->image_save_folder = $image_save_folder;
		$this->db = new DB();	
	}

	

	

	

}

?>