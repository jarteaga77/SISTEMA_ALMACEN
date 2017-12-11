<?
include ("../conectar.php"); 
include ("../funciones/fechas.php"); 
include ("../security.php"); 
error_reporting(0);

date_default_timezone_set('America/Bogota');

$accion=$_POST["accion"];
if (!isset($accion)) { $accion=$_GET["accion"]; }

$codalbarantmp=$_POST["codalbarantmp"];
$codcliente=$_POST["codcliente"];
$fecha=$_POST["fecha"];

//$iva=$_POST["iva"];
$transporta=$_POST["transporta"];

$entrega=$_POST["entrega"];

$recibe=$_POST["recibe"];

$observacion=$_POST["observaciones"];

$cerrar=$_POST["cbocerrar"];

$fecha1=date("Y-m-d H:i:s");

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
       
	$query_operacion="INSERT INTO devoluciones (fecha,item_ccostos,entrega,transporta,recibe,observacion,id_usuario, activo) 
            VALUES ('$fecha',$codcliente,'$entrega','$transporta','$recibe','$observacion',$idusu, '$activo')" or die(mysql_error());					
        $rs_operacion=mysql_query($query_operacion);
        
      
	$codalbaran=mysql_insert_id();
       
	if ($rs_operacion) { $mensaje="La Devoluci&oacute;n ha sido dado de alta correctamente"; }
	$query_tmp="SELECT * FROM devulineatmp WHERE coddevu='$codalbarantmp' ORDER BY numlinea ASC";
	$rs_tmp=mysql_query($query_tmp);
	$contador=0;
	//$baseimponible=0;
	while ($contador < mysql_num_rows($rs_tmp)) {
		$codfamilia=mysql_result($rs_tmp,$contador,"codfamilia");
		$numlinea=mysql_result($rs_tmp,$contador,"numlinea");
		$codigo=mysql_result($rs_tmp,$contador,"codigo");
		$cantidad=mysql_result($rs_tmp,$contador,"cantidad");
		$cantidadnok=mysql_result($rs_tmp,$contador,"cantidadNoOK");
		$obse=mysql_result($rs_tmp,$contador,"observacion");
		
		$sel_stock_antiguo="SELECT stock  FROM articulos where codarticulo='$codigo'";
		
		$rs_stock=mysql_query($sel_stock_antiguo);
		
		$stock_antiguo=mysql_result($rs_stock,0,"stock");
		
		
		
		
		$sel_insertar="INSERT INTO devulucioneslinea (numlinea,cod_familia,cod_producto,cantidad,cantidadNoOK,observacion,coddevo) VALUES 
		($numlinea,$codfamilia,'$codigo',$cantidad,'$cantidadnok','$obse',$codalbaran)" or die(mysql_error());
		$rs_insertar=mysql_query($sel_insertar);		
		$sel_articulos="UPDATE articulos SET stock=(stock+'$cantidad'),id_usuario_mod='$idusu',fecha_mod='$fecha1' WHERE codarticulo='$codigo' AND codfamilia='$codfamilia'";
		$rs_articulos=mysql_query($sel_articulos);
		$sel_minimos = "SELECT stock,stock_minimo,descripcion FROM articulos where codarticulo='$codigo' AND codfamilia='$codfamilia'";
		$rs_minimos= mysql_query($sel_minimos);
		$stock_nuevo=mysql_result($rs_minimos,0,"stock");
//		if ((mysql_result($rs_minimos,0,"stock") < mysql_result($rs_minimos,0,"stock_minimo")) or (mysql_result($rs_minimos,0,"stock") <= 0))
//	   		{ 
//		  		$mensaje_minimo=$mensaje_minimo . " " . mysql_result($rs_minimos,0,"descripcion")."<br>";
//				$minimo=1;
//   			};

	$sel_control_articulos="INSERT INTO control_articulos (fecha,codarticulo,stock_antiguo,cantidad_retirada,stock_nuevo,modulo_mod,idusuario)VALUES('$fecha1','$codigo','$stock_antiguo','$cantidad','$stock_nuevo','DEVO','$idusu')";
			$rs_control=mysql_query($sel_control_articulos);
			


		$contador++;
	}
//	$baseimpuestos=$baseimponible*($iva/100);
//	$preciototal=$baseimponible+$baseimpuestos;
	//$preciototal=number_format($preciototal,2);	
//	$sel_act="UPDATE albaranes SET totalalbaran='$preciototal' WHERE codalbaran='$codalbaran'";
//	$rs_act=mysql_query($sel_act);
//	$baseimponible=0;
//	$preciototal=0;
//	$baseimpuestos=0;
	$cabecera1="Inicio >> Ventas &gt;&gt; Nuevo Albar&aacute;n ";
	$cabecera2="INSERTAR DEVOLUCION ";
}

