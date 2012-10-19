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
	<h3>Create a news story for the home page</h3>
	<form class="yform" style="width:500px" name="newitem" method="post" action="processing/addingnewsitem.php">
	  <div class="type-text"><label for="title">Title</label><input type="text" style="width:90%" name="title" id="title"></div>
	  <div class="type-text"><label for="content">Content</label><textarea name="content" style="width:90%" rows="5"></textarea></div>
	  <div class="type-button"><input type="submit" value="Save news item"/></div>
	</form>
	
	<h3>You can also edit recently posted news items</h3>
	<?php
	$newsset = mysql_query("select *, addtime(timestamp, '0 11:0:0') as time from newsitem n inner join users u on n.poster=u.userid order by timestamp desc limit 0,8");
	while ($newsrow = mysql_fetch_array($newsset)) {
	  echo '<form class="yform" style="width:500px" name="editnews' . $newsrow['newsid'] . '" method="post" action="processing/editingnewsitem.php">';
	  echo '<div class="type-text"><label for="title' . $newsrow['newsid'] . '">Title</label><input type="text" style="width:90%" name="title' . $newsrow['newsid'] . '" id="title' . $newsrow['newsid'] . '" value="' . stripslashes($newsrow['title']) . '")></div>';
	  echo '<div class="type-text"><label for="content' . $newsrow['newsid'] . '">Content</label><textarea id="content' . $newsrow['newsid'] . '" name="content' . $newsrow['newsid'] . '" style="width:90%" rows="5">' . stripslashes($newsrow['content']) . '</textarea></div>';
	  echo '<div class="type-text"><input type="text" style="background:#f4f4f4;width:90%;border:0" disabled value="posted on ' . $newsrow['time'] . ' by ' . $newsrow['username'] . '"></div>';
	  echo '<input type="hidden" name="newsid" value="' . $newsrow['newsid'] . '">';
	  echo '<div class="type-button"><input type="submit" value="Save news item"/></div>';
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