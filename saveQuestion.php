<?php session_start();
$path = getcwd();
$path=$path."/";
define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/indexController.php"); 
$ctrl=new IndexController();
$seo=$ctrl->getSeo();


function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
    
    //SOURCE STACKOVERFLOW
}

if($_POST['question'])
{
     // make connection
     $dwarf=new Opalus();
     $conn=$dwarf->makeConnection();
     
     //CLEAN Question
     $_POST['question'] = filter_var($_POST['question'], FILTER_SANITIZE_STRING);
     //SUBMIT
    $sql = "INSERT INTO `vragen`( `vraag`, `posi`, `nega`, `antw`) VALUES ('".$_POST['question']."',0,0,'".generateRandomString(10)."')";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['input']= "Je vraag is toegevoegd.";
        $last = $conn->insert_id;
    }
    $conn->close();
}


//REDIRECT
header("Location: ruben.php");
die();
?>

