<?
include ("../conectar.php"); 
include ("../funciones/fechas.php"); 
error_reporting (0);

$codalbaran=$_GET["codalbaran"];
$cadena_busqueda=$_GET["cadena_busqueda"];

$query="SELECT * FROM entrada_reparacion WHERE id='$codalbaran'";
$rs_query=mysql_query($query);
$codcliente=mysql_result($rs_query,0,"id_item_tramos");
$fecha=mysql_result($rs_query,0,"fecha_entrada");
//$iva=mysql_result($rs_query,0,"iva");

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
			window.open("../fpdf/imprimir_entrada_repa.php?codalbaran="+codalbaran);
		}
		
		</script>
	</head>
	<body>
		<div id="pagina">
			<div id="zonaContenido">
				<div align="center">
				<div id="tituloForm" class="header">VER GUIA DE ENTRADA POR REPARACION </div>
				<div id="frmBusqueda">
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
						<? 
						 $sel_cliente="SELECT CONCAT (tra.name_tramo, '-', name_item_tramos)AS centro, idItem_tramos FROM item_tramos item JOIN entrada_reparacion repa ON repa.id_item_tramos=item.idItem_tramos JOIN tramos tra ON tra.idTramos=item.Tramos_idTramos WHERE repa.id='$codalbaran'"; 
						  $rs_cliente=mysql_query($sel_cliente); ?>
                          
                          <tr>
						  <td>C&oacute;digo Guia de Entrada</td>
						  <td colspan="2"><?php echo $codalbaran?></td>
					  </tr>
                          
					  <tr>
							<td width="15%">Centro de costo</td>
							<td width="85%" colspan="2"><?php echo mysql_result($rs_cliente,0,"centro");?></td>
					    </tr>
						<tr>
<!--							<td width="15%">RUT</td>
						    <td width="85%" colspan="2"><?php //echo mysql_result($rs_cliente,0,"nif");?></td>
					    </tr>-->
<!--						<tr>
						  <td>Direcci&oacute;n</td>
						  <td colspan="2"><?php //echo mysql_result($rs_cliente,0,"direccion"); ?></td>
					  </tr>-->
						
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
							<td width="3%">ITEM</td>
							<td width="25%">REFERENCIA</td>
							<td width="30%">DESCRIPCION</td>
							<td width="10%">CANTIDAD</td>
				
					   </tr>
					</table>
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0 ID="Table1">
					  <? $sel_lineas="SELECT  linea_ent_repa.*,articulos.*,familias.nombre as nombrefamilia FROM linea_ent_repa,articulos,familias WHERE linea_ent_repa.codalbaran='$codalbaran' AND linea_ent_repa.codigo=articulos.codarticulo AND linea_ent_repa.codfamilia=articulos.codfamilia AND articulos.codfamilia=familias.codfamilia ORDER BY linea_ent_repa.numlinea ASC";
$rs_lineas=mysql_query($sel_lineas);
						for ($i = 0; $i < mysql_num_rows($rs_lineas); $i++) {
							$numlinea=mysql_result($rs_lineas,$i,"numlinea");
							$codfamilia=mysql_result($rs_lineas,$i,"codfamilia");
							$nombrefamilia=mysql_result($rs_lineas,$i,"nombrefamilia");
							$codarticulo=mysql_result($rs_lineas,$i,"codarticulo");
							$descripcion=mysql_result($rs_lineas,$i,"descripcion");
							$referencia=mysql_result($rs_lineas,$i,"referencia");
							$cantidad=mysql_result($rs_lineas,$i,"cantidad");
							
							//$descuento=mysql_result($rs_lineas,$i,"dcto");
							if ($i % 2) { $fondolinea="itemParTabla"; } else { $fondolinea="itemImparTabla"; } ?>
									<tr class="<? echo $fondolinea?>">
										<td width="17%" class="aCentro"><? echo $i+1?></td>
										<td width="18%"><? echo $referencia?></td>
										<td width="31%"><? echo $descripcion?></td>
										<td width="11%" class="aCentro"><? echo $cantidad?></td>
										<td width="11%" class="aCentro"><? echo $precio?></td>
									
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