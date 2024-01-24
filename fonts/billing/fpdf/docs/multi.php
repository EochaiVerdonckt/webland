<?php
require('../fpdf.php');

class PDF extends FPDF
{


// Page header
    function Header()
    {


    }


// Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
        // Line break
        $this->Ln(5);
        $this->Cell(0, 10, 'Copyright ' . date('Y') . ' Mobile-Express all rights reserved', 0, 0, 'C');
    }
}

$usernameDb = "mobile_express_";
$passwordDb = "E9EGWx3M";
$hostname = "mobile-express.be.mysql";
$dbname = "mobile_express_";


if(!is_null($_POST['id']) && is_numeric($_POST['id'])) {

    $klant =  getClient($hostname,$usernameDb,$passwordDb,$dbname);


    // STAP 2 KIES HET AANTAL BEHANDELINGEN
    if($_POST['aantal'])
    {
        $aantal = $_POST['aantal'];

        // STAP 3 KIES DE BEHANDELINGEN
        if($_POST["comform"])
        {
            // STAP 4 ZET DE BEHANDELINGEN IN DE DB
            $nummer = saveBill($hostname,$usernameDb,$passwordDb,$dbname);
            $behandelingen = getBehandelingen($nummer,$hostname, $usernameDb, $passwordDb, $dbname);
            render($klant, $nummer,$behandelingen);
        }
        else
        {
            chose_treats($hostname,$usernameDb,$passwordDb,$dbname);
        }
    }
    else
    {
        chose_amount();
    }
}
else
{
    chose_client();
}

function chose_treats($hostname,$usernameDb,$passwordDb,$dbname)
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

    echo  '<form method="post">';
					echo '<div style="margin: 12px;"><label>Kies de behandeling</label></div>';
					;

					for ($x = 0; $x < $_POST["aantal"]; $x++) {
						echo '<div style="margin: 12px;">';
						echo '<select name="treat'.$x.'">';
						foreach ($behandelingen as &$value) {
							echo "<option name='id' value='".$value["id"]."'>".$value["naam"];
							echo "</option>";
						}
						echo "</select>";
						echo "</div>";
					}

					echo '<input type="hidden" name="id" value="'.$_POST['id'].'" />';
					echo "<input type='hidden' name='aantal' value='".$_POST['aantal']."'/>";

					echo "<input type='hidden' name='comform' value='true'/>";
					echo '<div style="margin: 12px;"><button>Volgende</button></div>';
					echo '</form>';
}

function getClient($hostname,$usernameDb,$passwordDb,$dbname)
{
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
            $klant=$row;
        }

    } else {
        echo "0 results";
    }

    $conn->close();
    return $klant;
}

function saveBill($hostname,$usernameDb,$passwordDb,$dbname)
{

    $conn = new mysqli($hostname, $usernameDb, $passwordDb, $dbname);
    $sql = "INSERT INTO `bill_balance`( `klantid`,  `hasMulti`) VALUES ('" . $_POST["id"] . "',1)";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['input'] = "New record created successfully";
        $last = $conn->insert_id;


    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();


    for ($x = 0; $x < $_POST['aantal']; $x++) {

        $loper = "treat" . $x;
        // Create connection
        $conn = new mysqli($hostname, $usernameDb, $passwordDb, $dbname);
// Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }


        $sql = "INSERT INTO `behandeling_bill_balance`( `behandeling`, `factuur`) VALUES ('" . $_POST[$loper] . "'," . $last . ")";
        if ($conn->query($sql) === TRUE) {
            $_SESSION['input'] = "New record created successfully";


        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
    return $last;
}
//STAP 1 KIES DE KLANT
function chose_client()
{
    $usernameDb = "mobile_express_";
    $passwordDb = "E9EGWx3M";
    $hostname = "mobile-express.be.mysql";
    $dbname = "mobile_express_";

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

// STAP 2 KIES HET AANTAL BEHANDELINGEN
function chose_amount()
{
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
    echo '<div style="margin: 12px;"><label>Aantal behandelingen</label></div>';
    echo '<div style="margin: 12px;">';
    echo  '<input type="number"  name="aantal" value="1" required=""/>';
    echo  '<input type="hidden"  name="id" value="'.$_POST['id'].'" />';
    echo "</div>";
    echo '<div style="margin: 12px;"><button>Volgende</button></div>';
    echo '</form>


</div>
';
}


function render($klant, $nummer,$behandelingen)
{
    // Instanciation of inherited class
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();

    // Logo
    $pdf->Image('logo.png',10,6,30);
    // Arial bold 15
    $pdf->SetFont('Arial','B',15);
    // Move to the right
    $pdf->Cell(80);
    // Title
    $pdf->Cell(30,10,'FACTUUR',0,0,'C');

    $pdf->SetFont('Arial','',10);
    // Line break
    $pdf->Ln(5);
    // Title
    $pdf->Cell(0,10,'BEAUTIFULL BALANCE',0,0,'L');
    $pdf->Cell(0,10,$klant['voornaam']." ".$klant['naam'],0,0,'R');
    // Line break
    $pdf->Ln(5);
    // Title
    $pdf->Cell(0,10,'Vissenakensesteenweg 21 Bunsbeek',0,0,'L');
    $pdf->Cell(0,10,$klant['straat']." ".$klant['city'],0,0,'R');
    $pdf->Ln(5);
    $pdf->Cell(0,10,'BE 05 5292.4744 ',0,0,'L');
    $pdf->Cell(0,10,$klant['BTW'],0,0,'R');



    $verval = date("d/m/Y", mktime(0, 0, 0, date("m"), date("d")+14, date("Y")));



    // Line break
    $pdf->Ln(20);
    $pdf->Cell(45,6,"Plaats: BUNSBEEK",1,0,'C');
    $pdf->Cell(45,6,"datum: ".date("d/m/Y"),1,0,'C');
    $pdf->Cell(45,6,"Vervaldatum: ".$verval,1,0,'C');
    $pdf->Cell(45,6,"Factuurnummer: ".$nummer,1,0,'C');

    $pdf->Ln(12);
    $tot = 0;


    foreach ($behandelingen as &$value) {
        $pdf->Ln(8);
        $pdf->Cell(90,6,"Behandeling: ".$value["naam"],1,0,'L');
        $pdf->Cell(90,6,$value["bedrag"]." EUR",1,0,'R');
        $tot= $tot+$value["bedrag"];

    }





    $pdf->Ln(12);
    $pdf->Cell(90,6,"Totaal",1,0,'L');
    $pdf->Cell(90,6,$tot. " EUR",1,0,'R');
    $btw= $tot*0.21;
    $pdf->Ln(8);
    $pdf->Cell(90,6,"BTW (21%)",1,0,'L');
    $pdf->Cell(90,6,$btw. " EUR",1,0,'R');

    $pdf->Ln(10);
    $pdf->Cell(180,6,"Betaling cash ontvangen",0,0,'C');

    $pdf->Output();
}


function getBehandelingen($nummer,$hostname, $usernameDb, $passwordDb, $dbname)
{

    $behandelingen = array();

    // Create connection
    $conn = new mysqli($hostname, $usernameDb, $passwordDb, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM `price_balance` WHERE id IN (SELECT behandeling FROM `behandeling_bill_balance` WHERE factuur = ".$nummer." )";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {



        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
           array_push($behandelingen, $row);
        }

    } else {
        echo "0 results";
    }

    $conn->close();
    return $behandelingen;
}
//STAP 5 RENDER DE PDF
