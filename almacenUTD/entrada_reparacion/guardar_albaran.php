<?
include ("../conectar.php"); 
include ("../funciones/fechas.php"); 
include ("../security.php"); 
error_reporting(0);

date_default_timezone_set('America/Bogota');

//$codcliente_tmp=$_POST['select2'];

$accion=$_POST["accion"];
if (!isset($accion)) { $accion=$_GET["accion"]; }

$codalbarantmp=$_POST["codalbarantmp"];
//$codcliente=$codcliente_tmp;
$fecha=$_POST["fecha"];
//$iva=$_POST["iva"];
$remision=$_POST["rem"];
$recibe=$_POST["recibe"];
$tecnico=$_POST["tec"];
$obse=$_POST["obse"];
//$req=$_POST["req"];
$fecha1=date("Y-m-d H:i:s");
$cerrar=$_POST["cbocerrar"];
$item_tramos=$_POST['select2'];
$minimo=0;

if ($cerrar=="1")
{
	$activo=0;
}
else if($cerrar=="2")
	{
	$activo=1;
	}



//$user=$_SESSION['MM_Username'];
//$Login_query="SELECT id FROM authuser WHERE uname='$user'"; 	//Seleccionar Usuario de BD
//$LoginRS = mysql_query($Login_query, $conectar) or die(mysql_error());
//$loginFoundUser = mysql_fetch_row($LoginRS);
//$idusu =  intval($loginFoundUser[0])

$idusu = $_SESSION['id_User'];

if($accion == "alta") {
	$query_operacion="INSERT INTO entrada_reparacion(fecha_entrada,fecha_registro,id_usuario,remision,tec_hardware,observacion,activo,id_item_tramos)VALUES('$fecha','$fecha1', '$idusu', '$remision','$tecnico','$obse','$activo', '$item_tramos')";					
	$rs_operacion=mysql_query($query_operacion);
	$codalbaran=mysql_insert_id();
	if ($rs_operacion) { $mensaje="La entrada por reparación ha sido dado de alta correctamente"; }
	$query_tmp="SELECT * FROM  linea_ent_repa_tmp WHERE codalbaran='$codalbarantmp' ORDER BY numlinea ASC";
	$rs_tmp=mysql_query($query_tmp);
	$contador=0;
	//$baseimponible=0;
	while ($contador < mysql_num_rows($rs_tmp)) {
		$codfamilia=mysql_result($rs_tmp,$contador,"codfamilia");
		$numlinea=mysql_result($rs_tmp,$contador,"numlinea");
		$codigo=mysql_result($rs_tmp,$contador,"codigo");
		$cantidad=mysql_result($rs_tmp,$contador,"cantidad");
		//$precio=mysql_result($rs_tmp,$contador,"precio");
		//$importe=mysql_result($rs_tmp,$contador,"importe");
		$observacion=mysql_result($rs_tmp,$contador,"observacion");
		//$baseimponible=$baseimponible+$importe;
		
		$sel_stock_antiguo="SELECT stock  FROM articulos where codarticulo='$codigo'";
		
		$rs_stock=mysql_query($sel_stock_antiguo);
		
		$stock_antiguo=mysql_result($rs_stock,0,"stock");
		
		
		
		//$dcto=mysql_result($rs_tmp,$contador,"dcto");
		$sel_insertar="INSERT INTO linea_ent_repa (codalbaran,numlinea,codfamilia,codigo,cantidad,observacion) VALUES 
		('$codalbaran','$numlinea','$codfamilia','$codigo','$cantidad','$observacion')";
		$rs_insertar=mysql_query($sel_insertar);		
		$sel_articulos="UPDATE articulos SET stock=(stock+'$cantidad'),id_usuario_mod='$idusu',fecha_mod='$fecha1' WHERE codarticulo='$codigo' AND codfamilia='$codfamilia'";
		$rs_articulos=mysql_query($sel_articulos);
		$sel_minimos = "SELECT stock,stock_minimo,descripcion FROM articulos where codarticulo='$codigo' AND codfamilia='$codfamilia'";
		$rs_minimos= mysql_query($sel_minimos);
		$stock_nuevo=mysql_result($rs_minimos,0,"stock");
		if ((mysql_result($rs_minimos,0,"stock") < mysql_result($rs_minimos,0,"stock_minimo")) or (mysql_result($rs_minimos,0,"stock") <= 0))
	   		{ 
		  		$mensaje_minimo=$mensaje_minimo . " " . mysql_result($rs_minimos,0,"descripcion")."<br>";
				$minimo=1;
   			};
			
			$sel_control_articulos="INSERT INTO control_articulos (fecha,codarticulo,stock_antiguo,cantidad_retirada,stock_nuevo,modulo_mod,idusuario)VALUES('$fecha1','$codigo','$stock_antiguo','$cantidad','$stock_nuevo','EREP','$idusu')";
			$rs_control=mysql_query($sel_control_articulos);
			
			
		$contador++;
	}
/*	$baseimpuestos=$baseimponible*($iva/100);
	$preciototal=$baseimponible+$baseimpuestos;
	//$preciototal=number_format($preciototal,2);	
	$sel_act="UPDATE albaranes_sys SET totalalbaran='$preciototal' WHERE codalbaran='$codalbaran'";
	$rs_act=mysql_query($sel_act);
	$baseimponi	ble=0;
	$preciototal=0;
	$baseimpuestos=0;*/
	$cabecera1="Inicio >> Nueva Entrada ";
	$cabecera2="INSERTAR Entradar por reparación ";
}

