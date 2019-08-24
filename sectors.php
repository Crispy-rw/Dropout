<?php

mysql_connect("localhost","root","");
mysql_select_db("mine");

$id = $_POST['id'];

$res = mysql_query("SELECT * from sector WHERE sector_id = '{$id}'") or die(mysql_error());
?>
<option> - </option>
<?php
while ($row = mysql_fetch_array($res)) {

?>

<option value="<?php echo htmlentities($row['sector_id']); ?>"> <?php  echo htmlentities($row['sector_name']);  ?> </option>

<?php
}
?>