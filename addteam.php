<br/><a href="grounds.php">Assign grounds</a>

<h3>Add Team</h3>
<form name="addteam">
<input type="text" name="teamname" value="">
<button type="button" onClick="return confirmTeam()">Add</button>
</form>

<script type="text/javascript">
function confirmTeam() {
var agree = confirm("Are you sure you wish to add team " + document.addteam.teamname.value + "?");
if (agree) {
	return newTeam();
}
}

function newTeam() {
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
  document.getElementById("teamlist").innerHTML=document.getElementById("teamlist").innerHTML+xmlhttp.responseText;
  }
}
xmlhttp.open("GET","processing/addingteam.php?name=" + document.addteam.teamname.value,true);
xmlhttp.send(null);
}
}
</script>
