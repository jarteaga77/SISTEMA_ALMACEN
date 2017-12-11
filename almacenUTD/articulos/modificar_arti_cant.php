<?php 
 
error_reporting(0);
include ("../conectar.php"); 
//include ("../funciones/fechas.php"); 
//include("../barcode/barcode.php");


$codarticulo=$_GET["codarticulo"];
$cadena_busqueda=$_GET["cadena_busqueda"];

$query="SELECT stock,referencia,descripcion,codarticulo FROM articulos WHERE codarticulo='$codarticulo'";
$rs_query=mysql_query($query);
//$codigobarras=mysql_result($rs_query,0,"codigobarras");
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
		
		function cancelar() {
			location.href="index.php?cadena_busqueda=<? echo $cadena_busqueda?>";
		}
		
		function limpiar() {
			
			document.getElementById("stock").value="";
			
		}
		
		function validar()
		{
			
			var avalidar=document.getElementById("stock").value;
			
			
				if (isNaN (avalidar)) {
				
				alert ("Solo se permiten Números");
				}
				 else {
									document.getElementById("formulario").submit();
				}
		}
		
		
		</script>
	</head>
	<body>
		<div id="pagina">
			<div id="zonaContenido">
				<div align="center">
    				<div id="tituloForm" class="header">MODIFICAR STOCK</div>
    				<div id="frmBusqueda">
                      
                      				<form id="formulario" name="formulario" method="post" action="guardar_articulo.php" enctype="multipart/form-data">
				<input id="accion" name="accion" value="modificar_cantidad" type="hidden">
				<input id="id" name="id" value="<?php echo $codarticulo?>" type="hidden">
				<input id="codarticulo" name="codarticulo" value="<?php echo $codarticulo?>" type="hidden">
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
						
                        
                          <tr>
						 <td>Cod. Articulo</td>
						  <td width="58%"><?php echo mysql_result($rs_query,0,"codarticulo")?></td>
				      </tr>
                        
                        
                        <tr>
						 <td>Referencia</td>
						  <td width="58%"><?php echo mysql_result($rs_query,0,"referencia")?></td>
				      </tr>
                      
                      
                        <tr>
						 <td>Descripción</td>
						  <td width="58%"><?php echo mysql_result($rs_query,0,"descripcion")?></td>
				      </tr>
                        
                        
						<tr>
						 <td>Stock</td>
						  <td colspan="2"><input NAME="nstock" type="text" class="cajaPequena" id="stock" size="10" maxlength="10" value="<?php echo mysql_result($rs_query,0,"stock")?>"> unidades</td>
				      </tr>
					  	
										  
					</table>
                      
                    </div> <!-- frmbusqueda> -->
                    <div id="botonBusqueda">
                      <img src="../img/botonaceptar.jpg" width="85" height="22" onClick="validar()" border="1" onMouseOver="style.cursor=cursor">
                      <img src="../img/botonlimpiar.jpg" width="69" height="22" onClick="limpiar()" border="1" onMouseOver="style.cursor=cursor">
                      <img src="../img/botoncancelar.jpg" width="85" height="22" onClick="cancelar()" border="1" onMouseOver="style.cursor=cursor">
                    </div> <!- botonBusqueda -->
                    </form>
			 </div>				
		  </div>
		</div>
	</body>
</html>