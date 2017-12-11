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
//if ($fondoguia=="SI") $pdf->Header($imagenguia,20,8,150,0);

$pdf->Ln(10);
//$user= $_SESSION['MM_Username'];

//include ("../conectar.php");
  
$codalbaran=$_GET["codalbaran"]; 
  
$consulta ="SELECT hm.fecha_mto,hm.km_en_momento,hm.km_prox_mant,CONCAT(ma.marca, '-', li.name_linea,'-','Placa:', ve.placa_equipo)AS vehiculo, mant.nom_mto,meca.nom_mecanico,rut.nom_rutina,hm.observacion,hm.solicita,us.full_name, hm.horas_uso
FROM hoja_mantenimiento hm 
LEFT JOIN vehiculos_equipos ve ON ve.id_vehiculo=hm.vehiculos_equipos_id_vehiculo 
LEFT JOIN linea li ON li.idLinea=ve.Linea_idLinea 
LEFT JOIN marca_vehiculo ma ON ma.id_marca=li.marca_vehiculo_id_marca 
LEFT JOIN authuser us ON us.id=hm.id_usuario
LEFT JOIN mecanico_responsable meca ON meca.id_mecanico=hm.mecanico_responsable_id_mecanico 
LEFT JOIN tipo_mantenimiento mant ON mant.id_mto=hm.tipo_mantenimiento_id_mto 
LEFT JOIN rutinas rut ON rut.id_rutina=hm.id_rutina 
WHERE hm.id_hoja_mto='$codalbaran'";
$resultado = mysql_query($consulta, $conexion);
$lafila=mysql_fetch_array($resultado);
//print_r($lafila);

	$pdf->Cell(95);
   // $pdf->Cell(80,4,"",'',0,'C');
    
    $pdf->Ln(4);

    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','B',9);	
	
   

//    $pdf->Cell(95);
//    $pdf->Cell(80,4,"",'LRT',0,'L',1);
//    $pdf->Ln(4);
//	
//    $pdf->Cell(5);
//    $pdf->Cell(70,4,'Centro de Costos:'.$lafila["nombre_ccostos"]. '-'.$lafila["nombre_item_ccostos"] );
//    $pdf->Ln(4);

    $pdf->Cell(80);
    $pdf->Cell(50,5,'HOJA DE MANTENIMIENTO',1,0,'C');
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
//    $pdf->Cell(30,4,"RFC",1,0,'C',1);
//	$pdf->Cell(30,4,"ID centro costos",1,0,'C',1);
        
		$pdf->Cell(20,4,"Fecha",1,0,'C',1);	
		$pdf->Cell(21,4,"Hoja de Mto.",1,0,'C',1);
		 $pdf->Cell(70,4,"Vehiculo",1,0,'C',1);
	
	
       
	$pdf->Ln(4);
	
	$pdf->Cell(1);
	$pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','',7);
	
	$fecha = implota($lafila["fecha_mto"]);
	
