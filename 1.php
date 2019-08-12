<?php
session_start();
//var_dump($_SESSION);
if(@$_SESSION['usertype'] != 'administrator'){
	header("location:./logout.php");
	exit();
}
include "connect.php";
$print="";
$data=null;
if (isset($_POST['user'])) {
	$Name=mysql_real_escape_string($_POST['nm']);
	$Username=$_POST['uname'];
	$p1=$_POST['pass1'];
	$p2=$_POST['pass2'];
	$Telephone=$_POST['tel'];
	$Identity=$_POST['idcard'];
	if(empty($Name)||empty($Username)||empty($p1)||empty($p2)||empty($Telephone)||empty($Identity))
		$print="You have to fill all fields !!!";
	else if(!preg_match("/^07[2,3,8]{1}[0-9]{7}$/", $Telephone))
		$print="Invalid telephone number !!!";
	else{
		if($p1==$p2){

		}else{
			$print="Your password doesn't match !!!";
		}
	mysql_query("INSERT INTO users SET
		Username='$Username',
		Password='$p1',
		Names='$Name',
		Telephone='$Telephone',
		identity_no='$Identity',
		Usertype='user'
		")or die(mysql_error());
	$id=mysql_insert_id();
	mysql_query("Update schools set user_id=$id where school_id={$_POST['sec']}");
	$print="New user inseted!!!";
	}
}
if(@$_GET['act']=='delete'&& is_numeric($_GET['id'])){
	mysql_query("DELETE FROM users WHERE user_id='{$_GET['id']}'");
}


if (isset($_POST['update'])) {
	$Name=$_POST['nm'];
	$Username=$_POST['uname'];
	$p1=$_POST['pass1'];
	$p2=$_POST['pass2'];
	$Telephone=$_POST['tel'];
	$Identity=$_POST['idcard'];
	if(empty($Name)||empty($Username)||empty($p1)||empty($p2)||empty($Telephone)||empty($Identity))
		$print="You have to fill all fields !!!";
	else if(!preg_match("/^07[2,3,8]{1}[0-9]{7}$/", $Telephone))
		$print="Invalid telephone number !!!";
	else{
		if($p1==$p2){

		}else{
			$print="Your password doesn't match !!!";
		}
		mysql_query("UPDATE users SET
		Username='$Username',
		Password='$p1',
		Names='$Name',
		Telephone='$Telephone',
		identity_no='$Identity',
		Usertype='user' WHERE user_id='{$_GET['id']}'
		")or die(mysql_error());
		$print="User updated !!!";
		unset($_GET);
	}
}
if(@$_GET['act']=='update' && is_numeric($_GET['id'])){
	$rs=mysql_query("SELECT users.*, schools.school_id FROM users,schools WHERE users.user_id='{$_GET['id']}' && users.user_id=schools.user_id")or die(mysql_error());
	$data=mysql_fetch_assoc($rs);
}
?>
<html>
<head>
	<title>Online School Dropout Reporting System</title>
	<link rel="stylesheet" type="text/css" href="css/file.css">
	<link rel="icon"href="Images/logo2.jpeg">
</head>
<body>
<div id="wrapper">

	<div id="banner">
		<img src="Images/banno.png"width="100%"height="100%"style="border-radius:10px 10px 0px 0px;">
	</div>

	<!----------------menu------------------>
	<div id="menu">
		<ul>
			<li><a href="1.php"class="active">Home</a></li>
			<li><a href="schools.php">Schools</a></li><!--
			<li><a href="cells.php">Cells</a></li>-->
			<li><a href="comments.php">Comments</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>
	</div>
	<div id="body">
		Welcome <font style="text-decoration:none;color:chocolate;"><?php echo $_SESSION['username'];?> </font>| Register System Users
		<hr>
		<a onclick="window.open('Change.php?id=<?php echo $_SESSION['user_id'];?>', 'newwindow', 'width=350, height=200'); return false;">Change Password</a>
		<div>
			<form method="POST"action="">
				<?php  echo $data != null?"<input type=hidden name=id value='{$_GET['id']}'/>":""?>
				<table style="color:white;">
					<tr><td>School:</td>
						<?php
						$query=mysql_query("select schools.school_name, schools.school_id from schools,users where schools.user_id=users.user_id")or die(mysql_error());
						?>
						<td>
							<select name="sec">
								
									<?php 
									while($sc=mysql_fetch_assoc($query)){
									#var_dump($sc);
									echo "<option value='{$sc['school_id']}' ".($data['school_id'] == $sc['school_id'] || $sc['school_id'] == $_GET['school']?"selected":"").">".$sc['school_name']."</option>";
									}
									?>
							</select>
						</td>
					</tr>
					<tr><td>Names:</td><td><input type="text"name="nm"value='<?php echo $data['Names'];?>'></td></tr>
					<tr><td>Phone no:</td><td><input type="text"maxlength="10" onkeypress="return disablenum(event)"name="tel"value='<?php echo $data['Telephone'];?>'></td></tr>
					<tr><td>Identity no:</td><td><input type="text"maxlength="16" onkeypress="return disablenum(event)" name="idcard"value='<?php echo $data['identity_no'];?>'></td></tr>
					<tr><td>Username:</td><td><input type="text"name="uname"value='<?php echo $data['Username'];?>'></td></tr>
					<tr><td>Password:</td><td><input type="password"name="pass1"></td></tr>
					<tr><td>Re-Type:</td><td><input type="password"name="pass2"></td></tr>
					<tr><td colspan="2"><center><input type="submit"name='<?php echo $data==null?'user':'update'?>'value='<?php echo $data?"Update user":"Save User";?>'><br>
						<?php echo $print ?></center></td></tr>

				</table>
			</form>
		</div>
			<!----------------------list of registered schools------------------------>
			<center>
			<table border="1"style="color:white; border-collapse:collapse;">
				<tr id="header">
					<td>Id</td>
					<td>Names</td>
					<td>Phone</td>
					<td>Username</td>
					<td>School</td>
					<td colspan="2">Operation</td>
				</tr>
				<?php
				$sql=mysql_query("select users.*,schools.school_name from users,schools where users.user_id=schools.user_id")or die(mysql_error());
				while($result=mysql_fetch_assoc($sql)){
					if($result['Usertype'] == 'administrator')
						continue;
				#var_dump($result);
				?>
				<tr>
					<td><?php echo $result['user_id'];?></td>
					<td><?php echo $result['Names'];?></td>
					<td><?php echo $result['Telephone'];?></td>
					<td><?php echo $result['Username'];?></td>
					<td><?php echo $result['school_name'];?></td>
					<td><a onclick='if(confirm("Do you really want to delete <?php echo $result['Names'];?>?")){return true} else {return false}' href="1.php?act=delete&id=<?php echo $result['user_id'];?>">Delete</a></td>
					<td><a href="./1.php?act=update&id=<?php echo $result['user_id']?>">Update</a></td>
				</tr>
				<?php
				}
				?>
			</table>
		</center>
	</div>

	<div id="footer">Carlos TWIZEYIMANA 2015 &copy All Rights Reserved !!!</div>

</div>
</body>
</html>
<!--javascript which is going to ensure that no character will going to be entered in textbox we need to receive integers from-->
<script type="text/javascript">
	function disablenum (evt){
		var charcode=(evt.which)?evt.which:event.keycode;
		if (charcode>38 && (charcode<48 || charcode>57)) {
        return false;

		}
		return true;

	}
</script>