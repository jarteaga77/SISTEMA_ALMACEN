<?php 
header('Cache-Control: no-cache');
header('Pragma: no-cache'); 
error_reporting(0);
include ("../conectar.php"); 
include ("../funciones/fechas.php");
include("../barcode/barcode.php");


$codarticulo=$_GET["codarticulo"];
$cadena_busqueda=$_GET["cadena_busqueda"];

$query="SELECT * FROM articulos WHERE codarticulo='$codarticulo'";
$rs_query=mysql_query($query);
$codigobarras=mysql_result($rs_query,0,"codigobarras");

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
				<div id="tituloForm" class="header">VER ARTICULO</div>
				<div id="frmBusqueda">
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
						<tr>
							<td width="22%">Codigo</td>
						    <td width="38%"><?php echo mysql_result($rs_query,0,"codarticulo")?></td>
					        <td width="40%" rowspan="11" align="center" valign="top"><img src="../fotos_articulos/<?php echo mysql_result($rs_query,0,"imagen")?>" width="160px" height="140px" border="1"></td>
						</tr>
						<tr>
							<td width="22%">Referencia</td>
							<?php $referencia=mysql_result($rs_query,0,"referencia"); ?>
							<td width="38%"><?php echo mysql_result($rs_query,0,"referencia")?></td>
				        </tr>
						<?php
						$codfamilia=mysql_result($rs_query,0,"codfamilia");
					  	$query_familia="SELECT * FROM familias WHERE codfamilia='$codfamilia'";
						$res_familia=mysql_query($query_familia);
						$nombrefamilia=mysql_result($res_familia,0,"nombre");
					  ?>
						<tr>
							<td width="22%">Familia</td>
							<td width="38%"><?php echo $nombrefamilia?></td>
				        </tr>
						<tr>
							<td width="22%">Descripci&oacute;n</td>
						    <td width="38%"><?php echo mysql_result($rs_query,0,"descripcion")?></td>
				        </tr>
						<tr>
						  <td>Impuesto</td>
						  <td><?php echo mysql_result($rs_query,0,"impuesto")?> %</td>
				      </tr>
					  <?php
					  	$codproveedor1=mysql_result($rs_query,0,"codproveedor1");
					  	if ($codproveedor1<>0) {
							$query_proveedor="SELECT * FROM proveedores WHERE codproveedor='$codproveedor1'";
							$res_proveedor=mysql_query($query_proveedor);
							$nombreproveedor=mysql_result($res_proveedor,0,"nombre");
						} else {
							$nombreproveedor="Sin determinar";
						}
					  ?>
						<tr>
							<td width="22%">Proveedor1</td>
							<td width="38%"><?php echo $nombreproveedor?></td>
				        </tr>
					<?php
						$codproveedor2=mysql_result($rs_query,0,"codproveedor2");
					  	if ($codproveedor2<>0) {
							$query_proveedor="SELECT * FROM proveedores WHERE codproveedor='$codproveedor2'";
							$res_proveedor=mysql_query($query_proveedor);
							$nombreproveedor=mysql_result($res_proveedor,0,"nombre");
						} else {
							$nombreproveedor="Sin determinar";
						}
					  ?>
						<tr>
							<td width="22%">Proveedor2</td>
							<td width="38%"><?php echo $nombreproveedor?></td>
				        </tr>
						<tr>
							<td width="22%">Descripci&oacute;n corta</td>
						    <td width="38%"><?php echo mysql_result($rs_query,0,"descripcion_corta")?></td>
				        </tr>
 <?php
                                                $codubicacion=mysql_result($rs_query,0,"codubicacion");
                                                if ($codubicacion<>0) {
                                                        $query_ubicacion="SELECT * FROM ubicaciones WHERE codubicacion='$codubicacion'";
                                                        $res_ubicacion=mysql_query($query_ubicacion);
                                                        $nombreubicacion=mysql_result($res_ubicacion,0,"nombre");
                                                } else {
                                                        $nombreubicacion="Sin determinar";
                                                }
                                          ?>
                                                <tr>
                                                        <td width="22%">Ubicaci&oacute;n</td>
                                                        <td width="38%"><?php echo $nombreubicacion?></td>
                                        </tr>
						<?php
						$codubicacion2=mysql_result($rs_query,0,"codubicacion2");
					  	if ($codubicacion2<>0) {
							$query_ubicacion2="SELECT * FROM ubicaciones WHERE codubicacion='$codubicacion2'";
							$res_ubicacion2=mysql_query($query_ubicacion2);
							$nombreubicacion2=mysql_result($res_ubicacion2,0,"nombre");
						} else {
							$nombreubicacion2="Sin determinar";
						}
					  ?>
						<tr>
							<td width="22%">2da. Ubicaci&oacute;n</td>
							<td width="38%"><?php echo $nombreubicacion2?></td>
				        </tr>

						


						<tr>
							<td>Stock</td>
							<td><?php echo mysql_result($rs_query,0,"stock")?> unidades</td>
					    </tr>
						<tr>
							<td>Stock minimo</td>
							<td><?php echo mysql_result($rs_query,0,"stock_minimo")?> unidades</td>
					    </tr>
						<tr>
							<td>Aviso M&iacute;nimo</td>
							<td colspan="2"><?php if (mysql_result($rs_query,0,"aviso_minimo")==0) { echo "No"; } else { echo "Si"; }?></td>
						</tr>
						<tr>
							<td width="22%">Datos del producto</td>
							<td colspan="2"><?php echo mysql_result($rs_query,0,"datos_producto")?></td>
					    </tr>
						<tr>
							<td width="22%">Fecha de alta</td>
							<td colspan="2"><?php echo mysql_result($rs_query,0,"fecha_alta")?></td>
					    </tr>
                        
                        <tr>
							<td width="22%">Fecha de vencimiento</td>
							<td colspan="2"><?php echo mysql_result($rs_query,0,"fecha_venci")?></td>
					    </tr>
						<?php
						$codembalaje=mysql_result($rs_query,0,"codembalaje");
					  	if ($codembalaje<>0) {
							$query_embalaje="SELECT * FROM embalajes WHERE codembalaje='$codembalaje'";
							$res_embalaje=mysql_query($query_embalaje);
							$nombreembalaje=mysql_result($res_embalaje,0,"nombre");
						} else {
							$nombreembalaje="Sin determinar";
						}
					  ?>
						<tr>
							<td width="22%">Embalaje</td>
							<td colspan="2"><?php echo $nombreembalaje?></td>
					    </tr>
						<tr>
							<td>Unidades por caja</td>
							<td colspan="2"><?php echo mysql_result($rs_query,0,"unidades_caja")?> unidades</td>
						</tr>
						<tr>
							<td>Preguntar precio ticket</td>
							<td colspan="2"><?php if (mysql_result($rs_query,0,"precio_ticket")==0) { echo "No"; } else { echo "Si"; }?></td>
						</tr>
						<tr>
							<td>Modificar descrip. ticket</td>
							<td colspan="2"><?php if (mysql_result($rs_query,0,"modificar_ticket")==0) { echo "No"; } else { echo "Si"; }?></td>
						</tr>
						<tr>
							<td>Observaciones</td>
							<td colspan="2"><?php echo mysql_result($rs_query,0,"observaciones")?></td>
						</tr>
						<tr>
							<td>Precio de compra</td>
							<td colspan="2"><?php echo mysql_result($rs_query,0,"precio_compra")." ".$simbolomoneda?> </td>
						</tr>
						<tr>
							<td>Precio almac&eacute;n</td>
							<td colspan="2"><?php echo mysql_result($rs_query,0,"precio_almacen")." ".$simbolomoneda?> </td>
						</tr>												
						<tr>
							<td>Precio en tienda</td>
							<td colspan="2"><?php echo mysql_result($rs_query,0,"precio_tienda")." ".$simbolomoneda?> </td>
						</tr>
						<!--<tr>
							<td>Pvp</td>
							<td colspan="2"><?php echo mysql_result($rs_query,0,"precio_pvp")?> &#36;</td>
						</tr>-->
						<tr>
							<td>Precio con iva</td>
							<td colspan="2"><?php echo mysql_result($rs_query,0,"precio_iva")." ".$simbolomoneda?> </td>
						</tr>
                                                
                                                <?php
						$linea=mysql_result($rs_query,0,"Linea_idLinea");
					  	if ($linea<>0) {
							$query_linea="SELECT li.idLinea, CONCAT(ma.marca,'-',li.name_linea)AS nom FROM linea li JOIN marca_vehiculo ma ON li.marca_vehiculo_id_marca=ma.id_marca WHERE idLinea='$linea'";
							$res_linea=mysql_query($query_linea);
							$nombrelinea=mysql_result($res_linea,0,"nom");
						} else {
							$nombrelinea="Sin determinar";
						}
					  ?>
						<tr>
							<td width="22%">Linea</td>
							<td colspan="2"><?php echo $nombrelinea?></td>
					    </tr>
                                                
                                                
                                                
						<tr>
							<td>Codigo de barras</td>
							<td colspan="2"><?php echo $codigobarras?></td></td>
						</tr>
						<tr>
							<td>Codigo de barras</td>
							<td colspan="2"><?php echo "<img src='../barcode/barcode.php?encode=EAN-13&bdata=".$codigobarras."&height=50&scale=2&bgcolor=%23FFFFEC&color=%23333366&type=png'>" ?></td>
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
