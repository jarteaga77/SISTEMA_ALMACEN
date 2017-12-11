<?php
include ("../conectar.php");
include ("../security.php");
error_reporting (0);

$cadena_busqueda=$_GET["cadena_busqueda"];

if (!isset($cadena_busqueda)) { $cadena_busqueda=""; } else { $cadena_busqueda=str_replace("",",",$cadena_busqueda); }

if ($cadena_busqueda<>"") {
	$array_cadena_busqueda=split("~",$cadena_busqueda);
	$codvehiculo=$array_cadena_busqueda[1];
	$id=$array_cadena_busqueda[2];
	$fechainicio=$array_cadena_busqueda[3];
	$fechafin=$array_cadena_busqueda[4];
} else {
	$codvehiculo="";
	$id="";
	//$numalbaran="";
	//$cboEstados="";
	$fechainicio="";
	$fechafin="";
}

?>
<html>
	<head>
		<title>Guia Hoja de Mantenimiento</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
		<link href="../calendario/calendar-blue.css" rel="stylesheet" type="text/css">
		<script type="text/JavaScript" language="javascript" src="../calendario/calendar.js"></script>
		<script type="text/JavaScript" language="javascript" src="../calendario/lang/calendar-sp.js"></script>
		<script type="text/JavaScript" language="javascript" src="../calendario/calendar-setup.js"></script>
		<script language="javascript">
		
		function inicio() {
			document.getElementById("form_busqueda").submit();
		}
		
		function nuevo_albaran() {
			location.href="nuevo_albaran.php";
		}
		
		function buscar() {
			var cadena;
			cadena=hacer_cadena_busqueda();
			document.getElementById("cadena_busqueda").value=cadena;
			if (document.getElementById("iniciopagina").value=="") {
				document.getElementById("iniciopagina").value=1;
			} else {
				document.getElementById("iniciopagina").value=document.getElementById("paginas").value;
			}
			document.getElementById("form_busqueda").submit();
		}
		
		function paginar() {
			document.getElementById("iniciopagina").value=document.getElementById("paginas").value;
			document.getElementById("form_busqueda").submit();
		}
		
		function hacer_cadena_busqueda() {
			var vehiculos=document.getElementById("cbovehi").value;
			var id=document.getElementById("id").value;
					
			//var cboEstados=document.getElementById("cboEstados").value;
			var fechainicio=document.getElementById("fechainicio").value;
			var fechafin=document.getElementById("fechafin").value;
			var cadena="";
			cadena="~"+vehiculos+"~"+id+"~"+fechainicio+"~"+fechafin+"~";
			return cadena;
			}
		
		var cursor;
		if (document.all) {
		// Está utilizando EXPLORER
		cursor='hand';
		} else {
		// Está utilizando MOZILLA/NETSCAPE
		cursor='pointer';
		}
		
		function limpiar() {
			document.getElementById("form_busqueda").reset();
		}
		
		function abreVentana(){
			miPopup = window.open("ventana_clientes.php","miwin","width=700,height=380,scrollbars=yes");
			miPopup.focus();
		}
		
		function validarcliente(){
			var codigo=document.getElementById("codcliente").value;
			miPopup = window.open("comprobarcliente_ini.php?codcliente="+codigo,"frame_datos","width=700,height=80,scrollbars=yes");
		}	

		</script>
	</head>
	<body onLoad="inicio()">
		<div id="pagina">
			<div id="zonaContenido">
				<div align="center">
				<div id="tituloForm" class="header">Buscar Hoja de Mantenimiento </div>
				<div id="frmBusqueda">
				<form id="form_busqueda" name="form_busqueda" method="post" action="rejilla.php" target="frame_rejilla">
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>					
						<tr>
								<?php
						
					  	$query_vehiculos="SELECT ve.id_vehiculo, CONCAT(ma.marca,' - ',li.name_linea,' - ', ' Placa: ', ve.placa_equipo)AS nom FROM linea li JOIN marca_vehiculo ma ON li.marca_vehiculo_id_marca=ma.id_marca JOIN vehiculos_equipos ve ON ve.Linea_idLinea=li.idLinea ORDER BY nom ASC";
						$res_vehi=mysql_query($query_vehiculos);
						$contador=0;
					  ?>
						<tr>
							<td width="11%">Vehiculos</td>
						  <td colspan="2"><select id="cbovehi" name="cbovehi" class="comboGrande">
                            <option value="0">Seleccione el Vehiculo </option>
                            <?php
								while ($contador < mysql_num_rows($res_vehi)) { 
									if ($f==mysql_result($res_vehi,$contador,"ve.id_vehiculo")) {?>
                            <option value="<?php echo mysql_result($res_vehi,$contador,"ve.id_vehiculo")?>" selected="selected"><?php echo mysql_result($res_vehi,$contador,"nom")?></option>
                            <? } else { ?>
                            <option value="<?php echo mysql_result($res_vehi,$contador,"ve.id_vehiculo")?>"><?php echo mysql_result($res_vehi,$contador,"nom")?></option>
                            <? } 
									$contador++;
								} ?>
                          </select></td>
					    </tr>
						<tr>
						  <td>Num. Hoja de Mto.</td>
						  <td><input id="id" type="text" class="cajaPequena" NAME="id" maxlength="15" value="<? echo $numalbaran?>"></td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
					  </tr>
						
					  <tr>
						  <td>Fecha de inicio</td>
						  <td><input id="fechainicio" type="text" class="cajaPequena" NAME="fechainicio" maxlength="10" value="<? echo $fechainicio?>" readonly><img src="../img/calendario.png" name="Image1" id="Image1" width="16" height="16" border="0" onMouseOver="this.style.cursor='pointer'" title="Calendario">
        <script type="text/javascript">
					Calendar.setup(
					  {
					inputField : "fechainicio",
					ifFormat   : "%d/%m/%Y",
					button     : "Image1"
					  }
					);
		</script>	</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
					  </tr>
						<tr>
						  <td>Fecha de fin</td>
						  <td><input id="fechafin" type="text" class="cajaPequena" NAME="fechafin" maxlength="10" value="<? echo $fechafin?>" readonly><img src="../img/calendario.png" name="Image2" id="Image2" width="16" height="16" border="0" onMouseOver="this.style.cursor='pointer'" title="Calendario2">
        <script type="text/javascript">
					Calendar.setup(
					  {
					inputField : "fechafin",
					ifFormat   : "%d/%m/%Y",
					button     : "Image2"
					  }
					);
		</script></td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
					  </tr>
					</table>
			  </div>
			 	<div id="botonBusqueda"><img src="../img/botonbuscar.jpg" width="69" height="22" border="1" onClick="buscar()" onMouseOver="style.cursor=cursor">
			 	  <img src="../img/botonlimpiar.jpg" width="69" height="22" border="1" onClick="limpiar()" onMouseOver="style.cursor=cursor">
					 <img src="../img/botonnuevoalbaran.jpg" width="106" height="22" border="1" onClick="nuevo_albaran()" onMouseOver="style.cursor=cursor">
				</div>
			  <div id="lineaResultado">
			  <table class="fuente8" width="80%" cellspacing=0 cellpadding=3 border=0>
			  	<tr>
				<td width="50%" align="left">N de Hoja de Mto. encontradas <input id="filas" type="text" class="cajaPequena" NAME="filas" maxlength="5" readonly></td>
				<td width="50%" align="right">Mostrados <select name="paginas" id="paginas" onChange="paginar()">
		          </select></td>
			  </table>
				</div>
				<div id="cabeceraResultado" class="header">
                                    Relaci&oacute;n de Hoja de Mto. </div>
				<div id="frmResultado">
				<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">
						<tr class="cabeceraTabla">
							<td width="8%">ITEM</td>
							<td width="8%">N. Hoja MTO.</td>
							<td width="29%">Vehiculo </td>							
							<td width="10%">FECHA</td>
							<td width="5%">&nbsp;</td>
							<td width="5%">&nbsp;</td>
							<td width="5%">&nbsp;</td>
							<td width="5%">&nbsp;</td>
							<td width="5%">&nbsp;</td>
						</tr>
				</table>
				</div>
				<input type="hidden" id="iniciopagina" name="iniciopagina">
				<input type="hidden" id="cadena_busqueda" name="cadena_busqueda">
			</form>
				<div id="lineaResultado_pagos">
					<iframe width="100%" height="250" id="frame_rejilla" name="frame_rejilla" frameborder="0">
						<ilayer width="100%" height="250" id="frame_rejilla" name="frame_rejilla"></ilayer>
					</iframe>
					<iframe id="frame_datos" name="frame_datos" width="0" height="0" frameborder="0">
					<ilayer width="0" height="0" id="frame_datos" name="frame_datos"></ilayer>
					</iframe>
				</div>
			</div>
		  </div>			
		</div>
	</body>
</html>
