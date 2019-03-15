<?php

include_once "ListData.php";
include_once "FileContents.php";

$fileobj = new FileContents();
$listobj = new ListData();
$listofdata=array();
$error = array();
$res=array();
$res['status']=1;
$data=array();
$valid_email=array();
$invalid_email=array();

if((empty($_POST['name']))) {
	$error['name'] = 'Name feild is required';
}
if (empty($_FILES['file']['name'])) {
	$error['file'] = 'Select a file to upload';
   }
if(!empty($error)){
	$res['status']=0;
	$res['error']=$error;
	echo json_encode($res);
	}
if(empty($error)) {
	$targetDirectory = "uploads/";
	$path = $_FILES['file']['name'];
	$ext = pathinfo($path, PATHINFO_EXTENSION);
	$file_name=uniqid().".".$ext;
	$uploaded = move_uploaded_file($_FILES["file"]["tmp_name"], $targetDirectory.$file_name);	
	$_POST["file"]=$file_name;
	$mimes = array('text/csv');
	if(in_array($_FILES['file']['type'],$mimes)) {
		if($_FILES["file"]["size"] > 0) {
			$file = fopen($targetDirectory.$file_name,"r");
			fgetcsv($file);
			$row=0;
			while (($getData = fgetcsv($file, 1000, ",")) !== FALSE) {
				if (filter_var($getData[2], FILTER_VALIDATE_EMAIL)) {
					$row++;
					$data[$row]["firstname"] = $getData[0];
					$data[$row]["lastname"] = $getData[1];
					$data[$row]["email"] = $getData[2];
					$data[$row]["mobile"] = $getData[3];
					$data[$row]["website"] = $getData[4];
					array_push($valid_email,$getData[2]);
				} 
				else {
					array_push($invalid_email,$getData[2]);
				}
		       }
		       if(($row>0) &&(!empty($valid_email))) {
		       	$id_list=$listobj->insert($_POST);
		       	for($i=1;$i<=$row;$i++){
		       		$row_data["firstname"]=$data[$i]["firstname"];
		       		$row_data["lastname"]=$data[$i]["lastname"];
		       		$row_data["email"]=$data[$i]["email"];
		       		$row_data["mobile"]=$data[$i]["mobile"];
		       		$row_data["website"]=$data[$i]["website"];
		       		$row_data["id"]=$id_list;
		       		$insert_to_file=$fileobj->insert($row_data);
		       		$listofdata=$listobj->select();
		       	}
		       }
		       else
		       {
		       	?>
		       	<script type="text/javascript">
		       		alert("File contents are not valid");
		       		window.location.href = "csvupload.php";
		       	</script>
		       	<?php
		       }
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
	<style>
		table, th, td {
			border: 1px solid black;
  			border-collapse: collapse;
  			padding: 15px;
		}
	</style>
	<title>Listing Emails</title>
</head>
<body>
	<h1 align="center"> LIST OF UPLOADED FILES </h1>
	<table border=1 align="center">
		<tr>
			<th colspan=2>ID</th>
			<th colspan=2>NAME</th>
			<th colspan=2>DESCRIPTION</th>
			<th colspan=2>FILE</th>
			<th colspan=2>VIEW</th>
		</tr>
		<?php
		foreach ($listofdata as $key => $value) {
			echo "<tr>";
			$id=$value['id'];
			echo '<td colspan=2>'.$id.'</td>';
			echo "<td colspan=2>".$value['name']."</td>";
			echo "<td colspan=2>".$value['description']."</td>";
			echo "<td colspan=2>".$value['file']."</td>";
			echo $str = '<td colspan=2> <a href="list.php?list='.$id.'"> VIEW-LIST </a></td> ';
			echo "</tr>";
		}
		?>
	</table>
</body>
</html>
