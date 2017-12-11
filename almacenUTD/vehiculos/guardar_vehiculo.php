<?php
error_reporting(0);
header('Cache-Control: no-cache');
header('Pragma: no-cache'); 

include ("../conectar.php"); 
include ("../funciones/fechas.php"); 
//include("../barcode/barcode.php");
error_reporting(0);

$accion=$_POST["accion"];
if (!isset($accion)) { $accion=$_GET["accion"]; }

$placa=$_POST["areaplaca"];
$modelo=$_POST["areamodelo"];
$cc=$_POST["areacc"];
$chasis=$_POST["areachasis"];
$motor=$_POST["areamotor"];
$licencia=$_POST["arealicencia"];
$tipo_vehi=$_POST["Acbovehi"];
$linea=$_POST["AcboLinea"];
$combustible=$_POST["AcboCombus"];
$ccostos=$_POST["AcboItems"];
$soat=$_POST["areasoat"];
$fechasoat=$_POST["fechasoat"];
//$fechalis=$fechasoat;
//if ($fechasoat<>"") { $fechasoat=explota($fechasoat); } else { $fechasoat="0000-00-00"; }
$tecno=$_POST["areatecno"];
$fechatecno=$_POST["fechatecno"];
//$fechalis2=$fechatecno;
//if ($fechatecno<>"") { $fechatecno=explota($fechatecno); } else { $fechatecno="0000-00-00"; }
$observaciones=$_POST["aobservaciones"];

$foto=$_POST["foto"];



if ($accion=="alta") {
	$sel_comp="SELECT * FROM  vehiculos_equipos WHERE placa_equipo='$placa'";
	$rs_comp=mysql_query($sel_comp);
	if (mysql_num_rows($rs_comp) > 0) {
		?><script>
				alert ("No se puede dar de alta a este vehiculo, ya existe uno con esta placa.");
				location.href="index.php";
			</script><?
	} else {
	
        $foto_name= "";
		
		$query_operacion="INSERT INTO vehiculos_equipos (placa_equipo,modelo_equipo, CC_equipo, num_chasis_equipo,num_motor_equipo, licencia_transito_equipo, Tipo_Combustible_idTipo_Combustible, tipo_vehi_equi_id_tipo_vehi_equi, Linea_idLinea, item_ccostos_id_item_ccostos, soat_equipo, venci_soat_equipo, num_tecno_meca, venci_tecno_meca, novedad_vehi, imagen) 
						VALUES ('$placa', '$modelo', '$cc', '$chasis', '$motor', '$licencia', '$combustible', '$tipo_vehi', '$linea', '$ccostos', '$soat', '$fechasoat', '$tecno', '$fechatecno', '$observaciones', '$foto_name')";	
									
		
		//echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";
//		
//		echo $query_operacion;
		
		$rs_operacion=mysql_query($query_operacion);
		$codvehiculo=mysql_insert_id();
		
		
if (isset($_POST['accion'])) {  
		if(is_uploaded_file($_FILES['foto']['tmp_name'])) { // verifica haya sido cargado el archivo 
			if(move_uploaded_file($_FILES['foto']['tmp_name'], "../fotos_vehi/fotosubida.jpg")) { // se coloca en su lugar final 
			} 
		} 
		
//		$codarticulo=$_POST['codigo'];
		$foto_name="foto".$codvehiculo.".jpg";
		$foto_namea="fotosubida.jpg";
		$query_operacion="UPDATE  vehiculos_equipos SET imagen='$foto_name' WHERE id_vehiculo='$codvehiculo'";	
		$rs_operacion=mysql_query($query_operacion);
//		$foto_nameb="no_img.jpg";
		if (file_exists("../fotos_vehi/$foto_namea")) 
		{
			copy ("../fotos_vehi/$foto_namea", "../fotos_vehi/$foto_name");
			unlink("../fotos_vehi/$foto_namea"); 
		} 
	} 
	else  
	{ 
		$codvehiculo=$_POST['codvehiculo'];			
	} 






						
//	    $foto_name="foto".$codarticulo.".jpg";
//	    $foto_namea="fotosubida.jpg";

//		$query_operacion="UPDATE articulos SET imagen='$foto_name' WHERE codarticulo='$codarticulo'";				
//		$rs_operacion=mysql_query($query_operacion);
				
//        if (! copy ("../fotos/$foto_namea", "../fotos/$foto_name")) 
//		{
		 // echo "<h2>No se ha podido copiar el archivo  111</h2>\n";
//		};

		$codaux=$codvehiculo;
		while (strlen($codaux)<6) {
			$codaux="0".$codaux;
		}
		// el 84 lo he puesto por lo de españa el 0000 representa el código de la empresa
			
//		if ($codigobarras=='Automatico'){
//		$codigobarras="560000".$codaux;
//		$pares=$codigobarras[0] + $codigobarras[2] + $codigobarras[4] + $codigobarras[6] + $codigobarras[8] + $codigobarras[10];
//		$impares=$codigobarras[1] + $codigobarras[3] + $codigobarras[5] + $codigobarras[7] + $codigobarras[9] + $codigobarras[11];
//		$impares=$impares * 3;
//		$total=$impares + $pares;
//		$resto = $total % 10;
//			if($resto == 0){
//				$valor = 0;
//			}else{
//				$valor = 10 - $resto;
//			}
//		$codigobarras=$codigobarras."".$valor;
//		} 
		
//		$sel_actualizar="UPDATE articulos SET codigobarras='$codigobarras' WHERE codarticulo='$codarticulo'";
//		$rs_actualizar=mysql_query($sel_actualizar);
		
		if ($rs_operacion) { $mensaje="El Vehiculo ha sido dado de alta correctamente"; }
		$cabecera1="Inicio >> Vehiculo &gt;&gt; Nuevo Vehiculo ";
		$cabecera2="INSERTAR VEHICULO ";
		}
}

