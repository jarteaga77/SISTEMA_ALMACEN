<?
include ("../conectar.php"); 
include ("../funciones/fechas.php"); 
error_reporting (0);

$codalbaran=$_GET["id"];
$cadena_busqueda=$_GET["cadena_busqueda"];

$query="SELECT hm.fecha_mto,hm.vehiculos_equipos_id_vehiculo,hm.km_prox_mant,hm.id_hoja_mto,rut.id_rutina FROM hoja_mantenimiento hm JOIN rutinas rut ON hm.id_rutina=rut.id_rutina WHERE hm.id_hoja_mto='$codalbaran'";
$rs_query=mysql_query($query);
$idmto=mysql_result($rs_query,0,"hm.id_hoja_mto");
$fecha=mysql_result($rs_query,0,"hm.fecha_mto");
$proximo=mysql_result($rs_query,0,"hm.km_prox_mant");
$rutina=mysql_result($rs_query,0,"rut.id_rutina");
$vehiculo=mysql_result($rs_query,0,"hm.vehiculos_equipos_id_vehiculo");


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
			location.href="index.php?cadena_busqueda=<? echo $cadena_busqueda?>";
		}
		
		function imprimir(codalbaran) {
			window.open("../fpdf/imprimir_albaranMeca.php?codalbaran="+codalbaran);
		}
		
		</script>
	</head>
	<body>
		<div id="pagina">
			<div id="zonaContenido">
				<div align="center">
				<div id="tituloForm" class="header">VER HOJA DE MANTENIMIENTO</div>
				<div id="frmBusqueda">
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
					
					<tr>
						  <td>ID Hoja de Mantenimiento</td>
						  <td colspan="2"><?php echo $idmto?></td>
					  </tr>
					  <tr>
						  <td>Fecha</td>
						  <td colspan="2"><?php echo implota($fecha)?></td>
					  </tr>
                      
                      	<? 
						 $sel_vehiculo="SELECT CONCAT(ma.marca, '-', li.name_linea)AS nom FROM linea li,marca_vehiculo ma, vehiculos_equipos ve WHERE ve.Linea_idLinea=li.idLinea AND ma.id_marca=li.marca_vehiculo_id_marca AND ve.id_vehiculo='$vehiculo'"; 
						  $rs_vehiculo=mysql_query($sel_vehiculo); ?>
						<tr>
							<td width="15%">Vehiculo</td>
							<td width="85%" colspan="2"><?php echo mysql_result($rs_vehiculo,0,"nom");?></td>
					    </tr>
                      
                      
					  <tr>
						  <td>Kilometraje del Proximo Mto.</td>
						  <td colspan="2"><?php echo $proximo?></td>
					  </tr>
                      
                      	<? 
						 $sel_rutina="SELECT nom_rutina FROM rutinas WHERE id_rutina='$rutina'"; 
						  $rs_rutina=mysql_query($sel_rutina); ?>
						<tr>
							<td width="15%">Rutina</td>
							<td width="85%" colspan="2"><?php echo mysql_result($rs_rutina,0,"nom_rutina");?></td>
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
					  <? $sel_lineas="SELECT linea_hoja_mto.*,articulos.*,familias.nombre as nombrefamilia FROM linea_hoja_mto,articulos,familias WHERE linea_hoja_mto.hoja_mantenimiento_id_hoja_mto='$idmto' AND linea_hoja_mto.codigo=articulos.codarticulo AND linea_hoja_mto.codfamilia=articulos.codfamilia AND articulos.codfamilia=familias.codfamilia ORDER BY linea_hoja_mto.id_linea_hoja_mto ASC";
$rs_lineas=mysql_query($sel_lineas);
						for ($i = 0; $i < mysql_num_rows($rs_lineas); $i++) {
							//$numlinea=mysql_result($rs_lineas,$i,"id_linea_hoja_mto");
							$codfamilia=mysql_result($rs_lineas,$i,"codfamilia");
							$nombrefamilia=mysql_result($rs_lineas,$i,"nombrefamilia");
							$codarticulo=mysql_result($rs_lineas,$i,"codarticulo");
							$descripcion=mysql_result($rs_lineas,$i,"descripcion");
							$referencia=mysql_result($rs_lineas,$i,"referencia");
							$cantidad=mysql_result($rs_lineas,$i,"cantidad");
							$precio=mysql_result($rs_lineas,$i,"precio");
							$importe=mysql_result($rs_lineas,$i,"importe");
				
							if ($i % 2) { $fondolinea="itemParTabla"; } else { $fondolinea="itemImparTabla"; } ?>
									<tr class="<? echo $fondolinea?>">
										<td width="14%" class="aCentro"><? echo $i+1?></td>
										<td width="24%"><? echo $referencia?></td>
										<td width="29%"><? echo $descripcion?></td>
										<td width="11%" class="aCentro"><? echo $cantidad?></td>
										<td width="7%" class="aCentro"><? echo $precio?></td>
										<td width="8%" class="aCentro"><? echo $descuento?></td>
										<td width="7%" class="aCentro"><? echo $importe?></td>
									</tr>
									<? $baseimponible=$baseimponible+$importe; ?>
					<? } ?>
					</table>
			  </div>
			  <? $baseimpuestos=$baseimponible*($iva/100);
				$preciototal=$baseimponible+$baseimpuestos;
				$preciototal=number_format($preciototal,2); ?>
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
					 <img src="../img/botonimprimir.jpg" width="79" height="22" border="1" onClick="imprimir(<? echo $idmto?>)" onMouseOver="style.cursor=cursor">
				        </div>
					</div>
			  </div>
		  </div>
		</div>
	</body>
</html>
