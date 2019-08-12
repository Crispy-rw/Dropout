<?php
	session_start();
	include_once('config.php');

	if(isset($_GET['class_id'])){
		$database = new Connection();
		$db = $database->open();
		try{
			$sql = "DELETE FROM class WHERE class_id = '".$_GET['class_id']."'";
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

	header('location: class.php');

?>