<?php
session_start();
if ($_SESSION["admin"]!="1") {
	echo "<meta http-equiv=\"refresh\" content=\"0;URL=index.php\"/>";
}
include("connect.php");
include("error_reporting.php");
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
	<div id="container" style="width:600px; margin-left:auto; margin-right:auto">

	<h3>Edit Johnnie Walker XI player data and profiles</h3>
	<?php
	$jwxiset = mysql_query("select jwxiplayerinfo.*, name from jwxiplayerinfo natural join players");
	while ($jwxirow = mysql_fetch_array($jwxiset)) {
	  echo '<form class="yform" style="width:500px" name="editjwxiplayerinfo' . $jwxirow['playerid'] . '">';
	  echo '<div class="type-text"><label for="name' . $jwxirow['playerid'] . '">Name</label><input type="text" style="width:90%" name="name' . $jwxirow['playerid'] . '" id="name' . $jwxirow['playerid'] . '" value="' . stripslashes($jwxirow['name']) . '"/></div>';
	  echo '<div style="width:90%"><div class="type-text" style="width:200px; float:left"><label for="shirtnumber' . $jwxirow['playerid'] . '">Shirt Number</label><input type="text" style="width:99%" name="shirtnumber' . $jwxirow['playerid'] . '" id="shirtnumber' . $jwxirow['playerid'] . '" value="' . $jwxirow['shirtnumber'] . '"/></div><div class="type-text" style="width:200px; float:right"><label for="capnumber' . $jwxirow['playerid'] . '">Cap Number</label><input type="text" style="width:99%" name="capnumber' . $jwxirow['playerid'] . '" id="capnumber' . $jwxirow['playerid'] . '" value="' . $jwxirow['capnumber'] . '")></div></div>';
	  echo '<div style="width:90%"><div class="type-text" style="width:92px; float:left"><label for="imageurl' . $jwxirow['playerid'] . '">Image URL</label><input type="text" style="width:90px; background-color:#f4f4f4; text-align:right" disabled name="imgdisabled' . $jwxirow['playerid'] . '" id="imgdisabled' . $jwxirow['playerid'] . '" value="profileimages/"/></div><div class="type-text" style="display:inline-block" width:100%; float:right"><label>&nbsp</label><input type="text" style="width:99%; float:left" name="imageurl' . $jwxirow['playerid'] . '" id="imageurl' . $jwxirow['playerid'] . '" value="' . $jwxirow['imageurl'] . '")></div></div>';
	  echo '<div class="type-text" style="clear:both"><label for="profile' . $jwxirow['playerid'] . '">Profile</label><textarea id="profile' . $jwxirow['playerid'] . '" name="profile' . $jwxirow['playerid'] . '" style="width:90%" rows="5">' . stripslashes($jwxirow['profile']) . '</textarea></div>';
	  echo '<input type="hidden" name="playerid" value="' . $jwxirow['playerid'] . '">';
	  echo '<div class="type-button"><input type="button" value="Save player information" onclick="savejwxiplayerinfo(' . $jwxirow['playerid'] . ')"/></div>';
	  echo '</form>';
	}
	
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

<script type="text/javascript">
function savejwxiplayerinfo(pid) {
alert(pid);
var name = document.getElementById('name' + pid).value;
var snum = document.getElementById('shirtnumber' + pid).value;
var cnum = document.getElementById('capnumber' + pid).value;
var imgurl = document.getElementById('imageurl' + pid).value;
var profile = document.getElementById('profile' + pid).value;

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
    alert(xmlhttp.responseText);
  }
  }
}
var params = "name="+name+"&shirtnumber="+snum+"&capnumber="+cnum+"&imageurl="+imgurl+"&profile="+profile+"&playerid="+pid;

try {
xmlhttp.open("POST","processing/editingjwxiplayerinfo.php",true);
xmlhttp.setRequestHeader("Content-length", params.length);
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xmlhttp.setRequestHeader("Connection", "close")
xmlhttp.send(params);
}
catch (err) {
alert(err.description);
}
}

</script>