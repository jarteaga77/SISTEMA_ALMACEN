<?php
include ("../conectar.php"); 

$accion=$_POST["accion"];
if (!isset($accion)) { $accion=$_GET["accion"]; }

$nombrecobrador=$_POST["Anombrecobrador"];

if ($accion=="alta") {
	$query_operacion="INSERT INTO cobradores (codcobrador, nombrecobrador, borrado) 
					VALUES ('', '$nombrecobrador', '0')";					
	$rs_operacion=mysql_query($query_operacion);
	if ($rs_operacion) { $mensaje="El Cobrador ha sido dado de alta correctamente"; }
	$cabecera1="Inicio >> Cobrador &gt;&gt; Nuevo Cobrador ";
	$cabecera2="INSERTAR COBRADOR ";
	$sel_maximo="SELECT max(codcobrador) as maximo FROM cobradores";
	$rs_maximo=mysql_query($sel_maximo);
	$codcobrador=mysql_result($rs_maximo,0,"maximo");
}

if ($accion=="modificar") {
	$codcobrador=$_POST["Zid"];
	$query="UPDATE cobradores SET nombrecobrador='$nombrecobrador', borrado=0 WHERE codcobrador='$codcobrador'";
	$rs_query=mysql_query($query);
	if ($rs_query) { $mensaje="Los datos deL Cobrador han sido modificados correctamente"; }
	$cabecera1="Inicio >> Cobrador &gt;&gt; Modificar Cobrador ";
	$cabecera2="MODIFICAR COBRADOR ";
}

if ($accion=="baja") {
	$codcobrador=$_GET["codcobrador"];
	$query_comprobar="SELECT * FROM clientes WHERE codcobrador='$codcobrador' AND borrado=0";
	$rs_comprobar=mysql_query($query_comprobar);
   if ( @mysql_num_rows($rs_comprobar) > 0 ) {
		?><script>
			alert ("No se puede eliminar este Cobrador porque tiene clientes asociados.");
			location.href="eliminar_cobrador.php?codcobrador=<?php echo $codcobrador?>";
		</script>
		<?php
	} else {
		$query_comprobar="SELECT * FROM proveedores WHERE codcobrador='$codcobrador' AND borrado=0";
		$rs_comprobar=mysql_query($query_comprobar);
		if ( @mysql_num_rows($rs_comprobar) > 0 ) {
			?><script>
				alert ("No se puede eliminar este Cobrador porque tiene proveedores asociados.");
				location.href="eliminar_cobrador.php?codcobrador=<? echo $codcobrador?>";
			</script>
		<?php } else {
				$query="UPDATE cobradores SET borrado=1 WHERE codcobrador='$codcobrador'";
				$rs_query=mysql_query($query);
				if ($rs_query) { $mensaje="El Cobrador ha sido eliminado correctamente"; }
				$cabecera1="Inicio >> Cobrador &gt;&gt; Eliminar Cobrador ";
				$cabecera2="ELIMINAR COBRADOR ";
				$query_mostrar="SELECT * FROM cobradores WHERE codcobrador='$codcobrador'";
				$rs_mostrar=mysql_query($query_mostrar);
				@$codcobrador=mysql_result($rs_mostrar,0,"codcobrador");
				@$nombrecobrador=mysql_result($rs_mostrar,0,"nombrecobrador");
			}
	}
}

?>

<html>
	<head>
		<title>CodeKa Mx , Guardar Cobrador</title>
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
							<td width="85%" colspan="2"><?php echo $codcobrador?></td>
					    </tr>
						<tr>
							<td width="15%">Nombre Cobrador</td>
						    <td width="85%" colspan="2"><?php echo $nombrecobrador?></td>
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
