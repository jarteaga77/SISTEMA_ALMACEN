<?php 
    /*  
  
    Este es un programa desarrollado bajo el concepto de Software Libre y Uds.,
	pueden modificarlo y redistribuirlo bajo los terminos de la GNU General 
	Public License como ha sido publicado por Free Software Foundation.
	ya sea bajo la Licencia version 2 o cualquier Licencia posterior.

    	
	Autores: Ignacio Albacete
			 Pedro Obregón Mejías
			 Rubén D. Mancera Morán
	
	Fecha Liberación del código: 15/10/2007
	Codeka 2007 -- Murcia	
	
	Este codigo ha sido modificado parcialmente por
	
	Fecha Liberación del código: 28/08/2010
	Grupo  CodeKa Mx --- Mexico , Chile
	                     Manuel Avalos
	                     Arturo Fertilio
						 Helio Trincado 	 
	
	*/
header ("Expires: Thu, 27 Mar 1980 23:59:00 GMT"); //la pagina expira en una fecha pasada
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
header ("Pragma: no-cache");

include ("../conectar.php");
error_reporting(0);

 ?>

<html>

	<head>

		<meta content="text/html; charset=UTF-8" http-equiv=Content-Type>
		<title>Principal</title>

		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">

		<link href="../calendario/calendar-blue.css" rel="stylesheet" type="text/css">

		<script type="text/JavaScript" language="javascript" src="../calendario/calendar.js"></script>

		<script type="text/JavaScript" language="javascript" src="../calendario/lang/calendar-sp.js"></script>

		<script type="text/JavaScript" language="javascript" src="../calendario/calendar-setup.js"></script>

		<script type="text/javascript" src="../funciones/validar.js"></script>

		<script language="javascript">

		

		function cancelar() {

			location.href="index.php";

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

			document.getElementById("areaplaca").value="";

			document.getElementById("areamodelo").value="";

			document.getElementById("areacc").value="";

			document.getElementById("motor").value="";
                        
                        document.getElementById("areachasis").value="";

			document.getElementById("areasoat").value="";

			document.getElementById("areatecno").value="";
                        
                        document.getElementById("arealicencia").value="";

			document.getElementById("fechatecno").value="";
                        
                        document.getElementById("fechasoat").value="";

			document.getElementById("aobservaciones").value="";

			document.getElementById("foto").value="";

			document.formulario.Acbovehi.options[0].selected = true;

			document.formulario.Acbolinea.options[0].selected = true;

			document.formulario.Acbocombus.options[0].selected = true;
                        
                        document.formulario.Acboitems.options[0].selected = true;

    document.formulario.AcboLinea.options[0].selected = true;
			

		

		}

		</script>

	</head>

	<body>

		<div id="pagina">

			<div id="zonaContenido">

				<div align="center">

				<div id="tituloForm" class="header">INSERTAR VEHICULO - EQUIPOS </div>

				<div id="frmBusqueda">

                                    <form id="formulario" name="formulario" method="post" action="../vehiculos/guardar_vehiculo.php" enctype="multipart/form-data">

				<input id="accion" name="accion" value="alta" type="hidden">

					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>

						<tr>

						<td width="15%">Placa de Vehiculo</td>

					      <td width="30%"><input name="areaplaca" id="areaplaca" value="" maxlength="6" class="cajaGrande" type="text"></td>
                                           
                                              	<td width="55%" rowspan="15" align="left" valign="top"><ul id="lista-errores"></ul></td>

                                              
                                                </tr>
                                              
                                              <tr>
                                              
                                              <td width="15%">Modelo</td>
					      <td width="30%"><input name="areamodelo" id="areamodelo" value="" maxlength="30" class="cajaGrande" type="text"></td>
                                              </tr>
                                              
                                              <tr>
                                              
                                              <td width="15%">C.C</td>

					      <td width="30%"><input name="areacc" id="areacc" value="" maxlength="11" class="cajaGrande" type="text"></td>
                                              </tr>
                                              
                                              <tr>
                                              
                                               <td width="15%">N&uacute;mero de Chasis</td>

					      <td width="30%"><input name="areachasis" id="areachasis" value="" maxlength="20" class="cajaGrande" type="text"></td>
                                             
                                              </tr>
                                              
                                              <tr>
                                               <td width="15%">N&uacute;mero de Motor</td>

					      <td width="30%"><input name="areamotor" id="areamotor" value="" maxlength="20" class="cajaGrande" type="text"></td>
                                               </tr>
                                               
                                               
                                               <td width="15%">Licencia de Transito</td>

					      <td width="30%"><input name="arealicencia" id="arealicencia" value="" maxlength="11" class="cajaGrande" type="text"></td>
                       
                                              
                                              	<?php

					  	$query_tipo="SELECT * FROM tipo_vehi_equi ORDER BY nom_tipo ASC ";

						$res_tipo=mysql_query($query_tipo);

						$contador=0;

					  ?>
                                              
                        <tr>

							<td width="17%">Tipo de Vehiculo</td>

							<td><select id="Acbovehi" name="Acbovehi" class="comboGrande">

							

								<option value="0">Seleccione el Tipo de Vehiculo</option>

								<?php

								while ($contador < mysql_num_rows($res_tipo)) { ?>

								<option value="<?php echo  mysql_result($res_tipo,$contador,"id_tipo_vehi_equi")?>"><?php echo mysql_result($res_tipo,$contador,"nom_tipo")?></option>

								<? $contador++;

								} ?>				

								</select>							</td>

				        </tr>
                                              
                                              
                                              

						</tr>

						<?php

					  	$query_lineas="SELECT li.idLinea, CONCAT(ma.marca,'-',li.name_linea)AS nom FROM linea li JOIN marca_vehiculo ma ON li.marca_vehiculo_id_marca=ma.id_marca ";

						$res_linea=mysql_query($query_lineas);

						$contador=0;

					  ?>

						<tr>

							<td width="17%">Linea</td>

							<td><select id="AcboLinea" name="AcboLinea" class="comboGrande">

							

								<option value="0">Seleccione la Linea</option>

								<?php

								while ($contador < mysql_num_rows($res_linea)) { ?>

								<option value="<?php echo mysql_result($res_linea,$contador,"idLinea")?>"><?php echo mysql_result($res_linea,$contador,"nom")?></option>

								<? $contador++;

								} ?>				

								</select>							</td>

				        </tr>
                                        
                                        
                                        <?php

					  	$query_combustible="SELECT * FROM tipo_combustible ";

						$res_combustible=mysql_query($query_combustible);

						$contador=0;

					  ?>
                                        
                                        
                                        
                                        	<tr>

							<td width="17%">Tipo de Combustible</td>

							<td><select id="AcboCombus" name="AcboCombus" class="comboGrande">

							

								<option value="0">Seleccione el Combustible</option>

								<?php

								while ($contador < mysql_num_rows($res_combustible)) { ?>

								<option value="<?php echo mysql_result($res_combustible,$contador,"idTipo_Combustible")?>"><?php echo mysql_result($res_combustible,$contador,"name_combustible")?></option>

								<? $contador++;

								} ?>				

								</select>
                                                        </td>

				        </tr>
                                        
                                        
                                        		    
                                        <?php

					  	$query_item="SELECT * FROM item_ccostos WHERE id_ccostos=4 ";

						$res_item=mysql_query($query_item);

						$contador=0;

					  ?>
                                        
                                        
                                        
                                        	<tr>

							<td width="17%">&Aacute;rea de Pertenencia</td>

							
                                                            <td><select id="AcboItems" name="AcboItems" class="comboGrande">

							
								<option value="0">Seleccione &Aacute;rea de Pertenencia</option>

								<?php

								while ($contador < mysql_num_rows($res_item)) { ?>

								<option value="<?php echo mysql_result($res_item,$contador,"id_item_ccostos")?>"><?php echo mysql_result($res_item,$contador,"nombre_item_ccostos")?></option>

								<? $contador++;

								} ?>				

								</select>
                                                        </td>

				        </tr>
                
                                        
                                        
                                                   <tr>

						<td width="15%">SOAT</td>

					      <td width="30%"><input name="areasoat" id="areasoat" value="" maxlength="100" class="cajaGrande" type="text"></td>
                                              </tr>
                                        

						<tr>

							<td>Fecha de Vencimiento del SOAT </td>

							<td><input NAME="fechasoat" type="text" class="cajaPequena" id="fechasoat" size="10" maxlength="10" readonly> <img src="../img/calendario.png" name="Image1" id="Image1" width="16" height="16" border="0" id="Image1" onMouseOver="this.style.cursor='pointer'">

        <script type="text/javascript">

					Calendar.setup(

					  {

					inputField : "fechasoat",

					ifFormat   : "%Y-%m-%d",

					button     : "Image1"

					  }

					);

		</script></td>

					    </tr>
                                        
                                        
                                        <tr>

						<td width="15%">N&uacute;mero de la Tecnomec&aacute;nica</td>

					      <td width="30%"><input name="areatecno" id="areatecno" value="" maxlength="20" class="cajaGrande" type="text"></td>
                                              </tr>
                                        

						<tr>

							<td>Fecha de Vencimiento de la Tecnomec&aacute;nica  </td>

							<td><input NAME="fechatecno" type="text" class="cajaPequena" id="fechatecno" size="10" maxlength="10" readonly> <img src="../img/calendario.png" name="Image2" id="Image2" width="16" height="16" border="0" id="Image2" onMouseOver="this.style.cursor='pointer'">

        <script type="text/javascript">

					Calendar.setup(

					  {

					inputField : "fechatecno",

					ifFormat   : "%Y-%m-%d",

					button     : "Image2"

					  }

					);

		</script></td>

			
                
                

					  	 <tr>

							<td width="17%">Observaciones</td>

						    <td><textarea name="aobservaciones" cols="41" rows="2" id="aobservaciones" class="areaTexto"></textarea></td>

				        </tr>

						<tr>

						
					  <tr>

						  <td>Imagen [Formato jpg] [200x200]</td>

						  <td><input type="file" name="foto" id="foto" class="cajaMedia" accept="image/jpg" /></td>

				      </tr>

					</table>

			  </div>

				<div id="botonBusqueda">

				<img src="../img/botonaceptar.jpg" width="85" height="22" onClick="validar(formulario,true)" border="1" onMouseOver="style.cursor=cursor">

					<img src="../img/botonlimpiar.jpg" width="69" height="22" onClick="limpiar()" border="1" onMouseOver="style.cursor=cursor">

					<img src="../img/botoncancelar.jpg" width="85" height="22" onClick="cancelar()" border="1" onMouseOver="style.cursor=cursor">

					<input type="hidden" name="id" id="id" value="">					

			  </div>

			  </form>	

			 </div>			

		  </div>

		</div>

	   
	</body>

</html>
