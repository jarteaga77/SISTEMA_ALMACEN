<?php
header('Cache-Control: no-cache');
header('Pragma: no-cache'); 
?>
<html>
<head>
<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
</head>
<script language="javascript">

function pon_prefijo(nombre) {
	parent.document.form_busqueda.nombre.value=nombre;
}

function limpiar() {
	parent.document.form_busqueda.nombre.value="";
	parent.document.form_busqueda.codcliente.value="";
}

</script>
<? include ("../conectar.php"); ?>
<body>
<?
	$codcliente=$_GET["codcliente"];
	$consulta="SELECT item.id_item_ccostos,CONCAT(centro.nombre_ccostos, '-',  item.nombre_item_ccostos) AS nombre FROM 
                                                    centrocostos centro JOIN item_ccostos item ON centro.id_ccostos=item.id_ccostos WHERE item.id_item_ccostos='$codcliente'";
	$rs_tabla = mysql_query($consulta);
	if (mysql_num_rows($rs_tabla)>0) {
		?>
		<script languaje="javascript">
		pon_prefijo("<? echo mysql_result($rs_tabla,0,nombre) ?>");
		</script>
		<? 
	} else { ?>
	<script>
	alert ("No existe ningun Centro de Costos con ese ID");
	limpiar();
	</script>
	<? }
?>
</div>
</body>
</html>
