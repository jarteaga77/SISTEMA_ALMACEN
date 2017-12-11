<?php
include ("../security.php");
error_reporting (0);
header('Cache-Control: no-cache');
header('Pragma: no-cache'); 

include ("../conectar.php");

$cadena_busqueda=$_GET["cadena_busqueda"];

if (!isset($cadena_busqueda)) { $cadena_busqueda=""; } else { $cadena_busqueda=str_replace("",",",$cadena_busqueda); }

if ($cadena_busqueda<>"") {
	$array_cadena_busqueda=split("~",$cadena_busqueda);
	
        $codvehiculo=$array_cadena_busqueda[1];
        $placa=$array_cadena_busqueda[2];
		$linea=$array_cadena_busqueda[3];
		$tipo=$array_cadena_busqueda[4];
		$dependencia=$array_cadena_busqueda[5];
	
} else {
$codvehiculo="";
        
	$placa="";
	$linea="";
	$dependencia="";
}

?>
<html>
	<head>
		<title>Vehiculos</title>
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
		
		function inicio() {
			document.getElementById("form_busqueda").submit();
		}
		function nuevo_vehiculo() {
			location.href="nuevo_vehiculo.php";
		}
		
		function imprimir() {
			var codvehiculo=document.getElementById("codvehiculo").value;
			var placa=document.getElementById("placa").value;
			var linea=document.getElementById("cboLineas").value;
			var dependencia=document.getElementById("cboDepe").value;			
			var tipo=document.getElementById("cboTipo").value;
		
			window.open("../fpdf/vehiculos.php?codvehiculo="+codvehiculo+"&placa="+placa+"&linea="+linea+"&dependencia="+dependencia+"&tipo="+tipo);
		}
		
		function limpiar_busqueda() {
			
                        document.getElementById("codvehiculo").value="";
                        document.getElementById("placa").value="";
			document.form_busqueda.cboLineas.options[0].selected = true;
			document.form_busqueda.cboDepe.options[0].selected = true;
			document.form_busqueda.cboTipo.options[0].selected = true;
		}
		
		function buscar() {
			var cadena;
			cadena=hacer_cadena_busqueda();
			document.getElementById("cadena_busqueda").value=cadena;
			if (document.getElementById("iniciopagina").value=="") {
				document.getElementById("iniciopagina").value=1;
			} else {
				document.getElementById("iniciopagina").value=document.getElementById("paginas").value;
			}
			document.getElementById("form_busqueda").submit();
		}
		
		function paginar() {
			document.getElementById("iniciopagina").value=document.getElementById("paginas").value;
			document.getElementById("form_busqueda").submit();
		}
		
		function hacer_cadena_busqueda() {
			
			
			
			var codvehiculo=document.getElementById("codvehiculo").value;	 
			var placa=document.getElementById("placa").value;			
			var linea=document.getElementById("cboLineas").value;
			//alert (linea);
			
			var tipo=document.getElementById("cboTipo").value;
			var dependencia=document.getElementById("cboDepe").value;
			var cadena="";
			cadena="~"+codvehiculo+"~"+placa+"~"+linea+"~"+tipo+"~"+dependencia;
			return cadena;
			}
		
		function ventanaVehiculo(){
			miPopup = window.open("ventana_vehiculo.php","miwin","width=700,height=500,scrollbars=yes");
			miPopup.focus();
		}

		</script>
	</head>
	<body onLoad="inicio()">
		<div id="pagina">
			<div id="zonaContenido">
				<div align="center">
				<div id="tituloForm" class="header">Buscar VEHICULOS - EQUIPOS </div>
				<div id="frmBusqueda">
				<form id="form_busqueda" name="form_busqueda" method="post" action="rejilla.php" target="frame_rejilla">
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>					
						<tr>
							<td width="16%">C&oacute;digo del vehiculo </td>
                                                        <td width="68%"><input id="codvehiculo" type="text" class="cajaPequena" NAME="codvehiculo" maxlength="15" value="<? echo $codvehiculo?>" readonly> <img src="../img/ver.png" width="16" height="16" onClick="ventanaVehiculo()" onMouseOver="style.cursor=cursor" title="Buscar Vehiculos"></td>
							<td width="5%">&nbsp;</td>
							<td width="5%">&nbsp;</td>
							<td width="6%" align="right"></td>
						</tr>
						<tr>
							<td>Placa</td>
							<td><input id="placa" name="placa" type="text" class="cajaGrande" maxlength="6" value="<? echo $placa?>"></td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<?php
						//$linea=mysql_result($rs_query,0,"idLinea");
					  	$query_lineas="SELECT li.idLinea,CONCAT(ma.marca,'-',li.name_linea)AS nom FROM linea li JOIN marca_vehiculo ma ON 		  		                         li.marca_vehiculo_id_marca=ma.id_marca ";
						$res_lineas=mysql_query($query_lineas);
						$contador=0;
                                                ?>
						<tr>
							<td width="11%">Lineas</td>
                                                        <td colspan="2"><select id="cboLineas" name="AcboLineas" class="comboGrande">
                                      	<option value="0">Seleccione la Linea</option>

								<?php

								while ($contador < mysql_num_rows($res_lineas)) { ?>

								<option value="<?php echo mysql_result($res_lineas,$contador,"li.idLinea")?>"><?php echo mysql_result($res_lineas,$contador,"nom")?></option>

								<? $contador++;

								} ?>				

								</select>							</td>

				        </tr>
                                        
                                        <?php
					  	$query_tipo="SELECT id_tipo_vehi_equi,nom_tipo FROM tipo_vehi_equi ORDER BY nom_tipo ASC";
						$res_tipo=mysql_query($query_tipo);
						$contador=0;
					  ?>
			<tr>
							<td width="11%">Tipo Vehiculo</td>
						  <td colspan="2"><select id="cboTipo" name="AcboTipo" class="comboGrande">
                         	<option value="0">Seleccione Tipo de Vehiculo </option>

								<?php

								while ($contador < mysql_num_rows($res_tipo)) { ?>

								<option value="<?php echo mysql_result($res_tipo,$contador,"id_tipo_vehi_equi")?>"><?php echo mysql_result($res_tipo,$contador,"nom_tipo")?></option>

								<? $contador++;

								} ?>				

								</select>							</td>

				        </tr>
                        
					<?php
					  	$query_item="SELECT id_item_ccostos,nombre_item_ccostos FROM item_ccostos WHERE id_ccostos=4 ORDER BY nombre_item_ccostos ASC";
						$res_item=mysql_query($query_item);
						$contador=0;
					  ?>
			<tr>
							<td width="11%">Dependencias</td>
						  <td colspan="2"><select id="cboDepe" name="AcboDepe" class="comboGrande">
                         	<option value="0">Seleccione la Dependencia </option>

								<?php

								while ($contador < mysql_num_rows($res_item)) { ?>

								<option value="<?php echo mysql_result($res_item,$contador,"id_item_ccostos")?>"><?php echo mysql_result($res_item,$contador,"nombre_item_ccostos")?></option>

								<? $contador++;

								} ?>				

								</select>							</td>

				        </tr>
					
					</table>
			        <div id="botonBusqueda"><img src="../img/botonbuscar.jpg" width="69" height="22" border="1" onClick="buscar()" onMouseOver="style.cursor=cursor">
			 	  <img src="../img/botonlimpiar.jpg" width="69" height="22" border="1" onClick="limpiar_busqueda()" onMouseOver="style.cursor=cursor">
					 <img src="../img/botonnuevovehi.jpg" width="111" height="22" border="1" onClick="nuevo_vehiculo()" onMouseOver="style.cursor=cursor">
					<img src="../img/botonimprimir.jpg" width="79" height="22" border="1" onClick="imprimir()" onMouseOver="style.cursor=cursor">
					</div>				
			  <div id="lineaResultado">
			  <table class="fuente8" width="80%" cellspacing=0 cellpadding=3 border=0>
			  	<tr>
				<td width="50%" align="left">N de vehiculos encontrados <input id="filas" type="text" class="cajaPequena" NAME="filas" maxlength="5" readonly></td>
				<td width="50%" align="right">Mostrados <select name="paginas" id="paginas" onChange="paginar()">
		          </select></td>
			  </table>
				</div>
				<div id="cabeceraResultado" class="header">
					Relacion de VEHICULOS </div>
				<div id="frmResultado">
				<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">
						<tr class="cabeceraTabla">
							<td width="5%">ITEM</td>
							<td width="5%">COD</td>
							<td width="10%">PLACA</td>
							<td width="10%">TIPO</td>
							<td width="10%">LINEA</td>
							<td width="20%">DEPENDENCIA</td>
							<td width="5%">&nbsp;</td>
							<td width="5%">&nbsp;</td>
							<td width="5%">&nbsp;</td>
							<td width="5%">&nbsp;</td>
						</tr>
				</table>
				</div>
				<input type="hidden" id="iniciopagina" name="iniciopagina">
				<input type="hidden" id="cadena_busqueda" name="cadena_busqueda">
			</form>
				<div id="lineaResultado_pagos">
					<iframe width="100%" height="250" id="frame_rejilla" name="frame_rejilla" frameborder="0">
						<ilayer width="100%" height="250" id="frame_rejilla" name="frame_rejilla"></ilayer>
					</iframe>
				</div>
			</div>
		  </div>			
		</div>
	</body>
</html>
