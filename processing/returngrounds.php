<?php
include("../connect.php");
$teamid = $_GET["team"];
$grounds = mysql_query("select grounds.groundid as groundid, grounds.name as name from teamsgrounds natural join grounds where teamid = " . $teamid . " order by groundid");
while ($groundrow = mysql_fetch_array($grounds)) {
	echo "<option value=\"" . $groundrow["groundid"] . "\">" . $groundrow["name"] . "</option>";
}
?>
