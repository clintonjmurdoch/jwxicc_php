<?php
session_start();
?>
<head>
	<title>Fines</title>
</head>
<body>

<table id="finetable">
	<tr>
		<th>Player</th>
		<th>Offence</th>
		<th>Paid</th>
	</tr>

<?php
include("classes/finesclass.php");
$matchid = $_GET["match"];
$fines = mysql_query("select fineid from fines where matchid = " . $matchid);

while ($finesrow = mysql_fetch_array($fines)) {
	$fine = new fines($finesrow[fineid]);

	echo "<tr>";
	echo "<td>" . $fine->get_playername() . "</td>";
	echo "<td>" . $fine->get_offence() . "</td>";
	echo "<td>" . $fine->get_paid() . "</td>";
	echo "</tr>";
}
?>
</table>

<?php
if ($_SESSION["admin"]=="1") {
	include("addfines.php");
}

?>
</body>
