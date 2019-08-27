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
$year_err = $ubudehe_err = $class_err = $f_name_err = $l_name_err = $gender_err = $province_name_err = $district_name_err = $sector_name_err = $cell_name_err = $village_name_err = $father_err = $mother_err = $department_name_err = $letter_err =  "";



// Add Student
if(isset($_POST['student'])){

  $Name=mysql_real_escape_string(strtoupper($_POST['fname']));
  $Surname=mysql_real_escape_string(ucfirst($_POST['lname']));
  $Gender=$_POST['gender'];
  $District=ucfirst($_POST['district']);
  $Sector=ucfirst($_POST['sector']);
  $Cell=ucfirst($_POST['cell']);
  $Village=ucfirst($_POST['village']);
  $Father=ucfirst($_POST['father']);
  $Fc=$_POST['father_contact'];
  $Mother=ucfirst($_POST['mother']);
  $Mc=$_POST['mother_contact'];
  $Village_id=$_POST['village'];
  $ubudehe = $_POST['ubudehe'];


  $check=mysql_query("SELECT *from students where Fname='$Name' && Lname='$Surname' && Father='$Father' && Mother='$Mother'");
  if(mysql_num_rows($check) != 1){
    mysql_query("INSERT INTO students values(null,'$Name','$Surname','$Gender','$Father','$Fc','$Mother','$Mc','$ubudehe','$Village_id','{$_POST['class']}')")or die(mysql_error());#,'7{$_FILES['upload']['name']}')");
    #move_uploaded_file($_FILES['upload']['tmp_name'],"c:\\xampp\\htdocs\\Pro\\Profile\\".$_FILES['upload']['name']);
    $echo="New student inserted !!!";
  }else{
    $echo="This student is already inserted !!!";
  }
}


