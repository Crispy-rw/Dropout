<?php
session_start();
include "connect.php";
if ($_SESSION['usertype']!='user') {
	header("location:./logout.php");
	exit();
}
$echo=null;
$print=null;
#var_dump($_SESSION);
if(@$_GET['act']=='delete' && is_numeric($_GET['id'])){
	if(mysql_query("DELETE FROM students where student_id='{$_GET['id']}'")){
		$echo="Student deleted !!!";
	}else{
		$echo="Error while deleting !!!";
	}
}
?>
<!--------------------The start of php of search-------------------------->
<?php
$data_found = null;
if(isset($_POST['search'])){
	$word=$_POST['word'];
	$data=mysql_query("SELECT students.*,classes.*,depts.deptacronym from students,classes,depts WHERE students.Fname || students.Lname like '%$word%' && students.class_id=classes.class_id && classes.dept_id=depts.dept_id && depts.school_id='{$_SESSION['school_id']}'")or die(mysql_error());
	if(mysql_num_rows($data)==1){
		$ro=mysql_fetch_assoc($data);

$data_found = <<<DATA
<center>		
<table border="1"style="color:white; border-collapse:collapse;">
	<tr id="header">
		<td>Id</td>
		<td>Name</td>
		<td>Class</td>
		<td>Parent contact</td>
		<td colspan="3"><center>Operation</center></td>
	</tr>
	<tr>
		<td>{$ro['student_id']}</td>
		<td>{$ro['Fname']} {$ro['Lname']}</td>
DATA;
$data_found .= "<td>".($ro['deptacronym'] == "P"?"P":"S").$ro['year'].' '.($ro['deptacronym'] == "P" || $ro['deptacronym'] == "OLC"?"":$ro['deptacronym'])." ".$ro['letter']."</td>";
$data_found .= <<<DATA
		<td>{$ro['Fathercontact']} / {$ro['Mothercontact']}</td>
		<td><a onclick='if(confirm("Do you really want to delete {$ro['Fname']} {$ro['Lname']}")){return true}else {return false}' href="./view.php?act=delete&id={$ro['student_id']}">Delete</a></td>
		<td><a href="">Update</a></td>
		<td><a href="./view.php?act=drop&id={$ro['student_id']}">Drop out</a></td>
	</tr>
</table>
</center>
DATA;
		
	}else{
		$print="Student not found!!!";
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

	<!----------------menu------------------>
	<div id="menu">
		<ul>
			<li><a href="2.php">Home</a></li>
			<li><a href="registration.php">Registration</a></li>
			<li><a href="view.php"class="active">View students</a></li>
			<li><a href="reports.php">Reports</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>

		<form method="POST"action=""style="float:right;margin-right:2px;margin-top:3px;width:250px;">
		<input type="text"name="word"placeholder="Search..."style="border-radius:8px;">
		<input type="submit"name="search"value="Search"style="cursor:pointer;border-radius:5px;"><br>
		<?php echo "<marquee onmouseover='stop();' onmouseout='start();' scrollamount=2 style='color:white'>".$print."</marquee>";?>
		</form>
	</div>
	<div id="body">
		Students list
		<hr>
			<!----------------------list of registered schools------------------------>
			<?php
			if($data_found != null){
				echo $data_found;
			} else{ ?>
			<center>
			<table border="1"style="color:white; border-collapse:collapse;">
				<tr id="header">
					<td>Id</td>
					<td>Name</td>
					<td>Class</td>
					<td>Parent contact</td>
					<!--<td>Photo</td>-->
					<td colspan="3"><center>Operation</center></td>
				</tr>
				<?php
				$data=mysql_query("select students.*,classes.*,depts.deptacronym from students,classes,depts where students.class_id=classes.class_id && classes.dept_id=depts.dept_id && depts.school_id='{$_SESSION['school_id']}'");
				$students_in_class = array();
				while($row=mysql_fetch_assoc($data))
					$students_in_class[] = $row;
				foreach($students_in_class as $row){
					#var_dump($row);
					//check if the student is droped
					$droped_query = mysql_query("SELECT * FROM droped WHERE student_id='{$row['student_id']}' && status=1 && user_id='{$_SESSION['user_id']}'");
					if(mysql_num_rows($droped_query)>0)
						continue;
				?>
				<tr>
					<td><?php echo $row['student_id'];?></td>
					<td><?php echo $row['Fname'].' '.$row['Lname'];?></td>
					<td><?php echo 'S'.$row['year'].' '.$row['deptacronym'];?></td>
					<td><?php echo $row['Fathercontact'].' / '.$row['Mothercontact'];?></td>
					<!--<td><img src="./Profile/<?php echo $row['photo'];?>"height="20"width="20"></td>-->
					<td><a onclick='if(confirm("Do you really want to delete <?php echo $row['Fname'].' '.$row['Lname'];?>?")){return true}else {return false}' href="./view.php?act=delete&id=<?php echo $row['student_id']?>">Delete</a></td>
					<td><a href="./registration.php?act=update&id=<?php echo $row['student_id'];?>">Update</a></td>
					<td><a onclick='return confirm("Do you really want to drop this students?")'href="./reports.php?act=drop&id=<?php echo $row['student_id']?>">Drop out</a></td>
				</tr>
				<?php
				}
				?>
			</table>
			</center>
			<?php } ?>
	</div>

	<div id="footer">Carlos TWIZEYIMANA 2015 &copy All Rights Reserved !!!</div>

</div>
</body>
</html>