<?php
	session_start();
	include_once('config.php');

	if(isset($_GET['course_id'])){
		$database = new Connection();
		$db = $database->open();
		try{
			$sql = "DELETE FROM course WHERE course_id = '".$_GET['course_id']."'";
			//if-else statement in executing our query
			$_SESSION['message'] = ( $db->exec($sql) ) ? 'Course is Deleted Duccessfully' : 'Something went wrong. Cannot Delete Course';
		}
		catch(PDOException $e){
			$_SESSION['message'] = $e->getMessage();
		}

		//close connection
		$database->close();

	}
	else{
		$_SESSION['message'] = 'Select Course to delete first';
	}

	header('location: course.php');

?>