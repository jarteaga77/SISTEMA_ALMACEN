<?
include ("../conectar.php"); 
include ("../funciones/fechas.php"); 
include ("../security.php"); 
error_reporting(0);

date_default_timezone_set('America/Bogota');

$accion=$_POST["accion"];
if (!isset($accion)) { $accion=$_GET["accion"]; }

$codalbarantmp=$_POST["codalbarantmp"];
$fecha=$_POST["fecha"];
$entrada=$_POST["entrada"];
$proximo=$_POST["proximo"];
$obse=$_POST["obse"];
$mantenimiento=$_POST["cbomant"];
$vehiculo=$_POST["cbovehi"];
$mecanico=$_POST["cbomeca"];
$rutina=$_POST["cborut"];
$iva=$_POST["iva"];
$solicita=$_POST["solicita"];
$cerrar=$_POST["cbocerrar"];
$activo="1";
$fecha1=date("Y-m-d H:i:s");
$horas=$_POST["horas"];
//$fechamod=explota($fecha1);

if ($cerrar=="1")
{
	$activo=0;
}
else if($cerrar=="2")
	{
	$activo=1;
	}




$minimo=0;


//$user=$_SESSION['MM_Username'];
//$Login_query="SELECT id FROM authuser WHERE uname='$user'"; 	//Seleccionar Usuario de BD
//$LoginRS = mysql_query($Login_query, $conectar) or die(mysql_error());
//$loginFoundUser = mysql_fetch_row($LoginRS);
//$idusu =  intval($loginFoundUser[0])

$idusu = $_SESSION['id_User'];

if($accion == "alta") {
	$query_operacion="INSERT INTO hoja_mantenimiento (fecha_mto, km_en_momento, km_prox_mant, observacion, 	tipo_mantenimiento_id_mto, vehiculos_equipos_id_vehiculo, mecanico_responsable_id_mecanico,id_usuario, 	id_rutina,solicita,iva,activo, horas_uso) VALUES ('$fecha', '$entrada', '$proximo', '$obse', '$mantenimiento', $vehiculo, '$mecanico', '$idusu','$rutina','$solicita','$iva','$activo', '$horas')";					
	$rs_operacion=mysql_query($query_operacion);
	$codalbaran=mysql_insert_id();
	if ($rs_operacion) { 
	$mensaje="La Hoja de Mantenimiento ha sido dado de alta correctamente"; 
		$sel_fecha="SELECT venci_soat_equipo,venci_tecno_meca,soat_equipo,num_tecno_meca FROM vehiculos_equipos WHERE id_vehiculo='$vehiculo'";
			$re_fechaven=mysql_result($sel_fecha);
			$fechaactual=date("Y-m-d");
			$fechavensoat=mysql_result($re_fechaven,0,"soat_equipo");
			$fechaventecno=mysql_result($re_fechaven,0,"num_tecno_meca");
			
			if($fechaactual >= $fechavensoat)
			{
				$mensaje_soat="Tiene Vencido el SOAT N° "  . mysql_result($re_fechaven,0,"soat_equipo")."<br>";
				$vencidosoat=1;
			}
			
			if($fechaactual > $fechaventecno)
			{
				$mensaje_tecno="Tiene vencido la Tecnomecanica N° ". mysql_result($re_fechaven,0,"num_tecno_meca")."<br>";
				$vencidotecno=1;
			}
	
	}
	$query_tmp="SELECT * FROM linea_hoja_tmp_mec WHERE codalbaran='$codalbarantmp' ORDER BY id_linea_hoja_mto ASC";
	$rs_tmp=mysql_query($query_tmp);
	$contador=0;
	$baseimponible=0;
	while ($contador < mysql_num_rows($rs_tmp)) {
		$codfamilia=mysql_result($rs_tmp,$contador,"codfamilia");
		//$numlinea=mysql_result($rs_tmp,$contador,"id_linea_hoja_mto");
		$codigo=mysql_result($rs_tmp,$contador,"codigo");
		$cantidad=mysql_result($rs_tmp,$contador,"cantidad");
		$precio=mysql_result($rs_tmp,$contador,"precio");
		$importe=mysql_result($rs_tmp,$contador,"importe");
		$baseimponible=$baseimponible+$importe;
		
		$sel_stock_antiguo="SELECT stock  FROM articulos where codarticulo='$codigo'";
		
		$rs_stock=mysql_query($sel_stock_antiguo);
		
		$stock_antiguo=mysql_result($rs_stock,0,"stock");
		
		
		$sel_insertar="INSERT INTO linea_hoja_mto (hoja_mantenimiento_id_hoja_mto,codfamilia,codigo,cantidad,precio,importe) VALUES 
		('$codalbaran','$codfamilia','$codigo','$cantidad','$precio','$importe')";
		$rs_insertar=mysql_query($sel_insertar);		
		$sel_articulos="UPDATE articulos SET stock=(stock-'$cantidad'),fecha_mod='$fecha1',id_usuario_mod='$idusu' WHERE codarticulo='$codigo' AND codfamilia='$codfamilia'";
		$rs_articulos=mysql_query($sel_articulos);
		
		$sel_minimos = "SELECT stock,stock_minimo,descripcion FROM articulos where codarticulo='$codigo' AND codfamilia='$codfamilia'";
		$rs_minimos= mysql_query($sel_minimos);
		$stock_nuevo=mysql_result($rs_minimos,0,"stock");
		if ((mysql_result($rs_minimos,0,"stock") < mysql_result($rs_minimos,0,"stock_minimo")) or (mysql_result($rs_minimos,0,"stock") <= 0))
	   		{ 
		  		$mensaje_minimo=$mensaje_minimo . " " . mysql_result($rs_minimos,0,"descripcion")."<br>";
				$minimo=1;
   			};
			
			$sel_control_articulos="INSERT INTO control_articulos (fecha,codarticulo,stock_antiguo,cantidad_retirada,stock_nuevo,modulo_mod,idusuario)VALUES('$fecha1','$codigo','$stock_antiguo','$cantidad','$stock_nuevo','HMTO','$idusu')";
			$rs_control=mysql_query($sel_control_articulos);
				
			
		$contador++;
	}
	$baseimpuestos=$baseimponible*($iva/100);
	$preciototal=$baseimponible+$baseimpuestos;
	//$preciototal=number_format($preciototal,2);	
	$sel_act="UPDATE hoja_mantenimiento SET total_mto='$preciototal' WHERE id_hoja_mto='$codalbaran'";
	$rs_act=mysql_query($sel_act);
	$baseimponible=0;
	$preciototal=0;
	$baseimpuestos=0;
	$cabecera1="Inicio >> Nueva Hoja de Mantenimiento";
	$cabecera2="INSERTAR HOJA DE MANTENIMIENTO ";
}