if ($accion=="modificar") {
	$codalbaran=$_POST["codalbaran"];
	$act_albaran="UPDATE entrada_reparacion SET fecha_mod='$fecha1',id_usuario_mod='$idusu',remision='$remision', activo='$activo',observacion='$obse' WHERE id='$codalbaran'";
	$rs_albaran=mysql_query($act_albaran);
	$sel_lineas = "SELECT codigo,codfamilia,cantidad FROM linea_ent_repa WHERE codalbaran='$codalbaran' order by numlinea";
	$rs_lineas = mysql_query($sel_lineas);
	$contador=0;
	while ($contador < mysql_num_rows($rs_lineas)) {
		$codigo=mysql_result($rs_lineas,$contador,"codigo");
		$codfamilia=mysql_result($rs_lineas,$contador,"codfamilia");
		$cantidad=mysql_result($rs_lineas,$contador,"cantidad");
		
		$sel_stock_antiguo="SELECT stock  FROM articulos where codarticulo='$codigo'";
		
		$rs_stock=mysql_query($sel_stock_antiguo);
		
		$stock_antiguo=mysql_result($rs_stock,0,"stock");
	
		
		$sel_actualizar="UPDATE articulos SET stock=(stock-'$cantidad') WHERE codarticulo='$codigo' AND codfamilia='$codfamilia'";
		$rs_actualizar = mysql_query($sel_actualizar);
		
		
		$sel_stock_nuevo="SELECT stock FROM articulos WHERE codarticulo='$codigo'";
	
		$rs_stock_nuevo=mysql_query($sel_stock_nuevo);
		$stock_nuevo=mysql_result($rs_stock_nuevo,0,"stock");
		
		  $sel_control_articulos="INSERT INTO control_articulos (fecha,codarticulo,stock_antiguo,cantidad_retirada,stock_nuevo,modulo_mod,idusuario)VALUES('$fecha1','$codigo','$stock_antiguo','$cantidad','$stock_nuevo','EREP','$idusu')";
			$rs_control=mysql_query($sel_control_articulos);
	
		
		$contador++;
	}
	$sel_borrar = "DELETE FROM linea_ent_repa WHERE codalbaran='$codalbaran'";
	$rs_borrar = mysql_query($sel_borrar);
	$sel_lineastmp = "SELECT * FROM linea_ent_repa_tmp WHERE codalbaran='$codalbarantmp' ORDER BY numlinea";
	$rs_lineastmp = mysql_query($sel_lineastmp);
	$contador=0;
	$baseimponible=0;
	while ($contador < mysql_num_rows($rs_lineastmp)) {
		$numlinea=mysql_result($rs_lineastmp,$contador,"numlinea");
		$codigo=mysql_result($rs_lineastmp,$contador,"codigo");
		$codfamilia=mysql_result($rs_lineastmp,$contador,"codfamilia");
		$cantidad=mysql_result($rs_lineastmp,$contador,"cantidad");
		//$precio=mysql_result($rs_lineastmp,$contador,"precio");
		//$importe=mysql_result($rs_lineastmp,$contador,"importe");
		//$baseimponible=$baseimponible+$importe;
		$observacion=mysql_result($rs_lineastmp,$contador,"observacion");
		//$dcto=mysql_result($rs_lineastmp,$contador,"dcto");
	
	
		$sel_stock_antiguo="SELECT stock  FROM articulos where codarticulo='$codigo'";
		
		$rs_stock=mysql_query($sel_stock_antiguo);
		
		$stock_antiguo=mysql_result($rs_stock,0,"stock");
	
	
		$sel_insert = "INSERT INTO linea_ent_repa (codalbaran,numlinea,codigo,codfamilia,cantidad,observacion) 
		VALUES ('$codalbaran','','$codigo','$codfamilia','$cantidad','$observacion')";
		$rs_insert = mysql_query($sel_insert);
		
		$sel_actualiza="UPDATE articulos SET stock=(stock+'$cantidad'),id_usuario_mod='$idusu',fecha_mod='$fecha1' WHERE codarticulo='$codigo' AND codfamilia='$codfamilia'";
		$rs_actualiza = mysql_query($sel_actualiza);
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
		   
		   $sel_stock_nuevo="SELECT stock FROM articulos WHERE codarticulo='$codigo'";
	
		$rs_stock_nuevo=mysql_query($sel_stock_nuevo);
		$stock_nuevo=mysql_result($rs_stock_nuevo,0,"stock");
		
		  $sel_control_articulos="INSERT INTO control_articulos (fecha,codarticulo,stock_antiguo,cantidad_retirada,stock_nuevo,modulo_mod,idusuario)VALUES('$fecha1','$codigo','$stock_antiguo','$cantidad','$stock_nuevo','EREP','$idusu')";
			$rs_control=mysql_query($sel_control_articulos);
		
		   
		   
		$contador++;
	}
	/*$baseimpuestos=$baseimponible*($iva/100);
	$preciototal=$baseimponible+$baseimpuestos;
	//$preciototal=number_format($preciototal,2);	
	$sel_act="UPDATE albaranes_sys SET totalalbaran='$preciototal' WHERE codalbaran='$codalbaran'";
	$rs_act=mysql_query($sel_act);
	$baseimponible=0;
	$preciototal=0;
	$baseimpuestos=0;*/
	if ($rs_act) { $mensaje="Los datos de la Entrada han sido modificados correctamente"; }
	$cabecera1="Inicio >> Modificar";
	$cabecera2="MODIFICAR Entrada por reparación";
}

