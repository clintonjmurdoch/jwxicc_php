<?php
include("../connect.php");
$name = $_GET["name"];
if ($name==null) {
echo "<br/>enter a team name<br/>";
}
else
{
mysql_query("insert into teams values(null, '" . $name . "')");
echo $name . "<br/>";
}
?>
