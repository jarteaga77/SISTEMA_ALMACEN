<?php


define('FPDF_FONTPATH','font/');


require_once('mysql_table.php');
include ("../conectar.php");



$codalbaran=$_GET["codalbaran"];

$consulta3="SELECT id_ccostos FROM albaranesp WHERE codalbaran='$codalbaran'";
$rsconsulta3=mysql_query($consulta3);
$coditem=mysql_result($rsconsulta3,0,"id_ccostos");

if($coditem==85 )
{
	include("comuneslobo.php");
	
}else
{
	include("comunes.php");
}





include ("../funciones/fechas.php"); 





error_reporting(0);

$pdf=new PDF();
$pdf->Open();
$pdf->AddPage();

$pdf->Ln(10);


//include ("../conectar.php");
  
//$codalbaran=$_GET["codalbaran"];
$codproveedor=$_GET["codproveedor"];
  
$consulta = "SELECT pro.nif,pro.nombre,pro.direccion,pro.telefono,pro.movil,pro.codprovincia,pro.localidad,en.fecha,en.requisicion,en.orden_compra,en.remision_factura,en.compras,us.full_name,en.observacion FROM albaranesp en LEFT JOIN proveedores pro ON en.codproveedor=pro.codproveedor LEFT JOIN authuser us ON us.id=en.id_usuario WHERE en.codalbaran='$codalbaran' AND en.codproveedor='$codproveedor'";
$resultado = mysql_query($consulta, $conexion);
$lafila=mysql_fetch_array($resultado);
	$pdf->Cell(95);
    $pdf->Cell(80,4,"",'',0,'C');
    $pdf->Ln(4);
	
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','B',8);	
	
    $pdf->Cell(80);
    $pdf->Cell(40,5,'ENTRADA ALMACEN',1,0,'C');
    $pdf->Ln(10);
	

    $pdf->Cell(1);
    $pdf->Cell(80,4,"",'LRT',0,'L',1);
    $pdf->Ln(4);
	
      $pdf->Cell(1);
    $pdf->Cell(80,4,$lafila["pro.nif"],'LR',0,'L',1);
    $pdf->Ln(4);
    
    $pdf->Cell(1);
    $pdf->Cell(80,4,$lafila["nombre"],'LR',0,'L',1);
    $pdf->Ln(4);

    $pdf->Cell(1);
    $pdf->Cell(80,4,$lafila["direccion"],'LR',0,'L',1);
    $pdf->Ln(4);
	
	//Calculamos la provincia
	$codigoprovincia=$lafila["codprovincia"];
	$consulta="select nombreprovincia from provincias where codprovincia='$codigoprovincia'";
	$query=mysql_query($consulta);
	$row=mysql_fetch_array($query);

	$pdf->Cell(1);
    $pdf->Cell(80,4,$lafila["codpostal"] . "  " . $lafila["localidad"] . ", " . $row["nombreprovincia"],'LR',0,'L',1);
    $pdf->Ln(4);		
	
    $pdf->Cell(1);
    // Solo incluyo el telefono principal, no el celular.
     $pdf->Cell(80,4,"Tel: " . $lafila["telefono"] . "  " . "Movil: " . $lafila["movil"],'LR',0,'L',1);
    //$pdf->Cell(80,4,"Tel.: " . $lafila["telefono"] ,'LR',0,'L',1);
    $pdf->Ln(4);
	
    $pdf->Cell(1);
    $pdf->Cell(80,4,"",'LRB',0,'L',1);
    $pdf->Ln(7);					

    $pdf->SetFillColor(255,191,116);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','B',8);
	
    $pdf->Cell(1);
    
	
	$pdf->Cell(20,4,"Fecha",1,0,'C',1);	
	$pdf->Cell(40,4, utf8_decode("Entrada Almacen N°"),1,0,'C',1);
        $pdf->Cell(30,4,"Requisicion",1,0,'C',1);
        $pdf->Cell(30,4,"N.Orden Compra",1,0,'C',1);
        $pdf->Cell(40,4,"Factura/Remision",1,0,'C',1);
	$pdf->Ln(4);
	
	$pdf->Cell(1);
	$pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','',7);
	
	$fecha=implota($lafila["fecha"]);
	
  
	$pdf->Cell(20,4,$fecha,1,0,'C',1);	
	$pdf->Cell(40,4,$codalbaran,1,0,'C',1);	
        $pdf->Cell(30,4,$lafila["requisicion"],1,0,'C',1);
        $pdf->Cell(30,4,$lafila["orden_compra"],1,0,'C',1);
        $pdf->Cell(40,4,utf8_decode($lafila["remision_factura"]),1,0,'C',1);
	
	
	//ahora mostramos las lneas del albarn
	$pdf->Ln(7);		
	$pdf->Cell(1);
	
	$pdf->SetFillColor(255,191,116);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','B',8);
	
    $pdf->Cell(35,4,"Referencia",1,0,'C',1);
	$pdf->Cell(75,4,"Descripcion",1,0,'C',1);
	$pdf->Cell(15,4,"Cantidad",1,0,'C',1);	
	$pdf->Cell(20,4,utf8_decode("Ubicación"),1,0,'C',1);
	$pdf->Cell(15,4,"Precio",1,0,'C',1);
	$pdf->Cell(15,4,"% Desc.",1,0,'C',1);	
	$pdf->Cell(15,4,"Total",1,0,'C',1);
	
	$pdf->Ln(4);
			
			
	$pdf->SetFillColor(224,235,255);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','',7);

	
	$consulta2 = "Select * from albalineap where codalbaran='$codalbaran' and codproveedor='$codproveedor' order by numlinea";
    $resultado2 = mysql_query($consulta2,$conexion);
    
	$contador=1;
	while ($row=mysql_fetch_array($resultado2))
	{
	  $pdf->Cell(1);
	  $contador++;
	  $codarticulo=mysql_result($resultado2,$lineas,"codigo");
	  $codfamilia=mysql_result($resultado2,$lineas,"codfamilia");
	  $sel_articulos="SELECT articulos.*, ubicaciones.nombre FROM articulos,ubicaciones WHERE articulos.codarticulo='$codarticulo' AND articulos.codubicacion=ubicaciones.codubicacion AND codfamilia='$codfamilia'";
	  $rs_articulos=mysql_query($sel_articulos);
	  $pdf->Cell(35,4,mysql_result($rs_articulos,0,"referencia"),0,'L');
	  
	  $acotado = substr(mysql_result($rs_articulos,0,"descripcion"), 0, 45);
	  $pdf->Cell(75,4,$acotado,0,'L');
	  
	  $pdf->Cell(15,4,mysql_result($resultado2,$lineas,"cantidad"),0,'C');	
	  
	   $pdf->Cell(20,4,mysql_result($rs_articulos,0,"ubicaciones.nombre"),0,'C');
	  
	  $precio2= number_format(mysql_result($resultado2,$lineas,"precio"),2,".",",");	  
	  $pdf->Cell(15,4,$precio2,0,'R');
	  
	  if(mysql_result($resultado2,$lineas,"dcto")==0) 
	  {
	  $pdf->Cell(15,4,"",0,'C');
	  } 
	  else 
	   { 
		$pdf->Cell(15,4,mysql_result($resultado2,$lineas,"dcto") . " %",0,'C');
	   }
	  
	  $importe2=number_format(mysql_result($resultado2,$lineas,"importe"),2,".",",");	  
	  
	  $pdf->Cell(15,4,$importe2,0,'R');
	 
	  $pdf->Ln(4);	


	  //vamos acumulando el importe
	  $importe=$importe+mysql_result($resultado2,$lineas,"importe");
	  $contador=$contador+1;
	  $lineas=$lineas+1;
	  
	}
	
