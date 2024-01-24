<?php
session_start();

$path = getcwd();
$path = str_replace("slides", "", $path);

define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/adminController.php"); 


$ctrl=new AdminController();
$ctrl->verify();

if($_POST){
    $table='slides_color';
    $field="value";
    $key= 1;
    $value=$_POST['color1'];
    $ctrl->updateStatement($table,$field,$value,$key);
    $key= 2;
    $value=$_POST['color2'];
    $ctrl->updateStatement($table,$field,$value,$key,1);
    $key= 3;
    $value=$_POST['color3'];
    $ctrl->updateStatement($table,$field,$value,$key,1);
}


function getSlideColors($ctrl){
   return $ctrl->selectStatement('slides_color');
}

function showOptions($ctrl){
    echo "<div class='row' style='padding-right: 15px;'>";
        $ctrl->side_nav();   
       $colors=getSlideColors($ctrl);
        
        echo "<div class='col-md-9' style=''>";
                echo '<div class="well text-center" >
                <h1>Verander de kleuren van uw presentatie.</h1>
               
                <hr />';
                 echo '<div  class="row">';      
                 echo '
                 <form method="post" style="text-align:left; margin-left:25px;">
    <div>             
    <label>Kies de achtergrondkleur van je wayoint</label>
     <input type="color"  name="color1" value="'.$colors[0]['value'].'">
    </div>
    <div>
    <label>Kies de tekstkleur van je wayoint</label>
     <input type="color"  name="color2" value="'.$colors[1]['value'].'">
     </div>
     <div>
    <label>Kies nog een kleur </label>
    <input type="color"  name="color3" value="'.$colors[2]['value'].'">
    </div>
    <input type="submit" class="btn btn-dark">
    </form>
                 
                 ';  
                echo '</div>'; 
                echo '<div  class="row text-center">';
                echo '<div class="text-center" style="width: 100%;
    margin-top: 25px;
    margin-bottom: 25px;">';
                    echo "<a href='presentation.php' class='btn btn-dark'>BEKIJK UW PRESENTATIE</a>";
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