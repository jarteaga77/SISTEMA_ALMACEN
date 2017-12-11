
<?php 
include ("../conectar.php"); 
include ("../funciones/fechas.php"); 
include ("../security.php");
error_reporting(0);

$codalbaran=$_GET["codalbaran"];

$level=$_SESSION['level'];

$sel_alb="SELECT * FROM devoluciones WHERE id_devoluciones='$codalbaran'";
$rs_alb=mysql_query($sel_alb);
$codcliente=mysql_result($rs_alb,0,"item_ccostos");
$fecha=mysql_result($rs_alb,0,"fecha");
$sel_cliente="SELECT item.id_item_ccostos,CONCAT(centro.nombre_ccostos, '-',  item.nombre_item_ccostos) AS nombre FROM 
              centrocostos centro JOIN item_ccostos item ON centro.id_ccostos=item.id_ccostos WHERE item.id_item_ccostos='$codcliente'";
$rs_cliente=mysql_query($sel_cliente);
$nombre=mysql_result($rs_cliente,0,"nombre");

$fechahoy=date("Y-m-d");
$sel_albaran="INSERT INTO devotmp (fecha) VALUE ('$fechahoy')";
$rs_albaran=mysql_query($sel_albaran);
$codalbarantmp=mysql_insert_id();

$sel_lineas="SELECT * FROM devulucioneslinea WHERE coddevo='$codalbaran' ORDER BY numlinea ASC";
$rs_lineas=mysql_query($sel_lineas);
$contador=0;
while ($contador < mysql_num_rows($rs_lineas)) {
	$codfamilia=mysql_result($rs_lineas,$contador,"cod_familia");
	$codigo=mysql_result($rs_lineas,$contador,"cod_producto");
	$cantidad=mysql_result($rs_lineas,$contador,"cantidad");
	$cantidadno=mysql_result($rs_lineas,$contador,"cantidadNoOK");
        //$observacion=mysql_result($rs_lineas,$contador,"observacion");
//	$precio=mysql_result($rs_lineas,$contador,"precio");
//	$importe=mysql_result($rs_lineas,$contador,"importe");
//	$baseimponible=$baseimponible+$importe;
//	$dcto=mysql_result($rs_lineas,$contador,"dcto");
	$sel_tmp="INSERT INTO devulineatmp (coddevu,numlinea,codfamilia,codigo,cantidad,cantidadNoOK,observacion) VALUES ($codalbarantmp,'',$codfamilia,'$codigo',$cantidad,$cantidadno,'$observacion')";
	$rs_tmp=mysql_query($sel_tmp);
	$contador++;
}

//$baseimpuestos=$baseimponible*($iva/100);
//$preciototal=$baseimponible+$baseimpuestos;
//$preciototal=number_format($preciototal,2);
?>
<html>
	<head>
		<title>Principal</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
		<link href="../calendario/calendar-blue.css" rel="stylesheet" type="text/css">
		<script type="text/JavaScript" language="javascript" src="../calendario/calendar.js"></script>
		<script type="text/JavaScript" language="javascript" src="../calendario/lang/calendar-sp.js"></script>
		<script type="text/JavaScript" language="javascript" src="../calendario/calendar-setup.js"></script>
		<script language="javascript">
		var cursor;
		if (document.all) {
		// Está utilizando EXPLORER
		cursor='hand';
		} else {
		// Está utilizando MOZILLA/NETSCAPE
		cursor='pointer';
		}
		
		var miPopup
		function abreVentana(){
			miPopup = window.open("ver_clientes.php","miwin","width=700,height=380,scrollbars=yes");
			miPopup.focus();
		}
		
		function inicio() {
			document.getElementById("modif").value=1;
			document.formulario_lineas.submit();
			document.getElementById("modif").value=0;
		}
		
			function comprobar(level)
		{
			var level=level;		
			if(level ==6  || level==8|| level==1 || level==2 || level==9 || level==3 || level==7)
			{
						document.getElementById("cbocerrar").disabled=false;
			}
			
		}
		
		function ventanaArticulos(){
			miPopup = window.open("ver_articulos.php","miwin","width=700,height=500,scrollbars=yes");
			miPopup.focus();
		}
		
		function validarcliente(){
			var codigo=document.getElementById("codcliente").value;
			miPopup = window.open("comprobarcliente.php?codcliente="+codigo,"frame_datos","width=700,height=80,scrollbars=yes");
		}	
		
		function cancelar() {
			location.href="index.php";
		}
		
		function limpiarcaja() {
			document.getElementById("nombre").value="";
			//document.getElementById("nif").value="";
		}
		
