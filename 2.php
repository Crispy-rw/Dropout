<?php
session_start();
include "connect.php";
if ($_SESSION['usertype']!='user') {
	header("location:./logout.php");
	exit();
}
$echo=null;
$ecla=null;
$tbc=null;
		$sql=mysql_query($s = "select school_id from schools where user_id='{$_SESSION['user_id']}'")or die(mysql_error());
		//echo $s;
		if(mysql_num_rows($sql) == 1){
		while($row=mysql_fetch_assoc($sql)){
		// var_dump($row);
		$_SESSION['school_id']=$row['school_id'];
		}
	} else{
		echo "<script>alert('No School Information Found'); window.location='./logout.php'</script>";
	}
if(isset($_POST['department'])){
	$comb=$_POST['comb'];
	$acro=$_POST['acro'];
	if(empty($comb)or empty($acro)){
		$echo="You have to fill all fields !!!";
	}else{
		$sql1=mysql_query("select *from depts where deptname='$comb'&& school_id='{$_SESSION['school_id']}'");
		if(mysql_num_rows($sql1)==0){
		if(mysql_query("INSERT INTO depts values(null,'$comb','$acro','{$_SESSION['school_id']}')")){
			$echo="New Department inserted !!!";
		}
		}else{
			$echo="Department is already exists !!!";
		}
	}
}
if(isset($_POST['update'])){
	$comb=$_POST['comb'];
	$acro=$_POST['acro'];
	$id=$_POST['id'];
	if(empty($comb)or empty($acro)){
		$echo="You have to fill all fields !!!";
	}else{
		$sql1=mysql_query("select * from depts where deptname='$comb' && school_id='{$_SESSION['school_id']}' && dept_id != '{$id}'");
		if(mysql_num_rows($sql1)==0){
			if(mysql_query("UPDATE depts SET deptname='$comb',deptacronym='$acro' WHERE dept_id='{$id}'") or die(mysql_error())){
				$echo="Department Updated !!!";
				unset($_GET);
			}
		}else{
			$echo="Department is already exists !!!";
		}
	}
}
if(isset($_POST['class'])){
	$depart=$_POST['departments'];
	$year=$_POST['year'];
	$letter=strtoupper($_POST['letter']);
	//var_dump($_POST); die;
	if(empty($depart)or empty($year)){
		$ecla="You to fill all fields !!!";
	}else{
		$cla=mysql_query("select * from classes where year=$year && letter='$letter' && dept_id={$depart}")or die(mysql_error());
		if(mysql_num_rows($cla) != 0){
			$ecla="This class is already exists !!!";
		}else{
			//seacrh dept for comparison
			$dept_query = mysql_query("SELECT * FROM depts WHERE dept_id ='{$depart}'");
			$dept_info = mysql_fetch_assoc($dept_query);
			if($dept_info['deptacronym'] == "OLC"  && $year >3){
				$ecla="Invalid Class Level!!!";
			}
			else if($dept_info['deptacronym'] != "P"  && $year <4){
				$ecla="Invalid Class Level!!!";
			} else{
				mysql_query("INSERT INTO classes values(null,'$year','$letter','{$depart}')");
				$ecla="New class inserted !!!";
			}
		}
	}
}
#var_dump($_SESSION);
//The start of deleting and updating part
if(@$_GET['act']=='delete' && is_numeric($_GET['id'])){
	if(mysql_query("DELETE FROM depts where dept_id='{$_GET['id']}'")){
		$echo="Department deleted !!!";
	}else{
		$echo="Error while deleting !!!";
	}
}
//The start of deleting and updating part
if(@$_GET['act']=='delete_class' && is_numeric($_GET['id'])){
	if(mysql_query("DELETE FROM classes where class_id='{$_GET['id']}'")){
		$tbc="Class deleted !!!";
	}else{
		$tbc="Error while deleting !!!";
	}
}
//The start of updating and updating part
$data_to_update = null;
if(@$_GET['act']=='update' && is_numeric($_GET['id'])){
	$sql = mysql_query("SELECT * FROM depts WHERE dept_id='{$_GET['id']}'");
	$data_to_update = mysql_fetch_assoc($sql);
}
//var_dump($_SESSION);
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
			<li><a href="2.php"class="active">Home</a></li>
			<li><a href="registration.php">Registration</a></li>
			<li><a href="view.php">View students</a></li>
			<li><a href="reports.php">Reports</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>
	</div>
	<div id="body">
		Welcome <font style="text-decoration:none;color:chocolate;"><?php echo $_SESSION['username'];?> </font>|Classes and Departments
		<?php
		$data=mysql_query("SELECT schools.school_name FROM schools,users WHERE schools.user_id={$_SESSION['user_id']}");
		$ro=mysql_fetch_assoc($data);
		echo "<b style='float:right;color:black;'>".$ro['school_name']."</b>";
		?>
		<hr>
		<a onclick="window.open('Change.php?id=<?php echo $_SESSION['user_id'];?>', 'newwindow', 'width=350, height=200'); return false;">Change Password</a>
		<div>
			<fieldset style='width:300px'>
			<legend>Combination</legend>
			<form method="POST"action="">
				<?php  echo $data_to_update != null?"<input type=hidden name=id value='".$data_to_update['dept_id']."'/>":""?>
				<table style="color:white;">
					<tr><td>Combination:</td><td><input type="text"name="comb" value='<?php echo $data_to_update != null?$data_to_update['deptname']:"" ?>'></td></tr>
					<tr><td>Acronym:</td><td><input type="text"name="acro" value='<?php echo $data_to_update != null?$data_to_update['deptacronym']:"" ?>'></td></tr>
					<tr><td colspan="2"><center><input type="submit"name="<?php  echo $data_to_update == null?"department":"update" ?>" value="<?php  echo $data_to_update != null?"Save Updates":"Save Data" ?>"><br>
						<?php echo $echo?>
					</center></td></tr>
				</table>
			</form>
			</fieldset>
		</div>
			<!------------------end of department part------------------------>
		<div id="classes">
			<fieldset>
			<legend>Classes</legend>
			<form method="POST"action="2.php">
				<table style="color:white;">
					<tr>
						<td>Department:</td>
						<td>
							<select name="departments">
								<?php
								$dept=mysql_query("select * from depts where school_id='{$_SESSION['school_id']}'");
								while($res=mysql_fetch_assoc($dept)){
									echo "<option value='{$res['dept_id']}'>".$res['deptacronym']."</option>";
									$_SESSION['dept_id']=$res['dept_id'];
								}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td>Year(Ex.4):</td>
						<td>
							<select name="year">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
							</select>
						</td>
					</tr>
					<tr><td>Letter(Ex.B):</td><td><input type="text"name="letter"></td></tr>
					<tr><td colspan="2"><center><input type="submit"name="class"value="Save"><br>
						<?php echo $ecla?></center></td></tr>
				</table>
			</form>
			</fieldset>
		</div>
			<!----------------------list of registered schools------------------------>
			<br><br>
			<?php echo $tbc;?>
			<table border="1"style="color:white; border-collapse:collapse;">
				<tr id="header">
					<td>Id</td>
					<td>Combination</td>
					<td>Acronym</td>
					<td>Class</td>
					<td colspan="2">Operation</td>
				</tr>
				<?php
				$data=mysql_query("SELECT * FROM depts where school_id IN (select school_id from schools where user_id='{$_SESSION['user_id']}')")or die(mysql_error());
				$depts = array();
				while($result=mysql_fetch_assoc($data))
					$depts[] = $result;
				foreach($depts as $result){
					//var_dump($result);
				?>
				<tr>
					<td><?php echo $result['dept_id'];?></td>
					<td><?php echo $result['deptname'];?></td>
					<td><?php echo $result['deptacronym'];?></td>
					<td>
						<?php
						//select all classes inm the dept
						$c_query = mysql_query("SELECT * FROM classes WHERE dept_id='{$result['dept_id']}'");
						while($r = mysql_fetch_assoc($c_query)){
							echo ($result['deptacronym'] == "P"?"P":"S").$r['year'] ." ".($result['deptacronym'] == "OLC" || $result['deptacronym'] == "P"?"":$result['deptacronym'])." ".$r['letter']." <sup><a onclick='return confirm(\"Do you want to delete this class?\");' href='./2.php?act=delete_class&id={$r['class_id']}'>X</a></sup> | ";
						}
						?>
					</td>
					<td><a onclick='if(confirm("Do you really want to delete <?php echo $result['deptacronym']?>?")){return true}else {return false}' href="./2.php?act=delete&id=<?php echo $result['dept_id']?>">Delete</a></td>
					<td><a href="2.php?act=update&id=<?php echo $result['dept_id'];?>">Update</a></td>
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