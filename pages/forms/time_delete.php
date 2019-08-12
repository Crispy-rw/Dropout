<?php
	session_start();
	include_once('config.php');

	if(isset($_GET['time_id'])){
		$database = new Connection();
		$db = $database->open();
		try{
			
			$sql = "DELETE FROM ttime WHERE time_id = '".$_GET['time_id']."'";
			//if-else statement in executing our query
			$_SESSION['message'] = ( $db->exec($sql) ) ? 'time is Deleted Duccessfully' : 'Something went wrong. Cannot Delete time';
		}
		catch(PDOException $e){
			$_SESSION['message'] = $e->getMessage();
		}

		//close connection
		$database->close();

	}
	else{
		$_SESSION['message'] = 'Select time to delete first';
	}

	header('location: time.php');

?>