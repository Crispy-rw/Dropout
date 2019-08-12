<?php
	session_start();
	include_once('config.php');

	if(isset($_POST['edit'])){
		$database = new Connection();
		$db = $database->open();
		try{
			$level_id = $_GET['level_id'];
			//$school_name = $_POST['school_name'];
			//$level_id = $_POST['level_id'];
			$level_name= $_POST['level_name'];
			$dept_head= $_POST['dept_head'];
			
			

			$sql = "UPDATE level SET  level_name = '$level_name' WHERE level_id = '$level_id'";
			//if-else statement in executing our query
			$_SESSION['message'] = ( $db->exec($sql) ) ? 'Level updated Successfully' : 'Something went wrong. Cannot Update Level';
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

	header('location: level.php');

?>