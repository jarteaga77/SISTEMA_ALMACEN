<?
include ("../conectar.php"); 
include ("../funciones/fechas.php"); 
include ("../security.php"); 
error_reporting(0);

date_default_timezone_set('America/Bogota');

$accion=$_POST["accion"];
if (!isset($accion)) { $accion=$_GET["accion"]; }

$codalbarantmp=$_POST["codalbarantmp"];
//$codalbaran=$_POST["calbaran"];
$codproveedor=$_POST["codproveedor"];
$fecha=$_POST["fecha"];
$iva=$_POST["iva"];
$remision=$_POST["remi"];
$requi=$_POST["req"];
$orden=$_POST["orden"];
$centrocostos=$_POST["codcliente"];
$compras=$_POST["compra"];
$observacion=$_POST["observa"];
$cerrar=$_POST["cbocerrar"];


$fecha1=date("Y-m-d H:i:s");



if ($cerrar=="1")
{
	$activo=0;
}
else if($cerrar=="2")
	{
	$activo=1;
	}

        

$minimo=0;

$idusu = $_SESSION['id_User'];

if ($accion=="alta") {
	$query_comprobar="SELECT * FROM albaranesp WHERE codalbaran='$codalbarantmp' AND codproveedor='$codproveedor'";
	$rs_comprobar=mysql_query($query_comprobar);
	if (mysql_num_rows($rs_comprobar) > 0 ) {
			?><script>
				alert ("No se puede dar de alta este numero de albaran con este proveedor, ya existe uno en el sistema.");
				location.href="index.php";
			</script><?
	} else {
			$query_operacion="INSERT INTO albaranesp (codalbaran,codproveedor, codfactura, fecha, iva, estado,id_usuario,remision_factura,requisicion,orden_compra,id_ccostos,compras,observacion,activo) VALUES ('','$codproveedor',  '0', '$fecha', '$iva', '1', $idusu,'$remision',$requi,$orden, $centrocostos, '$compras','$observacion', '$activo')";					
			$rs_operacion=mysql_query($query_operacion);
                        $codalbaran=mysql_insert_id();
			if ($rs_operacion) { $mensaje="El albar&aacute;n ha sido dado de alta correctamente"; }
			$query_tmp="SELECT * FROM albalineaptmp WHERE codalbaran='$codalbarantmp' ORDER BY numlinea ASC";
			$rs_tmp=mysql_query($query_tmp);
			$contador=0;
			$baseimponible=0;
			while ($contador < mysql_num_rows($rs_tmp)) {
				$codfamilia=mysql_result($rs_tmp,$contador,"codfamilia");
				$numlinea=mysql_result($rs_tmp,$contador,"numlinea");
				$codigo=mysql_result($rs_tmp,$contador,"codigo");
				$cantidad=mysql_result($rs_tmp,$contador,"cantidad");
				$precio=mysql_result($rs_tmp,$contador,"precio");
				$importe=mysql_result($rs_tmp,$contador,"importe");
				$baseimponible=$baseimponible+$importe;
				$dcto=mysql_result($rs_tmp,$contador,"dcto");
				
				//Control articulos
				
				$sel_stock_antiguo="SELECT stock  FROM articulos where codarticulo='$codigo'";
		
		$rs_stock=mysql_query($sel_stock_antiguo);
		
		$stock_antiguo=mysql_result($rs_stock,0,"stock");
				
				
				
				$sel_insertar="INSERT INTO albalineap (codalbaran,codproveedor,numlinea,codfamilia,codigo,cantidad,precio,importe,dcto) VALUES 
				('$codalbaran','$codproveedor','$numlinea','$codfamilia','$codigo','$cantidad','$precio','$importe','$dcto')";
				$rs_insertar=mysql_query($sel_insertar);		
				$sel_articulos="UPDATE articulos SET stock=(stock+'$cantidad'),precio_compra='$precio', precio_almacen='$precio',precio_tienda='$precio',precio_pvp='$precio', precio_iva=('$precio'*0.16)+'$precio', fecha_mod='$fecha1', id_usuario_mod='$idusu' WHERE codarticulo='$codigo' AND codfamilia='$codfamilia'";
				$rs_articulos=mysql_query($sel_articulos);
				
				$sel_stock_nuevo="SELECT stock FROM articulos WHERE codarticulo='$codigo'";
				$rs_stocknuevo=mysql_query($sel_stock_nuevo);
				$stock_nuevo=mysql_result($rs_stocknuevo,0,"stock");
				
				$sel_comprobar="SELECT codarticulo FROM artpro WHERE codarticulo='".$codigo."' AND codfamilia='$codfamilia' AND codproveedor='".$codproveedor."'";
				$rs_comprobar=mysql_query($sel_comprobar);
				$precio=sprintf("%01.2f",$precio);
				if (mysql_num_rows($rs_comprobar) > 0) {
					$sentencia="UPDATE artpro SET precio='".$precio."' WHERE codarticulo='".$codigo."' AND codfamilia='$codfamilia' AND codproveedor='".$codproveedor."'";         } else {
					$sentencia="INSERT into artpro (codarticulo,codfamilia,codproveedor,precio) VALUES ('$codigo','$codfamilia','$codproveedor','$precio')";		
				}
				$ejecutar=mysql_query($sentencia);
				/*$sentencia2="UPDATE articulos SET ultimo_precio_costo='".$precio."' AND codproveedor='$codproveedor' WHERE codarticulo='$codigo' AND codfamilia='$codfamilia'";
				$ejecutar=mysql_query($sentencia2);*/
				
				$sel_control_articulos="INSERT INTO control_articulos (fecha,codarticulo,stock_antiguo,cantidad_retirada,stock_nuevo,modulo_mod,idusuario)VALUES('$fecha1','$codigo','$stock_antiguo','$cantidad','$stock_nuevo','ENAL','$idusu')";
			$rs_control=mysql_query($sel_control_articulos);
			
				
				$contador++;
			}
			$baseimpuestos=$baseimponible*($iva/100);
			$preciototal=$baseimponible+$baseimpuestos;
			//$preciototal=number_format($preciototal,2);	
			$sel_act="UPDATE albaranesp SET totalalbaran='$preciototal' WHERE codalbaran='$codalbaran'";
			$rs_act=mysql_query($sel_act);
			$baseimpuestos=0;
			$preciototal=0;
			$baseimponible=0;
			$cabecera1="Inicio >> Compras &gt;&gt; Nuevo ENTRADA ALMACEN ";
			$cabecera2="INSERTAR ENTRADA ";
		}
} 

