<?php session_start();
$path = getcwd();
$path = str_replace("picV2", "", $path);

define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/adminController.php"); 


$ctrl=new AdminController();
$ctrl->verify();
$conn = $ctrl->getConnection();
$sql = "DELETE FROM `albums` WHERE id=".$_GET['product'];
$conn->query($sql);
$conn->close();

header("Location: /afbeeldingen/albums.php");
die();