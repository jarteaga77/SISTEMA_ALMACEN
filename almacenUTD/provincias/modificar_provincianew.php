<?php include ("../conectar.php"); 

$codprovincia=$_GET["codprovincia"];

$query="SELECT * FROM provincias WHERE codprovincia='$codprovincia'";
$rs_query=mysql_query($query);

?>

<?xml version="1.0" encoding="utf-8"?>

<!DOCTYPE html
   PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" >

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<title>Principal</title>
		 <style type="text/css" xml:space="preserve">
BODY, P,TD{ font-family: Arial,Verdana,Helvetica, sans-serif; font-size: 10pt }
A{font-family: Arial,Verdana,Helvetica, sans-serif;}
B {	font-family : Arial, Helvetica, sans-serif;	font-size : 12px;	font-weight : bold;}
.error_strings{ font-family:Verdana; font-size:14px; color:#660000; background-color:#ff0;}
</style><script language="JavaScript" src="../funciones/gen_validatorv4.js"
    type="text/javascript" xml:space="preserve"></script>
		
		
		
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
		<script type="text/javascript" src="../funciones/validar.js"></script>
			
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
			document.getElementById("formulario").reset();
		}
		
		</script>
		<style type="text/css" xml:space="preserve">
BODY, P,TD{ font-family: Arial,Verdana,Helvetica, sans-serif; font-size: 10pt }
A{font-family: Arial,Verdana,Helvetica, sans-serif;}
B {	font-family : Arial, Helvetica, sans-serif;	font-size : 12px;	font-weight : bold;}
.error_strings{ font-family:Verdana; font-size:14px; color:#660000; background-color:#ff0;}
</style><script language="JavaScript" src="gen_validatorv4.js"
    type="text/javascript" xml:space="preserve"></script>
		
		
	</head>
	<body>
		<div id="pagina">
			<div id="zonaContenido">
				<div align="center">
				<div id="tituloForm" class="header">MODIFICAR PROVINCIA </div>
				<div id="frmBusqueda">
				<form id="formulario" name="formulario" method="post" action="guardar_provincia.php">
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
						<tr>
							<td>C&oacute;digo</td>
							<td><?php echo $codprovincia?></td>
<!--					
         	    <td width="42%" rowspan="2" align="left" valign="top"><ul id="lista-errores"></ul></td>
-->			
						</tr>
						<tr>
							<td width="15%">Nombre</td>
							<div id='formulario_Nombreprovincia_errorloc' class="error_strings"></div>
						    <td width="43%"><input name="nombreprovincia" type="text" class="cajaGrande" id="nombreprovincia" size="45" maxlength="45" value="<?php echo mysql_result($rs_query,0,"nombreprovincia")?>" /></td>
						</tr>
					</table>
			  </div>
				<div id="botonBusqueda">
					<img src="../img/botonaceptar.jpg" width="85" height="22" onclick="validar(formulario,true)" border="1" onmouseover="style.cursor=cursor">
					<img src="../img/botonlimpiar.jpg" width="69" height="22" onclick="limpiar()" border="1" onmouseover="style.cursor=cursor">
					<img src="../img/botoncancelar.jpg" width="85" height="22" onclick="cancelar()" border="1" onmouseover="style.cursor=cursor">
					<input id="accion" name="accion" value="modificar" type="hidden">
					<input id="id" name="Zid" value="<?php echo $codprovincia?>" type="hidden">
			  </div>
			  </form>
			  
			  
			 </div>
		  </div>
		</div>
		
	<script language="JavaScript" type="text/javascript"
    xml:space="preserve">//<![CDATA[
//You should create the validator only after the definition of the HTML form
  var frmvalidator  = new Validator("myform");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();

    frmvalidator.addValidation("nombreprovincia","req","Favor escribir nombre de la Provincia");
    frmvalidator.addValidation("nombreprovincia","maxlen=20",	"Longitud maxima 35 letras");

    
//]]></script>	
		
		
	</body>
</html>
