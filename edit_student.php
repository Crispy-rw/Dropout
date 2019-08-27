     <div class="modal fade" id="edit_<?php echo $row['student_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Student </h4>
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
                    <input type="text" name="fname"  required class="form-control"  placeholder="First Name">
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