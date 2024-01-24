<?php
session_start();


$path = getcwd();
$path = str_replace("portaal", "", $path);
define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/adminController.php"); 
include (FSPATH."Controllers/indexController.php"); 

$ctrl=new AdminController();
$ctrl->verify();


if(!is_numeric($_GET['id'])){
    echo "NOT ALLOWED";
    die();
} else{
    $id=$_GET['id'];
  if(getFlag($id)=='#000'){
    Install($id);  
  } else{ Uninstall($id); }
}



header("Location: /portaal/index.php");
die();

function getFlag($id){
    $ctrl=new IndexController();
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

function Uninstall($id){
    $ctrl=new IndexController();
    $conn=$ctrl->getConnection();
    $sql = "UPDATE `promo_balance` SET `promo`='#000' WHERE id=".$id;
    if ($conn->query($sql) === TRUE) {
        $_SESSION['input']= "New record created successfully";
        $last = $conn->insert_id;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}

function Install($id){
    $ctrl=new IndexController();
    $conn=$ctrl->getConnection();
    $sql = "UPDATE `promo_balance` SET `promo`='#FFF' WHERE id=".$id;
    if ($conn->query($sql) === TRUE) {
        $_SESSION['input']= "New record created successfully";
        $last = $conn->insert_id;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}


?>


<!-- GELIEVE ZELF JE CODE TE SCHRIJVEN. 130EURO PER GEKOPIEERDE FUNCTIE VOOR VRAGEN CONTACTEER SABAM-->
<!-- (SOFTWARE VALT ONDER DE AUTEURSWETGEVING.)-->