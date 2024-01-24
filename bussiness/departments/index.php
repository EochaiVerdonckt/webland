<?php
session_start();
$path = getcwd();
$path = str_replace("departments", "", $path);
define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/adminController.php"); 


$ctrl=new AdminController();
$ctrl->verify();
$title= "uw departementen.";

if($_POST)
{
   if($_POST['remove']){
    $conn=$ctrl->getConnection();  
    $sql = "DELETE FROM `departments` WHERE id=".$_POST['id'];
    $conn->query($sql);
    $conn->close();
   }
}

function getServices($ctrl){
   return $ctrl->selectStatement('departments',1);
}

function printService($service){
    echo '<div class="col-4" style="border: 2px solid black;">
                <div class="caption">
                    <div class="snow-flake" style="background: url('.$service['foto'].');background-size: cover;"></div>
                    <h6>'.$service['naam'].'</h6>';
                   echo  '<p><div style="width: fit-content;margin: auto;">';
                   
                   echo ' <a href="/agenda/create.php?depart='.$service['id'].'" class="btn btn-dark" role="button"><i class="fa fa-calendar"></i></a>';
                   
                   echo  '<a href="update.php?id='.$service['id'].'" class="btn btn-light" role="button"><i class="fas fa-pen-fancy"></i></a>
                     <a href="foto.php?id='.$service['id'].'"  class="btn btn-light" role="button" style="margin-right: 5px;"><i class="fa fa-camera-retro"></i></a>';
                     echo '
                          <form method="post" style="float:right;">
                     <input type="hidden" value="remove" name="remove" />
                        <input type="hidden" value="'.$service['id'].'" name="id"/>
                         <button class="btn btn-dark"><i style="color: white;" class="fa fa-close"></i></button>
                    </form>';
            
          
                     
            echo    '</div></p>';
            
            echo '</div></div>';
}



function showOptions($ctrl,$title){
$services=getServices($ctrl);
    echo "<div class='row'>";
         $ctrl->side_nav();   
    echo "<div class='col-md-9' style='background:url(future.jpg);min-height: 150vh;background-size:cover;'>";
    echo '<div class="well text-center" style="width: 100%;margin-top:50px; padding:20px;">
                <h1>'.$title.'<a href="create.php"><i class="fas fa-plus-square"></i></a></h1>
                <h3>Gelieve na een foto te hebben geüpload op [CTRL]+[SHFT]+[R] te duwen.</h3>
                <hr /> 
          <div>';
          
    echo '<div  class="row">';  
          if($ctrl->count('departments')==0)
            {
                echo '<h1>U heeft nog geen departementen toegevoegd.</h1>';
            }
            if($ctrl->count('departments')==1)
            {
               printService($services);
            }
            if($ctrl->count('departments')>1)
            {
                foreach ($services as &$client) {
                    printService($client);
                }
            }
       
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

    <div id="vliegerContent" style="padding-top: 4%; padding-bottom: 4%; border-bottom: 1px solid black;background: url('/tegels/bg.jpg'); background-size: cover;" class="text-center">
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
<!-- GELIEVE ZELF JE CODE TE SCHRIJVEN.130EURO PER GEKOPIEERDE FUNCTIE VOOR VRAGEN CONTACTEER SABAM-->
<!-- (SOFTWARE VALT ONDER DE AUTEURSWETGEVING.)-->