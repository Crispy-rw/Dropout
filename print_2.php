<?php
session_start();
include "connect.php";

				$sq=mysql_query($s = "SELECT droped.*,students.*,depts.deptacronym, classes.year, classes.letter, classes.class_id,villages.villagename,cells.cellname,sector.sector_name,districts.district_name 
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
				$students = array();
				while($row=mysql_fetch_assoc($sq))
				//echo $s;
					$students[] = $row;
				//select school identification
				$school_query = "SELECT DISTINCT `schools`.*, `villages`.`villagename`, `cells`.`cellname`, `sector`.`sector_name`, `districts`.`district_name`
								 FROM `schools`, `villages`, `cells`, `sector`, `districts` WHERE 
								 `schools`.`village_id`=`villages`.`village_id` && 
								 `villages`.`cell_id`=`cells`.`cell_id` && 
								 `cells`.`sector_id`=`sector`.`sector_id` && 
								 `sector`.`district_id`=`districts`.`district_id` && 
								 `schools`.`school_id`='{$_SESSION['school_id']}' ";
								 //echo $school_query;
				$school = mysql_query($school_query);
				$sc = mysql_fetch_assoc($school);
				$year = date("Y",time());
				//select information of school
				$school_id_query = mysql_query("SELECT * FROM schools WHERE school_id='{$_SESSION['school_id']}'");
				$school_id = mysql_fetch_assoc($school_id_query);

				//select head master
				//var_dump($_SESSION);
				$head = mysql_query("SELECT * FROM users WHERE user_id='{$_SESSION['user_id']}'");
				$head_ = mysql_fetch_assoc($head);
				$tb = "
District:{$sc['district_name']}<br />
Sector:{$sc['sector_name']}<br />
Cell:{$sc['cellname']}<br />
Village:{$sc['villagename']}<br /><br />
<div style='text-align:center; text-decoration:underline;'>Students who drop school in {$year}</div><br /><table border=1 style='border-collapse:collapse' width=100% cellspacing=0>";
	
	$count = 0;
				for($i=0;$i<count($students);$i++){
					if($i==0 || $students[$i]["class_id"] != @$students[($i-1)]["class_id"] ){
						$tb .= "<tr><td colspan=10>".($students[$i]['deptacronym']=="P"?"P":"S")."{$students[$i]['year']} ".($students[$i]['deptacronym']=="P6" || $students[$i]['deptacronym']=="OLC"?"":$students[$i]['deptacronym'])." {$students[$i]['letter']}</td></tr><tr><th>No</th><th>Name</th><th>Surname</th><th>Father</th><th>Mother</th><th>Village</th><th>Cell</th><th>Sector</th><th>District</th><th>Date</th></tr>";
						$count = 0;
					}
					$tb .= "<tr>";
					$tb .= "<td>{$students[$i]['droped_id']}</td>";
					$tb .= "<td>{$students[$i]['Fname']}</td>";
					$tb .= "<td>{$students[$i]['Lname']}</td>";
					$tb .= "<td>{$students[$i]['Father']}</td>";
					$tb .= "<td>{$students[$i]['Mother']}</td>";
					$tb .= "<td>{$students[$i]['villagename']}</td>";
					$tb .= "<td>{$students[$i]['cellname']}</td>";
					$tb .= "<td>{$students[$i]['sector_name']}</td>";
					$tb .= "<td>{$students[$i]['district_name']}</td>";
					$tb .= "<td>{$students[$i]['date']}</td>";
					$tb .= "</tr>";
				}
				$tb .= "</table><br /><b>Total: ".count($students)." Student".(count($students)>1?"s":"")."</b><br /><br /><div style='width:300px; margin-right:5px; float:right;'>{$school_id['school_name']}<br /><br /><br /><br />Head Master<br />{$head_['Names']}</div>";
				//echo $tb;
				require_once "./lib/mpdf57/mpdf.php";

$pdf = new MPDF();

$pdf->Open();

$pdf->AddPage("L");

$pdf->SetFont("Arial","B",9);

$pdf->WriteHTML($tb);

$pdf->Output();
				die;
$tb = "";
if($students){
	$tb = "
District:{$sc['DistrictName']}<br />
Sector:{$sc['SectorName']}<br />
Cell:{$sc['CellName']}<br />
Village:{$sc['VillageName']}<br /><br />
<div style='text-align:center; text-decoration:underline;'>Students who droped school in {$year}</div><br /><table border=1 style='border-collapse:collapse' width=100% cellspacing=0>";
	$count = 0;
	for($i=0;$i<count($students);$i++){
		if($i==0 || $students[$i]["ClassID"] != @$students[($i-1)]["ClassID"] ){
			$tb .= "<tr><td colspan=10>".($students[$i]['deptacronym']=="P6"?"P":"S")."{$students[$i]['year']} ".($students[$i]['deptacronym']=="P6" || $students[$i]['deptacronym']=="OLC"?"":$students[$i]['deptacronym'])." {$students[$i]['letter']}</td></tr><tr><th>No</th><th>Name</th><th>Surname</th><th>Father</th><th>Mother</th><th>Village</th><th>Cell</th><th>Sector</th><th>District</th><th>Date</th></tr>";
			$count = 0;
		}
		$tb .= "<tr><td>".(++$count)."</td><td>{$students[$i]['FName']}</td><td>{$students[$i]['LName']}</td><td style='cursor:pointer;' title='Contact: {$students[$i]['FatherContact']}'>{$students[$i]['Father']}</td><td style='cursor:pointer;' title='Contact: {$students[$i]['MotherContact']}'>{$students[$i]['Mother']}</td><td>{$students[$i]['VillageName']}</td><td>{$students[$i]['CellName']}</td><td>{$students[$i]['SectorName']}</td><td>{$students[$i]['DistrictName']}</td><td>{$students[$i]['Date']}</td></tr>";
	}
	$tb .= "</table><br /><b>Total: ".count($students)." Student".(count($students)>1?"s":"")."</b><br /><br /><div style='width:300px; margin-right:5px; float:right;'>{$school_id['SchoolName']}<br /><br /><br /><br />Head Master<br />".$db->select1cell("users","Name",array("UserID"=>$school_id['UserID']),true)."</div>";
	
	echo $tb;
	
} else
	$tb = "
<span class=error>No Student Drop the school in {$year} year!</span>";
require_once "./lib/mpdf57/mpdf.php";

$pdf = new MPDF();

$pdf->Open();

$pdf->AddPage("L");

$pdf->SetFont("Arial","B",9);

$pdf->WriteHTML($tb);

$pdf->Output();
?>