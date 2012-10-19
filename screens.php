<?php
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Johnnie Walker XI - Records</title>
<!-- add your meta tags here -->

<link href="css/my_layout.css" rel="stylesheet" type="text/css" />
<link href="css/screen/forms.css" rel="stylesheet" type="text/css" />

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
      <br/><br/>
	<div id="border" style="border:none; text-align:center; margin:0 auto; font-size:16pt; background-color:aliceblue; width:400px">
	  <form class="yform full">
	  <div class="type-select"><label for="scan">Scan type</label>
	  <select id="scan">
	    <option>MRI</option>
	    <option>CT</option>
	    <option>other</option>
	    <option>other</option>
	    <option>other</option>
	  </select></div>
	  <div class="type-select"><label for="scan2">Scan-specific information</label>
	  <select id="scan">
	    <option>DTI 32 channel</option>
	    <option>T1</option>
	    <option>other</option>
	    <option>other</option>
	    <option>other</option>
	  </select></div>
	  <div class="type-text">
	  <label for="patient">Patient ID</label>
	  <input type="text" value="id">
	  <a>click here to find</a>
	  </div>
	  <div class="type-text">
	  <label for="date">Scan Date</label>
	  <input type="text"/>
	  </div>
	  <div class="type-button">
	  <input type="submit" style="background-color:aqua" value="Browse files..."/>
	  </div>
	  <div class="type-button">
	  <input type="submit" style="background-color:aqua" value="Upload"/>
	  </div>
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