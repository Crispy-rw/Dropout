<?php
include "connect.php";
$print="";
if (isset($_POST['send'])) {
	$names=$_POST['name'];
	$email=$_POST['email'];
	$message=$_POST['message'];
	if(empty($names)||empty($email)||empty($message)){
		$print="You have to fill all fields!!!";
	}elseif(!preg_match("/^[a-zA-Z]\w+(\.\w+)*\@\w+(\.[0-9a-zA-Z]+)*\.[a-zA-Z]{2,4}$/", $email)){
								
	$print="Invalid Email !!!";
	
	}else{
	mysql_query("INSERT INTO comments values(null,'$names','$email','$message')")or die(mysql_error());
	$print="Thanks for your message!!!";
	}
	unset($_POST);
}
?>
<html>
<head>
	<title>Online School Dropout Reporting System</title>
	<link rel="stylesheet" type="text/css" href="css/file.css">
	<link rel="icon"href="Images/logo2.jpeg">
</head>
<body>
<div id="wrapper">

	<div id="banner">
		<img src="Images/banno.png"width="100%"height="100%"style="border-radius:10px 10px 0px 0px;">
	</div>

	<!----------------menu------------------>
	<div id="menu">
		<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="about us.php">About us</a></li>
			<li><a href="contact us.php"class="active">Contact us</a></li>
		</ul>
	</div>
	<div id="body">
		<center>
			<div id="adv">
				<b style="font-family:Lucida Calligraphy;">Welcome to our system!!!</b>
				<hr>
				Here you can contact us by sending a comment
				<form method="POST"action="">
					<table style="color:white; padding-top:20px;">
						<tr>
							<td>Name</td><td><input type="text"name="name"value='<?php echo @$_POST?$_POST['name']:"";?>'></td>
						</tr>
						<tr>
							<td>Email Address</td><td><input type="text"name="email"value='<?php echo @$_POST?$_POST['email']:"";?>'></td>
						</tr>
						<tr>
							<td>Message</td><td><textarea rows="10"cols="50"name="message"style="font-family:nyala;font-size:18px;"><?php echo @$_POST?$_POST['message']:"";?></textarea></td>
						</tr>
						<tr>
							<td colspan="2"><center><input type="submit"name="send"value="Send">
								<?php echo "$print";?></center></td>
						</tr>
					</table>
				</form>
			</div>
		</center>
	</div>
	<div id="footer">Carlos TWIZEYIMANA 2015 &copy All Rights Reserved !!!</div>
	
</div>
</body>
</html>