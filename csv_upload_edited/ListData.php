<?php
/**
*Created by Sanija K
*User vinam
*Date 12-03-2018
*Time 6:20PM
*/
include_once "Database.php";

class ListData extends Database{
	var $id;
	var $name;
	var $description;
	var $file;

	/**
	*
	*/
	function __construct(){
		parent::__construct();
	}
}

?>