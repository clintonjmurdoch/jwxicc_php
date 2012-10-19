<?php

session_start();
include("error_reporting.php");
include("connect.php");
$matchid = $_GET["match"];
$teamlist = mysql_query("select team1id, team2id from matches where matchid = " .$matchid);
$teamrow = mysql_fetch_array($teamlist);
$hometeamid = $teamrow["team1id"];
$awayteamid = $teamrow["team2id"];

//retrieve the innings ids - this will have to be changed to allow for 2 innings matches, if required in the future
$homeinningslist = mysql_query("select inningid from innings where matchid = " . $matchid . " and teamid = " . $hometeamid);
$homeinningsrow = mysql_fetch_array($homeinningslist);
$homeinnings = $homeinningsrow['inningid'];
$awayinningslist = mysql_query("select inningid from innings where matchid = " . $matchid . " and teamid = " . $awayteamid);
$awayinningsrow = mysql_fetch_array($awayinningslist);
$awayinnings = $awayinningsrow['inningid']; 

//retrieve the players in the match
$hometeamselectedlist = mysql_query("select * from players where playerid in (select playerid from selectedteams where matchid = " . $matchid . " and teamid = " . $hometeamid . ")");
$awayteamselectedlist = mysql_query("select * from players where playerid in (select playerid from selectedteams where matchid = " . $matchid . " and teamid = " . $awayteamid . ")");

//use the resultsets to create arrays
while ($hometeam = mysql_fetch_array($hometeamselectedlist)) {
	$id = $hometeam["playerid"];
	$name = $hometeam["name"];
	$hometeamarray[$id] = $name;
}

while ($awayteam = mysql_fetch_array($awayteamselectedlist)) {
	$id = $awayteam["playerid"];
	$name = $awayteam["name"];
	$awayteamarray[$id] = $name;
}

//sort the arrays
asort($hometeamarray);
asort($awayteamarray);

