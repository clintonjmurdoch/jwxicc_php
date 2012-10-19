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
<body onload="show_image_dimensions()">
  <div class="page_margins">
    <div class="page">
      <div id="main">
      <div id="container" style="float:left; border:3px solid #f4f4f4">
	<div id="picturediv" style="width:220px; text-align:center; float:left; padding:5px"></div>
	<div id="description" style="background-color:#f4f4f4; width:500px; padding:10px; float:left">
	  <h3>Vaughan Garner</h3>
	  <p>Shirt number: 47<br/>Cap number: 1</p>
	  <p>As if writing his own profile wasn&#8217;t showing enough Lance, Garner has the gall to show his face in Mildura again after a pitiful display with the bat during Willowfest 2009 (see stats below for those of you who are sketchy with the details). Mildura aside, Garner has been a rock solid contributor for JWXI, especially since the move to Melbourne, and will no doubt be called upon to bowl some lengthy spells, provided that a comfortable G-string can be found. He is set to become just the second person, after Chris Taylor, to play 47 matches on day one of the carnival.</p>
	</div>
      </div>   
      <div style="clear:both"></div>   
      </div>
    </div>
  </div>
</body>
</html>


<script type="text/javascript">
function show_image_dimensions()
{
var newImg = new Image();
newImg.src = "http://www.jwxicc.com/favicon.ico";
var height = newImg.height;
var width = newImg.width;
var ratio = width/200;
var newheight = height/ratio;
var html = "<img src=\"favicon.ico\" width=200px height="+newheight+" style=\"vertical-align:middle\"/>";
document.getElementById('picturediv').innerHTML = html;
}
</script>