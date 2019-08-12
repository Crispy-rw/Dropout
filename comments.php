<?php
session_start();
//var_dump($_SESSION);
if(@$_SESSION['usertype'] != 'administrator'){
	header("location:./logout.php");
	exit();
}
include "connect.php";
if(@$_GET['act']=='delete' && is_numeric($_GET['id'])){
	mysql_query("DELETE FROM comments WHERE Id='{$_GET['id']}'");
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
			<li><a href="schools.php">Schools</a></li><!--
			<li><a href="cells.php">Cells</a></li>-->
			<li><a href="comments.php"class="active">Comments</a></li>
			<li><a href="index.php">Logout</a></li>
		</ul>
	</div>
	<div id="body">
		View comments
		<hr>
		
			<!----------------------select comments------------------------>

			<table border="1"style="color:white; border-collapse:collapse;">
				<tr id="header">
					<td>Id</td>
					<td>Names</td>
					<td>Email</td>
					<td>Message</td>
					<td>Operations</td>
				</tr>
				<?php
				include "connect.php";
				$sql=mysql_query("select *from comments")or die(mysql_error());
				while($row=mysql_fetch_assoc($sql)){
					#var_dump($row);
				?>
				<tr>
					<td><?php echo $row['Id'];?></td>
					<td><?php echo $row['Names'];?></td>
					<td><?php echo $row['Email'];?></td>
					<td><?php echo $row['Message'];?></td>
					<td><a onclick='if(confirm("Do you really want to delete this comment?")){return true} else{return false}' href="./comments.php?act=delete&id=<?php echo $row['Id'];?>">Delete</a></td>
				</tr>
				<?php
				}
				?>
			</table>
	</div>

	<div id="footer">Carlos TWIZEYIMANA 2015 &copy All Rights Reserved !!!</div>    

</div>
</body>
</html>