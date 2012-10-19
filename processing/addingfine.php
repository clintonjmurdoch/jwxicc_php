<?php
include("../connect.php");
mysql_query("insert into fines values(null," . $_GET["player"] . "," . $_GET["match"] . ",'" . $_GET["reason"] . "',0)");
$playername = mysql_query("select name from players where playerid = " . $_GET["player"]);
$playerrow = mysql_fetch_array($playername);
echo "<tr><td>" . $playerrow["name"] . "</td><td>" . $_GET["reason"] . "</td><td>0</td></tr>";
?>
