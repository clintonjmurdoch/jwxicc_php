<?php
include('../connect.php');
$inningid = $_GET['inningid'];

  if ($_GET['wickets'] == null) {
	$wickets = 'null';
  }
  else {
	$wickets = $_GET['wickets'];
  }

  if ($_GET['runs'] == null) {
  	$runs = 'null';
  }
  else {
	$runs = $_GET['runs'];
  }

$inningofmatch = $_GET['inningofmatch'];

$url = "update innings set wicketslost=" . $wickets . ", score=" . $runs . ", inningofmatch=" . $inningofmatch . " where inningid = " . $inningid;
if (mysql_query($url)) {
	echo 'true;
}
else {
	echo mysql_error();
}
?>