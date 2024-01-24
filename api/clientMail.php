<?php 
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


$headers = 'From:robot@webland.be' . "\r\n" .
    'Reply-To: info@yumyumsushi.be' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
// get posted data
$data = json_decode(file_get_contents("php://input"));
$client_mail=$_POST['mail'];
$restaurant= $_POST['restaurant'];
$time=$_POST['time'];
if($restaurant=="YUM YUM SUSHI"){
    $msg2="We hebben uw bestelling goed ontvangen. Bedankt voor uw bestelling.";
}else{
    $msg2="We hebben uw bestelling goed ontvangen. Deze is binnen ".$time." klaar.";
}

if(mail($client_mail,"Conformatie bestelling ".$restaurant,$msg2,$headers )){
    $res=json_encode("mail send");
    
    if($_POST['msg']){
        if(mail($_POST['omail'],"U heeft een bestelling ontvangen".$restaurant,$_POST['msg'],$headers )){
            $res=json_encode("mails send");
        }else{
            $res=json_encode("mail send - owner not");
        }
    }
}
else{
     $res=json_encode("mail not send");
}



// set response code - 200 OK
http_response_code(200);
echo $res;
?>