if ($accion=="modificar") {
	$codvehiculo=$_POST["id"];
	$cadena=""; ?>
	
	<?
	if ($foto_name<>"")
	 {   
	   $foto_name="foto".$codvehiculo.".jpg"; 
	   unlink("../fotos_vehi/$foto_name");
	   $cadena="imagen=".$foto_name;
	   if (! copy ($foto, "../fotos_vehi/$foto_name")) 
		{
		  echo "<h2>No se ha podido copiar el archivo</h2>\n";
		};
	};
	$query="UPDATE vehiculos_equipos SET placa_equipo='$placa', modelo_equipo='$modelo', CC_equipo='$cc', num_chasis_equipo='$chasis', num_motor_equipo='$motor', licencia_transito_equipo='$licencia', soat_equipo='$soat', venci_soat_equipo='$fechasoat', num_tecno_meca='$tecno', venci_tecno_meca='$fechatecno', Tipo_Combustible_idTipo_Combustible='$combustible', tipo_vehi_equi_id_tipo_vehi_equi='$tipo_vehi', item_ccostos_id_item_ccostos='$ccostos', Linea_idLinea='$linea', novedad_vehi='$observaciones' WHERE id_vehiculo='$codvehiculo'";
	
		//	echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";
//		
//		echo $query;
	
	
	$rs_query=mysql_query($query);
	if ($rs_query) { $mensaje="Los datos del Vehiculo han sido modificados correctamente"; }
	$cabecera1="Inicio >> Vehiculos - Equipos &gt;&gt; Modificar Vehiculo ";
	$cabecera2="MODIFICAR VEHICULO ";
	$sel_img="SELECT imagen FROM  vehiculos_equipos WHERE id_vehiculo='$codvehiculo'";
	$rs_img=mysql_query($sel_img);
	$foto_name=mysql_result($rs_img,0,"imagen");
	//$codigobarras=mysql_result($rs_img,0,"codigobarras");
}

