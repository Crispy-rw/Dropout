<?php
session_start();
include"connect.php";
$print="";
$username_err = "";
$password_err = "";


if (isset($_POST['login'])) {
	$username=$_POST['username'];
	$password=$_POST['password'];
	$sql="select*from users where Username='$username' AND Password='$password'";
	$exec=mysql_query($sql)or die(mysql_error());
	if (mysql_num_rows($exec)==1) {
		$row=mysql_fetch_array($exec);
		$_SESSION['username']=$row['Username'];
		$_SESSION['password']=$row['Password'];
		$_SESSION['usertype']=$row['Usertype'];
		$_SESSION['user_id']=$row['user_id'];
		if ($row['Usertype']=='administrator') {
			header("location:./dashboard.php");
		}elseif ($row['Usertype']=='user') {
			header("location:./dashboard2.php");
		}elseif ($row['Usertype']=='executive'){
			header("location:3.php");
		}elseif ($row['Usertype'] == 'rehab') {
      header("location:rehab_dashboard.php");
    }
	}
	else{
		$username_err = "Invalid username or password !!!";
		$password_err = "Invalid username or password !!!";
		}
	
}
#var_dump($row);
?>
<!----------------------start of html codes-------------------->
 
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Time Table</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">


  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="index2.html"><b>Student Dropout Management System </a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg"> Login </p>

    <form action="" method="POST">
      <div class="form-group has-feedback <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
        <input type="text" name="username" value="<?php echo @$_POST['username']; ?>" class="form-control" placeholder="Username">
        <span class="fa fa-user form-control-feedback"></span>
        <span class="help-block"><?php echo $username_err; ?></span>
      </div>
      <div class="form-group has-feedback <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
        <input type="password" name="password" value="" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <span class="help-block"><?php echo $password_err; ?></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">

          <input type="submit" class="btn btn-primary btn-block btn-flat" name="login" value="Login">
        </div>
        <!-- /.col -->
      </div>
    </form>

  
    <!-- /.social-auth-links -->

    <a href="#">I forgot my password</a><br>
    
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