if ($accion=="modificar") {
	$codalbaran=$_POST["codalbaran"];
	$act_albaran="UPDATE devoluciones SET item_ccostos='$codcliente', fecha_mod='$fecha1', id_usuario_mod='$idusu', activo='$activo' WHERE id_devoluciones='$codalbaran'";
	$rs_albaran=mysql_query($act_albaran);
	$sel_lineas = "SELECT cod_producto,cod_familia,cantidad,cantidadNoOK FROM devulucioneslinea WHERE coddevo='$codalbaran' order by numlinea";
	$rs_lineas = mysql_query($sel_lineas);
	$contador=0;
	while ($contador < mysql_num_rows($rs_lineas)) {
		$codigo=mysql_result($rs_lineas,$contador,"cod_producto");
		$codfamilia=mysql_result($rs_lineas,$contador,"cod_familia");
		$cantidad=mysql_result($rs_lineas,$contador,"cantidad");
		$cantidadnok=mysql_result($rs_lineas,$contador,"cantidadNoOK");
		
		$sel_stock_antiguo="SELECT stock  FROM articulos where codarticulo='$codigo'";
		
		$rs_stock=mysql_query($sel_stock_antiguo);
		
		$stock_antiguo=mysql_result($rs_stock,0,"stock");
		
		$sel_actualizar="UPDATE `articulos` SET stock=(stock-'$cantidad') WHERE codarticulo='$codigo' AND codfamilia='$codfamilia'";
		$rs_actualizar = mysql_query($sel_actualizar);
		
		$sel_stock_nuevo="SELECT stock FROM articulos WHERE codarticulo='$codigo'";
	
		$rs_stock_nuevo=mysql_query($sel_stock_nuevo);
		$stock_nuevo=mysql_result($rs_stock_nuevo,0,"stock");
		
		  $sel_control_articulos="INSERT INTO control_articulos (fecha,codarticulo,stock_antiguo,cantidad_retirada,stock_nuevo,modulo_mod,idusuario)VALUES('$fecha1','$codigo','$stock_antiguo','$cantidad','$stock_nuevo','DEVO','$idusu')";
			$rs_control=mysql_query($sel_control_articulos);
		
		
		
		$contador++;
	}
	$sel_borrar = "DELETE FROM devulucioneslinea WHERE coddevo='$codalbaran'";
	$rs_borrar = mysql_query($sel_borrar);
	$sel_lineastmp = "SELECT * FROM devulineatmp WHERE coddevu='$codalbarantmp' ORDER BY numlinea";
	$rs_lineastmp = mysql_query($sel_lineastmp);
	$contador=0;
	//echo "paso por aca";
	//$baseimponible=0;
	while ($contador < mysql_num_rows($rs_lineastmp)) {
		$numlinea=mysql_result($rs_lineastmp,$contador,"numlinea");
		$codigo=mysql_result($rs_lineastmp,$contador,"codigo");
		$codfamilia=mysql_result($rs_lineastmp,$contador,"codfamilia");
		$cantidad=mysql_result($rs_lineastmp,$contador,"cantidad");
		$cantidadnok=mysql_result($rs_lineastmp,$contador,"cantidadNoOK");
		
                $observacion=mysql_result($rs_lineastmp,$contador,"observacion");
				
				
				$sel_stock_antiguo="SELECT stock  FROM articulos where codarticulo='$codigo'";
		
		$rs_stock=mysql_query($sel_stock_antiguo);
		
		$stock_antiguo=mysql_result($rs_stock,0,"stock");
		
//		$precio=mysql_result($rs_lineastmp,$contador,"precio");
//		$importe=mysql_result($rs_lineastmp,$contador,"importe");
//		$baseimponible=$baseimponible+$importe;
//		$dcto=mysql_result($rs_lineastmp,$contador,"dcto");
	
		 $sel_insert = "INSERT INTO devulucioneslinea (coddevo,cod_producto,cod_familia,cantidad,cantidadNoOK,observacion)
		VALUES ('$codalbaran','$codigo','$codfamilia','$cantidad', '$cantidadnok','$observacion')";
		$rs_insert = mysql_query($sel_insert);
		
		$sel_actualiza="UPDATE articulos SET stock=(stock+'$cantidad'),id_usuario_mod='$idusu', fecha_mod='$fecha1' WHERE codarticulo='$codigo' AND codfamilia='$codfamilia'";
		$rs_actualiza = mysql_query($sel_actualiza);
		$sel_bajominimo ="SELECT stock,stock_minimo,descripcion FROM articulos WHERE codarticulo='$codigo' AND codfamilia='$codfamilia'";
		$rs_bajominimo= mysql_query($sel_bajominimo);
		$stock=mysql_result($rs_bajominimo,0,"stock");
		$stock_minimo=mysql_result($rs_bajominimo,0,"stock_minimo");
		$descripcion=mysql_result($rs_bajominimo,0,"descripcion");
		
		//if (($stock < $stock_minimo) or ($stock <= 0))
//		   { 
//			  $mensaje_minimo=$mensaje_minimo . " " . $descripcion."<br>";
//			  $minimo=1;
//		   };

	$sel_stock_nuevo="SELECT stock FROM articulos WHERE codarticulo='$codigo'";
	
		$rs_stock_nuevo=mysql_query($sel_stock_nuevo);
		$stock_nuevo=mysql_result($rs_stock_nuevo,0,"stock");
		
		  $sel_control_articulos="INSERT INTO control_articulos (fecha,codarticulo,stock_antiguo,cantidad_retirada,stock_nuevo,modulo_mod,idusuario)VALUES('$fecha1','$codigo','$stock_antiguo','$cantidad','$stock_nuevo','DEVO','$idusu')";
			$rs_control=mysql_query($sel_control_articulos);
		

		$contador++;
	}
//	$baseimpuestos=$baseimponible*($iva/100);
//	$preciototal=$baseimponible+$baseimpuestos;
	//$preciototal=number_format($preciototal,2);	
//	$sel_act="UPDATE albaranes SET totalalbaran='$preciototal' WHERE codalbaran='$codalbaran'";
//	$rs_act=mysql_query($sel_act);
//	$baseimponible=0;
//	$preciototal=0;
//	$baseimpuestos=0;
	if ($rs_act) { $mensaje="Los datos de la Devoluci&aocute;n han sido modificados correctamente"; }
	$cabecera1="Inicio >> Ventas &gt;&gt; Modificar Albar&aacute;n ";
	$cabecera2="MODIFICAR DEVOLUCION ";
}

