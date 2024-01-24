<?php session_start();

$path = getcwd();
$path = str_replace("horeca/prices", "", $path);

define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/adminController.php"); 
include (FSPATH."Controllers/indexController.php"); 

$ctrl=new AdminController();
$ctrl->verify();
if(!is_numeric($_GET['id']))
{
    echo "NO HAX ALLOWED";
    die();
    
}
    $conn= $ctrl->getConnection();

    //$sql = "INSERT INTO `product`( `naam`, `info`,`price`) VALUES (,,".."')";
    $sql = "DELETE FROM `cat_balance` WHERE id=".$_GET['id'];
    if ($conn->query($sql) === TRUE) {
        $_SESSION['input']= "New record created successfully";
        $last = $conn->insert_id;


    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();


header("Location: index.php");
die();



?>