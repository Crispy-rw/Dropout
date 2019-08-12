<?php
session_start();
require_once "./lib/config.php";
$db = new DBConnector();

$year = $db->select1cell("year","Year",array("Active"=>1),true);
$school = $db->select1cell("cells","CellID",array("UserID"=>$_SESSION['user']['UserID']),true);
$school_id = $db->selectOneRowFromTable($tbl="schools",$condition=array("SchoolID"=>$school),$indexed=true);
$tbl = array("schools","villages","cells","sector","district");
$fld = array("schools"=>array("*"),"villages"=>array("VillageName"),"cells"=>array("CellName"),"sector"=>array("SectorName"),"district"=>array("DistrictName"));
$condition = array("schools`.`SchoolVillage"=>"villages`.`VillageID","villages`.`CellID"=>"cells`.`CellID","cells`.`SectorID"=>"sector`.`SectorID","sector`.`DistrictID"=>"district`.`DistrictID","schools`.`SchoolID"=>$school);
$lbl = array("tbl"=>$tbl,"fld"=>$fld,"condition"=>$condition);
$sc = $db->selectInMoreTable($lbl,$multirows=false,$indexed=true, $order="");
//save new user
$tbl = array("student_{$year}","droped_student_{$year}","villages","cells","sector","district","classes_{$year}","dept_{$year}");
$fld = array("student_{$year}"=>array("*"),"droped_student_{$year}"=>array("Status","Date","DropedID"),"villages"=>array("VillageName"),"cells"=>array("CellName"),"sector"=>array("SectorName"),"district"=>array("DistrictName"),"classes_{$year}"=>array("ClassID","ClassYear","ClassLetter"),"dept_{$year}"=>array("DeptAcronym"));
$condition = array(
					"student_{$year}`.`StudentID"=>"droped_student_{$year}`.`StudentID",
					"student_{$year}`.`VillageID"=>"villages`.`VillageID",
					"villages`.`CellID"=>"cells`.`CellID",
					"cells`.`SectorID"=>"sector`.`SectorID",
					"sector`.`DistrictID"=>"district`.`DistrictID",
					"student_{$year}`.`ClassID"=>"classes_{$year}`.`ClassID",
					"classes_{$year}`.`DeptID"=>"dept_{$year}`.`DeptID",
					"cells`.`CellID"=>$school,
					"droped_student_{$year}`.`Status"=>1
					);
$lbl = array("tbl"=>$tbl,"fld"=>$fld,"condition"=>$condition);
$students = $db->selectInMoreTable($lbl,$multirows=true,$indexed=true, $order="ORDER BY DeptAcronym ASC, ClassYear ASC, Fname ASC, LName ASC");
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
			$tb .= "<tr><td colspan=10>".($students[$i]['DeptAcronym']=="P6"?"P":"S")."{$students[$i]['ClassYear']} ".($students[$i]['DeptAcronym']=="P6" || $students[$i]['DeptAcronym']=="OLC"?"":$students[$i]['DeptAcronym'])." {$students[$i]['ClassLetter']}</td></tr><tr><th>No</th><th>Name</th><th>Surname</th><th>Father</th><th>Mother</th><th>Village</th><th>Cell</th><th>Sector</th><th>District</th><th>Date</th></tr>";
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