//    $pdf->Cell(30,4,$lafila["nif"],1,0,'C',1);
//	$pdf->Cell(30,4,$lafila["id_ccostos"],1,0,'C',1);
      
	$pdf->Cell(20,4,$fecha,1,0,'C',1);	
	$pdf->Cell(21,4,$codalbaran,1,0,'C',1);		
	  $pdf->cell(70,4,$lafila["vehiculo"],1,0,'C',1 );
	
	  $pdf->SetFillColor(255,191,116);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','B',8);
	
	  
	  $pdf->Ln(7);
	  $pdf->Cell(1);
	 
	   
		$pdf->Cell(20,4,"Km Entrada",1,0,'C',1);	
		$pdf->Cell(24,4,("Km Proximo Mto."),1,0,'C',1);
		 $pdf->Cell(25,4,"Tipo Mto.",1,0,'C',1);
		$pdf->Cell(35,4,"Mecanico",1,0,'C',1);
		$pdf->Cell(30,4,"Rutina",1,0,'C',1);
		$pdf->Cell(24,4,("Horas de Uso"),1,0,'C',1);
       
	$pdf->Ln(4);
	
	$pdf->Cell(1);
	$pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','',8);
	
	
	
	$pdf->Cell(20,4,$lafila["km_en_momento"],1,0,'C',1);	
	$pdf->Cell(24,4,$lafila["km_prox_mant"],1,0,'C',1);		
	$pdf->cell(25,4,$lafila["nom_mto"],1,0,'C',1 );
	$pdf->cell(35,4,$lafila["nom_mecanico"],1,0,'C',1 );
	$pdf->cell(30,4,$lafila["nom_rutina"],1,0,'C',1 );
	$pdf->cell(24,4,$lafila["horas_uso"],1,0,'C',1 );
	
	//ahora mostramos las lneas del albarn
	$pdf->Ln(7);		
	$pdf->Cell(1);
	
	$pdf->SetFillColor(255,191,116);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','B',8);
	
    $pdf->Cell(30,4,"Referencia",1,0,'C',1);
	$pdf->Cell(70,4,utf8_decode("Descripción"),1,0,'C',1);
    $pdf->Cell(14,4,"UM",1,0,'C',1);
	$pdf->Cell(20,4,"Cantidad",1,0,'C',1);
	$pdf->Cell(40,4,utf8_decode("Ubicación"),1,0,'C',1);	
	$pdf->Ln(4);
			
			
	$pdf->SetFillColor(224,235,255);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','',7);

	
	$consulta2 = "SELECT * from linea_hoja_mto WHERE hoja_mantenimiento_id_hoja_mto='$codalbaran' ORDER BY id_linea_hoja_mto";
    $resultado2 = mysql_query($consulta2, $conexion);
    
	$contador=1;
	while ($row=mysql_fetch_array($resultado2))
	{
          
	  $pdf->Cell(1);
	  $contador++;
	  $codarticulo=mysql_result($resultado2,$lineas,"codigo");
	  $codfamilia=mysql_result($resultado2,$lineas,"codfamilia");
	  $codubicacion=mysql_result($resultado2,$lineas,"codubicacion");
	  $sel_articulos="SELECT ar.referencia,ar.descripcion,u.nombre,ubi.nombre FROM articulos ar INNER JOIN embalajes u ON u.codembalaje=ar.codembalaje INNER JOIN ubicaciones ubi ON ubi.codubicacion=ar.codubicacion WHERE ar.codarticulo='$codarticulo'";
	  $rs_articulos=mysql_query($sel_articulos);
	  $pdf->Cell(30,4,mysql_result($rs_articulos,0,"ar.referencia"),0,'L');
	  
	  $acotado = substr(mysql_result($rs_articulos,0,"ar.descripcion"), 0, 45);
	  $pdf->Cell(70,4,$acotado,0,'L');
          
          $pdf->Cell(14,4,mysql_result($rs_articulos,0,"u.nombre"),0,'L');
	  
	  $pdf->Cell(20,4,number_format(mysql_result($resultado2,$lineas,"cantidad"),2,".",","),0,'C');	
	  $pdf->Cell(40,4,mysql_result($rs_articulos,0,"ubi.nombre"),0,'L');

	 
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
	$pdf->Ln(4);		
	$pdf->Cell(66);
	
	$pdf->SetFillColor(255,191,116);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','B',8);
	
	$pdf->Ln(4);
	
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','',8);
	
	


      @mysql_free_result($resultado); 
      @mysql_free_result($query);
	  @mysql_free_result($resultado2); 
	  @mysql_free_result($query3);
          
          
     $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','B',8);	
    
    $pdf->Ln(1);
    $pdf->Cell(1);
    $pdf->Cell(175,4,"",'LRT',0,'L',1);
    $pdf->Ln(1);
	
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
		  $pdf->Cell(35,4,"Solicita",1,0,'C',1);
          $pdf->Cell(35,4,"Recibe",1,0,'C',1);
		  
          $pdf->Ln(4);
          
          $pdf->Cell(1);
	$pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','',8);
          
          $pdf->Cell(35,15,$lafila["full_name"],1,0,'C',1);
		  $pdf->Cell(35,15,"Ing.Javier Bejarano",1,0,'C',1);
		  $pdf->Cell(35,15,utf8_decode("Andres Felipe Muñoz"),1,0,'C',1);
          $pdf->Cell(35,15,$lafila["solicita"],1,0,'C',1);
          $pdf->Cell(35,15,$lafila["nom_mecanico"],1,0,'C',1);
		  

$pdf->Output();
?> 