//if ($accion=="baja") {
//	$codalbaran=$_GET["codalbaran"];
//	$query="UPDATE albaranes SET borrado=1 WHERE codalbaran='$codalbaran'";
//	$rs_query=mysql_query($query);
//	$query="SELECT * FROM albalinea WHERE codalbaran='$codalbaran' ORDER BY numlinea ASC";
//	$rs_tmp=mysql_query($query);
//	$contador=0;
//	$baseimponible=0;
//	while ($contador < mysql_num_rows($rs_tmp)) {
//		$codfamilia=mysql_result($rs_tmp,$contador,"codfamilia");
//		$codigo=mysql_result($rs_tmp,$contador,"codigo");
//		$cantidad=mysql_result($rs_tmp,$contador,"cantidad");
//		$sel_articulos="UPDATE articulos SET stock=(stock-'$cantidad') WHERE codarticulo='$codigo' AND codfamilia='$codfamilia'";
//		$rs_articulos=mysql_query($sel_articulos);
//		$contador++;
//	}
//	if ($rs_query) { $mensaje="El albar&aacute;n ha sido eliminado correctamente"; }
//	$cabecera1="Inicio >> Ventas &gt;&gt; Eliminar Albar&aacute;n";
//	$cabecera2="ELIMINAR SALIDA ALMACEN";
//	$query_mostrar="SELECT * FROM albaranes WHERE codalbaran='$codalbaran'";
//	$rs_mostrar=mysql_query($query_mostrar);
//	$codcliente=mysql_result($rs_mostrar,0,"id_ccostos");
//	$fecha=mysql_result($rs_mostrar,0,"fecha");
//	$iva=mysql_result($rs_mostrar,0,"iva");
//}