//	while ($contador<35)
//	{
//	  $pdf->Cell(1);
//      $pdf->Cell(40,4,"",'LR',0,'C');
//      $pdf->Cell(80,4,"",'LR',0,'C');
//	  $pdf->Cell(20,4,"",'LR',0,'C');	
//	  $pdf->Cell(15,4,"",'LR',0,'C');
//	  $pdf->Cell(15,4,"",'LR',0,'C');
//	  $pdf->Cell(20,4,"",'LR',0,'C');
//	  $pdf->Ln(4);	
//	  $contador=$contador+1;
//	}
//
//	  $pdf->Cell(1);
//      $pdf->Cell(40,4,"",'LRB',0,'C');
//      $pdf->Cell(80,4,"",'LRB',0,'C');
//	  $pdf->Cell(20,4,"",'LRB',0,'C');	
//	  $pdf->Cell(15,4,"",'LRB',0,'C');
//	  $pdf->Cell(15,4,"",'LRB',0,'C');
//	  $pdf->Cell(20,4,"",'LRB',0,'C');
//	  $pdf->Ln(4);	


	//ahora mostramos el final de la factura
	$pdf->Ln(4);		
	$pdf->Cell(66);
	
	$pdf->SetFillColor(255,191,116);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','B',8);
	
    $pdf->Cell(30,4,"Subtotal",1,0,'C',1);
	$pdf->Cell(30,4,"% IVA",1,0,'C',1);
	$pdf->Cell(30,4,"IVA",1,0,'C',1);	
	$pdf->Cell(35,4,"TOTAL",1,0,'C',1);
	$pdf->Ln(4);
	
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','',7);
	
	$pdf->Cell(66);
    $importe4=number_format($importe,2,".",",");	
    $pdf->Cell(30,4,$importe4,1,0,'R',1);
	$pdf->Cell(30,4,$lafila["iva"] . "%",1,0,'C',1);
	
	$ivai=$lafila["iva"];
	$impo=$importe*($ivai/100);
	$impo=sprintf("%01.2f", $impo); 
	$total=$importe+$impo; 
	$total=sprintf("%01.2f", $total);

	$impo=number_format($impo,2,".",",");	
	$pdf->Cell(30,4,"$impo",1,0,'R',1);	
    $total=sprintf("%01.2f", $total);
	$total2= number_format($total,2,".",",");	
	$pdf->Cell(35,4, $simbolomoneda . "$total2",1,0,'R',1);
	$pdf->Ln(8);


      @mysql_free_result($resultado); 
      @mysql_free_result($query);
	  @mysql_free_result($resultado2); 
	  @mysql_free_result($query3);
          
          
