<!-- Edit -->
<div class="modal fade" id="edit_<?php echo $row['transfer_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Extend date Infromation</h4></center>
            </div>
            <div class="modal-body">
            <div class="container-fluid">
            <form method="POST" action="view_rehab_student.php?ext_id=<?php echo $row['tr ansfer_id'];?>">
                <div class="row form-group">
                    <div class="col-sm-3">
                        <label class="control-label" style="position:relative; top:7px;">Starting Date:</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" name="start" readonly value="<?php echo $row['start_date'];?>"/>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-sm-3">
                        <label class="control-label" style="position:relative; top:7px;">End Date:</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" name="end_ext" value="<?php echo $row['end_date'];?>" >
                    </div>
                </div>
                
            </div> 
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <button type="submit" name="extend_date" class="btn btn-success" > Update </button>
            </form>
            </div>

        </div>
    </div>
</div>


<!-- Delete -->
<div class="modal fade" id="delete_<?php echo $row['transfer_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Remove Option Information </h4></center>
            </div>
            <div class="modal-body">	
            	<p class="text-center">Are you sure you want to Send to school</p>
				<h2 class="text-center"><?php echo $row['Fname'].' [ '.$row['Lname']; ?>]</h2>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <a href="view_rehab_student.php?tid=<?php echo $row['transfer_id']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Yes</a>
            </div>

        </div>
    </div>
</div>



