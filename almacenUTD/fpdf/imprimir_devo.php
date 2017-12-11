<?php
define('FPDF_FONTPATH','font/');
require_once('mysql_table.php');
include("comunes.php");
include ("../conectar.php");
include ("../funciones/fechas.php"); 
include("../security.php");
error_reporting(0);

$pdf=new PDF();
$pdf->Open();
$pdf->AddPage();
if ($fondoguia=="SI") $pdf->Header($imagenguia,20,8,150,0);

$pdf->Ln(10);


//include ("../conectar.php");

$user= $_SESSION['MM_Username'];
  
$codalbaran=$_GET["codalbaran"];
  
$consulta = "Select CONCAT (centro.nombre_ccostos,' - ', item.nombre_item_ccostos)AS centro,devo.fecha,devo.entrega,devo.transporta,devo.recibe,us.full_name,devo.observacion FROM devoluciones devo LEFT JOIN item_ccostos item ON item.id_item_ccostos=devo.item_ccostos LEFT JOIN centrocostos centro ON centro.id_ccostos=item.id_ccostos LEFT JOIN  authuser us ON us.id=devo.id_usuario WHERE devo.id_devoluciones='$codalbaran' ";
$resultado = mysql_query($consulta, $conexion);
$lafila=mysql_fetch_array($resultado);
	$pdf->Cell(95);
   // $pdf->Cell(80,4,"",'',0,'C');
    
    $pdf->Ln(4);

    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','B',10);	
	
   

//    $pdf->Cell(95);
//    $pdf->Cell(80,4,"",'LRT',0,'L',1);
//    $pdf->Ln(4);
//	
//    $pdf->Cell(5);
//    $pdf->Cell(70,4,'Centro de Costos:'.$lafila["nombre_ccostos"]. '-'.$lafila["nombre_item_ccostos"] );
//    $pdf->Ln(4);

    $pdf->Cell(70);
    $pdf->Cell(69,5,'DEVOLUCION MATERIAL Y/O INSUMOS',1,0,'C');
    $pdf->Ln(10);
	
	//Calculamos la provincia
//	$codigoprovincia=$lafila["codprovincia"];
//	$consulta="select * from provincias where codprovincia='$codigoprovincia'";
//	$query=mysql_query($consulta);
//	$row=mysql_fetch_array($query);

//	$pdf->Cell(95);
//    $pdf->Cell(80,4,$lafila["codpostal"] . "  " . $lafila["localidad"] . ", " . $row["nombreprovincia"] ,'LR',0,'L',1);
//    $pdf->Ln(4);		
//	
//    $pdf->Cell(95);
//    //No muestro el celular
//    //$pdf->Cell(80,4,"Tel.: " . $lafila["telefono"] . "  " . "Movil: " . $lafila["movil"],'LR',0,'L',1);
//    $pdf->Cell(80,4,"Tel.: " . $lafila["telefono"] ,'LR',0,'L',1);
    
    //$pdf->Ln(4);
	
//    $pdf->Cell(95);
//    $pdf->Cell(80,4,"",'LRB',0,'L',1);
//    $pdf->Ln(10);					

//    
//        $pdf->Cell(40,65,'REMISIONES');
//	$pdf->SetX(10);
//        
//        $pdf->Ln(4);
    
    $pdf->SetFillColor(255,191,116);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','B',7);
    
	
    $pdf->Cell(1);
//    $pdf->Cell(30,4,"RFC",1,0,'C',1);
//	$pdf->Cell(30,4,"ID centro costos",1,0,'C',1);
         $pdf->Cell(70,4,"Centro Costos",1,0,'C',1);
	$pdf->Cell(30,4,"Fecha",1,0,'C',1);	
	$pdf->Cell(20,4,  utf8_decode("Devolución N°"),1,0,'C',1);
       
	$pdf->Ln(4);
	
	$pdf->Cell(1);
	$pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','',7);
	
	$fecha = implota($lafila["fecha"]);
	
