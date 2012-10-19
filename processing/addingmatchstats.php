<?php
//Bowling information needs to be set to insert/update for existing information
//Everything else looks to be working deliciously

include("../error_reporting.php");
include("../connect.php");

$homeinnings = $_POST['homeinnings'];
$awayinnings = $_POST['awayinnings'];
$matchid = $_POST['matchid'];
$hometeam = $_POST['hometeam'];
$awayteam = $_POST['awayteam'];

//GET THE SELECTED TEAMS
$hometeamlist = mysql_query("select playerid from selectedteams where matchid = " . $matchid . " and teamid = " . $hometeam);
$awayteamlist = mysql_query("select playerid from selectedteams where matchid = " . $matchid . " and teamid = " . $awayteam);

//DONT FORGET TO CHANGE THIS SO AS IT WILL DELETE ITEMS FROM THE TABLE IF THEY ARE ALREADY THERE - IE UPDATING INFORMATION RATHER THAN CREATING NEW INFORMATION

while($hometeamrow = mysql_fetch_array($hometeamlist)) {
	$pid = $hometeamrow['playerid'];
	
	//BATTING INFORMATION USES HOME INNINGS ID
	$batpos = $_POST['batpos' . $pid];
	if (!is_numeric($batpos)) {
		$batpos = 'null'; }
	$runss = $_POST['runss' . $pid];
	if (!is_numeric($runss)) {
		$runss = 'null'; }
	$balls = $_POST['balls' . $pid];
	if (!is_numeric($balls)) {
		$balls = 'null'; }
	$fours = $_POST['fours' . $pid];
	if (!is_numeric($fours)) {
		$fours = 'null'; }
	$sixes = $_POST['sixes' . $pid];
	if (!is_numeric($sixes)) {
		$sixes = 'null'; }
	$howout = $_POST['howout' . $pid];
	if (!is_numeric($howout)) {
		$howout = 'null'; }
	$bowler = $_POST['bowler' . $pid];
	if (!is_numeric($bowler)) {
		$bowler = 'null'; }
		
	$countset = mysql_query("select playerinningid from playerinnings where playerid = " . $pid . " and inningid = " . $homeinnings);
	$count = mysql_num_rows($countset);
	$countrow = mysql_fetch_array($countset);

	if ($count != 0) {
		$playerinningid = $countrow["playerinningid"];
		$q = "update playerinnings set batpos = " . $batpos . ", howout = " . $howout . ", bowler = " . $bowler . ", score = " . $runss . ", balls = " . $balls . ", fours = " . $fours . ", sixes = " . $sixes . " where playerinningid = " . $playerinningid;
	}
	else {		
		$q = "insert into playerinnings values(null, " . $pid . ", " . $homeinnings . ", " . $batpos . ", " . $howout . ", " . $bowler . ", " . $runss . ", " . $balls . ", " . $fours . ", " . $sixes . ")";
	}
	if (mysql_query($q)) {
		echo "successful: "; }
	else {
		echo "fail on player number " . $pid . ": " . mysql_error() . ": "; }
	echo $q . "<br/>";
	
	//BOWLING INFORMATION USES AWAY INNINGS ID
	$overs = $_POST['overs' . $pid];
	if (is_numeric($overs)) {
		//IF THERE ARE NO OVERS ENTERED THEN NO OTHER INFORMATION IS USED
		$maidens = $_POST['maidens' . $pid];
		if (!is_numeric($maidens)) {
			$maidens = '0'; }
		$bruns = $_POST['runs' . $pid];
		if (!is_numeric($bruns)) {
			$bruns = '0'; }
		$wickets = $_POST['wickets' . $pid];
		if (!is_numeric($wickets)) {
			$wickets = '0'; }
		$noballs = $_POST['noballs' . $pid];
		if (!is_numeric($noballs)) {
			$noballs = '0'; }
		$wides = $_POST['wides' . $pid];
		if (!is_numeric($wides)) {
			$wides = '0'; }
			
		
		$q = "insert into bowling values(" . $awayinnings . ", " . $pid . ", " . $overs . ", " . $maidens . ", " . $bruns . ", " . $wickets . ", " . $noballs . ", " . $wides . ")";
		if (mysql_query($q)) {
			echo "successful: "; }
		else {
			echo "fail on player number " . $pid . ": " . mysql_error() . ": "; }
		echo $q . "<br/>";
	}
}

