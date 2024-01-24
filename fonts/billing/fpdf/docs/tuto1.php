<?php

require('../fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(80);
// Title
// $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
$pdf->Cell(30,10,'OFFERTE',0,0,'C');


// Logo
$this->Image('logo.png',10,6,30);


$pdf->Output();


?>

