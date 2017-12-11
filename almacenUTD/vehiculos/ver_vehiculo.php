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
			location.href="index.php?cadena_busqueda=<?php echo $cadena_busqueda?>";
		}
		
		</script>
	</head>
	<body>
		<div id="pagina">
			<div id="zonaContenido">
				<div align="center">
				<div id="tituloForm" class="header">VER VEHICULO</div>
				<div id="frmBusqueda">
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
						<tr>
							<td width="22%">Placa</td>
						    <td width="38%"><?php echo mysql_result($rs_query,0,"placa_equipo")?></td>
					        <td width="40%" rowspan="11" align="center" valign="top"><img src="../fotos_vehi/<?php echo mysql_result($rs_query,0,"imagen")?>" width="160px" height="140px" border="1"></td>
						</tr>
						<tr>
							<td width="22%">Modelo</td>
							<td width="38%"><?php echo mysql_result($rs_query,0,"modelo_equipo")?></td>
				        </tr>
						
						<tr>
							<td width="22%">C.C</td>
						    <td width="38%"><?php echo mysql_result($rs_query,0,"CC_equipo")?></td>
				        </tr>
						<tr>
							<td width="22%">N&uacute;mero de Chasis</td>
							<td width="38%"><?php echo mysql_result($rs_query,0,"num_chasis_equipo")?></td>
				        </tr>
                                        
                                        <tr>
							<td width="22%">N&uacute;mero de Motor</td>
							<td width="38%"><?php echo mysql_result($rs_query,0,"num_motor_equipo")?></td>
				        </tr>
                                        
                                         <tr>
							<td width="22%">Licencia de Transito</td>
							<td width="38%"><?php echo mysql_result($rs_query,0,"licencia_transito_equipo")?></td>
				        </tr>
                                        
                                          <tr>
							<td width="22%">SOAT</td>
							<td width="38%"><?php echo mysql_result($rs_query,0,"soat_equipo")?></td>
				        </tr>
                                        
                                            <tr>
							<td width="22%">Vencimiento del SOAT</td>
							<td width="38%"><?php echo mysql_result($rs_query,0,"venci_soat_equipo")?></td>
				        </tr>
                                        
                                           <tr>
							<td width="22%">N&uacute;mero de la Tecnomecanica</td>
							<td width="38%"><?php echo mysql_result($rs_query,0,"num_tecno_meca")?></td>
				        </tr>
                                        
                                         <tr>
							<td width="22%">Vencimiento de la Tecnomecanica</td>
							<td width="38%"><?php echo mysql_result($rs_query,0,"venci_tecno_meca")?></td>
				        </tr>
                                        
                                        
					  <?php
					  	$codcombustible=mysql_result($rs_query,0,"Tipo_Combustible_idTipo_Combustible");
					  	if ($codcombustible<>0) {
							$query_combustible="SELECT * FROM tipo_combustible WHERE idTipo_Combustible='$codcombustible'";
							$res_combustible=mysql_query($query_combustible);
							$nombrecombustible=mysql_result($res_combustible,0,"name_combustible");
						} else {
							$nombrecombustible="Sin determinar";
						}
					  ?>
						<tr>
							<td width="22%">Tipo Combustible</td>
							<td width="38%"><?php echo $nombrecombustible?></td>
				        </tr>
                                        
                                         <?php
					  	$codtipo=mysql_result($rs_query,0,"tipo_vehi_equi_id_tipo_vehi_equi");
					  	if ($codtipo<>0) {
							$query_tipo="SELECT * FROM tipo_vehi_equi WHERE id_tipo_vehi_equi='$codtipo'";
							$res_tipo=mysql_query($query_tipo);
							$nombretipo=mysql_result($res_tipo,0,"nom_tipo");
						} else {
							$nombretipo="Sin determinar";
						}
					  ?>
						<tr>
							<td width="22%">Tipo de Vehiculo</td>
							<td width="38%"><?php echo $nombretipo?></td>
				        </tr>
                                        
                                        
                                            <?php
					  	$codlinea=mysql_result($rs_query,0,"Linea_idLinea");
					  	if ($codlinea<>0) {
							$query_linea="SELECT CONCAT(ma.marca, '-', li.name_linea) AS nom FROM linea li JOIN marca_vehiculo ma ON li.marca_vehiculo_id_marca= ma.id_marca WHERE li.idLinea='$codlinea'";
							$res_linea=mysql_query($query_linea);
							$nombrelinea=mysql_result($res_linea,0,"nom");
						} else {
							$nombrelinea="Sin determinar";
						}
					  ?>
						<tr>
							<td width="22%">Marca-Linea</td>
							<td width="38%"><?php echo $nombrelinea?></td>
				        </tr>
                        
                                                   <?php
					  	$coddepe=mysql_result($rs_query,0,"item_ccostos_id_item_ccostos");
					  	if ($coddepe<>0) {
							$query_depe="SELECT id_item_ccostos,nombre_item_ccostos FROM item_ccostos WHERE id_item_ccostos='$coddepe'";
							$res_depe=mysql_query($query_depe);
							$nombredepe=mysql_result($res_depe,0,"nombre_item_ccostos");
						} else {
							$nombredepe="Sin determinar";
						}
					  ?>
						<tr>
							<td width="22%">Marca-Linea</td>
							<td width="38%"><?php echo $nombredepe?></td>
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
