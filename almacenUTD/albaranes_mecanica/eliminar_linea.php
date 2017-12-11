<?php
header('Cache-Control: no-cache');
header('Pragma: no-cache'); 

include ("../conectar.php");

$codalbaran=$_GET["codalbarantmp"];
$numlinea=$_GET["numlinea"];

$consulta = "DELETE FROM linea_hoja_tmp_mec WHERE codalbaran ='".$codalbaran."' AND id_linea_hoja_mto='".$numlinea."'";
$rs_consulta = mysql_query($consulta);
echo "<script>parent.location.href='frame_lineas.php?codalbarantmp=".$codalbaran."';</script>";

?>