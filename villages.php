<?php

mysql_connect("localhost","root","");
mysql_select_db("mine");

$id = $_POST['id'];

$res = mysql_query("SELECT * from villages WHERE village_id = '{$id}'") or die(mysql_error());
?>

<?php
while ($row = mysql_fetch_array($res)) {

?>

<option value="<?php echo htmlentities($row['village_id']); ?>"> <?php  echo htmlentities($row['villagename']);  ?> </option>

<?php
}
?>