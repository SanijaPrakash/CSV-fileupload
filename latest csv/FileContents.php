<?php
/**
*Created by Sanija K
*User vinam
*Date 12-03-2018
*Time 6:00PM
*/
include_once "Database.php";

class FileContents extends Database {

	var $fileid;
	var $firstname;
	var $lastname;
	var $email;
	var $mobile;
	var $website;
	var $id;

	/***
	*
	**/
	function __construct() {

		parent::__construct();
	}

}
?>