<?php 

include "config.php";
include "cookie.php";
include "header.php";

?>


<h1><?php echo "$PageTitle" ?></h1>


<?php




if (($PassMaster[1] == "$set_pass") && ($PassMaster[2] == "$set_user")) {

   print "<p><strong><a href=\"logout.php\" onclick=\"NewWindow(this.href,'logout','300','200','no');return false\" title=\"logout\">Logged In</a>:</strong> $PassMaster[2]</p>\n";


?>




<!-- BEGIN YOUR TEXT HERE -->







<p>You have been successfully logged in.</p>

<p>To add your text, open <em>index.php</em> and paste your HTML between the <em style="color: steelblue">&lt;!-- BEGIN YOUR TEXT HERE --&gt;</em> and the <em style="color: steelblue">&lt;!-- END YOUR TEXT HERE --&gt;</em> tags.</p>



<p>Return to <a href="index.php">page 1</a>.</p>












<!-- END YOUR TEXT HERE -->


<?php


}


else {
     print "<META http-equiv=\"refresh\" content=\"0;URL=index.php\">\n";
}

?>




<?php include "footer.php" ?>
