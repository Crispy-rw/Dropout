<?php

mysql_connect("localhost","root","");
mysql_select_db("mine");

$id = $_POST['id'];

$res = mysql_query("SELECT * from cells WHERE cell_id = '{$id}'") or die(mysql_error());

?>

<?php

while ($row = mysql_fetch_array($res)) {

?>
    <option value="<?php echo htmlentities($row['cell_id']); ?>"> <?php  echo htmlentities($row['cellname']);  ?> </option>
<?php

}
?>