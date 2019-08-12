<?php
session_start();
#var_dump($_SESSION);
if(@$_SESSION['usertype'] != 'administrator'){
	header("location:./logout.php");
	exit();
}
include "connect.php";
$error = "";

if(@$_GET['act'] == 'delete' && is_numeric($_GET['id'])){
	//delete data in the school table
	$o=mysql_query("SELECT user_id FROM schools WHERE school_id='{$_GET['id']}'");
	$i=mysql_fetch_assoc($o);
	mysql_query("DELETE FROM users WHERE user_id='{$i['user_id']}'");
	if(mysql_query("DELETE FROM schools WHERE school_id='".$_GET['id']."'")){
		$error = "School deleted !!!";
	} else{
		$error = "Error while deleting the school !!!";
	}
}
$update = null;
if(@$_GET['act'] == 'update' && is_numeric($_GET['id'])){
	//select school information form database
	$q = mysql_query("SELECT * FROM schools WHERE school_id='{$_GET['id']}'");
	$update = mysql_fetch_assoc($q);

}
//save the school information
#var_dump($_POST);
if(@$_POST['save_school']){
	//check the village information
	#var_dump($_POST);
	if(!empty($_POST['sec'])){
		
		if(!isset($_POST['cell_id']) || !is_numeric($_POST['cell_id'])){
			//save the cell identification
			$villageid = null;
			$check = mysql_query("SELECT * FROM cells WHERE cellname='".mysql_real_escape_string(trim($_POST['cellname']))."'");
			if(mysql_num_rows($check) == 0){
				mysql_query("INSERT INTO cells SET cellname='".mysql_real_escape_string(trim($_POST['cellname']))."' , sector_id=1");
				$villageid = mysql_insert_id();
			} else{
				$c = mysql_fetch_assoc($check);
				$villageid = $c['cell_id'];
			}
			
			$check = mysql_query("SELECT * FROM villages WHERE villagename='".mysql_real_escape_string(trim($_POST['villageid']))."' && cell_id='{$villageid}'");
			if(mysql_num_rows($check) == 0){
				mysql_query("INSERT INTO villages SET villagename='".mysql_real_escape_string(trim($_POST['villageid']))."' , cell_id='{$villageid}'");
				$_POST['cell_id'] = mysql_insert_id();
			} else{
				$v = mysql_fetch_assoc($check);
				$_POST['cell_id'] = $v['village_id'];
			}
		}
		if(is_numeric($_POST['cell_id'])){
			//save the school information
			$check = mysql_query("SELECT * FROM schools WHERE school_name='".mysql_real_escape_string(trim($_POST['sec']))."' && Village_id='{$_POST['cell_id']}'");
			if(mysql_num_rows($check) == 0){
				if(mysql_query("INSERT INTO schools SET school_name='".mysql_real_escape_string(trim($_POST['sec']))."', Village_id='{$_POST['cell_id']}', user_id=1") or die(mysql_error())){
					$error = "<br />School Successfully Registered!";
					unset($_POST);
				} else
					$error = "<br />Error While Saving School";
			} else{
				$error = "<br />School Name Already Exists";
			}
		}
	} else{
		$error = "<br />Empty School Name!";
	}
}

//update

