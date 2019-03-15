<?php
include_once "ListData.php";
include_once "FileContents.php";

$fileobj = new FileContents();
$listobj = new ListData();
if(isset($_GET['list'])){
	$listid=$_GET['list'];
	$list_data=$listobj->select($listid);
	if(!empty($list_data))
	{
		$list_data=$list_data[0];
	}
	$list_contents= $fileobj->select($listid,10,true);
	//print_r($list_contents);
   // die();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>CONTACT DETAILS</title>
</head>
<body>
<h1 align="center">CONTACT DETAILS</h1><br><br>

LIST NAME   :<b> <?php echo $list_data['name']; ?></b>&nbsp;&nbsp;&nbsp;
DESCRIPTION :<b> <?php echo $list_data['description']; ?></b>&nbsp;&nbsp;&nbsp;
FILE NAME   :<b> <?php echo $list_data['file']; ?></b><br><br>
<table align="center" cellspacing="10" border="1">
	<tr>
		<th colspan=2>ID</th>
		<th colspan=2>FIRSTNAME</th>
		<th colspan=2>LASTNAME</th>
		<th colspan=2>EMAIL</th>
		<th colspan=2>MOBILE</th>
		<th colspan=2>WEBSITE</th>
		<th colspan=2>LIST_ID</th>
	</tr>
	<?php
		foreach ($list_contents as $key => $value) {
			echo "<tr>";
			echo "<td colspan=2>".$value['fileid']."</td>";
			echo "<td colspan=2>".$value['firstname']."</td>";
			echo "<td colspan=2>".$value['lastname']."</td>";
			echo "<td colspan=2>".$value['email']."</td>";
			echo "<td colspan=2>".$value['mobile']."</td>";
			echo "<td colspan=2>".$value['website']."</td>";
			echo "<td colspan=2>".$value['id']."</td>";
			echo "</tr>";
		}
		?>

</table>
</body>
</html>