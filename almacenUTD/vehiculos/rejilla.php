<?php

include ("../conectar.php");
error_reporting (0);

$codvehiculo=$_POST["codvehiculo"];
$placa=$_POST["placa"];
$linea=$_POST["AcboLineas"];
//$linea=18;
$tipo=$_POST["AcboTipo"];
//$tipo=1;
$dependencia=$_POST["AcboDepe"];
//$dependecia=41;


$cadena_busqueda=$_POST["cadena_busqueda"];

$where=" 1=1";
if ($codvehiculo <> "") { $where.=" AND id_vehiculo='$codvehiculo'"; }
if ($placa <> "") { $where.=" AND placa_equipo like '%".$placa."%'"; }
if ($linea > "0") { $where.=" AND Linea_idLinea='$linea'"; }
if ($tipo > "0") { $where.=" AND tipo_vehi_equi_id_tipo_vehi_equi='$tipo'"; }
if ($dependencia > "0") { $where.=" AND item_ccostos_id_item_ccostos='$dependencia'"; }


//$where.=" ORDER BY id_vehiculo ASC";
$query_busqueda="SELECT count(*) as filas FROM vehiculos_equipos where estado_vehi=1 AND ".$where;
$rs_busqueda=mysql_query($query_busqueda);
$filas=mysql_result($rs_busqueda,0,"filas");