if ($accion=="baja") {
	$codalbaran=$_GET["codalbaran"];
	$query="UPDATE albaranes_elec SET borrado=1 WHERE codalbaran='$codalbaran'";
	$rs_query=mysql_query($query);
	$query="SELECT * FROM albalinea_elec WHERE codalbaran='$codalbaran' ORDER BY numlinea ASC";
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
	$query_mostrar="SELECT * FROM albaranes_elec WHERE codalbaran='$codalbaran'";
	$rs_mostrar=mysql_query($query_mostrar);
	$codcliente=mysql_result($rs_mostrar,0,"id_ccostos");
	$fecha=mysql_result($rs_mostrar,0,"fecha");
	$iva=mysql_result($rs_mostrar,0,"iva");
}

if ($accion=="convertir") {
	$codalbaran=$_POST["codalbaran"];
	$fecha=$_POST["fecha"];
	$fecha=explota($fecha);
	$sel_albaran="SELECT * FROM albaranes_elec WHERE codalbaran='$codalbaran'";
	$rs_albaran=mysql_query($sel_albaran);
	$iva=mysql_result($rs_albaran,0,"iva");
	$codcliente=mysql_result($rs_albaran,0,"id_ccostos");
	$totalfactura=mysql_result($rs_albaran,0,"totalalbaran");
	$sel_factura="INSERT INTO facturas (codfactura,fecha,iva,id_ccostos,estado,totalfactura,borrado) VALUES 
		('','$fecha','$iva','$codcliente','1','$totalfactura','0')";
	$rs_factura=mysql_query($sel_factura);
	$codfactura=mysql_insert_id();
	$act_albaran="UPDATE albaranes_elec SET codfactura='$codfactura',estado='2' WHERE codalbaran='$codalbaran'";
	$rs_act=mysql_query($act_albaran);
	$sel_lineas="SELECT * FROM albalinea_elec WHERE codalbaran='$codalbaran' ORDER BY numlinea ASC";
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
			window.open("../fpdf/imprimir_entrada_repa.php?codalbaran="+codalbaran);
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
                        
                       
                        
						<? } 
						  ?>
						 <tr>
						  <td>C&oacute;digo de Entrada</td>
						  <td colspan="2"><?php echo $codalbaran?></td>
					  </tr>
                        
					
					  	  <tr>
						  <td>Remisi&oacute;n</td>
						  <td colspan="2"><?php echo $remision?></td>
					  </tr>
					 
					  <tr>
						  <td>Fecha</td>
						  <td colspan="2"><?php echo $fecha1?></td>
					  </tr>
                      
                      
                      <tr>
						  <td>Técnico de Hardware</td>
						  <td colspan="2"><?php echo $tecnico?></td>
					  </tr>
                      
                       <tr>
						  <td>Observaciones Generales</td>
						  <td colspan="2"><?php echo $obse?></td>
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
							<td width="30%">OBSERVACION</td>
						</tr>
					</table>
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0 ID="Table1">
					  <? $sel_lineas="SELECT linea_ent_repa.*,articulos.*,familias.nombre as nombrefamilia FROM linea_ent_repa,articulos,familias WHERE linea_ent_repa.codalbaran='$codalbaran' AND linea_ent_repa.codigo=articulos.codarticulo AND linea_ent_repa.codfamilia=articulos.codfamilia AND articulos.codfamilia=familias.codfamilia ORDER BY linea_ent_repa.numlinea ASC";
