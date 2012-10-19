	<div class="hlist">
          <!-- main navigation: horizontal list -->
          <ul id="row1">
            <li><a href="index.php">Home</a></li>
            <!-- <li><a href="matches.php?seasonselect=2010/2011">Matches</a></li>-->
            <li><a onclick="showRow2('WF')">Willowfest</a></li>
            <li><a href="http://www.willowfest.com.au/results/">Ladder</a></li>
            <li><a href="playerprofiles.php">Player Profiles/Cap Numbers</a></li>
            <li><a href="shirtnumbers.php">Shirt Numbers</a></li>
            <li><a href="history.php">History</a></li>
            <li><a href="seasonreports.php">Season Reports</a></li>
            <li><a href="seasonstats.php">Season Statistics</a></li>
            <li><a href="records.php">Records</a></li>
            <li><a href="halloffame.php">Hall of Fame</a></li>
            <li><a href="teamrules.php">Team Rules</a></li>
          </ul>
          <ul id="row2"></ul>
        </div>
        
        <script type="text/javascript">
		function showRow2(selection) {
			document.getElementById("row2").innerHTML = "<li><a href="WF-2012-SQUAD.php">2012 Squad</a></li>";
		}
        </script>