//		function actualizar_importe()
//			{
//				var precio=document.getElementById("precio").value;
//				var cantidad=document.getElementById("cantidad").value;
//				var descuento=document.getElementById("descuento").value;
//				descuento=descuento/100;
//				total=precio*cantidad;
//				descuento=total*descuento;
//				total=total-descuento;
//				var original=parseFloat(total);
//				var result=Math.round(original*100)/100 ;
//				document.getElementById("importe").value=result;
//			}
			
		function validar_cabecera()
			{
				var mensaje="";
				if (document.getElementById("nombre").value=="") mensaje+="  - Nombre\n";
				
				if (mensaje!="") {
					alert("Atencion, se han detectado las siguientes incorrecciones:\n\n"+mensaje);
				} else {
					document.getElementById("formulario").submit();
				}
			}	
		
		function validar() 
			{
				var mensaje="";
				var entero=0;
				var enteroo=0;
		
				if (document.getElementById("referencia").value=="") mensaje="  - Referencia\n";
				if (document.getElementById("descripcion").value=="") mensaje+="  - Descripcion\n";
							
						
				if (document.getElementById("cantidad").value=="") 
						{ 
						mensaje+="  - Falta la cantidad\n";
						} else {
							enteroo=parseFloat(document.getElementById("cantidad").value);
							if (isNaN(enteroo)==true) {
								mensaje+="  - La cantidad debe ser numerica\n";
							} else {
									document.getElementById("cantidad").value=enteroo;
								}
						}
				
				
				if (mensaje!="") {
					alert("Atencion, se han detectado las siguientes incorrecciones:\n\n"+mensaje);
				} else {
					
					document.getElementById("formulario_lineas").submit();
					document.getElementById("referencia").value="";
					document.getElementById("descripcion").value="";
					document.getElementById("cantidad").value=1;
										
				}
			}
			
//		function cambio_iva() {
//			var original=parseFloat(document.getElementById("baseimponible").value);
//			var result=Math.round(original*100)/100 ;
//			document.getElementById("baseimponible").value=result;
//	
//			document.getElementById("baseimpuestos").value=parseFloat(result * parseFloat(document.getElementById("iva").value / 100));
//			var original1=parseFloat(document.getElementById("baseimpuestos").value);
//			var result1=Math.round(original1*100)/100 ;
//			document.getElementById("baseimpuestos").value=result1;
//			var original2=parseFloat(result + result1);
//			var result2=Math.round(original2*100)/100 ;
//			document.getElementById("preciototal").value=result2;
//		}	
		</script>
	</head>
	<body onLoad="inicio()">
		<div id="pagina">
			<div id="zonaContenido">
				<div align="center">
				<div id="tituloForm" class="header">INSERTAR DEVOLUCION </div>
				<div id="frmBusqueda">
				<form id="formulario" name="formulario" method="post" action="guardar_albaran.php">
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
                                     <tr>
						  <td>C&oacute;digo Guia de Despacho</td>
						  <td colspan="2"><?php echo $codalbaran?></td>
					  </tr>
                    
						<tr>
							<td width="15%">Centro de Costos </td>
					      <td colspan="3"><input NAME="codcliente" type="text" class="cajaPequena" id="codcliente" size="6" maxlength="5" onClick="limpiarcaja()" value="<? echo $codcliente?>">
					        <img src="../img/ver.png" width="16" height="16" onClick="abreVentana()" title="Buscar cliente" onMouseOver="style.cursor=cursor"> <img src="../img/cliente.png" width="16" height="16" onClick="validarcliente()" title="Validar cliente" onMouseOver="style.cursor=cursor"></td>					
						</tr>
                        
       
                        
						<tr>
							<td width="6%">Nombre</td>
						    <td width="27%"><input NAME="nombre" type="text" class="cajaGrande" id="nombre" size="45" maxlength="45" value="<? echo $nombre?>" readonly></td>
                            
                            <tr>
							<td width="17%">Cerrar Devolución</td>

							<td><select id="cbocerrar" name="cbocerrar" class="comboMedio" disabled>

							
<option value="0" >Cerrar Devolución</option><option value="1">SI</option><option value="2">NO</option>        
						  
                                        </select>
                                        </td>
                                        </tr>
                        
                            
<!--				            <td width="3%">RUT</td>
				            <td width="64%"><input NAME="nif" type="text" class="cajaMedia" id="nif" size="20" maxlength="15" value="<? echo $nif?>" readonly></td>-->
						</tr>
						
				            
						</tr>
                        
                        
                                    <?
 echo "<script>";
