<?php
session_start();
$path = getcwd();
$path = str_replace("gold/afbeeldingen", "", $path);

define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/adminController.php"); 


$ctrl=new AdminController();
$ctrl->verify();
$title= "uw fotopagina.";

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
function print_artikels()
{
    $ctrl=new AdminController();
    $conn =$ctrl->getConnection();
    $sql = "SELECT * FROM artikel_balance where id>0";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $state =  trim($row['state']);
            $id= trim($row['id']);
            echo '<div class="col-lg-4">';
            echo '<div class="thumbnail">
                     <span class="badge">Album:'.getAlbumName($row['album']).'</span>
                    <img src="/gold/afbeeldingen/uploads/'.$row['foto'].'" width="100%;" alt="">
                    <div class="caption">              
                       '.$row['info'].'
                        <p>
                       <a href="update.php?id='.$row['id'].'" class="btn btn-dark" role="button"><i class="fa fa-pen-fancy"></i></a>
                       
                       <a href="remove.php?product='.$id.'" class="btn btn-dark" role="button"><i class="fa fa-times"></i></a>
                      ';

            if($state==0)
            {
                echo ' <a href="hideOrPublish.php?id='.$row['id'].'" class="btn btn-dark role="button"><i class="fa fa-eye-slash"></i></a>';
            }
            else
            {
                echo '<a href="hideOrPublish.php?id='.$id.'" class="btn btn-dark" role="button"><i class="fa fa-eye"></i></a>';
            }
            
             echo '<a href="relation.php?id='.$id.'" class="btn btn-default" role="button">album</a>
                      ';

            echo '<a href="cover.php?product='.$id.'" class="btn btn-default" role="button">cover</a>
                      ';

            echo '
                       
                       </p>
                    </div>
                 </div></div>';
        }
    } else {
        echo "0 results";
    }
    mysqli_close($conn);
}

function getAlbumName($id)
{
    $ctrl=new AdminController();
    $conn =$ctrl->getConnection();
    $sql = "SELECT naam FROM albums where id=".$id;
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $album =  trim($row['naam']);
        }
    } else {
        echo "0 results";
    }
    mysqli_close($conn);
    return $album;
}

function showOptions($ctrl,$title){
    echo "<div class='row'>";
         $ctrl->side_nav();   
    echo "<div class='col-md-9' style='background:url(future.jpg);min-height: 150vh;background-size:cover;'>";
    echo '<div class="well text-center" style="width: 100%;margin-top:50px; padding:20px;">
                <h1>'.$title.' <a href="albums.php" class="btn btn-dark">ALBUMS</a> <a href="create.php" class="btn btn-dark"><i class="fa fa-plus"></i></a></h1>
                <h3>Gelieve na een foto te hebben geüpload op [CTRL]+[SHFT]+[R] te duwen.</h3>
                <hr /> 
          <div>';
    echo '<div class="row">';      
    print_artikels();    
    echo '</div>'; 
    echo '</div>';    
    echo '</div>'; 
 
    
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
<!-- GELIEVE ZELF JE CODE TE SCHRIJVEN.130EURO PER GEKOPIEERDE FUNCTIE VOOR VRAGEN CONTACTEER SABAM-->
<!-- (SOFTWARE VALT ONDER DE AUTEURSWETGEVING.)-->