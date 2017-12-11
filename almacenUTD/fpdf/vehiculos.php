<?php


define('FPDF_FONTPATH','font/');
//require('mysql_table.php');
require_once ('fpdf.php') ; 
include("comunes.php");

include ("../conectar.php");  

error_reporting(0);


$pdf=new PDF();
$pdf->Open();
$pdf->AddPage();

// Cabecera

$pdf->Header('./logo/logo.jpg',10,8,33,33);

//Nombre del Listado

$pdf->SetFillColor(255,255,255);
$pdf->SetFont('Arial','B',10);
$pdf->SetY(30);
$pdf->SetX(0);
    
$pdf->MultiCell(220,6,"Listado de Vehiculos",0,C,0);

$pdf->Ln();    
	
//Restauracin de colores y fuentes

    $pdf->SetFillColor(224,235,255);
    $pdf->SetTextColor(0);
    $pdf->SetFont('Arial','B',7);


$codarticulo=$_GET["codarticulo"];
$descripcion=$_GET["descripcion"];
$codfamilia=$_GET["cboFamilias"];
$referencia=$_GET["referencia"];
$codproveedor=$_GET["cboProveedores"];
$codubicacion=$_GET["cboUbicacion"];

$where="1=1";
if ($codarticulo <> "") { $where.=" AND codarticulo='$codarticulo'"; }
if ($descripcion <> "") { $where.=" AND descripcion like '%".$descripcion."%'"; }
if ($codfamilia > "0") { $where.=" AND codfamilia='$codfamilia'"; }
if ($codproveedor > "0") { $where.=" AND (codproveedor1='$codproveedor' OR codproveedor2='$codproveedor')"; }
if ($codubicacion > "0") { $where.=" AND codubicacion='$codubicacion'"; }
if ($referencia <> "") { $where.=" AND referencia like '%".$referencia."%'"; }


$header=array('Placa','Marca - Linea','SOAT','Ven. Fecha', 'Tecnomecanica', 'Tecno. Fecha');

//Colores, ancho de lnea y fuente en negrita
$pdf->SetFillColor(200,200,200);
$pdf->SetTextColor(0);
$pdf->SetDrawColor(0,0,0);
$pdf->SetLineWidth(.1);
$pdf->SetFont('Arial','B',6);
	
//Cabecera
$w=array(20,40,50,20,40,20);
for($i=0;$i<count($header);$i++)
	$pdf->Cell($w[$i],7,$header[$i],1,0,'C',1);
$pdf->Ln();
$pdf->SetFont('Arial','',8);
$sel_resultado="SELECT ve.id_vehiculo,ve.placa_equipo, CONCAT(ma.marca, '-', li.name_linea)AS nombre,ve.CC_equipo, ve.soat_equipo, ve.venci_soat_equipo, ve.num_tecno_meca, ve.venci_tecno_meca, item.nombre_item_ccostos  FROM vehiculos_equipos ve JOIN linea li ON ve.Linea_idLinea=li.idLinea JOIN item_ccostos item ON ve.item_ccostos_id_item_ccostos=item.id_item_ccostos JOIN marca_vehiculo ma ON ma.id_marca=li.marca_vehiculo_id_marca WHERE ve.estado_vehi=1 AND ".$where;
$res_resultado=mysql_query($sel_resultado);
$contador=0;
while ($contador < mysql_num_rows($res_resultado)) {
	$pdf->Cell($w[0],5,mysql_result($res_resultado,$contador,"ve.placa_equipo"),'LRTB',0,'L');
	$pdf->Cell($w[1],5,mysql_result($res_resultado,$contador,"nombre"),'LRTB',0,'C');
	$pdf->Cell($w[2],5,mysql_result($res_resultado,$contador,"ve.soat_equipo"),'LRTB',0,'R');
	$pdf->Cell($w[3],5,mysql_result($res_resultado,$contador,"ve.venci_soat_equipo"),'LRTB',0,'R');
	$pdf->Cell($w[4],5,mysql_result($res_resultado,$contador,"ve.num_tecno_meca"),'LRTB',0,'R');
	$pdf->Cell($w[5],5,mysql_result($res_resultado,$contador,"ve.venci_tecno_meca"),'LRTB',0,'R');
	

	$pdf->Ln();
	$contador++;
};
			
$pdf->Output();
?> 
