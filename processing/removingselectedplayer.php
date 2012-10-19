<?php
include("../connect.php");
mysql_query("delete from selectedteams where teamid = " . $_GET["team"] . " and matchid = " . $_GET["match"] . " and playerid = " . $_GET["player"]);
echo "true";

?>
