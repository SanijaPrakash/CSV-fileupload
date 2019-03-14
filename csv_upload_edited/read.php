<?php

include_once "ListData.php";
include_once "FileContents.php";
$fileobj = new FileContents();
$listobj = new ListData();
if(isset($_POST["btnsubmit"])) {

	if ((empty($_FILES['file']['name']))||(strlen($_POST['name'])<5)) {
		?>
		<script type="text/javascript">
			alert(" Some feilds are Empty.Refill the form ");
	        window.location.href = "csvupload.php";
	    </script>
	    <?php
	}
	else {
		$targetDirectory = "uploads/";
		$path = $_FILES['file']['name'];
		$ext = pathinfo($path, PATHINFO_EXTENSION);
		$file_name=uniqid().".".$ext;
		$uploaded = move_uploaded_file($_FILES["file"]["tmp_name"], $targetDirectory.$file_name);	
		$_POST["file"]=$file_name;
		$data=array();
		$valid_email=array();
		$invalid_email=array();
		$mimes = array('text/csv');
		if(in_array($_FILES['file']['type'],$mimes)) {
			if($_FILES["file"]["size"] > 0) {
				$file = fopen($targetDirectory.$file_name,"r");
				fgetcsv($file);
				$row=0;
				while (($getData = fgetcsv($file, 1000, ",")) !== FALSE) {
					$row++;
					if (filter_var($getData[2], FILTER_VALIDATE_EMAIL)) {
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
		        	//insert to db
		        	$id_list=$listobj->insert($_POST);
		        	for($i=1;$i<=$row;$i++){
		        		$row_data["firstname"]=$data[$i]["firstname"];
		        		$row_data["lastname"]=$data[$i]["lastname"];
		        		$row_data["email"]=$data[$i]["email"];
		        		$row_data["mobile"]=$data[$i]["mobile"];
		        		$row_data["website"]=$data[$i]["website"];
		        		$row_data["list_id"]=$id_list;
		        		$insert_to_file=$fileobj->insert($row_data);
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
