<?php
include ("../conectar.php"); 

$accion=$_POST["accion"];
if (!isset($accion)) { $accion=$_GET["accion"]; }

$nombrevendedor=$_POST["Anombrevendedor"];

if ($accion=="alta") {
	$query_operacion="INSERT INTO vendedores (codvendedor, nombrevendedor, borrado) 
					VALUES ('', '$nombrevendedor', '0')";					
	$rs_operacion=mysql_query($query_operacion);
	if ($rs_operacion) { $mensaje="El Vendedor ha sido dado de alta correctamente"; }
	$cabecera1="Inicio >> Vendedor &gt;&gt; Nuevo Vendedor ";
	$cabecera2="INSERTAR VENDEDOR ";
	$sel_maximo="SELECT max(codvendedor) as maximo FROM vendedores";
	$rs_maximo=mysql_query($sel_maximo);
	$codvendedor=mysql_result($rs_maximo,0,"maximo");
}

if ($accion=="modificar") {
	$codvendedor=$_POST["Zid"];
	$query="UPDATE vendedores SET nombrevendedor='$nombrevendedor', borrado=0 WHERE codvendedor='$codvendedor'";
	$rs_query=mysql_query($query);
	if ($rs_query) { $mensaje="Los datos deL Vendedor han sido modificados correctamente"; }
	$cabecera1="Inicio >> Vendedor &gt;&gt; Modificar Vendedor ";
	$cabecera2="MODIFICAR Vendedor ";
}

if ($accion=="baja") {
	$codvendedor=$_GET["codvendedor"];
	$query_comprobar="SELECT * FROM clientes WHERE codvendedor='$codvendedor' AND borrado=0";
	$rs_comprobar=mysql_query($query_comprobar);
   if ( @mysql_num_rows($rs_comprobar) > 0 ) {
		?><script>
			alert ("No se puede eliminar este Vendedor porque tiene clientes asociados.");
			location.href="eliminar_Vendedor.php?codvendedor=<?php echo $codvendedor?>";
		</script>
		<?php
	} else {
		$query_comprobar="SELECT * FROM proveedores WHERE codvendedor='$codvendedor' AND borrado=0";
		$rs_comprobar=mysql_query($query_comprobar);
		if ( @mysql_num_rows($rs_comprobar) > 0 ) {
			?><script>
				alert ("No se puede eliminar este Vendedor porque tiene proveedores asociados.");
				location.href="eliminar_Vendedor.php?codvendedor=<? echo $codvendedor?>";
			</script>
		<?php } else {
				$query="UPDATE vendedores SET borrado=1 WHERE codvendedor='$codvendedor'";
				$rs_query=mysql_query($query);
				if ($rs_query) { $mensaje="El Vendedor ha sido eliminado correctamente"; }
				$cabecera1="Inicio >> Vendedor &gt;&gt; Eliminar Vendedor ";
				$cabecera2="ELIMINAR Vendedor ";
				$query_mostrar="SELECT * FROM vendedores WHERE codvendedor='$codvendedor'";
				$rs_mostrar=mysql_query($query_mostrar);
				@$codvendedor=mysql_result($rs_mostrar,0,"codvendedor");
				@$nombrevendedor=mysql_result($rs_mostrar,0,"nombrevendedor");
			}
	}
}

?>

<html>
	<head>
		<title>CodeKa Mx , Guardar Vendedor</title>
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
							<td width="85%" colspan="2"><?php echo $codvendedor?></td>
					    </tr>
						<tr>
							<td width="15%">Nombre Vendedor</td>
						    <td width="85%" colspan="2"><?php echo $nombrevendedor?></td>
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
