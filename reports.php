<?php
session_start();
include "connect.php";
if ($_SESSION['usertype']!='user') {
	header("location:./logout.php");
	exit();
}
$error = "";
if(@$_GET['act'] == 'back' && is_numeric($_GET['id'])){
	mysql_query("UPDATE droped SET status=0, user_id='{$_SESSION['user_id']}' WHERE droped_id='{$_GET['id']}'");
	$error = "<span class=success>Student is back to School !!!</span>";
}
if(@$_GET['act']=='drop' && is_numeric($_GET['id'])) {
	//var_dump($_GET);
	//var_dump($_SESSION);
	//check if the student allready left school
	$check = mysql_query("SELECT * FROM droped WHERE student_id='{$_GET['id']}' && `date` = '".(date("Y-m-d",time()))."' ");

	if($r = mysql_fetch_assoc($check)){
		mysql_query("UPDATE droped SET`date`='".(date("Y-m-d",time()))."', status=1, user_id='{$_SESSION['user_id']}' WHERE droped_id='{$r['droped_id']}'");
		$error = "<span class=success>Student Left the School Again !!!</span>";
	} else{
		mysql_query("INSERT INTO droped SET student_id='{$_GET['id']}', `date`=NOW(), status=1, user_id='{$_SESSION['user_id']}'");
		$error = "<span class=success>Student left the school !!!</span>";
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
<div id="wrapper">

	<div id="banner">
		<img src="Images/banno.png"width="100%"height="100%"style="border-radius:10px 10px 0px 0px;">
	</div>

	<!---------------- menu ------------------>
	<div id="menu">
		<ul>
			<li><a href="2.php">Home</a></li>
			<li><a href="registration.php">Registration</a></li>
			<li><a href="view.php">View students</a></li>
			<li><a href="reports.php"class="active">Reports</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>
	</div>
	<div id="body">
		Dropped Students List
		<hr>
		<center>
			<?php echo $error; ?>
			<table border="1"style="color:white; border-collapse:collapse;">
				<tr id="header">
					<td>Id</td>
					<td>Name</td>
					<td>Surname</td>
					<td>Father</td>
					<td>Mother</td>
					<td>Village</td>
					<td>Cell</td>
					<td>Sector</td>
					<td>District</td>
					<td>Date</td>
					<td>Operation</td>
				</tr>
				<?php

				$sq=mysql_query($s = "SELECT droped.*,students.*,villages.villagename,cells.cellname,sector.sector_name,districts.district_name 
								FROM droped, students, villages, cells,sector,districts, classes, depts, schools WHERE 
								droped.student_id=students.student_id && 
								students.village_id=villages.village_id && 
								villages.cell_id=cells.cell_id && 
								cells.sector_id=sector.sector_id && 
								students.class_id = classes.class_id &&
								classes.dept_id = depts.dept_id &&
								depts.school_id = schools.school_id &&
								schools.user_id = '{$_SESSION['user_id']}' &&
								droped.status = 1 &&
								sector.district_id=districts.district_id")or die(mysql_error());
				while($row=mysql_fetch_assoc($sq)){
				//echo $s;
				?>
				<tr>
					<td><?php echo $row['droped_id'];?></td>
					<td><?php echo $row['Fname'];?></td>
					<td><?php echo $row['Lname'];?></td>
					<td><?php echo $row['Father'];?></td>
					<td><?php echo $row['Mother'];?></td>
					<td><?php echo $row['villagename'];?></td>
					<td><?php echo $row['cellname'];?></td>
					<td><?php echo $row['sector_name'];?></td>
					<td><?php echo $row['district_name'];?></td>
					<td><?php echo $row['date'];?></td>
					<td><a onclick='return confirm("<?php echo $row['Fname']." ".$row['Lname'] ?> is backing to school?")' href="./reports.php?act=back&id=<?php echo $row['droped_id'] ?>">Back</a></td>
				</tr>
					<?php
				}
				?>
			</table>
			<a href='print_2.php' target="_blank">Print</a>
		</center>
	</div>

	<div id="footer">Carlos TWIZEYIMANA 2015 &copy All Rights Reserved !!!</div>

</div>
</body>
</html>