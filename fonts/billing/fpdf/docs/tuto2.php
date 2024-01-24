<?php
require('../fpdf.php');

class PDF extends FPDF
{




// Page header
function Header()
{

	//
	//
//
//3010 Kessel-Lo
//
	// Logo
	$this->Image('logo.png',10,6,30);
	// Arial bold 15
	$this->SetFont('Arial','B',15);
	// Move to the right
	$this->Cell(80);
	// Title
	$this->Cell(30,10,'FACTUUR',0,0,'C');

	$this->SetFont('Arial','',10);

	// Title
	$this->Cell(0,10,'BEAUTIFULL BALANCE',0,0,'R');
	// Line break
	$this->Ln(5);

	$this->SetFont('Arial','B',15);
	// Move to the right
	$this->Cell(80);
	$this->SetTextColor(255,255,255);
	// Title
	$this->Cell(30,10,'OFFERTE',0,0,'C');

	$this->SetTextColor(0,0,0);
	$this->SetFont('Arial','',10);
	// Title
	$this->Cell(0,10,'Vissenakensesteenweg ',0,0,'R');

	// Line break
	$this->Ln(5);
	$this->SetFont('Arial','B',15);
	// Move to the right
	$this->Cell(80);
	$this->SetTextColor(255,255,255);
	// Title
	$this->Cell(30,10,'OFFERTE',0,0,'R');

	$this->SetTextColor(0,0,0);
	$this->SetFont('Arial','',10);
	$this->Cell(0,10,'21 Bunsbeek',0,0,'R');


	$this->SetFont('Arial','B',15);
	// Move to the right
	$this->Cell(80);
	$this->SetTextColor(255,255,255);
	// Title
	$this->Cell(30,10,'OFFERTE',0,0,'R');

	// Line break
	$this->Ln(5);
	$this->SetTextColor(0,0,0);
	$this->SetFont('Arial','',10);
	$this->Cell(0,10,'BE 05 5292.4744 ',0,0,'R');


	$this->SetFont('Arial','B',15);
	// Move to the right
	$this->Cell(80);
	$this->SetTextColor(255,255,255);
	// Title
	$this->Cell(30,10,'OFFERTE',0,0,'R');

	// Line break
	$this->Ln(5);
	$this->SetTextColor(0,0,0);
	$this->SetFont('Arial','',10);
	$this->Cell(0,10,'',0,0,'R');


	// Line break
	$this->Ln(20);
	$this->Cell(60,6,"Plaats: BUNSBEEK",1,0,'C');
	$this->Cell(60,6,"datum: ".date("d/m/Y"),1,0,'C');
	$this->Cell(60,6,"Factuurnummer: XXX",1,0,'C');

	//
	// Line break
	$this->Ln(20);





}




// Page footer
function Footer()
{
	// Position at 1.5 cm from bottom
	$this->SetY(-15);
	// Arial italic 8
	$this->SetFont('Arial','I',8);
	// Page number
	$this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);


$pdf->SetFont('Arial','B',15);
// Move to the right
$pdf->Cell(80);
// Title
$pdf->Cell(30,10,'Uw gegevens',0,0,'C');
// Line break
$pdf->Ln(20);
$pdf->SetFont('Arial','',10);
$pdf->Cell(20,6,"Thomas"." Janssens",0,0,'L');
$pdf->Ln(5);
$pdf->Cell(20,6,"Dorpstraat 1A 3010 Kessel-lo",0,0,'L');
$pdf->Ln(5);
$pdf->Cell(20,6,"Thomas@test.com"." 016/46.XX.XX",0,0,'L');
$pdf->Ln(5);
$pdf->Cell(20,6,"btw-nummer",0,0,'L');
$pdf->Ln(20);
$pdf->Cell(90,6,"Massagerug",1,0,'C');
$pdf->Cell(90,6,"30 EUR",1,0,'C');


$pdf->Ln(5);
$pdf->Cell(90,6,"Totaal",1,0,'C');
$pdf->Cell(90,6,"30 EUR",1,0,'C');

$pdf->Ln(20);
$pdf->Cell(90,6,"BTW (21%)",1,0,'C');
$pdf->Cell(90,6,"4,21 EUR",1,0,'C');

$pdf->Output();
?>
