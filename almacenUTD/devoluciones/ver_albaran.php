<?
include ("../conectar.php"); 
include ("../funciones/fechas.php"); 
error_reporting (0);

$codalbaran=$_GET["codalbaran"];
$cadena_busqueda=$_GET["cadena_busqueda"];

$query="SELECT * FROM devoluciones WHERE id_devoluciones='$codalbaran'";
$rs_query=mysql_query($query);
$codcliente=mysql_result($rs_query,0,"item_ccostos");
$fecha=mysql_result($rs_query,0,"fecha");
$entrega=mysql_result($rs_query,0,"entrega");
$transporta=mysql_result($rs_query,0,"transporta");
$recibe=mysql_result($rs_query,0,"recibe");
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
			window.open("../fpdf/imprimir_devo.php?codalbaran="+codalbaran);
		}
		
		</script>
	</head>
	<body>
		<div id="pagina">
			<div id="zonaContenido">
				<div align="center">
				<div id="tituloForm" class="header">VER GUIA DE DEVOLUCION</div>
				<div id="frmBusqueda">
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
                    
                    
                              <tr>
                                                    <td>C&oacute;digo de Devoluci&oacute;n</td>
						  <td colspan="2"><?php echo $codalbaran?></td>
					  </tr>
                    
						<? 
						 $sel_cliente="SELECT item.id_item_ccostos,CONCAT(centro.nombre_ccostos, '-',  item.nombre_item_ccostos) AS nombre FROM 
                                                    centrocostos centro JOIN item_ccostos item ON centro.id_ccostos=item.id_ccostos WHERE id_item_ccostos='$codcliente' ORDER BY centro.id_ccostos"; 
						  $rs_cliente=mysql_query($sel_cliente); ?>
						<tr>
							<td width="15%">Centro de costo</td>
							<td width="85%" colspan="2"><?php echo mysql_result($rs_cliente,0,"nombre");?></td>
					    </tr>
					
						
                                 
                                          
                                             <tr>
                                                    <td>Entrega</td>
						  <td colspan="2"><?php echo $entrega?></td>
					  </tr>
                                            <tr>
                                                    <td>Transporta</td>
						  <td colspan="2"><?php echo $transporta?></td>
					  </tr>
                                            <tr>
                                                    <td>Recibe</td>
						  <td colspan="2"><?php echo $recibe?></td>
					  </tr>
                                          
                                          
					  <tr>
						  <td>Fecha</td>
						  <td colspan="2"><?php echo $fecha?></td>
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
							$descripcion=mysql_result($rs_lineas,$i,"descripcion");
							$referencia=mysql_result($rs_lineas,$i,"referencia");
							$cantidad=mysql_result($rs_lineas,$i,"cantidad");
							$cantidadno=mysql_result($rs_lineas,$i,"cantidadNoOK");
						
							if ($i % 2) { $fondolinea="itemParTabla"; } else { $fondolinea="itemImparTabla"; } ?>
									<tr class="<? echo $fondolinea?>">
										<td width="9%" class="aCentro"><div align="center"><? echo $i+1?></td>
										<td width="24%"><div align="center"><? echo $referencia?></td>
										<td width="37%"><div align="center"><? echo $descripcion?></td>
										<td width="12%" class="aCentro"><div align="center"><? echo $cantidad?></td>
                                        
                                        <td width="18%" class="aCentro"><div align="center"><? echo $cantidadno?></td>
									
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