//    $pdf->Cell(30,4,$lafila["nif"],1,0,'C',1);
//	$pdf->Cell(30,4,$lafila["id_ccostos"],1,0,'C',1);
        $pdf->cell(70,4,utf8_decode($lafila["centro"]),1,0,'C',1 );
	$pdf->Cell(30,4,$fecha,1,0,'C',1);	
	$pdf->Cell(20,4,$codalbaran,1,0,'C',1);		
	
	
	//ahora mostramos las lneas del albarn
	$pdf->Ln(7);		
	$pdf->Cell(1);
	
	$pdf->SetFillColor(255,191,116);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','B',7);
	
    $pdf->Cell(30,4,"Referencia",1,0,'C',1);
	$pdf->Cell(57,4,"Descripcion",1,0,'C',1);
        $pdf->Cell(14,4,"UM",1,0,'C',1);
	$pdf->Cell(20,4,"Cantidad",1,0,'C',1);	
	$pdf->Cell(20,4,"Cant. NO OK",1,0,'C',1);
	$pdf->Cell(47,4,utf8_decode("Observación"),1,0,'C',1);
	$pdf->Ln(4);
			
			
	$pdf->SetFillColor(224,235,255);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','',7);

	
	$consulta2 = "Select * from devulucioneslinea where coddevo=$codalbaran order by numlinea";
        $resultado2 = mysql_query($consulta2, $conexion);
    
	$contador=1;
	while ($row=mysql_fetch_array($resultado2))
	{
          
	  $pdf->Cell(1);
	  $contador++;
	  $codarticulo=mysql_result($resultado2,$lineas,"cod_producto");
	  $codfamilia=mysql_result($resultado2,$lineas,"cod_familia");
	  $sel_articulos="SELECT art.referencia,art.descripcion,em.nombre,art.codfamilia FROM articulos art JOIN embalajes em ON art.codembalaje=em.codembalaje WHERE art.codarticulo='$codarticulo' AND art.codfamilia='$codfamilia'";
	  $rs_articulos=mysql_query($sel_articulos);
	  $pdf->Cell(30,4,mysql_result($rs_articulos,0,"art.referencia"),0,'L');
	  
	  $acotado = substr(mysql_result($rs_articulos,0,"art.descripcion"), 0, 45);
	  $pdf->Cell(57,4,$acotado,0,'L');
          
          $pdf->Cell(14,4,mysql_result($rs_articulos,0,"em.nombre"),0,'L');
	  
	  $pdf->Cell(20,4,number_format(mysql_result($resultado2,$lineas,"cantidad"),2,".",","),0,'C');	
	  $pdf->Cell(20,4,number_format(mysql_result($resultado2,$lineas,"cantidadNoOK"),2,".",","),0,'C');	
	  
	  $pdf->Cell(47,4,mysql_result($resultado2,$lineas,"observacion"),0,'R');
	  
	
	  $pdf->Ln(4);	  
          
           $contador=$contador + 1;
           $lineas=$lineas + 1;
	};
	
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
//	  $contador=$contador +1;
//	}

//	  $pdf->Cell(1);
//      $pdf->Cell(40,4,"",'LRB',0,'C');
//      $pdf->Cell(80,4,"",'LRB',0,'C');
//	  $pdf->Cell(20,4,"",'LRB',0,'C');	
//	  $pdf->Cell(15,4,"",'LRB',0,'C');
//	  $pdf->Cell(15,4,"",'LRB',0,'C');
//	  $pdf->Cell(20,4,"",'LRB',0,'C');
//	  $pdf->Ln(4);	


	//ahora mostramos el final de la factura


//
//      @mysql_free_result($resultado); 
//      @mysql_free_result($query);
//	  @mysql_free_result($resultado2); 
//	  @mysql_free_result($query3);
          
        
     $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','B',8);	
    
      $pdf->Ln(4);
    $pdf->Cell(1);
    $pdf->Cell(175,4,"",'LRT',0,'L',1);
    $pdf->Ln(4);
    
    
	
      $pdf->Cell(1);
    $pdf->Cell(175,4,'Observaciones: '. $lafila["observacion"],'LR',0,'L',1);
    $pdf->Ln(4);
    
    $pdf->Cell(1);
    $pdf->Cell(175,4,"",'LRB',0,'L',1);
    $pdf->Ln(1);  
          
              
    $pdf->SetFillColor(255,191,116);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','B',8);
          
          $pdf->Ln(4);
          $pdf->Cell(1);
          $pdf->Cell(35,4,"Elabora",1,0,'C',1);
		  $pdf->Cell(35,4,"Autoriza",1,0,'C',1);
		  
          $pdf->Cell(35,4,"Transporta/Reviza",1,0,'C',1);
          $pdf->Cell(35,4,"Entrega",1,0,'C',1);
          $pdf->Cell(35,4,"Recibe",1,0,'C',1);
          $pdf->Ln(4);
          
          $pdf->Cell(1);
	$pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','',8);
          
          $pdf->Cell(35,15,$lafila["full_name"],1,0,'C',1);
		  
          $pdf->Cell(35,15,$lafila[""],1,0,'C',1);
		   		  
          $pdf->Cell(35,15,$lafila["transporta"],1,0,'C',1);
          $pdf->Cell(35,15,$lafila["entrega"],1,0,'C',1);
          $pdf->Cell(35,15,$lafila["recibe"],1,0,'C',1);

          
          

$pdf->Output();
?> 