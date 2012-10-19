<?php
session_start();
if ($_SESSION["admin"]!="1") {
	echo "<meta http-equiv=\"refresh\" content=\"0;URL=index.php\"/>";
}
include("connect.php");
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
<body onLoad="showPlayers()">
  <div class="page_margins">
    <div class="page">
      <div id="header">
        <div id="topnav">
          <!-- start: skip link navigation -->
          <a class="skip" title="skip link" href="#navigation">Skip to the navigation</a><span class="hideme">.</span>
          <a class="skip" title="skip link" href="#content">Skip to the content</a><span class="hideme">.</span>
          <!-- end: skip link navigation --><a href="#">Login</a> | <a href="#">Contact</a> | <a href="#">Imprint</a>
        </div>
      </div>
      <div id="nav">
        <!-- skiplink anchor: navigation -->
        <a id="navigation" name="navigation"></a>
        <div class="hlist">
          <!-- main navigation: horizontal list -->
          <ul>
            <li class="active"><strong>Home</strong></li>
            <li><a href="matches.php?seasonselect=2009/2010">Matches</a></li>
            <li><a href="#">Ladders</a></li>
            <li><a href="grounds.php">Grounds</a></li>
            <li><a href="teams.php">Teams</a></li>
            <li><a href="players.php">Players</a></li>
          </ul>
        </div>
      </div>
      <div id="main">

<form name="teamlist">
<select name="team" onChange="showPlayers()">
<?php
$teams = mysql_query("select * from teams");
while ($teamrow = mysql_fetch_array($teams)) {
	echo "<option value=\"" . $teamrow["teamid"] . "\">" . $teamrow["name"] . "</option>";
}
?>

</select>
</form>
<div id="playerdiv">

</div>
<br/><a href="editplayers.php">(edit players)</a>
<?php
include("addplayer.php");
?>
      </div>
      <!-- begin: #footer -->
      <div id="footer">Layout based on <a href="http://www.yaml.de/">YAML</a>
      </div>
    </div>
  </div>
</body>
</html>

<script type="text/javascript">

function showPlayers() {
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
  document.getElementById("playerdiv").innerHTML=xmlhttp.responseText;
  }
}
xmlhttp.open("GET","processing/returnplayers.php?team=" + document.teamlist.team.options[document.teamlist.team.selectedIndex].value,true);
xmlhttp.send(null);
}
}
</script>