//if ($accion=="convertir") {
//	$codalbaran=$_POST["codalbaran"];
//	$fecha=$_POST["fecha"];
//	$fecha=explota($fecha);
//	$sel_albaran="SELECT * FROM albaranes WHERE codalbaran='$codalbaran'";
//	$rs_albaran=mysql_query($sel_albaran);
//	$iva=mysql_result($rs_albaran,0,"iva");
//	$codcliente=mysql_result($rs_albaran,0,"id_ccostos");
//	$totalfactura=mysql_result($rs_albaran,0,"totalalbaran");
//	$sel_factura="INSERT INTO facturas (codfactura,fecha,iva,id_ccostos,estado,totalfactura,borrado) VALUES 
//		('','$fecha','$iva','$codcliente','1','$totalfactura','0')";
//	$rs_factura=mysql_query($sel_factura);
//	$codfactura=mysql_insert_id();
//	$act_albaran="UPDATE albaranes SET codfactura='$codfactura',estado='2' WHERE codalbaran='$codalbaran'";
//	$rs_act=mysql_query($act_albaran);
//	$sel_lineas="SELECT * FROM albalinea WHERE codalbaran='$codalbaran' ORDER BY numlinea ASC";
//	$rs_lineas=mysql_query($sel_lineas);
//	$contador=0;
//	while ($contador < mysql_num_rows($rs_lineas)) {
//		$codfamilia=mysql_result($rs_lineas,$contador,"codfamilia");
//		$codigo=mysql_result($rs_lineas,$contador,"codigo");
//		$cantidad=mysql_result($rs_lineas,$contador,"cantidad");
//		$precio=mysql_result($rs_lineas,$contador,"precio");
//		$importe=mysql_result($rs_lineas,$contador,"importe");
//		$dcto=mysql_result($rs_lineas,$contador,"dcto");
//		$sel_insert="INSERT INTO factulinea (codfactura,numlinea,codfamilia,codigo,cantidad,precio,importe,dcto) VALUES 
//			('$codfactura','','$codfamilia','$codigo','$cantidad','$precio','$importe','$dcto')";
//		$rs_insert=mysql_query($sel_insert);
//		$contador++;
//	}
//	$mensaje="El albar&aacute;n ha sido convertido correctamente";
//	$cabecera1="Inicio >> Ventas &gt;&gt; Convertir Albar&aacute;n";
//	$cabecera2="CONVERTIR ALBAR&Aacute;N";
//}

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
			window.open("../fpdf/imprimir_devo.php?codalbaran="+codalbaran);
		}
		
//		function imprimirf(codfactura) {
//			window.open("../fpdf/imprimir_factura.php?codfactura="+codfactura);
//		}
		
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
						 $sel_cliente="SELECT item.id_item_ccostos,CONCAT(centro.nombre_ccostos, '-',  item.nombre_item_ccostos) AS nombre FROM 
                                                    centrocostos centro JOIN item_ccostos item ON centro.id_ccostos=item.id_ccostos WHERE item.id_item_ccostos='$codcliente' "; 
						  $rs_cliente=mysql_query($sel_cliente); ?>
						<tr>
							<td width="15%">Centro de Costos</td>
							<td width="85%" colspan="2"><?php echo mysql_result($rs_cliente,0,"nombre");?></td>
					    </tr>
						<tr>
							<td width="15%">ID</td>
						    <td width="85%" colspan="2"><?php echo mysql_result($rs_cliente,0,"item.id_item_ccostos");?></td>
					    </tr>
					
					
					  	<tr>
						  <td>C&oacute;digo de Devoluci&oacute;n</td>
						  <td colspan="2"><?php echo $codalbaran?></td>
					  </tr>
					
					  <tr>
						  <td>Fecha</td>
						  <td colspan="2"><?php echo implota($fecha)?></td>
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
                            <td width="10%">CANTIDAD NO OK</td>
							
						</tr>
					</table>
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0 ID="Table1">
					  <? $sel_lineas="SELECT devulucioneslinea.*,articulos.*,familias.nombre as nombrefamilia FROM devulucioneslinea,articulos,familias WHERE devulucioneslinea.coddevo='$codalbaran' AND devulucioneslinea.cod_producto=articulos.codarticulo AND devulucioneslinea.cod_familia=articulos.codfamilia AND articulos.codfamilia=familias.codfamilia ORDER BY devulucioneslinea.numlinea ASC";
$rs_lineas=mysql_query($sel_lineas);
						for ($i = 0; $i < mysql_num_rows($rs_lineas); $i++) {
							$numlinea=mysql_result($rs_lineas,$i,"numlinea");
							$codfamilia=mysql_result($rs_lineas,$i,"codfamilia");
							$nombrefamilia=mysql_result($rs_lineas,$i,"nombrefamilia");
							$codarticulo=mysql_result($rs_lineas,$i,"codarticulo");
							$referencia=mysql_result($rs_lineas,$i,"referencia");
							$descripcion=mysql_result($rs_lineas,$i,"descripcion");
							$cantidad=mysql_result($rs_lineas,$i,"cantidad");
$cantidadnok=mysql_result($rs_lineas,$i,"cantidadNoOK");							
							
							
							if ($i % 2) { $fondolinea="itemParTabla"; } else { $fondolinea="itemImparTabla"; } ?>
									<tr class="<? echo $fondolinea?>">
										<td width="18%" class="aCentro"><? echo $i+1?></td>
										<td width="24%"><? echo $referencia?></td>
										<td width="29%"><? echo $descripcion?></td>
										<td width="14%" class="aCentro"><? echo $cantidad?></td>
                                        
                                        <td width="15%" class="aCentro"><? echo $cantidadnok?></td>
										
										
										
									</tr>
					<? } ?>
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