?>
<html> 
	<head>
		<title>Vehiculos</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
		<script language="javascript">
		
		function ver_vehiculo(codvehiculo) {
			parent.location.href="ver_vehiculo.php?codvehiculo=" + codvehiculo + "&cadena_busqueda=<? echo $cadena_busqueda?>";
		}
		
		function modificar_vehiculo(codvehiculo) {
			parent.location.href="modificar_vehiculo.php?codvehiculo=" + codvehiculo + "&cadena_busqueda=<? echo $cadena_busqueda?>";
		}
		
				function nueva_imagen(codvehiculo) {
			parent.location.href="ingresar_imagen.php?codvehiculo=" + codvehiculo + "&cadena_busqueda=<? echo $cadena_busqueda?>";
		}
		
		function cambiar_imagen(codvehiculo) {
			parent.location.href="cambiar_imagen.php?codvehiculo=" + codvehiculo + "&cadena_busqueda=<? echo $cadena_busqueda?>";
		}
		


		function inicio() {
			var numfilas=document.getElementById("numfilas").value;
			var indi=parent.document.getElementById("iniciopagina").value;
			var contador=1;
			var indice=0;
			if (indi>numfilas) { 
				indi=1; 
			}
			parent.document.form_busqueda.filas.value=numfilas;
			parent.document.form_busqueda.paginas.innerHTML="";		
			while (contador<=numfilas) {
				texto=contador + "-" + parseInt(contador+9);
				if (indi==contador) {
					parent.document.form_busqueda.paginas.options[indice]=new Option (texto,contador);
					parent.document.form_busqueda.paginas.options[indice].selected=true;
				} else {
					parent.document.form_busqueda.paginas.options[indice]=new Option (texto,contador);
				}
				indice++;
				contador=contador+10;
			}
		}
		</script>
	</head>

	<body onload=inicio()>	
		<div id="pagina">
			<div id="zonaContenidoPP">
			<div align="center">
			<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">
			<input type="hidden" name="numfilas" id="numfilas" value="<? echo $filas?>">
				<? $iniciopagina=$_POST["iniciopagina"];
				if (empty($iniciopagina)) { $iniciopagina=$_GET["iniciopagina"]; } else { $iniciopagina=$iniciopagina-1;}
				if (empty($iniciopagina)) { $iniciopagina=0; }
				if ($iniciopagina>$filas) { $iniciopagina=0; }
					if ($filas > 0) { ?>
						<? $sel_resultado="SELECT * FROM vehiculos_equipos where estado_vehi=1 AND".$where ;
						   $sel_resultado=$sel_resultado." limit ".$iniciopagina.",10";
						   $res_resultado=mysql_query($sel_resultado);
						   $contador=0;
						   $idvehiculo=mysql_result($res_resultado,$contador,"id_vehiculo");
						   while ($contador < mysql_num_rows($res_resultado)) { 
						   		if ($i % 2) { $fondolinea="itemParTabla"; } else { $fondolinea="itemImparTabla";}?>
							<tr class="<?php echo $fondolinea?>">
							<td class="aCentro" width="12%"><? echo $contador+1;?></td>
							<td width="9%"><div align="center"><? echo mysql_result($res_resultado,$contador,"id_vehiculo")?></div></td>
							<td width="10%"><div align="left"><? echo mysql_result($res_resultado,$contador,"placa_equipo")?></div></td>
							<td width="12%"><div align="left">
							<? $codtipo=mysql_result($res_resultado,$contador,"tipo_vehi_equi_id_tipo_vehi_equi");
							$query_tipo="SELECT nom_tipo FROM tipo_vehi_equi WHERE id_tipo_vehi_equi='$codtipo'";
							$rs_tipo=mysql_query($query_tipo);
							$nombre_tipo=mysql_result($rs_tipo,0,"nom_tipo");
							echo $nombre_tipo;			
							?>
                              <td width="23%"><div align="center">
							<? $codlinea=mysql_result($res_resultado,$contador,"Linea_idLinea");
							$query_linea="SELECT CONCAT(ma.marca,'-', li.name_linea)AS nom FROM linea li JOIN 		                             marca_vehiculo ma ON li.marca_vehiculo_id_marca= ma.id_marca WHERE li.idLinea='$codlinea'";
							$rs_linea=mysql_query($query_linea);
							$nombre_linea=mysql_result($rs_linea,0,"nom");
							
							//print_r($rs_linea);
							echo $nombre_linea;			
							?>
                            <td width="18%">  <div align="center">
							  <? $coddepe=mysql_result($res_resultado,$contador,"item_ccostos_id_item_ccostos");
							$query_depe="SELECT nombre_item_ccostos FROM item_ccostos WHERE id_item_ccostos='$coddepe'";
							$rs_depe=mysql_query($query_depe);
							$nombre_depe=mysql_result($rs_depe,0,"nombre_item_ccostos");
							echo $nombre_depe;			
							?>
                                                                
							</div></td>
							
                                                        <td width="5%"><div align="center"><a href="#"><img src="../img/modificar.png" width="16" height="16" border="0" onClick="modificar_vehiculo(<?php echo mysql_result($res_resultado,$contador,"id_vehiculo")?>)" title="Modificar"></a></div></td>
                                                        <td width="5%"><div align="center"><a href="#"><img src="../img/ver.png" width="16" height="16" border="0" onClick="ver_vehiculo(<?php echo mysql_result($res_resultado,$contador,"id_vehiculo")?>)" title="Visualizar"></a></div></td>
            
            					<td width="6%"><div align="center"><a href="#"><img src="../img/img_change.gif" width="16" height="16" border="0" onClick="nueva_imagen(<?php echo mysql_result($res_resultado,$contador,"id_vehiculo")?>)" title="Nueva imagen"></a></div></td>
                                                                  
							<td width="6%"><div align="center"><a href="#"><img src="../img/img_change.gif" width="16" height="16" border="0" onClick="cambiar_imagen(<?php echo mysql_result($res_resultado,$contador,"id_vehiculo")?>)" title="Modificar imagen"></a></div></td>
						</tr>
						<? $contador++;
							}
						?>			
					</table>
					<? } else { ?>
					<table class="fuente8" width="87%" cellspacing=0 cellpadding=3 border=0>
						<tr>
							<td width="100%" class="mensaje"><?php echo "No hay ning&uacute;n Vehiculo que cumpla con los criterios de b&uacute;squeda";?></td>
					    </tr>
					</table>					
					<? } ?>					
				</div>
			</div>
		  </div>			
		</div>
        
        
          
		 
	</body>
    
</html>