if ($accion=="modificar") {
	$codalbaran=$_POST["codalbaran"];
	
	//echo ($codalbaran);
	$act_albaran="UPDATE hoja_mantenimiento SET km_en_momento='$entrada', km_prox_mant='$proximo', observacion='$obse',tipo_mantenimiento_id_mto='$mantenimiento',vehiculos_equipos_id_vehiculo='$vehiculo', mecanico_responsable_id_mecanico='$mecanico',id_rutina='$rutina',solicita='$solicita',iva='$iva', fecha_modificacion='$fecha1',activo='$activo', id_usuario_mod='$idusu', horas_uso='$horas' WHERE id_hoja_mto='$codalbaran'";
	
	//echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";
//	echo $act_albaran;
//	echo $cerrar;
	$rs_albaran=mysql_query($act_albaran);
	
	if($rs_albaran)
	{
		
		$sel_fecha="SELECT venci_soat_equipo,venci_tecno_meca,soat_equipo,num_tecno_meca FROM vehiculos_equipos WHERE id_vehiculo='$vehiculo'";
			$re_fechaven=mysql_result($sel_fecha);
			$fechaactual=date("Y-m-d");
			$fechavensoat=mysql_result($re_fechaven,0,"soat_equipo");
			$fechaventecno=mysql_result($re_fechaven,0,"num_tecno_meca");
			
			if($fechaactual >= $fechavensoat)
			{
				$mensaje_soat="Tiene Vencido el SOAT N° "  . mysql_result($re_fechaven,0,"soat_equipo")."<br>";
				$vencidosoat=1;
			}
			
			if($fechaactual > $fechaventecno)
			{
				$mensaje_tecno="Tiene vencido la Tecnomecanica N° ". mysql_result($re_fechaven,0,"num_tecno_meca")."<br>";
				$vencidotecno=1;
			}
	}
	
	
		
	
	
	$sel_lineas = "SELECT codigo,codfamilia,cantidad FROM linea_hoja_mto WHERE hoja_mantenimiento_id_hoja_mto='$codalbaran' order by id_linea_hoja_mto";
	$rs_lineas = mysql_query($sel_lineas);
	$contador=0;
	while ($contador < mysql_num_rows($rs_lineas)) {
		$codigo=mysql_result($rs_lineas,$contador,"codigo");
		$codfamilia=mysql_result($rs_lineas,$contador,"codfamilia");
		$cantidad=mysql_result($rs_lineas,$contador,"cantidad");
		
		$sel_stock_antiguo="SELECT stock  FROM articulos where codarticulo='$codigo'";
		
		$rs_stock=mysql_query($sel_stock_antiguo);
		
		$stock_antiguo=mysql_result($rs_stock,0,"stock");
	
		
		
		$sel_actualizar="UPDATE `articulos` SET stock=(stock+'$cantidad'),id_usuario_mod='$idusu',fecha_mod='$fecha1' WHERE codarticulo='$codigo' AND codfamilia='$codfamilia'";
		$rs_actualizar = mysql_query($sel_actualizar);
		
		
		$sel_stock_nuevo="SELECT stock FROM articulos WHERE codarticulo='$codigo'";
	
		$rs_stock_nuevo=mysql_query($sel_stock_nuevo);
		$stock_nuevo=mysql_result($rs_stock_nuevo,0,"stock");
		
		  $sel_control_articulos="INSERT INTO control_articulos (fecha,codarticulo,stock_antiguo,cantidad_retirada,stock_nuevo,modulo_mod,idusuario)VALUES('$fecha1','$codigo','$stock_antiguo','$cantidad','$stock_nuevo','HMTO','$idusu')";
			$rs_control=mysql_query($sel_control_articulos);
		
		
		$contador++;
		
	}
	$sel_borrar = "DELETE FROM  linea_hoja_mto WHERE hoja_mantenimiento_id_hoja_mto='$codalbaran'";
	$rs_borrar = mysql_query($sel_borrar);
	$sel_lineastmp = "SELECT * FROM linea_hoja_tmp_mec WHERE codalbaran='$codalbarantmp' ORDER BY id_linea_hoja_mto";
	$rs_lineastmp = mysql_query($sel_lineastmp);
	$contador=0;
	$baseimponible=0;
	while ($contador < mysql_num_rows($rs_lineastmp)) {
		$numlinea=mysql_result($rs_lineastmp,$contador,"id_linea_hoja_mto");
		$codigo=mysql_result($rs_lineastmp,$contador,"codigo");
		$codfamilia=mysql_result($rs_lineastmp,$contador,"codfamilia");
		$cantidad=mysql_result($rs_lineastmp,$contador,"cantidad");
		$precio=mysql_result($rs_lineastmp,$contador,"precio");
		$importe=mysql_result($rs_lineastmp,$contador,"importe");
		$baseimponible=$baseimponible+$importe;

	
		$sel_stock_antiguo="SELECT stock  FROM articulos where codarticulo='$codigo'";
		
		$rs_stock=mysql_query($sel_stock_antiguo);
		
		$stock_antiguo=mysql_result($rs_stock,0,"stock");
	
	
		$sel_insert = "INSERT INTO linea_hoja_mto (hoja_mantenimiento_id_hoja_mto,codigo,codfamilia,cantidad,precio,importe) 
		VALUES ('$codalbaran','$codigo','$codfamilia','$cantidad','$precio','$importe')";
		$rs_insert = mysql_query($sel_insert);
		
		$sel_actualiza="UPDATE articulos SET stock=(stock-'$cantidad'),id_usuario_mod='$idusu',fecha_mod='$fecha1' WHERE codarticulo='$codigo' AND codfamilia='$codfamilia'";
		$rs_actualiza = mysql_query($sel_actualiza);
		
		$sel_stock_nuevo="SELECT stock FROM articulos WHERE codarticulo='$codigo'";
	
		$rs_stock_nuevo=mysql_query($sel_stock_nuevo);
		$stock_nuevo=mysql_result($rs_stock_nuevo,0,"stock");
		
		  $sel_control_articulos="INSERT INTO control_articulos (fecha,codarticulo,stock_antiguo,cantidad_retirada,stock_nuevo,modulo_mod,idusuario)VALUES('$fecha1','$codigo','$stock_antiguo','$cantidad','$stock_nuevo','HMTO','$idusu')";
			$rs_control=mysql_query($sel_control_articulos);
		
		
		$sel_bajominimo ="SELECT stock,stock_minimo,descripcion FROM articulos WHERE codarticulo='$codigo' AND codfamilia='$codfamilia'";
		$rs_bajominimo= mysql_query($sel_bajominimo);
		$stock=mysql_result($rs_bajominimo,0,"stock");
		$stock_minimo=mysql_result($rs_bajominimo,0,"stock_minimo");
		$descripcion=mysql_result($rs_bajominimo,0,"descripcion");
		
		if (($stock < $stock_minimo) or ($stock <= 0))
		   { 
			  $mensaje_minimo=$mensaje_minimo . " " . $descripcion."<br>";
			  $minimo=1;
		   };
		
		$contador++;
	}
	$baseimpuestos=$baseimponible*($iva/100);
	$preciototal=$baseimponible+$baseimpuestos;
	//$preciototal=number_format($preciototal,2);	
	$sel_act="UPDATE hoja_mantenimiento SET total_mto='$preciototal' WHERE id_hoja_mto='$codalbaran'";
	$rs_act=mysql_query($sel_act);
	$baseimponible=0;
	$preciototal=0;
	$baseimpuestos=0;
	if ($rs_act) { $mensaje="Los datos de Hoja de Mantenimiento se han modificados correctamente"; }
	$cabecera1="Inicio >>  Modificar Hoja de Mantenimiento ";
	$cabecera2="MODIFICAR Hoja de Mantenimiento ";
}

