<!-- Edit -->
<div class="modal fade" id="edit_<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Edit Rehabilitation Infromation</h4></center>
            </div>
            <div class="modal-body">
			<div class="container-fluid">
			<form method="POST" action="new_rehab.php?sehab=<?php echo $row['id']; ?>">

                <div class="form-group">
                  <label for="departments" class="col-sm-3 control-label"> Location </label>

                  <div class="col-sm-9 <?php echo (!empty($village_name_err)) ? 'has-error' : ''; ?>">
                    <input name="sector_id"  type="text" readonly="" value="<?php echo $row['sector_name'] ?>" class="form-control" >
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
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <button type="submit" name="update_rehab" class="btn btn-success"><span class="glyphicon glyphicon-check"></span> Update</a>
			</form>
            </div>

        </div>
    </div>
</div>




<!-- Add director of rehabilitation  -->
<div class="modal fade" id="edit2_<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Add Rehabilitation Info</h4></center>
            </div>
            <div class="modal-body">
            <div class="container-fluid">
            <form method="POST" action="new_rehab.php?rehab_id=<?php echo $row['id']; ?>">

                <div class="form-group">
                  <label for="departments" class="col-sm-3 control-label"> Location </label>

                  <div class="col-sm-9 <?php echo (!empty($village_name_err)) ? 'has-error' : ''; ?>">
                    <input name="sector_id"  type="text" readonly="" value="<?php echo $row['sector_name'] ?>" class="form-control" >
                    <span class="help-block"><?php echo $sector_name_err; ?></span>
                  </div>
                </div>

               <div class=" form-group">
                    <div class="col-sm-3">
                        <label class="control-label" style="position:relative; top:7px;"> Names :</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" required pattern="[A-Za-z]{2,10}" class="form-control" name="name" value="<?php echo @$_POST['name']; ?>">
                    </div>
                </div>

                <div class=" form-group">
                    <div class="col-sm-3">
                        <label class="control-label" style="position:relative; top:7px;"> Phone no :</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" required pattern="^07[2,3,8]{1}[0-9]{7}" class="form-control" name="phone" value="<?php echo @$_POST['phone']; ?>">
                    </div>
                </div>

                <div class=" form-group">
                    <div class="col-sm-3">
                        <label class="control-label" style="position:relative; top:7px;"> Identity no :</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" required pattern="[0-9]{16}" class="form-control" name="id" value="<?php echo @$_POST['id']; ?>">
                    </div>
                </div>

                <div class=" form-group">
                    <div class="col-sm-3">
                        <label class="control-label" style="position:relative; top:7px;"> Username :</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" required pattern="[a-z]{2,10}" name="user" value="<?php echo @$_POST['user']; ?>">
                    </div>
                </div>

                <div class=" form-group">
                    <div class="col-sm-3">
                        <label class="control-label" style="position:relative; top:7px;"> Password :</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" required name="pass" value="<?php echo @$_POST['pass']; ?>">
                    </div>
                </div>
                
            </div> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <button type="submit" name="rehab_add" class="btn btn-success"><span class="glyphicon glyphicon-check"></span> Update</a>
            </form>
            </div>

        </div>
    </div>
</div>








<!-- Delete -->
<div class="modal fade" id="delete_<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Remove Option Information </h4></center>
            </div>
            <div class="modal-body">	
            	<p class="text-center">Are you sure you want to Remove</p>
				<h2 class="text-center"><?php echo $row['name'] ?>]</h2>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <a href="new_rehab.php?id=<?php echo $row['id']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Yes</a>
            </div>

        </div>
    </div>
</div>