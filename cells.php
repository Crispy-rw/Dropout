<?php
session_start();
//var_dump($_SESSION);
if(@$_SESSION['usertype'] != 'administrator'){
	header("location:./logout.php");
	exit();
}
$print="";
$dd=null;
include "connect.php";
if(isset($_POST['cell1'])){
	$Names=$_POST['nm'];
	$tel=$_POST['tel'];
	$Identity=$_POST['idcard'];
	$username=$_POST['uname'];
	$p1=$_POST['pass1'];
	$p2=$_POST['pass2'];

	if(empty($Names)or empty($tel)or empty($username)or empty($p1)or empty($p2)){
		$print="You have to fill all fields !!!";
	}else{
		if ($p1==$p2) {
		
			mysql_query("INSERT INTO users values(null,'$username','$p1','$Names','$tel','$Identity','executive')")or die(mysql_error());
			//$id=mysql_insert_id();
			//mysql_query("UPDATE cells SET user_id=$id where cell_id='{$_POST['cell']}'")or die(mysql_error());
			$print="User inserted !!!";
		}else{
			$print="Your password doesn't match !!!";
		}
	}	
}
if(@$_GET['act']=='delete' && is_numeric($_GET['id'])){
	mysql_query("DELETE FROM cells WHERE cell_id='{$_GET['id']}'");
	$i=mysql_insert_id();
	mysql_query("DELETE FROM users WHERE user_id=$i")or die(mysql_error());
}
if(@$_GET['act']=='update' && is_numeric($_GET['id'])){
	//$q=mysql_query("SELECT * FROM users WHERE user_id='{$_GET['id']}'");
	//$dd=mysql_fetch_assoc($q);
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
			<li><a href="1.php">Home</a></li>
			<li><a href="schools.php">Schools</a></li>
			<li><a href="#"class="active">Cells</a></li>
			<li><a href="comments.php">Comments</a></li>
			<li><a href="index.php">Logout</a></li>
		</ul>
	</div>
	<div id="body">
		Cell Settings
		<hr>
		<div>
			<form method="POST"action="">
				<table style="color:white;">
					<tr>
						<td>Cell Name:</td>
						<td>
							<select name="cell">
							<?php
							$query=mysql_query("select cellname,cell_id from cells")or die(mysql_error());
							while($row=mysql_fetch_assoc($query)){
							#var_dump($row);
							echo "<option value='{$row['cell_id']}'>".$row['cellname']."</option>";
							}
							?>
							</select>
						</td>
					</tr>
					<tr><td>Names:</td><td><input type="text"name="nm"value='<?php echo $dd?$dd['Names']:"";?>'></td></tr>
					<tr><td>Phone no:</td><td><input type="text"name="tel"maxlength="10"value='<?php echo $dd?$dd['Telephone']:"";?>'></td></tr>
					<tr><td>Identity no:</td><td><input type="text"maxlength="16"name="idcard"value='<?php echo $dd?$dd['identity_no']:"";?>'></td></tr>
					<tr><td>Username:</td><td><input type="text"name="uname"value='<?php echo $dd?$dd['Username']:"";?>'></td></tr>
					<tr><td>Password:</td><td><input type="password"name="pass1"></td></tr>
					<tr><td>Re-Type:</td><td><input type="password"name="pass2"></td></tr>
					<tr><td colspan="2"><center><input type="submit"name='<?php echo $dd?"upd":"cell1"?>'value='<?php echo $dd?"Update user":"Save User"?>'>
						<br><?php echo $print; ?></center></td></tr>
				</table>
			</form>
		</div>
			<!----------------------list of registered schools------------------------>

			<center>
			<table border="1"style="color:white;">
				<tr id="header">
					<td>Id</td>
					<td>Name</td>
					<td>Executive Secretary</td>
					<td colspan="2">Operation</td>
				</tr>
				<?php
				include "connect.php";
				$query=mysql_query("SELECT cells.*,users.Names FROM cells,users WHERE cells.user_id=users.user_id")or die(mysql_error());
				while($result=mysql_fetch_assoc($query)){
					#var_dump($result);
				?>
				<tr>
					<td><?php echo $result['cell_id'];?></td>
					<td><?php echo $result['cellname'];?></td>
					<td><?php echo $result['Names'];?></td>
					<td><a onclick='return confirm(" Do you really want to delete <?php echo $result['cellname'];?>?")'href="./cells.php?act=delete&id=<?php echo $result['cell_id'];?>">Delete</a></td>
					<td><a href="./cells.php?act=update&id=<?php echo $result['cell_id'];?>">Update</a></td>
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