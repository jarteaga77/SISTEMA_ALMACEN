<?php


define('FPDF_FONTPATH','font/');
require_once('mysql_table.php');
include("comunes.php");
include ("../conectar.php");
include ("../funciones/fechas.php"); 
include ("../security.php");
error_reporting(0);
$user=$_SESSION['MM_Username'];


$pdf=new PDF();
$pdf->Open();
$pdf->AddPage();
if ($fondoguia=="SI") $pdf->Header($imagenguia,20,8,150,0);

$pdf->Ln(10);


//include ("../conectar.php");
  
$codalbaran=$_GET["codalbaran"];
  
$consulta = "SELECT CONCAT(tr.name_tramo,' - ',item.name_item_tramos) AS destino, repa.fecha_entrada, us.full_name,repa.remision,repa.tec_hardware,repa.observacion FROM entrada_reparacion repa 
LEFT JOIN item_tramos item ON repa.id_item_tramos=item.idItem_tramos 

LEFT  JOIN authuser us ON us.id=repa.id_usuario 

LEFT  JOIN  tramos tr ON tr.idTramos=item.Tramos_idTramos  


WHERE repa.id='$codalbaran'";
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

    $pdf->Cell(67);
    $pdf->Cell(77,5,utf8_decode('ENTRADA POR REPARACIÓN DE EQUIPOS'),1,0,'C');
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
    $pdf->SetFont('Arial','B',8);
    
	
	$pdf->Cell(1);
//  $pdf->Cell(30,4,"RFC",1,0,'C',1);
//	$pdf->Cell(30,4,"ID centro costos",1,0,'C',1);
    $pdf->Cell(70,4,"DESTINO",1,0,'C',1);
	$pdf->Cell(30,4,"Fecha",1,0,'C',1);	
	$pdf->Cell(20,4,  utf8_decode("Entrada N°"),1,0,'C',1);
       
	$pdf->Ln(4);
	
	$pdf->Cell(1);
	$pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','',7);
	
	$fecha = implota($lafila["fecha_entrada"]);
	
//    $pdf->Cell(30,4,$lafila["nif"],1,0,'C',1);
//	$pdf->Cell(30,4,$lafila["id_ccostos"],1,0,'C',1);
    $pdf->cell(70,4,$lafila["destino"],1,0,'C',1 );
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
	
    $pdf->Cell(45,4,"Referencia",1,0,'C',1);
	$pdf->Cell(77,4,"Descripcion",1,0,'C',1);
    $pdf->Cell(10,4,"UM",1,0,'C',1);
	$pdf->Cell(12,4,"Cantidad",1,0,'C',1);
	$pdf->Cell(30,4,utf8_decode("Ubicación"),1,0,'C',1);
		
	//$pdf->Cell(15,4,"Precio",1,0,'C',1);
	//$pdf->Cell(15,4,"% Desc.",1,0,'C',1);	
	//$pdf->Cell(20,4,"Total",1,0,'C',1);
	$pdf->Ln(4);
			
			
	$pdf->SetFillColor(224,235,255);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','',7);

	
	$consulta2 = "Select * from linea_ent_repa where codalbaran='$codalbaran' order by numlinea";
    $resultado2 = mysql_query($consulta2, $conexion);
    
	$contador=1;
	while ($row=mysql_fetch_array($resultado2))
	{
          
	  $pdf->Cell(1);
	  $contador++;
	  $codarticulo=mysql_result($resultado2,$lineas,"codigo");
	  $codfamilia=mysql_result($resultado2,$lineas,"codfamilia");
	  $sel_articulos="SELECT * FROM articulos,embalajes,ubicaciones WHERE codarticulo='$codarticulo' AND codfamilia='$codfamilia' AND articulos.codembalaje=embalajes.codembalaje AND articulos.codubicacion=ubicaciones.codubicacion";
	  $rs_articulos=mysql_query($sel_articulos);
	  $pdf->Cell(45,4,mysql_result($rs_articulos,0,"referencia"),0,'L');
	  
	  $acotado = substr(mysql_result($rs_articulos,0,"descripcion"), 0, 45);
	  $pdf->Cell(77,4,utf8_decode($acotado),0,'L');
          
      $pdf->Cell(10,4,mysql_result($rs_articulos,0,"nombre"),0,'L');
	  
	  $pdf->Cell(12,4,number_format(mysql_result($resultado2,$lineas,"cantidad"),2,".",","),0,'C');	

	   $pdf->Cell(30,4,mysql_result($rs_articulos,0,"ubicaciones.nombre"),0,'L');

	  /*
	  $precio2= number_format(mysql_result($resultado2,$lineas,"precio"),2,".",",");	  
	  $pdf->Cell(15,4,$precio2,0,'R');
	  
	  if (mysql_result($resultado2,$lineas,"dcto")==0) 
	  {
	  $pdf->Cell(15,4,"",0,'C');
	  } 
	  else 
	   { 
		$pdf->Cell(15,4,mysql_result($resultado2,$lineas,"dcto") . " %",0,'C');
	   }
	  
	  $importe2= number_format(mysql_result($resultado2,$lineas,"importe"),2,".",",");	  
	  
	  $pdf->Cell(20,4,$importe2,0,'R');
	  */
	  $pdf->Ln(4);	


	  //vamos acumulando el importe
	 // $importe=$importe + mysql_result($resultado2,$lineas,"importe");
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
	$pdf->Ln(4);		
	$pdf->Cell(66);
	
	$pdf->SetFillColor(255,191,116);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','B',8);
	
	/*
    $pdf->Cell(30,4,"Subtotal",1,0,'C',1);
	$pdf->Cell(30,4,"% IVA",1,0,'C',1);
	$pdf->Cell(30,4,"IVA",1,0,'C',1);	
	$pdf->Cell(35,4,"TOTAL",1,0,'C',1);
	$pdf->Ln(4);
	
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','',8);
	
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
	$pdf->Cell(35,4,$simbolomoneda . $total2,1,0,'R',1);
	$pdf->Ln(4);
	*/

      @mysql_free_result($resultado); 
      @mysql_free_result($query);
	  @mysql_free_result($resultado2); 
	  @mysql_free_result($query3);
          
          
     $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','B',7);	
    
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
		  $pdf->Cell(35,4,"Almacenista",1,0,'C',1);	 
          $pdf->Cell(35,4,utf8_decode("Técnico"),1,0,'C',1);
          $pdf->Cell(35,4,"Recibe",1,0,'C',1);
		  
          $pdf->Ln(4);
          
          $pdf->Cell(1);
	$pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','',7);
          
          $pdf->Cell(35,15,$lafila["full_name"],1,0,'C',1);
		  $pdf->Cell(35,15,"",1,0,'C',1);
		   $pdf->Cell(35,15,utf8_decode("Andres Felipe Muñoz"),1,0,'C',1);
          $pdf->Cell(35,15,$lafila["tec_hardware"],1,0,'C',1);
          $pdf->Cell(35,15,"",1,0,'C',1);
		  

          
          

$pdf->Output();
?> 