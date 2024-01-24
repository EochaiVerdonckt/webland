<?php
session_start();
$path = getcwd();
$path = str_replace("reservaties", "", $path);
define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/adminController.php"); 
include (FSPATH."Controllers/indexController.php"); 

$ctrl=new AdminController();
if(!is_numeric($_GET['id']))
{
    echo "NOT A VALID FLAG";
    die();
}


function getItem($id)
{
    $ctrl=new AdminController();
    $conn = $ctrl->getConnection();
    $rij = array();


    $sql = "SELECT * FROM `price_balance` where id=".$id;
    $item=array();
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $item = $row;
        }

    } else {
        echo "item niet gevonden.";
        die();
    }
    $conn->close();
    return $item;
}

function getVerlofState()
 {
   

    $rij = array();
    $ctrl=new AdminController();
    $conn = $ctrl->getConnection();

    $sql = "SELECT * FROM `order_params` where id=1";
    $item=array();
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $item = $row['vlag'];
        }

    } else {
        echo "item niet gevonden.";
        die();
    }
    $conn->close();
    return $item;
 }
 
 
 
function getWachttijd()
 {

    $rij = array();
    $ctrl=new AdminController();
    $conn = $ctrl->getConnection();

    $sql = "SELECT * FROM `order_params` where id=2";
    $item=array();
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $item = $row['vlag'];
        }

    } else {
        echo "item niet gevonden.";
        die();
    }
    $conn->close();
    return $item;
 }

function print_header_flugzeug(){
    echo '
    <!--HEADER-->
    <div class="row" style="border-bottom: 1px solid black;    margin-right: 0;margin-left: 0;" id="header">
        <div class="col-lg-4 col-md-4 col-sm-4">
            <a href="index.php">
                <img src="logo.png" alt="logo" id="logo" width="100%;"/>
            </a>
        </div>   
        <div class="col-lg-1 col-md-1 col-sm-1 ol-lg-offset-1 col-md-offset-1 col-sm-offset-1">
             <a href="https://www.facebook.com/ERAFlugzeug">
                <img src="facebookIcon.png"  style="width: 100%; max-width: 50px;"/>
             </a>   
        </div>   

    ';
}

function toonlijst()
{
    echo '<div class="col-lg-8">';
   
    $rij = array();
    $ctrl=new AdminController();
    $conn = $ctrl->getConnection();
    

    $gisteren=new DateTime('now');
    $gisteren->setTime(00, 00);
    $gisteren= $gisteren->format('Y-m-d H:i:s');
    $sql = "SELECT * FROM `bestelling` where id=".$_GET['id'];
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
    $last=null;
    foreach ($rij as &$value) {
        $time=strtotime($value['tijd']);
        $time = $time+2*3600;
         echo '<div style="margin-left:8px;">
         <h1 style="color: black;font-weig ht:800;">YUM YUM SUSHI</h1>
         ';
         
    echo '<h2 style="color: black;">Niluwa BV</h2>';
    echo '<h4 style="color: black;">Tiensestraat 90</h4>';
      echo '<h4 style="color: black;">3000 Leuven</h4>';
          echo '<h3 style="color: black;">BTW: BE07 4958 9571</h3>';
         echo '<h3 style="color: black;font-weight:800;margin-top:25px;">Leveringsbon</h3>';
          echo '<h5> '.date('d/m/Y H:i:s', $time).'</h5>';
        if(empty($last))
        {
            $last=$value['id'];
        }
        echo '<h3 style="margin-top:25px;color: black;font-weight:800;">'.$value['naam'].'</h3>';
        echo '<h3> Tel: '.$value['tel'].'</h3>';
       
        if($value['leveringsaddres']=='Take away'){
             echo '<h3>'.$value['leveringsaddres'].'</h3>';
        }  else{
            echo '<h3>'.$value['leveringsaddres'].' '.$value['huisnr'].'</h3>';
            echo '<h3>'.' Bus:'.$value['bus'].'</h3>';
           
            echo '<h3>'.$value['postal'].'</h3>';
        }
        if(!empty($value['levertijd']))
        {
            echo '<h3 style="border-top: 1px solid white;"> Lever: '.$value['levertijd'].'</h3>';
        }
        
        echo "<div style='padding:20px;padding-left:15px;width:35%;background: rgba(0,0,0,0.6);'><span style='font-size: 2em;color: white;'>".$value['comment']."</span></div></div>";
        $tot=0;

    $ctrl=new AdminController();
    $conn = $ctrl->getConnection();

        $sql = "SELECT * FROM `orderline` WHERE `bestelling`=".$value['id'];
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            echo '<table style="width: 100%; padding: 2%;padding-left:0;">';
            while($row = mysqli_fetch_assoc($result)) {
                $o=getItem($row['item']);
                
                if($o['cat']=="79" || $o['cat']=="83" )
                {
                    if($item['id']<727 && $item['id']>721 )
                    {
                    echo '<tr>';
                    echo '<td style="text-align: left;"><span style="font-size: 2em; color: black;">'.$row['aantal'].'x </span>'.$o['naam'].'</td>';
                    echo '<td>'.$o['bedrag'].' EUR</td>';
                 
                    if(!empty($row['saus']))
                    {
                        echo '<td >Saus: '.$row['saus'].'</td>';
                    }
                    echo '</tr>';
                    $tot=$tot+$o['bedrag']*$row['aantal']; 
                    }
                    else
                    {
                    $aantal=0;
                    $formaat=explode(";", $row['formaat']);
                    while($aantal<$row['aantal'])
                    {
                        if($formaat[$aantal]=="Klein")
                        {
                            echo '<tr>';
                            echo '<td style="border-top: 1px solid white; text-align: left; ">'.$o['naam'].' Klein</td>';
                            echo '<td style="border-top: 1px solid white;">'.$o['bedrag'].' EUR</td>';
                            echo '</tr>';
                            $tot=$tot+$o['bedrag'];
                        }
                        else
                        {
                            echo '<tr>';
                            echo '<td style="border-top: 1px solid white; text-align: left;">'.$o['naam'].' Groot</td>';
                            echo '<td style="border-top: 1px solid white;">'.$o['bedrag2'].' EUR</td>';
                            echo '</tr>';
                            $tot=$tot+$o['bedrag2'];
                        }
                        $aantal++;
                    }   
                    }
                }
                else
                {
                    echo '<tr>';
                    echo '<td style="font-weight:700;border-top: 1px solid white; text-align: left;"><span style="font-size: 2em; font-weight: 900; color: black;">'.$row['aantal'].'x </span>'.$o['naam'].'</td>';
                    echo '<td style="border-top: 1px solid white;">'.$o['bedrag'].' EUR</td>';
                    
                    if(!empty($row['saus']))
                    {
                        echo '<td style="border-top: 1px solid white;">Saus: '.$row['saus'].'</td>';
                    }
                    echo '</tr>';
                    $tot=$tot+$o['bedrag']*$row['aantal'];    
                }
            }
            echo '</table>';
            echo "<h1 style='color:black; font-wieght:600;'>Totaal: ".$tot." EUR</h1>";
        } else {
            echo "0 results";
        }
        $conn->close();
    }
    echo '</div>';
    echo "<h1 id='laatste' style='visibility:hidden;'>".$last."</h1>";
}


