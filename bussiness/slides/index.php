<?php
session_start();
$path = getcwd();
$path = str_replace("bussiness/slides", "", $path);

define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/adminController.php"); 


$ctrl=new AdminController();
$ctrl->verify();

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

function getSlides($ctrl){
   return $ctrl->selectStatement('slides');
}

function printSlide($service){
    echo '<div class="col-4" style="border: 2px solid black;">
                <div class="caption">
                    <div class="snow-flake" style="background: url('.$service['foto'].');background-size: cover;"></div>
                    <h6>'.$service['titel'].'</h6>
                     <p>
                     <a href="update.php?id='.$service['id'].'" class="btn btn-light" role="button"><i class="fas fa-pen-fancy"></i></a>';
               echo '<a href="foto.php?id='.$service['id'].'" class="btn btn-light" role="button"><i class="fas fa-camera-retro"></i></a>';
            
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



function showOptions($ctrl){
    echo "<div class='row' style='padding-right: 15px;'>";
        $ctrl->side_nav();   
        $slides=getSlides($ctrl);
         
        
        echo "<div class='col-md-9' style=''>";
                echo '<div class="well text-center" >
                
                <h1>Maak een korte presentatie over uw bedrijf.</h1>
                <h3><i class="fa fa-exclamation-circle" ></i>Duw op [ctrl]+[shift]+[R] om je nieuwe foto te zien.</h3>
                <hr />';
                 echo '<div  class="row">';      
                    printSlide($slides[0]);    
                    printSlide($slides[1]);
                    printSlide($slides[2]);
                echo '</div>'; 
                echo '<div  class="row text-center">';
                echo '<div class="text-center" style="width: 100%;
    margin-top: 25px;
    margin-bottom: 25px;">';
                    echo "<a href='presentation.php' class='btn btn-dark'>BEKIJK UW PRESENTATIE</a>";
                    echo "<a href='color.php' class='btn btn-dark'><i class='fas fa-tint'></i></a>";
                    echo '</div>';
                echo '</div>';  
            echo    '</div>';
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



    <!-- Bootstrap css -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
    <!-- Icons Font -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/font5/css/fontawesome.min.css">
    <link href="/font5/css/brands.css" rel="stylesheet">
    <link href="/font5/css/solid.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries  -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <style>
        .snow-flake {
            width: 100%;
            padding-bottom: 60%;
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
<!-- GELIEVE ZELF JE CODE TE SCHRIJVEN. 130EURO PER GEKOPIEERDE FUNCTIE VOOR VRAGEN CONTACTEER SABAM-->
<!-- (SOFTWARE VALT ONDER DE AUTEURSWETGEVING.)-->