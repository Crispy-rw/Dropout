<?php
	session_start();
	include_once('config.php');

	if(isset($_POST['edit'])){
		$database = new Connection();
		$db = $database->open();
		try{
			$class_id = $_GET['class_id'];
			//$school_name = $_POST['school_name'];
			//$dept_id = $_POST['dept_id'];
			$class_name= $_POST['class_name'];
			$dept_id= $_POST['dept_id'];
			$level_id= $_POST['level_id'];
			

			$sql = "UPDATE class SET dept_id= '$dept_id', class_name = '$class_name', level_id = '$level_id' WHERE class_id = '$class_id'";
			//if-else statement in executing our query
			$_SESSION['message'] = ( $db->exec($sql) ) ? 'Class updated Successfully' : 'Something went wrong. Cannot Update Class';
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

	header('location: class.php');

?>