while($awayteamrow = mysql_fetch_array($awayteamlist)) {
	$pid = $awayteamrow['playerid'];
	
	//BATTING INFORMATION USES AWAY INNINGS ID
	$batpos = $_POST['batpos' . $pid];
	if (!is_numeric($batpos)) {
		$batpos = 'null'; }
	$runs = $_POST['runss' . $pid];
	if (!is_numeric($runss)) {
		$runss = 'null'; }
	$balls = $_POST['balls' . $pid];
	if (!is_numeric($balls)) {
		$balls = 'null'; }
	$fours = $_POST['fours' . $pid];
	if (!is_numeric($fours)) {
		$fours = 'null'; }
	$sixes = $_POST['sixes' . $pid];
	if (!is_numeric($sixes)) {
		$sixes = 'null'; }
	$howout = $_POST['howout' . $pid];
	if (!is_numeric($howout)) {
		$howout = 'null'; }
	$bowler = $_POST['bowler' . $pid];
	if (!is_numeric($bowler)) {
		$bowler = 'null'; }
		
	$countset = mysql_query("select playerinningid from playerinnings where playerid = " . $pid . " and inningid = " . $awayinnings);
	$count = mysql_num_rows($countset);
	$countrow = mysql_fetch_array($countset);

	if ($count != 0) {
		$playerinningid = $countrow["playerinningid"];
		$q = "update playerinnings set batpos = " . $batpos . ", howout = " . $howout . ", bowler = " . $bowler . ", score = " . $runss . ", balls = " . $balls . ", fours = " . $fours . ", sixes = " . $sixes . " where playerinningid = " . $playerinningid;
	}
	else {		
		$q = "insert into playerinnings values(null, " . $pid . ", " . $awayinnings . ", " . $batpos . ", " . $howout . ", " . $bowler . ", " . $runss . ", " . $balls . ", " . $fours . ", " . $sixes . ")";
	}
	if (mysql_query($q)) {
		echo "successful: "; }
	else {
		echo "fail on player number " . $pid . ": " . mysql_error() . ": "; }
	echo $q . "<br/>";
	
	//BOWLING INFORMATION USES HOME INNINGS ID
	$overs = $_POST['overs' . $pid];
	if (is_numeric($overs)) {
		//IF THERE ARE NO OVERS ENTERED THEN NO OTHER INFORMATION IS USED
		$maidens = $_POST['maidens' . $pid];
		if (!is_numeric($maidens)) {
			$maidens = '0'; }
		$bruns = $_POST['runs' . $pid];
		if (!is_numeric($bruns)) {
			$bruns = '0'; }
		$wickets = $_POST['wickets' . $pid];
		if (!is_numeric($wickets)) {
			$wickets = '0'; }
		$noballs = $_POST['noballs' . $pid];
		if (!is_numeric($noballs)) {
			$noballs = '0'; }
		$wides = $_POST['wides' . $pid];
		if (!is_numeric($wides)) {
			$wides = '0'; }
		$q = "insert into bowling values(" . $homeinnings . ", " . $pid . ", " . $overs . ", " . $maidens . ", " . $bruns . ", " . $wickets . ", " . $noballs . ", " . $wides . ")";
		if (mysql_query($q)) {
			echo "successful: "; }
		else {
			echo "fail on player number " . $pid . ": " . mysql_error() . ": "; }
		echo $q . "<br/>";
	}	
	
}

?>