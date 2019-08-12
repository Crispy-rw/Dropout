<?php
	session_start();
	include_once('config.php');

	if(isset($_GET['lect_id'])){
		$database = new Connection();
		$db = $database->open();
		try{
			$sql = "DELETE FROM lecture WHERE lect_id = '".$_GET['lect_id']."'";
			//if-else statement in executing our query
			$_SESSION['message'] = ( $db->exec($sql) ) ? 'Lecture is Deleted Duccessfully' : 'Something went wrong. Cannot Delete Lecture';
		}
		catch(PDOException $e){
			$_SESSION['message'] = $e->getMessage();
		}

		//close connection
		$database->close();

	}
	else{
		$_SESSION['message'] = 'Select Lecture to delete first';
	}

	header('location: lecture.php');

?>