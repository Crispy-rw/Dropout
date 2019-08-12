<?php
session_start();
include "connect.php";
if($_SESSION['usertype']!='user') {
	header("location:./logout.php");
	exit();
}
include "connect.php";
$echo=null;
$d=null;
if (isset($_POST['student'])) {
	$Name=mysql_real_escape_string(strtoupper($_POST['nm']));
	$Surname=mysql_real_escape_string(ucfirst($_POST['snm']));
	$Gender=$_POST['sex'];
	$District=ucfirst($_POST['di']);
	$Sector=ucfirst($_POST['sect']);
	$Cell=ucfirst($_POST['cell']);
	$Village=ucfirst($_POST['vil']);
	$Father=ucfirst($_POST['f']);
	$Fc=$_POST['fc'];
	$Mother=ucfirst($_POST['m']);
	$Mc=$_POST['mc'];

	if(empty($Name)or empty($Surname)or empty($Gender)or empty($District)or empty($Sector)or empty($Cell)or empty($Village)or empty($Father)or empty($Fc)or empty($Mother)or empty($Mc)){
			
			$echo="You have to fill all fields";

	}else if(!preg_match("/^07[2,3,8]{1}[0-9]{7}$/", $Mc)){
		$echo="Invalid telephone number !!!";
	}else if(!preg_match("/^07[2,3,8]{1}[0-9]{7}$/", $Fc)){
		$echo="Invalid telephone number !!!";
	}else{
		$District_id=null;
		$check=mysql_query("select *from districts where district_name='$District'");
		if(mysql_num_rows($check)==0){
			mysql_query("INSERT INTO districts values(null,'$District')");
			$District_id=mysql_insert_id();
		}else{
			$dis=mysql_fetch_assoc($check);
			$District_id=$dis['district_id'];
		}
		
		$Sector_id=null;
		$check=mysql_query("select *from sector where sector_name='$Sector' && district_id='$District_id'")or die(mysql_error());
		if(mysql_num_rows($check)==0){
			mysql_query("INSERT INTO sector values(null,'$Sector','$District_id')");
			$Sector_id=mysql_insert_id();
		}else{
			$sec=mysql_fetch_assoc($check);
			$Sector_id=$sec['sector_id'];
		}
		
		$Cell_id=null;
		$check=mysql_query($gg = "select *from cells where cellname='$Cell' && sector_id='$Sector_id'")or die(mysql_error());
		//echo $gg;
		if(mysql_num_rows($check)==0){

			mysql_query($ddd = "INSERT INTO cells values(null,'$Cell','$Sector_id')")or die(mysql_error());
			//echo $ddd;
			$Cell_id=mysql_insert_id();
		}else{
			$cel=mysql_fetch_assoc($check);
			$Cell_id=$cel['cell_id'];

		}
		//die;
		$Village_id=null;
		$check=mysql_query("select *from villages where villagename='$Village' && cell_id='$Cell_id'")or die(mysql_error());
		if(mysql_num_rows($check)==0){
			mysql_query("INSERT INTO villages values(null,'$Village','$Cell_id')");
			$Village_id=mysql_insert_id();
		}else{
			$vil=mysql_fetch_assoc($check);
			$Village_id=$vil['village_id'];
	}
	if(empty($Name)or empty($Surname)or empty($Gender)or empty($District)or empty($Sector)or empty($Cell)or empty($Village)or empty($Father)or empty($Fc)or empty($Mother)or empty($Mc)){
		$echo="You have to fill all fields !!!";
	}
	$check=mysql_query("SELECT *from students where Fname='$Name' && Lname='$Surname' && Father='$Father' && Mother='$Mother'");
	if(mysql_num_rows($check) != 1){
		mysql_query("INSERT INTO students values(null,'$Name','$Surname','$Gender','$Father','$Fc','$Mother','$Mc','$Village_id','{$_POST['sec']}')")or die(mysql_error());#,'7{$_FILES['upload']['name']}')");
		#move_uploaded_file($_FILES['upload']['tmp_name'],"c:\\xampp\\htdocs\\Pro\\Profile\\".$_FILES['upload']['name']);
		$echo="New student inserted !!!";
	}else{
		$echo="This student is already inserted !!!";
	}
}
	unset($_POST);
}
if(@$_GET['act']='update' && is_numeric($_GET['id'])){
	$s=mysql_query("SELECT students.*,villages.villagename,cells.cellname,sector.sector_name,districts.district_name FROM students,villages,cells,sector,districts WHERE student_id='{$_GET['id']}' && students.village_id=villages.village_id && villages.cell_id=cells.cell_id && cells.sector_id=sector.sector_id && sector.district_id=districts.district_id");
	$d=mysql_fetch_assoc($s);
}

	if (isset($_POST['upd'])) {
	$Name=mysql_real_escape_string(strtoupper($_POST['nm']));
	$Surname=mysql_real_escape_string(ucfirst($_POST['snm']));
	$Gender=$_POST['sex'];
	$District=ucfirst($_POST['di']);
	$Sector=ucfirst($_POST['sect']);
	$Cell=ucfirst($_POST['cell']);
	$Village=ucfirst($_POST['vil']);
	$Father=ucfirst($_POST['f']);
	$Fc=$_POST['fc'];
	$Mother=ucfirst($_POST['m']);
	$Mc=$_POST['mc'];

	if(empty($Name)or empty($Surname)or empty($Gender)or empty($District)or empty($Sector)or empty($Cell)or empty($Village)or empty($Father)or empty($Fc)or empty($Mother)or empty($Mc)){
			
			$echo="You have to fill all fields";

	}else if(!preg_match("/^07[2,3,8]{1}[0-9]{7}$/", $Mc)){
		$echo="Invalid telephone number !!!";
	}else if(!preg_match("/^07[2,3,8]{1}[0-9]{7}$/", $Fc)){
		$echo="Invalid telephone number !!!";
	}else{
		$District_id=null;
		$check=mysql_query("select *from districts where district_name='$District'");
		if(mysql_num_rows($check)==0){
			mysql_query("INSERT INTO districts values(null,'$District')");
			$District_id=mysql_insert_id();
		}else{
			$dis=mysql_fetch_assoc($check);
			$District_id=$dis['district_id'];
		}
		
		$Sector_id=null;
		$check=mysql_query("select *from sector where sector_name='$Sector' && district_id='$District_id'")or die(mysql_error());
		if(mysql_num_rows($check)==0){
			mysql_query("INSERT INTO sector values(null,'$Sector','$District_id')");
			$Sector_id=mysql_insert_id();
		}else{
			$sec=mysql_fetch_assoc($check);
			$Sector_id=$sec['sector_id'];
		}
		
		$Cell_id=null;
		$check=mysql_query($gg = "select *from cells where cellname='$Cell' && sector_id='$Sector_id'")or die(mysql_error());
		//echo $gg;
		if(mysql_num_rows($check)==0){

			mysql_query($ddd = "INSERT INTO cells values(null,'$Cell','$Sector_id')")or die(mysql_error());
			//echo $ddd;
			$Cell_id=mysql_insert_id();
		}else{
			$cel=mysql_fetch_assoc($check);
			$Cell_id=$cel['cell_id'];

		}
		$Village_id=null;
		$check=mysql_query("select *from villages where villagename='$Village' && cell_id='$Cell_id'")or die(mysql_error());
		if(mysql_num_rows($check)==0){
			mysql_query("INSERT INTO villages values(null,'$Village','$Cell_id')");
			$Village_id=mysql_insert_id();
		}else{
			$vil=mysql_fetch_assoc($check);
			$Village_id=$vil['village_id'];
	}
	if(empty($Name)or empty($Surname)or empty($Gender)or empty($District)or empty($Sector)or empty($Cell)or empty($Village)or empty($Father)or empty($Fc)or empty($Mother)or empty($Mc)){
		$echo="You have to fill all fields !!!";
	}
	$check=mysql_query("SELECT *from students where Fname='$Name' && Lname='$Surname' && Father='$Father' && Mother='$Mother' && student_id != '{$_GET['id']}'");
	if(mysql_num_rows($check) != 1){
		mysql_query("UPDATE students SET Fname='$Name',
											Lname='$Surname',
											Gender='$Gender',
											Father='$Father',
											Fathercontact='$Fc',
											Mother='$Mother',
											Mothercontact='$Mc',
											village_id='$Village_id',
											class_id='{$_POST['sec']}' WHERE student_id='{$_GET['id']}'")or die(mysql_error());
		$echo="Student updated !!!";
		unset($d);
unset($_POST);
	}else{
		$echo="This student is already in the system !!!";
	}
}
}
#var_dump($_SESSION);
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
			<li><a href="registration.php"class="active">Registration</a></li>
			<li><a href="view.php">View students</a></li>
			<li><a href="reports.php">Reports</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>
	</div>
	<div id="body">
		Students registration<?php // var_dump($d); ?>
		<hr>
		<div>
			<form method="POST"action=""enctype="multipart/form-data">
				<table style="color:white;">
					<tr><td>Class:</td>
						<td>
							<select name="sec">
								<?php
								$data=mysql_query($dd  = "SELECT classes.*,depts.deptacronym FROM classes,depts,schools WHERE classes.dept_id=depts.dept_id && depts.school_id=Schools.school_id && schools.user_id='{$_SESSION['user_id']}'")or die(mysql_error());
								//echo $dd;

								while($result=mysql_fetch_assoc($data)){
									//var_dump($result);
									echo "<option value='{$result['class_id']}' ".($result['class_id'] == $d['class_id']?"selected":"")." >".'S'.$result['year'].' '.$result['deptacronym'].' '.$result['letter']."</option>";
									#$_SESSION['class_id']=$result['class_id'];
									//($data['school_id'] == $sc['school_id'] || $sc['school_id'] == $_GET['school']?"selected":"")
								}
								?>
							</select>
					</td></tr>
					<tr><td>Name:</td><td><input type="text" placeholder="Student name" name="nm"value='<?php echo @$_POST['nm']?@$_POST['nm']:@$d['Fname']; ?>'></td></tr>
					<tr><td>Surname:</td><td><input type="text" placeholder="Student surname"name="snm"value='<?php echo @$_POST['snm']?@$_POST['snm']:@$d['Lname']; ?>'></td></tr>
					<tr><td>Gender:</td><td>Male<input type="radio"name="sex" <?php echo @$d['Gender'] == 'male'?"checked":"" ?> value="male">
											Female<input type="radio"name="sex"value="female"  <?php echo @$d['Gender'] == 'female'?"checked":"" ?>>
					</td></tr>
					<tr><td>District:</td><td><input type="text" placeholder="Where parents live" name="di"value='<?php echo @$_POST['di']?@$_POST['di']:@$d['district_name']; ?>'></td></tr>
					<tr><td>Sector:</td><td><input type="text" placeholder="Where parents live" name="sect"value='<?php echo @$_POST['sect']?@$_POST['sect']:@$d['sector_name']; ?>'></td></tr>
					<tr><td>Cell:</td><td><input type="text" placeholder="Where parents live" name="cell"value='<?php echo @$_POST['cell']?@$_POST['cell']:@$d['cellname']; ?>'></td></tr>
					<tr><td>Village:</td><td><input type="text" placeholder="Where parents live" name="vil"value='<?php echo @$_POST['vil']?@$_POST['vil']:@$d['villagename']; ?>'></td></tr>
					<tr><td>Father:</td><td><input type="text" placeholder="Father's names" name="f"value='<?php echo @$_POST['f']?@$_POST['f']:@$d['Father']; ?>'></td></tr>
					<tr><td>F.contact:</td><td><input type="text" onkeypress="return disablenum(event)" maxlength="10" placeholder="Father's contact" name="fc"value='<?php echo @$_POST['fc']?@$_POST['fc']:@$d['Fathercontact']; ?>'></td></tr>
					<tr><td>Mother:</td><td><input type="text" placeholder="Mother's names" name="m"value='<?php echo @$_POST['m']?@$_POST['m']:@$d['Mother']; ?>'></td></tr>
					<tr><td>M.contact:</td><td><input type="text" maxlength="10" onkeypress="return disablenum(event)" placeholder="Mother's contact" name="mc"value='<?php echo @$_POST['mc']?@$_POST['mc']:@$d['Mothercontact']; ?>'></td></tr>
					<!--<tr><td>Photo:</td><td><input type="file"name="upload"value="Browse"></td></tr>-->
					<tr><td colspan="2"><center><input type="submit"name='<?php echo @$d?"upd":"student";?>'value='<?php echo @$d?"Update user":"Save Data";?>'><br>
						<?php echo $echo;?></center></td></tr>
				</table>
			</form>
		</div>
			
	</div>

	<div id="footer">Carlos TWIZEYIMANA 2015 &copy All Rights Reserved !!!</div>

</div>
</body>
</html>
<script type="text/javascript">
	function disablenum (evt){
		var charcode=(evt.which)?evt.which:event.keycode;
		if (charcode>38 && (charcode<48 || charcode>57)) {
        return false;

		}
		return true;

	}
</script>