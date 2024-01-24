<?php
require('../fpdf.php');

class PDF extends FPDF
{




// Page header
function Header()
{


	$usernameDb = "mobile_express_";
	$passwordDb = "E9EGWx3M";
	$hostname = "mobile-express.be.mysql";
	$dbname = "mobile_express_";


	$id=3;
	if(!is_null($_POST['id']))
	{
		if(is_numeric($_POST['id']))
		{
			$item="";

			// Create connection
			$conn = new mysqli($hostname, $usernameDb, $passwordDb, $dbname);
// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}

			$sql = "SELECT * FROM clients_balance where id=".$_POST['id'];

			$result = mysqli_query($conn, $sql);

			if (mysqli_num_rows($result) > 0) {



				// output data of each row
				while($row = mysqli_fetch_assoc($result)) {
					$item=$row;
				}

			} else {
				echo "0 results";
			}

			$conn->close();


//KIES DE BEHANDELING.

			if($_POST["treat"])
			{


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
				$this->Cell(0,10,$item['voornaam']." ".$item['naam'],0,0,'R');
				// Line break
				$this->Ln(5);
				// Title
				$this->Cell(0,10,'Vissenakensesteenweg 21 Bunsbeek',0,0,'L');
				$this->Cell(0,10,$item['straat']." ".$item['city'],0,0,'R');
				$this->Ln(5);
				$this->Cell(0,10,'BE 05 5292.4744 ',0,0,'L');
				$this->Cell(0,10,$item['BTW'],0,0,'R');



				$verval = date("d/m/Y", mktime(0, 0, 0, date("m"), date("d")+14, date("Y")));



				// Line break
				$this->Ln(20);
				$this->Cell(45,6,"Plaats: BUNSBEEK",1,0,'C');
				$this->Cell(45,6,"datum: ".date("d/m/Y"),1,0,'C');
				$this->Cell(45,6,"Vervaldatum: ".$verval,1,0,'C');
				$this->Cell(45,6,"Factuurnummer: XXX",1,0,'C');
			}
			else
			{


				$behandelingen=array();

				// Create connection
				$conn = new mysqli($hostname, $usernameDb, $passwordDb, $dbname);
// Check connection
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				}

				$sql = "SELECT * FROM price_balance";

				$result = mysqli_query($conn, $sql);

				if (mysqli_num_rows($result) > 0) {



					// output data of each row
					while($row = mysqli_fetch_assoc($result)) {
						array_push($behandelingen,$row);
					}

				} else {
					echo "0 results";
				}

				$conn->close();


				echo '
				<div>
                    <script type="text/javascript">
                            google_ad_client = "ca-pub-3598185186227907";
                            google_ad_slot = "4603323478";
                            google_ad_width = 300;
                            google_ad_height = 250;
                    </script>
                    <!-- Extra -->
                    <script type="text/javascript" src="//pagead2.googlesyndication.com/pagead/show_ads.js">
                    </script>
                    
                    
                    ';
				echo '

                   
                </div>
                    ';

				echo '
		<div>

<form method="post">';
				echo '<div style="margin: 12px;"><label>Kies de behandeling</label></div>';
				echo '<div style="margin: 12px;"><select name="treat">';
				foreach ($behandelingen as &$value) {
					echo "<option name='id' value='".$value["id"]."'>".$value["naam"];
					echo "</option>";
				}
				echo "</select></div>";
				echo '<input type="hidden" name="id" value="'.$_POST['id'].'" />';
				echo '<div style="margin: 12px;"><button>Volgende</button></div>';
				echo '</form>


</div>
';


			}


		}
	}
	else{

		$item=array();

		// Create connection
		$conn = new mysqli($hostname, $usernameDb, $passwordDb, $dbname);
// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		$sql = "SELECT * FROM clients_balance";

		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {



			// output data of each row
			while($row = mysqli_fetch_assoc($result)) {
				array_push($item,$row);
			}

		} else {
			echo "0 results";
		}

		$conn->close();


		echo '
				<div>
                    <script type="text/javascript">
                            google_ad_client = "ca-pub-3598185186227907";
                            google_ad_slot = "4603323478";
                            google_ad_width = 300;
                            google_ad_height = 250;
                    </script>
                    <!-- Extra -->
                    <script type="text/javascript" src="//pagead2.googlesyndication.com/pagead/show_ads.js">
                    </script>
                    
                    
                    ';
		echo '

                   
                </div>
                    ';

		echo '
		<div>

<form method="post">';
		echo '<div style="margin: 12px;"><label>Kies de klant</label></div>';
		echo '<div style="margin: 12px;"><select name="id">';
		foreach ($item as &$value) {
			echo "<option name='id' value='".$value["id"]."'>".$value['voornaam']." ".$value["naam"]." - ".$value["email"];
			echo "</option>";
		}
		echo "</select></div>";
		echo '<div style="margin: 12px;"><button>Volgende</button></div>';
		echo '</form>


</div>
';



	}

	//
	// Line break
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





if($_POST['treat'])
{

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

	$sql = "SELECT * FROM price_balance where id=".$_POST['treat'];

	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {



		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			$item=$row;
		}

	} else {
		echo "0 results";
	}

	$conn->close();
}


// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();



$pdf->Ln(20);
$pdf->Cell(90,6,"Behandeling: ".$item["naam"],1,0,'L');
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
