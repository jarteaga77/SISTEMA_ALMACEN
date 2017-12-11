<?php 
header('Cache-Control: no-cache');
header('Pragma: no-cache'); 
error_reporting(0);
include ("../conectar.php"); 
include ("../funciones/fechas.php"); 

include("../barcode/barcode.php");


$codvehiculo=$_GET["codvehiculo"];
$cadena_busqueda=$_GET["cadena_busqueda"];

$query="SELECT * FROM vehiculos_equipos WHERE id_vehiculo='$codvehiculo'";
$rs_query=mysql_query($query);
//$codigobarras=mysql_result($rs_query,0,"codigobarras");
?>
<html>
	<head>
		<title>Principal</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
		<script type="text/javascript" src="../funciones/validar.js"></script>
        
        <link href="../calendario/calendar-blue.css" rel="stylesheet" type="text/css">
        
        <script type="text/JavaScript" language="javascript" src="../calendario/calendar.js"></script>

		<script type="text/JavaScript" language="javascript" src="../calendario/lang/calendar-sp.js"></script>

		<script type="text/JavaScript" language="javascript" src="../calendario/calendar-setup.js"></script>

		<script type="text/javascript" src="../funciones/validar.js"></script>

		<script language="javascript">
      
		
		var cursor;
		if (document.all) {
		// Está utilizando EXPLORER
		cursor='hand';
		} else {
		// Está utilizando MOZILLA/NETSCAPE
		cursor='pointer';
		}
		
		function cancelar() {
			location.href="index.php?cadena_busqueda=<? echo $cadena_busqueda?>";
		}
		
		function limpiar() {
			document.getElementById("placa").value="";
			document.getElementById("modelo").value="";
			document.getElementById("cc").value="";
			document.getElementById("chasis").value="";
			document.getElementById("motor").value="";
			document.formulario.cbocombus.options[0].selected = true;
			document.formulario.cbovehi.options[0].selected = true;
			document.formulario.cbolinea.options[0].selected = true;
			document.getElementById("licencia").value="";
			document.getElementById("soat").value="";
			document.getElementById("fechasoat").value="";
			document.getElementById("tecno").value="";
			document.getElementById("fechatecno").value="";
			document.getElementById("observaciones").value="";
			document.formulario.cboitems.options[0].selected = true;
		
		}
		
		</script>
	</head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    
	<body>
		<div id="pagina">
			<div id="zonaContenido">
				<div align="center">
    				<div id="tituloForm" class="header">MODIFICAR VEHICULO</div>
    				<div id="frmBusqueda">
                      
                                    <form id="formulario" name="formulario" method="post" action="guardar_vehiculo.php" enctype="multipart/form-data">
					<input id="accion" name="accion" value="modificar" type="hidden">
				<input id="id" name="id" value="<?php echo $codvehiculo?>" type="hidden">
				<input id="codvehiculo" name="codvehiculo" value="<?php echo $codvehiculo?>" type="hidden">
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
						<tr>
						<td width="20%">Placa</td>
						<?php $placa=mysql_result($rs_query,0,"placa_equipo");?>
					      <td colspan="2"><input name="areaplaca" id="areaplaca" value="<?php echo mysql_result($rs_query,0,"placa_equipo")?>" maxlength="6" class="cajaGrande" type="text"></td>
							 <td width="4%" rowspan="15" align="left" valign="top"><ul id="lista-errores"></ul></td>

                        
                        </tr>
                        
                        		<tr>
						<td width="20%">Modelo</td>
						<?php $modelo=mysql_result($rs_query,0,"modelo_equipo");?>
					      <td colspan="2"><input name="areamodelo" id="areamodelo" value="<?php echo mysql_result($rs_query,0,"modelo_equipo")?>" maxlength="20" class="cajaGrande" type="text"></td>
						</tr>
                        
                          <tr>
						<td width="20%">C.C</td>
						<?php $cc=mysql_result($rs_query,0,"CC_equipo");?>
					      <td colspan="2"><input name="areacc" id="areacc" value="<?php echo mysql_result($rs_query,0,"CC_equipo")?>" maxlength="5" class="cajaGrande" type="text"></td>
						</tr>
                     
                     
                            <tr>
						<td width="20%">N&uacute;mero de Chasis</td>
						<?php $chasis=mysql_result($rs_query,0,"num_chasis_equipo");?>
					      <td colspan="2"><input name="areachasis" id="areachasis" value="<?php echo mysql_result($rs_query,0,"num_chasis_equipo")?>" maxlength="20" class="cajaGrande" type="text"></td>
						</tr>   
                
                
                                 <tr>
						<td width="20%">N&uacute;mero de Motor</td>
						<?php $motor=mysql_result($rs_query,0,"num_motor_equipo");?>
					      <td colspan="2"><input name="areamotor" id="areamotor" value="<?php echo mysql_result($rs_query,0,"num_motor_equipo")?>" maxlength="20" class="cajaGrande" type="text"></td>
						</tr> 

	<?php 
						$combus=mysql_result($rs_query,0,"Tipo_Combustible_idTipo_Combustible");
					  	$query_combus="SELECT * FROM tipo_combustible ORDER BY name_combustible ASC";
						$res_combus=mysql_query($query_combus);
						$contador=0;
					  ?>
						<tr>
							<td width="11%">Tipo de Combustible</td>
							<td colspan="2"><select id="AcboCombus" name="AcboCombus" class="comboGrande">
							
								<option value="0">Seleccione Tipo de Combustible</option>
								<?php
								while ($contador < mysql_num_rows($res_combus)) { 
									if ($combus==mysql_result($res_combus,$contador,"idTipo_Combustible")) { ?>
								<option value="<?php echo mysql_result($res_combus,$contador,"idTipo_Combustible")?>" selected="selected"><?php echo mysql_result($res_combus,$contador,"name_combustible")?></option>
								<? } else { ?>
								<option value="<?php echo mysql_result($res_combus,$contador,"idTipo_Combustible")?>"><?php echo mysql_result($res_combus,$contador,"name_combustible")?></option>
								<? } 
								$contador++;
								} ?>				
								</select> 						</td>
				        </tr>
						

						<?php 
						$tipo=mysql_result($rs_query,0,"tipo_vehi_equi_id_tipo_vehi_equi");
					  	$query_tipo="SELECT * FROM tipo_vehi_equi ORDER BY nom_tipo ASC";
						$res_tipo=mysql_query($query_tipo);
						$contador=0;
					  ?>
						<tr>
							<td width="11%">Tipo de Vehiculo</td>
							<td colspan="2"><select id="Acbovehi" name="Acbovehi" class="comboGrande">
							
								<option value="0">Seleccione Tipo de Vehiculo</option>
								<?php
								while ($contador < mysql_num_rows($res_tipo)) { 
									if ($tipo==mysql_result($res_tipo,$contador,"id_tipo_vehi_equi")) { ?>
								<option value="<?php echo mysql_result($res_tipo,$contador,"id_tipo_vehi_equi")?>" selected="selected"><?php echo mysql_result($res_tipo,$contador,"nom_tipo")?></option>
								<? } else { ?>
								<option value="<?php echo mysql_result($res_tipo,$contador,"id_tipo_vehi_equi")?>"><?php echo mysql_result($res_tipo,$contador,"nom_tipo")?></option>
								<? } 
								$contador++;
								} ?>				
								</select> 						</td>
				        </tr>
						
   
              <?php 
						$linea=mysql_result($rs_query,0,"Linea_idLinea");
					  	$query_linea="SELECT li.idLinea, CONCAT(ma.marca,'-',li.name_linea)AS nom FROM linea li JOIN  	 marca_vehiculo ma ON li.marca_vehiculo_id_marca=ma.id_marca ORDER BY nom";
						$res_linea=mysql_query($query_linea);
						$contador=0;
					  ?>
						<tr>
							<td width="11%">Tipo Marca - Linea</td>
							<td colspan="2"><select id="AcboLinea" name="AcboLinea" class="comboGrande">
							
								<option value="0">Seleccione Marca - Linea</option>
								<?php
								while ($contador < mysql_num_rows($res_linea)) { 
									if ($linea==mysql_result($res_linea,$contador,"li.idLinea")) { ?>
								<option value="<?php echo mysql_result($res_linea,$contador,"li.idLinea")?>" selected="selected"><?php echo mysql_result($res_linea,$contador,"nom")?></option>
								<? } else { ?>
								<option value="<?php echo mysql_result($res_linea,$contador,"li.idLinea")?>"><?php echo mysql_result($res_linea,$contador,"nom")?></option>
								<? } 
								$contador++;
								} ?>				
								</select> 						</td>
				        </tr>
				

              <?php 
						$item=mysql_result($rs_query,0,"item_ccostos_id_item_ccostos");
					  	$query_item="SELECT * FROM item_ccostos ORDER BY nombre_item_ccostos";
						$res_item=mysql_query($query_item);
						$contador=0;
					  ?>
						<tr>
							<td width="11%">Área de pertencia</td>
							<td colspan="2"><select id="AcboItems" name="AcboItems" class="comboGrande">
							
								<option value="0">Seleccione Área de Pertenencia</option>
								<?php
								while ($contador < mysql_num_rows($res_item)) { 
									if ($item==mysql_result($res_item,$contador,"id_item_ccostos")) { ?>
								<option value="<?php echo mysql_result($res_item,$contador,"id_item_ccostos")?>" selected="selected"><?php echo mysql_result($res_item,$contador,"nombre_item_ccostos")?></option>
								<? } else { ?>
								<option value="<?php echo mysql_result($res_item,$contador,"id_item_ccostos")?>"><?php echo mysql_result($res_item,$contador,"nombre_item_ccostos")?></option>
								<? } 
								$contador++;
								} ?>				
								</select> 						</td>
				        </tr>	

                   <tr>
						<td width="20%">Licencia de Transito</td>
						<?php $licencia=mysql_result($rs_query,0,"licencia_transito_equipo");?>
					      <td colspan="2"><input name="arealicencia" id="arealicencia" value="<?php echo mysql_result($rs_query,0,"licencia_transito_equipo")?>" maxlength="20" class="cajaGrande" type="text"></td>
						</tr> 
                        
                        
                                <tr>
						<td width="20%">SOAT</td>
						<?php $soat=mysql_result($rs_query,0,"soat_equipo");?>
					      <td colspan="2"><input name="areasoat" id="areasoat" value="<?php echo mysql_result($rs_query,0,"soat_equipo")?>" maxlength="100" class="cajaGrande" type="text"></td>
						</tr>


	     
							<tr>
								<td>Fecha de vencimiento SOAT</td>
							<td colspan="2"><input NAME="fechasoat" type="text" class="cajaPequena" id="fechasoat" size="10" maxlength="10" readonly value="<?php echo implota(mysql_result($rs_query,0,"venci_soat_equipo"))?>"> <img src="../img/calendario.png" name="Image1" id="Image1" width="16" height="16" border="0" id="Image1" onMouseOver="this.style.cursor='pointer'">
        <script type="text/javascript">
					Calendar.setup(
					  {
					inputField : "fechasoat",
					ifFormat   : "%Y-%m-%d",
					button     : "Image1"
					  }
					);
		</script></td>
        </tr>
          <tr>
						<td width="20%">N&uacute;mero Tecnomecanica</td>
						<?php $tecno=mysql_result($rs_query,0,"num_tecno_meca");?>
					      <td colspan="2"><input name="areatecno" id="tecno" value="<?php echo mysql_result($rs_query,0,"num_tecno_meca")?>" maxlength="20" class="cajaGrande" type="text"></td>
				          <td width="4%" rowspan="15" align="left" valign="top"><ul id="lista-errores"></ul></td>
						</tr>
        
                        				<tr>
								<td>Fecha de vencimiento Tecnomecanica</td>
							<td colspan="2"><input NAME="fechatecno" type="text" class="cajaPequena" id="fechatecno" size="10" maxlength="10" readonly value="<?php echo implota(mysql_result($rs_query,0,"venci_tecno_meca"))?>"> <img src="../img/calendario.png" name="Image2" id="Image2" width="16" height="16" border="0" id="Image2" onMouseOver="this.style.cursor='pointer'">
        <script type="text/javascript">
					Calendar.setup(
					  {
					inputField : "fechatecno",
					ifFormat   : "%Y-%m-%d",
					button     : "Image2"
					  }
					);
		</script></td>
        </tr>
                        
                        		<tr>
							<td width="11%">Observaciones</td>
						    <td colspan="2"><textarea name="aobservaciones" cols="41" rows="2" id="aobservaciones" class="areaTexto"><?php echo mysql_result($rs_query,0,"novedad_vehi")?></textarea></td>
				        </tr>
						
						
               
				
				
					</table>
                      
                    </div> <!-- frmbusqueda> -->
                    <div id="botonBusqueda">
                      <img src="../img/botonaceptar.jpg" width="85" height="22" onClick="validar(formulario,true)" border="1" onMouseOver="style.cursor=cursor">
                      <img src="../img/botonlimpiar.jpg" width="69" height="22" onClick="limpiar()" border="1" onMouseOver="style.cursor=cursor">
                      <img src="../img/botoncancelar.jpg" width="85" height="22" onClick="cancelar()" border="1" onMouseOver="style.cursor=cursor">
                    </div> <!- botonBusqueda -->
                    </form>
			 </div>				
		  </div>
		</div>
	</body>
</html>