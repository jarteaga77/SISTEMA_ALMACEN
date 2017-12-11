<?php
include ("../conectar.php");
?>

<html>
<head>
<title>Configuraciones</title>
<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
</head>
<body>
<div id="pagina">
<div id="zonaContenido">
<div align="center">
<div id="tituloForm" class="header">PANEL DE CONTROL</div>
<div id="frmBusqueda">
<form id="form_busqueda" name="form_busqueda" method="post" action="rejilla.php" target="frame_rejilla">
<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
<tr>
<td>Moneda</td>
<td>
      <select>
         <option value="1">US$ - Dolar</option>
         <option value="1">$ - Peso Chileno</option>
         <option value="1">E - Euro</option>
      </select>
</td>

</tr>
<tr>
     <td>Generar codigos de barra</td>
        <td><input type="checkbox"></td>
</tr>
<tr>
    <td>Valores con Decimales</td>
          <td><input type="text" size="5" value="2">decimales</td>
</tr>
 
 </table>
 
           <div id="botonBusqueda">
  <img src="../img/botonaceptar.jpg" width="69" height="22" border="1" onClick="buscar()" onMouseOver="style.cursor=cursor">
   
    </div>
   
    </form>
    </div>
    </div>
          </div>
        </div>
   	</body>
   </html>