//          	$pdf->Cell(95);
//    $pdf->Cell(80,4,"",'',0,'C');
//    $pdf->Ln(4);
	
  
  
  
          
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','B',8);	
    
    $pdf->Cell(1);
    $pdf->Cell(190,4,"",'LRT',0,'L',1);
    $pdf->Ln(4);
	
      $pdf->Cell(1);
    $pdf->Cell(190,4,'Observaciones: '. $lafila["observacion"],'LR',0,'L',1);
    $pdf->Ln(4);
    
    $pdf->Cell(1);
    $pdf->Cell(190,4,"",'LRB',0,'L',1);
    $pdf->Ln(1);     
    
    
          $pdf->SetFillColor(255,191,116);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','B',8);
          
          $pdf->Ln(5);
          $pdf->Cell(1);
          $pdf->Cell(40,4,"Elabora",1,0,'C',1);
          $pdf->Cell(40,4,"Compras",1,0,'C',1);
		  $pdf->Cell(40,4,utf8_decode("V.B° Almacen"),1,0,'C',1);
		  $pdf->Cell(40,4,utf8_decode("V.B° Dirección de MTO."),1,0,'C',1);
          $pdf->Ln(4);
          
          
          $pdf->Cell(1);
	$pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','',8);
          
          $pdf->Cell(40,15,$lafila["full_name"],1,0,'C',1);
          $pdf->Cell(40,15,$lafila["compras"],1,0,'C',1);
		  $pdf->Cell(40,15,$lafila[""],1,0,'C',1);
		  $pdf->Cell(40,15,$lafila[""],1,0,'C',1);

$pdf->Output();
?>
