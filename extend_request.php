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
                
                <input type="submit" name="extend_date" class="btn btn-success" value="UPDATE">
            </form>
            </div>

        </div>
    </div>
</div>