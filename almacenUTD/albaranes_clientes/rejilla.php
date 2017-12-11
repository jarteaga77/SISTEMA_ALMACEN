<?php
include ("../conectar.php");
include ("../funciones/fechas.php");
include ("../security.php");
error_reporting (0);


$level = $_SESSION['level'];

$codcliente=$_POST["codcliente"];
$nombre=$_POST["nombre"];
$numalbaran=$_POST["numalbaran"];
$estado=$_POST["cboEstados"];
$fechainicio=$_POST["fechainicio"];
if ($fechainicio<>"") { $fechainicio=explota($fechainicio); }
$fechafin=$_POST["fechafin"];
if ($fechafin<>"") { $fechafin=explota($fechafin); }

$cadena_busqueda=$_POST["cadena_busqueda"];

$where="1=1";
if ($codcliente <> "") { $where.=" AND albaranes.id_ccostos='$codcliente'"; }
if ($nombre <> "") { $where.=" OR centrocostos.nombre_ccostos like '%".$nombre."%'"; }
if ($numalbaran <> "") { $where.=" AND albaranes.codalbaran='$numalbaran'"; }
if ($estado > "0") { $where.=" AND albaranes.estado='$estado'"; }
if (($fechainicio<>"") and ($fechafin<>"")) {
	$where.=" AND albaranes.fecha between '".$fechainicio."' AND '".$fechafin."'";
} else {
	if ($fechainicio<>"") {
		$where.=" and albaranes.fecha>='".$fechainicio."'";
	} else {
		if ($fechafin<>"") {
			$where.=" and albaranes.fecha<='".$fechafin."'";
		}
	}
}

$where.=" ORDER BY albaranes.codalbaran DESC";
$query_busqueda="SELECT count(*) as filas FROM albaranes,item_ccostos,centrocostos WHERE albaranes.borrado=0 AND albaranes.id_ccostos=item_ccostos.id_item_ccostos AND centrocostos.id_ccostos=item_ccostos.id_ccostos AND  ".$where;

$rs_busqueda=mysql_query($query_busqueda);
$filas=mysql_result($rs_busqueda,0,"filas");

?>
<html>
	<head>
		<title>Centro de Costos</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
		<script language="javascript">
		
		function ver_albaran(codalbaran) {
			parent.location.href="ver_albaran.php?codalbaran=" + codalbaran + "&cadena_busqueda=<? echo $cadena_busqueda?>";
		}
		
		
		function imprimir_etiquetas(codalbaran) {
				window.open("../fpdf/codigocontinuo.php?codalbaran="+codalbaran);
		}
		
		function modificar_albaran(codalbaran,level,activo) 
		{
			
			//alert (level);
				if((level==6 || level==1  || level==2 || level==8) && (activo==1))
				{
			//alert (activo);
				
				parent.location.href="modificar_albaran.php?codalbaran=" + codalbaran + "&cadena_busqueda=<? echo $cadena_busqueda?>";
				
			
				}
				
				else
				{
				if(level==1 && activo==0)
				{
					parent.location.href="modificar_albaran.php?codalbaran=" + codalbaran + "&cadena_busqueda=<? echo $cadena_busqueda?>";
				}
		
		else {
			if((level==2 || level==6 || level==8) && (activo==0))
				{
			
				alert("La orden de salida no esta activa. Comuniquese con el Administrador");
				}
				
				else
				{
					alert("La orden de salida no esta activa. Comuniquese con el Administrador");
					
				}
				
		}
	}
}		
		
//		function convertir_albaran(codalbaran,marcaestado) {
//			if (marcaestado==1) {
//				parent.location.href="convertir_albaran.php?codalbaran=" + codalbaran + "&cadena_busqueda=<? echo $cadena_busqueda?>";
//			} else {
//				alert ("No se puede convertir en factura un albaran ya facturado");
//			}
//		}
		
		function eliminar_albaran(codalbaran) {
			parent.location.href="eliminar_albaran.php?codalbaran=" + codalbaran + "&cadena_busqueda=<? echo $cadena_busqueda?>";
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
						<? $sel_resultado="SELECT  albaranes.codalbaran, CONCAT( centrocostos.nombre_ccostos, '-' , item_ccostos.nombre_item_ccostos)AS centro, albaranes.fecha,albaranes.totalalbaran,albaranes.activo
                                                                  FROM albaranes,item_ccostos,centrocostos WHERE item_ccostos.id_item_ccostos=albaranes.id_ccostos AND
                                                                  centrocostos.id_ccostos=item_ccostos.id_ccostos AND albaranes.borrado=0 AND " .$where;
						   $sel_resultado=$sel_resultado."  limit ".$iniciopagina.",10";
						   $res_resultado=mysql_query($sel_resultado);
						   $contador=0;
						   $activo=0;					   
						   while ($contador < mysql_num_rows($res_resultado)) { 
						   		//$marcaestado=mysql_result($res_resultado,$contador,"albaranes.estado");
								
								$activo=mysql_result($res_resultado,$contador,"albaranes.activo");
						
								if ($contador % 2) { $fondolinea="itemParTabla"; } else { $fondolinea="itemImparTabla"; }?>
						<tr class="<?php echo $fondolinea?>">
							<td class="aCentro" width="17%"><div align="center"><? echo $contador+1;?></td>
							<td width="8%"><div align="center"><? echo mysql_result($res_resultado,$contador,"albaranes.codalbaran")?></div></td>
							<td width="30%"><div align="center"><? echo mysql_result($res_resultado,$contador,"centro")?></div></td>
							<td width="10%"><div align="center"><? echo number_format(mysql_result($res_resultado,$contador,"albaranes.totalalbaran"),2,".",",")?></div></td>							
							<td class="aDerecha" width="15%"><div align="center"><? echo mysql_result($res_resultado,$contador,"albaranes.fecha")?></div></td>
							<td width="10%"><div align="center"><a href="#"><img src="../img/modificar.png" width="16" height="16" border="0" onClick="modificar_albaran(<?php echo mysql_result($res_resultado,$contador,"albaranes.codalbaran")?>,<? echo $level ?>,<? echo $activo ?>)" title="Modificar"></a></div></td>
							<td width="10%"><div align="center"><a href="#"><img src="../img/ver.png" width="16" height="16" border="0" onClick="ver_albaran(<?php echo mysql_result($res_resultado,$contador,"albaranes.codalbaran")?>)" title="Visualizar"></a></div></td>
						</tr>
						<? $contador++;
							}
						?>			
					</table>
					<? } else { ?>
					<table class="fuente8" width="87%" cellspacing=0 cellpadding=3 border=0>
						<tr>
							<td width="100%" class="mensaje"><?php echo "No hay ninguna orden de despacho que cumpla con los criterios de b&uacute;squeda";?></td>
					    </tr>
					</table>					
					<? } ?>					
				</div>
			</div>
		  </div>			
		</div>
	</body>
</html>
