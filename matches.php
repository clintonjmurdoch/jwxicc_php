<?php 
session_start();
include("classes/matchesclass.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Johnnie Walker XI - Matches</title>
<!-- add your meta tags here -->

<link href="css/my_layout.css" rel="stylesheet" type="text/css" />
<!--[if lte IE 7]>
<link href="css/patches/patch_my_layout.css" rel="stylesheet" type="text/css" />
<![endif]-->
</head>
<body onload="chooseSeason()">
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
<form method="get" action="matches.php">
<?php
echo $_SESSION["welcome"];
?>
<p>Season: <select name="seasonselect">
<?php
$seasonlist = mysql_query("select season from matches group by season order by season asc");
while ($seasonrow = mysql_fetch_array($seasonlist)) {
	if ($seasonrow["season"]==$_GET["seasonselect"]) {
		echo "<option name=\"" . $seasonrow[season] . "\" value=\"" . $seasonrow[season] . "\" selected=\"selected\">" . $seasonrow[season] . "</option>";
	}
	else {
		echo "<option name=\"" . $seasonrow[season] . "\" value=\"" . $seasonrow[season] . "\">" . $seasonrow[season] . "</option>";
	}
}
?>
</select>
Competition: <select name="competitionselect">
<?php
$competitionlist = mysql_query("select * from competitions where competitionid <> 1 order by competitionid desc");
while ($competitionrow = mysql_fetch_array($competitionlist)) {
	if ($competitionrow["competitionid"]==$_GET["competitionselect"]) {
		echo "<option name=\"" . $competitionrow["competitionid"] . "\" value=\"" . $competitionrow["competitionid"] . "\" selected=\"selected\">" . $competitionrow["association"] . " " . $competitionrow["grade"] . "</option>";
	}
	else {
		echo "<option name=\"" . $competitionrow["competitionid"] . "\" value=\"" . $competitionrow["competitionid"] . "\">" . $competitionrow["association"] . " " . $competitionrow["grade"] . "</option>";
	}
}
?>
</select>

<input type="submit" value="go"/></p>
</form>

	<table>
		<tr>
			<th>Round</th>
			<th>Home</th>
			<th>Away</th>
			<th>Ground</th>
			<th>Date</th>
			<th></th>
		</tr>
<?php
if ($_GET["seasonselect"]) {
	$season = $_GET["seasonselect"];
}
else {
	$season = "2011/2012";
}
if ($_GET["competitionselect"]) { 
	$comp = $_GET["competitionselect"];
}
else { 
	$comp = "8";
}
$matches = mysql_query("select matchid from matches where season = '" . $season . "' and competition = " . $comp . " order by round asc");

while ($matchesrow = mysql_fetch_array($matches)) {
	$match = new matches($matchesrow[matchid]);

	echo "<tr>";
	echo "<td><b>" . $match->get_round() . "</b></td>";
	echo "<td><b>" . $match->get_team1() . "</b></td>";
	echo "<td><b>" . $match->get_team2() . "</b></td>";
	echo "<td><b>" . $match->get_ground() . "</b></td>";
	echo "<td><b>" . $match->get_date() . "</b></td>";
	echo "<td><a href=viewmatch.php?match=" . $matchesrow[matchid] . ">View</a></td>";
	echo "</tr>";
}
echo "</table><br/>";

?>
      </div>
      <!-- begin: #footer -->
      <div id="footer">Layout based on <a href="http://www.yaml.de/">YAML</a>
      </div>
    </div>
  </div>
</body>
</html>