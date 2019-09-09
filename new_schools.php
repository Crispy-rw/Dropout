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

//  Remove director of a specific schools
if(isset($_GET['act']) == 'delete_dir'){

  $dir_id = $_GET['id'];

  $dir_sql = "UPDATE schools SET `user_id` = '1' WHERE `school_id` = '{$dir_id}' ";

  $update_dir = mysql_query($dir_sql) or die(mysql_error());

  if ($update_dir) {
    echo "Director Removed Successfully";
  }else{
    echo "Protocol Error";
  }

}


// Remove schools
// if ($_GET['delete_sch'] && is_numeric($_GET['sch_id'])) {
//   $chk = mysql_query("SELECT * from students WHERE school_id = '' ") or die(mysql_error());
// }


//save the school information

if(isset($_POST['save_school'])){
  //check the village information

  if(!empty($_POST['school_name'])){
    
    if(is_numeric($_POST['cell_id'])){
      //save the school information
      $check = mysql_query("SELECT * FROM schools WHERE school_name='".mysql_real_escape_string(trim($_POST['school_name']))."' && Village_id='{$_POST['cell_id']}'");
      if(mysql_num_rows($check) == 0){
        if(mysql_query("INSERT INTO schools SET school_name='".mysql_real_escape_string(trim($_POST['school_name']))."', Village_id='{$_POST['cell_id']}', user_id=1") or die(mysql_error())){
          echo  "<br />School Successfully Registered!";
          unset($_POST);
        } else
          echo " <br />Error While Saving School ";
      } else{
        echo " <br />School Name Already Exists ";
      }
    }
  } else{
    echo "<br />Empty School Name!";
  }

}


if(isset($_POST['save_dir'])){


  $name = $_POST['name'];
  $phone = $_POST['phone'];
  $id = $_POST['id'];
  $user = $_POST['user'];
  $pass = $_POST['pass'];
  $sec_id = $_GET['dir'];


  //save executive information
  $sql = "INSERT into users VALUES(null,'{$user}','{$pass}','{$name}','{$phone}','{$id}','user')";

  $res = mysql_query($sql) or die(mysql_errno());

  $user_id = mysql_insert_id();

  unset($res);

  if(is_numeric($user_id)){

    $update = "UPDATE schools SET user_id = '{$user_id}' WHERE school_id = {$sec_id}";
    
    $res = mysql_query($update) or die(mysql_error());

    if ($res) {
      
      echo "Headmaster has been set";

    }


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
              <h3 class="box-title">School Features </h3>
              <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#modal-default">
                <i class="fa fa-plus"> </i> Add School
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
                  <td>Droped</td>
                  <td colspan="2">Operations</td>
                </tr>
                </thead>
                <tbody>
                  <?php
                     $sql=mysql_query("SELECT schools.*, users.user_id, users.names, users.Usertype, districts.district_name, sector.sector_name from schools,users,villages, cells, sector, districts WHERE schools.user_id=users.user_id && schools.village_id=villages.village_id && villages.cell_id=cells.cell_id && cells.sector_id=sector.sector_id && sector.district_id=districts.district_id order by school_id")or die(mysql_error());
        #var_dump($sql); echo mysql_num_rows($sql);
                     $data = array();
                     while($row=mysql_fetch_assoc($sql))
                        $data[] = $row;

                           $i = 1; 
                     foreach ($data as $row) {
                     $query = mysql_query("SELECT droped.* FROM droped, students, classes,depts, schools WHERE
                                           droped.student_id = students.student_id &&
                                           students.class_id = classes.class_id &&
                                           classes.dept_id = depts.dept_id &&
                                           depts.school_id = schools.school_id &&
                                           droped.status = 1 &&
                                           schools.school_id = '{$row['school_id']}'")or die(mysql_error());
                 ?>
               <tr>
                <td><?php echo $row['school_id'];?></td>
                <td><?php echo $row['school_name'];?></td>
                <td><?php echo $row['district_name']."-".$row['sector_name'];?></td>
                <td>
                  <?php echo $row['Usertype'] == "administrator"?"<a class='btn btn-success btn-sm' data-toggle='modal' href='#edit_{$row['school_id']}'>Set Director</a>":$row['names']."<a onclick='return confirm(\"Do you want to delete this Director?\");' href='./new_schools.php?act=delete_dir&id={$row['school_id']}'> X </a>" ;?>
                    
                  </td>
                  <?php $num = mysql_num_rows($query); ?>
                <td><?php if($num>0){ ?><a target="_blank" href='print_1.php?school_id=<?php echo $row['school_id'] ?>&user_id=<?php echo $row['user_id'] ?>'><?php echo $num; echo " student".($num>1?"s":"") ?></a><?php } else{ echo "None";} ?></td>
                <td><a href="new_schools.php?act=delete_sch&sch_id=<?php echo $row['school_id'] ?>" class="btn btn-danger btn-sm">Remove schools</a></td>   
                <?php include('./add_director.php'); ?>             
               </tr>
              <?php
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
                <h4 class="modal-title">Add school </h4>
              </div>
              <div class="modal-body">
                
                <form class="form-horizontal" action="" method="POST">
              <div class="box-body">

                <div class="form-group">
                  <label for="departments" class="col-sm-3 control-label"> Village Name </label>

                  <div class="col-sm-9 <?php echo (!empty($village_name_err)) ? 'has-error' : ''; ?>">
                    <select name="cell_id" class="form-control" >
                      <option value=""> - </option>
                      <?php


                        $query = "select cells.cellname, villages.village_id, villages.villagename from villages, cells, sector WHERE cells.cell_id=villages.village_id && sector.sector_id=cells.sector_id order by cells.cellname asc; ";
                        #echo $query;
                        $cells = mysql_query($query);
                        if($cells && mysql_num_rows($cells)>0){
                             #var_dump($cells);
                           while($cell = mysql_fetch_assoc($cells)){
                             #var_dump($cell);
                              echo "<option value='{$cell['village_id']}'>".$cell['villagename']."(".$cell['cellname'].")</option>";
                         }
                        }                       

                     ?>
                    </select>
                    <span class="help-block"><?php echo $village_name_err; ?></span>
                  </div>
                </div> 

                <div class="form-group ">
                  <label for="school_name" class="col-sm-3 control-label"> School name </label>

                  <div class="col-sm-9 <?php echo (!empty($school_name_err)) ? 'has-error' : ''; ?>">
                    <input type="text" required pattern="[A-Za-z ]{1,15}" class="form-control" name="school_name">
                    <span class="help-block"><?php echo $school_name_err; ?></span>
                  </div>
              </div>

                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-default" data-dismiss="modal" >Cancel</button>
                <button type="submit" name="save_school" class="btn btn-info pull-right">Save</button>
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