echo "comprobar($level);";
echo "</script>";                              
     ?>   
						
					</table>										
			  </div>
			  <input id="codalbarantmp" name="codalbarantmp" value="<? echo $codalbarantmp?>" type="hidden">
			  <input id="codalbaran" name="codalbaran" value="<? echo $codalbaran?>" type="hidden">
			
			  <input id="accion" name="accion" value="modificar" type="hidden">			  
			  </form>
			  <br>
			  <div id="frmBusqueda">
				<form id="formulario_lineas" name="formulario_lineas" method="post" action="frame_lineas.php" target="frame_lineas">
				<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
				  <tr>
					<td width="11%">Referencia</td>
					<td colspan="10"><input NAME="referencia" type="text" class="cajaMedia" id="referencia" size="15" maxlength="15" readonly> <img src="../img/ver.png" width="16" height="16" onClick="ventanaArticulos()" onMouseOver="style.cursor=cursor" title="Buscar articulo"></td>
				  </tr>
				  <tr>
                                      <td>Descripci&oacute;n</td>
                                      <td width="19%"><input NAME="descripcion" type="text" class="cajaMedia" id="descripcion" size="30" maxlength="30" readonly></td>
					
					<td width="5%">Cantidad</td>
					<td width="5%"><input NAME="cantidad" type="text" class="cajaMinima" id="cantidad" size="10" maxlength="10" value="1"></td>
					
                    	<td width="5%">Cantidad NO OK</td>
					<td width="5%"><input NAME="cantNO" type="text" class="cajaMinima" id="cantNO" size="10" maxlength="10" value="0"></td>
                    
                                        <td>Observaci&oacute;n</td>
					<td width="19%"><input NAME="observacion" type="text" class="cajaMedia" id="observacion" size="30" maxlength="100" ></td>
					
                                        
                                        
					<td width="15%"><img src="../img/botonagregar.jpg" width="72" height="22" border="1" onClick="validar()" onMouseOver="style.cursor=cursor" title="Agregar articulo"></td>
				  </tr>
				</table>
				</div>
				<input name="codarticulo" value="<? echo $codarticulo?>" type="hidden" id="codarticulo">
				<br>
				<div id="frmBusqueda">
				<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">
						<tr class="cabeceraTabla">
							<td width="5%">ITEM</td>
							<td width="26%">REFERENCIA</td>
							<td width="30%">DESCRIPCION</td>
							<td width="8%">CANTIDAD</td>
                            <td width="8%">CANTIDAD NO OK</td>
							<td width="3%">&nbsp;</td>
						</tr>
				</table>
				<div id="lineaResultadoAW">
					<iframe width="100%" height="250" id="frame_lineas" name="frame_lineas" frameborder="0">
						<ilayer width="100%" height="250" id="frame_lineas" name="frame_lineas"></ilayer>
					</iframe>			
					<iframe id="frame_datos" name="frame_datos" width="0" height="0" frameborder="0">
					<ilayer width="0" height="0" id="frame_datos" name="frame_datos"></ilayer>
					</iframe>
				</div>					
			  </div>
<!--			  <div id="frmBusqueda" style="display:none">
			<table width="25%" border=0 align="right" cellpadding=3 cellspacing=0 class="fuente8">
			  <tr>
			    <td width="27%" class="busqueda">Sub-total</td>
				<td width="73%" align="right"><div align="center">
			      <input class="cajaTotales" name="baseimponible" type="text" id="baseimponible" size="12" align="right" value="" readonly> 
		        </div></td>
			  </tr>
			  <tr>
				<td class="busqueda">IVA</td>
				<td align="right"><div align="center">
			      <input class="cajaTotales" name="baseimpuestos" type="text" id="baseimpuestos" size="12" align="right" value=" readonly> 
		        </div></td>
			  </tr>
			  <tr>
				<td class="busqueda">Precio Total</td>
				<td align="right"><div align="center">
			      <input class="cajaTotales" name="preciototal" type="text" id="preciototal" size="12" align="right" value="" readonly> 
		        </div></td>
			  </tr>
		</table>
			  </div>-->
				<div id="botonBusquedaAW">					
				  <div align="center">
				   <img src="../img/botonaceptar.jpg" width="85" height="22" onClick="validar_cabecera()" border="1" onMouseOver="style.cursor=cursor">
					<img src="../img/botoncancelar.jpg" width="85" height="22" onClick="cancelar()" border="1" onMouseOver="style.cursor=cursor">
				    <input id="codfamilia" name="codfamilia" value="<? echo $codfamilia?>" type="hidden">
				    <input id="codalbarantmp" name="codalbarantmp" value="<? echo $codalbarantmp?>" type="hidden">
					<input id="modif" name="modif" value="0" type="hidden">				    
			      </div>
				</div>

			  </form>
			 </div>
		  </div>
		</div>
	</body>
</html>
