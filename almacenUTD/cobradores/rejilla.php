<?php
include ("../conectar.php");

$nombrecobrador=$_POST["nombrecobrador"];
$codcobrador=$_POST["codcobrador"];
$cadena_busqueda=$_POST["cadena_busqueda"];

$where="1=1";
if ($codcobrador <> "") { $where.=" AND codcobrador='$codcobrador'"; }
if ($nombrecobrador <> "") { $where.=" AND nombrecobrador like '%".$nombrecobrador."%'"; }

$where.=" ORDER BY nombrecobrador ASC";
$query_busqueda="SELECT count(*) as filas FROM cobradores WHERE borrado=0 AND ".$where;
$rs_busqueda=mysql_query($query_busqueda);
$filas=mysql_result($rs_busqueda,0,"filas");

?>
<html>
	<head>
		<title>CodeKa Mx , Cobradores</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
		<script language="javascript">
		
		function ver_cobrador(codcobrador) {
			parent.location.href="ver_cobrador.php?codcobrador=" + codcobrador + "&cadena_busqueda=<? echo $cadena_busqueda?>";
		}
		
		function modificar_cobrador(codcobrador) {
			parent.location.href="modificar_cobrador.php?codcobrador=" + codcobrador + "&cadena_busqueda=<? echo $cadena_busqueda?>";
		}
		
		function eliminar_cobrador(codcobrador) {
			parent.location.href="eliminar_cobrador.php?codcobrador=" + codcobrador + "&cadena_busqueda=<? echo $cadena_busqueda?>";
		}

		function inicio() {
			var numfilas=document.getElementById("numfilas").value;
			var indi=parent.document.getElementById("iniciopagina").value;
			var contador=1;
			var indice=0;
			if (indi>numfilas) { 
				indi=1; 
			}
			parent.document.form_busqueda.filas.value=numfilas;
			parent.document.form_busqueda.paginas.innerHTML="";		
			while (contador<=numfilas) {
				texto=contador + "-" + parseInt(contador+9);
				if (indi==contador) {
					parent.document.form_busqueda.paginas.options[indice]=new Option (texto,contador);
					parent.document.form_busqueda.paginas.options[indice].selected=true;
				} else {
					parent.document.form_busqueda.paginas.options[indice]=new Option (texto,contador);
				}
				indice++;
				contador=contador+10;
			}
		}
		</script>
	</head>

	<body onload=inicio()>	
		<div id="pagina">
			<div id="zonaContenidoPP">
			<div align="center">
			<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">
			<input type="hidden" name="numfilas" id="numfilas" value="<? echo $filas?>">
				<? $iniciopagina=$_POST["iniciopagina"];
				if (empty($iniciopagina)) { $iniciopagina=$_GET["iniciopagina"]; } else { $iniciopagina=$iniciopagina-1;}
				if (empty($iniciopagina)) { $iniciopagina=0; }
				if ($iniciopagina>$filas) { $iniciopagina=0; }
					if ($filas > 0) { ?>
						<?php $sel_resultado="SELECT * FROM cobradores WHERE borrado=0 AND ".$where;
						   $sel_resultado=$sel_resultado."  limit ".$iniciopagina.",10";
						   $res_resultado=mysql_query($sel_resultado);
						   $contador=0;
						   while ($contador < mysql_num_rows($res_resultado)) { 
								 if ($contador % 2) { $fondolinea="itemParTabla"; } else { $fondolinea="itemImparTabla"; }?>
						<tr class="<?php echo $fondolinea?>">
							<td class="aCentro" width="12%"><?php echo $contador+1;?></td>
							<td width="20%"><div align="center"><?php echo mysql_result($res_resultado,$contador,"codcobrador")?></div></td>
							<td width="50%"><div align="left"><?php echo mysql_result($res_resultado,$contador,"nombrecobrador")?></div></td>
							<td width="6%"><div align="center"><a href="#"><img src="../img/modificar.png" width="16" height="16" border="0" onClick="modificar_cobrador(<?php echo mysql_result($res_resultado,$contador,"codcobrador")?>)" title="Modificar"></a></div></td>
							<td width="6%"><div align="center"><a href="#"><img src="../img/ver.png" width="16" height="16" border="0" onClick="ver_cobrador(<?php echo mysql_result($res_resultado,$contador,"codcobrador")?>)" title="Visualizar"></a></div></td>
							<td width="6%"><div align="center"><a href="#"><img src="../img/eliminar.png" width="16" height="16" border="0" onClick="eliminar_cobrador(<?php echo mysql_result($res_resultado,$contador,"codcobrador")?>)" title="Eliminar"></a></div></td>
						</tr>
						<? $contador++;
							}
						?>			
					</table>
					<? } else { ?>
					<table class="fuente8" width="85%" cellspacing=0 cellpadding=3 border=0>
						<tr>
							<td width="100%" class="mensaje"><?php echo "No hay ningun Cobrador que cumpla con los criterios de b&uacute;squeda";?></td>
					    </tr>
					</table>					
					<? } ?>					
				</div>
			</div>
		  </div>			
		</div>
	</body>
</html>
