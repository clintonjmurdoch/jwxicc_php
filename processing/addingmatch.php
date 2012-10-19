<?php
include("../connect.php");
$comp = $_POST["competition"];
$season = $_POST["season"];
$round = $_POST["round"];
$team1 = $_POST["team1"];
$team2 = $_POST["team2"];
$ground = $_POST["ground"];
$month = $_POST["month"];
$day = $_POST["day"];
if ($month<7) {
	$year = substr($season,5,4);
}
else {
	$year = substr($season,0,4);
}
$date = $year . "-" . $month . "-" . $day . " 13:00:00";
mysql_query("insert into matches values(null," . $comp . ",'" . $season . "',". $round . "," . $team1 . "," . $team2 . "," . $ground . ",'" . $date . "',null)");
echo "<meta http-equiv=\"refresh\" content=\"0;URL=../matches.php?seasonselect=" . substr($season,0,4) . "%2F" . substr($season,5,4) . "\"/>"
?>
