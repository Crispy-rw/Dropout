<?php
session_start();
include "connect.php";
if ($_SESSION['usertype']!='executive') {
	header("location:./logout.php");
	exit();
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
			<li><a href="#"class="active">Reports</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>
	</div>
	<div id="body">
		Welcome <font style="text-decoration:none;color:chocolate;"><?php echo $_SESSION['username'];?> </font>| Dropped Students List
		<hr>
		<center>
			<table border="1"style="color:white;">
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
				$sq=mysql_query("SELECT droped.*,students.*,villages.villagename,cells.cellname,sector.sector_name,districts.district_name FROM droped,students,villages,cells,sector,districts WHERE droped.student_id=students.student_id && students.village_id=villages.village_id && villages.cell_id=cells.cell_id && cells.sector_id=sector.sector_id && sector.district_id=districts.district_id")or die(mysql_error());
				$row=mysql_fetch_assoc($sq);
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
					<td><a href="">Back</a></td>
				</tr>
			</table>
		</center>
	</div>

	<div id="footer">Carlos TWIZEYIMANA 2015 &copy All Rights Reserved !!!</div>

</div>
</body>
</html>