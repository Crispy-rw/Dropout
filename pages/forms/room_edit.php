<?php
	session_start();
	include_once('config.php');

	if(isset($_POST['edit'])){
		$database = new Connection();
		$db = $database->open();
		try{
			$room_id = $_GET['room_id'];
			//$school_name = $_POST['school_name'];
			//$dept_id = $_POST['dept_id'];
			$room_name= $_POST['room_name'];
			$description= $_POST['description'];
			
			

			$sql = "UPDATE room SET description = '$description', room_name = '$room_name' WHERE room_id = '$room_id'";
			//if-else statement in executing our query
			$_SESSION['message'] = ( $db->exec($sql) ) ? 'Room updated Successfully' : 'Something went wrong. Cannot Update Room';
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

	header('location: room.php');

?>