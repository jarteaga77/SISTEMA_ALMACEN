<?php
error_reporting(0);
header('Cache-Control: no-cache');
header('Pragma: no-cache'); 
include ("../security.php");

include ("../conectar.php"); 
include ("../funciones/fechas.php"); 
include("../barcode/barcode.php");


date_default_timezone_set('America/Bogota');

$accion=$_POST["accion"];
if (!isset($accion)) { $accion=$_GET["accion"]; }

$referencia=$_POST["Areferencia"];
$codfamilia=$_POST["AcboFamilias"];
$descripcion=$_POST["Adescripcion"];
$codimpuesto=$_POST["AcboImpuestos"];
$codproveedor1=$_POST["acboProveedores1"];
$codproveedor2=$_POST["acboProveedores2"];
$descripcion_corta=$_POST["Adescripcion_corta"];
$codubicacion=$_POST["AcboUbicacion"];
$codubicacion2=$_POST["AcboUbicacion2"];
$stock_minimo=$_POST["nstock_minimo"];
$stock=$_POST["nstock"];
$aviso_minimo=$_POST["aaviso_minimo"];
$datos=$_POST["adatos"];
$fecha=$_POST["fecha"];
$fechaven=$_POST["fechaven"];
$aviso_vencimiento=$_POST["aviso_venc"];
//$fechalis=$fecha;
//if ($fecha<>"") { $fecha=explota($fecha); } else { $fecha="0000-00-00"; }
$codembalaje=$_POST["AcboEmbalaje"];
$unidades_caja=$_POST["nunidades_caja"];
$precio_ticket=$_POST["aprecio_ticket"];
$modif_descrip=$_POST["amodif_descrip"];
$observaciones=$_POST["aobservaciones"];
$precio_compra=$_POST["qprecio_compra"];
$precio_almacen=$_POST["qprecio_almacen"];
$precio_tienda=$_POST["qprecio_tienda"];
//$pvp=$_POST["qpvp"];
$linea=$_POST["AcLinea"];
$precio_iva=$_POST["qprecio_iva"];
$codigobarras=$_POST["barras"];
$foto=$_POST["foto"];

//$idusu = $_SESSION['id_User'];



$fecha1=date("Y-m-d H:i:s");

$idusucrea = $_SESSION['id_User'];
$idusmod = $_SESSION['id_User'];


