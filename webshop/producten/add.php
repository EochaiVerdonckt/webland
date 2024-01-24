<?php
session_start();

$path = getcwd();
$path = str_replace("producten", "", $path);
define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/adminController.php"); 
$ctrl= new AdminController();
$conn= $ctrl->getConnection();
        $sql= "UPDATE `product` SET `aantal`=`aantal`+1 WHERE id=".$_GET['id'];

        if ($conn->query($sql) === TRUE) {
            $_SESSION['input']= "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
        header("Location: /producten/detail.php?id=".$_SESSION['catog']);
        die();


?>