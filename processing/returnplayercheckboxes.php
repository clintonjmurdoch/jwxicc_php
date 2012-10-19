<?php
include("../connect.php");
$playerresult = mysql_query("select * from players where teamid = " . $_GET["team"]);
//echo "<table id=\"playertable\">";
while ($playerrow = mysql_fetch_array($playerresult)) {
	if ($playerrow["status"]==1) {
		$activereturn = "<input onClick=\"updateStatus(this.form.playerid.value,this.form.active.checked)\" type=\"checkbox\" name=\"active\" value=\"1\" CHECKED/>";
	}
	else {
		$activereturn = "<input onClick=\"updateStatus(this.form.playerid.value,this.form.active.checked)\" type=\"checkbox\" name=\"active\"/ value=\"1\">";
	} 
	echo "<form name=\"thisplayer\">";
	echo "<input name=\"playerid\" type=\"hidden\" value=\"" . $playerrow["playerid"] . "\"/>";
	echo "<div>";
	echo "<p>" . $playerrow["name"] . $activereturn . "</p>";
	echo "</div>";
	echo "</form>";
}
//echo "</table>";
?>
