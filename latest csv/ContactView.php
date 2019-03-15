<?php
include_once "ListData.php";
include_once "FileContents.php";
include_once "Database.php";

class ContactView extends Database {

	/**
	*
	*/
	function __construct() {
		parent::__construct();
	}

	/**
	*@return object
	*/
	
	public function mergeObjects() : object {
		$listobj=new ListData();
		$fileobj=new FileContents();
		$obj_merged=(object) array_merge((array)$listobj,(array) $fileobj);
		return $obj_merged;
	}
}
?>