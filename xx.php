<?php
require_once 'config.php';
$id=$_POST['id'];
$ret="SELECT * from district WHERE province_id=$id";
$query= $conn -> prepare($ret);
$query-> execute();
$dist = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
{
?>

<option value="">Now Select District </option>
<?php
foreach($dist as $row) {?>
<option value="<?php echo htmlentities($row->id);?>"><?php echo htmlentities($row->name);?></option>
<?php }}} ?>






<script type="text/javascript">
$(document).ready(function()
{
$("#province").change(function()
{
var id=$(this).val();
var dataString = 'id='+ id;

$.ajax
({
type: "POST",
url: "district.php",
data: dataString,
cache: false,
success: function(html)
{
$("#district").html(html);
}
});
});
$("#district").change(function()
{
var id=$(this).val();
var dataString = 'id='+ id;

$.ajax
({
type: "POST",
url: "sector.php",
data: dataString,
cache: false,
success: function(html)
{
$("#sector").html(html);
}
});
});
});
</script>