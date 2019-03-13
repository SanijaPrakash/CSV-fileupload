<?php
?>
<!DOCTYPE html>
<html>
<head>
	<title>List upload</title>
	<style>
	.btnbutton{
		background-color: #000000;
		color: white;
		padding: 10px 32px;
		text-align: center;
		margin: 4px 2px;
		font-size: 18px;
	}
		
	input,textarea{
		font-size: 14px;
	}
	</style>
</head>
<body>
	<form name="form" id="form" method="post" action="read.php" enctype="multipart/form-data">
		<table cellpadding="10" align="center">
			<tr>
				<td colspan="3"> NAME       : </td>
				<td colspan="3"> <input type="text" name="name" required minlength="5" maxlength="20"> </td>
			</tr>
			<tr>
				<td colspan="3"> DESCRIPTION: </td>
				<td colspan="3"> <textarea name="description" rows="5" cols="20" maxlength="140"></textarea> </td>
			</tr>
			<tr>
				<td colspan="3"> Upload your CSV file  </td>
				<td colspan="3"> <input type="file" name="file" required> </td>
			</tr>
			<tr>
				<td colspan="3"> <input type="submit" name="btnsubmit" value="SUBMIT"></td>
			</tr>
		</table>
	</form>
</body>
</html>