<?php
header('Cache-Control: no-cache');
header('Pragma: no-cache'); 
?>
<html>
<head>
<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
</head>
<script language="javascript">

function pon_prefijo(nombre,nif) {
	parent.document.formulario.nombre.value=nombre;
	parent.document.formulario.nif.value=nif;
}

function limpiar() {
	parent.document.formulario.nombre.value="";
	parent.document.formulario.nif.value="";
	parent.document.formulario.codcliente.value="";
}

</script>
<? include ("../conectar.php"); ?>
<body>
<?
	$codcliente=$_GET["codcliente"];
	$consulta="SELECT id_item_ccostos FROM item_ccostos WHERE  id_item_ccostos='$codcliente' ";
	$rs_tabla = mysql_query($consulta);
	if (mysql_num_rows($rs_tabla)>0) {
		?>
		<script languaje="javascript">
		pon_prefijo("<? echo mysql_result($rs_tabla,0,nombre) ?>","<? echo mysql_result($rs_tabla,0,nif) ?>");
		</script>
		<? 
	} else { ?>
	<script>
	alert ("No existe ningun centro de costo con ese ID");
	limpiar();
	</script>
	<? }
?>
</div>
</body>
</html>
