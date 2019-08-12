<?php
	session_start();
	include_once('config.php');

	if(isset($_POST['edit'])){
		$database = new Connection();
		$db = $database->open();
		try{
			$time_id = $_GET['time_id'];
			//$school_name = $_POST['school_name'];
			//$time_id = $_POST['time_id'];
			$course_id= $_POST['course_id'];
			$time_start= $_POST['time_start'];
			$time_end= $_POST['time_end'];
			
			
			
			$sql = "UPDATE ttime SET time_end = '$time_end',time_start = '$time_start', course_id = '$course_id' WHERE time_id = '$time_id'";
			//if-else statement in executing our query
			$_SESSION['message'] = ( $db->exec($sql) ) ? 'time updated Successfully' : 'Something went wrong. Cannot Update time';
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

	header('location: time.php');

?>