<?php

include_once "ListData.php";
include_once "FileContents.php";

$fileobj = new FileContents();
$listobj = new ListData();

if(isset($_POST["btnsubmit"])) {	
	$file_name = basename($_FILES["file"]["name"]);
	$_POST["file"]=$file_name;
	$data=array();
	$valid_email=array();
	$invalid_email=array();
	$mimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
	if(in_array($_FILES['file']['type'],$mimes)) {
		if($_FILES["file"]["size"] > 0) {
			$id_list=$listobj->insert($_POST);
			$file = fopen($file_name, "r");
			fgetcsv($file);
			while (($getData = fgetcsv($file, 1000, ",")) !== FALSE) {
				$data["firstname"]= $getData[0];
				$data["lastname"]= $getData[1];
				$data["email"]= $getData[2];
				$data["mobile"]= $getData[3];
				$data["website"]= $getData[4];
				$data["list_id"]=1;
				$email=$data["email"];
				if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
					$insert_to_file=$fileobj->insert($data);
					array_push($valid_email,$email);
				} 
				else {
					array_push($invalid_email,$email);
				}
	        }
	       $path = $_FILES['file']['name'];
	       $ext = pathinfo($path, PATHINFO_EXTENSION);
	       $uploaded = move_uploaded_file($_FILES["file"]["tmp_name"], $targetDirectory.uniqid().$ext);
	    }
	}
	else {
		?>
		<script type="text/javascript">
			alert("Invalid File Format");
			window.location.href = "csvupload.php";
		</script>
		<?php
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Listing Emails</title>
</head>
<body>
	<h1 align="center">LIST OF INVALID EMAIL</h1>
	<table align="center" border=1 cellspacing="10">
		<tr>
			<th>Valid Email</th>
		</tr>
		<?php
		foreach ($valid_email as $key => $value) {
			echo "<tr>";
			echo "<td>".$value."</td>";
			echo "</tr>";
		}
		?>
	</table>
	<br/><br/>
	<h1 align="center">LIST OF INVALID EMAIL</h1>
	<table border =1 align="center" cellspacing="10">
		<tr>
			<th>Invalid Email</th>
		</tr>
		<?php
		foreach ($invalid_email as $key => $value) {
			echo "<tr>";
			echo "<td>".$value."</td>";
			echo "</tr>";
		}
		?>
	</table>
</body>
</html>