if ($accion=="baja") {
	$codalbaran=$_GET["codalbaran"];
	$query="UPDATE albaranes SET borrado=1 WHERE codalbaran='$codalbaran'";
	$rs_query=mysql_query($query);
	$query="SELECT * FROM albalinea WHERE codalbaran='$codalbaran' ORDER BY numlinea ASC";
	$rs_tmp=mysql_query($query);
	$contador=0;
	$baseimponible=0;
	while ($contador < mysql_num_rows($rs_tmp)) {
		$codfamilia=mysql_result($rs_tmp,$contador,"codfamilia");
		$codigo=mysql_result($rs_tmp,$contador,"codigo");
		$cantidad=mysql_result($rs_tmp,$contador,"cantidad");
		$sel_articulos="UPDATE articulos SET stock=(stock+'$cantidad') WHERE codarticulo='$codigo' AND codfamilia='$codfamilia'";
		$rs_articulos=mysql_query($sel_articulos);
		$contador++;
	}
	if ($rs_query) { $mensaje="El albar&aacute;n ha sido eliminado correctamente"; }
	$cabecera1="Inicio >> Ventas &gt;&gt; Eliminar Albar&aacute;n";
	$cabecera2="ELIMINAR SALIDA ALMACEN";
	$query_mostrar="SELECT * FROM albaranes WHERE codalbaran='$codalbaran'";
	$rs_mostrar=mysql_query($query_mostrar);
	$codcliente=mysql_result($rs_mostrar,0,"id_ccostos");
	$fecha=mysql_result($rs_mostrar,0,"fecha");
	$iva=mysql_result($rs_mostrar,0,"iva");
}

