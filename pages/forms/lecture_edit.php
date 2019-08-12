<?php
	session_start();
	include_once('config.php');

	if(isset($_POST['edit'])){
		$database = new Connection();
		$db = $database->open();
		try{
			$lect_id = $_GET['lect_id'];
			//$school_name = $_POST['school_name'];
			//$dept_id = $_POST['dept_id'];
			$lect_name= $_POST['lect_name'];
			$dept_id= $_POST['dept_id'];
			$lect_grade= $_POST['lect_grade'];
			

			$sql = "UPDATE lecture SET dept_id= '$dept_id', lect_name = '$lect_name', lect_grade = '$lect_grade' WHERE lect_id = '$lect_id'";
			//if-else statement in executing our query
			$_SESSION['message'] = ( $db->exec($sql) ) ? 'Lecture updated Successfully' : 'Something went wrong. Cannot Update Lecture';
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

	header('location: lecture.php');

?>