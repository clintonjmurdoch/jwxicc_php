<?php
//TO UPDATE:
//Bowling data is not read from the database and added to bowling figures
//Add sundries - table exists
//Try using javascript to show catch/run out stuff when appropriate, otherwise put it on another page
//

session_start();
include("error_reporting.php");
include("connect.php");
$matchid = $_GET["match"];
$teamlist = mysql_query("select team1id, team2id from matches where matchid = " .$matchid);
$teamrow = mysql_fetch_array($teamlist);
$hometeam = $teamrow["team1id"];
$awayteam = $teamrow["team2id"];
$hometeamid = $hometeam;
$awayteamid = $awayteam;

//RETRIEVE THE PLAYERS SELECTED IN THE MATCH SEPARATED BY WHETHER THEY ALREADY HAVE RESULTS ENTERED
$hometeaminningslist = mysql_query("select players.name, inningslist.* from players inner join inningslist on players.playerid = inningslist.playerid inner join innings on inningslist.inningid=innings.inningid inner join matches on innings.matchid = matches.matchid where players.playerid in (select playerid from selectedteams where matchid = " . $matchid . " and teamid = " . $hometeam . ") and matches.matchid=" . $matchid . " order by isnull(batpos), batpos");
$hometeamselectedlist = mysql_query("select * from players where playerid in (select playerid from selectedteams where matchid = " . $matchid . " and teamid = " . $hometeam . " ) and playerid not in (select playerid from inningslist inner join innings on inningslist.inningid=innings.inningid inner join matches on innings.matchid=matches.matchid where matches.matchid = " . $matchid . " and teamid = " . $hometeam . ")");
$awayteaminningslist = mysql_query("select players.name, inningslist.* from players inner join inningslist on players.playerid = inningslist.playerid inner join innings on inningslist.inningid=innings.inningid inner join matches on innings.matchid = matches.matchid where players.playerid in (select playerid from selectedteams where matchid = " . $matchid . " and teamid = " . $awayteam . ") and matches.matchid=" . $matchid . " order by isnull(batpos), batpos");
$awayteamselectedlist = mysql_query("select * from players where playerid in (select playerid from selectedteams where matchid = " . $matchid . " and teamid = " . $awayteam . " ) and playerid not in (select playerid from inningslist inner join innings on inningslist.inningid=innings.inningid inner join matches on innings.matchid=matches.matchid where matches.matchid = " . $matchid . " and teamid = " . $awayteam . ")");

//RETRIEVE THE INNINGS IDS
$homeinningslist = mysql_query("select inningid from innings where matchid = " . $matchid . " and teamid = " . $hometeam);
$homeinningsrow = mysql_fetch_array($homeinningslist);
$homeinnings = $homeinningsrow['inningid'];
$awayinningslist = mysql_query("select inningid from innings where matchid = " . $matchid . " and teamid = " . $awayteam);
$awayinningsrow = mysql_fetch_array($awayinningslist);
$awayinnings = $awayinningsrow['inningid']; 

//COMBINE THE RESULTS FROM ABOVE INTO 1 ARRAY
while ($hometeam = mysql_fetch_array($hometeaminningslist)) {
	$id = $hometeam["playerid"];
	$name = $hometeam["name"];
	$hometeamarray[$id] = $name;
}

while ($hometeam = mysql_fetch_array($hometeamselectedlist)) {
	$id = $hometeam["playerid"];
	$name = $hometeam["name"];
	$hometeamarray[$id] = $name;
}

while ($awayteam = mysql_fetch_array($awayteaminningslist)) {
	$id = $awayteam["playerid"];
	$name = $awayteam["name"];
	$awayteamarray[$id] = $name;
}

while ($awayteam = mysql_fetch_array($awayteamselectedlist)) {
	$id = $awayteam["playerid"];
	$name = $awayteam["name"];
	$awayteamarray[$id] = $name;
}

asort($hometeamarray);
asort($awayteamarray);

//RESET THE RESULTSETS FOR USE LATER
if (mysql_num_rows($hometeaminningslist) != 0) {
  mysql_data_seek($hometeaminningslist,0);
}
if (mysql_num_rows($hometeamselectedlist) != 0) {
  mysql_data_seek($hometeamselectedlist,0);
}
if (mysql_num_rows($awayteaminningslist) != 0) {
  mysql_data_seek($awayteaminningslist,0);
}
if (mysql_num_rows($awayteamselectedlist) != 0) {
  mysql_data_seek($awayteamselectedlist,0);
}

