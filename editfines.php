<head>
	<title>Edit Fines</title>
</head>
<body>

<table>
	<tr>
		<th>Player</th>
		<th>Offence</th>
		<th>Paid</th>
	</tr>
</body>
<?php
include("classes/finesclass.php");
$matchid = $_GET["match"];
$fines = mysql_query("select fineid from fines where matchid = " . $matchid);
$match = $_GET["match"];
while ($finesrow = mysql_fetch_array($fines)) {
	echo "<form method=\"post\" action=\"processing/editingfines.php\">";
	$fine = new fines($finesrow[fineid]);

	echo "<tr>";
	echo "<td>" . $fine->get_playername() . "</td>";
	echo "<td>" . $fine->get_offence() . "</td>";
	echo "<input type=\"hidden\" name=\"fineid\" value=\"" . $fine->get_fineid() . "\"/>";
	echo "<input type=\"hidden\" name=\"match\" value=\"" . $match . "\"/>";
	if ($fine->get_paid() == "0") {
		echo "<td><input onclick=\"this.form.submit()\" type=\"checkbox\" name=\"paid\" value=\"1\"/></td>";
	}	
	else {
		echo "<td><input onclick=\"this.form.submit()\" type=\"checkbox\" name=\"paid\" value=\"1\" CHECKED/></td>";
	}
	echo "</tr>";
	echo "</form>";
}
?>
</table><br/>
