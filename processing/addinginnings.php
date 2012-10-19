<?php
include("../connect.php");

$match = $_GET['match'];
$team = $_GET['team'];
$pass = true;

$innsquery = "insert into innings values(" . $match . ", null, " . $team . ", null, null, null)";
if (!mysql_query($innsquery)) {
	echo 'insert of innings failed: ' . mysql_error();
	echo "<br/>";
	$pass = false;
}

$inningid = mysql_insert_id();
$sundquery = "insert into sundries (inningid) values (" . $inningid . ")";
if (!mysql_query($sundquery)) {
	echo 'insert of sundries failed: ' . mysql_error();
	$pass = false;
}

if ($pass) {
	echo "<meta http-equiv=\"refresh\" content=\"0;URL=../entermatchscores.php?match=" . $match . "\"/>";
}
?>