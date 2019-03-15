<?php
/**
*Created by Sanija K
*User vinam
*Date 13-03-2018
*Time 9:00 AM
*/

class Database{

	private $conn;
	private $debug;

	/**
	*
	**/

	function __construct(){

		$this->connect();
	}

	/**
	*@return void
	**/

	public function connect() : void {

		$this->conn= new mysqli(
			"localhost",
			"root",
			"vinam@123",
			"student",
			3306
		);

		if(!$this->conn)
			die($this->conn->error_log("error"));
	}

	/**
     * @param integer $debug
     */
    public function setDebug($debug) : void {
        $this->debug = $debug;
    }

    /**
	*@param Int $id
	*@param Int $limit
	*@param bool $multiple
	*@return array
	**/

	public function select($id=0,$limit=10,$multiple=false) : array {
		$unUsed=array(0=>"conn",1=>"debug");
		$classVariables=array_keys(get_class_vars(get_called_class()));
		$variables=array_diff($classVariables, $unUsed);
		$tbl_feilds=implode(",",$variables);
		$sql="select ".$tbl_feilds." from ".get_called_class();
		if($id>0) {
			$sql .= " where id = ".$id; 
			if(!$multiple){
				$sql .= " limit 1";
			} 
		}
		else {
			$sql.=" limit $limit";
		}
		if($this->debug==1) {
			echo "SQL QUERY : ".$sql."\n";
		}
		$result=$this->conn->query($sql);
		return $result->fetch_all(1);
	}

	/**
	*@param array $data
	*@return int
	**/

	public function insert($data) : int {
		$unUsed=array(0=>"conn",1=>"debug");
		$classVariables=array_keys(get_class_vars(get_called_class()));
		$variables=array_diff($classVariables, $unUsed);
		$sql="insert into ".get_called_class()." SET ";
		foreach ($data as $key => $value) {
			if(in_array($key, $variables)){				
				$sql.=$key." = '".$value."',";
			}
		}
		$sql=rtrim($sql,",");
		if($this->debug==1){
			echo "SQL QUERY : ".$sql."\n";
		}
		if($this->conn->query($sql))
			return $this->conn->insert_id;
		else  
		 	return 0;
	}

	/**
	*@param Object $obj
	*@return array
	**/

	public function select_join(Object $obj) : array {
		$unUsed=array(1=>"id");
		$classVariables=array_keys(get_object_vars($obj));
		$variables=array_diff($classVariables,$unUsed);
		// print_r($variables);
		unset($variables[4]);
		unset($variables[5]);
		// print_r($variables);
		$tbl_feilds=implode(",", $variables);
		// print_r($tbl_feilds);
		$sql=" select ListData.id,FileContents.id, ".$tbl_feilds." from ListData join FileContents on ListData.id = FileContents.id ";
		if($this->debug==1) {
			echo " SQL QUERY FOR JOIN : ".$sql."\n";
		}
		$result=$this->conn->query($sql);
		return $result->fetch_all(1);
	}
}
?>

    