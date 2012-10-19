<?php
session_start();
if ($_SESSION["admin"]!="1") {
	echo "<meta http-equiv=\"refresh\" content=\"0;URL=index.php\"/>";
}
include("connect.php");
$groundid = $_GET["ground"];
$groundresult = mysql_query("select * from grounds where groundid = " . $groundid);
$ground = mysql_fetch_array($groundresult);
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
        <div class="hlist">
          <!-- main navigation: horizontal list -->
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="matches.php?seasonselect=2009/2010">Matches</a></li>
            <li><a href="#">Ladders</a></li>
            <li><a href="grounds.php">Grounds</a></li>
            <li><a href="teams.php">Teams</a></li>
            <li><a href="players.php">Players</a></li>
          </ul>
        </div>
      </div>
      <div id="main">
 <div id="ground">
<p class="note">
<?php
echo $ground["name"] . "<br/>";
echo $ground["address"] . ", " . $ground["suburb"] . " " . $ground["postcode"] . "<br/>";
echo $ground["melwayref"];
?>
</p>
</div>

<h3>Assign to teams</h3>
<?php
$teamsgroundsresult = mysql_query("select * from teams where teamid in (select teamid from teamsgrounds where groundid = " . $groundid . ") order by name");
$teamlistresult = mysql_query("select * from teams where teamid not in (select teamid from teamsgrounds where groundid = " . $groundid . ") order by name");
echo "<p id=\"assigned\">Teams currently assigned: <br/>";
while ($teamsgrounds = mysql_fetch_array($teamsgroundsresult)) {
	echo $teamsgrounds["name"] . "<br/>";
}
echo "</p>";
echo "<p>Add more: <form onsubmit=\"return addTeam()\" method=\"get\" action=\"anypage.php\" name=\"addteam\"><select name=\"team\">";
while ($teamlist = mysql_fetch_array($teamlistresult)) {
	echo "<option id=\"" . $teamlist["teamid"] . "\" value=\"" . $teamlist["teamid"] . "\">" . $teamlist["name"] . "</option>";
}
echo "</select>";
echo "<button type=\"button\" onclick=\"return addTeam()\">Click</button>";
echo "</p>"
?>

</form>
      </div>
      <!-- begin: #footer -->
      <div id="footer">Layout based on <a href="http://www.yaml.de/">YAML</a>
      </div>
    </div>
  </div>
</body>
</html>

<script type="text/javascript">

function addTeam() {
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
  document.getElementById("assigned").innerHTML=document.getElementById("assigned").innerHTML+xmlhttp.responseText;
  }
}
xmlhttp.open("GET","processing/addingteamground.php?ground=" + <?php echo $groundid; ?> + "&team=" + document.addteam.team.value,true);
xmlhttp.send(null);
}
}
</script>