if ($accion=="modificar") {
	$codalbaran=$_POST["codalbaran"];
	$act_albaran="UPDATE albaranesp SET iva='$iva',fecha_mod='$fecha1', id_usuario_mod='$idusu', activo='$activo' WHERE codalbaran='$codalbaran' AND codproveedor='$codproveedor'";
	$rs_albaran=mysql_query($act_albaran);
	$sel_lineas = "SELECT codigo,codfamilia,cantidad FROM albalineap WHERE codalbaran='$codalbaran' AND codproveedor='$codproveedor' order by numlinea";
	$rs_lineas = mysql_query($sel_lineas);
	$contador=0;
	while ($contador < mysql_num_rows($rs_lineas)) {
		$codigo=mysql_result($rs_lineas,$contador,"codigo");
		$codfamilia=mysql_result($rs_lineas,$contador,"codfamilia");
		$cantidad=mysql_result($rs_lineas,$contador,"cantidad");
		
		//Control articulos
		
		$sel_stock_antiguo="SELECT stock  FROM articulos where codarticulo='$codigo'";
		
		$rs_stock=mysql_query($sel_stock_antiguo);
		
		$stock_antiguo=mysql_result($rs_stock,0,"stock");
	
		
		
		$sel_actualizar="UPDATE articulos SET stock=(stock-'$cantidad'),precio_compra='$precio', precio_almacen='$precio',precio_tienda='$precio',precio_pvp='$precio', precio_iva=('$precio'*0.16)+'$precio',id_usuario_mod='$idusu', fecha_mod='$fecha1' WHERE codarticulo='$codigo' AND codfamilia='$codfamilia'";
		$rs_actualizar = mysql_query($sel_actualizar);
		
		
		//Control articulos
		$sel_stock_nuevo="SELECT stock FROM articulos WHERE codarticulo='$codigo'";
	
		$rs_stock_nuevo=mysql_query($sel_stock_nuevo);
		$stock_nuevo=mysql_result($rs_stock_nuevo,0,"stock");
		
		  $sel_control_articulos="INSERT INTO control_articulos (fecha,codarticulo,stock_antiguo,cantidad_retirada,stock_nuevo,modulo_mod,idusuario)VALUES('$fecha1','$codigo','$stock_antiguo','$cantidad','$stock_nuevo','ENAL','$idusu')";
			$rs_control=mysql_query($sel_control_articulos);
		
		
		
		$contador++;
	}
	$sel_borrar = "DELETE FROM albalineap WHERE codalbaran='$codalbaran' AND codproveedor='$codproveedor'";
	$rs_borrar = mysql_query($sel_borrar);
	$sel_lineastmp = "SELECT * FROM albalineaptmp WHERE codalbaran='$codalbarantmp' ORDER BY numlinea";
	$rs_lineastmp = mysql_query($sel_lineastmp);
	$contador=0;
	$baseimponible=0;
	while ($contador < mysql_num_rows($rs_lineastmp)) {
		$numlinea=mysql_result($rs_lineastmp,$contador,"numlinea");
		$codigo=mysql_result($rs_lineastmp,$contador,"codigo");
		$codfamilia=mysql_result($rs_lineastmp,$contador,"codfamilia");
		$cantidad=mysql_result($rs_lineastmp,$contador,"cantidad");
		$precio=mysql_result($rs_lineastmp,$contador,"precio");
		$importe=mysql_result($rs_lineastmp,$contador,"importe");
		$baseimponible=$baseimponible+$importe;
		$dcto=mysql_result($rs_lineastmp,$contador,"dcto");
		
		
		$sel_stock_antiguo="SELECT stock  FROM articulos where codarticulo='$codigo'";
		
		$rs_stock=mysql_query($sel_stock_antiguo);
		
		$stock_antiguo=mysql_result($rs_stock,0,"stock");
	
	
		$sel_insert = "INSERT INTO albalineap (codalbaran,codproveedor,numlinea,codigo,codfamilia,cantidad,precio,importe,dcto) 
		VALUES ('$codalbaran','$codproveedor','','$codigo','$codfamilia','$cantidad','$precio','$importe','$dcto')";
		$rs_insert = mysql_query($sel_insert);
		
		$sel_actualiza="UPDATE articulos SET stock=(stock+'$cantidad') WHERE codarticulo='$codigo' AND codfamilia='$codfamilia'";
		$rs_actualiza = mysql_query($sel_actualiza);
		$sel_bajominimo = "SELECT stock,stock_minimo,descripcion FROM articulos WHERE codarticulo='$codigo' AND codfamilia='$codfamilia'";
		$rs_bajominimo= mysql_query($sel_bajominimo);
		$stock=mysql_result($rs_bajominimo,0,"stock");
		$stock_minimo=mysql_result($rs_bajominimo,0,"stock_minimo");
		$descripcion=mysql_result($rs_bajominimo,0,"descripcion");
		
		if (($stock < $stock_minimo) or ($stock <= 0))
		   { 
			  $mensaje_minimo=$mensaje_minimo . " " . $descripcion."<br>";
			  $minimo=1;
		   };
		   
		   //Control articulos
		$sel_stock_nuevo="SELECT stock FROM articulos WHERE codarticulo='$codigo'";
	
		$rs_stock_nuevo=mysql_query($sel_stock_nuevo);
		$stock_nuevo=mysql_result($rs_stock_nuevo,0,"stock");
		
		  $sel_control_articulos="INSERT INTO control_articulos (fecha,codarticulo,stock_antiguo,cantidad_retirada,stock_nuevo,modulo_mod,idusuario)VALUES('$fecha1','$codigo','$stock_antiguo','$cantidad','$stock_nuevo','ENAL','$idusu')";
			$rs_control=mysql_query($sel_control_articulos);
		
		   
		$contador++;
	}
	$baseimpuestos=$baseimponible*($iva/100);
	$preciototal=$baseimponible+$baseimpuestos;
	//$preciototal=number_format($preciototal,2);	
	$sel_act="UPDATE albaranesp SET totalalbaran='$preciototal' WHERE codalbaran='$codalbaranp'";
	$rs_act=mysql_query($sel_act);
	$baseimpuestos=0;
	$preciototal=0;
	$baseimponible=0;
	if ($rs_act) { $mensaje="Los datos de la Entrada Almacen han sido modificados correctamente"; }
	$cabecera1="Inicio >> Compras &gt;&gt; Modificar Entrada Almacen ";
	$cabecera2="MODIFICAR ENTRADA ALMACEN ";
}

