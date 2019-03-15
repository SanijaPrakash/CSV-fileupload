<?php

include_once "ContactView.php";
$allcontact=array();
$contactviewobj=new ContactView();
if(isset($_GET["view"])) { 
	$obj_merged=$contactviewobj->mergeObjects();
	$allcontact=$contactviewobj->select_join($obj_merged);
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
  			font-family: Georgia;
		}
		h1 {
			font-family: Georgia;
		}
	</style>
	<title>View all contacts</title>
</head>
<body>
	<h1 align="center" >VIEW ALL CONTACTS </h1>
	<table align="center">
		<tr>
			<th>FIRST NAME</th>
			<th>LAST NAME</th>
			<th>EMAIL</th>
			<th>MOBILE</th>
			<th>WEBSITE</th>
			<th>LIST NAME</th>
		</tr>
		<?php
		foreach ($allcontact as $key => $value) {
			echo "<tr>";
			echo "<td>".$value['firstname']."</td>";
			echo "<td>".$value['lastname']."</td>";
			echo "<td>".$value['email']."</td>";
			echo "<td>".$value['mobile']."</td>";
			echo "<td>".$value['website']."</td>";
			echo "<td>".$value['name']."</td>";
		}
		?>
	</table>
</body>
</html>