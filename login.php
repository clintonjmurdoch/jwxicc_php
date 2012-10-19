<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Johnnie Walker XI - Admin Login</title>
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
<form class="yform" id="loginform" method="post" action="processing/loggingin.php">
    <div class="type-text"><label for="username">Username</label><input type="text" id="username" name="username"/></div>
    <div class="type-text"><label for="password">Password</label><input type="password" id="password" name="password"/></div>
    <div class="type-button"><input type="submit" value="Log In"/></div>
</form>

      </div>
      <!-- begin: #footer -->
      <div id="footer">Layout based on <a href="http://www.yaml.de/">YAML</a>
      </div>
    </div>
  </div>
</body>
</html>
