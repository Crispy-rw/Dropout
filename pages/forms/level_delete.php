<?php
	session_start();
	include_once('config.php');

	if(isset($_GET['level_id'])){
		$database = new Connection();
		$db = $database->open();
		try{
			$sql = "DELETE FROM level WHERE level_id = '".$_GET['level_id']."'";
			//if-else statement in executing our query
			$_SESSION['message'] = ( $db->exec($sql) ) ? 'Level is Deleted Duccessfully' : 'Something went wrong. Cannot Delete Level';
		}
		catch(PDOException $e){
			$_SESSION['message'] = $e->getMessage();
		}

		//close connection
		$database->close();

	}
	else{
		$_SESSION['message'] = 'Select Level to delete first';
	}

	header('location: level.php');

?>