<?php
require('../fpdf.php');

class PDF extends FPDF
{




// Page header
function Header()
{

	if(is_null($_POST['id']))
	{
		echo "SOMTHING WNET WRONG";
	}

	if(!is_numeric($_POST['id']))
	{
		echo "SOMTHING WNET WRONG";
	}

	$usernameDb = "mobile_express_";
	$passwordDb = "E9EGWx3M";
	$hostname = "mobile-express.be.mysql";
	$dbname = "mobile_express_";


	// Create connection
	$conn = new mysqli($hostname, $usernameDb, $passwordDb, $dbname);
// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$sql = "SELECT * FROM `bill_balance` WHERE YEAR(created) = YEAR(CURRENT_DATE) AND id=".$_POST['id'];

	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {

		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {


			// Create connection
			$conn = new mysqli($hostname, $usernameDb, $passwordDb, $dbname);
// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}

			$sql = "SELECT * FROM `clients_balance` WHERE id=".$row['klantid'];

			$result = mysqli_query($conn, $sql);
			while($row2 = mysqli_fetch_assoc($result)) {


				$date= explode(" ",$row['created']);
				$date=$date[0];
				$date= explode("-",$date);
				$date=$date[2]."/".$date[1]."/".$date[0];



				// Create connection
				$conn = new mysqli($hostname, $usernameDb, $passwordDb, $dbname);
// Check connection
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				}

				if($row['hasFree']==0)
				{
					$sql = "SELECT * FROM `price_balance` WHERE id=".$row['behandeling'];
				}
				else
				{

					$sql = "SELECT * FROM `facto_balance` WHERE factuur=".$row['id'];
				}

				$result = mysqli_query($conn, $sql);
				while($row3 = mysqli_fetch_assoc($result)) {


					$vnaam=$row2['voornaam'];
					$naam=$row2['naam'];
					$email= $row2['email'];


					// Logo
					$this->Image('logo.png',10,6,30);
					// Arial bold 15
					$this->SetFont('Arial','B',15);
					// Move to the right
					$this->Cell(80);
					// Title
					$this->Cell(30,10,'FACTUUR',0,0,'C');

					$this->SetFont('Arial','',10);
					// Line break
					$this->Ln(5);
					// Title
					$this->Cell(0,10,'BEAUTIFULL BALANCE',0,0,'L');
					$this->Cell(0,10,$vnaam." ".$naam,0,0,'R');
					// Line break
					$this->Ln(5);
					// Title
					$this->Cell(0,10,'Vissenakensesteenweg 21 Bunsbeek',0,0,'L');
					$this->Cell(0,10,$row2['straat']." ".$row2['city'],0,0,'R');
					$this->Ln(5);
					$this->Cell(0,10,'BE 05 5292.4744 ',0,0,'L');
					$this->Cell(0,10,$row2['BTW'],0,0,'R');



					$verval = date("d/m/Y", mktime(0, 0, 0, date("m"), date("d")+14, date("Y")));



					// Line break
					$this->Ln(20);
					$this->Cell(45,6,"Plaats: BUNSBEEK",1,0,'C');
					$this->Cell(45,6,"datum: ".$date,1,0,'C');
					$this->Cell(45,6,"Vervaldatum: ".$verval,1,0,'C');
					$this->Cell(45,6,"Factuurnummer: ".$_POST['id'],1,0,'C');

				}


			}




		}


	} else {
		echo "0 results";
	}

	$conn->close();
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
	// Line break
	$this->Ln(5);
	$this->Cell(0,10,'Copyright '.date('Y').' Mobile-Express all rights reserved',0,0,'C');
}
}



$usernameDb = "mobile_express_";
$passwordDb = "E9EGWx3M";
$hostname = "mobile-express.be.mysql";
$dbname = "mobile_express_";
$item="";

// Create connection
$conn = new mysqli($hostname, $usernameDb, $passwordDb, $dbname);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM `bill_balance` WHERE YEAR(created) = YEAR(CURRENT_DATE) AND id=".$_POST['id'];

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {

	// output data of each row
	while($row = mysqli_fetch_assoc($result)) {


		// Create connection
		$conn = new mysqli($hostname, $usernameDb, $passwordDb, $dbname);
// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		$sql = "SELECT * FROM `clients_balance` WHERE id=".$row['klantid'];

		$result = mysqli_query($conn, $sql);
		while($row2 = mysqli_fetch_assoc($result)) {


			$date= explode(" ",$row['created']);
			$date=$date[0];
			$date= explode("-",$date);
			$date=$date[2]."/".$date[1]."/".$date[0];



			// Create connection
			$conn = new mysqli($hostname, $usernameDb, $passwordDb, $dbname);
// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}

			if($row['hasFree']==0)
			{
				$sql = "SELECT * FROM `price_balance` WHERE id=".$row['behandeling'];
			}
			else
			{

				$sql = "SELECT * FROM `facto_balance` WHERE factuur=".$row['id'];
			}


			$result = mysqli_query($conn, $sql);
			while($row3 = mysqli_fetch_assoc($result)) {
				$item=$row3;

			}
		}
	}


} else {
	echo "0 results";
}

$conn->close();




// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();



$pdf->Ln(20);
$pdf->Cell(90,6,"".$item["naam"],1,0,'L');
$pdf->Cell(90,6,$item["bedrag"]." EUR",1,0,'R');


$pdf->Ln(8);
$pdf->Cell(90,6,"Totaal",1,0,'L');
$pdf->Cell(90,6,$item["bedrag"]. " EUR",1,0,'R');


$btw= $item['bedrag']*0.21;
$pdf->Ln(20);
$pdf->Cell(90,6,"BTW (21%)",1,0,'L');
$pdf->Cell(90,6,$btw. " EUR",1,0,'R');



$pdf->Ln(10);
$pdf->Cell(180,6,"Betaling cash ontvangen",0,0,'C');

$pdf->Output();
?>
