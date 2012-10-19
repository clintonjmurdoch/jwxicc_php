<?php
session_start();
include("../connect.php");
$name = $_GET["name"];
$team = $_GET["team"];
$active = $_GET["active"];
mysql_query("insert into players values(null, '" . $name . "', " . $team . ", " . $active . ")");
$playerid = mysql_insert_id();
if ($team == 1) {
  mysql_query("insert into jwxiplayerinfo (playerid) values ('" . $playerid . "')");
}
if ($active==1) {
	$activereturn = "Active";
}
else {
	$activereturn = "Inactive";
} 
echo "<tr><td>" . $playerid . "</td><td>" . $_GET["name"] . "</td><td>" . $activereturn . "</td></tr>";
?>