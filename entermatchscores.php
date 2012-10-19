<?php
session_start();
if ($_SESSION["admin"]!="1") {
	echo "<meta http-equiv=\"refresh\" content=\"0;URL=index.php\"/>";
}

include('connect.php');

$matchid = $_GET['match'];
$matchset = mysql_query('select * from matches m inner join competitions c on m.competition = c.competitionid where matchid  = ' . $matchid);
$matchrow = mysql_fetch_array($matchset);

$team1id = $matchrow['team1id'];
$team2id = $matchrow['team2id'];
$inningsset = mysql_query('select * from innings where matchid = ' . $matchid);

$team1set = mysql_query('select name from teams where teamid = ' . $team1id);
$team1row = mysql_fetch_array($team1set);
$team1 = $team1row['name'];

$team2set = mysql_query('select name from teams where teamid = ' . $team2id);
$team2row = mysql_fetch_array($team2set);
$team2 = $team2row['name'];

$groundset = mysql_query('select name from grounds where groundid = ' . $matchrow['groundid']);
$groundrow = mysql_fetch_array($groundset);
$ground = $groundrow['name'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Enter Match Results and Innings Scores</title>
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
      <div style="width:600px; margin-left:auto; margin-right:auto">
      	<div id="matchinfo">
      	  <?php
      	  echo '<div class="note" style="text-align:center">';
      	  echo '<p>Competition: ' . $matchrow['association'] . ' ' . $matchrow['grade'] . '</p>';  
      	  echo '<p>Season: ' . $matchrow['season'] . ', Round: ' . $matchrow['round'] . '</p>';
      	  echo '<p>Match between ' . $team1 . ' and ' . $team2 . ' played at ' . $ground . '</p>';
      	  echo '</div>';
      	  ?>
      	</div>
      	<div id=innings">
      	  <?php
      	  if (mysql_num_rows($inningsset) == 0) {
      	  	echo '<p id="inningsheader">There are no innings added to this match yet.</p><table id="inningstable"></table>';
      	  }
      	  else {
      	  	echo '<p id="inningsheader">Innings already added to this match:</p>';
      	  	echo '<table id="inningstable">';
      	  	while ($inningsrow = mysql_fetch_array($inningsset)) {
      	  	  echo '<form id="inningsform' . $inningsrow['inningid'] . '" class=yform">';
      	  	  //Assign team name to innings without another DB lookup
      	  	  if ($matchrow['team1id'] == $inningsrow['teamid']) {
      	  	  	$teamname = $team1;
      	  	  }
      	  	  else {
      	  	  	$teamname = $team2;
      	  	  }
      	  	  echo '<tr><td>Innings id: ' . $inningsrow['inningid'] . '</td><td>Team: ' . $teamname;
      	  	  echo '</td><td>Score: ';
      	  	  echo '<input type="text" onkeypress="makecross(' . $inningsrow['inningid'] . ')" name="wicketslost" id="wicketslost' . $inningsrow['inningid'] . '" size="1.5" maxlength="2" value="' . $inningsrow['wicketslost'] . '"/>';
      	  	  echo '/';
      	  	  echo '<input type="text" onkeypress="makecross(' . $inningsrow['inningid'] . ')" name="runs" id="runs' . $inningsrow['inningid'] . '" size="2" maxlength="3" value="' . $inningsrow['score'] . '"/>';
      	  	  echo '</td><td>Innings order: <select onchange="makecross(' . $inningsrow['inningid'] . ')" id="inningofmatch' . $inningsrow['inningid'] . '" name="inningofmatch">';
      	  	  
      	  	  for($i=1;$i<=4;$i++) {
      	  	  	if ($i == $inningsrow['inningofmatch']) {
      	  	  	  echo '<option value="' . $i . '" selected>' . $i . '</option>';
      	  	  	}
      	  	  	else {
      	  	  	  echo '<option value="' . $i . '">' . $i . '</option>';
      	  	  	}
      	  	  } 

      	  	  echo '</select></td>';
      	  	  echo '<td id="tdimg' . $inningsrow['inningid'] . '"><img height="30px" weight="30px" src="images/tick.png"/></td>';
      	  	  echo '<td><div class="type-button"><input type="button" onclick="saveinnings(' . $inningsrow['inningid'] . ')" value="Save"/></div></td>';
      	  	  echo '</tr></form>';
      	  	}
      	  	echo '</table>';
      	  }
      	  ?>
      	  <form class="yform" name="addinnings" style="width:350px" method="get" action="processing/addinginnings.php">
      	    <p>Add innings to the match</p>
      	    <div class="type-select"><label for="team">Team</label>
	    <select id="team" name="team">
	    <?php
	    echo '<option value="' . $team1id . '">' . $team1 . '</option>';
	    echo '<option value="' . $team2id . '">' . $team2 . '</option>';
            ?>
            </select></div>
            <?php echo '<input type="hidden" name="match" value="' . $matchid . '"/>'; ?>
            <div class="type-button"><input type="submit" value="Add Innings"/></div>
      	  </form>
      	<div style="margin-left:auto; margin-right:auto">
              <p class="note" style="width:590px">Once you are happy with the number of innings created for this match, <a href="entermatchstats.php?match=<?php echo $matchid; ?>">Continue >></a></p>
      	</div>
        
	</div>
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
function makecross(innings) {
document.getElementById('tdimg'+innings).innerHTML = '<img height="30px" weight="30px" src="images/cross.png"/>';
}

function saveinnings(innings) {
var iom = document.getElementById('inningofmatch'+innings).value;
var wktslost = document.getElementById('wicketslost'+innings).value;
var runs = document.getElementById('runs'+innings).value;
var xmlhttp;
if (window.XMLHttpRequest)
  {
  // code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {
  // code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
{
if(xmlhttp.readyState==4)
  {
  if (xmlhttp.responseText == true) {
    document.getElementById('tdimg'+innings).innerHTML = '<img height="30px" weight="30px" src="images/tick.png"/>';
  }
  else {
    alert('Saving innings data failed: '+xmlhttp.responseText);
  }
  }
}
xmlhttp.open("GET","processing/editinginnings.php?inningid=" + innings + "&wickets=" + wktslost + "&runs=" + runs + "&inningofmatch=" + iom);
xmlhttp.send(null);
}

</script>