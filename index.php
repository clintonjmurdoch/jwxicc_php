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
<body>
  <div class="page_margins">
    <div class="page">
      <div id="header">
       <img src="favicon.ico" length="220" width="220"/>
      
      
        <div id="topnav" style="width:200px">
          <!-- start: skip link navigation -->
          <a class="skip" title="skip link" href="#navigation">Skip to the navigation</a><span class="hideme">.</span>
          <a class="skip" title="skip link" href="#content">Skip to the content</a><span class="hideme">.</span>
          <!-- end: skip link navigation --><a href="login.php">Login</a> | <a href="contact.php">Contact</a> | <a href="suggestions.php">Suggestions</a>
          <br></br>
          <form method="get" action="http://www.google.com/search">
<div id="rightdiv" style="border:1px solid red;padding:4px;width:18.5em;">
<table border="0" cellpadding="0">
<tr><td>
<input type="text"   name="q" size="25"
 maxlength="125" value="" />
<input type="submit" value="Google" /></td></tr>
<tr><td align="center" style="font-size:75%">
<input type="checkbox"  name="sitesearch"
 value="jwxicc.com" checked /> only search Johnnie Walker XI<br />
</td></tr></table>
</div>
</form>
        </div>
      </div>
      
      <div id="nav">
        <!-- skiplink anchor: navigation -->
        <a id="navigation" name="navigation"></a>
        <?php include("navbar.php"); ?>
      </div>
      <div id="main">

        <div id="rightdiv">
		<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:like-box href="http://www.facebook.com/pages/Johnnie-Walker-XI/143138622462934" width="292" show_faces="true" stream="true" header="true"></fb:like-box>
        <!--Weatherzone current weather button-->
<script type="text/javascript" src="http://www.weatherzone.com.au/woys/graphic_current.jsp?postcode=3000"></script>

<!--end Weatherzone current weather button-->
<!--Weatherzone forecast button-->
<script type="text/javascript" src="http://www.weatherzone.com.au/woys/graphic_forecast.jsp?postcode=3000"></script>
<p><a href="http://www.weatherzone.com.au/radar.jsp?lt=radarz&lc=002">Melbourne Weather Radar</a></p>

<!--Weatherzone current weather button-->
<script type="text/javascript" src="http://www.weatherzone.com.au/woys/graphic_current.jsp?postcode=3500"></script>
<!--end Weatherzone current weather button-->
<!--Weatherzone forecast button-->
<script type="text/javascript" src="http://www.weatherzone.com.au/woys/graphic_forecast.jsp?postcode=3500"></script>
<p><a href="http://www.weatherzone.com.au/radar.jsp?lt=radarz&lc=030">Mildura Weather Radar</a></p>
        </div>
        
	<div id="leftdiv" style="padding:5px">
	<div id="nextmatch" class="note">
	<h3>Next Match</h3>
        <p>Willowfest Round 1 vs TBC @ TBC, Thursday December 27, 10:00</p>
	</div>
	
	<h2>NEWS FEED</h2>
	
	<?php 
	$newsset = mysql_query("select *, addtime(timestamp, '0 11:0:0') as time from newsitem n inner join users u on n.poster=u.userid order by timestamp desc limit 0,100");
	while ($newsrow = mysql_fetch_array($newsset)) {
	  echo '<br/><h3>' . stripslashes($newsrow['title']) . '</h3>';
	  echo '<p><small>posted on ' . $newsrow['time'] . ' by ' . $newsrow['username'] . '</small></p>';
	  echo '<p>' . stripslashes($newsrow['content']) . '</p><hr style="height:2px"/>';
	}
	?>

        </div>
    

        <div style="clear:both">
            
      </div>
      <!-- begin: #footer -->
      <div id="footer">Layout based on <a href="http://www.yaml.de/">YAML</a>
      <style type="text/css">#counter_74477 {font-family: "Verdana"; font-size: 11px; clear: left; color: #BBBBBB;}  #counter_74477 a {color: #BBBBBB;}#counter_div_74477 {height: 27px}</style><div id="counter_div_74477"></div><p id="counter_74477"><span></span> <a target="_blank" href="http://www.nydailyclassifieds.com/">nydailyclassifieds.com</a> <span></span></p><script type="text/javascript" src="http://counter.website-hit-counters.com/white-on-black/74477"></script>
      </div>
    </div>
  </div>
</body>
</html>