if ($accion=="alta") {
	$sel_comp="SELECT * FROM articulos WHERE referencia='$referencia' AND borrado=0";
	$rs_comp=mysql_query($sel_comp);
	if (mysql_num_rows($rs_comp) > 0) {
		?><script>
				alert ("No se puede dar de alta a este articulo, ya existe uno con esta referencia.");
				location.href="index.php";
			</script><?
	} else {
	
        $foto_name= "";
		
		$query_operacion="INSERT INTO articulos (codarticulo, codfamilia, referencia, descripcion, impuesto, codproveedor1, codproveedor2, descripcion_corta, codubicacion, stock, stock_minimo, aviso_minimo, datos_producto, fecha_alta, codembalaje, unidades_caja, precio_ticket, modificar_ticket, observaciones, precio_compra, precio_almacen, precio_tienda, precio_iva, codigobarras, imagen, borrado,Linea_idLinea,fecha_venci, aviso_venci,id_usuario_cre,fecha_creacion,codubicacion2) 
						VALUES ('', '$codfamilia', '$referencia', '$descripcion', '$codimpuesto', '$codproveedor1', '$codproveedor2', '$descripcion_corta', '$codubicacion', '0', '$stock_minimo', '$aviso_minimo', '$datos', '$fecha', '$codembalaje', '$unidades_caja', '$precio_ticket', '$modificar_ticket', '$observaciones', '$precio_compra', '$precio_almacen', '$precio_tienda', '$precio_iva','$codigobarras', '$foto_name','0','$linea', '$fechaven', '$aviso_vencimiento', '$idusucrea', '$fecha1','$codubicacion2')";	
									
		$rs_operacion=mysql_query($query_operacion);
		$codarticulo=mysql_insert_id();
		
		
if (isset($_POST['accion'])) {  
		if(is_uploaded_file($_FILES['foto']['tmp_name'])) { // verifica haya sido cargado el archivo 
			if(move_uploaded_file($_FILES['foto']['tmp_name'], "../foto_articulos/fotosubida.jpg")) { // se coloca en su lugar final 
			} 
		} 
		
//		$codarticulo=$_POST['codigo'];
		$foto_name="foto".$codarticulo.".jpg";
		$foto_namea="fotosubida.jpg";
		$query_operacion="UPDATE articulos SET imagen='$foto_name' WHERE codarticulo='$codarticulo'";	
		$rs_operacion=mysql_query($query_operacion);
//		$foto_nameb="no_img.jpg";
		if (file_exists("../fotos_articulos/$foto_namea")) 
		{
			copy ("../fotos_articulos/$foto_namea", "../fotos_articulos/$foto_name");
			unlink("../fotos_articulos/$foto_namea"); 
		} 
	} 
	else  
	{ 
		$codarticulo=$_POST['codigo'];			
	} 

						
//	    $foto_name="foto".$codarticulo.".jpg";
//	    $foto_namea="fotosubida.jpg";

//		$query_operacion="UPDATE articulos SET imagen='$foto_name' WHERE codarticulo='$codarticulo'";				
//		$rs_operacion=mysql_query($query_operacion);
				
//        if (! copy ("../fotos/$foto_namea", "../fotos/$foto_name")) 
//		{
		 // echo "<h2>No se ha podido copiar el archivo  111</h2>\n";
//		};

		$codaux=$codarticulo;
		while (strlen($codaux)<6) {
			$codaux="0".$codaux;
		}
		// el 84 lo he puesto por lo de españa el 0000 representa el código de la empresa
			
		if ($codigobarras=='Automatico'){
		$codigobarras="560000".$codaux;
		$pares=$codigobarras[0] + $codigobarras[2] + $codigobarras[4] + $codigobarras[6] + $codigobarras[8] + $codigobarras[10];
		$impares=$codigobarras[1] + $codigobarras[3] + $codigobarras[5] + $codigobarras[7] + $codigobarras[9] + $codigobarras[11];
		$impares=$impares * 3;
		$total=$impares + $pares;
		$resto = $total % 10;
			if($resto == 0){
				$valor = 0;
			}else{
				$valor = 10 - $resto;
			}
		$codigobarras=$codigobarras."".$valor;
		} 
		
		$sel_actualizar="UPDATE articulos SET codigobarras='$codigobarras' WHERE codarticulo='$codarticulo'";
		$rs_actualizar=mysql_query($sel_actualizar);
		
		if ($rs_operacion) { $mensaje="El articulo ha sido dado de alta correctamente"; }
		$cabecera1="Inicio >> Articulos &gt;&gt; Nuevo Articulo ";
		$cabecera2="INSERTAR ARTICULO ";
		}
}

if ($accion=="modificar") {
	$codarticulo=$_POST["id"];
	$cadena=""; ?>
	
	<?
	if ($foto_name<>"")
	 {   
	   $foto_name="foto".$codarticulo.".jpg"; 
	   unlink("../fotos_articulos/$foto_name");
	   $cadena="imagen=".$foto_name;
	   if (! copy ($foto, "../fotos_articulos/$foto_name")) 
		{
		  echo "<h2>No se ha podido copiar el archivo</h2>\n";
		};
	};
	$query="UPDATE articulos SET codfamilia='$codfamilia', referencia='$referencia', descripcion='$descripcion', impuesto='$codimpuesto', codproveedor1='$codproveedor1', codproveedor2='$codproveedor2', descripcion_corta='$descripcion_corta', codubicacion='$codubicacion', stock_minimo='$stock_minimo', aviso_minimo='$aviso_minimo', datos_producto='$datos', fecha_alta='$fecha', codembalaje='$codembalaje', unidades_caja='$unidades_caja', precio_ticket='$precio_ticket', modificar_ticket='$modif_descrip', observaciones='$observaciones', precio_compra='$precio_compra', precio_almacen='$precio_almacen', precio_tienda='$precio_tienda', precio_iva='$precio_iva', codigobarras='$codigobarras', ".$cadena." borrado=0, Linea_idLinea='$linea', id_usuario_mod='$idusmod', aviso_venci='$aviso_vencimiento',fecha_mod='$fecha1', 	fecha_venci='$fechaven', codubicacion2='$codubicacion2' WHERE codarticulo='$codarticulo'";
	$rs_query=mysql_query($query);
	if ($rs_query) { $mensaje="Los datos del articulo han sido modificados correctamente"; }
	$cabecera1="Inicio >> Articulos &gt;&gt; Modificar Articulo ";
	$cabecera2="MODIFICAR ARTICULO ";
	$sel_img="SELECT imagen,codigobarras FROM articulos WHERE codarticulo='$codarticulo'";
	$rs_img=mysql_query($sel_img);
	$foto_name=mysql_result($rs_img,0,"imagen");
	$codigobarras=mysql_result($rs_img,0,"codigobarras");
}


