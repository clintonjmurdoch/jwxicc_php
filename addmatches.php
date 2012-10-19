<?php
session_start();
include("connect.php");
$competitionresult = mysql_query("select * from competitions where competitionid <> 1 order by competitionid desc");
$teams1 = mysql_query("select * from teams");
$teams2 = mysql_query("select * from teams");
$grounds = mysql_query("select groundid, name from grounds");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Johnnie Walker XI - Add Matches</title>
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
      <!-- START CONTENT HERE -->
<h3>Add Match</h3>
<form name="matchform" class="yform columnar" style="width:350px" onsubmit="return validate()" method="POST" action="processing/addingmatch.php">
<div class="type-select"><label for="competition">Competition</label><select id="competition" name="competition">
	<?php
	while ($competitionrow = mysql_fetch_array($competitionresult)) {
		echo "<option value=\"" . $competitionrow["competitionid"] . "\">" . $competitionrow["association"] . " " . $competitionrow["grade"] . "</option>";
	}
	?>
</select></div>
<div class="type-select"><label for="season">Season</label>
<select id="season" name="season">
	<option value="2006/2007">2006/2007</option>
	<option value="2008/2009">2008/2009</option>
	<option value="2009/2010">2009/2010</option>
        <option value="2010/2011">2010/2011</option>
</select></div>

<div class="type-select"><label for="round">Round</label>
<select id="round" name="round">
	<option value="1">1</option>
	<option value="2">2</option>
	<option value="3">3</option>
        <option value="4">4</option>
	<option value="5">5</option>
	<option value="6">6</option>
	<option value="7">7</option>
        <option value="8">8</option>
	<option value="9">9</option>
	<option value="10">10</option>
	<option value="11">11</option>
        <option value="12">12</option>
	<option value="13">13</option>
	<option value="14">14</option>
	<option value="15">15</option>
        <option value="16">16</option>
	<option value="17">17</option>
	<option value="18">18</option>
	<option value="19">19</option>
        <option value="20">20</option>
	<option value="21">21</option>
	<option value="22">22</option>
	<option value="23">23</option>
        <option value="24">24</option>
	<option value="25">25</option>
	<option value="26">26</option>
	<option value="27">27</option>
        <option value="28">28</option>
	<option value="29">29</option>
	<option value="30">30</option>
	<option value="92">EF</option>
	<option value="93">QF</option>
	<option value="94">SF</option>
	<option value="95">PF</option>
	<option value="96">GF</option>
        <option value="97">GF1</option>
	<option value="98">GF2</option>
        <option value="99">GF3</option>
</select></div>

<?php

echo "<div class=\"type-select\"><label for=\"team1\">Home Team</label><select id=\"team1\" name=\"team1\" onchange=\"updateGrounds()\">";
while ($teamrow=mysql_fetch_array($teams1)) {
	echo "<option value=\"" . $teamrow["teamid"] . "\">" . $teamrow["name"] . "</option>";
}
echo "</select></div>";

echo "<div class=\"type-select\"><label for=\"team2\">Away Team</label><select id=\"team2\" name=\"team2\">";
while ($teamrow=mysql_fetch_array($teams2)) {
	echo "<option value=\"" . $teamrow["teamid"] . "\">" . $teamrow["name"] . "</option>";
}
echo "</select></div>";

echo "<div class=\"type-select\"><label for=\"ground\">Ground</label><select id=\"ground\" name=\"ground\">";
while ($groundrow=mysql_fetch_array($grounds)) {
	echo "<option value=\"" . $groundrow["groundid"] . "\">" . $groundrow["name"] . "</option>";
}
echo "</select></div>";

?>
<div class="type-select"><label for="month">Date</label><select name="month" style="display:inline; width:100px">
	<option value="01">January</option>
	<option value="02">February</option>
	<option value="03">March</option>
	<option value="04">April</option>
	<option value="05">May</option>
	<option value="06">June</option>
	<option value="07">July</option>
	<option value="08">August</option>
	<option value="09">September</option>
	<option value="10">October</option>
	<option value="11">November</option>
	<option value="12">December</option>
</select>
<select name="day" style="display:inline; width:100px">
	<option value="01">1</option>
	<option value="02">2</option>
	<option value="03">3</option>
	<option value="04">4</option>
	<option value="05">5</option>
	<option value="06">6</option>
	<option value="07">7</option>
	<option value="08">8</option>
	<option value="09">9</option>
	<option value="10">10</option>
	<option value="11">11</option>
	<option value="12">12</option>
	<option value="13">13</option>
	<option value="14">14</option>
	<option value="15">15</option>
	<option value="16">16</option>
	<option value="17">17</option>
	<option value="18">18</option>
	<option value="19">19</option>
	<option value="20">20</option>
	<option value="21">21</option>
	<option value="22">22</option>
	<option value="23">23</option>
	<option value="24">24</option>
	<option value="25">25</option>
	<option value="26">26</option>
	<option value="27">27</option>
	<option value="28">28</option>
	<option value="29">29</option>
	<option value="30">30</option>
	<option value="31">31</option>
</select></div>
<div class="type-button"><input type="submit" value="Add"/>
<input type="button" name="btnCancel" value="Cancel" onclick="history.go(-1)" /></div>
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
function updateGrounds()
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
  document.getElementById("ground").innerHTML=xmlhttp.responseText;
  }
}
xmlhttp.open("GET","processing/returngrounds.php?team="+document.matchform.team1.value,true);
xmlhttp.send(null);
}

function validate() {
var theround = validateRound();
var theteam = validateTeams();
if (theround==false) {
	return false;
  }
else if (theteam==false) {
	return false;
  }
}

function validateRound() {
if (document.matchform.round.value=="") {
	alert("Please enter a round number");
	return false;
  }
}

function validateTeams() {
if (document.matchform.team1.value==document.matchform.team2.value) {
	alert("The teams must be different");
	return false;
  }
}
</script>