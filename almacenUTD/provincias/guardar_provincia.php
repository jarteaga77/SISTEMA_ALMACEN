<?
include ("../conectar.php"); 

$accion=$_POST["accion"];
if (!isset($accion)) { $accion=$_GET["accion"]; }

$nombreprovincia=$_POST["Anombreprovincia"];

if ($accion=="alta") {
	$query_operacion="INSERT INTO provincias (codprovincia, nombreprovincia, borrado) 
					VALUES ('', '$nombreprovincia', '0')";					
	$rs_operacion=mysql_query($query_operacion);
	if ($rs_operacion) { $mensaje="La Provincia ha sido dada de alta correctamente"; }
	$cabecera1="Inicio >> Provincias &gt;&gt; Nueva Provincia ";
	$cabecera2="INSERTAR PROVINCIA ";
	$sel_maximo="SELECT max(codprovincia) as maximo FROM provincias";
	$rs_maximo=mysql_query($sel_maximo);
	$codentidad=mysql_result($rs_maximo,0,"maximo");
}

if ($accion=="modificar") {
	$codprovincia=$_POST["Zid"];
	$query="UPDATE provincias SET nombreprovincia='$nombreprovincia', borrado=0 WHERE codprovincia='$codprovincia'";
	$rs_query=mysql_query($query);
	if ($rs_query) { $mensaje="Los datos de la Provincia han sido modificados correctamente"; }
	$cabecera1="Inicio >> Provincias &gt;&gt; Modificar Provincia ";
	$cabecera2="MODIFICAR PROVINCIA ";
}

if ($accion=="baja") {
	$codprovincia=$_GET["codprovincia"];
	$query_comprobar="SELECT * FROM clientes WHERE codprovincia='$codprovincia' AND borrado=0";
	$rs_comprobar=mysql_query($query_comprobar);
	if (mysql_num_rows($rs_comprobar) > 0 ) {
		?><script>
			alert ("No se puede eliminar esta Provincia porque tiene clientes asociados.");
			location.href="eliminar_provincia.php?codprovincia=<?php echo $codprovincia?>";
		</script>
		<?php
	} else {
		$query_comprobar="SELECT * FROM proveedores WHERE codprovincia='$codprovincia' AND borrado=0";
		$rs_comprobar=mysql_query($query_comprobar);
		if (mysql_num_rows($rs_comprobar) > 0 ) {
			?><script>
				alert ("No se puede eliminar esta Provincia porque tiene proveedores asociados.");
				location.href="eliminar_provincia.php?codprovincia=<? echo $codprovincia?>";
			</script>
		<?php } else {
				$query="UPDATE provincias SET borrado=1 WHERE codprovincia='$codprovincia'";
				$rs_query=mysql_query($query);
				if ($rs_query) { $mensaje="La Provincia ha sido eliminada correctamente"; }
				$cabecera1="Inicio >> Provincia &gt;&gt; Eliminar Provincia ";
				$cabecera2="ELIMINAR PROVINCIA ";
				$query_mostrar="SELECT * FROM provincias WHERE codprovincia='$codprovincia'";
				$rs_mostrar=mysql_query($query_mostrar);
				$codprovincia=mysql_result($rs_mostrar,0,"codprovincia");
				$nombreprovincia=mysql_result($rs_mostrar,0,"nombreprovincia");
			}
	}
}

?>

<html>
	<head>
		<title>Principal</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
		<script language="javascript">
		
		var cursor;
		if (document.all) {
		// Está utilizando EXPLORER
		cursor='hand';
		} else {
		// Está utilizando MOZILLA/NETSCAPE
		cursor='pointer';
		}
		
		function aceptar() {
			location.href="index.php";
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
							<td width="15%">C&oacute;digo</td>
							<td width="85%" colspan="2"><?php echo $codprovincia?></td>
					    </tr>
						<tr>
							<td width="15%">Nombre</td>
						    <td width="85%" colspan="2"><?php echo $nombreprovincia?></td>
					    </tr>						
					</table>
			  </div>
				<div id="botonBusqueda">
					<img src="../img/botonaceptar.jpg" width="85" height="22" onClick="aceptar()" border="1" onMouseOver="style.cursor=cursor">
			  </div>
			 </div>
		  </div>
		</div>
	</body>
</html>
