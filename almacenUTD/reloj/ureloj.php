<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html lang="es"> 

<?php 
include ("../conectar.php");
include ("../security.php");
?> 

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <title>Reloj digital</title>
 <link rel="stylesheet"    type= "text/css"  href="../960gs/code/css/reset.css" />
 <link rel="stylesheet"    type= "text/css"  href="../960gs/code/css/text.css" />
 <link rel="stylesheet"    type= "text/css"  href="../960gs/code/css/960.css" />
 <link rel="stylesheet"    type= "text/css"  />
 
<style type="text/css">
BODY{
   background-color:#FFFFFF;
   color: #000000;
   font-family: verdana, arial, helvetica;
}

p{
   border: 1px solid #999;
   padding: 5px;
   margin: 0px;
}
#cabecera{
   background-color: #00FF66;
   background-image:url(imagenes/header2.jpg)
}
#cabecera01{
   background-color: #ccffcc;
}
#izq{
   background-color: #e0e0ff;
}
#izq1{
   background-color: #ccccff;
}

#izq3{
   background-color: #ccccff;
}

#pie{
   background-color: #ff8800;
}
#icono1{
   background-color: #CCCCCC;
}
</style> 

<script type="text/javascript">

// FECHA
function MostrarFechaActual()    {
var nombre_dia = new Array("domingo", "lunes", "martes", "miércoles", "jueves", "viernes", "sábado")
var nombre_mes = new Array("enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre")

var hoy_es = new Date()
dia_mes = hoy_es.getDate()
dia_semana = hoy_es.getDay()
mes = hoy_es.getMonth() + 1
anyo = hoy_es.getYear()

if (anyo < 100) anyo = '19' + anyo
else if ( ( anyo > 100 ) && ( anyo < 999 ) ) { var cadena_anyo = new String(anyo) ; anyo = '20' + cadena_anyo.substring(1,3)    }

document.write(nombre_dia[dia_semana] + ",<br> " + dia_mes + " de " + nombre_mes[mes - 1] + " de " + anyo)    }

//  RELOJ 24 HORAS
var Reloj24H = null
var RelojEnMarcha = false

function DetenerReloj24 () {if(RelojEnMarcha)    clearTimeout(Reloj24H); RelojEnMarcha = false }

function MostrarHoraActual() {
   	var ahora = new Date()
   	var hora = ahora.getHours()
   	var minuto = ahora.getMinutes()
   	var segundo = ahora.getSeconds()
   	var HHMMSS
       
if (hora < 10) {HHMMSS = "0" + hora} else {HHMMSS = " " + hora};
if (minuto < 10) {HHMMSS += ":0" + minuto} else {HHMMSS += ":" + minuto};
if (segundo < 10) {HHMMSS += ":0" + segundo} else {HHMMSS += ":" + segundo}
        
document.Reloj24H.digitos.value = HHMMSS;
Reloj24H = setTimeout("MostrarHoraActual()",1000)
RelojEnMarcha = true }

function IniciarReloj24() {
 	DetenerReloj24()
 	MostrarHoraActual() }
// final -->
</script>

 </head>

  <body>
 
  <div class="container_12">
   
     <div id="cabecera" class="grid_12">
     <p> <img src="" width="480" height="57" alt="" />
	 <br /> 	 </p>
	 
	 </div>     
	 <div class="clear"></div>
   
     <div id="cabecera01" class="grid_12">
     <h6 align="left">  Reloj virtual</h6>
     </div>     
	 <div class="clear"></div>
   	 
	 <div class="grid_12"  id ="izq" >
     <div  class="grid_3 alpha"  id="izq">	  
	 </div>
	   
	 <div  class="grid_6"  id="izq3">
	  <body onload="IniciarReloj24()">
      <script type="text/javascript">MostrarFechaActual()</script>

      <form name="Reloj24H" action="">
      <input style="color:navy; text-align:center; font-size:38pt; font-weight:bold" type="text" size="18" name="digitos" value="  ">
      </form>
	  	
		
		</p> 
       </div>
	   
	<div  class = "grid_3  omega"   id="izq"> 
	</div>	  	  
    <div class= "clear"></div> 
    </div>

	<div  class="prefix_5 grid_7"  id= "pie" >
	    <?php
		    echo "UTDVVCC " ;
	    ?> 
	</div>
	<div  class="prefix_10 grid_2"  id= "icono1" >
	  <a href="../centralsalir.php"><img src="../img/botonaceptar.jpg" alt="Salir" width="69" height="25" border="1" onclick = "../central2.php" ondblclick="../central2.php" title="salir"   /></a></div>
	
	
	<div class = "clear"> </div>
  </div>
  <!-- end .container_12 -->  
  </body>
  </html>