if(@$_GET['act']=='drop' && is_numeric($_GET['st_id'])) {
  //var_dump($_GET);
  //var_dump($_SESSION);
  //check if the student allready left school
  $check = mysql_query("SELECT * FROM droped WHERE student_id='{$_GET['st_id']}' && `date` = '".(date("Y-m-d",time()))."' ");

  if($r = mysql_fetch_assoc($check)){
    mysql_query("UPDATE droped SET`date`='".(date("Y-m-d",time()))."', status=1, user_id='{$_SESSION['user_id']}' WHERE droped_id='{$r['droped_id']}'");
    echo "<span class=success>Student Left the School Again !!!</span>";
  } else{
    mysql_query("INSERT INTO droped SET student_id='{$_GET['st_id']}', `date`=NOW(), status=1, user_id='{$_SESSION['user_id']}'");
    echo  "<span class=success>Student left the school !!!</span>";
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

        Students
  
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Students</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <!-- Used DATA WE NEED  -->

        <div class="box">
            <div class="box-header">
              <h3 class="box-title">Students Features </h3>
              <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#modal-default">
                <i class="fa fa-plus"> </i> Add Students
              </button>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>First name</th>
                  <th>Last name</th>
                  <th>Gender</th>
                  <th>Class</th>
                  <th>Father</th>
                  <th>Mother</th>
                  <th>Action</th>
                  <th>Operation</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                       $data=mysql_query("select students.*,classes.*,depts.deptacronym from students,classes,depts where students.class_id=classes.class_id && classes.dept_id=depts.dept_id && depts.school_id='{$_SESSION['school_id']}'");
                       $students_in_class = array();
                          while($row=mysql_fetch_assoc($data))
                                $students_in_class[] = $row;
                              // echo "<pre>";
                              // print_r($students_in_class);
                           $i = 1; 
                          foreach ($students_in_class as $row) 
                          {
                            ?>
                            <tr>
                              <td><?php echo $i; ?></td>
                              <td><?php echo htmlentities($row['Fname']); ?></td>
                              <td><?php echo htmlentities($row['Lname']); ?></td>
                              <td><?php echo htmlentities($row['Gender']); ?></td>
                              <td><?php echo 'S'.$row['year'].' '.$row['deptacronym'];?></td>
                              <td><?php echo htmlentities($row['Father']); ?></td>                              
                              <td><?php echo htmlentities($row['Mother']); ?></td>                              
                              <td>

                                <a href="#edit_<?php echo $row['student_id']; ?>" class="btn btn-success btn-sm" data-toggle="modal"><span class="fa fa-edit"></span> Edit </a>
                                <a href="students.php?act=del_st&id=<?php echo $row['student_id']; ?>" class="btn btn-danger btn-sm" data-toggle="modal"><span class="fa fa-edit"></span> Delete </a>
                                <td>

                                <?php 
                                $st = mysql_query("SELECT * FROM droped where student_id = {$row['student_id']} && status = 1");

                                if(mysql_num_rows($st) > 0){
                                  ?>
                                   <a class="btn btn-danger btn-sm" data-toggle="modal"><span class="fa fa-trash"></span> Droped </a>
                                  <?php
                                }else{

                                ?>
                                  <a href="#delete_<?php echo $row['student_id']; ?>" class="btn btn-danger btn-sm" data-toggle="modal"><span class="fa fa-trash"></span> Drop </a>
                                  </td>

                                <?php
                                }
                                ?>


                              </td>                              
                              <?php include("./drop.php") ?>
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
                <h4 class="modal-title">Add Student </h4>
              </div>
              <div class="modal-body">
                
                <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
              <div class="box-body">

                <div class="form-group">
                  <label for="class" class="col-sm-3 control-label"> Class</label>

                  <div class="col-sm-9 <?php echo (!empty($class_err))?'has-error':''; ?> ">
                     <select name="class" required class="form-control">
                        <?php
                            $data=mysql_query($dd  = "SELECT classes.*,depts.deptacronym FROM classes,depts,schools WHERE classes.dept_id=depts.dept_id && depts.school_id=Schools.school_id && schools.user_id='{$_SESSION['user_id']}'")or die(mysql_error());
                            //echo $dd;

                            while($result=mysql_fetch_assoc($data)){
                            //var_dump($result);
                            echo "<option value='{$result['class_id']}' ".($result['class_id'] == $d['class_id']?"selected":"")." >".'S'.$result['year'].' '.$result['deptacronym'].' '.$result['letter']."</option>";
                            #$_SESSION['class_id']=$result['class_id'];
                            //($data['school_id'] == $sc['school_id'] || $sc['school_id'] == $_GET['school']?"selected":"")
                }
                ?>
                    </select>

                    <span class="help-block"><?php echo $class_err; ?></span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="fname" class="col-sm-3 control-label"> First Name </label>

                  <div class="col-sm-9 <?php echo (!empty($f_name_err)) ? 'has-error' : ''; ?>">
                    <input type="text" name="fname" required class="form-control"  placeholder="First Name">
                    <span class="help-block"><?php echo $f_name_err; ?></span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="lname" class="col-sm-3 control-label"> Last Name </label>

                  <div class="col-sm-9 <?php echo (!empty($l_name_err)) ? 'has-error' : ''; ?>">
                    <input type="text" name="lname" required class="form-control"  placeholder="Last Name">
                    <span class="help-block"><?php echo $l_name_err; ?></span>
                  </div>
                </div>


                <div class="form-group">
                  <label for="gender" class="col-sm-3 control-label"> Gender </label>

                  <div class="col-sm-9 <?php echo (!empty($gender_err)) ? 'has-error' : ''; ?>">
                    <select name="gender" required class="form-control">
                      <option value="" > - </option>
                      <option value="male"> Male</option>
                      <option value="female"> Female </option>
                    </select>
                    <span class="help-block"><?php echo $gender_err; ?></span>
                  </div>
                </div>                
 

                <div class="form-group">
                  <label for="district" class="col-sm-3 control-label"> District Name </label>

                  <div class="col-sm-9 <?php echo (!empty($district_name_err)) ? 'has-error' : ''; ?>">
                    <select name="district" required id="district" class="form-control" >
                      <option value=""> - </option>
                      <?php
                       $dis=mysql_query("select * from districts ");
                       while($res2=mysql_fetch_assoc($dis)){
                          echo "<option value='{$res2['district_id']}'>".$res2['district_name']."</option>";
                       }
                     ?>
                    </select>
                    <span class="help-block"><?php echo $district_name_err; ?></span>
                  </div>
                </div>


                <div class="form-group">
                  <label for="sector" class="col-sm-3 control-label"> Sector Name </label>

                  <div class="col-sm-9 <?php echo (!empty($sector_name_err)) ? 'has-error' : ''; ?>">
                    <select name="sector" required id="sector" class="form-control" >
                      <option value=""> - </option>
                    </select>
                    <span class="help-block"><?php echo $sector_name_err; ?></span>
                  </div>
                </div>


                <div class="form-group">
                  <label for="cell" class="col-sm-3 control-label"> Cell Name </label>

                  <div class="col-sm-9 <?php echo (!empty($cell_name_err)) ? 'has-error' : ''; ?>">
                    <select name="cell" required id="cell" class="form-control" >
                      <option value=""> - </option>
                    </select>
                    <span class="help-block"><?php echo $cell_name_err; ?></span>
                  </div>
                </div>                


                <div class="form-group">
                  <label for="village" class="col-sm-3 control-label"> Village Name </label>

                  <div class="col-sm-9 <?php echo (!empty($village_name_err)) ? 'has-error' : ''; ?>">
                    <select name="village"  required id="village" class="form-control" >
                      <option value=""> - </option>
                    </select>
                    <span class="help-block"><?php echo $village_name_err; ?></span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="father" class="col-sm-3 control-label"> Father </label>

                  <div class="col-sm-9 <?php echo (!empty($father_err)) ? 'has-error' : ''; ?>">
                    <input type="text" name="father" required class="form-control"  placeholder="father">
                    <span class="help-block"><?php echo $father_err; ?></span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="father" class="col-sm-3 control-label"> Father Contact </label>

                  <div class="col-sm-9 <?php echo (!empty($f_contact_err)) ? 'has-error' : ''; ?>">
                    <input type="text" name="father_contact" required class="form-control"  placeholder="father Contact">
                    <span class="help-block"><?php echo $father_err; ?></span>
                  </div>
                </div>


                <div class="form-group">
                  <label for="mother" class="col-sm-3 control-label"> Mother </label>

                  <div class="col-sm-9 <?php echo (!empty($mother_err)) ? 'has-error' : ''; ?>">
                    <input type="text" name="mother" required class="form-control"  placeholder="mother">
                    <span class="help-block"><?php echo $mother_err; ?></span>
                  </div>
                </div>


                <div class="form-group">
                  <label for="mother" class="col-sm-3 control-label"> Mother Contact </label>

                  <div class="col-sm-9 <?php echo (!empty($mother_err)) ? 'has-error' : ''; ?>">
                    <input type="text" name="mother_contact" required class="form-control"  placeholder="mother">
                    <span class="help-block"><?php echo $mother_err; ?></span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="ubudehe" class="col-sm-3 control-label"> UBUDEHE </label>

                  <div class="col-sm-9 <?php echo (!empty($ubudehe_err)) ? 'has-error' : ''; ?>">
                    <select  name="ubudehe" class="form-control"  required>
                      <option> - </option>
                       <option value="1"> 1 </option>
                       <option value="2"> 2 </option>
                       <option value="3"> 3 </option>
                       <option value="4"> 4 </option>
                    </select>
                    <span class="help-block"><?php echo $ubudehe_err; ?></span>
                  </div>
                </div>

                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-default" data-dismiss="modal" >Cancel</button>
                <button type="submit" name="student" class="btn btn-info pull-right">Save</button>
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
      'autoWidth'   : true
    })
  })




  $(document).ready(function(){

    $("#district").change(function(){

      //get id of a district

      var id = $(this).val();
      var dataString = 'id=' + id;

      $.ajax({
        type: 'POST',
        url: 'sectors.php',
        data: dataString,
        cashe: false,
        success: function(html){
          console.log(html);
          $("#sector").html(html);
        }
      });
    });


    $("#sector").change(function(){

      //get id of a sector

      var id = $(this).val();
      var dataString = 'id=' + id;

      $.ajax({
        type: 'POST',
        url: 'cells.php',
        data: dataString,
        cashe: false,
        success: function(html){
          console.log(html);
          $("#cell").append(html);
        }
      });
    });



    $("#cell").change(function(){

      //get id of a cell

      var id = $(this).val();
      var dataString = 'id=' + id;

      $.ajax({
        type: 'POST',
        url: 'villages.php',
        data: dataString,
        cashe: false,
        success: function(html){
          console.log(html);
          $("#village").append(html);
        }
      });
    });



  });
</script>
</body>
</html>
