<?php
$path = getcwd();
$path = str_replace("webshop/categ", "", $path);
define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/adminController.php"); 


$ctrl=new AdminController();
$ctrl->verify();
$conn = $ctrl->getConnection();
   
    $sql = "DELETE FROM `catog` WHERE id=".$_GET['id'];
    if ($conn->query($sql) === TRUE) {
        
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    header("Location:index.php");
    die();

?>