<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");



session_start();
require('functies.php');

if($_POST){
    $servername = "webland.be.mysql";
    $username = "webland_be_webland";
    $password = "Luckies7Databank";
    $dbname = "webland_be_webland";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // prepare sql and bind parameters
        if (false === ( $stmt = $conn->prepare("INSERT INTO `studentid_bmi`(`length`, `mass`, `age`, `result`) VALUES (:length,:mass,:age,:result)"))) {
           echo 'error preparing statement: ' . $conn->error;
         
        }
        
        $length=filter_var ($_POST['lengte'], FILTER_SANITIZE_STRING); 
        $mass=filter_var ($_POST['gewicht'], FILTER_SANITIZE_STRING); 
        $age=filter_var ($_POST['leeftijd'], FILTER_SANITIZE_STRING); 
        $result=filter_var ($_POST['bmi'], FILTER_SANITIZE_STRING); 
        echo 'lengte'.$length.' gewicht'.$mass.' age:'.$age.' result'.$result;
        
        
        $stmt->bindParam(':length', $length);
        $stmt->bindParam(':mass', $mass);
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':result', $result);
        $stmt->execute();
       
       
          $conn = null;
        echo  " DE BMI CALCULATIE IS OPGESLAGEN.";
    } catch(PDOException $e) {
       echo $e->getMessage();
    }
      
    
}
?>

