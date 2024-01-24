<?php
session_start();
$path = getcwd();
$path = str_replace("prices", "", $path);
define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/adminController.php"); 


$ctrl=new AdminController();
$ctrl->verify();


if($_POST['price'])
{
    $conn=$ctrl->getConnection();
    $sql='UPDATE `price_balance` SET `bedrag` = "'.$_POST['price'].'" WHERE id='.$_POST['id'];
    if ($conn->query($sql) === TRUE) {
        $last = $conn->insert_id;
    } 
    else
    {
         echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    header("Location: /prices/");
    die();
   
}
