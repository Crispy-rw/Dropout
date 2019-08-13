<?php
// Initialize the session
session_start();
include "connect.php";
if ($_SESSION['usertype']!='administrator') {
  header("location:./logout.php");
  exit();
}
 

// Define variables and initialize with empty values
$year_err = $school_name_err = $village_name_err =  "";





//save the seo information

if(isset($_POST['save_seo'])){


  $name = $_POST['name'];
  $phone = $_POST['phone'];
  $id = $_POST['id'];
  $user = $_POST['user'];
  $pass = $_POST['pass'];
  $sec_id = $_GET['sec'];


  //save executive information
  $sql = "INSERT into users VALUES(null,'{$user}','{$pass}','{$name}','{$phone}','{$id}','executive')";

  $res = mysql_query($sql) or die(mysql_errno());

  $user_id = mysql_insert_id();

  unset($res);

  if(is_numeric($user_id)){

    $update = "UPDATE sector SET user_id = '{$user_id}' WHERE sector_id = {$sec_id}";
    
    $res = mysql_query($update) or die(mysql_error());


  }


}




 
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>School Dropout Management</title>
  <!-- Tell the browser to be responsive to screen width -->
   <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="./bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="./bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="./bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="./dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="./dashboard.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>O</b>S<b>D</b><b>M</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>School Dropout </b> management System</b> </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          
          <!-- Notifications: style can be found in dropdown.less -->
         
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="./dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $_SESSION['username'] ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="./dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  <?php echo $_SESSION['username'] ?> - <?php echo $_SESSION['usertype'] ?>
                </p>
              </li>
              <!-- Menu Body -->
             
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                   <a href="./logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
         
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="./dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['username'] ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
     
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview">
          <a href="dashboard.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
          
        </li>
        
        <li >
          <a href="new_schools.php">
            <i class="fa fa-edit"></i> <span> Schools</span>
          </a>
        </li>
       
    
        <li >
          <a href="new_rehab.php">
            <i class="fa fa-edit"></i> <span> Rehabilitation</span>
          </a>
        </li>
       
    
        <li>
          <a href="new_seo.php">
            <i class="fa fa-edit"></i> <span>Sector Education Officer</span>
          </a>
        </li>       
    

      
        <li class="header">Setting</li>
        <li><a href="#"><i class="fa fa-cogs text-red"></i> <span>Account Setting</span></a></li>
       
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Options
  
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Options</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <!-- Used DATA WE NEED  -->

        <div class="box">
            <div class="box-header">
              <h3 class="box-title">Sector Education Officer Features </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <td>Location</td>
                  <td>SEO</td>
                  <td># of Schools</td>
                  <td colspan="2">Operations</td>
                </tr>
                </thead>
                <tbody>
                  <?php

                     $res = "SELECT districts.*,sector.*,users.* from districts,sector,users WHERE sector.user_id = users.user_id  &&  districts.district_id = sector.district_id";

                     $data = array();
                     $sql = mysql_query($res) or die(mysql_error());
                     while($row=mysql_fetch_assoc($sql))
                        $data[] = $row;
                      // echo "<pre>";
                      // print_r($data);
                           $i = 1; 
                     foreach ($data as $row) {

                      $query = mysql_query("SELECT DISTINCT schools.school_id FROM `schools`, `villages`, `cells`, `sector`, 
                                           `districts` WHERE  `schools`.`village_id`=`villages`.`village_id` && 
                                           `villages`.`cell_id`=`cells`.`cell_id` && 
                                           `cells`.`sector_id`='{$row['sector_id']}'") or die(mysql_error());                            
                    
                     ?>
               <tr>
                <td><?php echo $row['district_name']."-".$row['sector_name'];?></td>
                <td><?php echo $row['Usertype'] == "administrator"?"<a class='btn btn-success btn-sm' data-toggle='modal' href='#edit_{$row['sector_id']}'>set SEO</a>":$row['Names'];?></td>
                <?php $num = mysql_num_rows($query); ?>
                <td><?php if($num>0){ ?><?php echo $num; echo " School".($num>1?"s":"") ?><?php } else { echo "None";} ?></td>

                <?php include './edit_delete_seo.php';?>

          </tr>
              <?php
                  }
                  
               ?>
                </tbody>
              </table>
             
            </div>
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Designed By</b> Christian & Bonaventure
    </div>
    <strong>Copyright &copy; 2019 <a href="http://www.iprctumba.rp.ac.rw"> IPRC Tumba </a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
 
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="./bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="./bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="./bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="./bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="./bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="./bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="./dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="./dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
</body>
</html>
