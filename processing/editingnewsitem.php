<?php
session_start();
include("../connect.php");
$newsid = $_POST['newsid'];
$title = mysql_real_escape_string($_POST['title' . $newsid]);
$content = mysql_real_escape_string($_POST['content' . $newsid]);

if (!($title == "") && !($content=="")) { 
$query = "update newsitem set title='" . $title . "', content='" . $content . "' where newsid=" . $newsid;
mysql_query($query);
}
else {
echo "one of the title or content is blank";
}
if (!mysql_error()) {
echo "<meta http-equiv=\"refresh\" content=\"0;URL=../newsitems.php\"/>";
}
else {
echo "Error adding to MySQL database";
}
?>