<?php
session_start();
$path = getcwd();
$path = str_replace("gold/hours", "", $path);

define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/adminController.php"); 

$ctrl=new AdminController();
$ctrl->verify();


if($_POST)
{
    $ctrl->updateStatement('hours','waarde',$_POST['maandag'],1);
    $ctrl->updateStatement('hours','waarde',$_POST['dinsdag'],2);
    $ctrl->updateStatement('hours','waarde',$_POST['woensdag'],3);
    $ctrl->updateStatement('hours','waarde',$_POST['donderdag'],4);
    $ctrl->updateStatement('hours','waarde',$_POST['vrijdag'],5);
    $ctrl->updateStatement('hours','waarde',$_POST['zaterdag'],6);
    $ctrl->updateStatement('hours','waarde',$_POST['zondag'],7);
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
function getHours($ctrl)
{
    return $ctrl->selectStatement("hours",1);
}

function toonForm($ctrl){
    $item= getHours($ctrl);
    echo "<div style='text-align:left;'>";
    echo "<h3><i class='fa fa-info'></i> Voor de dagen dat u gesloten bent zet u, [GESLOTEN].</h3>";
    echo "<h3><i class='fa fa-info'></i> voorbeeld:  [08:00-12:00].</h3>";
    echo "<h3><i class='fa fa-info'></i> voor pauzes voorbeeld:  [08:00-12:00 13:00-20:00].</h3>";
    
    echo '<form method="post" style="text-align:left;">';
    echo '<label>Maandag</label>';
    echo '<input type="text" name="maandag" class="form-control" value="'.$item[0]['waarde'].'"/>';
    echo '<label>Dinsdag</label>';
    echo '<input type="text" name="dinsdag" class="form-control" value="'.$item[1]['waarde'].'"/>';
    echo '<label>Woensdag</label>';
    echo '<input type="text" name="woensdag" class="form-control" value="'.$item[2]['waarde'].'"/>';
    echo '<label>Donderdag</label>';
    echo '<input type="text" name="donderdag" class="form-control" value="'.$item[3]['waarde'].'"/>';
    echo '<label>Vrijdag</label>';
    echo '<input type="text" name="vrijdag" class="form-control" value="'.$item[4]['waarde'].'"/>';
    echo '<label>Zaterdag</label>';
    echo '<input type="text" name="zaterdag" class="form-control" value="'.$item[5]['waarde'].'"/>';
    echo '<label>Zondag</label>';
    echo '<input type="text" name="zondag" class="form-control" value="'.$item[6]['waarde'].'"/>';
    echo '<input type="submit" class="btn btn-dark" style="margin-top:12px;"/>';
    echo '</form>';
    echo "</div>";
}


function showOptions($ctrl){
    echo "<div class='row' style='padding-right: 15px;'>";
         $ctrl->side_nav();   
        echo "<div class='col-md-9' style='background:url(future.jpg);min-height: 150vh;background-size:cover;'>";
                echo '<div class="well text-center" style="width: 100%;background: rgba(255,255,255,0.8);margin-top:50px; padding:20px;">
                <h1>Openingsuren <a class="btn btn-dark" href="foto.php"><i class="fas fa-camera-retro"></i></a></h1>
                <hr />';
               toonForm($ctrl);
            echo    '</div>';
        echo '</div>';
    
    echo "</div>";
}

?>




<!DOCTYPE html>
<html>
<head lang="nl">
    <meta charset="UTF-8">
    <title>Webland | Backoffice</title>
    
    <meta name="description" content=">Webland | " />
    <meta name="google-site-verification" content="ExQ89lGiGlXTIDoWcfx5CxMkRu-Wtubn8FYir2BJRU8" />
    <?php $ctrl->printStyles(); ?>

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
    showOptions($ctrl);
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
 <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
 <script src="https://kit.fontawesome.com/ec86fc2ae0.js" crossorigin="anonymous"></script>
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