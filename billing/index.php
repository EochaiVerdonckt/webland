<?php
session_start();

$path = getcwd();
$path = str_replace("billing", "", $path);

define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/adminController.php"); 

$ctrl=new AdminController();
$ctrl->verify();


function getBills3(){
    
    $ctrl=new AdminController();
    $conn = $ctrl->getConnection();
    
 
    
    if($_GET['klant']){
      $sql = "SELECT * FROM `bill` where soort='kas' and klant=".$_GET['klant'];  
    }
    else{
     $sql = "SELECT * FROM `bill` where soort='kas'";   
    }
    
    
    $bills= array();
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $datum=$row['datum'];
            $datum = explode(" ", $datum);
            $row['datum']=$datum[0];
            array_push($bills,$row);
        }

    } else {
        
    }
    $conn->close();
    
    return $bills;
}

function getBills(){
    $ctrl=new AdminController();
    $conn=$ctrl->getConnection();

    
    if($_GET['klant']){
      $sql = "SELECT * FROM `bill` where soort='factuur' and klant=".$_GET['klant'];  
    }
    else{
     $sql = "SELECT * FROM `bill` where soort='factuur'";  
    }
    
    $bills= array();
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $datum=$row['datum'];
            $datum = explode(" ", $datum);
            $row['datum']=$datum[0];
            array_push($bills,$row);
        }

    } else {
       
    }
    $conn->close();
    
    return $bills;
}

function getBills2(){
   $ctrl=new AdminController();
    $conn=$ctrl->getConnection();
  
    
     if($_GET['klant']){
       $sql = "SELECT * FROM `bill` where soort='bon' and klant=".$_GET['klant'];  
    }
    else{
      $sql = "SELECT * FROM `bill` where soort='bon'";
    }
   
    $bills= array();
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $datum=$row['datum'];
            $datum = explode(" ", $datum);
            $row['datum']=$datum[0];
            array_push($bills,$row);
        }

    } else {
        
    }
    $conn->close();
    
    return $bills;
}

function updateKlantenBills($bills){
    $ctrl=new AdminController();
    $conn=$ctrl->getConnection();
    
    foreach ($bills as &$value) {
        $value['klantId']=$value['klant'];
        if($value['klant'])
        {
            $sql = "SELECT * FROM clients where id=".$value['klant'];
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                // output data of each row
                while($row = mysqli_fetch_assoc($result)) {
                    $value['klant']=$row['voornaam']." ".$row['naam'];
                }
            } else {
            
            }            
        }
        else
        {
            $value['klant']="geen klant";   
        }
    }
    $conn->close();
    return $bills;
}

function updateBedragBills($bills){
    $ctrl=new AdminController();
    $conn=$ctrl->getConnection();
    
    
    foreach ($bills as &$value) {
        $sql = "SELECT sum(bedrag) as bedrag FROM `bill_post` WHERE factuur=".$value['nummer'];
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                $value['bedrag']=$row['bedrag'];
            }
        } else {
           
        }
    }
    $conn->close();
    return $bills;
}

function printBills($bills){
     echo '<table style="width: 100%;" id="customers">';
    echo '<tr><th>Nummer</th><th>Klant</th><th>Datum</th><th>Bedrag</th><th>Bekijk</th><th>Betaald?</th></tr>';
    foreach ($bills as &$value) {
            echo '<tr datum="'.$value['datum'].'" class="record pay-'.$value['betaalt'].'"><td>'.$value['nummer'].'</td><td><a href="?klant='.$value['klantId'].'">'.$value['klant'].'</a></td><td>'.$value['datum'].'</td><td>'.$value['bedrag'].'</td><td><a class="btn btn-dark" href="/billing/fpdf/docs/free.php?bill='.$value['nummer'].'"><i class="fa fa-eye"></i></a></td>';
           echo '<td>';
           if($value['betaalt']==1){
               echo "Betaald";
           }
           else{
               echo '<a class="btn btn-dark" href="payed.php?bill='.$value['nummer'].'"><i class="fa fa-check"></i></a>';
           }
           echo '</td>';
           echo '</tr>';
    }
    echo '</table>';
}
function showOptions($ctrl){
$bills=getBills();
$bills=updateKlantenBills($bills);
$bills=updateBedragBills($bills);
    
$bills2=getBills2();
$bills2=updateKlantenBills($bills2);
$bills2=updateBedragBills($bills2);
    
    
$bills3=getBills3();
$bills3=updateKlantenBills($bills3);
$bills3=updateBedragBills($bills3);
    echo "<div class='row' style='padding-right: 15px;'>";
         $ctrl->side_nav();   
        echo "<div class='col-md-9' style='background:url(future.jpg);min-height: 150vh;background-size:cover;'>";
                echo '<div class="well text-center" style="width: 100%;background: rgba(255,255,255,0.8);margin-top:50px; padding:20px;">
                <h1>Uw facturen<a href="create.php"><i class="fas fa-plus-square"></i></a></h1>
                <hr />';

            echo '<div class="row">
            <label>Start:</label>
            <input type="date" name="start" class="form-control" id="startFilter"/>
 
            <label>End:</label>
            <input type="date" name="end"  id="endFilter" class="form-control"/>
        
            <button class="btn btn-dark" style="margin-top:8px;margin-bottom: 8px;" id="filter-knop"> Filter</button>
            </div>';
            
            echo '<div class="row">'; 

             echo '<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Filter
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item sort"  id="payedLink">Betaalt</a>
    <a class="dropdown-item sort" id="unpayedLink">Niet betaalt</a>
    <a class="dropdown-item sort" id="resetLink">Reset Filter</a>
  </div>
</div>';
            
            echo '
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#" id="facturenLink">Facturen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" id="offertesLink">Offerts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" id="bonnenLink">Bestelbonnen</a>
                </li>
            
            </ul>';
            
            echo '<div id="facturenDoos" style="width:100%;">';
               printBills($bills);
 
            echo '</div>';
            
            echo '<div id="offertesDoos" style="width:100%;">';
                printBills($bills3);
            echo '</div>';
            
            echo '<div id="bonnenDoos" style="width:100%;">';
                 printBills($bills2);  
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
    
     <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
       <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
      <script>
        $("#offertesDoos").hide();
        $("#bonnenDoos").hide();
        
        $("#businessList").hide();
        $("#mySiteList").hide();
        $("#horecaList").hide();
        $("#webshopList").hide();
        $("#futureList").hide();
        $("#whrList").hide();
        //
        $("#facturenLink").click(function() {
            $("#facturenDoos").show();
            $("#offertesDoos").hide();
            $("#bonnenDoos").hide();
            $("#facturenLink").addClass( "active" );
            $("#offertesLink").removeClass( "active" );
            $("#bonnenLink").removeClass( "active" );
        });
        
        $("#offertesLink").click(function() {
            $("#facturenDoos").hide();
            $("#offertesDoos").show();
            $("#bonnenDoos").hide();
            $("#offertesLink").addClass( "active" );
            $("#facturenLink").removeClass( "active" );
            $("#bonnenLink").removeClass( "active" );
        });
        
        $("#bonnenLink").click(function() {
            $("#facturenDoos").hide();
            $("#offertesDoos").hide();
            $("#bonnenDoos").show();
            $("#bonnenLink").addClass( "active" );
            $("#facturenLink").removeClass( "active" );
            $("#offertesLink").removeClass( "active" );
        });
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