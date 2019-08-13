<?php
// Initialize the session
session_start();
include "connect.php";
if ($_SESSION['usertype']!='rehab') {
  header("location:./logout.php");
  exit();
}
 

 
//FInd school imformation
$sql = "SELECT * from rehab where rehab.userId = '{$_SESSION['user_id']}' ";
$res = mysql_query($sql) or die(mysql_error());
$info = mysql_fetch_assoc($res);


 // Find school id and owner of the scholl
    $sql2=mysql_query($s = "select id from rehab where userId='{$_SESSION['user_id']}'")or die(mysql_error());
    //echo $s;
      if(mysql_num_rows($sql2) == 1){
        while($row=mysql_fetch_assoc($sql2)){
    // var_dump($row);
          $_SESSION['rehab_id']=$row['id'];
        }
     } else{
       echo "<script>alert('No Rehab Information Found'); window.location='./logout.php'</script>";
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

if(isset($_POST['save_student'])){





  $start=$_POST['start'];
  $end=$_POST['end'];
  $drop_id=$_GET['drop_id'];
  // var_dump($_REQUEST); die;
  
    //seacrh dept for comparison
  $dept_query = mysql_query("INSERT INTO transfer VALUES(null,'$drop_id','$start','$end','{$_SESSION['rehab_id']}',0)");

  if($dept_query){
   
   echo "Student Reveived";

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

        <li>
          <a href="rehab_dashboard.php">
            <i class="fa fa-dashboard"></i> <span> Dashboard</span>
          </a>
          
        </li>
        
        <li >
          <a href="request.php">
            <i class="fa fa-edit"></i> <span> Request </span>
          </a>
        </li>        

          
        <li >
          <a href="view_rehab_student.php">
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
                  <td>Name</td>
                  <td>Surname</td>
                  <td>Father</td>
                  <td>Mother</td>
                  <td>Village</td>
                  <td>Cell</td>
                  <td>Sector</td>
                  <td>District</td>
                  <td>Date</td>
                  <td>Operation</td>
                </tr>
                </thead>
                <tbody>
                  <?php
                       $drops = array();
                       $sq=mysql_query($s ="SELECT droped.*,students.*,villages.villagename,cells.cellname,sector.sector_name, districts.district_name 
                                             FROM droped, students, villages, cells,sector,districts, classes, depts, schools WHERE 
                                             droped.student_id=students.student_id && 
                                             students.village_id=villages.village_id && 
                                             villages.cell_id=cells.cell_id && 
                                             cells.sector_id=sector.sector_id && 
                                             students.class_id = classes.class_id &&
                                             classes.dept_id = depts.dept_id &&
                                             depts.school_id = schools.school_id &&
                                             droped.status = 1 &&
                                             sector.district_id=districts.district_id && droped.droped_id NOT IN(SELECT transfer.drop_id from transfer WHERE status = 0 )")or die(mysql_error());
                          while($row=mysql_fetch_assoc($sq))
                                $drops[] = $row;

                           $i = 1; 
                          foreach ($drops as $row) 
                          {
                            ?>
                            <tr>
                              <td><?php echo $row['droped_id'];?></td>
                              <td><?php echo $row['Fname'];?></td>
                              <td><?php echo $row['Lname'];?></td>
                              <td><?php echo $row['Father'];?></td>
                              <td><?php echo $row['Mother'];?></td>
                              <td><?php echo $row['villagename'];?></td>
                              <td><?php echo $row['cellname'];?></td>
                              <td><?php echo $row['sector_name'];?></td>
                              <td><?php echo $row['district_name'];?></td>
                              <td><?php echo $row['date'];?></td>
                              <td><a href="#edit_<?php echo $row['droped_id']; ?>" class="btn btn-success btn-sm" data-toggle="modal"><span class="fa fa-edit "></span> Accept </a></td>
                              <?php
                              include('./add_request.php');
                              ?>
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
                    <select name="departments" class="form-control" >
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
                    <select name="year" class="form-control"  placeholder="Combination Code">
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
