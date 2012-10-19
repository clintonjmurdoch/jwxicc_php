	<div class="hlist">
          <!-- main navigation: horizontal list -->
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="matches.php?seasonselect=2010/2011">Matches</a></li>
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
          <?php if ($_SESSION["admin"] == 1) { ?>
          <ul>
            <li><a href="#">Admin Options:</a></li>
            <li><a href="newsitems.php">Add/Edit News Items</a></li>
            <li><a href="addmatches.php?seasonselect=2009/2010">Add Matches</a></li>
            <li><a href="addplayers.php">Add Players</a></li>
            <li><a href="grounds.php">Grounds</a></li>
            <li><a href="teams.php">Teams</a></li>
            <li><a href="jwxiplayerinfo.php">JWXI Player Info</a></li>
          </ul>
          <?php } ?>
        </div>