<?php

require_once ('fpdf.php') ; 

class PDF extends FPDF
{
//Cabecera de pagina
function Header()
{
    
    $this->Image('./logo/logo_clb.png',10,3,50,15);
	$this->SetFont('times','B',8);
   // $this->Cell(110,5,utf8_decode(''),0,0,'C');
    //$this->Cell(-70,12,'Nit: 830.059.605-1',0,0,0);

	$this->Ln(1);	
}

//Pie de pgina
//function Footer()
//{
//    $this->SetFont('Arial','',6);
//	$this->SetY(-21);
//	$this->Cell(0,10,'UTDVVCC Sistema de Almacen - 2013 ',0,0,'C');
//	$this->SetY(-12);
//    $this->Cell(0,10,'Pagina '.$this->PageNo().'',0,0,'C');	
//}

}
?>
