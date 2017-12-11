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
						 
	Modificacion 13.10.2010					 	 
	El archivo copias debe tener chmod de 757
	*/
header ("Expires: Thu, 27 Mar 1980 23:59:00 GMT"); //la pagina expira en una fecha pasada
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
header ("Pragma: no-cache");

include ("../conectar.php"); 
include ("../funciones/fechas.php");

$denominacion=$_POST["Adenominacion"];
$fecha=$_POST["fecha"];
if ($fecha<>"") { $fecha=explota($fecha); }
$hora=$_POST["hora"];

$sel_maximo="SELECT max(id) as maximo FROM tabbackup";
$rs_maximo=mysql_query($sel_maximo);
$identif=mysql_result($rs_maximo,0,"maximo");
$identif++;
$archivo="../copias/copia".$identif.".sql";
//$archivo="../copias/copia".$fecha."".$hora."".$identif.".sql";
$sistema="show variables where variable_name= 'basedir'";
$rs_sistema=mysql_query($sistema);
$DirBase=mysql_result($rs_sistema,0,"value");

$primero=substr($DirBase,0,1);
if ($primero=="/") {
	$DirBase="mysqldump --opt ";
} else {
	$DirBase=$DirBase."\bin\mysqldump";
}

$executa = "$DirBase  --user=$Usuario --password=$Password   $BaseDeDatos > $archivo" ;
system($executa, $resultado);
 // si resultado es Falso hay error si esta OK  da el numero positivo de la ultima linea grabada 
 // se debera investigar cuando no hay registros trazpasados o sea linea cero ????
if ($resultado == "F") {
	$mensaje="ERROR. La copia de seguridad no se ha creado correctamente.";
	$cabecera2="ERROR COPIA DE SEGURIDAD";
} else {
	$query_operacion="INSERT INTO tabbackup (id, denominacion, fecha, hora, archivo) 
					VALUES ('', '$denominacion', '$fecha', '$hora', '$archivo')";					
	$rs_operacion=mysql_query($query_operacion);
	if ($rs_operacion) { $mensaje="La copia de seguridad se ha creado correctamente."; }
	$cabecera2="NUEVA COPIA DE SEGURIDAD";
}

?>

<html>
	<head>
		<title>Principal</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
		<script language="javascript">
		
		function aceptar() {
			location.href="hacerbak.php";
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
							<td width="15%">Denominacion</td>
							<td width="85%" colspan="2"><?php echo $denominacion?></td>
					    </tr>
						<tr>
							<td width="15%">Fecha</td>
						    <td width="85%" colspan="2"><?php echo $fecha?></td>
					    </tr>
						<tr>
							<td width="15%">Hora</td>
						    <td width="85%" colspan="2"><?php echo $hora?></td>
					    </tr>							
					</table>
			  </div>
				<div id="botonBusqueda">
					<img src="../img/botonaceptar.jpg" onClick="aceptar()" onMouseOver="style.cursor=cursor">
			  </div>
		  </div>
		</div>
	</body>
</html>