if ($accion=="baja") {
	$codarticulo=$_GET["codvehiculo"];
	$query="UPDATE vehiculos_equipos SET estado_vehi=0 WHERE id_vehiculo='$codvehiculo'";
	$rs_query=mysql_query($query);
	if ($rs_query) { $mensaje="El Vehiculo ha sido eliminado correctamente"; }
	$cabecera1="Inicio >> Vehiculos - Equipos &gt;&gt; Eliminar Vehiculo ";
	$cabecera2="ELIMINAR VEHICULO ";
	$query_mostrar="SELECT * FROM vehiculos_equipos WHERE id_vehiculo='$codvehiculo'";
	$rs_mostrar=mysql_query($query_mostrar);
        
	$codvehiculo=mysql_result($rs_mostrar,0,"id_vehiculo");
	$placa=mysql_result($rs_mostrar,0,"placa_equipo");
	$modelo=mysql_result($rs_mostrar,0,"modelo_equipo");
	$cc=mysql_result($rs_mostrar,0,"CC_equipo");
	$chasis=mysql_result($rs_mostrar,0,"num_chasis_equipo");
	$motor=mysql_result($rs_mostrar,0,"num_motor_equipo");
	$licencia=mysql_result($rs_mostrar,0,"licencia_transito_equipo");
        $combustible=mysql_result($rs_mostrar,0,"Tipo_Combustible_idTipo_Combustible");
        $tipo_vehi=mysql_result($rs_mostrar,0,"tipo_vehi_equi_id_tipo_vehi_equi");
        $ccostos=mysql_result($rs_mostrar,0,"item_ccostos_id_item_ccostos");
        $linea=mysql_result($rs_mostrar,0,"Linea_idLinea");

	$soat=mysql_result($rs_mostrar,0,"soat_equipo");
	$fechasoat=mysql_result($rs_mostrar,0,"venci_soat_equipo");
        if ($fechasoat<>"0000-00-00") { $fechalis=implota($fechasoat); }
	$tecno=mysql_result($rs_mostrar,0,"num_tecno_meca");
	$fechatecno=mysql_result($rs_mostrar,0,"venci_tecno_meca");
	if ($fechatecno<>"0000-00-00") { $fechalis2=implota($fechatecno); }
        $observaciones=mysql_result($rs_mostrar,0,"novedad_vehi");
	//$datos=mysql_result($rs_mostrar,0,"datos_producto");
	
	$foto_name=mysql_result($rs_mostrar,0,"imagen");
	
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
							<td width="15%">C&oacute;digo Vehiculo</td>
							<td width="58%"><?php echo $codvehiculo?></td>
					        <td width="27%" rowspan="11" align="center" valign="top"><img src="../fotos_vehi/<? echo $foto_name?>" width="160px" height="140px" border="1"></td>
						</tr>
						<tr>
							<td width="15%">Placa</td>
							<td width="58%"><?php echo $placa?></td>
				        </tr>
						
						<tr>
							<td width="15%">Modelo</td>
							<td width="58%"><?php echo $modelo?></td>
				        </tr>
						<tr>
							<td width="15%">C.C</td>
						    <td width="58%"><?php echo $cc?></td>
				        </tr>
						<tr>
						  <td>N&uacute;mero de Chasis</td>
						  <td><?php echo $chasis?></td>
				      </tr>
					 
                                      
						<tr>
							<td width="15%">N&uacute;mero de Motor</td>
						    <td width="58%"><?php echo $motor?></td>
				        </tr>
                                        
                                        	<?php
					  	if ($combustible<>0) {
							$query_combustible="SELECT * FROM tipo_combustible WHERE idTipo_Combustible='$combustible'";
							$res_combustible=mysql_query($query_combustible);
							$nombrecombustible=mysql_result($res_combustible,0,"name_combustible");
						} else {
							$nombrecombustible="Sin determinar";
						}
					  ?>
                                        
                                        
                                        	<tr>
							<td width="15%">Tipo de Combustible</td>
						    <td width="58%"><?php echo $nombrecombustible?></td>
				        </tr>
                                        
                                        
                                             	<?php
					  	if ($tipo_vehi<>0) {
							$query_tipo="SELECT * FROM tipo_vehi_equi WHERE id_tipo_vehi_equi='$tipo_vehi'";
							$res_tipo=mysql_query($query_tipo);
							$nombretipo=mysql_result($res_tipo,0,"nom_tipo");
						} else {
							$nombretipo="Sin determinar";
						}
					  ?>
                                        
                                        
                                        	<tr>
							<td width="15%">Tipo de Vehiculo</td>
						    <td width="58%"><?php echo $nombretipo?></td>
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
							<td width="15%">Licencia de Transito</td>
							<td colspan="2"><?php echo $licencia?></td>
					    </tr>
						<tr>
							<td width="15%">SOAT</td>
							<td colspan="2"><?php echo $soat?></td>
					    </tr>
						
						<tr>
							<td>Vencimiento del Soat</td>
							<td colspan="2"><?php echo $fechasoat?></td>
						</tr>
						<tr>
							<td>N&uacute;mero de la Tecnomecanica</td>
							<td colspan="2"><?php echo $tecno?></td>
						</tr>
						<tr>
							<td>Vencimiento de la Tecnomecanica</td>
							<td colspan="2"><?php echo $fechatecno?></td>
						</tr>
						<tr>
							<td>Observaciones</td>
							<td colspan="2"><?php echo $observaciones?></td>
						</tr>
                                                
                                                        	<?php
					  	if ($ccostos<>0) {
							$query_item="SELECT * FROM item_ccostos WHERE id_item_ccostos='$ccostos'";
							$res_item=mysql_query($query_item);
							$nombreitem=mysql_result($res_item,0,"nombre_item_ccostos");
						} else {
							$nombreitem="Sin determinar";
						}
					  ?>
                                        
                                        
                                        	<tr>
							<td width="15%">Dependencia a donde Pertenece</td>
						    <td width="58%"><?php echo $nombreitem?></td>
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