if ($accion=="baja") {
	$codalbaran=$_GET["codalbaran"];
        echo $codalbaran;
	$codproveedor=$_GET["codproveedor"];
	$query="SELECT * FROM albalineap WHERE codalbaran='$codalbaran' AND codproveedor='$codproveedor' ORDER BY numlinea ASC";
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
	if ($rs_query) { $mensaje="La  Entrada Almacen ha sido eliminada correctamente"; }
	$cabecera1="Inicio >> Compras &gt;&gt; Eliminar Entrada Almacen";
	$cabecera2="ELIMINAR ENTRADA";
	$query_mostrar="SELECT * FROM albaranesp WHERE codalbaran='$codalbaran' AND codproveedor='$codproveedor'";
	$rs_mostrar=mysql_query($query_mostrar);
	$codproveedor=mysql_result($rs_mostrar,0,"codproveedor");
	$fecha=mysql_result($rs_mostrar,0,"fecha");
	$iva=mysql_result($rs_mostrar,0,"iva");
}

if ($accion=="convertir") {
	$codalbaran=$_POST["codalbaran"];
	$fecha=$_POST["fecha"];
	$codfactura=$_POST["Acodfactura"];
	$fecha=explota($fecha);
	$query_comprobar="SELECT * FROM facturasp WHERE codfactura='$codfactura' AND codproveedor='$codproveedor'";
	$rs_comprobar=mysql_query($query_comprobar);
	if (mysql_num_rows($rs_comprobar) > 0 ) {
			?><script>
				alert ("No se puede dar de alta este numero de factura con este proveedor, ya existe uno en el sistema.");
				location.href="index.php";
			</script><?
	} else {
		$sel_albaran="SELECT * FROM albaranesp WHERE codalbaran='$$codalbarantmp' AND codproveedor='$codproveedor'";
		$rs_albaran=mysql_query($sel_albaran);
		$iva=mysql_result($rs_albaran,0,"iva");
		$codproveedor=mysql_result($rs_albaran,0,"codproveedor");
		$totalfactura=mysql_result($rs_albaran,0,"totalalbaran");
		$sel_factura="INSERT INTO facturasp (codfactura,fecha,iva,codproveedor,estado,totalfactura,borrado) VALUES 
			('$codfactura','$fecha','$iva','$codproveedor','1','$totalfactura','0')";
		$rs_factura=mysql_query($sel_factura);
		$act_albaran="UPDATE albaranesp SET codfactura='$codfactura',estado='2' WHERE codalbaran='$codalbarantmp' AND codproveedor='$codproveedor'";
		$rs_act=mysql_query($act_albaran);
		$sel_lineas="SELECT * FROM albalineap WHERE codalbaran='$codalbaran' AND codproveedor='$codproveedor' ORDER BY numlinea ASC";
		$rs_lineas=mysql_query($sel_lineas);
		$contador=0;
		while ($contador < mysql_num_rows($rs_lineas)) {
			$codfamilia=mysql_result($rs_lineas,$contador,"codfamilia");
			$codigo=mysql_result($rs_lineas,$contador,"codigo");
			$cantidad=mysql_result($rs_lineas,$contador,"cantidad");
			$precio=mysql_result($rs_lineas,$contador,"precio");
			$importe=mysql_result($rs_lineas,$contador,"importe");
			$dcto=mysql_result($rs_lineas,$contador,"dcto");
			$sel_insert="INSERT INTO factulineap (codfactura,codproveedor,numlinea,codfamilia,codigo,cantidad,precio,importe,dcto) VALUES 
				('$codfactura','$codproveedor','','$codfamilia','$codigo','$cantidad','$precio','$importe','$dcto')";
			$rs_insert=mysql_query($sel_insert);
			$contador++;
		}
		$mensaje="El albar&aacute;n ha sido convertido correctamente";
		$cabecera1="Inicio >> Compras &gt;&gt; Convertir Albar&aacute;n";
		$cabecera2="CONVERTIR ALBAR&Aacute;N";
	}
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
		
		function imprimir(codalbaran,codproveedor) {
			window.open("../fpdf/imprimir_albaran_proveedor.php?codalbaran="+codalbaran+"&codproveedor="+codproveedor);
		}
		
		function imprimirf(codfactura,codproveedor) {
			window.open("../fpdf/imprimir_factura_proveedor.php?codfactura="+codfactura+"&codproveedor="+codproveedor);
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
						<? 
						 $sel_proveedores="SELECT * FROM proveedores WHERE codproveedor='$codproveedor'"; 
						  $rs_proveedores=mysql_query($sel_proveedores); ?>
						
                        <tr>
						  <td>C&oacute;digo Entrada Almacen</td>
						  <td colspan="2"><?php echo $codalbaran ?></td>
					  </tr>
					  
                        
                        <tr>
							<td width="15%">Proveedor</td>
							<td width="85%" colspan="2"><?php echo mysql_result($rs_proveedores,0,"nombre");?></td>
					    </tr>
						<tr>
							<td width="15%">NIT</td>
						    <td width="85%" colspan="2"><?php echo mysql_result($rs_proveedores,0,"nif");?></td>
					    </tr>
						<tr>
						  <td>Direcci&oacute;n</td>
						  <td colspan="2"><?php echo mysql_result($rs_proveedores,0,"direccion"); ?></td>
					  </tr>

						
					  </tr>
					  
					  	
					  <tr>
						  <td>Fecha</td>
						  <td colspan="2"><?php echo $fecha?></td>
					  </tr>
					  <tr>
						  <td>IVA</td>
						  <td colspan="2"><?php echo $iva?> %</td>
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
							<td width="10%">DCTO %</td>
							<td width="10%">IMPORTE</td>
						</tr>
					</table>
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0 ID="Table1">
					  <? $sel_lineas="SELECT albalineap.*, articulos.descripcion, articulos.referencia, familias.nombre as nombrefamilia FROM albalineap,articulos,familias WHERE albalineap.codalbaran='$codalbaran' AND albalineap.codproveedor='$codproveedor' AND albalineap.codigo=articulos.codarticulo AND albalineap.codfamilia=articulos.codfamilia AND articulos.codfamilia=familias.codfamilia ORDER BY albalineap.numlinea ASC";
$rs_lineas=mysql_query($sel_lineas);
						for ($i = 0; $i < mysql_num_rows($rs_lineas); $i++) {
							$numlinea=mysql_result($rs_lineas,$i,"numlinea");
							$codfamilia=mysql_result($rs_lineas,$i,"codfamilia");
							$nombrefamilia=mysql_result($rs_lineas,$i,"nombrefamilia");
							$referencia=mysql_result($rs_lineas,$i,"referencia");
							$codarticulo=mysql_result($rs_lineas,$i,"codigo");
							$descripcion=mysql_result($rs_lineas,$i,"descripcion");
							$cantidad=mysql_result($rs_lineas,$i,"cantidad");
							$precio=mysql_result($rs_lineas,$i,"precio");
							$importe=mysql_result($rs_lineas,$i,"importe");
							$baseimponible=$baseimponible+$importe;
							$descuento=mysql_result($rs_lineas,$i,"dcto");
							if ($i % 2) { $fondolinea="itemParTabla"; } else { $fondolinea="itemImparTabla"; } ?>
									<tr class="<? echo $fondolinea?>">
										<td width="5%" class="aCentro"><? echo $i+1?></td>
										<td width="25%"><? echo $referencia?></td>
										<td width="30%"><? echo $descripcion?></td>
										<td width="10%" class="aCentro"><? echo $cantidad?></td>
										<td width="10%" class="aCentro"><? echo $precio?></td>
										<td width="10%" class="aCentro"><? echo $descuento?></td>
										<td width="10%" class="aCentro"><? echo $importe?></td>
									</tr>
					<? } ?>
					</table>
			  </div>
				  <?
				  $baseimpuestos=$baseimponible*($iva/100);
			      $preciototal=$baseimponible+$baseimpuestos;
			      $preciototal=number_format($preciototal,2,".",",");
			  	  ?>
					<div id="frmBusqueda">
					<table width="25%" border=0 align="right" cellpadding=3 cellspacing=0 class="fuente8">
						<tr>
							<td width="15%">Base imponible</td>
							<td width="15%" align="right"><? echo $simbolomoneda ?><?php echo number_format($baseimponible,2,".",",");?></td>
						</tr>
						<tr>
							<td width="15%">IVA</td>
							<td width="15%" align="right"><? echo $simbolomoneda ?><?php echo number_format($baseimpuestos,2,".",",");?></td>
						</tr>
						<tr>
							<td width="15%">Total</td>
							<td width="15%" align="right"><? echo $simbolomoneda ?><?php echo $preciototal?></td>
						</tr>
					</table>
			  </div>
			  <? if ($accion=="baja") { 
					  $query="DELETE FROM albaranesp WHERE codalbaran='$codalbaran' AND codproveedor='$codproveedor'";
						$rs_query=mysql_query($query);
						$borrar_lineas="DELETE FROM albalineap WHERE codalbaran='$codalbaran' AND codproveedor='$codproveedor'";
						$rs_borrar_lineas=mysql_query($borrar_lineas);
				} ?>
				<div id="botonBusqueda">
					<div align="center">
					  <img src="../img/botonaceptar.jpg" width="85" height="22" onClick="aceptar()" border="1" onMouseOver="style.cursor=cursor">
			
						   <img src="../img/botonimprimir.jpg" width="79" height="22" border="1" onClick="imprimir('<? echo $codalbaran?>',<? echo $codproveedor ?>)" onMouseOver="style.cursor=cursor">
					
				        </div>
					</div>
			  </div>
		  </div>
		</div>
	</body>
</html>
