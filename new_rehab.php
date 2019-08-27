<?php
// Initialize the session
session_start();
include "connect.php";
if ($_SESSION['usertype']!='administrator') {
  header("location:./logout.php");
  exit();
}
 

// Define variables and initialize with empty values
$year_err = $sector_name_err = $rehab_name_err =  "";



if(isset($_GET['act']) == 'delete_dir'){

  $dir_id = $_GET['id'];

  $dir_sql = "UPDATE rehab SET `userId` = '1' WHERE `id` = '{$dir_id}' ";

  $update_dir = mysql_query($dir_sql) or die(mysql_error());

  if ($update_dir) {
    echo "Director Removed Successfully";
  }else{
    echo "Protocol Error";
  }

}


//save the school information

if (isset($_POST['save_rehab'])) {

  $add = mysql_query("INSERT rehab VALUES(null,'{$_POST['rehab']}','{$_POST['sector_id']}',1)");

  if ($add) {

    echo "Rehabilitation Added";

  }else{

    echo "Protocol Error";
  }



}



if(isset($_POST['rehab_add'])){
  //check the village information

  $rehab_id = $_GET['rehab_id'];
  $name = $_POST['name'];
  $phone = $_POST['phone'];
  $id = $_POST['id'];
  $user = $_POST['user'];
  $pass = $_POST['pass'];

  $check = mysql_query("SELECT * from users WHERE username = '$user'") or die(mysql_error());

if(mysql_num_rows($check) == 0 ){

  $sql = "INSERT INTO users VALUES(null,'$user','$pass','$name','$phone','$id','rehab')"; 

  $res = mysql_query($sql) or die(mysql_error());

  $user_id = mysql_insert_id();

  // echo $user_id;

  if($user_id){

    $rehab = "UPDATE rehab SET userId = '{$user_id}'  WHERE id = '{$rehab_id}'";

    $save = mysql_query($rehab) or die(mysql_error());

    if($save){

      echo "Director Set";

     }else{

      echo "Error While Saving! Protocol Error";

     }
  }

}else{

  echo "User Already Exist";

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
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                      page and may cause design problems
                    </a>
                  </li>
                  
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
         
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
                  <small><?php echo $info['school_name'] ?></small>
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
        Rehabilitation
  
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Rehabilitation</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <!-- Used DATA WE NEED  -->

        <div class="box">
            <div class="box-header">
              <h3 class="box-title">Rehabilitation Features </h3>
              <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#modal-default">
                <i class="fa fa-plus"> </i> Add Rehabilitation Center
              </button>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <td>Name</td>
                  <td>Address</td>
                  <td>Directors</td>
                  <td colspan="2">Operations</td>
                </tr>
                </thead>
                <tbody>
                  <?php
                     $sql=mysql_query("SELECT districts.district_name,sector.sector_name,rehab.*,users.* from users,rehab,districts,sector WHERE districts.district_id = sector.district_id && sector.sector_id = rehab.sector_id && rehab.userId = users.user_id")or die(mysql_error());
        #var_dump($sql); echo mysql_num_rows($sql);
                     $data = array();
                     while($row=mysql_fetch_assoc($sql))
                        $data[] = $row;

                           $i = 1; 
                     foreach ($data as $row) {
                  
                 ?>
               <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $row['name'];?></td>
                <td><?php echo $row['district_name']."-".$row['sector_name'];?></td>
                <td>

                  <?php echo $row['Usertype'] == "administrator"?"<a class='btn btn-success btn-sm' data-toggle='modal' href='#edit2_{$row['id']}'>Set Director</a>":$row['Names']."<a onclick='return confirm(\"Do you want to delete this Director?\");' href='./new_rehab.php?act=delete_dir&id={$row['id']}'> X </a>" ;?>
                  

                </td>
                <td>
                    <a href="#delete_<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" data-toggle="modal"><span class="fa fa-trash"></span> Delete </a>
                </td>
               <?php include('./edit_delete_rehab.php'); ?>
               </tr>
              <?php
               $i++;
                  }
                  
               ?>
                </tbody>
              </table>
             
            </div>

            <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Rehabilitation Center </h4>
              </div>
              <div class="modal-body">
                
                <form class="form-horizontal" action="" method="POST">
              <div class="box-body">

                <div class="form-group">
                  <label for="departments" class="col-sm-3 control-label"> Location </label>

                  <div class="col-sm-9 <?php echo (!empty($village_name_err)) ? 'has-error' : ''; ?>">
                    <select name="sector_id" class="form-control" >
                      <option value=""> - </option>
                      <?php


                        $query = "SELECT * from sector ";
                        #echo $query;
                        $cells = mysql_query($query);
                        if($cells && mysql_num_rows($cells)>0){
                             #var_dump($cells);
                           while($cell = mysql_fetch_assoc($cells)){
                             #var_dump($cell);
                              echo "<option value='{$cell['sector_id']}'>" .$cell['sector_name']. "</option>";
                         }
                        }                       

                     ?>
                    </select>
                    <span class="help-block"><?php echo $sector_name_err; ?></span>
                  </div>
                </div> 

                <div class="form-group ">
                  <label for="school_name" class="col-sm-3 control-label"> Rehabilitation name </label>

                  <div class="col-sm-9 <?php echo (!empty($rehab_name_err)) ? 'has-error' : ''; ?>">
                    <input type="text" class="form-control" name="rehab">
                    <span class="help-block"><?php echo $rehab_name_err; ?></span>
                  </div>
              </div>

                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-default" data-dismiss="modal" >Cancel</button>
                <button type="submit" name="save_rehab" class="btn btn-info pull-right">Save</button>
              </div>
              <!-- /.box-footer -->
            </form>


              </div>
              
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

        <!-- edit modal -->





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
