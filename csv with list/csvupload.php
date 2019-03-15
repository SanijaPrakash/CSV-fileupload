<?php
?>
<!DOCTYPE html>
<html>
<head>
  	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
	<title>List upload</title>
	<style>
	.btnsubmit,.btncontact{
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
	label{
		color: red;
	}
	</style>
</head>
<body>
	<h1 align="center"> CSV FILE UPLOAD</h1><br><br>
	<form name="form" method="post" action="read.php" enctype="multipart/form-data">
		<table align="center" cellspacing="10">
			<tr>
				<td colspan="3"> NAME       : </td>
				<td colspan="3"> <input type="text" id="name" placeholder="Your Name" name="name" required minlength="3" maxlength="20"> </td>
				<td colspan="3"> <label id="nameerr"></label></td>
			</tr>
			<tr>
				<td colspan="3"> DESCRIPTION : </td>
				<td colspan="3"> <textarea name="description" id="description" placeholder="Description" rows="5" cols="20" maxlength="140"></textarea> </td>
			</tr>
			<tr>
				<td colspan="3"> UPLOAD YOUR CSV FILE : </td>
				<td colspan="3"> <input type="file" id="file" name="file" required> </td>
				<td colspan="3"> <label id="fileerr"></label></td>
			</tr>
		</table>
		<center><input type="submit" id="btnsubmit" class="btnsubmit" name="btnsubmit" value="SUBMIT">&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" id="btncontact" class="btncontact" name="btncontact" value="VIEW CONTACT" disabled></center>
	</form>
</body>
<script type="text/javascript">
	$(document).ready(function() {
		$('#btnsubmit').click(function(e){
			// e.preventDefault();
			var name = $("#name").val();
			var file = $("#file").val();
			var nameerr;
			var fileerr;
			$.ajax({
				type: "POST",
	            url: "read.php",
	            dataType: "json",
	            data: {name:name,file:file},
            	success : function(data){
            		if(data.status==0){
            			$.each(data.error, function( index, value ) {
            				if(index=='name'){
            					nameerr=value;
            				}
            				if(index=='file'){
            					fileerr=value;
            				}	          				
						});
            			$('#nameerr').html(nameerr);
            			$('#fileerr').html(fileerr);
            		}
            		else {
            			  // $(this).unbind('#btnsubmit').submit();
            			  // $("#btnsubmit").unbind('click').click();
            		}
            	}
        	});
      	});
  	});
</script>
</html>



















