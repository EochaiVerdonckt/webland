<?php session_start();
include_once "functions.php";


if(is_null($_SESSION['progress']))
{
    $_SESSION['progress']=5;
}

$progress=$_SESSION['progress'];

function print_header_slot()
{
    $url= "login_FB.png";
    echo '<div style=" background-color: white; width: 20%;background-image: url(".$url."); padding-bottom: 20%; padding-right: 20px;background-repeat:no-repeat;"></div>';
}


function print_header_website()
{
    echo '

    <!--HEADER-->
    <div class="row" style="border-bottom: 1px solid black;" id="header">
        <div class="col-lg-2 col-md-2 col-sm-2">
            <a href="/">
                <img src="/logo.png" alt="Mobile Express logo" id="logo"/>
            </a>
        </div>

        <div class="col-lg-10 col-md-10 col-sm-10">
                        <i class="fa fa-round fa-facebook" onclick="window.location=\\\'https://www.facebook.com/Mobile-Express-566716116804062/\\\';"></i>
                        
                        
        </div >   
             <div style = "position: absolute; right: 4%; top: 1%;" >
                                <i id = "sluit"  class="fa fa-times fa-3x" style = " border: 1px solid #204d74;   color: #204d74;cursor: pointer;margin-top: 2%; background-color:#ededed; padding: 10px; display: none;" onclick = "linkAction1()" ></i >
                            <i id = "open"  class="fa fa-bars fa-3x" style = "border: 1px solid #204d74; color: #204d74; cursor: pointer;margin-top: 2%;  background-color:#ededed; padding: 10px; " onclick = "linkAction2()" ></i >
                        </div >
                    <script >
                         function linkAction1()
                        {
                            $("#sluit").fadeOut(function(){
                                   $("#open").fadeIn(); 
                            });
                            
                            $("#navigatie").animate({
                                 height: \'toggle\'
                            });
                            
                            
                        }
                        function linkAction2()
                        {
                            $("#open").fadeOut(function(){
                                 $("#sluit").fadeIn();   
                            });
                            
                            $("#navigatie").animate({
                                 height: \'toggle\'
                            });
                            
                        }
                    </script >
     </div >
                      
    <div class="header-triangle" ></div >    
    </div >
    
    
    <div style="display: none;    background-color: #FEC;" id="navigatie">
    
    <div class="row">
        <div class="col-lg-2 col-lg-offset-1" style="margin-top: 4%; margin-bottom: 4%;"">
                <a id="contactLink" href="/contact.php" type="button" class="btn btn-default  btn-block">
                    <span>CONTACT</span>
                </a>
        </div>
              
 
        
        <div class="col-lg-2 " style="margin-top: 4%;">
            <a id="webLink" type="button" class="btn btn-default btn-block" href="/website.php">
                <span>DESIGN</span>
            </a>
        </div>
        
        <div class="col-lg-2" style="margin-top: 4%; margin-bottom: 4%;"">
                <a id="ipTvLink" href="/tv" type="button" class="btn btn-default btn-block">
                    <span>IP TV</span>
                </a>
        </div>
        
        
        <div class="col-lg-2" style="margin-top: 4%; margin-bottom: 4%;">
            <a href="/dataRecovery.php" type="button" class="btn btn-default btn-block" id="dataRecLink">
                <span>DATA</span>
            </a>
        </div>
        <div class="col-lg-2" style="margin-top: 4%; margin-bottom: 4%;">
            <a href="/camera.php" type="button" class="btn btn-default btn-block" id="cameraLink">
                <span>CAMERA BEWAKING</span>
            </a>
        </div>
           <div class="shelf">

  <div class="bookend_left"></div>
	<div class="bookend_right"></div>
	<div class="reflection"></div>
    </div>
 

</div>
</div>
';


}

function make_logo()
{
    echo '  <div  style="border-right: 1px solid white;text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black;">
        <h1 class="text-center" style="margin-top:0; padding-top:2%;"><i class="fa fa-paint-brush" style="text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black; color: #FEC;"></i> Ik heb een logo </h1>
    </div>';
    echo '  
            <div class="row" style="padding-bottom: 2%; margin-left: 15%; margin-right: 15%;" >
                <form  method="post">    
                <input type="hidden" name="logo" value="nee"/>
                <button class="btn-success btn-lg btn-block" value="NEE">Nee</button>
                </form>
            </div>
            
            <div class="row" style="padding-bottom: 2%; margin-left: 15%; margin-right: 15%;">
                <form  method="post">
                    <input type="hidden" name="logo" value="ja"/>
                    <button class="btn btn-danger  btn-lg  btn-block" value="JA">JA</button>
                </form>
                
            </div>
               
</div>';
}

