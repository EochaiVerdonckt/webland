<?php
session_start();
$path = getcwd();
$path = str_replace("bussiness/zakenplan", "", $path);

define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/adminController.php"); 


$ctrl=new AdminController();
$ctrl->verify();
$title= "Business Plan";

if($_POST){
    $ctrl->updateStatement('zakenplan','sector',$_POST['sector'],1);
    $ctrl->updateStatement('zakenplan','idee',$_POST['idee'],1);
    $ctrl->updateStatement('zakenplan','klanten',$_POST['klanten'],1);
    $ctrl->updateStatement('zakenplan','profit',$_POST['profit'],1);
    $ctrl->updateStatement('zakenplan','cost',$_POST['cost'],1);
    $ctrl->updateStatement('zakenplan','vijand',$_POST['vijand'],1);
    $ctrl->updateStatement('zakenplan','challenge',$_POST['challenge'],1);
    $ctrl->updateStatement('zakenplan','status',$_POST['status'],1);
    $ctrl->updateStatement('zakenplan','netwerk',$_POST['netwerk'],1);
    $ctrl->updateStatement('zakenplan','motieven',$_POST['motieven'],1);
    $ctrl->updateStatement('zakenplan','ambitie',$_POST['ambitie'],1);
    $ctrl->updateStatement('zakenplan','markt',$_POST['markt'],1);
    $ctrl->updateStatement('zakenplan','product',$_POST['product'],1);
    $ctrl->updateStatement('zakenplan','place',$_POST['place'],1);
    $ctrl->updateStatement('zakenplan','price',$_POST['price'],1);
    $ctrl->updateStatement('zakenplan','promotie',$_POST['promotie'],1);
}

function getFlag($id){
    $ctrl=new AdminController();
    $conn=$ctrl->getConnection();
    $sql = "SELECT * FROM `promo_balance` where id=".$id;
    $item=array();
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
           $item=$row;
        }

    } 

    $conn->close();
    return $item['promo'];
}

function getPlan($ctrl){
   return $ctrl->selectStatement('zakenplan',1);
}

function printService($service){
    echo '<div class="col-4" style="border: 2px solid black;">
                <div class="caption">
                    <div class="snow-flake" style="background: url('.$service['foto'].');background-size: cover;"></div>
                    <h6>'.$service['naam'].'</h6>
                     <p>
                     <a href="update.php?id='.$service['id'].'" class="btn btn-light" role="button"><i class="fas fa-pen-fancy"></i></a>
                     <a href="foto.php?id='.$service['id'].'"  class="btn btn-light" role="button" style="margin-right: 5px;"><i class="fa fa-camera-retro"></i></a>';
            
            if($service['publish']==0)
            {
                echo '<a href="hideOrPublish.php?id='.$service['id'].'" class="btn btn-light" role="button"><i class="fa fa-eye"></i></a>';
            }
            else{
                echo '<a href="hideOrPublish.php?id='.$service['id'].'" class="btn btn-light" role="button"><i class="fa fa-eye-slash"></i></a>';
            }
                     
            echo    '</p>';
            
            if($service['publish']==1)
            {
                echo '<p>Wordt getoond</p>';
            }
            else{
                echo '<p>Is verborgen</p>';
            }
            
            echo '</div></div>';
}



