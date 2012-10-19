<?php
include("../connect.php");
if ($_GET["status"]=="true") {
	$status="1";
}
else {
	$status="0";
}
$playerid = $_GET["playerid"];
mysql_query("update players set status=" . $status . " where playerid=" . $playerid);
$playerres = mysql_query("select name from players where playerid = " . $playerid);
$playerrow = mysql_fetch_array($playerres);
$playername = $playerrow["name"];
echo $playername . " updated";
?>
