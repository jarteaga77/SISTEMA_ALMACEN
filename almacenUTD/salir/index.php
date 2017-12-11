<?php 

include "config.php";
include "cookie.php";
include "header.php";
error_reporting(0);

?>




<h1><?php echo "$PageTitle" ?></h1>


<?php

if ($login) {

   if (($password_cypt == $set_pass) && ($username == $set_user)) {
	print "<META http-equiv=\"refresh\" content=\"0;URL=index.php\">";
   }

   else {
      print "<p>Incorrect Username or Password, please <a href=\"javascript:history.back()\">go back</a> and try again.</p>\n";
   }


}


elseif (($PassMaster[1] == "$set_pass") && ($PassMaster[2] == "$set_user")) {

   print "<p><strong><a href=\"logout.php\" onclick=\"NewWindow(this.href,'logout','300','200','no');return false\" title=\"logout\">Logged In</a>:</strong> $PassMaster[2]</p>\n";


?>




<!-- BEGIN YOUR TEXT HERE -->







<p>You have been successfully logged in.</p>

<p>To add your text, open <em>index.php</em> and paste your HTML between the <em style="color: steelblue">&lt;!-- BEGIN YOUR TEXT HERE --&gt;</em> and the <em style="color: steelblue">&lt;!-- END YOUR TEXT HERE --&gt;</em> tags.</p>










<p>Go to <a href="page2.php">page 2</a>.</p>







<!-- END YOUR TEXT HERE -->


<?php


}


else {

?>

<form action="<?php echo "$PHP_SELF" ?>" method="post">

<table width="300" border="0" cellpadding="5" cellspacing="0">
   <tr>
	<td><strong>Username:</strong></td>
	<td><input type="text" name="username" class="textfield"></td>
   </tr>
   <tr>
	<td><strong>Password:</strong></td>
	<td><input type="password" name="password" class="textfield"></td>
   </tr>
   <tr>
	<td>&nbsp;</td>
  	<td><input type="submit" name="login" class="submit" value="Login"></td>
   </tr>
</table>

</form>

<?php } ?>




<?php include "footer.php" ?>
