<?php
session_start();


$path = getcwd();
$path = str_replace("klanten", "", $path);

define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/adminController.php"); 
$ctrl=new AdminController();
$clients=$ctrl->selectStatement("clients",1);

 $conn=$ctrl->getConnection(); 
    $rij = array();
    $sql = "SELECT * FROM clients LEFT OUTER JOIN cities ON clients.city = cities.zipcode  where voornaam LIKE '%".$_POST['zoek']."%' OR naam LIKE '%".$_POST['zoek']."%' OR email LIKE '%".$_POST['zoek']."%' OR gsm LIKE '%".$_POST['zoek']."%' OR BTW LIKE '%".$_POST['zoek']."%' GROUP BY cities.structure ";
    $sql;
    $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                array_push($rij,$row);
            }
        } 
    $conn->close();
    $clients=$rij;
    

foreach ($clients as &$client) {
    $client['title']=$client['voornaam']." ".$client['naam']." ".$client['email'];
}
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
http_response_code(200);
echo json_encode($clients);