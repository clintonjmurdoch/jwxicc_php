<?php
session_start();
include("../connect.php");
include("../error_reporting.php");
$sql = "select userid, username, name, admin from users where username='" . $_POST["username"] . "' and password='" . $_POST["password"] . "'";
$user = mysql_query($sql);
$userrow = mysql_fetch_array($user);
if ($userrow!=null) {
	$_SESSION["userid"] = $userrow["userid"];
	$_SESSION["username"] = $userrow["username"];
	$_SESSION["admin"] = $userrow["admin"];
	if ($userrow["admin"] == 1) {
		$_SESSION["welcome"] = "Welcome to JWXICC.com, " . $userrow["name"] . " (admin user)";
	}
	else {
		$_SESSION["welcome"] = "Welcome to JWXICC.com, " . $userrow["name"];
	}
	echo "successful login. now redirecting";
	echo "<meta http-equiv=\"refresh\" content=\"1;URL=../index.php\"/>";
}
else {
	echo "fail";
}
?>