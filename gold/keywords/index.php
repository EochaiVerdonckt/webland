<?php
session_start();
$path = getcwd();
$path = str_replace("gold/keywords", "", $path);

define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/adminController.php"); 


$ctrl=new AdminController();
$ctrl->verify();
$title= "About";

if(isset($_POST['key1'])){
    $conn=$ctrl->getConnection();

    $sql = "UPDATE `keywords` SET `id`='".$_POST['key1']."',`key1`='".$_POST['key1']."',`key2`='".$_POST['key2']."',`key3`='".$_POST['key3']."',`key4`='".$_POST['key4']."',`key5`='".$_POST['key5']."' WHERE 1' WHERE id=1";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['input']= "New record created successfully";
        $last = $conn->insert_id;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
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
function getKeys()
{
    $ctrl=new AdminController();
    $conn = $ctrl->getConnection();
    $sql = "SELECT * FROM keywords where id=1";
    $item='';
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $item = $row;
        }

    } else {
        echo "0 results";
    }

    $conn->close();
    return $item;
}


function getVlag()
{
    $ctrl=new AdminController();
    $conn = $ctrl->getConnection();

    $sql = "SELECT promo FROM promo_balance where id=3";
    $item='';
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $item = $row['promo'];
        }

    } else {
        echo "0 results";
    }

    $conn->close();
    return $item;
}

function toonForm(){
    $keys=getKeys();
    
    echo "<h3><i class='fa fa-info'></i> Kies uw keywords.</h3>";
   
    echo '<form method="post">';
     echo '<label>Sleutelwoord 1</label>';
     echo '<input type="text" name="key1" class="form-control" value="'.$keys['key1'].'"/>';
     echo '<label>Sleutelwoord 2</label>';
     echo '<input type="text" name="key2" class="form-control" value="'.$keys['key2'].'"/>'; 
     echo '<label>Sleutelwoord 3</label>';
     echo '<input type="text" name="key3" class="form-control" value="'.$keys['key3'].'"/>';
     echo '<label>Sleutelwoord 4</label>';
     echo '<input type="text" name="key4" class="form-control" value="'.$keys['key4'].'"/>';
     echo '<label>Sleutelwoord 5</label>';
     echo '<input type="text" name="key5" class="form-control" value="'.$keys['key5'].'"/>';
    echo '<input type="submit" class="btn btn-info btn-block" />';
    echo '</form>';
}

function showOptions($ctrl,$title){
    echo "<div class='row'>";
       
         $ctrl->side_nav();   
      
        
        echo "<div class='col-md-9' style='min-height: 150vh;background-size:cover;'>";
                echo '<div class="well text-center" style="width: 100%;margin-top:50px; padding:20px;">
                
                <h1>'.$title.'<a href="color.php" class="btn btn-dark"><i class="fas fa-tint"></i></a> <a href="foto.php" class="btn btn-dark"><i class="fa fa-camera"></i></a></h1>
                <hr />'; 
               toonForm();
        echo  '</div></div>';
        echo '</div>';
    
    echo "</div>";
}



?>




<!DOCTYPE html>
<html>
<head lang="nl">
    <meta charset="UTF-8">
    <title>Webland | Backoffice | ABOUT MODULE </title>
    
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

    <div class="row" style="padding-bottom: 1%; background-color: white;">

    </div>
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
 <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
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