function showOptions($ctrl,$title){
$plan=getPlan($ctrl);
    echo "<div class='row'>";
         $ctrl->side_nav();   
    echo "<div class='col-md-9' style='background:url(future.jpg);min-height: 150vh;background-size:cover;'>";
    echo '<div class="well text-center" style="width: 100%;margin-top:50px; padding:20px;">
                <h1>'.$title.'</h1>
                <h3>Neem hier absoluut uw tijd voor.</h3>
                <h3 style="color:red;">Een business (plan) is geen spelletje </h3>
                <hr /> 
          <div>';
          
        echo '<div  class="row">';  
        echo '<form method="POST" style="width: 100%;text-align: left;"/>';
        
        echo '
        
        <label>Sector</label>
                <br>
                <div style="text-align:left;    margin-top: 5px;margin-bottom: 5px;">
                    <div><input type="radio" name="sector" value=" Grondstoffen of voedsel leveren" checked="">  Grondstoffen of voedsel leveren</div>
                    <div><input type="radio" name="sector" value="Grondstoffen verwerken, produceren"> Grondstoffen verwerken, produceren</div>
                    <div><input type="radio" name="sector" value="Diensten verlenen aan bedrijven"> Diensten verlenen aan bedrijven        </div>
                    <div><input type="radio" name="sector" value="Diensten verlenen aan bedrijven"> Verkoop van goederen of diensten        </div>
                    <div><input type="radio" name="sector" value="Diensten verlenen aan bedrijven"> Dienstverlening zonder winstoogmerk.       </div>
                </div>
                <label>Beschrijf uw idee*</label>
                <textarea id="idee" name="idee" class="form-control placeholder" placeholder="Ik maak juweeltjes en wil deze verkopen." style="margin-bottom: 1%;" required="">'.$plan['idee'].'</textarea>
                <label>Doelgroep*</label>
                <textarea id="klanten" name="klanten" class="form-control placeholder" placeholder="Mijn juwelen kunnnen gedragen worden door alle leeftijdsgroepen, jonge en oud. Voor zowel mannen als vrouwen." style="margin-bottom: 1%;" required="">'.$plan['klanten'].'</textarea>
                <label>Verdienmodel*</label>
                <textarea id="profit" name="profit" class="form-control placeholder" placeholder="Ik werk ongeveer ongeveer 3uur aan een juweel, en de grondstoffen kosten me 15€. Ik zou deze dus moeten verkopen aan €345 per stuk. Ik heb wel/geen BTW vrijstelling. Of ik weet niet of ik een vrijstelling heb. Ik zou het eerste jaar ongeveer 12.000€ willen verdienen. Ik besef dat een zaak runnen in dit land me minimul 500€ per jaar kost, inclusief boekhouder, administratie en de kosten die Webland me aanrekent." style="margin-bottom: 1%;" required="">'.$plan['profit'].'</textarea>
                 <label>Kosten*</label>
                <textarea id="costs" name="cost" class="form-control placeholder" placeholder="Beschrijf hier zo nauwkeurig mogelijk welke kosten u heeft, welke investeringen u van plan bent." style="margin-bottom: 1%;" required="">'.$plan['cost'].'</textarea>
                <label>Concurrentie*</label>
                <textarea id="vijand" name="vijand" class="form-control placeholder" placeholder="In ons dorp zijn er geen juweliers. De gene het dichtstebij noemt XXXX en hun website is xxxx.be. " style="margin-bottom: 1%;" required="">'.$plan['vijand'].'</textarea>
                <label>Uitdagingen*</label>
                <textarea id="challenge" name="challenge" class="form-control placeholder" placeholder="Het belangrijkste is dat ik klanten heb. Bovendien kunnen de prijzen van mijn grondstoffen in de toekomste toenemen. Ik werk graag via webland omdat ik dankzij hun software niet teveel wordt afgeleid. En me zo kan richten op mijn kernactiviteiten." style="margin-bottom: 1%;" required="">'.$plan['challenge'].'</textarea>
                <label>Stand van zaken*</label>
                <textarea id="status" name="status" class="form-control placeholder" placeholder="Ik heb momenteel ongeveer 178 klanten per jaar. Een btw nummer maar nog geen website." style="margin-bottom: 1%;" required="">'.$plan['status'].'</textarea>
                <label>Hoe bouw je je netwerk op?*</label>
                <textarea id="netwerk" name="netwerk" class="form-control placeholder" placeholder="Ik wil vooral leven van mond aan mond reclame. Ik hoop ook klanten te scoren dankzij Cogitatio. En mijn Facebook pagina. Webland raad me ook een instagram aan." style="margin-bottom: 1%;" required="">'.$plan['netwerk'].'</textarea>
                <label>Persoonlijke motieven?*</label>
                <textarea id="motieven" name="motieven" class="form-control placeholder" placeholder="Hier beschrijft u waarom u juist nú voor uzelf begint. Benoem daarbij niet alleen de kracht van het
product of de dienst, maar geef een persoonlijke motivatie. Waarom gelooft u hierin?
Wellicht ten overvloede, maar wees altijd open en eerlijk over uw beweegredenen. " style="margin-bottom: 1%;" required="">'.$plan['motieven'].'</textarea>
                <label>Ambities?*</label>
                <textarea id="ambitie" name="ambitie" class="form-control placeholder" placeholder="Hier vertelt u wat u met uw onderneming wilt bereiken. Wat zijn precies uw ambities op zakelijk of privégebied? " style="margin-bottom: 1%;" required="">'.$plan['ambitie'].'</textarea>
                <label> De markt in beeld?*</label>
                <textarea id="markt" name="markt" class="form-control placeholder" placeholder="Vertel iets over de marktomvang
(lokaal, landelijk en/of internationaal), gesignaleerde trends en vermeld eventuele plannen van
de overheid. Breng deze informatie zo concreet mogelijk in kaart. Staaf het met cijfers en noem
betrouwbare bronnen " style="margin-bottom: 1%;" required="">'.$plan['markt'].'</textarea>
                <div style="text-align:center;">
                    <h3>De 4 p&#39;s</h3>
                </div>
                
                <label>Product of dienst*</label>
                <textarea id="product" name="product" class="form-control placeholder" placeholder=" Naar wie richt je je? Begin bij mensen en organisaties die je goed kent. Mond-tot-mondreclame gaat in ons klein land tenslotte vrij snel. Druk visitekaartjes, flyers, raamstickers. En laad deze door ons verspreiden." style="margin-bottom: 1%;" required="">'.$plan['product'].'</textarea>
                <label>Plaats*</label>
                <textarea id="place" name="place" class="form-control placeholder" placeholder="Ik verkoop van mijn thuis, en soms op standjes, maar in de toekomst ook op de website." style="margin-bottom: 1%;" required="">'.$plan['place'].'</textarea>
                <label>Prijs*</label>
                <textarea id="price" name="price" class="form-control placeholder" placeholder="Neem alle tijd om je concurrenten aandachtig te bestuderen en breng je kosten in kaart. Wat heb je nodig om kosten en omzet in evenwicht te houden? En waar maak je winst op? Dit vormt de aanloop naar je financieel plan." style="margin-bottom: 1%;" required="">'.$plan['price'].'</textarea>
                <label>Promotie*</label>
                <textarea id="promotie" name="promotie" class="form-control placeholder" placeholder=" Naar wie richt je je? Begin bij mensen en organisaties die je goed kent. Mond-tot-mondreclame gaat in ons klein land tenslotte vrij snel. Druk visitekaartjes, flyers, raamstickers. En laad deze door ons verspreiden." style="margin-bottom: 1%;" required="">'.$plan['promotie'].'</textarea>
        
                <input type="submit"  class="btn btn-dark"/>
        ';
        
        echo '</form>';
        echo '</div>';
    
    echo '</div>';    
    echo '</div>'; 
 
    
}



