<?php
// Initialize the session
session_start();
include "connect.php";
if ($_SESSION['usertype']!='user') {
  header("location:./logout.php");
  exit();
}
 

 
//FInd school imformation
$sql = "SELECT schools.* from schools where schools.user_id = '{$_SESSION['user_id']}' ";
$res = mysql_query($sql) or die(mysql_error());
$info = mysql_fetch_assoc($res);


 // Find school id and owner of the scholl
    $sql=mysql_query($s = "select school_id from schools where user_id='{$_SESSION['user_id']}'")or die(mysql_error());
    //echo $s;
      if(mysql_num_rows($sql) == 1){
        while($row=mysql_fetch_assoc($sql)){
    // var_dump($row);
          $_SESSION['school_id']=$row['school_id'];
        }
     } else{
       echo "<script>alert('No School Information Found'); window.location='./logout.php'</script>";
     }


// Define variables and initialize with empty values
$year_err = $department_name_err = $letter_err =  "";



//Delete Class
if(@$_GET['act']=='delete_class' && is_numeric($_GET['id'])){
  if(mysql_query("DELETE FROM classes where class_id='{$_GET['id']}'")){
    $tbc="Class deleted !!!";
  }else{
    $tbc="Error while deleting !!!";
  }
}



// Add Class

if(isset($_POST['save_class'])){


  if(empty(trim($_POST['departments']))) {
    $department_name_err = "Please department name should not be empty";
  }

  if (empty(trim($_POST['year']))) {
    $year_err = "Please class should not be empty";
  }


  if(empty($department_name_err) && empty($year_err)){

  $depart=$_POST['departments'];
  $year=$_POST['year'];
  $letter=strtoupper($_POST['letter']);
  //var_dump($_POST); die;
  
    $cla=mysql_query("select * from classes where year=$year && letter='$letter' && dept_id={$depart}")or die(mysql_error());
    if(mysql_num_rows($cla) != 0){
      $ecla="This class is already exists !!!";
    }else{
      //seacrh dept for comparison
      $dept_query = mysql_query("SELECT * FROM depts WHERE dept_id ='{$depart}'");
      $dept_info = mysql_fetch_assoc($dept_query);
      if($dept_info['deptacronym'] == "OLC"  && $year >3){
        $ecla="Invalid Class Level!!!";
      }
      else if($dept_info['deptacronym'] != "P"  && $year <4){
        $ecla="Invalid Class Level!!!";
      } else{
        mysql_query("INSERT INTO classes values(null,'$year','$letter','{$depart}')");
        $ecla="New class inserted !!!";
      }
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
                   <a href="../../logout.php" class="btn btn-default btn-flat">Sign out</a>
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
          <p><?php echo $info['school_name'] ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
     
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="dashboard2.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
          
        </li>
        
        <li >
          <a href="option.php">
            <i class="fa fa-edit"></i> <span> Options </span>
          </a>
        </li>        

          
        <li >
          <a href="class.php">
            <i class="fa fa-edit"></i> <span> Classes </span>
          </a>
        </li>

        <li >
          <a href="students.php">
            <i class="fa fa-edit"></i> <span> Students </span>
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
              <h3 class="box-title">Department Features </h3>
              <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#modal-default">
                <i class="fa fa-plus"> </i> Add Class
              </button>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Option Name</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                       $data=mysql_query("SELECT * FROM depts where school_id IN (select school_id from schools where user_id='{$_SESSION['user_id']}')")or die(mysql_error());
                       $depts = array();
                         while($result=mysql_fetch_assoc($data))
                           $depts[] = $result;

                           $i = 1; 
                          foreach ($depts as $row) 
                          {
                            ?>
                            <tr>
                              <td><?php echo $i; ?></td>
                              <td><?php echo htmlentities($row['deptname']); ?></td>
                              <td>
                                
                                <?php
                                   //select all classes inm the dept
                                   $c_query = mysql_query("SELECT * FROM classes WHERE dept_id='{$row['dept_id']}'");
                                   while($r = mysql_fetch_assoc($c_query)){
                                         echo ($result['deptacronym'] == "P"?"P":"S").$r['year'] ." ".($row['deptacronym'] == "OLC" || $row['deptacronym'] == "P"?"":$row['deptacronym'])." ".$r['letter']." <sup><a onclick='return confirm(\"Do you want to delete this class?\");' href='./class.php?act=delete_class&id={$r['class_id']}'>X</a></sup> | ";
                                   }
                                 ?>


                              </td>
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
                <h4 class="modal-title">Add Class </h4>
              </div>
              <div class="modal-body">
                
                <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
              <div class="box-body">

                <div class="form-group">
                  <label for="departments" class="col-sm-3 control-label"> Department Name </label>

                  <div class="col-sm-9 <?php echo (!empty($department_name_err)) ? 'has-error' : ''; ?>">
                    <select name="departments" required class="form-control" >
                      <option value=""> - </option>
                      <?php
                       $dept=mysql_query("select * from depts where school_id='{$_SESSION['school_id']}'");
                       while($res=mysql_fetch_assoc($dept)){
                          echo "<option value='{$res['dept_id']}'>".$res['deptacronym']."</option>";
                          $_SESSION['dept_id']=$res['dept_id'];
                       }
                     ?>
                    </select>
                    <span class="help-block"><?php echo $department_name_err; ?></span>
                  </div>
                </div> 

                <div class="form-group ">
                  <label for="year" class="col-sm-3 control-label"> Year </label>

                  <div class="col-sm-9 <?php echo (!empty($year_err)) ? 'has-error' : ''; ?>">
                    <select name="year" required class="form-control"  placeholder="Combination Code">
                      <option value=""> - </option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                    </select>  
                    <span class="help-block"><?php echo $year_err; ?></span>
                  </div>
              </div>


                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label"> Letter (Ex:B) </label>

                  <div class="col-sm-9 <?php echo (!empty($letter_err)) ? 'has-error' : ''; ?>">
                    <input type="text" name="letter" class="form-control"  placeholder="Letter">
                    <span class="help-block"><?php echo $letter_err; ?></span>
                  </div>
                </div>



                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-default" data-dismiss="modal" >Cancel</button>
                <button type="submit" name="save_class" class="btn btn-info pull-right">Save</button>
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
