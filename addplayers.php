<?php
session_start();
include("connect.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Johnnie Walker XI - Home</title>
<!-- add your meta tags here -->

<link href="css/my_layout.css" rel="stylesheet" type="text/css" />
<!--[if lte IE 7]>
<link href="css/patches/patch_my_layout.css" rel="stylesheet" type="text/css" />
<![endif]-->
</head>
<body onload="showTeamList()">
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
        <div id="showplayers" style="width:400px; float:left">
          <select name="team" id="team" onchange="showTeamList()">
          <?php
          $teamset = mysql_query('select * from teams');
          while ($teamrow = mysql_fetch_array($teamset)) {
            echo '<option value="' . $teamrow['teamid'] . '">' . $teamrow['name'] . '</option>';
          }
          ?>
          </select>
          <div id="playersdiv" style="width:400px"></div>
        </div>
	<div id="addplayers" style="width:400px; float:left">
	  <h3>Add Player</h3>
	  <form class="yform" name="addplayer">
	  <div class="type-text"><label for="playername">Name: </label><input type="text" id="playername" name="playername"/></div>
	  <div class="type-select"><label for="active">Active: </label><select id="active" name="active"></div>
		<option value="1">Yes</option>
		<option value="0">No</option>
	  </select><br/>
	  <div class="type-button"><input type="button" onclick="addPlayer()" value="Add Player"/></div>
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
function addPlayer() {
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
  document.getElementById("playertable").innerHTML=xmlhttp.responseText+document.getElementById("playertable").innerHTML;
  }
}
xmlhttp.open("GET","processing/addingplayer.php?team=" + document.getElementById("team").value + "&name=" + document.addplayer.playername.value + "&active=" + document.addplayer.active.options[document.addplayer.active.selectedIndex].value,true);
xmlhttp.send(null);
}
}

function showTeamList() 
{
var team = document.getElementById("team").value;
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
    document.getElementById("playersdiv").innerHTML = xmlhttp.responseText;
  }
}
xmlhttp.open("GET","processing/returnplayers.php?team="+team);
xmlhttp.send(null);
}
</script>