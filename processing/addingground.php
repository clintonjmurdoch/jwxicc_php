<?php
session_start();
include("../connect.php");
if ($_SESSION["admin"]!="1") {
	echo "<meta http-equiv=\"refresh\" content=\"0;URL=index.php\"/>";
}
$ground = $_POST["name"];
$address = $_POST["address"];
$suburb = $_POST["suburb"];
$postcode = $_POST["postcode"];
$melwayref = $_POST["melwayref"];
mysql_query("insert into grounds values(null, '" . $ground . "', '" . $address . "', '" . $suburb . "', " . $postcode . ", '" . $melwayref . "')");
$groundidresult = mysql_query("select max(groundid) as max from grounds");
$groundidrow = mysql_fetch_array($groundidresult);
$groundid = $groundidrow["max"];
echo "<meta http-equiv=\"refresh\" content=\"0;URL=../editground.php?ground=" . $groundid . "\"/>"
?>

