<?php
require('../fpdf.php');
session_start();
$path = getcwd();
$path = str_replace("billing/fpdf/docs", "", $path);

define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/adminController.php"); 

$ctrl=new AdminController();



class PDF extends FPDF
{

// Page header
function Header()
{
    if(!is_numeric ($_GET['bill']))
    {
        echo '<h1>HACKING IS NOT ALLOWED.</h1>'; 
        die();
    }
    $ctrl=new AdminController();
    $conn=$ctrl->getConnection();
    $logo=$ctrl->getLogo();
    $logo=FSPATH.$logo;
    $bill="";
    
    
    $sql = "SELECT * FROM bill where nummer=".$_GET['bill'];
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $bill=$row;
    }

    } else {
        echo "Factuur niet gevonden";
    }
    
    if(is_null($bill['klant']))
    {
        $klant=array();
        $klant['voornaam']="";
        $klant['naam']="";
        $klant['straat']="";
        $klant['city']="";
        
        
    }
    else
    {
        $sql = "SELECT * FROM clients where id=".$bill['klant'];
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                $klant=$row;
            }
        } else {
            echo "Klant niet gevonden";
        }        
    }

    
    $conn->close();
    
    
    $datum=$bill['datum'];
    $soort=$bill['soort'];
    $printS="factuur";
    if(is_null ( $soort ))
    {
        $printS="factuur";    
    }
    elseif($soort=="kas")
    {
        $printS="Offerte";
    }
    elseif($soort=="bon")
    {
        $printS="bestelbon";
    }
    elseif($soort=="factuur")
    {
        $printS="factuur";
    }
    $datum= explode(" ", $datum);
    $datum=$datum[0];
    $row=explode("-", $datum);
    $jaar=$row[0];
    $maand=$row[1];
    $dag=$row[2];
    $datum=$dag.'/'.$maand.'/'.$jaar;
    $verval=$jaar.'-'.$maand.'-'.$dag;
    $verval =date('Y-m-d', strtotime($verval. ' + 14 days'));
    $row=explode("-", $verval);
    $verval=$row[2].'/'.$row[1].'/'.$row[0];
    
    $ctrl=new AdminController();
    $conn=$ctrl->getConnection();
    $company= array();
    $sql = "SELECT * FROM Gegevens order by id";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        array_push($company,$row);
    }

    } else {
        echo "Bedrijfsgegevens niet gevonden";
    }
    
    
    $conn->close();
    
    
	// Logo
	$this->Image($logo,10,6,30);
	// Arial bold 15
	$this->SetFont('Arial','B',15);
	// Move to the right
	$this->Cell(80);
	// Title
	$this->Cell(30,10,$printS,0,0,'C');
	$this->SetFont('Arial','',10);
	// Line break
	$this->Ln(25);
	// Title
	$this->Cell(0,10,$company[0]['waarde'],0,0,'L');
	$this->Cell(0,10,$klant['voornaam']." ".$klant['naam'],0,0,'R');
	// Line break
	$this->Ln(5);
	// Title
	$this->Cell(0,10,$company[5]['waarde'].' '.$company[6]['waarde'].' '.$company[7]['waarde'].' '.$company[8]['waarde'].' '.$company[9]['waarde'],0,0,'L');
	$this->Cell(0,10,$klant['straat']." ".$klant['city'],0,0,'R');
	$this->Ln(5);
	$this->Cell(0,10,"BTW:".$company[10]['waarde'],0,0,'L');
	$this->Cell(0,10,"BTW:".$klant['BTW'],0,0,'R');
	$this->Ln(5);
	$this->Cell(0,10,'  ',0,0,'L');
	$this->Cell(0,10,' ',0,0,'R');
	// Line break
	$this->Ln(20);
	$this->Cell(45,6,"Plaats: ".$company[9]['waarde'],1,0,'C');
	$this->Cell(45,6,"datum: ".$datum,1,0,'C');
	$this->Cell(45,6,"Vervaldatum: ".$verval,1,0,'C');
	$this->Cell(45,6,"Factuurnummer: ".$bill['nummer'],1,0,'C');
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

    $ctrl=new AdminController();
    $conn=$ctrl->getConnection();

    $sql = "SELECT * FROM bill_post where factuur=".$_GET['bill'];
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
    // output data of each row
    $regels= array();
    while($row = mysqli_fetch_assoc($result)) {
       array_push($regels,$row);
    }

    } else {
        echo "POST NIET GEVONDEN";
    }
    
    $sql = "SELECT * FROM bill where nummer=".$_GET['bill'];
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $bill=$row;
    }

    } else {
        echo "FACTUUR NIET GEVONDEN";
    }

    $conn->close();


// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Ln(10);

$total=0;
foreach ($regels as &$value) {
    $pdf->Ln(10);
    $pdf->Cell(90,6,"".$value["omschrijving"],1,0,'L');
    $pdf->Cell(90,6,$value["bedrag"]." EUR",1,0,'R');
    $total=$total+$value["bedrag"];
}

$pdf->Ln(10);
$pdf->Cell(90,6,"TOTAAL",1,0,'L');
$pdf->Cell(90,6,$total.' EUR',1,0,'R');

$ctrl=new AdminController();
    $conn=$ctrl->getConnection();
    $company= array();
    $sql = "SELECT * FROM Gegevens order by id";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        array_push($company,$row);
    }

    } else {
        echo "Bedrijfsgegevens niet gevonden";
    }
    
    
    $conn->close();

if($bill['btw']==21)
{
    $btw=$total*1.21;
    $btw=$btw-$total;
    $pdf->Ln(10);
    $pdf->Cell(90,6,"BTW (21%)",1,0,'L');
    $pdf->Cell(90,6,$btw.' EUR',1,0,'R');
    
    $pdf->Ln(8);
    $pdf->Cell(90,6,"Te betalen",1,0,'L');
    $pdf->Cell(90,6,$total+$btw. " EUR",1,0,'R');
}

if($bill['btw']==6)
{
    $btw=$total*1.06;
    $btw=$btw-$total;
    $pdf->Ln(10);
    $pdf->Cell(90,6,"BTW (6%)",1,0,'L');
    $pdf->Cell(90,6,$btw.' EUR',1,0,'R');
    
    $pdf->Ln(8);
    $pdf->Cell(90,6,"Te betalen",1,0,'L');
    $pdf->Cell(90,6,$total+$btw. " EUR",1,0,'R');
}

if($bill['btw']=='marge')
{

    $pdf->Ln(10);
    $pdf->Cell(180,6,"BTW MARGEREGELING",0,0,'C');
   
}

if($bill['btw']=='vrij')
{

    $pdf->Ln(10);
    $pdf->Cell(180,6,"Kleine onderneming onderworpen aan de vrijstellingsregeling van belasting. BTW niet toepasselijk.",0,0,'C');
   
}


if($bill['pay']=='cash')
{
    $pdf->Ln(10);
    $pdf->Cell(180,6,"Betaling cash ontvangen",0,0,'C');
}

if($bill['pay']=='overschrijving')
{
     $datum=$bill['datum'];
    $datum= explode(" ", $datum);
    $datum=$datum[0];
    $row=explode("-", $datum);
    $jaar=$row[0];
    $maand=$row[1];
    $dag=$row[2];
    $Fnummer=$dag.'-'.$maand.'-'.$jaar."-".$bill['nummer'];
    
    $pdf->Ln(10);
    $pdf->Cell(180,6,"Betaling binnen de 14 dagen op ons rekenningnumer ".$company[11]['waarde'],0,0,'C');
        $pdf->Ln(10);
    $pdf->Cell(180,6,"t.a.v. ".$company[0]['waarde']." met vermelding van nummer: ".$Fnummer,0,0,'C');
}


$pdf->Output();
?>
