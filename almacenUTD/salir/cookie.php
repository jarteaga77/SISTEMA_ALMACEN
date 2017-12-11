<?php

$password_cypt = md5($password);

if (($password_cypt == $set_pass) && ($username == $set_user)) {
   setcookie("PassMaster[1]", "$password_cypt", time() + 3600, '/');
   setcookie("PassMaster[2]", "$username", time() + 3600, '/');
}

?>
