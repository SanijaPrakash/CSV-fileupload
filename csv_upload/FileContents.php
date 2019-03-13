<?php
/**
*Created by Sanija K
*User vinam
*Date 12-03-2018
*Time 6:00PM
*/
include_once "Database.php";

class FileContents extends Database {

	var $id;
	var $firstname;
	var $lastname;
	var $email;
	var $mobile;
	var $website;
	var $list_id;

	/***
	*
	**/

	function __construct() {

		parent::__construct();
	}

}
?>