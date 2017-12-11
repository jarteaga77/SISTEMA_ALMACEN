<?php 
    /*  
  
    Este es un programa desarrollado bajo el concepto de Software Libre y Uds.,
	pueden modificarlo y redistribuirlo bajo los terminos de la GNU General 
	Public License como ha sido publicado por Free Software Foundation;
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

			document.getElementById("referencia").value="";

			document.getElementById("descripcion").value="";

			document.getElementById("descripcion_corta").value="";

			document.getElementById("stock_minimo").value="";

			document.getElementById("stock").value="";

			document.getElementById("datos").value="";

			document.getElementById("fecha").value="";

	document.getElementById("fechaven").value="";
			document.getElementById("unidades_caja").value="";

			document.getElementById("observaciones").value="";

			document.getElementById("precio_compra").value="";

			document.getElementById("precio_almacen").value="";

			document.getElementById("precio_tienda").value="";

			document.getElementById("precio_iva").value="";

			document.getElementById("foto").value="";

			document.formulario.cboFamilias.options[0].selected = true;
                        
                  	document.formulario.cboImpuestos.options[0].selected = true;

			document.formulario.cboProveedores1.options[0].selected = true;

			document.formulario.cboProveedores2.options[0].selected = true;

			document.formulario.cboUbicacion.options[0].selected = true;

			document.formulario.cboEmbalaje.options[0].selected = true;

			document.formulario.Aaviso_minimo.options[0].selected = true;

			document.formulario.Aprecio_ticket.options[0].selected = true;

			document.formulario.Amodif_descrip.options[0].selected = true;
                        
                        document.formulario.cbolinea.options[0].selected = true;

		}

		</script>

	</head>

	<body>

		<div id="pagina">

			<div id="zonaContenido">

				<div align="center">

				<div id="tituloForm" class="header">INSERTAR ARTICULO </div>

				<div id="frmBusqueda">

				<form id="formulario" name="formulario" method="post" action="../articulos/guardar_articulo.php" enctype="multipart/form-data">

				<input id="accion" name="accion" value="alta" type="hidden">

					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>

						<tr>

						<td width="15%">Referencia</td>

					      <td width="30%"><input name="Areferencia" id="referencia" value="" maxlength="20" class="cajaGrande" type="text"></td>

				          <td width="55%" rowspan="15" align="left" valign="top"><ul id="lista-errores"></ul></td>

						</tr>

						<?php

					  	$query_familias="SELECT * FROM familias WHERE borrado=0 ORDER BY nombre ASC";

						$res_familias=mysql_query($query_familias);

						$contador=0;

					  ?>

						<tr>

							<td width="17%">Familia</td>

							<td><select id="cboFamilias" name="AcboFamilias" class="comboGrande">

							

								<option value="0">Seleccione una familia</option>

								<?php

								while ($contador < mysql_num_rows($res_familias)) { ?>

								<option value="<?php echo mysql_result($res_familias,$contador,"codfamilia")?>"><?php echo mysql_result($res_familias,$contador,"nombre")?></option>

								<? $contador++;

								} ?>				

								</select>							</td>

				        </tr>

						<tr>

							

						    <td  width="17%">Descripci&oacute;n</td>
									<td><textarea name="Adescripcion" cols="41" rows="2" id="descripcion" class="areaTexto"></textarea></td>;
						</tr>

						<?php

					  	$query_impuesto="SELECT codimpuesto,valor FROM impuestos WHERE borrado=0 ORDER BY nombre ASC";

						$res_impuesto=mysql_query($query_impuesto);

						$contador=0;

					  ?>

						<tr>

							<td width="17%">Impuesto</td>

							<td><select id="cboImpuestos" name="AcboImpuestos" class="comboMedio">

							

								<option value="0">Seleccione un impuesto</option>

								<?php

								while ($contador < mysql_num_rows($res_impuesto)) { ?>

								<option value="<?php echo mysql_result($res_impuesto,$contador,"valor")?>"><?php echo mysql_result($res_impuesto,$contador,"valor")?></option>

								<? $contador++;

								} ?>				

								</select> %							</td>

				        </tr>

						<?php

					  	$query_proveedores="SELECT codproveedor,nombre,nif FROM proveedores WHERE borrado=0 ORDER BY nombre ASC";

						$res_proveedores=mysql_query($query_proveedores);

						$contador=0;

					  ?>

						<tr>

							<td>Proveedor 1</td>

							<td><select id="cboProveedores1" name="acboProveedores1" class="comboGrande">

							<option value="0">Todos los proveedores</option>

								<?php

								while ($contador < mysql_num_rows($res_proveedores)) { 

									if ( mysql_result($res_proveedores,$contador,"codproveedor") == $proveedor) { ?>

								<option value="<?php echo mysql_result($res_proveedores,$contador,"codproveedor")?>" selected><?php echo mysql_result($res_proveedores,$contador,"nif")?> -- <?php echo mysql_result($res_proveedores,$contador,"nombre")?></option>

								<? } else { ?> 

								<option value="<?php echo mysql_result($res_proveedores,$contador,"codproveedor")?>"><?php echo mysql_result($res_proveedores,$contador,"nif")?> -- <?php echo mysql_result($res_proveedores,$contador,"nombre")?></option>

								<? }

								$contador++;

								} ?>				

								</select>							</td>

					    </tr>

					<?php

					  	$query_proveedores="SELECT codproveedor,nombre,nif FROM proveedores WHERE borrado=0 ORDER BY nombre ASC";

						$res_proveedores=mysql_query($query_proveedores);

						$contador=0;

					  ?>

						<tr>

							<td>Proveedor 2</td>

							<td><select id="cboProveedores2" name="acboProveedores2" class="comboGrande">

							<option value="0">Todos los proveedores</option>

								<?php

								while ($contador < mysql_num_rows($res_proveedores)) { 

									if ( mysql_result($res_proveedores,$contador,"codproveedor") == $proveedor) { ?>

								<option value="<?php echo mysql_result($res_proveedores,$contador,"codproveedor")?>" selected><?php echo mysql_result($res_proveedores,$contador,"nif")?> -- <?php echo mysql_result($res_proveedores,$contador,"nombre")?></option>

								<? } else { ?> 

								<option value="<?php echo mysql_result($res_proveedores,$contador,"codproveedor")?>"><?php echo mysql_result($res_proveedores,$contador,"nif")?> -- <?php echo mysql_result($res_proveedores,$contador,"nombre")?></option>

								<? }

								$contador++;

								} ?>				

								</select>							</td>

					    </tr>

						<tr>

						  <td>Descripci&oacute;n corta</td>

						  <td><input NAME="Adescripcion_corta" id="descripcion_corta" type="text" class="cajaGrande"  maxlength="30"></td>

				      </tr>

					  <?php

					  	$query_ubicacion="SELECT codubicacion,nombre FROM ubicaciones WHERE borrado=0 ORDER BY nombre ASC";

						$res_ubicacion=mysql_query($query_ubicacion);

						$contador=0;
						$contador2=0;

					  ?>

						<tr>

							<td>Ubicaci&oacute;n</td>

							<td><select id="cboUbicacion" name="AcboUbicacion" class="comboGrande">

							<option value="0">Todas las ubicaciones</option>

								<?php

								while ($contador < mysql_num_rows($res_ubicacion)) { 

									if ( mysql_result($res_ubicacion,$contador,"codubicacion") == $ubicacion) { ?>

								<option value="<?php echo mysql_result($res_ubicacion,$contador,"codubicacion")?>" selected><?php echo mysql_result($res_ubicacion,$contador,"nombre")?></option>

								<? } else { ?> 

								<option value="<?php echo mysql_result($res_ubicacion,$contador,"codubicacion")?>"><?php echo mysql_result($res_ubicacion,$contador,"nombre")?></option>

								<? }

								$contador++;

								} ?>				

								</select>							</td>

					    </tr>

<tr>

							<td>2da. Ubicaci&oacute;n</td>

							<td><select id="cboUbicacion2" name="AcboUbicacion2" class="comboGrande">

							<option value="0">Todas las ubicaciones</option>

								<?php

								while ($contador2 < mysql_num_rows($res_ubicacion)) { 

									if ( mysql_result($res_ubicacion,$contador2,"codubicacion") == $ubicacion) { ?>

								<option value="<?php echo mysql_result($res_ubicacion,$contador2,"codubicacion")?>" selected><?php echo mysql_result($res_ubicacion,$contador2,"nombre")?></option>

								<? } else { ?> 

								<option value="<?php echo mysql_result($res_ubicacion,$contador2,"codubicacion")?>"><?php echo mysql_result($res_ubicacion,$contador2,"nombre")?></option>

								<? }

								$contador2++;

								} ?>				

			</select>							
            
      </td>

				      </tr>

						<tr>

						<?php /*?> <td>Stock</td>

						  <td><input NAME="nstock" type="text" class="cajaPequena" id="stock" size="10" maxlength="10"> unidades</td>

				      </tr><?php */?>

					  	<tr>

						 <td>Stock m&iacute;nimo</td>

						  <td><input NAME="nstock_minimo" type="text" class="cajaPequena" id="stock_minimo" size="8" maxlength="8"> unidades</td>

				      </tr>

					  	<tr>

						 <td>Aviso m&iacute;nimo</td>

						  <td><select name="aaviso_minimo" id="aviso_minimo" class="comboPequeno">

						  <option value="0" selected="selected">No</option>

						  <option value="1">Si</option>

						  </select></td>

				      </tr>

					  <tr>

							<td width="17%">Aplicaci&oacute;n del Producto</td>

						    <td><textarea name="adatos" cols="41" rows="2" id="datos" class="areaTexto"></textarea></td>

			          </tr>

						<tr>

							<td>Fecha de Vencimiento</td>

							<td><input NAME="fechaven" type="text" class="cajaPequena" id="fechaven" size="10" maxlength="10" readonly> <img src="../img/calendario.png" name="Image2" id="Image2" width="16" height="16" border="0" onMouseOver="this.style.cursor='pointer'">

        <script type="text/javascript">

					Calendar.setup(

					  {

					inputField : "fechaven",

					ifFormat   : "%Y-%m-%d",

					button     : "Image2"

					  }

					);

		</script></td>

					    </tr>
                        
                        <tr>

						 <td>Aviso de Vencimiento</td>

						  <td><select name="aviso_venc" id="aviso_venc" class="comboPequeno">

						  <option value="0" selected="selected">No</option>

						  <option value="1">Si</option>

						  </select></td>

				      </tr>

                        
                        
                        <tr>

							<td>Fecha de Ingreso</td>

							<td><input NAME="fecha" type="text" class="cajaPequena" id="fecha" size="10" maxlength="10" readonly> <img src="../img/calendario.png" name="Image1" id="Image1" width="16" height="16" border="0" onMouseOver="this.style.cursor='pointer'">

        <script type="text/javascript">

					Calendar.setup(

					  {

					inputField : "fecha",

					ifFormat   : "%Y-%m-%d",

					button     : "Image1"

					  }

					);

		</script></td>

					    </tr>
                        

						 <?php

					  	$query_embalaje="SELECT codembalaje,nombre FROM embalajes WHERE borrado=0 ORDER BY nombre ASC";

						$res_embalaje=mysql_query($query_embalaje);

						$contador=0;

					  ?>

						<tr>

							<td>Unidad de Medida</td>

							<td><select id="cboEmbalaje" name="AcboEmbalaje" class="comboGrande">

							<option value="0">Todos los embalajes</option>

								<?php

								while ($contador < mysql_num_rows($res_embalaje)) { 

									if ( mysql_result($res_embalaje,$contador,"codembalaje") == $embalaje) { ?>

								<option value="<?php echo mysql_result($res_embalaje,$contador,"codembalaje")?>" selected><?php echo mysql_result($res_embalaje,$contador,"nombre")?></option>

								<? } else { ?> 

								<option value="<?php echo mysql_result($res_embalaje,$contador,"codembalaje")?>"><?php echo mysql_result($res_embalaje,$contador,"nombre")?></option>

								<? }

								$contador++;

								} ?>				

								</select>							</td>

					    </tr>

						<tr>

						 <td>Unidades por caja</td>

						  <td><input NAME="nunidades_caja" type="text" class="cajaPequena" id="unidades_caja" size="10" maxlength="10"> unidades</td>

				      </tr>

					  <tr>

						 <td>Preguntar precio ticket</td>

						  <td><select name="aprecio_ticket" id="precio_ticket" class="comboPequeno">

						  <option value="0" selected="selected">No</option>

						  <option value="1">Si</option>

						  </select></td>

				      </tr>

					  <tr>

						 <td>Modificar descrip. en ticket</td>

						  <td><select name="amodif_descrip" id="modif_descrip" class="comboPequeno">

						  <option value="0" selected="selected">No</option>

						  <option value="1">Si</option>

						  </select></td>

				      </tr>

					  	 <tr>

							<td width="17%">Observaciones</td>

						    <td><textarea name="aobservaciones" cols="41" rows="2" id="observaciones" class="areaTexto"></textarea></td>

				        </tr>

						<tr>

						  <td>Precio de compra</td>

						  <td><input NAME="qprecio_compra" type="text" class="cajaPequena" id="precio_compra" size="10" maxlength="10"> <?php echo $simbolomoneda ?></td>

				      </tr>

					  	<tr>

						  <td>Precio de almac&eacute;n</td>

						  <td><input NAME="qprecio_almacen" type="text" class="cajaPequena" id="precio_almacen" size="10" maxlength="10"><?php echo $simbolomoneda ?></td>

				      </tr>

						<tr>

						  <td>Precio de tienda</td>

						  <td><input NAME="qprecio_tienda" type="text" class="cajaPequena" id="precio_tienda" size="10" maxlength="10"> <?php echo $simbolomoneda ?></td>

				      </tr>

