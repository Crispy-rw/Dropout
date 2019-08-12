<?php
	session_start();
	include_once('config.php');

	if(isset($_POST['edit'])){
		$database = new Connection();
		$db = $database->open();
		try{
			$course_id = $_GET['course_id'];
			$course_name = $_POST['course_name'];
			$lect_id = $_POST['lect_id'];
			$credits= $_POST['credits'];
			$dept_id= $_POST['dept_id'];
			$level_id= $_POST['level_id'];
			$class_id= $_POST['class_id'];
			$room_id= $_POST['room_id'];
			$day= $_POST['day'];
			
			$sql = "UPDATE course SET course_name = '$course_name', credits = '$credits', dept_id = '$dept_id', level_id = '$level_id',lect_id = '$lect_id', class_id = '$class_id', room_id = '$room_id' , day = '$day' WHERE course_id = '$course_id'";
			//if-else statement in executing our query
			$_SESSION['message'] = ( $db->exec($sql) ) ? 'course updated Successfully' : 'Something went wrong. Cannot Update course';
		}
		catch(PDOException $e){
			$_SESSION['message'] = $e->getMessage();
		}

		//close connection
		$database->close();
	}
	else{
		$_SESSION['message'] = 'Fill up edit form first';
	}

	header('location: course.php');

?>