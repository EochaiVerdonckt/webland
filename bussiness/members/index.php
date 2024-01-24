<?php
session_start();


$path = getcwd();
$path = str_replace("bussiness/members", "", $path);

define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/adminController.php"); 

$ctrl=new AdminController();
$ctrl->verify();


if($_POST)
{
   
}

function getMembers($ctrl)
{
    return $ctrl->selectStatement("members",1);
}

function print_member($item){
    echo '<div class="col-lg-4">';
            echo '<div class="thumbnail">
                    <img src="'.$item['foto'].'" width="100%;" alt="">
                    <div class="caption">  
                    <h1>'.$item['info'].'</h1>
                       '.$item['omschrijving'].'
                       <p>
                       
                       <a href="/agenda/create.php?member='.$item['id'].'" class="btn btn-dark" role="button"><i class="fa fa-calendar"></i></a>
                       <a href="foto.php?id='.$item['id'].'" class="btn btn-dark" role="button"><i class="fa fa-camera-retro"></i></a>
                       <a href="update.php?id='.$item['id'].'" class="btn btn-dark" role="button"><i class="fa fa-pen-fancy"></i></a>
                       <a href="remove.php?id='.$item['id'].'" class="btn btn-default" role="button"><i style="color:red" class="fa fa-times"></i></a>
                      ';

            if($item['publish']==0)
            {
                echo '<a href="hideOrPublish.php?id='.$item['id'].'" class="btn btn-light" role="button"><i class="fa fa-eye"></i></a>';
            }
            else{
                echo '<a href="hideOrPublish.php?id='.$item['id'].'" class="btn btn-light" role="button"><i class="fa fa-eye-slash"></i></a>';
            }


            echo '
                       
                       </p>
                    </div>
                 </div></div>';
}

function showOptions($ctrl){
    echo "<div class='row' style='padding-right: 15px;'>";
         $ctrl->side_nav();   
        echo "<div class='col-md-9' style='background:url(future.jpg);min-height: 150vh;background-size:cover;'>";
                echo '<div class="well text-center" style="width: 100%;background: rgba(255,255,255,0.8);margin-top:50px; padding:20px;">
                <h1>De leden van uw bedrijf.<a href="create.php"><i class="fas fa-plus-square"></i></a></h1>
                <h3>Gelieve na een foto te hebben geüpload op [CTRL]+[SHFT]+[R] te duwen.</h3>
                <hr />';
            echo '<div class="row">';    
            if($ctrl->count('members')==0)
            {
                echo '<h1>U heeft nog geen leden toegevoegd.</h1>';
            }
            else{
                 $members=getMembers($ctrl);
            }
            if($ctrl->count('members')==1)
            {
               print_member($members);
            }
            if($ctrl->count('members')>1)
            {
                foreach ($members as &$member) {
                    print_member($member);
                }
            }
               
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
    <?php $ctrl->printStyles(); ?>

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
<!-- GELIEVE ZELF JE CODE TE SCHRIJVEN. SHIVAN GE SUCKT. 130EURO PER GEKOPIEERDE FUNCTIE VOOR VRAGEN CONTACTEER SABAM-->
<!-- (SOFTWARE VALT ONDER DE AUTEURSWETGEVING.)-->