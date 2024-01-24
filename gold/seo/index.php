<?php
session_start();

$path = getcwd();
$path = str_replace("gold/seo", "", $path);

define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/adminController.php"); 


$ctrl=new AdminController();
$ctrl->verify();
$title= "Bedrijfsgegevens.";

if($_POST)
{
    $table="Gegevens";
    $field="waarde";

    $ctrl->updateStatement($table,$field,$_POST['bedrijfsnaam'],1);
    $ctrl->updateStatement($table,$field,$_POST['omschrijving'],2);
    $ctrl->updateStatement($table,$field,$_POST['titel'],3);
    $ctrl->updateStatement($table,$field,$_POST['tel'],4);
    $ctrl->updateStatement($table,$field,$_POST['email'],5);
    $ctrl->updateStatement($table,$field,$_POST['adres'],6);
    $ctrl->updateStatement($table,$field,$_POST['adres2'],7);
    $ctrl->updateStatement($table,$field,$_POST['adres3'],8);
    $ctrl->updateStatement($table,$field,$_POST['adres4'],9);
    $ctrl->updateStatement($table,$field,$_POST['adres5'],10);
    $ctrl->updateStatement($table,$field,$_POST['btwn'],11);
    $ctrl->updateStatement($table,$field,$_POST['iban'],12);
    $ctrl->updateStatement($table,$field,$_POST['password'],13);
    $ctrl->updateStatement($table,$field,$_POST['password2'],14);
    $ctrl->updateStatement($table,$field,$_POST['facebook'],15);
    $ctrl->updateStatement($table,$field,$_POST['instagram'],16);
    $ctrl->updateStatement($table,$field,$_POST['tripadvisor'],17);
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

function getCompanyData($ctrl){
    $rij = array();
    // Create connection
    $conn = $ctrl->getConnection();
    $sql = "SELECT * FROM `Gegevens` order by id";
    $item=array();
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            array_push($item, $row);
        }

    } else {
        echo "0 results";
    }

    $conn->close();
    return $item;
}

function showOptions($ctrl,$title){
    $formdata=getCompanyData($ctrl);
    echo "<div class='row'>";
         $ctrl->side_nav();   
    echo "<div class='col-md-9' style='background:url(future.jpg);min-height: 150vh;background-size:cover;'>";
    echo '<div class="well text-center" style="width: 100%;margin-top:50px; padding:20px;">
                <h1>'.$title.'</h1>
                <hr /> 
                <h3>Gelieve alle velden waarheidsgetrouw in te vullen.</h3>
                <div>';
                
    echo '<form action="" method="post" style="margin-left:10%;margin-right:10%;width: 80%;text-align:left;" class="text-left;">';
    echo '<label>Bedrijfsnaam<span style="color:red">*</span></label>
          <input type="text"  name="bedrijfsnaam" class="form-control" value="'.$formdata[0]['waarde'].'"/>';
    echo '<label>Omschrijving<span style="color:red">*</span></label>
          <textarea name="omschrijving" class="form-control">'.$formdata[1]['waarde'].'</textarea>';
    echo '<label>Titel<span style="color:red">*</span></label>
          <input type="text"  name="titel" class="form-control" value="'.$formdata[2]['waarde'].'"/>';
    echo '<label>Telefoon<span style="color:red">*</span> </label>
          <input type="text"  name="tel" class="form-control" value="'.$formdata[3]['waarde'].'"/>';
    echo '<label id="emailLabel">Email<span style="color:red">*</span></label>
          <input id="emailField" type="text"  name="email" class="form-control" value="'.$formdata[4]['waarde'].'"/>';
    echo '<label>Straat<span style="color:red">*</span></label>
          <input type="text"  name="adres" class="form-control" value="'.$formdata[5]['waarde'].'"/>'; 
    echo '<label>Huisnummer<span style="color:red">*</span></label>
          <input type="text"  name="adres2" class="form-control" value="'.$formdata[6]['waarde'].'"/>'; 
    echo '<label>Bus</label>
          <input type="text"  name="adres3" class="form-control" value="'.$formdata[7]['waarde'].'"/>'; 
    echo '<label>Postcode<span style="color:red">*</span></label>
          <input type="text"  name="adres4" class="form-control" value="'.$formdata[8]['waarde'].'"/>'; 
    echo '<label>Stad of gemeente<span style="color:red">*</span></label>
          <input type="text"  name="adres5" class="form-control" value="'.$formdata[9]['waarde'].'"/>'; 
    echo '<label>BTW NUMMER</label>
          <input type="text"  name="btwn" class="form-control" value="'.$formdata[10]['waarde'].'"/>';
    echo '<label>IBAN<span style="color:red">*</span></label>
          <input type="text"  name="iban" class="form-control" value="'.$formdata[11]['waarde'].'"/>';   
    echo '<label>Wachtwoord<span style="color:red">*</span></label>
          <input type="password" id="password" name="password" class="form-control" value="'.$formdata[12]['waarde'].'"/>';   
    echo '<label id="passLabel">Wachtwoord bevestiging<span style="color:red">*</span></label>
          <input type="password" id="password2"  name="password2" class="form-control" value="'.$formdata[13]['waarde'].'"/>';         
    echo '<label>Facebook</label>
          <input type="text"  name="facebook" class="form-control" value="'.$formdata[14]['waarde'].'"/>';         
    echo '<label>Instagram</label>
          <input type="text"  name="instagram" class="form-control" value="'.$formdata[15]['waarde'].'"/>';         
    echo '<label>TripAdvisor</label>
          <input type="text"  name="tripadvisor" class="form-control" value="'.$formdata[16]['waarde'].'"/>'; 
    echo '<input type="submit" class="btn btn-dark" style="margin-top:8px;"/>';      
    echo  '</form>';
    echo  '</div></div>';
    echo '</div>';
    echo "</div>";
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
        .form-control{
            border: 2px solid black;
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
    <script>
       
        $("#password2").keyup(function() {
            
            if($("#password2").val()==$("#password").val()){
               $("#passLabel").text("Wachtwoord bevestiging"); 
               $("#password2").css("border-color", "#000");
            }
            else{
               $("#password2").css("border-color", "#991A00");
               $("#passLabel").text("Wachtwoorden zijn niet gelijk");
            }
        });
        
        $("#emailField").keyup(function() {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if(regex.test( $("#emailField").val())){
               $("#emailLabel").text("Email"); 
               $("#emailField").css("border-color", "#000");
            }
            else{
               $("#emailField").css("border-color", "#991A00");
               $("#emailLabel").text("Geen geldig email");
            }
        });
    </script>

</body>
</html>
<!-- GELIEVE ZELF JE CODE TE SCHRIJVEN. SHIVAN GE SUCKT. 130EURO PER GEKOPIEERDE FUNCTIE VOOR VRAGEN CONTACTEER SABAM-->
<!-- (SOFTWARE VALT ONDER DE AUTEURSWETGEVING.)-->