<!--					  	<tr>

						  <td>Pvp</td>

						  <td><input NAME="qpvp" type="text" class="cajaPequena" id="pvp" size="10" maxlength="10"><?php echo $simbolomoneda ?></td>

			      </tr>
-->
					  <tr>

						  <td>Precio con iva</td>

						  <td><input NAME="qprecio_iva" type="text" class="cajaPequena" id="precio_iva" size="10" maxlength="10"> <?php echo $simbolomoneda ?></td>

				      </tr>
                                      
                                        <?php

					  	$query_linea="SELECT li.idLinea, CONCAT(ma.marca,'-',li.name_linea)AS nom FROM linea li JOIN marca_vehiculo ma ON li.marca_vehiculo_id_marca=ma.id_marca";

						$res_linea=mysql_query($query_linea);

						$contador=0;

					  ?>

						<tr>

							<td>Linea</td>

							<td><select id="cbolinea" name="AcLinea" class="comboGrande">

							<option value="0">Todas las Lineas</option>

								<?php

								while ($contador < mysql_num_rows($res_linea)) { 

									if ( mysql_result($res_linea,$contador,"idLinea") == $linea) { ?>

								<option value="<?php echo mysql_result($res_linea,$contador,"idLinea")?>" selected><?php echo mysql_result($res_linea,$contador,"nom")?></option>

								<? } else { ?> 

								<option value="<?php echo mysql_result($res_linea,$contador,"idLinea")?>"><?php echo mysql_result($res_linea,$contador,"nom")?></option>

								<? }

								$contador++;

								} ?>				

								</select>							</td>

					    </tr>
                                      
                                      
                                      
<tr>
						<td width="35%">Codigo de Barras</td>
						<td><input NAME="barras" type="text" id="barras" size="10" Class="cajaMedia" maxlength="10" value="Automatico"></td></td>
					  </tr>
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