//get an array of dismissals to use in dropdown lists
$dismissals = mysql_query("select * from dismissals");
while ($dismissalsrow = mysql_fetch_array($dismissals)) {
	$id = $dismissalsrow["dismissalid"];
	$dismissal = $dismissalsrow["dismissal"];
	$dismissalsarray[$id] = $dismissal;
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Johnnie Walker XI - Enter Match Stats</title>
<!-- add your meta tags here -->

<link href="css/my_layout.css" rel="stylesheet" type="text/css" />
<!--[if lte IE 7]>
<link href="css/patches/patch_my_layout.css" rel="stylesheet" type="text/css" />
<![endif]-->
</head>
<body>
  <div class="page_margins">
    <div class="page">
      <div id="header">
        <div id="topnav">
          <!-- start: skip link navigation -->
          <a class="skip" title="skip link" href="#navigation">Skip to the navigation</a><span class="hideme">.</span>
          <a class="skip" title="skip link" href="#content">Skip to the content</a><span class="hideme">.</span>
          <!-- end: skip link navigation --><a href="login.php">Login</a> | <a href="contact.php">Contact</a> | <a href="suggestions.php">Suggestions</a>
        </div>
      </div>
      <div id="nav">
        <!-- skiplink anchor: navigation -->
        <a id="navigation" name="navigation"></a>
        <?php include("navbar.php"); ?>
      </div>
      <div id="main">
      <!-- HOME TEAM INNINGS BATTING SCORECARD -->
      <div class="battingcard">
      <form class="yform columnar" name="scores" id="scores" method="post" action="processing/nothingchanged.php">
      <!-- HOME TEAM START -->
      <fieldset>
      <legend>Home Team</legend>
      <div class="type-text"><label style="width:20%">Player</label><input type="text" disabled id="formheading" style="width:3.5em" value="Pos"/><input type="text" disabled id="formheading" value="Runs"/><input type="text" disabled id="formheading" value="Balls"/><input type="text" disabled id="formheading" value="4s"/><input type="text" disabled id="formheading" value="6s"/><input type="text" disabled id="formheading" style="width:10em" value="How Out"/><input type="text" disabled id="formheading" style="width:10em" value="Bowler"/><input type="text" disabled id="formheading" style="width:2em" value="O"/><input type="text" disabled id="formheading" style="width:2em" value="M"/><input type="text" disabled id="formheading" style="width:2em" value="R"/><input type="text" disabled id="formheading" style="width:2em" value="W"/><input type="text" disabled id="formheading" style="width:2em" value="Nb"/><input type="text" disabled id="formheading" style="width:2em" value="Wd"/></div>
        <?php
	foreach($hometeamarray as $k => $n) {
	  $pid = $k;
	  
	  $innsresultset = mysql_query("select * from playerinnings where playerid = " . $id . " and inningid = " . $homeinnings);
	  if ($innsrow = mysql_fetch_array($innsresultset)) {
	  	$runss = $innsrow["runs"];
	  	//etc
	  }
	  	  
	  echo '<div class="type-text type-select" id="div' . $pid . '">';
	  echo '<label style="width:20%" for="runss[' . $pid . ']">' . $n . '</label>';
	  echo '<select onChange="changed()" style="width:4em;margin-left:5px" name="batpos' . $pid . '" id="batpos[' . $pid . ']">';
	  echo '<option value=""></option>';
	  for($i=1;$i<12;$i++) {
	  	echo '<option value="' . $i . '">' . $i . '</option>';
	  }
	  echo '</select>';	  
	  echo '<input onChange="changed()" style="width:2em;margin-left:5px" type="text" maxlength="3" name="runss' . $pid . '" id="runss[' . $pid . ']"/>';
	  echo '<input onChange="changed()" style="width:2em;margin-left:5px" type="text" maxlength="3" name="balls' . $pid . '" id="balls[' . $pid . ']"/>';
	  echo '<input onChange="changed()" style="width:2em;margin-left:5px" type="text" maxlength="3" name="fours' . $pid . '" id="fours[' . $pid . ']"/>';
	  echo '<input onChange="changed()" style="width:2em;margin-left:5px" type="text" maxlength="3" name="sixes' . $pid . '" id="sixes[' . $pid . ']"/>';
	  echo '<select onChange="changed()" style="width:10em;margin-left:5px" name="howout' . $pid . '">';
	  echo '<option value=""></option>';
	  foreach($dismissalsarray as $key => $dismissal) {
	  	echo '<option value="' . $key . '">' . $dismissal. '</option>';
	  }
	  echo '</select>';
	  echo '<select onChange="changed()" style="width:10em;margin-left:5px" name="bowler' . $pid . '">';
	  echo '<option value=""></option>';
	  foreach($awayteamarray as $key => $name) {
	  	echo '<option value="' . $key . '">' . $name. '</option>';
	  }
	  echo '</select>';
	  echo '<input onChange="changed()" style="width:2em;margin-left:5px" type="text" maxlength="3" name="overs' . $pid . '" id="overs[' . $pid . ']"/>';
	  echo '<input onChange="changed()" style="width:2em;margin-left:5px" type="text" maxlength="3" name="maidens' . $pid . '" id="maidens[' . $pid . ']"/>';
	  echo '<input onChange="changed()" style="width:2em;margin-left:5px" type="text" maxlength="3" name="runs' . $pid . '" id="runs[' . $pid . ']"/>';
	  echo '<input onChange="changed()" style="width:2em;margin-left:5px" type="text" maxlength="3" name="wickets' . $pid . '" id="wickets[' . $pid . ']"/>';
	  echo '<input onChange="changed()" style="width:2em;margin-left:5px" type="text" maxlength="3" name="noballs' . $pid . '" id="noballs[' . $pid . ']"/>';
	  echo '<input onChange="changed()" style="width:2em;margin-left:5px" type="text" maxlength="3" name="wides' . $pid . '" id="wides[' . $pid . ']"/>';
	  echo '</div>';
	}
	?>
      </fieldset>
      <!-- END HOME TEAM -->
      <!-- AWAY TEAM -->
      <fieldset>
      <legend>Away Team</legend>
      <div class="type-text"><label style="width:20%">Player</label><input type="text" disabled id="formheading" style="width:3.5em" value="Pos"/><input type="text" disabled id="formheading" value="Runs"/><input type="text" disabled id="formheading" value="Balls"/><input type="text" disabled id="formheading" value="4s"/><input type="text" disabled id="formheading" value="6s"/><input type="text" disabled id="formheading" style="width:10em" value="How Out"/><input type="text" disabled id="formheading" style="width:10em" value="Bowler"/><input type="text" disabled id="formheading" style="width:2em" value="O"/><input type="text" disabled id="formheading" style="width:2em" value="M"/><input type="text" disabled id="formheading" style="width:2em" value="R"/><input type="text" disabled id="formheading" style="width:2em" value="W"/><input type="text" disabled id="formheading" style="width:2em" value="Nb"/><input type="text" disabled id="formheading" style="width:2em" value="Wd"/></div>
        <?php
	foreach($awayteamarray as $k => $n) {
	  $pid = $k;
	  echo '<div class="type-text type-select" id="div' . $pid . '">';
	  echo '<label style="width:20%" for="runss[' . $pid . ']">' . $n . '</label>';
	  echo '<select onChange="changed()" style="width:4em;margin-left:5px" name="batpos' . $pid . '" id="batpos[' . $pid . ']">';
	  echo '<option value=""></option>';
	  for($i=1;$i<12;$i++) {
	  	echo '<option value="' . $i . '">' . $i . '</option>';
	  }
	  echo '</select>';	  
	  echo '<input onChange="changed()" style="width:2em;margin-left:5px" type="text" maxlength="3" name="runss' . $pid . '" id="runss[' . $pid . ']"/>';
	  echo '<input onChange="changed()" style="width:2em;margin-left:5px" type="text" maxlength="3" name="balls' . $pid . '" id="balls[' . $pid . ']"/>';
	  echo '<input onChange="changed()" style="width:2em;margin-left:5px" type="text" maxlength="3" name="fours' . $pid . '" id="fours[' . $pid . ']"/>';
	  echo '<input onChange="changed()" style="width:2em;margin-left:5px" type="text" maxlength="3" name="sixes' . $pid . '" id="sixes[' . $pid . ']"/>';
	  echo '<select onChange="changed()" style="width:10em;margin-left:5px" name="howout' . $pid . '">';
	  echo '<option value=""></option>';
	  foreach($dismissalsarray as $key => $dismissal) {
	  	echo '<option value="' . $key . '">' . $dismissal. '</option>';
	  }
	  echo '</select>';
	  echo '<select onChange="changed()" style="width:10em;margin-left:5px" name="bowler' . $pid . '">';
	  echo '<option value=""></option>';
	  foreach($hometeamarray as $key => $name) {
	  	echo '<option value="' . $key . '">' . $name. '</option>';
	  }
	  echo '</select>';
	  echo '<input onChange="changed()" style="width:2em;margin-left:5px" type="text" maxlength="3" name="overs' . $pid . '" id="overs[' . $pid . ']"/>';
	  echo '<input onChange="changed()" style="width:2em;margin-left:5px" type="text" maxlength="3" name="maidens' . $pid . '" id="maidens[' . $pid . ']"/>';
	  echo '<input onChange="changed()" style="width:2em;margin-left:5px" type="text" maxlength="3" name="runs' . $pid . '" id="runs[' . $pid . ']"/>';
	  echo '<input onChange="changed()" style="width:2em;margin-left:5px" type="text" maxlength="3" name="wickets' . $pid . '" id="wickets[' . $pid . ']"/>';
	  echo '<input onChange="changed()" style="width:2em;margin-left:5px" type="text" maxlength="3" name="noballs' . $pid . '" id="noballs[' . $pid . ']"/>';
	  echo '<input onChange="changed()" style="width:2em;margin-left:5px" type="text" maxlength="3" name="wides' . $pid . '" id="wides[' . $pid . ']"/>';
	  echo '</div>';
	}
	?>
      </fieldset>
      <!-- END AWAY TEAM -->
      <?php //pass some variables in this form
      	echo '<input type="hidden" name="homeinnings" value="' . $homeinnings . '"/>';
      	echo '<input type="hidden" name="awayinnings" value="' . $awayinnings . '"/>';
      	echo '<input type="hidden" name="matchid" value="' . $matchid . '"/>';
      	echo '<input type="hidden" name="hometeam" value="' . $hometeamid . '"/>';
      	echo '<input type="hidden" name="awayteam" value="' . $awayteamid . '"/>';
      ?>
      <input type="checkbox" name="changecheck" id="changecheck"/>
      <input type="submit" value="Submit all results"/>
      <input type="button" value="test button" onClick="test()"/>
      </form>
      </div>
      </div>
      <!-- begin: #footer -->
      <div id="footer">Layout based on <a href="http://www.yaml.de/">YAML</a>
      </div>
    </div>
  </div>
</body>
</html>

<script type="text/javascript">
function test() {
	alert("null");
}

function changed() {
	document.getElementById("changecheck").checked=true;
	document.getElementById("changecheck").disabled=true;	
	document.getElementById("scores").action="processing/addingmatchstats.php";
}

function submitbutton() {

}

</script>