//DISMISSALS
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
      <form class="yform columnar" name="scores" id="scores" method="post" action="processing/addingmatchstats.php">
      <!-- HOME TEAM START -->
      <fieldset>
      <legend>Home Team</legend>
      <div class="type-text"><label style="width:20%">Player</label><input type="text" disabled id="formheading" style="width:3.5em" value="Pos"/><input type="text" disabled id="formheading" value="Runs"/><input type="text" disabled id="formheading" value="Balls"/><input type="text" disabled id="formheading" value="4s"/><input type="text" disabled id="formheading" value="6s"/><input type="text" disabled id="formheading" style="width:10em" value="How Out"/><input type="text" disabled id="formheading" style="width:10em" value="Bowler"/><input type="text" disabled id="formheading" style="width:2em" value="O"/><input type="text" disabled id="formheading" style="width:2em" value="M"/><input type="text" disabled id="formheading" style="width:2em" value="R"/><input type="text" disabled id="formheading" style="width:2em" value="W"/><input type="text" disabled id="formheading" style="width:2em" value="Nb"/><input type="text" disabled id="formheading" style="width:2em" value="Wd"/></div>
        <?php
	while ($hometeaminningsrow = mysql_fetch_array($hometeaminningslist)) {
	  $pid = $hometeaminningsrow['playerid'];
	  $hometeamarray[$pid] = $hometeaminningsrow['name'];
	  echo '<div class="type-text type-select">';
	  echo '<label style="width:20%" for="runs[' . $pid . ']">' . $hometeaminningsrow['name'] . '</label>';
	  echo '<select style="width:4em;margin-left:5px" name="batpos' . $pid . '" id="batpos[' . $pid . ']">';
	  $batpos = $awayteaminningsrow['batpos'];
	  echo '<option value=""></option>';
	  for($i=1;$i<$batpos;$i++) {
	  	echo '<option value="' . $i . '">' . $i . '</option>';
	  }
	  echo '<option value="' . $batpos . '" selected>' . $batpos . '</option>';
	  for($i=$batpos+1;$i<=12;$i++) {
	  	echo '<option value="' . $i . '">' . $i . '</option>';
	  }
	  echo '</select>';	  
	  echo '<input style="width:2em;margin-left:5px" type="text" maxlength="3" name="runss' . $pid . '" id="runss[' . $pid . ']" value="' . $hometeaminningsrow['score'] . '"/>';
	  echo '<input style="width:2em;margin-left:5px" type="text" maxlength="3" name="balls' . $pid . '" id="balls[' . $pid . ']"/>';
	  echo '<input style="width:2em;margin-left:5px" type="text" maxlength="3" name="fours' . $pid . '" id="fours[' . $pid . ']"/>';
	  echo '<input style="width:2em;margin-left:5px" type="text" maxlength="3" name="sixes' . $pid . '" id="sixes[' . $pid . ']"/>';
	  echo '<select style="width:10em;margin-left:5px" name="howout' . $pid . '" onChange="showCatcher(' . $pid . ')">';
	  echo '<option value=""></option>';
	  foreach($dismissalsarray as $key => $dismissal) {
	  	if ($key == $hometeaminningsrow['howout']) {
	  		echo '<option value="' . $key . '" selected>' . $dismissal. '</option>';
	  	}
	  	else {
	  		echo '<option value="' . $key . '">' . $dismissal. '</option>';
	  	}
	  }
	  echo '</select>';
	  echo '<select style="width:10em;margin-left:5px" name="bowler' . $pid . '">';
	  echo '<option value=""></option>';
	  foreach($awayteamarray as $key => $name) {
	  	if ($key == $hometeaminningsrow['bowler']) {
	  		echo '<option value="' . $key . '" selected>' . $name. '</option>';
	  	}
	  	else {
	  		echo '<option value="' . $key . '">' . $name. '</option>';
	  	}
	  }
	  echo '</select>';
	  echo '<input style="width:2em;margin-left:5px" type="text" maxlength="3" name="overs' . $pid . '" id="overs[' . $pid . ']"/>';
	  echo '<input style="width:2em;margin-left:5px" type="text" maxlength="3" name="maidens' . $pid . '" id="maidens[' . $pid . ']"/>';
	  echo '<input style="width:2em;margin-left:5px" type="text" maxlength="3" name="runs' . $pid . '" id="runs[' . $pid . ']"/>';
	  echo '<input style="width:2em;margin-left:5px" type="text" maxlength="3" name="wickets' . $pid . '" id="wickets[' . $pid . ']"/>';
	  echo '<input style="width:2em;margin-left:5px" type="text" maxlength="3" name="noballs' . $pid . '" id="noballs[' . $pid . ']"/>';
	  echo '<input style="width:2em;margin-left:5px" type="text" maxlength="3" name="wides' . $pid . '" id="wides[' . $pid . ']"/>';
	  echo '</div>';
	}
	while ($hometeamselectedrow = mysql_fetch_array($hometeamselectedlist)) {
	  $pid = $hometeamselectedrow['playerid'];
	  $hometeamarray[$pid] = $hometeamselectedrow['name'];
	  echo '<div class="type-text type-select">';
	  echo '<label style="width:20%" for="runs[' . $pid . ']">' . $hometeamselectedrow['name'] . '</label>';
	  echo '<select style="width:4em;margin-left:5px" name="batpos' . $pid . '" id="batpos[' . $pid . ']">';
	  echo '<option value=""></option>';
	  for($i=1;$i<=12;$i++) {
	  	echo '<option value="' . $i . '">' . $i . '</option>';
	  }
	  echo '</select>';	  
	  echo '<input style="width:2em;margin-left:5px" type="text" maxlength="3" name="runss' . $pid . '" id="runss[' . $pid . ']"/>';
	  echo '<input style="width:2em;margin-left:5px" type="text" maxlength="3" name="balls' . $pid . '" id="balls[' . $pid . ']"/>';
	  echo '<input style="width:2em;margin-left:5px" type="text" maxlength="3" name="fours' . $pid . '" id="fours[' . $pid . ']"/>';
	  echo '<input style="width:2em;margin-left:5px" type="text" maxlength="3" name="sixes' . $pid . '" id="sixes[' . $pid . ']"/>';
	  echo '<select style="width:10em;margin-left:5px" name="howout' . $pid . '" onChange="showCatcher(' . $pid . ')">';
	  echo '<option value=""></option>';
	  foreach($dismissalsarray as $key => $dismissal) {
	  	echo '<option value="' . $key . '">' . $dismissal. '</option>';
	  }
	  echo '</select>';
	  echo '<select style="width:10em;margin-left:5px" name="bowler' . $pid . '">';
	  echo '<option value=""></option>';
	  foreach($awayteamarray as $key => $name) {
	  	echo '<option value="' . $key . '">' . $name. '</option>';
	  }
	  echo '</select>';
	  echo '<input style="width:2em;margin-left:5px" type="text" maxlength="3" name="overs' . $pid . '" id="overs[' . $pid . ']"/>';
	  echo '<input style="width:2em;margin-left:5px" type="text" maxlength="3" name="maidens' . $pid . '" id="maidens[' . $pid . ']"/>';
	  echo '<input style="width:2em;margin-left:5px" type="text" maxlength="3" name="runs' . $pid . '" id="runs[' . $pid . ']"/>';
	  echo '<input style="width:2em;margin-left:5px" type="text" maxlength="3" name="wickets' . $pid . '" id="wickets[' . $pid . ']"/>';
	  echo '<input style="width:2em;margin-left:5px" type="text" maxlength="3" name="noballs' . $pid . '" id="noballs[' . $pid . ']"/>';
	  echo '<input style="width:2em;margin-left:5px" type="text" maxlength="3" name="wides' . $pid . '" id="wides[' . $pid . ']"/>';
	  echo '</div>';
	}?>
      </fieldset>
      <!-- END HOME TEAM -->
      <!-- AWAY TEAM -->
      <fieldset>
      <legend>Away Team</legend>
      <div class="type-text"><label style="width:20%">Player</label><input type="text" disabled id="formheading" style="width:3.5em" value="Pos"/><input type="text" disabled id="formheading" value="Runs"/><input type="text" disabled id="formheading" value="Balls"/><input type="text" disabled id="formheading" value="4s"/><input type="text" disabled id="formheading" value="6s"/><input type="text" disabled id="formheading" style="width:10em" value="How Out"/><input type="text" disabled id="formheading" style="width:10em" value="Bowler"/><input type="text" disabled id="formheading" style="width:2em" value="O"/><input type="text" disabled id="formheading" style="width:2em" value="M"/><input type="text" disabled id="formheading" style="width:2em" value="R"/><input type="text" disabled id="formheading" style="width:2em" value="W"/><input type="text" disabled id="formheading" style="width:2em" value="Nb"/><input type="text" disabled id="formheading" style="width:2em" value="Wd"/></div>
        <?php
	while ($awayteaminningsrow = mysql_fetch_array($awayteaminningslist)) {
	  $pid = $awayteaminningsrow['playerid'];
	  $awayteamarray[$pid] = $awayteaminningsrow['name'];
	  echo '<div class="type-text type-select">';
	  echo '<label style="width:20%" for="runs[' . $pid . ']">' . $awayteaminningsrow['name'] . '</label>';
	  echo '<select style="width:4em;margin-left:5px" name="batpos' . $pid . '" id="batpos[' . $pid . ']">';
	  $batpos = $awayteaminningsrow['batpos'];
	  echo '<option value=""></option>';
	  for($i=1;$i<$batpos;$i++) {
	  	echo '<option value="' . $i . '">' . $i . '</option>';
	  }
	  echo '<option value="' . $batpos . '" selected>' . $batpos . '</option>';
	  for($i=$batpos+1;$i<=12;$i++) {
	  	echo '<option value="' . $i . '">' . $i . '</option>';
	  }
	  echo '</select>';
	  echo '<input style="width:2em;margin-left:5px" type="text" maxlength="3" name="runss' . $pid . '" id="runss[' . $pid . ']" value="' . $awayteaminningsrow['score'] . '"/>';
	  echo '<input style="width:2em;margin-left:5px" type="text" maxlength="3" name="balls' . $pid . '" id="balls[' . $pid . ']" value="' . $awayteaminningsrow['balls'] . '"/>';
	  echo '<input style="width:2em;margin-left:5px" type="text" maxlength="3" name="fours' . $pid . '" id="fours[' . $pid . ']" value="' . $awayteaminningsrow['fours'] . '"/>';
	  echo '<input style="width:2em;margin-left:5px" type="text" maxlength="3" name="sixes' . $pid . '" id="sixes[' . $pid . ']" value="' . $awayteaminningsrow['sixes'] . '"/>';
	  echo '<select style="width:10em;margin-left:5px" name="howout' . $pid . '" onChange="showCatcher(' . $pid . ')">';
	  echo '<option value=""></option>';
	  foreach($dismissalsarray as $key => $dismissal) {
	  	if ($key == $awayteaminningsrow['howout']) {
	  		echo '<option value="' . $key . '" selected>' . $dismissal. '</option>';
	  	}
	  	else {
	  		echo '<option value="' . $key . '">' . $dismissal. '</option>';
	  	}
	  }
	  echo '</select>';
	  echo '<select style="width:10em;margin-left:5px" name="bowler' . $pid . '">';
	  echo '<option value=""></option>';
	  foreach($hometeamarray as $key => $name) {
	  	if ($key == $awayteaminningsrow['bowler']) {
	  		echo '<option value="' . $key . '" selected>' . $name. '</option>';
	  	}
	  	else {
	  		echo '<option value="' . $key . '">' . $name. '</option>';
	  	}
	  }
	  echo '</select>';
	  echo '<input style="width:2em;margin-left:5px" type="text" maxlength="3" name="overs' . $pid . '" id="overs[' . $pid . ']"/>';
	  echo '<input style="width:2em;margin-left:5px" type="text" maxlength="3" name="maidens' . $pid . '" id="maidens[' . $pid . ']"/>';
	  echo '<input style="width:2em;margin-left:5px" type="text" maxlength="3" name="runs' . $pid . '" id="runs[' . $pid . ']"/>';
	  echo '<input style="width:2em;margin-left:5px" type="text" maxlength="3" name="wickets' . $pid . '" id="wickets[' . $pid . ']"/>';
	  echo '<input style="width:2em;margin-left:5px" type="text" maxlength="3" name="noballs' . $pid . '" id="noballs[' . $pid . ']"/>';
	  echo '<input style="width:2em;margin-left:5px" type="text" maxlength="3" name="wides' . $pid . '" id="wides[' . $pid . ']"/>';
	  echo '</div>';
	}
	while ($awayteamselectedrow = mysql_fetch_array($awayteamselectedlist)) {
	  $pid = $awayteamselectedrow['playerid'];
	  $awayteamarray[$pid] = $awayteamselectedrow['name'];
	  echo '<div class="type-text type-select">';
	  echo '<label style="width:20%" for="runs[' . $pid . ']">' . $awayteamselectedrow['name'] . '</label>';
	  echo '<select style="width:4em;margin-left:5px" name="batpos' . $pid . '" id="batpos[' . $pid . ']">';
	  echo '<option value=""></option>';
	  for($i=1;$i<=12;$i++) {
	  	echo '<option value="' . $i . '">' . $i . '</option>';
	  }
	  echo '</select>';
	  echo '<input style="width:2em;margin-left:5px" type="text" maxlength="3" name="runss' . $pid . '" id="runss[' . $pid . ']"/>';
	  echo '<input style="width:2em;margin-left:5px" type="text" maxlength="3" name="balls' . $pid . '" id="balls[' . $pid . ']"/>';
	  echo '<input style="width:2em;margin-left:5px" type="text" maxlength="3" name="fours' . $pid . '" id="fours[' . $pid . ']"/>';
	  echo '<input style="width:2em;margin-left:5px" type="text" maxlength="3" name="sixes' . $pid . '" id="sixes[' . $pid . ']"/>';
	  echo '<select style="width:10em;margin-left:5px" name="howout' . $pid . '" onChange="showCatcher(' . $pid . ')">';
	  echo '<option value=""></option>';
	  foreach($dismissalsarray as $key => $dismissal) {
	  	echo '<option value="' . $key . '">' . $dismissal. '</option>';
	  }
	  echo '</select>';
	  echo '<select style="width:10em;margin-left:5px" name="bowler' . $pid . '">';
	  echo '<option value=""></option>';
	  foreach($hometeamarray as $key => $name) {
	  	echo '<option value="' . $key . '">' . $name. '</option>';
	  }
	  echo '</select>';
	  echo '<input style="width:2em;margin-left:5px" type="text" maxlength="3" name="overs' . $pid . '" id="overs[' . $pid . ']"/>';
	  echo '<input style="width:2em;margin-left:5px" type="text" maxlength="3" name="maidens' . $pid . '" id="maidens[' . $pid . ']"/>';
	  echo '<input style="width:2em;margin-left:5px" type="text" maxlength="3" name="runs' . $pid . '" id="runs[' . $pid . ']"/>';
	  echo '<input style="width:2em;margin-left:5px" type="text" maxlength="3" name="wickets' . $pid . '" id="wickets[' . $pid . ']"/>';
	  echo '<input style="width:2em;margin-left:5px" type="text" maxlength="3" name="noballs' . $pid . '" id="noballs[' . $pid . ']"/>';
	  echo '<input style="width:2em;margin-left:5px" type="text" maxlength="3" name="wides' . $pid . '" id="wides[' . $pid . ']"/>';
	  echo '</div>';
	}?>
      </fieldset>
      <!-- END AWAY TEAM -->
      <?php //pass some variables in this form
      	echo '<input type="hidden" name="homeinnings" value="' . $homeinnings . '"/>';
      	echo '<input type="hidden" name="awayinnings" value="' . $awayinnings . '"/>';
      	echo '<input type="hidden" name="matchid" value="' . $matchid . '"/>';
      	echo '<input type="hidden" name="hometeam" value="' . $hometeamid . '"/>';
      	echo '<input type="hidden" name="awayteam" value="' . $awayteamid . '"/>';
      ?>
      <input type="submit" value="Submit all results">
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
function onChange(pid) {

}

</script>