if ($accion=="convertir") {
	$codalbaran=$_POST["codalbaran"];
	$fecha=$_POST["fecha"];
	$fecha=explota($fecha);
	$sel_albaran="SELECT * FROM albaranes WHERE codalbaran='$codalbaran'";
	$rs_albaran=mysql_query($sel_albaran);
	$iva=mysql_result($rs_albaran,0,"iva");
	$codcliente=mysql_result($rs_albaran,0,"id_ccostos");
	$totalfactura=mysql_result($rs_albaran,0,"totalalbaran");
	$sel_factura="INSERT INTO facturas (codfactura,fecha,iva,id_ccostos,estado,totalfactura,borrado) VALUES 
		('','$fecha','$iva','$codcliente','1','$totalfactura','0')";
	$rs_factura=mysql_query($sel_factura);
	$codfactura=mysql_insert_id();
	$act_albaran="UPDATE albaranes SET codfactura='$codfactura',estado='2' WHERE codalbaran='$codalbaran'";
	$rs_act=mysql_query($act_albaran);
	$sel_lineas="SELECT * FROM albalinea WHERE codalbaran='$codalbaran' ORDER BY numlinea ASC";
	$rs_lineas=mysql_query($sel_lineas);
	$contador=0;
	while ($contador < mysql_num_rows($rs_lineas)) {
		$codfamilia=mysql_result($rs_lineas,$contador,"codfamilia");
		$codigo=mysql_result($rs_lineas,$contador,"codigo");
		$cantidad=mysql_result($rs_lineas,$contador,"cantidad");
		$precio=mysql_result($rs_lineas,$contador,"precio");
		$importe=mysql_result($rs_lineas,$contador,"importe");
		$dcto=mysql_result($rs_lineas,$contador,"dcto");
		$sel_insert="INSERT INTO factulinea (codfactura,numlinea,codfamilia,codigo,cantidad,precio,importe,dcto) VALUES 
			('$codfactura','','$codfamilia','$codigo','$cantidad','$precio','$importe','$dcto')";
		$rs_insert=mysql_query($sel_insert);
		$contador++;
	}
	$mensaje="El albar&aacute;n ha sido convertido correctamente";
	$cabecera1="Inicio >> Ventas &gt;&gt; Convertir Albar&aacute;n";
	$cabecera2="CONVERTIR ALBAR&Aacute;N";
}

