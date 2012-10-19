<?php
session_start();
include("connect.php");
include("classes/matchesclass.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Your Page Title</title>
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
if ($_GET["match"]!=null) {
	$matches = mysql_query("select matchid from matches where matchid = " . $_GET["match"]);
	$matchesrow = mysql_fetch_array($matches);
	if ($matchesrow != null) {
		$match = new matches($matchesrow[matchid]);
		echo "<p>" . $match->get_team1() . " v " . $match->get_team2() . "</p>";
		echo "<p>Played at: " . $match->get_ground() . "</p>";
		echo "<a href=\"fines.php?match=" . $_GET[match] . "\">View Fines</a><br/>";
	  if ($_SESSION["admin"] == 1) {
			echo "<a href=\"editfines.php?match=" . $_GET[match] . "\">Edit Fines</a><br/>";
			echo "<a href=\"selectteams.php?match=" . $_GET[match] . "\">Select Teams</a>";
		}
	}
	else {
		echo "no such match";
	}
}
else {
	echo "<meta http-equiv=\"refresh\" content=\"2;URL=matches.php\">";
	echo "no match has been entered - redirecting to the list of matches, or click <a href=\"matches.php\">here</a>";
}
?>
<br><div id="team1">
<?php
	$result = mysql_query("select * from players where playerid not in (select playerid from innings inner join inningslist on innings.inningid = inningslist.inningid where matchid = " . $_GET[match] . ")");
	$players = mysql_fetch_array
?>
</div>
      </div>
      <!-- begin: #footer -->
      <div id="footer">Layout based on <a href="http://www.yaml.de/">YAML</a>
      </div>
    </div>
  </div>
</body>
</html>