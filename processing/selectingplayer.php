<?php
include("../connect.php");
mysql_query("insert into selectedteams values(" . $_GET["team"] . "," . $_GET["match"] . "," . $_GET["player"] . ")");
echo "true";

?>
