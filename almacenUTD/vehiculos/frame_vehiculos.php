<?php
header('Cache-Control: no-cache');
header('Pragma: no-cache'); 
?>
<html>
<head>
<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
</head>
<script language="javascript">

function pon_prefijo(codvehiculo) {
	parent.opener.document.form_busqueda.codvehiculo.value=codvehiculo;
	parent.window.close();
}

</script>
<? include ("../conectar.php"); 
$tipo=$_POST["cmbtipo"];
$placa=$_POST["placa"];
$where="1=1";

//if ($linea<>0) { $where.=" AND vehiculos_equipos.Linea_idLinea='$linea'"; }
//if ($ccostos<>"") { $where.=" AND vehiculos_equipos.item_ccostos_id_item_ccostos='$ccostos'"; }
if ($tipo<>0) { $where.=" AND ve.tipo_vehi_equi_id_tipo_vehi_equi='$tipo'"; }
if ($placa<>"") { $where.=" AND ve.placa_equipo like '%$placa%'"; } ?>


<body>
<?
	
	$consulta="SELECT ve.id_vehiculo,ve.placa_equipo,ve.tipo_vehi_equi_id_tipo_vehi_equi,li.name_linea,item.nombre_item_ccostos,tipo.nom_tipo, ma.marca FROM vehiculos_equipos ve,linea li,item_ccostos item, tipo_vehi_equi tipo, marca_vehiculo ma WHERE " .$where. " AND ve.Linea_idLinea=li.idLinea AND ve.item_ccostos_id_item_ccostos=item.id_item_ccostos AND ve.tipo_vehi_equi_id_tipo_vehi_equi=tipo.id_tipo_vehi_equi AND ma.id_marca=li.marca_vehiculo_id_marca ";
	$rs_tabla = mysql_query($consulta);
	$nrs=mysql_num_rows($rs_tabla);
?>
<div id="tituloForm2" class="header">
<div align="center">
<form id="form1" name="form1">
<? if ($nrs>0) { ?>
		<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
		  <tr>
			<td width="20%"><div align="center"><b>Placa</b></div></td>
			<td width="20%"><div align="center"><b>Tipo</b></div></td>
			<td width="40%"><div align="center"><b>Marca-Linea</b></div></td>
			<td width="10%"><div align="center"><b>Dependencia</b></div></td>
			<td width="10%"><div align="center"></td>
		  </tr>
		<?php
			for ($i = 0; $i < mysql_num_rows($rs_tabla); $i++) {
				$placa=mysql_result($rs_tabla,$i,"ve.placa_equipo");
				$tipo=mysql_result($rs_tabla,$i,"tipo.nom_tipo");
				$codtipo=mysql_result($rs_tabla,$i,"ve.tipo_vehi_equi_id_tipo_vehi_equi");
				$codvehiculo=mysql_result($rs_tabla,$i,"ve.id_vehiculo");
				$linea=mysql_result($rs_tabla,$i,"li.name_linea");				
				$dependencia=mysql_result($rs_tabla,$i,"item.nombre_item_ccostos");
				$marca=mysql_result($rs_tabla,$i,"ma.marca");
		
				 if ($i % 2) { $fondolinea="itemParTabla"; } else { $fondolinea="itemImparTabla"; }?>
						<tr class="<?php echo $fondolinea?>">
					<td>
        <div align="center"><?php echo $placa;?></div></td>
					<td>
        <div align="left"><?php echo $tipo;?></div></td>
					<td><div align="center"><?php echo $marca . "-" . $linea ?></div></td>
					<td><div align="center"><?php echo $dependencia;?></div></td>
					<td align="center"><div align="center"><a href="javascript:pon_prefijo(<? echo $codvehiculo?>)"><img src="../img/convertir.png" border="0" title="Seleccionar"></a></div></td>					
				</tr>
			<?php }
		?>
  </table>
		<?php 
		}  ?>
<iframe id="frame_datos" name="frame_datos" width="0%" height="0" frameborder="0">
	<ilayer width="0" height="0" id="frame_datos" name="frame_datos"></ilayer>
</iframe>
<input type="hidden" id="accion" name="accion">
</form>
</div>
</div>
</body>

</html>
