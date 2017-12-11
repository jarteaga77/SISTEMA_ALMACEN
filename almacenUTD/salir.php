<?php
//$usuarios_sesion="prueba";
//
//session_name($usuarios_sesion);

session_start();

session_destroy();

header ("Location:http://192.168.1.128/almacenUTD/index.php");
?>
