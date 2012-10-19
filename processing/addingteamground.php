<?php
include("../connect.php");

$teamid = $_GET["team"];
$groundid = $_GET["ground"];

$teamresult = mysql_query("select * from teams where teamid = " . $teamid);
$teamrow = mysql_fetch_array($teamresult);

$groundcheckresult = mysql_query("select * from teamsgrounds where teamid = " . $teamid . " and groundid = " . $groundid);
if ($groundcheckrow = mysql_fetch_array($groundcheckresult)) {
echo "already added<br/>"; 
}
else {
mysql_query("insert into teamsgrounds values(" . $teamid . ", " . $groundid . ")");
echo $teamrow["name"] . "<br/>";
}
?>
