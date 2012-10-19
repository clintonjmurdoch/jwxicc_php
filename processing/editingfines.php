<?php
include("../connect.php");
$value = $_POST["paid"];
$fineid = $_POST["fineid"];
if (!$value) {
	$value = "0";
}
mysql_query("update fines set paid = " . $value . " where fineid = " . $fineid );
echo "<meta http-equiv=\"refresh\" content=\"0;URL=../editfines.php?match=" . $_POST["match"] . "\"/>"
?>
