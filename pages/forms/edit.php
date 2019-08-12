  <?php
	session_start();
	include_once('config.php');

	if(isset($_POST['edit'])){
		$database = new Connection();
		$db = $database->open();
		try{
			$dept_id = $_GET['dept_id'];
			//$school_name = $_POST['school_name'];
			//$dept_id = $_POST['dept_id'];
			$dept_name= $_POST['dept_name'];
			$dept_head= $_POST['dept_head'];

			$sql = "UPDATE department SET dept_head = '$dept_head', dept_name = '$dept_name' WHERE dept_id = '$dept_id'";
			//if-else statement in executing our query
			$_SESSION['message'] = ( $db->exec($sql) ) ? 'Department updated Successfully' : 'Something went wrong. Cannot Update Department';
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

	header('location: department.php');

?>