function calcProfit()
{

    $rij = array();
    $tot=0;
       $ctrl=new AdminController();
    $conn = $ctrl->getConnection();

    $gisteren=new DateTime('now');
    $gisteren->setTime(00, 00);
    $gisteren= $gisteren->format('Y-m-d H:i:s');
    $sql = "SELECT * FROM `bestelling` ORDER BY id desc";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            array_push($rij,$row);
        }

    } else {
       
    }

    $conn->close();
    $last=null;
    foreach ($rij as &$value) {
        if(empty($last))
        {
            $last=$value['id'];
        }
    $ctrl=new AdminController();
    $conn = $ctrl->getConnection();

        $sql = "SELECT * FROM `orderline` WHERE `bestelling`=".$value['id'];
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
           
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                $o=getItem($row['item']);
                
                if($o['cat']=="79" || $o['cat']=="83" )
                {
                    if($item['id']<727 && $item['id']>721 )
                    {
                        $tot=$tot+$o['bedrag']*$row['aantal']; 
                    }
                    else
                    {
                        $aantal=0;
                        $formaat=explode(";", $row['formaat']);
                    while($aantal<$row['aantal'])
                    {
                        if($formaat[$aantal]=="Klein")
                        {
                            $tot=$tot+$o['bedrag'];
                        }
                        else
                        {
                            $tot=$tot+$o['bedrag2'];
                        }
                        $aantal++;
                    }   
                    }
                }
                else
                {
                    $tot=$tot+$o['bedrag']*$row['aantal'];    
                }
            }
            
            
        } else {

        }
        $conn->close();
    }
   // echo "<h5>Total profit: ".$tot." EUR</h5>";
}


function verify()
{

    if(!$_SESSION['user'])
    {
        if($_POST)
        {
            if($_POST['user']=="l-admin" && $_POST['pass']=="pizza2018")
            {
                $_SESSION['user']="ok";
            }
            else
            {
                echo '
        
                                <form method="post" class="text-left" style="margin-top: 2%;">
                                    <label style="margin-top: 2%;">USER</label>
                                    <input type="text"  name="user" class="form-control"/>
                                    <label style="margin-top: 2%;">PASSWORD</label>
                                    <input type="password"  name="pass" class="form-control"/>
                                    <input type="submit"  class="form-control" style="margin-top: 2%;"/>
                                    <span>Foute login gegevens</span>
                                </form>
        ';
            }

        }
        else
        {
            echo '
        
                                <form method="post" class="text-left" style="margin-top: 2%;">
                                    <label style="margin-top: 2%;">USER</label>
                                    <input type="text"  name="user" class="form-control"/>
                                    <label style="margin-top: 2%;">PASSWORD</label>
                                    <input type="password"  name="pass" class="form-control"/>
                                    <input type="submit"  class="form-control" style="margin-top: 2%;"/>
                                </form>
        ';
        }
    }
}


function showOptions()
{



 
    echo '<div class="row">';
   

    toonlijst();
    echo "</div>";
    //END ROW 2
}

?>




<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>MyMenu | voeg je menu toe.</title>

    <meta name="description" content="Beautiful Balance Bunsbeek | Massages, schoonheid en persoonlijke verzorging" />
    <meta name="google-site-verification" content="ExQ89lGiGlXTIDoWcfx5CxMkRu-Wtubn8FYir2BJRU8" />
 <!-- Bootstrap Css -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet">

    <!-- Style -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" >
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="container-fluid ruimte-top">


    <?php verify();?>

    <div class="row" style="padding-bottom: 1%; background-color: white;">

    </div>
    <h2> <?php print_r(calcProfit()); ?></h2>
    
    <?php
    if($_SESSION['user']=="ok")
    {
        showOptions();
    }
    ?>
<script>
    window.print();
    setTimeout(function () { window.location.href = 'index.php'; }, 1000);
</script>
</body>
</html>
<!-- GELIEVE ZELF JE CODE TE SCHRIJVEN. SHIVAN GE SUCKT. 130EURO PER GEKOPIEERDE FUNCTIE VOOR VRAGEN CONTACTEER SABAM-->
<!-- (SOFTWARE VALT ONDER DE AUTEURSWETGEVING.)-->