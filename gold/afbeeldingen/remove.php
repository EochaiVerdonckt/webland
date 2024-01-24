<?php session_start();

$path = getcwd();
$path = str_replace("gold/afbeeldingen", "", $path);
define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/adminController.php"); 


$ctrl=new AdminController();
$ctrl->verify();
$conn = $ctrl->getConnection();
$sql = "DELETE FROM `artikel_balance` WHERE id=".$_GET['product'];

if ($conn->query($sql) === TRUE) {
    $_SESSION['input']= "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

header("Location: /gold/afbeeldingen/");
die();