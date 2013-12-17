<?php
include("../connect.php");
$teamid = mysql_real_escape_string($_GET["team"]);
$matchid = mysql_real_escape_string($_GET["match"]);
$playerid = mysql_real_escape_string($_GET["player"]);

mysql_query("delete from selectedteams where teamid = " . $teamid . " and matchid = " . $matchid . " and playerid = " . $playerid);
echo "true";

?>
