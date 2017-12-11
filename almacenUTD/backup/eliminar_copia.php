<?php
    /*  
  
    Este es un programa desarrollado bajo el concepto de Software Libre y Uds.,
	pueden modificarlo y redistribuirlo bajo los terminos de la GNU General 
	Public License como ha sido publicado por Free Software Foundation;
	ya sea bajo la Licencia version 2 o cualquier Licencia posterior.

    	
	Autores: Ignacio Albacete
			 Pedro Obregón Mejías
			 Rubén D. Mancera Morán
	
	Fecha Liberación del código: 15/10/2007
	Codeka 2007 -- Murcia	
	
	Este codigo ha sido modificado parcialmente por
	
	Fecha Liberación del código: 28/08/2010
	Grupo  CodeKa Mx --- Mexico , Chile
	                     Manuel Avalos
	                     Arturo Fertilio
						 Helio Trincado 	 
	
	*/
header ("Expires: Thu, 27 Mar 1980 23:59:00 GMT"); //la pagina expira en una fecha pasada
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
header ("Pragma: no-cache");

include ("../conectar.php"); 
include ("../funciones/fechas.php");


$sel_maximo="SELECT max(id) as maximo FROM tabbackup";
$rs_maximo=mysql_query($sel_maximo);
$identif=mysql_result($rs_maximo,0,"maximo");
//$identif++;
$archivo="../copias/copia".$identif.".sql";


$id=$_GET["id"];

if ($id==$identif) {
´            ?><script>

				alert ("No se puede dar de baja a esta base pues es la ultima base salvada.");

				location.href="restaurarbak.php";

			</script><?php

	} else {

$sel_borrar="DELETE FROM tabbackup WHERE id='$id'";
$rs_borrar=mysql_query($sel_borrar);

$archivo="../copias/copia".$id.".sql";

unlink($archivo);

$mensaje="La copia de seguridad se ha eliminado correctamente."; 
$cabecera2="ELIMINAR COPIA DE SEGURIDAD";}

?>

<html>
	<head>
		<title>Principal</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
		<script language="javascript">
		
		function aceptar() {
			location.href="restaurarbak.php";
		}
		
		var cursor;
		if (document.all) {
		// Está utilizando EXPLORER
		cursor='hand';
		} else {
		// Está utilizando MOZILLA/NETSCAPE
		cursor='pointer';
		}
		
		</script>
	</head>
	<body>
		<div id="pagina">
			<div id="zonaContenido">
			  <div align="center">
				<div id="tituloForm" class="header"><?php echo $cabecera2?></div>
				<div id="frmBusqueda">
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
						<tr>
							<td width="15%"></td>
							<td width="85%" colspan="2" class="mensaje"><?php echo $mensaje;?></td>
					    </tr>

						<tr>
							<td width="15%">Proceso</td>
							<td width="85%" colspan="2">Borrado correctamente</td>
					    </tr>							
					</table>
			  </div>
				<div id="botonBusqueda"> <img src="../img/botonaceptar.jpg" width="85" height="22" onClick="aceptar()" border="1" onMouseOver="style.cursor=cursor"> </div>
				</div>
			</div>
	</body>
</html>