if($accion=="modificar_cantidad")
{
	$codarticulo=$_POST["id"];
	
	
	$query="UPDATE articulos SET stock='$stock', fecha_mod='$fecha1', id_usuario_mod='$idusmod'  WHERE codarticulo='$codarticulo'";
	$rs_query=mysql_query($query);
	if ($rs_query) { $mensaje="El Stock del articulo han sido modificados correctamente"; }
	$cabecera1="Inicio >> Articulos &gt;&gt; Modificar Articulo ";
	$cabecera2="MODIFICAR ARTICULO ";
	
}



if ($accion=="baja") {
	$codarticulo=$_GET["codarticulo"];
	$query="UPDATE articulos SET borrado=1 WHERE codarticulo='$codarticulo'";
	$rs_query=mysql_query($query);
	if ($rs_query) { $mensaje="El articulo ha sido eliminado correctamente"; }
	$cabecera1="Inicio >> Articulos &gt;&gt; Eliminar Articulo ";
	$cabecera2="ELIMINAR ARTICULO ";
	$query_mostrar="SELECT * FROM articulos WHERE codarticulo='$codarticulo'";
	$rs_mostrar=mysql_query($query_mostrar);
	$codarticulo=mysql_result($rs_mostrar,0,"codarticulo");
	$referencia=mysql_result($rs_mostrar,0,"referencia");
	$codfamilia=mysql_result($rs_mostrar,0,"codfamilia");
	$descripcion=mysql_result($rs_mostrar,0,"descripcion");
	$codimpuesto=mysql_result($rs_mostrar,0,"impuesto");
	$codproveedor1=mysql_result($rs_mostrar,0,"codproveedor1");
	$codproveedor2=mysql_result($rs_mostrar,0,"codproveedor2");
	$descripcion_corta=mysql_result($rs_mostrar,0,"descripcion_corta");
	$codubicacion=mysql_result($rs_mostrar,0,"codubicacion");
	$stock_minimo=mysql_result($rs_mostrar,0,"stock_minimo");
	$stock=mysql_result($rs_mostrar,0,"stock");
	$aviso_minimo=mysql_result($rs_mostrar,0,"aviso_minimo");
	$datos=mysql_result($rs_mostrar,0,"datos_producto");
	$fecha=mysql_result($rs_mostrar,0,"fecha_alta");
	if ($fecha<>"0000-00-00") { $fechalis=implota($fecha); }
	$codembalaje=mysql_result($rs_mostrar,0,"codembalaje");
	$unidades_caja=mysql_result($rs_mostrar,0,"unidades_caja");
	$precio_ticket=mysql_result($rs_mostrar,0,"precio_ticket");
	$modif_descrip=mysql_result($rs_mostrar,0,"modificar_ticket");
	$observaciones=mysql_result($rs_mostrar,0,"observaciones");
	$precio_compra=mysql_result($rs_mostrar,0,"precio_compra");
	$precio_almacen=mysql_result($rs_mostrar,0,"precio_almacen");
	$precio_tienda=mysql_result($rs_mostrar,0,"precio_tienda");
	//$pvp=mysql_result($rs_mostrar,0,"precio_pvp");
	$precio_iva=mysql_result($rs_mostrar,0,"precio_iva");
	$foto_name=mysql_result($rs_mostrar,0,"imagen");
	$codigobarras=mysql_result($rs_mostrar,0,"codigobarras");
        $linea==mysql_result($rs_mostrar,0,"Linea_idLinea");
}

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
							<td colspan="2" class="mensaje"><?php echo $mensaje;?></td>
					    </tr>
						<tr>
							<td width="15%">C&oacute;digo</td>
							<td width="58%"><?php echo $codarticulo?></td>
					        <td width="27%" rowspan="11" align="center" valign="top"><img src="../fotos_articulos/<? echo $foto_name?>" width="160px" height="140px" border="1"></td>
						</tr>
						<tr>
							<td width="15%">Referencia</td>
							<td width="58%"><?php echo $referencia?></td>
				        </tr>
						<?php
					  	$query_familia="SELECT * FROM familias WHERE codfamilia='$codfamilia'";
						$res_familia=mysql_query($query_familia);
						$nombrefamilia=mysql_result($res_familia,0,"nombre");
					  ?>
						<tr>
							<td width="15%">Familia</td>
							<td width="58%"><?php echo $nombrefamilia?></td>
				        </tr>
						<tr>
							<td width="15%">Descripci&oacute;n</td>
						    <td width="58%"><?php echo $descripcion?></td>
				        </tr>
						<tr>
						  <td>Impuesto</td>
						  <td><?php echo $codimpuesto?> %</td>
				      </tr>
					  <?php
					  	if ($codproveedor1<>0) {
							$query_proveedor="SELECT * FROM proveedores WHERE codproveedor='$codproveedor1'";
							$res_proveedor=mysql_query($query_proveedor);
							$nombreproveedor=mysql_result($res_proveedor,0,"nombre");
						} else {
							$nombreproveedor="Sin determinar";
						}
					  ?>
						<tr>
							<td width="15%">Proveedor1</td>
							<td width="58%"><?php echo $nombreproveedor?></td>
				        </tr>
					<?php
					  	if ($codproveedor2<>0) {
							$query_proveedor="SELECT * FROM proveedores WHERE codproveedor='$codproveedor2'";
							$res_proveedor=mysql_query($query_proveedor);
							$nombreproveedor=mysql_result($res_proveedor,0,"nombre");
						} else {
							$nombreproveedor="Sin determinar";
						}
					  ?>
						<tr>
							<td width="15%">Proveedor2</td>
							<td width="58%"><?php echo $nombreproveedor?></td>
				        </tr>
						<tr>
							<td width="15%">Descripci&oacute;n corta</td>
						    <td width="58%"><?php echo $descripcion_corta?></td>
				        </tr>
						<?php
					  	if ($codubicacion<>0) {
							$query_ubicacion="SELECT * FROM ubicaciones WHERE codubicacion='$codubicacion'";
							$res_ubicacion=mysql_query($query_ubicacion);
							$nombreubicacion=mysql_result($res_ubicacion,0,"nombre");
						} else {
							$nombreubicacion="Sin determinar";
						}
					  ?>
						<tr>
							<td width="15%">Ubicaci&oacute;n</td>
							<td width="58%"><?php echo $nombreubicacion?></td>
				        </tr>
                        <?php
					  	if ($codubicacion2<>0) {
							$query_ubicacion="SELECT * FROM ubicaciones WHERE codubicacion='$codubicacion2'";
							$res_ubicacion=mysql_query($query_ubicacion);
							$nombreubicacion2=mysql_result($res_ubicacion,0,"nombre");
						} else {
							$nombreubicacion2="Sin determinar";
						}
					  ?>
                        
                        <tr>
							<td width="15%">2da. Ubicaci&oacute;n</td>
							<td width="58%"><?php echo $nombreubicacion2?></td>
				        </tr>
                        
						<tr>
							<td>Stock</td>
							<td><?php echo $stock?> unidades</td>
					    </tr>
						<tr>
							<td>Stock minimo</td>
							<td><?php echo $stock_minimo?> unidades</td>
					    </tr>
						<tr>
							<td>Aviso M&iacute;nimo</td>
							<td colspan="2"><?php if ($aviso_minimo==0) { echo "No"; } else { echo "Si"; }?></td>
						</tr>
						<tr>
							<td width="15%">Datos del producto</td>
							<td colspan="2"><?php echo $datos?></td>
					    </tr>
						<tr>
							<td width="15%">Fecha de alta</td>
							<td colspan="2"><?php echo $fecha?></td>
					    </tr>
                        
                        <tr>
							<td width="15%">Fecha de vencimiento</td>
							<td colspan="2"><?php echo $fechaven?></td>
					    </tr>
                        
                        
                        <tr>
							<td>Aviso de Vencimiento</td>
							<td colspan="2"><?php if ($aviso_vencimiento==0) { echo "No"; } else { echo "Si"; }?></td>
						</tr>
						
                        
						<?php
					  	if ($codembalaje<>0) {
							$query_embalaje="SELECT * FROM embalajes WHERE codembalaje='$codembalaje'";
							$res_embalaje=mysql_query($query_embalaje);
							$nombreembalaje=mysql_result($res_embalaje,0,"nombre");
						} else {
							$nombreembalaje="Sin determinar";
						}
					  ?>
						<tr>
							<td width="15%">Embalaje</td>
							<td colspan="2"><?php echo $nombreembalaje?></td>
					    </tr>
						<tr>
							<td>Unidades por caja</td>
							<td colspan="2"><?php echo $unidades_caja?> unidades</td>
						</tr>
						<tr>
							<td>Preguntar precio ticket</td>
							<td colspan="2"><?php if ($precio_ticket==0) { echo "No"; } else { echo "Si"; }?></td>
						</tr>
						<tr>
							<td>Modificar descrip. ticket</td>
							<td colspan="2"><?php if ($modif_descrip==0) { echo "No"; } else { echo "Si"; }?></td>
						</tr>
						<tr>
							<td>Observaciones</td>
							<td colspan="2"><?php echo $observaciones?></td>
						</tr>
						<tr>
							<td>Precio de compra</td>
							<td colspan="2"><?php echo $precio_compra?> <?php echo $simbolomoneda ?></td></td>
						</tr>
						<tr>
							<td>Precio almac&eacute;n</td>
							<td colspan="2"><?php echo $precio_almacen?> <?php echo $simbolomoneda ?></td></td>
						</tr>												
						<tr>
							<td>Precio en tienda</td>
							<td colspan="2"><?php echo $precio_tienda?> <?php echo $simbolomoneda ?></td></td>
						</tr>
						<!--<tr>
							<td>Pvp</td>
							<td colspan="2"><?php echo $pvp?> &#36;</td>
						</tr>-->
						<tr>
							<td>Precio con iva</td>
							<td colspan="2"><?php echo $precio_iva?> <?php echo $simbolomoneda ?></td></td>
						</tr>
                                                
                                                <?php
					  	if ($linea<>0) {
					  	$query_linea="SELECT li.idLinea, CONCAT(ma.marca,'-',li.name_linea)AS nom FROM linea li JOIN marca_vehiculo ma ON li.marca_vehiculo_id_marca=ma.id_marca WHERE li.idLinea='$linea'";
							$res_linea=mysql_query($query_linea);
							$nombrelinea=mysql_result($res_linea,0,"nom");
						} else {
							$nombrelinea="Sin determinar";
						}
					  ?>
						<tr>
							<td width="15%">Linea</td>
							<td width="58%"><?php echo $nombrelinea?></td>
				        </tr>
                                                
                                                
						<tr>
							<td>Codigo de barras</td>
							<td colspan="2"><?php echo "<img src='../barcode/barcode.php?encode=EAN-13&bdata=".$codigobarras."&height=50&scale=2&bgcolor=%23FFFFEC&color=%23333366&type=jpg'>"; ?></td>
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
