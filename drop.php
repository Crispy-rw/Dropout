     <div class="modal fade" id="edit_<?php echo $row['student_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Student </h4>
              </div>
              <div class="modal-body">
                 
                <form class="form-horizontal" action="students.php?update_id=<?php echo $row['student_id'];?>" method="POST">
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
                    <input type="text" name="fname" required class="form-control" value="<?php echo $row['Fname']; ?>"  placeholder="First Name">
                    <span class="help-block"><?php echo $f_name_err; ?></span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="lname" class="col-sm-3 control-label"> Last Name </label>

                  <div class="col-sm-9 <?php echo (!empty($l_name_err)) ? 'has-error' : ''; ?>">
                    <input type="text" name="lname" required class="form-control" value="<?php echo $row['Lname']?>"  placeholder="Last Name">
                    <span class="help-block"><?php echo $l_name_err; ?></span>
                  </div>
                </div>


                <div class="form-group">
                  <label for="gender" class="col-sm-3 control-label"> Gender </label>

                  <div class="col-sm-9 <?php echo (!empty($gender_err)) ? 'has-error' : ''; ?>">
                    <select name="gender" required class="form-control">
                      <option value="" > - </option>
                      <option <?php echo $row['Gender'] == 'male'?'selected':''; ?> value="male"> Male</option>
                      <option <?php echo $row['Gender'] == 'female'?'selected':''; ?> value="female"> Female </option>
                    </select>
                    <span class="help-block"><?php echo $gender_err; ?></span>
                  </div>
                </div>                

                <div class="form-group">
                  <label for="father" class="col-sm-3 control-label"> Father </label>

                  <div class="col-sm-9 <?php echo (!empty($father_err)) ? 'has-error' : ''; ?>">
                    <input type="text" name="father" value="<?php echo $row['Father'];?>" required class="form-control"  placeholder="father">
                    <span class="help-block"><?php echo $father_err; ?></span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="father" class="col-sm-3 control-label"> Father Contact </label>

                  <div class="col-sm-9 <?php echo (!empty($f_contact_err)) ? 'has-error' : ''; ?>">
                    <input type="text" name="father_contact" value="<?php echo $row['Fathercontact']?>" required class="form-control"  placeholder="father Contact">
                    <span class="help-block"><?php echo $father_err; ?></span>
                  </div>
                </div>


                <div class="form-group">
                  <label for="mother" class="col-sm-3 control-label"> Mother </label>

                  <div class="col-sm-9 <?php echo (!empty($mother_err)) ? 'has-error' : ''; ?>">
                    <input type="text" name="mother" required class="form-control" value="<?php echo $row['Mother'];?>"  placeholder="mother">
                    <span class="help-block"><?php echo $mother_err; ?></span>
                  </div>
                </div>


                <div class="form-group">
                  <label for="mother" class="col-sm-3 control-label"> Mother Contact </label>

                  <div class="col-sm-9 <?php echo (!empty($mother_err)) ? 'has-error' : ''; ?>">
                    <input type="text" value="<?php echo$row['Mothercontact'] ?>" name="mother_contact" required class="form-control"  placeholder="mother">
                    <span class="help-block"><?php echo $mother_err; ?></span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="ubudehe" class="col-sm-3 control-label"> UBUDEHE </label>

                  <div class="col-sm-9 <?php echo (!empty($ubudehe_err)) ? 'has-error' : ''; ?>">
                    <select  name="ubudehe" required class="form-control"  required>
                      <option value=""> - </option>
                       <option <?php echo ($row['ubudehe'] == '1')?'selected':'' ?> value="1"> 1 </option>
                       <option <?php echo ($row['ubudehe'] == '2')?'selected':'' ?> value="2"> 2 </option>
                       <option <?php echo ($row['ubudehe'] == '3')?'selected':'' ?> value="3"> 3 </option>
                       <option <?php echo ($row['ubudehe'] == '4')?'selected':'' ?> value="4"> 4 </option>
                    </select>
                    <span class="help-block"><?php echo $ubudehe_err; ?></span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="mother" class="col-sm-3 control-label"> Behavior </label>

                  <div class="col-sm-9 <?php echo (!empty($behavior_err)) ? 'has-error' : ''; ?>">
                    <textarea name="behavior" required  class="form-control"   maxlength="99" placeholder="Enter Students Behavior"><?php echo trim($row['behaviour']);?></textarea>
                    <span class="help-block"><?php echo $behavior_err; ?></span>
                  </div>
                </div>
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-default" data-dismiss="modal" >Cancel</button>
                <button type="submit" name="update_student" class="btn btn-info pull-right">Save</button>
              </div>
              <!-- /.box-footer -->
            </form>


              </div>
              
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
      </div>





<div class="modal fade" id="edit2_<?php echo $row['student_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Drop out Option </h4></center>
            </div>
            <div class="modal-body">	
            	<p class="text-center">Are you sure you want to Drop</p>
				      <h2 class="text-center"><?php echo $row['Fname'].' '.$row['Lname']; ?></h2>
           </div>

            <form method="POST" action="students.php?act=drop&st_id=<?php echo $row['student_id']; ?>" >
              
                <div class="form-group">
                  <label for="ubudehe" class="col-sm-3 control-label"> Type </label>

                  <div class="col-sm-9 <?php echo (!empty($type_err)) ? 'has-error' : ''; ?>">
                    <select  name="type" class="form-control" required>
                      <option> - </option>
                       <option value="behavior"> behavior </option>
                       <option value="Drug Addiction"> Drug Addiction </option>
                       <option value="poverty"> poverty </option>
                       <option value="prostitution"> prostitution </option>
                    </select>
                    <span class="help-block"><?php echo $type_err; ?></span>
                  </div>
                </div>

               <div class="form-group">
                  <label for="mother" class="col-sm-3 control-label"> Reason </label>

                  <div class="col-sm-9 <?php echo (!empty($reason_err)) ? 'has-error' : ''; ?>">
                    <textarea name="reason" required="/^[A-Za-z]{100}/" class="form-control"   maxlength="99" placeholder="Enter Students Behavior">
                    </textarea>
                    <span class="help-block"><?php echo $type_err; ?></span>
                  </div>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Yes</button>
            </div>
            </form>


        </div>
    </div>
</div>