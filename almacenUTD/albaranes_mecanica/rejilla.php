<?php
include ("../conectar.php");
include ("../funciones/fechas.php");
include ("../security.php");
error_reporting (0);


$idusu = $_SESSION['id_User'];
$level = $_SESSION['level'];

$id=$_POST["id"];
$vehiculo=$_POST["cbovehi"];
$fechainicio=$_POST["fechainicio"];
if ($fechainicio<>"") { $fechainicio=explota($fechainicio); }
$fechafin=$_POST["fechafin"];
if ($fechafin<>"") { $fechafin=explota($fechafin); }

$cadena_busqueda=$_POST["cadena_busqueda"];

$where="1=1";
if ($id <> "") { $where.=" AND hm.id_hoja_mto='$id'"; }
if ($vehiculo > "0") { $where.=" AND ve.id_vehiculo='$vehiculo' "; }
if (($fechainicio<>"") and ($fechafin<>"")) {
	$where.=" AND hm.fecha between '".$fechainicio."' AND '".$fechafin."' ";
} else {
	if ($fechainicio<>"") {
		$where.=" AND hm.fecha>=' ".$fechainicio."'";
	} else {
		if ($fechafin<>"") {
			$where.=" AND hm.fecha<=' ".$fechafin."'";
		}
	}
}

$where.=" ORDER BY hm.id_hoja_mto DESC";
$query_busqueda="SELECT count(*) as filas FROM hoja_mantenimiento hm,vehiculos_equipos ve,linea li,marca_vehiculo ma WHERE hm. 	vehiculos_equipos_id_vehiculo=ve.id_vehiculo AND ve.Linea_idLinea=li.idLinea AND li.marca_vehiculo_id_marca=ma.id_marca AND ". $where;

$rs_busqueda=mysql_query($query_busqueda);
$filas=mysql_result($rs_busqueda,0,"filas");

?>
<html>
	<head>
		<title>Centro de Costos</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
		<script language="javascript">
		
		function ver_albaran(id) {
		
			
			parent.location.href="ver_albaran.php?id=" + id + "&cadena_busqueda=<? echo $cadena_busqueda?>";
		}
		
		
		function imprimir_etiquetas(codalbaran) {
				window.open("../fpdf/codigocontinuo.php?codalbaran="+codalbaran);
		}
		
		function modificar_albaran(id,level,activo) {
		
				if((level==1 || level ==2 || level==9 || level==4) && (activo==1))
				{
					
					parent.location.href="modificar_albaran.php?id=" + id + "&cadena_busqueda=<? echo $cadena_busqueda?>";	
				}else
				
				
				if(level==1 && activo==0)
				{
					parent.location.href="modificar_albaran.php?id=" + id + "&cadena_busqueda=<? echo $cadena_busqueda?>";
				}
				else
				
					if((level==9 || level==2) && (activo==0))
					
					{
					alert("La hoja de mantenimiento no esta activa. Comuniquese con el Administrador");

					}
				else	
					{
						alert("La hoja de mantenimiento no esta activa. Comuniquese con el Administrador");
					}
					
		
			
		}
		

		
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
						<? $sel_resultado="SELECT hm.activo,hm.id_hoja_mto,hm.fecha_mto, CONCAT(ma.marca, '-', li.name_linea,'-','Placa: ',ve.placa_equipo)AS nom FROM hoja_mantenimiento hm,linea li,marca_vehiculo ma, vehiculos_equipos ve WHERE hm.vehiculos_equipos_id_vehiculo=ve.id_vehiculo AND ve.Linea_idLinea=li.idLinea AND ma.id_marca=li.marca_vehiculo_id_marca AND " .$where ;
						   $sel_resultado=$sel_resultado."  limit ".$iniciopagina.",10";
						   $res_resultado=mysql_query($sel_resultado);
						   $contador=0;
						  
						   
						   //$marcaestado=0;					   
						   while ($contador < mysql_num_rows($res_resultado)) { 
						   		 $activo=mysql_result($res_resultado,$contador,"hm.activo");
								if ($contador % 2) { $fondolinea="itemParTabla"; } else { $fondolinea="itemImparTabla"; }?>
						<tr class="<?php echo $fondolinea?>">
							<td class="aCentro" width="16%"><div align="center"><? echo $contador+1;?></td>
							<td width="11%"><div align="center"><? echo mysql_result($res_resultado,$contador,"hm.id_hoja_mto")?></div></td>
							<td width="27%"><div align="center"><? echo mysql_result($res_resultado,$contador,"nom")?></div></td>							
							<td class="aDerecha" width="27%"><div align="center"><? echo mysql_result($res_resultado,$contador,"hm.fecha_mto")?></div></td>
							
							
							
                            
                            <td width="10%"><div align="center"><a href="#"><img src="../img/modificar.png" width="16" height="16" border="0" onClick="modificar_albaran(<?php echo mysql_result($res_resultado,$contador,"hm.id_hoja_mto")?>,<? echo $level ?>,<? echo $activo ?>)" title="Modificar"></a></div></td>  
                             
                         
                            
                            
							<td width="9%"><div align="center"><a href="#"><img src="../img/ver.png" width="16" height="16" border="0" onClick="ver_albaran(<?php echo mysql_result($res_resultado,$contador,"hm.id_hoja_mto")?>)" title="Visualizar"></a></div></td>
						</tr>
						<? $contador++;
							}
						?>			
					</table>
					<? } else { ?>
					<table class="fuente8" width="87%" cellspacing=0 cellpadding=3 border=0>
						<tr>
							<td width="100%" class="mensaje"><?php echo "No hay ninguna Hoja de Mantenimiento que cumpla con los criterios de b&uacute;squeda";?></td>
					    </tr>
					</table>					
					<? } ?>					
				</div>
			</div>
		  </div>			
		</div>
        
        <?
		
	//	echo "<br>";echo "<br>";echo "<br>";echo "<br>";
//		echo $idusu."usuario";
//		echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";
//		echo $activo."activo";
		?>
 
        
	</body>
</html>