$rs_lineas=mysql_query($sel_lineas);
						for ($i = 0; $i < mysql_num_rows($rs_lineas); $i++) {
							$numlinea=mysql_result($rs_lineas,$i,"numlinea");
							$codfamilia=mysql_result($rs_lineas,$i,"codfamilia");
							$nombrefamilia=mysql_result($rs_lineas,$i,"nombrefamilia");
							$codarticulo=mysql_result($rs_lineas,$i,"codarticulo");
							$referencia=mysql_result($rs_lineas,$i,"referencia");
							$descripcion=mysql_result($rs_lineas,$i,"descripcion");
							$cantidad=mysql_result($rs_lineas,$i,"cantidad");
							$observacion=mysql_result($rs_lineas,$i,"observacion");			
										
										if ($i % 2) { $fondolinea="itemParTabla"; } else { $fondolinea="itemImparTabla"; } ?>
									<tr class="<? echo $fondolinea?>">
										<td width="5%" class="aCentro"><? echo $i+1?></td>
										<td width="25%"><? echo $referencia?></td>
										<td width="30%"><? echo $descripcion?></td>
										<td width="10%" class="aCentro"><? echo $cantidad?></td>
										<td width="30%" class="aCentro"><? echo $observacion?></td>
									</tr>
					<? } ?>
					</table>
			  </div>
<?php /*?>				  <?
				  $baseimpuestos=$baseimponible*($iva/100);
			      $preciototal=$baseimponible+$baseimpuestos;
			      $preciototal=number_format($preciototal,2);
			  	  ?><?php */?>
				<!--	<div id="frmBusqueda">
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
			  </div>-->
				<div id="botonBusqueda">
					<div align="center">
					 <img src="../img/botonaceptar.jpg" width="85" height="22" onClick="aceptar()" border="1" onMouseOver="style.cursor=cursor">
					  <? if ($accion=="convertir") { ?>
					   <img src="../img/botonimprimir.jpg" width="79" height="22" border="1" onClick="imprimirf(<? echo $codfactura?>)" onMouseOver="style.cursor=cursor">
					   <? } else { ?>
					   <img src="../img/botonimprimir.jpg" width="79" height="22" border="1" onClick="imprimir(<? echo $codalbaran?>)" onMouseOver="style.cursor=cursor">
					   <? } ?>
				        </div>
					</div>
			  </div>
		  </div>
		</div>
		
	
		
	</body>
</html>