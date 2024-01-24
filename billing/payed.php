<?php
session_start();


$path = getcwd();

define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/adminController.php"); 

$ctrl=new AdminController();
$ctrl->verify();

if(!is_numeric($_GET['bill'])){
    echo "NOT ALLOWED";
    die();
}
  $conn = $ctrl->getConnection();
    $sql = "UPDATE `bill` SET `betaalt`='1' WHERE nummer=".$_GET['bill'];
    if ($conn->query($sql) === TRUE) {
            //$_SESSION['input']= "Opgeslagen in de databank.";
           $_SESSION['input']=$sql; 
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        die();
    }
    $conn->close();

header('Location: /billing/');
exit();
?>