<?php
session_start();
//include("class_lib.php");
//$member=unserialize($_SESSION["member"]);
?>
<body onLoad="sendEmail()">
<p id="output">Mail is now sending, please wait</p>
</body>

<script type="text/javascript">
function sendEmail()
{
var xmlhttp;
if (window.XMLHttpRequest)
  {
  // code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {
  // code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
{
if(xmlhttp.readyState==4)
  {
	if (xmlhttp.responseText=="success") {
		var texttodisplay = "Verification email sent successfully. Please click on the link you receive in your email inbox to verify your email address.";
		document.getElementById("output").innerHTML=texttodisplay;
	}
	else {
		document.getElementById("output").innerHTML="Message sending failed. " + xmlhttp.responseText;
	}
  }
}
xmlhttp.open("GET","sendverificationemail.php",true);
xmlhttp.send(null);
}
</script>