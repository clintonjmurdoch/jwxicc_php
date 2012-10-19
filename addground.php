<?php 
session_start();
if ($_SESSION["admin"]!="1") { 
	echo "<meta http-equiv=\"refresh\" content=\"0;URL=index.php\"/>";
}
?>
<h3>Add Ground</h3>
<form method="post" action="processing/addingground.php">
<input type="text" value="name" name="name"/>
<input type="text" value="address" name="address"/>
<input type="text" value="suburb" name="suburb"/>
<input type="text" value="postcode" name="postcode"/>
<input type="text" value="melway ref" name="melwayref"/>
<input type="submit" value="Add"/>
</form>
