<?php
session_start();
include("../connect.php");
$title = mysql_real_escape_string($_POST['title']);
$content = mysql_real_escape_string($_POST['content']);

if (!($title == "") && !($content=="")) { 
$query = "insert into newsitem values(null, '" . $title . "', '" . $content . "', UTC_TIMESTAMP(), " . $_SESSION["userid"] . ")";
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