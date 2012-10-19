<?
include("classes/playersclass.php");
?>
<h3>Add Fine</h3>
<form onsubmit="return addFine()" method="get" name="fineform" action="anypage.php">
<select name="player">
<?php
$match=$_GET["match"];
$players = mysql_query("select playerid from players where playerid in (select playerid from selectedteams where matchid = " . $match . ") and teamid = 1 order by name");
while ($playersrow = mysql_fetch_array($players)) {
	$player = new players($playersrow[playerid]);
	echo "<option value=\"" . $player->get_playerid() . "\">" . $player->get_name() . "</option>";
} 
?>
</select>
<select name="reason">
	<option value="catch">Dropped Catch</option>
	<option value="duck">Duck</option>
	<option value="stumping">Missed Stumping</option>
</select>
<?php 
echo "<input type=\"hidden\" name=\"match\" value=\"" . $match . "\"/>"; 
?>
<input name="clicker" type="submit" value="Add"/>
</form>

<script type="text/javascript">
function addFine() {
	addTheFine();
	return false;
}

function addTheFine() {
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
  document.getElementById("finetable").innerHTML=document.getElementById("finetable").innerHTML+xmlhttp.responseText;
  }
}
xmlhttp.open("GET","processing/addingfine.php?player=" + document.fineform.player.value + "&match=" + <?php echo $_GET["match"]; ?> + "&reason=" + document.fineform.reason.value,true);
xmlhttp.send(null);
}
}
</script>
