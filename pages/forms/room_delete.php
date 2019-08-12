<?php
	session_start();
	include_once('config.php');

	if(isset($_GET['room_id'])){
		$database = new Connection();
		$db = $database->open();
		try{
			$sql = "DELETE FROM room WHERE room_id = '".$_GET['room_id']."'";
			//if-else statement in executing our query
			$_SESSION['message'] = ( $db->exec($sql) ) ? 'Room is Deleted Duccessfully' : 'Something went wrong. Cannot Delete Room';
		}
		catch(PDOException $e){
			$_SESSION['message'] = $e->getMessage();
		}

		//close connection
		$database->close();

	}
	else{
		$_SESSION['message'] = 'Select Room to delete first';
	}

	header('location: room.php');

?>