?>




<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Webland | Backoffice</title>
    
    <meta name="description" content=">Webland | " />
    <meta name="google-site-verification" content="ExQ89lGiGlXTIDoWcfx5CxMkRu-Wtubn8FYir2BJRU8" />
    <?php $ctrl->printStyles(); ?>
    <style>
                .snow-flake
        {
            width:100%;
            padding-bottom: 60%;
        }
        .btn-light{
            border: 1px solid black;
        }
    </style>
</head>
<body>
<div class="container-fluid ruimte-top">

    <div id="vliegerContent" style="padding-top: 4%; padding-bottom: 4%; border-bottom: 1px solid black;background: url('/portaal/bg.jpg'); background-size: cover;" class="text-center">
        <h1 style=" text-shadow: 3px 3px #000; color: white; margin-top: 0; margin-left: auto; margin-right: auto; padding-top: 5%; padding-bottom: 5%;"class="text-vertical-center" data-stellar-background-ratio="0.5">Beheerders Pagina</h1>
    </div>
<?php $ctrl->print_supernav(); ?> 
<?php
    if($_SESSION['user']=="ok")
    {
    showOptions($ctrl,$title);
    }
?>



    <div class="row" style="border-top: 1px solid black;    margin-right: 0; margin-left: 0;">
        <div class="text-center ruimte-top">
            <p>Copyright © Webland, design by <a href="http://mobile-express.be">Webland</a> All rights reserved</p>
        </div>
    </div>
    <div class="row ruimte-bottom" style="   margin-right: 0; margin-left: 0;">
        <div class="col-lg-4 col-md-4 col-sm-4 col-lg-offset-2 col-md-offset-2 col-sm-offset-2">
            <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/3.0/"><img
                    alt="Creative Commons License" style="border-width:0"
                    src="https://i.creativecommons.org/l/by-nc-nd/3.0/88x31.png"/></a><a rel="license"
                                                                                         href="http://creativecommons.org/licenses/by-nc-nd/3.0/"></a>
        </div>
    </div>
</div>
    <!-- JS SCRIPTS -->
    
     <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/bootstrap-assets/js/bootstrap.min.js"></script>
   <script>
        $("#businessList").hide();
        $("#mySiteList").hide();
        $("#horecaList").hide();
        $("#webshopList").hide();
        $("#futureList").hide();
        $("#whrList").hide();
        //
        $("#futurePanel").click(function() {
            $("#futureList").toggle();
        });
        $("#businessPanel").click(function() {
            $("#businessList").toggle();
        });
         $("#mySitePanel").click(function() {
             $("#mySiteList").toggle();
        });
        $("#horecaPanel").click(function() {
             $("#horecaList").toggle();
        });
         $("#webshopPanel").click(function() {
             $("#webshopList").toggle();
        });
         $("#whrPanel").click(function() {
             $("#whrList").toggle();
        });
    </script>
</body>
</html>
<!-- GELIEVE ZELF JE CODE TE SCHRIJVEN. SHIVAN GE SUCKT. 130EURO PER GEKOPIEERDE FUNCTIE VOOR VRAGEN CONTACTEER SABAM-->
<!-- (SOFTWARE VALT ONDER DE AUTEURSWETGEVING.)-->