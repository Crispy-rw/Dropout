

<!-- Delete -->
<div class="modal fade" id="delete_<?php echo $row['transfer_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

        <form action="view_rehab_student.php?tid=<?php echo $row['transfer_id'];?>" method="POST">
         <div class="modal-body">
           <div class="container-fluid">

            <div class="modal-body">    
                <p class="text-center">Are you sure you want to Send to school</p>
                <h2 class="text-center"><?php echo $row['Fname'].' [ '.$row['Lname']; ?>]</h2>
            </div>


            <div class="row form-group">
                <div class="col-sm-3">
                    <label class="control-label" style="position:relative; top:7px;"> Comment:</label>
                </div>
                <div class="col-sm-8">
                    <textarea required="Field empty" maxlength="200" class="form-control" name="comment" ></textarea>
                </div>
            </div>
           </div> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <button type="submit" name="update" class="btn btn-success"><span class="glyphicon glyphicon-check"></span> Send Back</a>
            </div>
        </form>
        </div>
    </div>
</div>



