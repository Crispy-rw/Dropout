<?php
session_start();
include"connect.php";
$print="";
//if(@$_GET['act']='change' && is_numeric($_GET['id'])){
$id=@$_GET['id'];
	if(isset($_POST['change'])){
		$np=$_POST['np'];
		$cp=$_POST['cp'];
		if(empty($np)||empty($cp)){
		$print="You have to fill all fields !!!";
		}else{
			if($np==$cp){

			}else{
				$print="Your password doesn't match !!!";
			}
		mysql_query("UPDATE users SET Password='$np' WHERE user_id='$id'")or die(mysql_error());
		$print="Password has been changed !!!";
	}
}
?>
<html>
<head>
	<title>Online School Dropout Reporting System</title>
	<link rel="stylesheet" type="text/css" href="css/file.css">
	<link rel="icon"href="Images/logo2.jpeg">
</head>
<body>
	<form method="POST">
		<table style="color:white;">
			<tr>
				<td>New password:</td>
				<td><input type="password"name="np"></td>
			</tr>
			<tr>
				<td>Confirm password:</td>
				<td><input type="password"name="cp"></td>
			</tr>
			<tr>
				<td colspan="2">
					<center>
						<input type="submit"value="Save Change"name="change"><br>
						<?php echo $print;?>
					</center>
				</td>
			</tr>
		</table>
	</form>
	<center>
	<a onclick="window.close('Change.php')">Exit</a>
	</center>
</body>
</html>