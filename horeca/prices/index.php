<?php
session_start();
$path = getcwd();
$path = str_replace("horeca/prices", "", $path);

define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/adminController.php"); 


$ctrl=new AdminController();
$ctrl->verify();

if($_POST['action']=='remove')
{

   $conn= $ctrl->getConnection();
    //$sql = "INSERT INTO `product`( `naam`, `info`,`price`) VALUES (,,".."')";
    $sql = "DELETE FROM `price_balance` WHERE id=".$_POST['id'];
    if ($conn->query($sql) === TRUE) {
        $_SESSION['input']= "New record created successfully";
        $last = $conn->insert_id;


    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    removeOrders();
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

function removeOrders(){
    $ctrl=new AdminController();
    $conn= $ctrl->getConnection();
    //$sql = "INSERT INTO `product`( `naam`, `info`,`price`) VALUES (,,".."')";
    $sql = "DELETE FROM `bestelling` WHERE id>0";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['input']= "New record created successfully";
        $last = $conn->insert_id;


    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

function toonPrices()
{
    echo '<div class="col-lg-8">';
    $rij = array();
    $ctrl=new AdminController();
    $conn=$ctrl->getConnection();
    $sql = "SELECT * FROM cat_balance order by sort";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            array_push($rij,$row);
        }

    } else {
        echo "0 results";
    }

    $conn->close();

    foreach ($rij as &$value) {
        echo '<img src="'.$value['img'].'"  style="width:100%;"/>';
        echo '<h3>'.$value['naam'].'</h3>';
        
        
        echo '
        
        <a href="editCat.php?id='.$value['id'].'" class="btn btn-default"><i class="fa fa-pen-fancy"></i></a><a href="wave-down.php?id='.$value['id'].'" class="btn btn-default"><i class="fa fa-arrow-up"></i></a>
        
        <a href="wave-up.php?id='.$value['id'].'" class="btn btn-default"><i class="fa fa-arrow-down"></i></a>
        
        
         <a href="addItem2Catog.php?id='.$value['id'].'" class="btn btn-default"><i class="fa fa-plus"></i></a>
        
        <a href="change-pic.php?id='.$value['id'].'" class="btn btn-default"><i class="fa fa-eye"></i></a>
        
        <a href="bool-tkt.php?id='.$value['id'].'" class="btn btn-default"><i class="fa fa-shopping-bag"></i></a>
        
        <a href="removeCat.php?id='.$value['id'].'" class="btn btn-default"><i class="fa fa-times" style="color:red;"></i></a> 
        </h3>
        <h3>
        <form method="post" action="saveSortCatog.php">
                        <input type="hidden" value="'.$value['id'].'" name="id"/>
                        <input type="text" value="'.$value['sort'].'" name="sort" size="1"/>
                        <button><i style="color: black;" class="fa fa-save"></i></button>
                    </form></h3>';
                 echo '<h3>
         <form method="post" action="createSortCatog.php">
                        <input type="hidden" value="'.$value['id'].'" name="id"/>
                        <select id="cars" name="sortFilter">
                            <option value="naam">Sorteer op naam</option>
                            <option value="prijs">Sorteer op prijs</option>
                        </select>
                        <button><i style="color: black;" class="fa fa-save"></i></button>
                    </form></h3>';        
        echo '<p>'.$value['comment'].'</p>';
        

        $conn=$ctrl->getConnection();
        $sql = "SELECT * FROM price_balance where cat=".$value['id']." ORDER BY sort";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo '<table style="width: 100%; padding: 2%;">';
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td style="border-top: 1px solid white; text-align: left; padding-left: 2%;">'.$row['naam'].'</td>';
                echo '<td style="border-top: 1px solid white;"><form method="POST" action="updatePrice.php"><input type="hidden" name="id" value="'.$row['id'].'"/><input type="text" name="price" value="'.$row['bedrag'].'" size="6"/><button><i style="color: black;" class="fa fa-save"></i></button></form></td>';
       
                echo '<td style="border-top: 1px solid white;display: -webkit-box;">
                <a href="wave-2-down.php?id='.$row['id'].'" class="btn btn-default"><i class="fa fa-arrow-up"></i></a><a href="wave-2-up.php?id='.$row['id'].'" class="btn btn-default"><i class="fa fa-arrow-down"></i></a>
                 
                    <form method="post" action="edit.php">
                        <input type="hidden" value="'.$row['id'].'" name="id"/>
                        <button><i style="color: black;" class="fa fa fa-pen-fancy"></i></button>
                    </form>
                    <form method="post">
                     <input type="hidden" value="remove" name="action" >
                        <input type="hidden" value="'.$row['id'].'" name="id"/>
                         <button><i style="color: darkred;" class="fa fa-close"></i></button>
                    </form>
                      <form method="post" action="saveSort.php">
                        <input type="hidden" value="'.$row['id'].'" name="id"/>
                        <input type="text" value="'.$row['sort'].'" name="sort" size="1"/>
                        <button><i style="color: black;" class="fa fa-save"></i></button>
                    </form>
                </td>';
                echo '</tr>';

            }
            echo '</table>';

        } else {
            echo "0 results";
        }

        $conn->close();
   
    }


    echo '</div>';


}



function showOptions($ctrl){
    echo "<div class='row' style='padding-right: 15px;'>";
       
         $ctrl->side_nav();   
      
        
        echo "<div class='col-md-9' style='background:url(future.jpg);min-height: 150vh;background-size:cover;'>";
        echo '<div style="margin-top:15px;"> </div>';
        echo '<a class="btn btn-dark" href="newPrijs.php">Nieuwe prijs </a><a href="create2.php" class="btn btn-dark" role="button">nieuwe categorie</a><a href="create2.php" class="btn btn-dark" role="button"><i class="fa fa-tint"></i></a>';
            echo "<div class='well'>
     <h5>Opgelet bij het verwijderen van een categorie, ben je al je items van die categorie kwijt.</h5>
     <h5>Om te sorteren kan u de pijltjes of het getal aanpassen en op save duwen.</h5>
     <h5>Om de foto te veranderen duwt u op het oogje.</h5>
     <h5>Indien een categorie online bestelt kan worden. Klik dan op het zakje.</h5>
     <h5>Bekijk de video voor meer <a href='youtube.com'>informatie.</a></h5>
     <h5>Problemen? Bel: 0485/86.59.70</h5>
     </div>";
      toonPrices();     
    echo '</div>';
   
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
<!-- GELIEVE ZELF JE CODE TE SCHRIJVEN. SHIVAN GE SUCKT. 130EURO PER GEKOPIEERDE FUNCTIE VOOR VRAGEN CONTACTEER SABAM-->
<!-- (SOFTWARE VALT ONDER DE AUTEURSWETGEVING.)-->