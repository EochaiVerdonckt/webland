<?php 
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");



// get posted data
$data = json_decode(file_get_contents("php://input"));
$client_mail=$_POST['mail'];
$restaurant= $_POST['restaurant'];
$time=$_POST['time'];
$msg2=$_POST['msg'];

if(mail($client_mail,"U heeft een  bestelling ontvangen".$restaurant,$msg2)){
    $res=json_encode("mail send");
}
else{
     $res=json_encode("mail not send");
}



// set response code - 200 OK
http_response_code(200);
echo $res;
?>