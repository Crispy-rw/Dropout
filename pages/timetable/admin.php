<?php
                  include_once('config.php');

                  $database = new Connection();
                        $db = $database->open();

                    $sql = $db->prepare("SELECT level.level_id, department.dept_name, class.class_name, class.dept_id,level.level_name,class.class_id FROM department,level,class WHERE class.dept_id = department.dept_id AND level.level_id = class.level_id AND class.class_id = 'ITL1A' ");
					$sql->execute();
					while ($result = $sql->fetch(PDO::FETCH_ASSOC)) {
					    echo "Department : ".$result['dept_name']."<br> ";
					    echo "Level : ".$result['level_name']."  <br>";
					    echo "Class : ".$result['class_name']." ";
}
					    $sql = $db->prepare("SELECT level.level_id, department.dept_name, class.class_name, class.dept_id,level.level_name,class.class_id FROM department,level,class WHERE class.dept_id = department.dept_id AND level.level_id = class.level_id AND class.class_id = 'ITL1A' ");
					$sql->execute();
					while ($result = $sql->fetch(PDO::FETCH_ASSOC)) {
					    echo "Department : ".$result['dept_name']."<br> ";
					    echo "Level : ".$result['level_name']."  <br>";
					    echo "Class : ".$result['class_name']." ";


}
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Time table</title>
 </head>
 <body>
 	<table width="800">
 		<thead>
 			<tr>
 			<th>Time </th>
 			<th>Monday</th>
 			<th>Tuesday </th>
 			<th>Wednesday</th>
 			<th>Thursday </th>
 			<th>Friday </th>
 			</tr>
 		</thead>
 		<tr>
 			<td></td>
 			<td></td>
 			<td></td>
 			<td></td>
 			<td></td>
 			<td></td>
 		</tr>
 	</table>
 </body>
 </html>