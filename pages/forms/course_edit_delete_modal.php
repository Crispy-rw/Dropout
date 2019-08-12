<!-- Edit -->
<div class="modal fade" id="edit_<?php echo $row->course_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Edit Department Infromation</h4></center>
            </div>
            <div class="modal-body">
			<div class="container-fluid">
			<form method="POST" action="course_edit.php?course_id=<?php echo $row->course_id; ?>">
				<div class="row form-group">
					<div class="col-sm-3">
						<label class="control-label" style="position:relative; top:7px;">Course Code:</label>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="course_id" value="<?php echo $row->course_id; ?>" readonly/>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-3">
						<label class="control-label" style="position:relative; top:7px;">Course Name:</label>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="course_name" value="<?php echo $row->course_name; ?>">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-3">
						<label class="control-label" style="position:relative; top:7px;">Department Code:</label>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="dept_id" value="<?php echo $row->dept_id; ?>" >
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-3">
						<label class="control-label" style="position:relative; top:7px;">Level Code:</label>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="level_id" value="<?php echo $row->level_id; ?>" >
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-3">
						<label class="control-label" style="position:relative; top:7px;">Lecture Code:</label>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="lect_id" value="<?php echo $row->lect_id; ?>" >
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-3">
						<label class="control-label" style="position:relative; top:7px;">Class Code:</label>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="class_id" value="<?php echo $row->class_id; ?>" >
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-3">
						<label class="control-label" style="position:relative; top:7px;">Room Code:</label>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="room_id" value="<?php echo $row->room_id; ?>" >
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-3">
						<label class="control-label" style="position:relative; top:7px;">Day:</label>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="day" value="<?php echo $row->day; ?>" >
					</div>
				</div>
				
				
            </div> 
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <button type="submit" name="edit" class="btn btn-success"><span class="glyphicon glyphicon-check"></span> Update</a>
			</form>
            </div>

        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete_<?php echo $row->course_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Delete Course Information </h4></center>
            </div>
            <div class="modal-body">	
            	<p class="text-center">Are you sure you want to Delete</p>
				<h2 class="text-center"><?php echo $row->course_name.' '.$row->course_id; ?></h2>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <a href="course_delete.php?course_id=<?php echo $row->course_id; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Yes</a>
            </div>

        </div>
    </div>
</div>