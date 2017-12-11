<?php

if ($yes) {
   setcookie("PassMaster[1]", "null", time() + 0, '/');
   setcookie("PassMaster[2]", "null", time() + 0, '/');

   $logout_message = "<p>Ud., ha terminado con exito su salida del Sistema.</p>\n";
}

include "config.php";

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>

<head>

<title><?php echo "$PageTitle" ?></title>


<META HTTP-EQUIV="expires" CONTENT="0">
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">


<link rel="stylesheet" type="text/css" href="style.css">


<script>
<!--
function wait(delay){
   string="pauseforalert("+delay+");";
   setTimeout(string,delay);
}

function pauseforalert(delay){
   this.window.close();
   opener.location='<?php echo "$redirectURL" ?>';
}
// -->
</script>


</head>



<body <?php 

if ($yes) {
   print "onload=\"wait($redirectDelay);\"";
}

?>>




<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
   <tr>
	<td bgcolor="#00CC33" height="15"><img src="/images/spacer.gif" width="3" height="3"></td>
   </tr>
   <tr>
	<td class="hrz_line"><img src="/images/spacer.gif" width="1" height="1"></td>
   </tr>
   <tr>
	<td style="background: #ffffff; padding: 5px" valign="middle"><h1 style="margin-top: 0; margin-bottom: 0">Logout</h1></td>
   </tr>
   <tr>
	<td class="hrz_line"><img src="/images/spacer.gif" width="1" height="1"></td>
   </tr>
   <tr>
	<td valign="top" style="padding: 1em" class="maincontent" height="105">

	

	<?php

		if ($yes) {
		   print "$logout_message";
		}

		else {

		   print "<p><strong>Esta Ud. seguro que desea salir del Sistema?</strong></p>\n";

		   print "<form action=\"$PHP_SELF\" method=\"post\">\n";

		   print "<input type=\"submit\" name=\"yes\" value=\"Si\" class=\"submit\">\n";

		   print "<input type=\"submit\" name=\"no\" value=\"No\" class=\"submit\" onclick=\"self.close()\">\n";

		   print "</form>\n";

		}

	?>


	</td>
   </tr>
   <tr>
	<td class="hrz_line"><img src="/images/spacer.gif" width="1" height="1"></td>
   </tr>
   <tr>
	<td height="20" style="padding-top: 3px; padding-bottom: 3px; padding-left: 1em"><a href="javascript:window.close()">Terminar</a></td>
   </tr>
   <tr>
	<td class="hrz_line"><img src="/images/spacer.gif" width="1" height="1"></td>
   </tr>
   <tr>
	<td bgcolor="#456189" height="15"><img src="/images/spacer.gif" width="3" height="3"></td>
   </tr>
</table>



	

</body>
</html>