function stappenteller($progress)
{
    if (is_null($_SESSION['account'])) {
        make_account();
    } else if (is_null($_SESSION['logo'])) {
        if ($_POST['logo']) {
            $_SESSION['logo'] = $_POST['logo'];
            $progress=10;
            chose_colors();
        } else {
            $progress=10;
            make_logo();
        }
    }
    else if (is_null($_SESSION['kleur1'])) {
        if ($_POST['kleur1']) {
            $_SESSION['kleur1'] = $_POST['kleur1'];
            $_SESSION['kleur2'] = $_POST['kleur2'];
            $_SESSION['kleur3'] = $_POST['kleur3'];
            $progress=10;
            make_project();
        } else {
            $progress=10;
            chose_colors();
        }
    }
    else if (is_null($_SESSION['namePrject'])) {
        if(is_null($_POST['projectName'])) {
            $progress=20;
            make_project();
        }
        else {
            $_SESSION['namePrject'] = $_POST['projectName'];
            $progress=20;
            make_slogan();
        }
    }
    else if (is_null($_SESSION['slogan'])) {
        if(is_null($_POST['slogan'])) {
            $progress=30;
            make_project();
        }
        else {
            $_SESSION['slogan'] = $_POST['slogan'];
            $progress=30;
            make_idea();
        }
    }
    else if (is_null($_SESSION['projectDesc']))
    {
        if(is_null($_POST['projectDesc'])) {
            $progress=40;
            make_project();
        }
        else {
            $_SESSION['projectDesc'] = $_POST['projectDesc'];
            $progress=40;
            make_status();
        }
    }
    else if (is_null($_SESSION['projectStatus']))
    {
        if(is_null($_POST['projectStatus'])) {
            $progress=50;
            make_status();
        }
        else {
            $_SESSION['projectStatus'] = $_POST['projectStatus'];
            $progress=50;
            make_customers();
        }
    }
    else if (is_null($_SESSION['client']))
    {
        if(is_null($_POST['client'])) {
            $progress=60;
            make_customers();
        }
        else {
            $_SESSION['client'] = $_POST['client'];
            $progress=60;
            make_concurentie();
        }
    }
    else if (is_null($_SESSION['concurentie']))
    {
        if(is_null($_POST['concurentie'])) {
            $progress=70;
            make_concurentie();
        }
        else {
            $_SESSION['concurentie'] = $_POST['concurentie'];
            $progress=70;
            make_power();
        }
    }
    else if (is_null($_SESSION['power'])) {
        if(is_null($_POST['power'])) {
            $progress=80;
            make_power();
        }
        else {
            $_SESSION['power'] = $_POST['power'];
            $progress=80;
            make_weak();
        }
    }
    else if (is_null($_SESSION['weak'])) {
        if(is_null($_POST['weak'])) {
            $progress=85;
            make_weak();
        }
        else {
            $_SESSION['weak'] = $_POST['weak'];
            $progress=85;
            make_earn();
        }
    }
    else if (is_null($_SESSION['earn'])) {
        if(is_null($_POST['earn'])) {
            $progress=90;
            make_earn();
        }
        else {
            $_SESSION['earn'] = $_POST['earn'];
            $progress=1000;
            make_sector();
        }
    }
    else if (is_null($_SESSION['sector'])) {
        if(is_null($_POST['sector'])) {
            $progress=100;
            make_sector();
        }
        else {
            $_SESSION['sector'] = $_POST['sector'];
            $progress=100;
            finish();
        }
    }
    else
    {
        $progress=100;
        finish();
        $_SESSION['progress']=100;
    }
    $_SESSION['progress']= $progress;

}
function finish()
{
    echo '  <div  style="border-right: 1px solid white;text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black;">
        <h1 class="text-center" style="margin-top:2%; padding-top:2%;"><i class="fa fa-book" style="text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black; color: #FEC;"></i> Je offerte is verzonden. </h1>
        <h4 class="text-center" style="margin-top:2%; padding-top:2%;"> We nemen spoedig contact met u op. </h4>
        
    </div>';



    echo '  <div  style="border-right: 1px solid white;text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black;">
        <h4 class="text-center" style="margin-top:2%; padding-top:2%;"><i class="fa fa-user" style="text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black; color: #FEC;"></i> Gegevens</h4>
    </div>';

    $vzw= "nee";


    if(!is_null($_SESSION['account']['vehicle']))
    {
        $vzw= "ja";
    }
    echo '<table id="offerte" class="text-center" align="center">';
    echo '<tr>';
    echo '<th class="offerteCell">';
    echo 'Naam';
    echo '</th>';
    echo '<th class="offerteCell">';
    echo 'Familienaam';
    echo '</th>';
    echo '<th class="offerteCell">';
    echo 'mail';
    echo '</th>';
    echo '<th class="offerteCell">';
    echo 'adres';
    echo '</th>';
    echo '<th class="offerteCell">';
    echo 'gemeente';
    echo '</th>';
    echo '<th class="offerteCell">';
    echo 'telefoon';
    echo '</th>';
    echo '<th class="offerteCell">';
    echo 'btw-nummer';
    echo '</th>';
    echo '<th class="offerteCell">';
    echo 'sector';
    echo '</th>';
    echo '<th class="offerteCell">';
    echo 'vzw';
    echo '</th>';
    echo '</tr><tr>';
    echo '<td class="offerteCell">';
    echo $_SESSION ["account"]['naam'];
    echo '</td>';
    echo '<td class="offerteCell">';
    echo $_SESSION ["account"]['achternaam'];
    echo '</td>';
    echo '<td class="offerteCell">';
    echo $_SESSION ["account"]['mail'];
    echo '</td>';
    echo '<td class="offerteCell">';
    echo $_SESSION ["account"]['straat'];
    echo '</td>';
    echo '<td class="offerteCell">';
    echo $_SESSION ["account"]['city'];
    echo '</td>';
    echo '<td class="offerteCell">';
    echo $_SESSION ["account"]['phone'];
    echo '</td>';
    echo '<td class="offerteCell">';
    echo $_SESSION ["account"]['btw'];
    echo '</td>';
    echo '<td class="offerteCell">';
    echo $_SESSION ["sector"];
    echo '</td>';
    echo '<td class="offerteCell">';
    echo $vzw;
    echo '</td>';
    echo '</tr>';
    echo '</table>';


    echo '  <div  style="border-right: 1px solid white;text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black;">
        <h4 class="text-center" style="margin-top:0; padding-top:2%;"><i class="fa fa-paint-brush" style="text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black; color: #FEC;"></i> Creatief profiel</h4>
    </div>';


    echo '<table  class="text-center" align="center">';
    echo '<tr>';
    echo '<th class="offerteCell">';
    echo 'logo';
    echo '</th>';
    echo '<th class="offerteCell">';
    echo 'kleur1';
    echo '</th>';
    echo '<th class="offerteCell">';
    echo 'kleur2';
    echo '</th>';
    echo '<th class="offerteCell">';
    echo 'kleur3';
    echo '</th>';
    echo '</tr><tr>';
    echo '<td class="offerteCell">';
    echo $_SESSION ["logo"];
    echo '</td>';
    echo '<td class="offerteCell" style="background-color: '.$_SESSION ["kleur1"].'">';
    echo $_SESSION ["kleur1"];
    echo '</td>';
    echo '<td class="offerteCell" style="background-color: '.$_SESSION ["kleur2"].'">';
    echo $_SESSION ["kleur2"];
    echo '</td>';
    echo '<td class="offerteCell" style="background-color: '.$_SESSION ["kleur3"].'">';
    echo $_SESSION ["kleur3"];
    echo '</td>';

    echo '</tr>';
    echo '</table>';

    echo '  <div  style="border-right: 1px solid white;text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black;">
        <h4 class="text-center" style="margin-top:0; padding-top:2%;"><i class="fa fa-bank" style="text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black; color: #FEC;"></i> Business plan</h4>
    </div>';



    echo '<table  class="text-center" align="center">';
    echo '<tr>';
    echo '<th class="offerteCell">';
    echo 'Sterktes';
    echo '</th>';
    echo '<th class="offerteCell">';
    echo 'Zwaktes';
    echo '</th>';
    echo '<th class="offerteCell">';
    echo 'Verdienmodel';
    echo '</th>';
    echo '<th class="offerteCell">';
    echo 'Klanten';
    echo '</th>';
    echo '<th class="offerteCell">';
    echo 'Concurrentie';
    echo '</th>';
    echo '<th class="offerteCell">';
    echo 'Status';
    echo '</th>';
    echo '</tr><tr>';
    echo '<td class="offerteCell">';
    echo $_SESSION ["power"];
    echo '</td>';
    echo '<td class="offerteCell">';
    echo $_SESSION ["weak"];
    echo '</td>';
    echo '<td class="offerteCell" >';
    echo $_SESSION ["earn"];
    echo '</td>';
    echo '<td class="offerteCell" >';
    echo $_SESSION ["client"];
    echo '</td>';
    echo '<td class="offerteCell" >';
    echo $_SESSION ["concurentie"];
    echo '</td>';
    echo '<td class="offerteCell" >';
    echo $_SESSION ["projectStatus"];
    echo '</td>';


    echo '</tr>';
    echo '</table>';

    echo '  <div  style="border-right: 1px solid white;text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black;">
        <h4 class="text-center" style="margin-top:0; padding-top:2%;"><i class="fa fa-briefcase" style="text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black; color: #FEC;"></i> Je project</h4>
    </div>';






    echo '<table  class="text-center" align="center">';
    echo '<tr>';
    echo '<th class="offerteCell">';
    echo 'Naam';
    echo '</th>';
    echo '<th class="offerteCell">';
    echo 'Slogan';
    echo '</th>';
    echo '<th class="offerteCell">';
    echo 'Beschrijving';
    echo '</th>';

    echo '</tr><tr>';
    echo '<td class="offerteCell">';
    echo $_SESSION ["namePrject"];
    echo '</td>';
    echo '<td class="offerteCell">';
    echo $_SESSION ["slogan"];
    echo '</td>';
    echo '<td class="offerteCell" >';
    echo $_SESSION ["projectDesc"] ;
    echo '</td>';
    echo '</tr>';
    echo '</table>';


    echo '  <div  style="border-right: 1px solid white;text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black;">
        <h4 class="text-center" style="margin-top:0; padding-top:2%;"><i class="fa fa-tag" style="text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black; color: #FEC;"></i> Prijzen</h4>
    </div>';




    echo '<table  class="text-center" align="center">';
    echo '<tr>';
    echo '<th class="offerteCell">';
    echo 'Ontwerp website (voorschot)';
    echo '</th>';
    echo '<th class="offerteCell">';
    echo 'Ontwerp logo';
    echo '</th>';
    echo '<th class="offerteCell">';
    echo 'jaarlijkse kosten';
    echo '</th>';
    echo '<th class="offerteCell">';
    echo 'Looptijd contract ';
    echo '</th>';
    echo '<th class="offerteCell">';
    echo 'Korting éénmalige betaling';
    echo '</th>';
    echo '<th class="offerteCell">';
    echo 'SEO (Google)';
    echo '</th>';
    echo '</tr><tr>';
    echo '<td class="offerteCell">';
    echo "250€";
    echo '</td>';
    echo '<td class="offerteCell">';
    echo "85€";
    echo '</td>';
    echo '<td class="offerteCell" >';
    echo "130€";
    echo '</td>';
    echo '<td class="offerteCell" >';
    echo "5 jaar";
    echo '</td>';
    echo '<td class="offerteCell" >';
    echo "-50€";
    echo '</td>';
    echo '<td class="offerteCell" >';
    echo "0€";
    echo '</td>';


    echo '</tr>';
    echo '</table>';



        echo '  <div  style="border-right: 1px solid white;text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black;">
        <h4 class="text-center" style="margin-top:0; padding-top:2%;"><i class="fa fa-puzzle-piece" style="text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black; color: #FEC;"></i> Stappen plan</h4>
    </div>';


    echo '<table  class="text-center" align="center">';
    echo '<tr>';
    echo '<th class="offerteCell">';
    echo 'Offerte verzonden';
    echo '</th>';
    echo '<th class="offerteCell">';
    echo 'Logo ontvangen';
    echo '</th>';
    echo '<th class="offerteCell">';
    echo 'Thema ontwerpen';
    echo '</th>';
    echo '<th class="offerteCell">';
    echo 'Website klaar ';
    echo '</th>';
    echo '<th class="offerteCell">';
    echo 'Domein naam online';
    echo '</th>';
    echo '<th class="offerteCell">';
    echo 'SEO (Google)';
    echo '</th>';
    echo '</tr><tr>';
    echo '<td class="offerteCell">';
    echo '<i class="fa fa-check" style="text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black; color: darkgreen;"></i>';
    echo '</td>';
    echo '<td class="offerteCell">';
    echo '<i class="fa fa-close" style="text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black; color: darkred;"></i>';
    echo '</td>';
    echo '<td class="offerteCell" >';
    echo '<i class="fa fa-close" style="text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black; color: darkred;"></i>';
    echo '</td>';
    echo '<td class="offerteCell" >';
    echo '<i class="fa fa-close" style="text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black; color: darkred;"></i>';
    echo '</td>';
    echo '<td class="offerteCell" >';
    echo '<i class="fa fa-close" style="text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black; color: darkred;"></i>';
    echo '</td>';
    echo '<td class="offerteCell" >';
    echo '<i class="fa fa-close" style="text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black; color: darkred;"></i>';
    echo '</td>';


    echo '</tr>';
    echo '</table>';

    echo '  <div  style="border-right: 1px solid white;text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black;">
        <h4 class="text-center" style="margin-top:0; padding-top:2%;"><i class="fa fa-tags" style="text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black; color: #FEC;"></i> Overzicht</h4>
    </div>';




    echo '<table  class="text-center" align="center">';
    echo '<tr>';
    echo '<th class="offerteCell">';
    echo 'Jaar 1';
    echo '</th>';
    echo '<th class="offerteCell">';
    echo 'Jaar 2';
    echo '</th>';
    echo '<th class="offerteCell">';
    echo 'Jaar3 ';
    echo '</th>';
    echo '<th class="offerteCell">';
    echo 'Jaar 4';
    echo '</th>';
    echo '<th class="offerteCell">';
    echo 'Jaar 5';
    echo '</th>';

    echo '</tr><tr>';
    echo '<td class="offerteCell">';
    echo "465€";
    echo '</td>';
    echo '<td class="offerteCell">';
    echo "130€";
    echo '</td>';
    echo '<td class="offerteCell" >';
    echo "130€";
    echo '</td>';
    echo '<td class="offerteCell" >';
    echo "130€";
    echo '</td>';
    echo '<td class="offerteCell" >';
    echo "130€";
    echo '</td>';
    echo '</tr>';
    echo '</table>';

    echo '  <div  style="border-right: 1px solid white;text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black;">
        <h6 class="text-center" style="margin-top:0;padding-top: 20px; ">Je eigen website kost bij concurenten gemmideld €1625 op 5jaar.</h6>
    </div>';

    echo '  <div  style="border-right: 1px solid white;text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black;">
        <h6 class="text-center" style="margin-top:0;"> Totaal: €985 Totaal éénmalige betaling: €935 (btw exclu)</h6>
    </div>';

    echo '  <div  style="border-right: 1px solid white;text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black;">
        <h6 class="text-center" style="margin-top:0;"> Bespaar vandaag nog €690</h6>
    </div>';





    $usernameDb = "mobile_express_";
    $passwordDb = "E9EGWx3M";
    $hostname = "mobile-express.be.mysql";
    $dbname = "mobile_express_";

    // Create connection
    $conn = mysqli_connect($hostname, $usernameDb, $passwordDb, $dbname);
// Check connection
    if (!$conn) {
        die("Binnenkort beschikbaar, Connection failed: " . mysqli_connect_error());
    }

    if($vzw=='ja')
    {
        $vzw=1;
    }
    else
    {
        $vzw=0;
    }
    $sql = "INSERT INTO `klant`( `naam`, `Fnaam`, `mail`, `adres`, `gemeente`, `tel`, `btw`, `sector`, `vzw`) 
                VALUES ('".$_SESSION ["account"]['naam']."','".$_SESSION ["account"]['achternaam']."','".$_SESSION ["account"]['mail']."','".$_SESSION ["account"]['straat']."','".$_SESSION ["account"]['city']."','".$_SESSION ["account"]['phone']."','".$_SESSION ["account"]['btw']."','".$_SESSION ["sector"]."','".$vzw."')";

    if ($conn->query($sql) === TRUE) {
        $klant_id = $conn->insert_id;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();



    // Create connection
    $conn = mysqli_connect($hostname, $usernameDb, $passwordDb, $dbname);
// Check connection
    if (!$conn) {
        die("Binnenkort beschikbaar, Connection failed: " . mysqli_connect_error());
    }


    $sql = "INSERT INTO `project`(`klantid`, `naam`, `slogan`, `beschrijving`) VALUES (".$klant_id.",'".$_SESSION ["namePrject"]."','".$_SESSION ["slogan"]."','".$_SESSION ["projectDesc"]."')";

    if ($conn->query($sql) === TRUE) {
        $pooject_id = $conn->insert_id;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();



    // Create connection
    $conn = mysqli_connect($hostname, $usernameDb, $passwordDb, $dbname);
// Check connection
    if (!$conn) {
        die("Binnenkort beschikbaar, Connection failed: " . mysqli_connect_error());
    }

    if($_SESSION ["logo"]=='ja')
    {
        $logo=1;
    }
    else{
        $logo=0;
    }
    $sql = "INSERT INTO `creatiefProfiel`( `klantid`, `logo`, `kleur1`, `kleur2`, `kleur3`) 
              VALUES (".$klant_id.",".$logo.",'". $_SESSION ["kleur1"]."','". $_SESSION ["kleur2"]."','". $_SESSION ["kleur3"]."')";

    if ($conn->query($sql) === TRUE) {
        $profiel_id = $conn->insert_id;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();


    //

    // Create connection
    $conn = mysqli_connect($hostname, $usernameDb, $passwordDb, $dbname);
// Check connection
    if (!$conn) {
        die("Binnenkort beschikbaar, Connection failed: " . mysqli_connect_error());
    }

    if($_SESSION ["logo"]=='ja')
    {
        $logo=1;
    }
    else{
        $logo=0;
    }
    $sql = "INSERT INTO `plan`( `klantid`, `sterk`, `zwak`, `winst`, `klanten`, `status`, `concurrentie`) 
                    VALUES (".$klant_id.",'".$_SESSION ["power"]."','".$_SESSION ["weak"]."','".$_SESSION ["earn"]."','".$_SESSION ["client"]."','".$_SESSION ["projectStatus"]."','".$_SESSION ["concurentie"]."')";

    if ($conn->query($sql) === TRUE) {
        $plan_id = $conn->insert_id;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();


    //

    // Create connection
    $conn = mysqli_connect($hostname, $usernameDb, $passwordDb, $dbname);
// Check connection
    if (!$conn) {
        die("Binnenkort beschikbaar, Connection failed: " . mysqli_connect_error());
    }

    $sql = "INSERT INTO `steps`( `klantid`) VALUES (".$klant_id.")";

    if ($conn->query($sql) === TRUE) {
        $steps_id = $conn->insert_id;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();



    // Create connection
    $conn = mysqli_connect($hostname, $usernameDb, $passwordDb, $dbname);
// Check connection
    if (!$conn) {
        die("Binnenkort beschikbaar, Connection failed: " . mysqli_connect_error());
    }

    $sql = "INSERT INTO `offerte`( `klantid`, `verkoper`, `stap`, `plan`, `profiel`) VALUES (".$klant_id.",'".'EOghain'."',". $steps_id.",".$plan_id.",".$profiel_id.")";

    if ($conn->query($sql) === TRUE) {
        // the message
        $msg = "Nieuwe offerte \nt";

// use wordwrap() if lines are longer than 70 characters
        $msg = wordwrap($msg,70);

// send email
        mail("e.verdonckt@live.com","Nieuwe offerte",$msg);
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

    echo '
            <form action="http://mobile-express.be/fpdf/tutorial/tuto2.php">
                <button>Bekijk je offerte</button>
            </form>
            
            
         ';

}
function make_sector()
{
    echo '    <div  style="border-right: 1px solid white;text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black;">
        <h1 class="text-center" style="margin-top:2%; padding-top:2%;"><i class="fa fa-bullhorn" style="text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black; color: #FEC;"></i> Sector</h1>
    </div>';


    echo '
        <div class="row" style="padding-bottom: 2%; margin-left: 15%; margin-right: 15%; padding-top: 2%;" >
                <form  method="post">    
                    <input type="hidden" name="sector" value="Grondstoffen of voedsel leveren"/>
                    <button style="margin-top: 2%;" class="btn btn-block btn-lg btn-success"> Grondstoffen of voedsel leveren</button>
                 </form>
                  <form  method="post">    
                    <input type="hidden" name="sector" value="Grondstoffen verwerken, produceren"/>
                    <button style="margin-top: 2%;" class="btn btn-block btn-lg btn-success">Grondstoffen verwerken, produceren</button>
                 </form>
                  <form  method="post">    
                    <input type="hidden" name="sector" value="Diensten verlenen aan bedrijven"/>
                    <button style="margin-top: 2%;" class="btn btn-block btn-lg btn-success">Diensten verlenen aan bedrijven</button>
                 </form>
                  <form  method="post">    
                    <input type="hidden" name="sector" value="Verkoop van goederen of diensten"/>
                     <button style="margin-top: 2%;" class="btn btn-block btn-lg btn-success">Verkoop van goederen of diensten</button>
                 </form>
                  <form  method="post">    
                    <input type="hidden" name="sector" value="Dienstverlening zonder winstoogmerk."/>
                    <button style="margin-top: 2%;" class="btn btn-block btn-lg btn-success">Dienstverlening zonder winstoogmerk.</button>
                 </form>
            </div>
';
}

function make_earn()
{
    echo '
    <div  style="border-right: 1px solid white;text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black;">
        <h1 class="text-center" style="margin-top:2%; padding-top:2%;"><i class="fa fa-bullhorn" style="text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black; color: #FEC;"></i> Verdienmodel</h1>
        <h3 class="text-center" style="margin-top:2%; padding-top:2%;"> Hoe ga je winst maken.</h3>
    </div>';

    echo '
        <div class="row" style="padding-bottom: 2%; margin-left: 15%; margin-right: 15%; padding-top: 2%;" >
                <form  method="post">    
                <textarea  class=" form-control" name="earn" placeholder="Schrijf er gerust op los."></textarea>
                <button style="margin-top: 2%;" class="btn btn-block btn-lg btn-success">Volgende</button>
                </form>
            </div>         
';
}
function make_weak()
{
    echo ' <div  style="border-right: 1px solid white;text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black;">
        <h1 class="text-center" style="margin-top:2%; padding-top:2%;"><i class="fa fa-bullhorn" style="text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black; color: #FEC;"></i> Zwaktes van mijn project</h1>
    </div>
';
    echo '
        <div class="row" style="padding-bottom: 2%; margin-left: 15%; margin-right: 15%; padding-top: 2%;" >
                <form  method="post">    
                <textarea  class=" form-control" name="weak" placeholder="Schrijf er gerust op los."></textarea>
                <button style="margin-top: 2%;" class="btn btn-block btn-lg btn-success">Volgende</button>
                </form>
            </div>
            
           
';
}
function make_power()
{
    echo '  <div  style="border-right: 1px solid white;text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black;">
        <h1 class="text-center" style="margin-top:2%; padding-top:2%;"><i class="fa fa-bullhorn" style="text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black; color: #FEC;"></i> Sterktes van mijn project</h1>
    </div>';

    echo '
        <div class="row" style="padding-bottom: 2%; margin-left: 15%; margin-right: 15%; padding-top: 2%;" >
                <form  method="post">    
                <textarea  class=" form-control" name="power" placeholder="Schrijf er gerust op los."></textarea>
                <button style="margin-top: 2%;" class="btn btn-block btn-lg btn-success">Volgende</button>
                </form>
            </div>
            
           
';
}
function make_concurentie()
{
    echo '    <div  style="border-right: 1px solid white;text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black;">
        <h1 class="text-center" style="margin-top:2%; padding-top:2%;"><i class="fa fa-bullhorn" style="text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black; color: #FEC;"></i> Concurrentie</h1>
    </div>';

    echo '
        <div class="row" style="padding-bottom: 2%; margin-left: 15%; margin-right: 15%; padding-top: 2%;" >
                <form  method="post">    
                <textarea  class=" form-control" name="concurentie" placeholder="Schrijf er gerust op los."></textarea>
                <button style="margin-top: 2%;" class="btn btn-block btn-lg btn-success">Volgende</button>
                </form>
            </div>   
';
}
function make_customers()
{
    echo '
    <div  style="border-right: 1px solid white;text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black;">
        <h1 class="text-center" style="margin-top:2%; padding-top:2%;"><i class="fa fa-bullhorn" style="text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black; color: #FEC;"></i> Doelgroepen</h1>
        <h3 class="text-center" style="margin-top:2%; padding-top:2%;"> Wie worden je klanten.</h3>
    </div>';


    echo '
        <div class="row" style="padding-bottom: 2%; margin-left: 15%; margin-right: 15%; padding-top: 2%;" >
                <form  method="post">    
                <textarea  class=" form-control" name="client" placeholder="Schrijf er gerust op los."></textarea>
                <button style="margin-top: 2%;" class="btn btn-block btn-lg btn-success">Volgende</button>
                </form>
            </div>          
';

}
function make_status()
{
    echo '
    <div  style="border-right: 1px solid white;text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black;">
        <h1 class="text-center" style="margin-top:2%; padding-top:2%;"><i class="fa fa-bullhorn" style="text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black; color: #FEC;"></i> Stand van zaken</h1>
    </div>';

    echo '
        <div class="row" style="padding-bottom: 2%; margin-left: 15%; margin-right: 15%; padding-top: 2%;" >
                <form  method="post">    
                <textarea  class=" form-control" name="projectStatus" placeholder="Schrijf er gerust op los."></textarea>
                <button style="margin-top: 2%;" class="btn btn-block btn-lg btn-success">Volgende</button>
                </form>
            </div>
            
           
';

}

function make_idea()
{
    echo '
    <div  style="border-right: 1px solid white;text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black;">
        <h1 class="text-center" style="margin-top:2%; padding-top:2%;"><i class="fa fa-bullhorn" style="text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black; color: #FEC;"></i> Beschrijf je idee</h1>
    </div>';
    echo '
        <div class="row" style="padding-bottom: 2%; margin-left: 15%; margin-right: 15%; padding-top: 2%;" >
                <form  method="post">    
                <textarea  class=" form-control" name="projectDesc" placeholder="Schrijf er gerust op los."></textarea>
                <button style="margin-top: 2%;" class="btn btn-block btn-lg btn-success">Volgende</button>
                </form>
            </div>
            
           
';
}
function make_slogan()
{
    echo '

    <div  style="border-right: 1px solid white;text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black;">
        <h1 class="text-center" style="margin-top:2%; padding-top:2%;"><i class="fa fa-bullhorn" style="text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black; color: #FEC;"></i> Geef een slogan</h1>
    </div>';
    echo '
        <div class="row" style="padding-bottom: 2%; margin-left: 15%; margin-right: 15%; padding-top: 2%;" >
                <form method="post">    
                <input type="text" class=" form-control" name="slogan"/>
                <button style="margin-top: 2%;" class="btn btn-block btn-lg btn-success">Volgende</button>
                </form>
            </div>
            
           
';
}
function make_project()
{
    echo '
    <div  style="border-right: 1px solid white;text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black;">
        <h1 class="text-center" style="margin-top:2%; padding-top:2%;"><i class="fa fa-bullhorn" style="text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black; color: #FEC;"></i> Geef je project een naam.</h1>
    </div>';
    echo '
        <div class="row" style="padding-bottom: 2%; margin-left: 15%; margin-right: 15%; padding-top: 2%;" >
                <form  method="post">    
                <input type="text" class=" form-control" name="projectName"/>
                <button style="margin-top: 2%;" class="btn btn-block btn-lg btn-success">Volgende</button>
                </form>
            </div> ';
}
function chose_colors()
{
    echo '   <div  style="border-right: 1px solid white;text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black;">
        <h1 class="text-center" style="margin-top:0; padding-top:2%;"><i class="fa fa-paint-brush" style="text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black; color: #FEC;"></i> 3 kleuren die me aanspreken. </h1>
    </div>';

    echo '
         <form  method="post">
        <div class="row text-center" style="padding-bottom: 2%;">
                    <input type="color-picker" value="" name="kleur1"/>
                    <input type="color-picker" value="" name="kleur2"/>
                    <input type="color-picker" value="" name="kleur3"/>
                   
        </div>
        <div class="row text-center" style="padding-bottom: 2%; padding-left: 15%; padding-right: 15%;">
   
                <button class="btn btn-block btn-success">VOLGENDE</button>
          
            
        </div>
          </form>
        <script>
            PICKER = {
    mouse_inside: false,

    to_hex: function (dec) {
        hex = dec.toString(16);
        return hex.length == 2 ? hex : \'0\' + hex;
    },

    show: function () {
        var input = $(this);
        var position = input.offset();

        PICKER.$colors  = $(\'<canvas width="230" height="150" ></canvas>\');
        PICKER.$colors.css({
            \'position\': \'absolute\',
            \'top\': position.top + input.height() + 9,
            \'left\': position.left,
            \'cursor\': \'crosshair\',
            \'display\': \'none\'
        });
        $(\'body\').append(PICKER.$colors.fadeIn());
        PICKER.colorctx = PICKER.$colors[0].getContext(\'2d\');

        PICKER.render();

        PICKER.$colors
            .click(function (e) {
                var new_color = PICKER.get_color(e);
                $(input).css({\'background-color\': new_color}).val(new_color).trigger(\'change\').removeClass(\'color-picker-binded\');
                PICKER.close();
            })
            .hover(function () {
                PICKER.mouse_inside=true;
            }, function () {
                PICKER.mouse_inside=false;
            });

        $("body").mouseup(function () {
            if (!PICKER.mouse_is_inside) PICKER.close();
        });
    },

    bind_inputs: function () {
        $(\'input[type="color-picker"]\').not(\'.color-picker-binded\').each(function () {
            $(this).click(PICKER.show);
        }).addClass(\'color-picker-binded\');
    },

    close: function () {PICKER.$colors.fadeOut(PICKER.$colors.remove);},

    get_color: function (e) {
        var pos_x = e.pageX - PICKER.$colors.offset().left;
        var pos_y = e.pageY - PICKER.$colors.offset().top;

        data = PICKER.colorctx.getImageData(pos_x, pos_y, 1, 1).data;
        return \'#\' + PICKER.to_hex(data[0]) + PICKER.to_hex(data[1]) + PICKER.to_hex(data[2]);
    },

  // Build Color palette
    render: function () {
        var gradient = PICKER.colorctx.createLinearGradient(0, 0, PICKER.$colors.width(), 0);

        // Create color gradient
        gradient.addColorStop(0,    "rgb(255,   0,   0)");
        gradient.addColorStop(0.15, "rgb(255,   0, 255)");
        gradient.addColorStop(0.33, "rgb(0,     0, 255)");
        gradient.addColorStop(0.49, "rgb(0,   255, 255)");
        gradient.addColorStop(0.67, "rgb(0,   255,   0)");
        gradient.addColorStop(0.84, "rgb(255, 255,   0)");
        gradient.addColorStop(1,    "rgb(255,   0,   0)");

        // Apply gradient to canvas
        PICKER.colorctx.fillStyle = gradient;
        PICKER.colorctx.fillRect(0, 0, PICKER.colorctx.canvas.width, PICKER.colorctx.canvas.height);

        // Create semi transparent gradient (white -> trans. -> black)
        gradient = PICKER.colorctx.createLinearGradient(0, 0, 0, PICKER.$colors.height());
        gradient.addColorStop(0,   "rgba(255, 255, 255, 1)");
        gradient.addColorStop(0.5, "rgba(255, 255, 255, 0)");
        gradient.addColorStop(0.5, "rgba(0,     0,   0, 0)");
        gradient.addColorStop(1,   "rgba(0,     0,   0, 1)");

        // Apply gradient to canvas
        PICKER.colorctx.fillStyle = gradient;
        PICKER.colorctx.fillRect(0, 0, PICKER.colorctx.canvas.width, PICKER.colorctx.canvas.height);
    }
};

PICKER.bind_inputs();
        </script>
';

    echo "  <div class=\"row text-center\">
        <div class=\"col-lg-2 col-md-2 col-sm-2 \">
                <h1><i class=\"fa fa-star fa-3x\" style=\"color: red;\"></i></h1>
                <h2>Rood</h2>
                <h6>Aggressie, belangrijk, passie</h6>
        </div>
        <div class=\"col-lg-2 col-md-2 col-sm-2 \">
            <h1><i class=\"fa fa-star fa-3x\" style=\"color: orange;\"></i></h1>
            <h2>Oranje</h2>
            <h6>Energie, speels, betaalbaar</h6>
        </div>
        <div class=\"col-lg-2 col-md-2 col-sm-2 \">
            <h1><i class=\"fa fa-star fa-3x\" style=\"color: yellow;\"></i></h1>
            <h2>Geel</h2>
            <h6>Vrolijk, Geluk, Humor</h6>
        </div>
        <div class=\"col-lg-2 col-md-2 col-sm-2 \">
            <h1><i class=\"fa fa-star fa-3x\" style=\"color: green;\"></i></h1>
            <h2>Groen</h2>
            <h6>Natuur, success, Groei</h6>
        </div>
        <div class=\"col-lg-2 col-md-2 col-sm-2 \">
            <h1><i class=\"fa fa-star fa-3x\" style=\"color: darkblue;\"></i></h1>
            <h2>Blauw</h2>
            <h6>Relaxatie, vertrouwen, comfort</h6>
        </div>
        <div class=\"col-lg-2 col-md-2 col-sm-2 \">
            <h1><i class=\"fa fa-star fa-3x\" style=\"color: mediumpurple;\"></i></h1>
            <h2>Paars</h2>
            <h6>Luxe, misterie, romantiek</h6>
        </div>

    </div>";
}
function make_account()
{

    if($_POST)
    {
        $_SESSION['account']=$_POST;
        make_logo();
    }
    else
    {
        print_account();
    }
}
function print_account()
{
    echo '  <div  style="border-right: 1px solid white;text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black;">
            <h1 class="text-center" style="margin-top:0; padding-top:2%;"><i class="fa fa-user" style="text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black; color: #FEC;"></i> Gegevens </h1>
        </div>';
            echo '<div class="row" style="padding-top: 2%">
            <div class="col-lg-8 col-md-8 col-sm-8 col-lg-offset-2 col-md-offset-2 col-sm-offset-2" style="border-right: 1px solid white;">
                <div  style="text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black;">

                </div>
                <form method="post">
                    <label>Voornaam*</label>
                    <input id="naam" name="naam" type="text" class="form-control" placeholder="Jhon" style="margin-bottom: 1%;" required>
                    <label>Achternaam*</label>
                    <input id="achternaam" name="achternaam" type="text" class="form-control" placeholder="Smith" style="margin-bottom: 1%;" required>
                    <label>E-mail*</label>
                    <input id="mail" name="mail" type="email" class="form-control" placeholder="example@apple.com" style="margin-bottom: 1%;" required>

                    <label>Straat+nummer</label>
                    <input id="straat" name="straat" type="text" class="form-control" placeholder="wetstraat 27B" style="margin-bottom: 1%;">
                    <label>Postcode+gemeente</label>
                    <input id="city" name="city" type="text" class="form-control" placeholder="1000 Brussel" style="margin-bottom: 1%;">
                    <label>Telefoon</label>
                    <input id="phone" name="phone" type="text" class="form-control" placeholder="Telefoonnummer" style="margin-bottom: 1%;">

                    <label>BTW nummer</label>
                    <input id="btw" name="btw" type="text" class="form-control" placeholder="BTW nummer" style="margin-bottom: 1%;">
                    <input style="margin-bottom: 1%;" type="checkbox" name="vehicle" value="Car"> Non profit, vzw of burgerinitiatief

                    <!--
                    
                    -->
                    <input type="submit" class="btn btn-success btn-block" value="VOLGENDE" style="margin-bottom: 1%; margin-top: 1%;">
                   <span>Je gegevens worden niet doorverkocht, zijn versleuteld en worden enkel gebruikt om je te leren kennen.</span>
                </form>
            </div>

           

        </div>';


}
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Mobile Express | Tevreden klanten daar gaan we voor.</title>
    <!-- JS SCRIPTS -->
    <script src="/jquery.min.js"></script>
    <script src="/bootstrap.min.js"></script>
    <script src="/owl.carousel.min.js"></script>
    <script src="angular.min.js"></script>
    <script src="/behaviour.js"></script>
    <script src="app.js"></script>
    <script src="wizardController.js"></script>


    <!-- CSS STYLES -->
    <link rel="stylesheet" type="text/css" href="/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/owl.carousel.css">
    <link href="/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="/style.css">
    <meta name="description" content="Hier kan je je smartphone of tablet laten herstellen, supersnel en goedkoop"/>
</head>
<body>

    <script>


        // This is called with the results from from FB.getLoginStatus().
        function statusChangeCallback(response) {
            console.log('statusChangeCallback');
            console.log(response);
            // The response object is returned with a status field that lets the
            // app know the current login status of the person.
            // Full docs on the response object can be found in the documentation
            // for FB.getLoginStatus().
            if (response.status === 'connected') {
                // Logged into your app and Facebook.
                testAPI();
            } else if (response.status === 'not_authorized') {
                // The person is logged into Facebook, but not your app.
                document.getElementById('status').innerHTML = 'Please log ' +
                    'into this app.';
            } else {
                // The person is not logged into Facebook, so we're not sure if
                // they are logged into this app or not.
                document.getElementById('status').innerHTML = 'Please log ' +
                    'into Facebook.';
            }
        }

        // This function is called when someone finishes with the Login
        // Button.  See the onlogin handler attached to it in the sample
        // code below.
        function checkLoginState() {
            FB.getLoginStatus(function(response) {
                statusChangeCallback(response);
            });
        }


        window.fbAsyncInit = function() {
            FB.init({
                appId      : '858516014274586',
                cookie     : true,  // enable cookies to allow the server to access
                                    // the session
                xfbml      : true,  // parse social plugins on this page
                version    : 'v2.5' // use graph api version 2.5
            });

            // Now that we've initialized the JavaScript SDK, we call
            // FB.getLoginStatus().  This function gets the state of the
            // person visiting this page and can return one of three states to
            // the callback you provide.  They can be:
            //
            // 1. Logged into your app ('connected')
            // 2. Logged into Facebook, but not your app ('not_authorized')
            // 3. Not logged into Facebook and can't tell if they are logged into
            //    your app or not.
            //
            // These three cases are handled in the callback function.

            FB.getLoginStatus(function(response) {
                statusChangeCallback(response);
            });

        };

        // Load the SDK asynchronously
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

        // Here we run a very simple test of the Graph API after login is
        // successful.  See statusChangeCallback() for when this call is made.
        function testAPI() {
            console.log('Welcome!  Fetching your information.... ');
            FB.api('/me', function(response) {
                console.log('Successful login for: ' + response.name);
                document.getElementById('status').innerHTML =
                    'Thanks for logging in, ' + response.name + '!';
                FB.api('/me', function(response) {
                    console.log(JSON.stringify(response));
                });
            });
        }

    </script>



<div class="container-fluid ">
    <?php print_header_website(); ?>

    <!--FIRST SLIDE-->
    <div class="blauw">
        <div style="padding-top: 5%;">
            <h1 style="margin-bottom: 5%; text-align: center;"><span>Onze wizard tovert sites en apps voor iedereen.</span></h1>
            <div style="margin-left: 20%; margin-right: 20%;  background-color: white;

  -webkit-box-shadow:
     0px 0px 0px 2px rgba(0,0,0,0.6),
                0px 0px 0px 14px #fff,
                0px 0px 0px 18px rgba(0,0,0,0.2),
                6px 6px 8px 17px #555;

     -moz-box-shadow:
     0px 0px 0px 2px rgba(0,0,0,0.6),
                0px 0px 0px 14px #fff,
                0px 0px 0px 18px rgba(0,0,0,0.2),
                6px 6px 8px 17px #555;

          box-shadow:
     0px 0px 0px 2px rgba(0,0,0,0.6),
                0px 0px 0px 14px #fff,
                0px 0px 0px 18px rgba(0,0,0,0.2),
                6px 6px 8px 17px #555;"">
            <div class="progress" style="    border-radius: 0;">
                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="<?php echo $progress;?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $progress;?>%">

                </div>

            </div>

        </div>
        </div>




    <?php  stappenteller($progress); ?>
    <div style="display:none;"id="status">
    </div>
    <!--

   -->




        <div class="row" style="border-top: 1px solid white;">
            <div class="text-center">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <h3><i class="fa fa-calculator"></i> Goedkoop</h3>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 ">
                    <h3><i class="fa fa-clock-o"></i> Snel</h3>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 ">
                    <h3><i class="fa fa-smile-o"></i> Kwaliteit gegarandeerd</h3>
                </div>
            </div>
        </div>
    </div>


    <!--FOOTER-->
    <div class="row">
        <div class="text-center ruimte-top">
            <p>Copyright © Mobile Express 2015 All rights reserved</p>
        </div>
    </div>
    <div class="row ruimte-bottom">
        <div class="col-lg-4 col-md-4 col-sm-4 col-lg-offset-2 col-md-offset-2 col-sm-offset-2">
            <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/3.0/"><img
                    alt="Creative Commons License" style="border-width:0"
                    src="https://i.creativecommons.org/l/by-nc-nd/3.0/88x31.png"/></a><a rel="license"
                                                                                         href="http://creativecommons.org/licenses/by-nc-nd/3.0/"></a>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-lg-offset-2 col-md-offset-2 col-sm-offset-2">

        </div>
    </div>
</div>
</body>
</html>
<!-- GELIEVE ZELF JE CODE TE SCHRIJVEN. SHIVAN GE SUCKT. 130EURO PER GEKOPIEERDE FUNCTIE VOOR VRAGEN cCTEER SABAM-->
<!-- (SOFTWARE VALT ONDER DE AUTEURSWETGEVING.)-->