?>

<html>
	<head>
		<title>Principal</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
		<link href="../SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css">
		<script src="../SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
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
		
		function imprimir(codalbaran) {
			window.open("../fpdf/imprimir_albaranMeca.php?codalbaran="+codalbaran);
		}
		
		function imprimirf(codfactura) {
			window.open("../fpdf/imprimir_factura.php?codfactura="+codfactura);
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
							<td width="85%" colspan="2" class="mensaje"><?php echo $mensaje;?></td>
					    </tr>
						<? if ($minimo==1) { ?>
						
						
						
						<tr>
							<td width="15%"></td>
							<td width="85%" colspan="2" class="mensajeminimo">Los siguientes art&iacute;culos est&aacute;n bajo m&iacute;nimo:<br><?php echo $mensaje_minimo;?></td>
					    </tr>
                    <?  }?>  
                    
                 <?   if($vencidosoat==1){ ?>
                      
                        <tr>
							<td width="15%"></td>
							<td width="85%" colspan="2" class="mensajeminimo">Alerta<br><?php echo $mensaje_soat;?></td>
                            
                 </tr>           
             <? } ?>   
             
              <?   if($vencidotecno==1){ ?>
                      
                        <tr>
							<td width="15%"></td>
							<td width="85%" colspan="2" class="mensajeminimo">Alerta<br><?php echo $mensaje_tecno;?></td>
            </tr>                
                            
             <? } ?>       
                     
                          <tr>
						  <td>Fecha</td>
						  <td colspan="2"><?php echo implota($fecha)?></td>
					  </tr>
                      
                       	<tr>
						  <td>C&oacute;digo Hoja de Mantenimiento</td>
						  <td colspan="2"><?php echo $codalbaran?></td>
					  </tr>
                        
                        
                        
						<? 
						 $sel_vehiculo="SELECT ve.id_vehiculo, CONCAT(ma.marca,'-',li.name_linea)AS nom FROM linea li JOIN marca_vehiculo ma ON li.marca_vehiculo_id_marca=ma.id_marca JOIN vehiculos_equipos ve ON ve.Linea_idLinea=li.idLinea WHERE ve.id_vehiculo='$vehiculo'"; 
						  $rs_vehiculo=mysql_query($sel_vehiculo); ?>
						<tr>
							<td width="15%">Vehiculo</td>
							<td width="85%" colspan="2"><?php echo mysql_result($rs_vehiculo,0,"nom");?></td>
					    </tr>
				
					  <tr>
						  <td></td>
						  <td colspan="2"></td>
					  </tr>
				  </table>
					 <table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0 ID="Table1">
						<tr class="cabeceraTabla">
							<td width="5%">ITEM</td>
							<td width="25%">REFERENCIA</td>
							<td width="30%">DESCRIPCION</td>
							<td width="10%">CANTIDAD</td>
							<td width="10%">PRECIO</td>
							<td width="10%">IMPORTE</td>
						</tr>
					</table>
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0 ID="Table1">
					  <? $sel_lineas="SELECT linea_hoja_mto.*,articulos.*,familias.nombre as nombrefamilia FROM linea_hoja_mto,articulos,familias WHERE linea_hoja_mto.hoja_mantenimiento_id_hoja_mto='$codalbaran' AND linea_hoja_mto.codigo=articulos.codarticulo AND linea_hoja_mto.codfamilia=articulos.codfamilia AND articulos.codfamilia=familias.codfamilia ORDER BY linea_hoja_mto.id_linea_hoja_mto ASC";
$rs_lineas=mysql_query($sel_lineas);
						for ($i = 0; $i < mysql_num_rows($rs_lineas); $i++) {
							$numlinea=mysql_result($rs_lineas,$i,"id_linea_hoja_mto");
							$codfamilia=mysql_result($rs_lineas,$i,"codfamilia");
							$nombrefamilia=mysql_result($rs_lineas,$i,"nombrefamilia");
							$codarticulo=mysql_result($rs_lineas,$i,"codarticulo");
							$referencia=mysql_result($rs_lineas,$i,"referencia");
							$descripcion=mysql_result($rs_lineas,$i,"descripcion");
							$cantidad=mysql_result($rs_lineas,$i,"cantidad");
							$precio=mysql_result($rs_lineas,$i,"precio");
							$importe=mysql_result($rs_lineas,$i,"importe");
							$baseimponible=$baseimponible+$importe;
							//$descuento=mysql_result($rs_lineas,$i,"dcto");
							if ($i % 2) { $fondolinea="itemParTabla"; } else { $fondolinea="itemImparTabla"; } ?>
									<tr class="<? echo $fondolinea?>">
										<td width="5%" class="aCentro"><? echo $i+1?></td>
										<td width="20%"><? echo $referencia?></td>
										<td width="30%"><? echo $descripcion?></td>
										<td width="10%" class="aCentro"><? echo $cantidad?></td>
										<td width="10%" class="aCentro"><? echo $precio?></td>
										
										<td width="10%" class="aCentro"><? echo $importe?></td>
									</tr>
					<? } ?>
					</table>
			  </div>
				  <?
				  $baseimpuestos=$baseimponible*($iva/100);
			      $preciototal=$baseimponible+$baseimpuestos;
			      $preciototal=number_format($preciototal,2);
			  	  ?>
					<div id="frmBusqueda">
					<table width="25%" border=0 align="right" cellpadding=3 cellspacing=0 class="fuente8">
						<tr>
							<td width="15%">Base imponible</td>
							<td width="15%" align="right"><? echo $simbolomoneda ?><?php echo number_format($baseimponible,2);?></td>
						</tr>
						<tr>
							<td width="15%">IVA</td>
							<td width="15%" align="right"><? echo $simbolomoneda ?><?php echo number_format($baseimpuestos,2);?></td>
						</tr>
						<tr>
							<td width="15%">Total</td>
							<td width="15%" align="right"><? echo $simbolomoneda ?><?php echo $preciototal?></td>
						</tr>
					</table>
			  </div>
				<div id="botonBusqueda">
					<div align="center">
					 <img src="../img/botonaceptar.jpg" width="85" height="22" onClick="aceptar()" border="1" onMouseOver="style.cursor=cursor">
					 
					   <img src="../img/botonimprimir.jpg" width="79" height="22" border="1" onClick="imprimir(<? echo $codalbaran?>)" onMouseOver="style.cursor=cursor">
					 
				        </div>
					</div>
			  </div>
		  </div>
		</div>

	</body>
</html>
