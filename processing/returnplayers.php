<?php
include("../connect.php");
$playerresult = mysql_query("select * from players where teamid = " . $_GET["team"] . " order by playerid desc");
echo "<table id=\"playertable\">";
while ($playerrow = mysql_fetch_array($playerresult)) {
	if ($playerrow["status"]==1) {
		$activereturn = "Active";
	}
	else {
		$activereturn = "Inactive";
	} 
	echo "<tr><td>" . $playerrow['playerid'] . "</td><td>" . $playerrow["name"] . "</td><td>" . $activereturn . "</td></tr>";
}
echo "</table>";
?>