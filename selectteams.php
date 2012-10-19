<?php
session_start();
if ($_SESSION["admin"]!="1") {
	echo "<meta http-equiv=\"refresh\" content=\"0;URL=index.php\"/>";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Select Teams</title>
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

<?php
include("connect.php");
$matchid = $_GET["match"];
$matchresult = mysql_query("select team1id, team2id from matches where matchid = " . $matchid);
$matchrow = mysql_fetch_array($matchresult);

$team1 = $matchrow["team1id"];
$team1nameresult = mysql_query("select name from teams where teamid = " . $team1);
$team1namerow = mysql_fetch_array($team1nameresult);
$team1name = $team1namerow["name"];

$team2 = $matchrow["team2id"];
$team2nameresult = mysql_query("select name from teams where teamid = " . $team2);
$team2namerow = mysql_fetch_array($team2nameresult);
$team2name = $team2namerow["name"];

$availableplayersteam1 = mysql_query("select * from players where playerid not in (select playerid from selectedteams where matchid = " . $matchid . ") and status = 1 and teamid = " . $team1);
$availableplayersteam2 = mysql_query("select * from players where playerid not in (select playerid from selectedteams where matchid = " . $matchid . ") and status = 1 and teamid = " . $team2);
$selectedplayersteam1 = mysql_query("select * from players where playerid in (select playerid from selectedteams where matchid = " . $matchid . ") and teamid = " . $team1);
$selectedplayersteam2 = mysql_query("select * from players where playerid in (select playerid from selectedteams where matchid = " . $matchid . ") and teamid = " . $team2);
?>

<div id="divteamselect" style="clear:left">
<form name="formteamselect">
<?php
echo "Choose Team to select players: ";
echo "<input type=\"button\" name=\"teamselect\" value=\"" . $team1name . "\" onclick=\"chooseTeam1()\" checked/>";
echo "<input type=\"button\" name=\"teamselect\" value=\"" . $team2name . "\" onclick=\"chooseTeam2()\"/>";
?>
</form>
</div>
<div id="selectionarea">
<div id="divteam1" style="clear:left;display:none">
	<h2>Team: <?php echo $team1name; ?> </h2>
	<div id="divavailableteam1" style="width:45%; display:inline; float:left">
	<p>Available Players</p>
	<form name="formavailableteam1">
	<?php
		echo "<select name=\"selectavailableteam1\" MULTIPLE size=\"15\" style=\"width:300px\">";
		while ($availableplayers1row = mysql_fetch_array($availableplayersteam1)) {
			echo "<option value=\"" . $availableplayers1row["playerid"] . "\">" . $availableplayers1row["name"] . "</option>";
		}
		echo "</select><br/>";
		echo "<input type=\"button\" value=\"Select > >\" onClick=\"updateTeamSelection('add',document.formavailableteam1.selectavailableteam1, document.formselectedteam1.selectselectedteam1,'" . $team1 . "','" . $matchid . "')\"/>";
	?>
	</form>
	</div>

	<div id="divselectedteam1" style="width:45%; display:inline; float:left">
	<p>Selected Players</p>
	<form name="formselectedteam1">
	<?php
		echo "<select name=\"selectselectedteam1\" MULTIPLE size=\"13\" style=\"width:300px\">";
		while ($selectedplayers1row = mysql_fetch_array($selectedplayersteam1)) {
			echo "<option value=\"" . $selectedplayers1row["playerid"] . "\">" . $selectedplayers1row["name"] . "</option>";
		}
		echo "</select><br/>";
		echo "<input type=\"button\" value=\"< < Remove\" onClick=\"updateTeamSelection('rem',document.formselectedteam1.selectselectedteam1, document.formavailableteam1.selectavailableteam1,'" . $team1 . "','" . $matchid . "')\"/>";
	?>
	</form>
	</div>

</div>

      <div id="divteam2" style="clear:left;display:none">
	<h2>Team: <?php echo $team2name; ?> </h2>

	<div id="divavailableteam2" style="width:45%; display:inline; float:left">
	<p>Available Players</p>
	<form name="formavailableteam2">
	<?php
		echo "<select name=\"selectavailableteam2\" MULTIPLE size=\"15\" style=\"width:300px\">";
		while ($availableplayers2row = mysql_fetch_array($availableplayersteam2)) {
			echo "<option value=\"" . $availableplayers2row["playerid"] . "\">" . $availableplayers2row["name"] . "</option>";
		}
		echo "</select><br/>";
		echo "<input type=\"button\" value=\"Select > >\" onClick=\"updateTeamSelection('add', document.formavailableteam2.selectavailableteam2, document.formselectedteam2.selectselectedteam2,'" . $team2 . "','" . $matchid . "')\"/>";
	?>
	</form>
	</div>

	<div id="divselectedteam2" style="width:45%; display:inline; float:left">
	<p>Selected Players</p>	
	<form name="formselectedteam2">
	<?php
		echo "<select name=\"selectselectedteam2\" MULTIPLE size=\"13\" style=\"width:300px\">";
		while ($selectedplayers2row = mysql_fetch_array($selectedplayersteam2)) {
			echo "<option value=\"" . $selectedplayers2row["playerid"] . "\">" . $selectedplayers2row["name"] . "</option>";
		}
		echo "</select><br/>";
		echo "<input type=\"button\" value=\"< < Remove\" onClick=\"updateTeamSelection('rem', document.formselectedteam2.selectselectedteam2, document.formavailableteam2.selectavailableteam2,'" . $team2 . "','" . $matchid . "')\"/>";
	?>
	</form>
	</div>
      </div>
      </div>
        <div style="display:block; clear:left">
              <p class="note">Once you are happy with the selected teams, <a href="entermatchscores.php?match=<?php echo $matchid; ?>">Continue >></a></p>
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
function updateTeamSelection(action,oldbox,newbox,teamid,matchid) {
	var i;
	var response;
	for(i=0;i<oldbox.options.length;i++) {
		if (oldbox.options[i].selected) {
			if (action=='add') {
				addSelectionToDb(teamid,matchid,oldbox.options[i].value);
			}
			if (action=='rem') {
				remSelectionFromDb(teamid,matchid,oldbox.options[i].value);
			}
			addOption(newbox,oldbox.options[i].text,oldbox.options[i].value);
			oldbox.remove(i);
			i--;
		}
	}
}

function addOption(selectbox,text,value) {
	var optn = document.createElement("OPTION");
	optn.text = text;
	optn.value = value;
	selectbox.options.add(optn);
}

function addSelectionToDb(teamid,matchid,playerid) {
{
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
  return xmlhttp.responsetext;
  }
}
xmlhttp.open("GET","processing/selectingplayer.php?team=" + teamid + "&match=" + matchid + "&player=" + playerid,true);
xmlhttp.send(null);
}
}

function remSelectionFromDb(teamid,matchid,playerid) {
{
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
  return xmlhttp.responsetext;
  }
}
xmlhttp.open("GET","processing/removingselectedplayer.php?team=" + teamid + "&match=" + matchid + "&player=" + playerid,true);
xmlhttp.send(null);
}
}

function chooseTeam1() {
	document.getElementById('divteam2').style.display = 'none';
	document.getElementById('divteam1').style.display = 'block';
}

function chooseTeam2() {
	document.getElementById('divteam1').style.display = 'none';
	document.getElementById('divteam2').style.display = 'block';
}
</script>