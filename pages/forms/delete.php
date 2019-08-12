<?php
	session_start();
	include_once('config.php');

	if(isset($_GET['dept_id'])){
		$database = new Connection();
		$db = $database->open();
		try{
			$sql = "DELETE FROM department WHERE dept_id = '".$_GET['dept_id']."'";
			//if-else statement in executing our query
			$_SESSION['message'] = ( $db->exec($sql) ) ? 'Department is Deleted Duccessfully' : 'Something went wrong. Cannot Delete Department';
		}
		catch(PDOException $e){
			$_SESSION['message'] = $e->getMessage();
		}

		//close connection
		$database->close();

	}
	else{
		$_SESSION['message'] = 'Select Department to delete first';
	}

	header('location: department.php');

?>