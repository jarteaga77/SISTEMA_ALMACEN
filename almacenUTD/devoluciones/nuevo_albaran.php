<?php 
include ("../conectar.php"); 
include("../security.php");


date_default_timezone_set('America/Bogota');

$level=$_SESSION['level'];

$fechahoy=date("Y-m-d");
$sel_albaran="INSERT INTO devotmp (coddevu,fecha) VALUE ('','$fechahoy')";
$rs_albaran=mysql_query($sel_albaran);
$codalbarantmp=mysql_insert_id();
?>
<html>
	<head>
		<title>Principal</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
		<link href="../calendario/calendar-blue.css" rel="stylesheet" type="text/css">
        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
		
		
		function comprobar(level)
		{
			var level=level;		
			if(level ==6  || level==8|| level==1 || level==2 || level==9 || level==3 || level==7)
			{
						document.getElementById("cbocerrar").disabled=false;
			}
	
				
		}
		
		
		function ventanaArticulos(){
			var codigo=document.getElementById("codcliente").value;
			if (codigo=="") {
				alert ("Debe introducir el ID centro de costos");
			} else {
				miPopup = window.open("ver_articulos.php","miwin","width=700,height=500,scrollbars=yes");
				miPopup.focus();
			}
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
			document.getElementById("nif").value="";
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
				if (document.getElementById("fecha").value=="") mensaje+="  - Fecha\n";
				if (mensaje!="") {
					alert("Atencion, se han detectado las siguientes incorrecciones:\n\n"+mensaje);
				} else {
					document.getElementById("formulario").submit();
				}
			}	
		
		function validar() 
			{
				var mensaje="";
				
				var enteroo=0;
		
				if (document.getElementById("codarticulo").value=="") mensaje="  - Referencia\n";
				if (document.getElementById("descripcion").value=="") mensaje+="  - Descripcion\n";
				//if (document.getElementById("precio").value=="") { 
//							mensaje+="  - Falta el precio\n"; 
//						} else {
//							if (isNaN(document.getElementById("precio").value)==true) {
//								mensaje+="  - El precio debe ser numerico\n";
//							}
//						}
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
//				if (document.getElementById("descuento").value=="") 
//						{ 
//						document.getElementById("descuento").value=0 
//						} else {
//							entero=parseInt(document.getElementById("descuento").value);
//							if (isNaN(entero)==true) {
//								mensaje+="  - El descuento debe ser numerico\n";
//							} else {
//								document.getElementById("descuento").value=entero;
//							}
//						} 
//				if (document.getElementById("importe").value=="") mensaje+="  - Falta el importe\n";
				
				if (mensaje!="") {
					alert("Atencion, se han detectado las siguientes incorrecciones:\n\n"+mensaje);
				} else {
//					document.getElementById("baseimponible").value=parseFloat(document.getElementById("baseimponible").value) + parseFloat(document.getElementById("importe").value);	
//					cambio_iva();
					document.getElementById("formulario_lineas").submit();
					document.getElementById("referencia").value="";
					document.getElementById("descripcion").value="";
					//document.getElementById("precio").value="";
					document.getElementById("cantidad").value=1;
					
					document.getElementById("cantNO").value=0;
//					document.getElementById("importe").value="";
//					document.getElementById("descuento").value=0;						
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
		
		var cursor;
		if (document.all) {
		// Está utilizando EXPLORER
		cursor='hand';
		} else {
		// Está utilizando MOZILLA/NETSCAPE
		cursor='pointer';
		}
		
		</script>
	</head>
	<body>
		<div id="pagina">
			<div id="zonaContenido">
				<div align="center">
				<div id="tituloForm_nf" class="header">CREAR GUIA DE DEVOLUCION</div>
                                <div id="zonaContenido_nf">
				<form id="formulario" name="formulario" method="post" action="guardar_albaran.php">
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
						<tr>
						<? $hoy=date("Y/m/d"); ?>
						
						<td width="6%">Fecha</td>
						<td width="7%"><input NAME="fecha" type="text" class="cajaPequena" id="fecha" size="10" maxlength="10" value="<? echo $hoy?>" readonly> <img src="../img/calendario.png" name="Image1" id="Image1" width="16" height="16" border="0" id="Image1" onMouseOver="this.style.cursor='pointer'">
                                        <script type="text/javascript">
					Calendar.setup(
					  {
					inputField : "fecha",
					ifFormat   : "%Y/%m/%d",
					button     : "Image1"
					  }
					);
                                       </script></td>
                                       
                                                    
                                                    
                                                <td width="15%">ID Centro Costos</td>
                                                <td colspan="3"><input NAME="codcliente" type="text" class="cajaPequena" id="codcliente" size="6" maxlength="5" onClick="limpiarcaja()">
					        <img src="../img/ver.png" onClick="abreVentana()" title="Buscar cliente" onMouseOver="style.cursor=cursor"> <img src="../img/cliente.png" width="16" height="16" onClick="validarcliente()" title="Validar cliente" onMouseOver="style.cursor=cursor"></td>					
						
						<td width="6%">Nombre</td>
						<td width="27%"><input NAME="nombre" type="text" class="cajaGrande" id="nombre" readonly></td>
<!--				            <td width="3%">RFC</td>
				            <td width="64%"><input NAME="nif" type="text" class="cajaMedia" id="nif" size="20" maxlength="15" readonly></td>-->
						
						
				            </tr>
                                            <tr>
                                            <td width="6%">Transporta</td>
						    <td width="5%"><input NAME="transporta" type="text" class="cajaMedia" id="transporta" size="30" maxlength="30"></td>
						
                                                <td width="6%">Recibe</td>
						    <td width="10%"><input NAME="recibe" type="text" class="cajaMedia" id="recibe" size="30" maxlength="30"></td>
                                            
                                             </tr>
                                                    <tr>
                                                    
                                                    <td width="6%">Entrega</td>
						    <td width="17%"><input NAME="entrega" type="text" class="cajaMedia" id="entrega" size="30" maxlength="30"></td>
                                               
                                                    
                                                   <td width="6%">Observaciones</td>
						    <td width="27%"><input NAME="observaciones" type="text" class="cajaGrande" id="observaciones" size="80" maxlength="100"></td>
						  </tr>
                          
                          <tr>
                          
                          <td width="17%">Cerrar Devolución</td>

							<td><select id="cbocerrar" name="cbocerrar" class="comboMedio"  disabled>

							

								<option value="0" >Cerrar Devolución</option><option value="1">SI</option><option value="2">NO</option>        
						  
                                        </select>
                                        </td>
                                        </tr>
   
                                    <?
 echo "<script>";
echo "comprobar($level);";
echo "</script>";                              
     ?>        
                          
                                        
                          </table>										
			  </div>
			  <input id="codalbarantmp" name="codalbarantmp" value="<? echo $codalbarantmp?>" type="hidden">
			  <input id="accion" name="accion" value="alta" type="hidden">
			  </form>
			  <br>
			  <div id="frmBusqueda4">
				<form id="formulario_lineas" name="formulario_lineas" method="post" action="frame_lineas.php" target="frame_lineas">
				<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
				  <tr>
					<td width="11%">Referencia</td>
					<td colspan="10"><input NAME="referencia" type="text" class="cajaMedia" id="referencia" size="15" maxlength="15" readonly> <img src="../img/ver.png" width="16" height="16" onClick="ventanaArticulos()" onMouseOver="style.cursor=cursor" title="Buscar articulos"></td>
				  </tr>
				  <tr>
					<td>Descripcion</td>
					<td width="2%"><input NAME="descripcion" type="text" class="cajaMedia" id="descripcion" size="30" maxlength="30" readonly></td>
					<td width="1%">Cantidad</td>
					<td width="5%"><input NAME="cantidad" type="text" class="cajaMinima" id="cantidad" size="10" maxlength="10" value="1" onChange="actualizar_importe()"></td>
                    
                    <td width="1%">Cantidad NO OK</td>
					<td width="5%"><input NAME="cantNO" type="text" class="cajaMinima" id="cantNO" size="10" maxlength="10" value="0"></td>
                    
                                         <td width="6%">Observaci&oacute;n</td>
                                        <td width="17%"><input NAME="obser" type="text" class="cajaGrande" id="obser" size="30" maxlength="100"></td>
                                                
					<td width="15%"><img src="../img/botonagregar.jpg" width="72" height="22" border="1" onClick="validar()" onMouseOver="style.cursor=cursor" title="Agregar articulo"></td>
				  </tr>
				</table>
				</div>
				<input name="codarticulo" value="<? echo $codarticulo?>" type="hidden" id="codarticulo">
				<br>
				<div id="frmBusqueda2z">
				<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">
						<tr class="cabeceraTabla">
							<td width="5%">ITEM</td>
							<td width="26%">REFERENCIA</td>
							<td width="35%">DESCRIPCION</td>
							<td width="8%">CANTIDAD</td>
                            <td width="8%">CANTIDAD NO OK</td>
							<td width="3%">&nbsp;</td>
						</tr>
				</table>
				<div id="lineaResultado2">
					<iframe width="100%" height="350" id="frame_lineas" name="frame_lineas" frameborder="0">
						<ilayer width="100%" height="250" id="frame_lineas" name="frame_lineas"></ilayer>
					</iframe>
				</div>					
			  </div>
<!--			  <div id="frmBusqueda" style="display:none">
			<table width="25%" border=0 align="right" cellpadding=3 cellspacing=0 class="fuente8">
			  <tr>
			    <td width="27%" class="busqueda">Sub-total</td>
				<td width="73%" align="right"><div align="center">//
			      <input class="cajaTotales" name="baseimponible" type="text" id="baseimponible" size="12" value=0 align="right" readonly> 
		        </div></td>
			  </tr>
			  <tr>
				<td class="busqueda">IVA</td>
				<td align="right"><div align="center">//
			      <input class="cajaTotales" name="baseimpuestos" type="text" id="baseimpuestos" size="12" align="right" value=0 readonly> 
		        </div></td>
			  </tr>
			  <tr>
				<td class="busqueda">Precio Total</td>
				<td align="right"><div align="center">//
			      <input class="cajaTotales" name="preciototal" type="text" id="preciototal" size="12" align="right" value=0 readonly> 
		        </div></td>
			  </tr>
		</table>
			  </div>-->
				<div id="botonBusqueda3_nf">					
				  <div align="center">
				    <img src="../img/botonaceptar.jpg" width="85" height="22" onClick="validar_cabecera()" border="1" onMouseOver="style.cursor=cursor">
					<img src="../img/botoncancelar.jpg" width="85" height="22" onClick="cancelar()" border="1" onMouseOver="style.cursor=cursor">
				    <input id="codfamilia" name="codfamilia" value="<? echo $codfamilia?>" type="hidden">
				    <input id="codalbarantmp" name="codalbarantmp" value="<? echo $codalbarantmp?>" type="hidden">				    
			      </div>
				</div>
			  		<iframe id="frame_datos" name="frame_datos" width="0" height="0" frameborder="0">
					<ilayer width="0" height="0" id="frame_datos" name="frame_datos"></ilayer>
					</iframe>
			  </form>
			 </div>
		  </div>
		</div>
	</body>
</html>