if(@$_POST['update_school']){
	//check the village information
	#var_dump($_POST);
	if(!empty($_POST['sec'])){
		
		if(!isset($_POST['cell_id']) || !is_numeric($_POST['cell_id'])){
			//save the cell identification
			$villageid = null;
			$check = mysql_query("SELECT * FROM cells WHERE cellname='".mysql_real_escape_string(trim($_POST['cellname']))."'");
			if(mysql_num_rows($check) == 0){
				mysql_query("INSERT INTO cells SET cellname='".mysql_real_escape_string(trim($_POST['cellname']))."' , sector_id=1");
				$villageid = mysql_insert_id();
			} else{
				$c = mysql_fetch_assoc($check);
				$villageid = $c['cell_id'];
			}
			
			$check = mysql_query("SELECT * FROM villages WHERE villagename='".mysql_real_escape_string(trim($_POST['villageid']))."' && cell_id='{$villageid}'");
			if(mysql_num_rows($check) == 0){
				mysql_query("INSERT INTO villages SET villagename='".mysql_real_escape_string(trim($_POST['villageid']))."' , cell_id='{$villageid}'");
				$_POST['cell_id'] = mysql_insert_id();
			} else{
				$v = mysql_fetch_assoc($check);
				$_POST['cell_id'] = $v['village_id'];
			}
		}

		if(is_numeric($_POST['cell_id'])){
			//save the school information
			$check = mysql_query("SELECT * FROM schools WHERE school_name='".mysql_real_escape_string(trim($_POST['sec']))."' && Village_id='{$_POST['cell_id']}'");
			if(mysql_num_rows($check) == 0){
				if(mysql_query("UPDATE schools SET school_name='".mysql_real_escape_string(trim($_POST['sec']))."', Village_id='{$_POST['cell_id']}' WHERE school_id='{$_POST['id']}'") or die(mysql_error())){
					$error = "<br />School Successfully Updated!";
					unset($_POST);
				} else
					$error = "<br />Error While Saving School";
			} else{
				$error = "<br />School Name Already Exists";
			}
		}
	} else{
		$error = "<br />Empty School Name!";
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
			<li><a href="1.php">Home</a></li>
			<li><a href="schools.php"class="active">Schools</a></li><!--
			<li><a href="cells.php">Cells</a></li>-->
			<li><a href="comments.php">Comments</a></li>
			<li><a href="index.php">Logout</a></li>
		</ul>
	</div>
	<div id="body">
		School Settings
		<hr>
		<div>
			<form method="POST" action="./schools.php">
				<?php
				if(@$update['school_id'])
					echo "<input type=hidden name=id value='{$update['school_id']}' />";
				?>
				<table style="color:white;">
					<?php
					if(@$_GET['new_village']){
						?>
						<tr><td>Cell: </td><td><input type=text name=cellname /></td></tr>
						<tr><td>Village: </td><td><input type=text name=villageid /></td></tr>
						<?php
					} else{
					?>
					<tr><td>Village:</td>
						<?php
						//select data for villages in the villages
						$query = "select cells.cellname, villages.village_id, villages.villagename from villages, cells, sector WHERE cells.cell_id=villages.village_id && sector.sector_id=cells.sector_id && sector.sector_id=1 order by cells.cellname asc; ";
						#echo $query;
						$c = "<select name=cell_id>";
						$cells = mysql_query($query);
						if($cells && mysql_num_rows($cells)>0){
							#var_dump($cells);
							while($cell = mysql_fetch_assoc($cells)){
								#var_dump($cell);
								$c .= "<option ".(@$update['village_id'] == $cell['village_id']?"selected":"")." value='{$cell['village_id']}'>".$cell['villagename']."(".$cell['cellname'].")</option>";
							}
						}
						$c .= "</select>";
						?>
						<td><?php echo $c ?><a href="./schools.php?new_village=1<?php echo (@$_GET['act']?"&act=".$_GET['act']:"")."".(@$_GET['id']?"&id=".$_GET['id']:"") ?>" style="text-decoration:none;color:chocolate;">New</a></td>
					</tr>
					<?php
					}
					?>
					<tr><td>School Name:</td><td><input type="text"name="sec" value='<?php echo @$update['school_name']?$update['school_name']:@$_POST['sec'] ?>'></td></tr>
					<tr><td colspan="2"><center><input type="submit"name='<?php echo @$update?"update_school":"save_school" ?>' value='<?php echo @$update?"Update School":"Save School" ?>'>
						<?php echo $error ?></center></td></tr>
				</table>
			</form>
		</div>
			<!----------------------list of registered schools------------------------>
			
			<center>
			<table border="1"style="color:white; border-collapse:collapse;">
				<tr id="header">
					<td>Id</td>
					<td>Name</td>
					<td>Address</td>
					<td>Directors</td>
					<td>Droped</td>
					<td colspan="2">Operations</td>
				</tr>
				<?php
				#echo "select schools.*, users.names, users.Usertype, districts.district_name, sector.sector_name from schools,users,villages, cells, sector, districts where schools.user_id=users.user_id && schools.village_id=villages.village_id && villages.cell_id=cells.cell_id && cells.sector_id=sector.sector_id && sector.district_id=districts.district_id";
				$sql=mysql_query("SELECT schools.*, users.user_id, users.names, users.Usertype, districts.district_name, sector.sector_name from schools,users,villages, cells, sector, districts WHERE schools.user_id=users.user_id && schools.village_id=villages.village_id && villages.cell_id=cells.cell_id && cells.sector_id=sector.sector_id && sector.district_id=districts.district_id order by school_id")or die(mysql_error());
				#var_dump($sql); echo mysql_num_rows($sql);
				$data = array();
				while($row=mysql_fetch_assoc($sql))
					$data[] = $row;
				foreach ($data as $row) {
					$query = mysql_query("SELECT droped.* FROM droped, students, classes,depts, schools WHERE
								droped.student_id = students.student_id &&
								students.class_id = classes.class_id &&
								classes.dept_id = depts.dept_id &&
								depts.school_id = schools.school_id &&
								droped.status = 1 &&
								schools.school_id = '{$row['school_id']}'")or die(mysql_error());
					?>
					<tr>
						<td><?php echo $row['school_id'];?></td>
						<td><?php echo $row['school_name'];?></td>
						<td><?php echo $row['district_name']."-".$row['sector_name'];?></td>
						<td><?php echo $row['Usertype'] == "administrator"?"<a href='./1.php?act=set_dir&school={$row['school_id']}'>set director</a>":$row['names'];?></td>
						<?php $num = mysql_num_rows($query); ?>
						<td><?php if($num>0){ ?><a target="_blank" href='print_1.php?school_id=<?php echo $row['school_id'] ?>&user_id=<?php echo $row['user_id'] ?>'><?php echo $num; echo " student".($num>1?"s":"") ?></a><?php } else{ echo "None";} ?></td>
						<td><a onclick='if(confirm("Do you Really Want to delete <?php echo $row['school_name'] ?>?")){return true} else{return false}' href="./schools.php?act=delete&id=<?php echo $row['school_id'] ?>">Delete</a></td>
						<td><a href="./schools.php?act=update&id=<?php echo $row['school_id']; ?>">Update</a></td>
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