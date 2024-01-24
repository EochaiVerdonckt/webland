<?php 
session_start();

$path = getcwd();
define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/indexController.php"); 

$ctrl=new IndexController();
$b_id=addOrder();
$tot=0;
$teller= $_SESSION['basket']['teller'];
for ($i = 1; $i <= $teller; $i++) {
    $order= array();
    $order =getProds($_SESSION['basket'][$i]['id']);
    $conn= $ctrl->getConnection();
    $sql='INSERT INTO `orderline`( `item`, `aantal`, `bestelling`) VALUES ('.$_SESSION['basket'][$i]['id'].','.$_SESSION['basket'][$i]['amount'].','.$b_id.')';
    
    updateStock($_SESSION['basket'][$i]['id'],$_SESSION['basket'][$i]['amount']);
    
    if ($conn->query($sql) === TRUE) {
    } else {
            echo "Error for loop: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}



$klant=saveKlant();
saveBill($klant);
savePosten();
sendMails();

for ($i = 1; $i <= $teller; $i++) {
    updateStock($_SESSION['basket'][$i]['id'],$_SESSION['basket'][$i]['amount']);
}

$_SESSION['basket']=null;
header("Location: comform.php");
die();

function updateStock($item,$aantal){
    $ctrl=new IndexController();
    $conn= $ctrl->getConnection();
        $sql= "UPDATE `product` SET `aantal`=`aantal`-".$aantal." WHERE id=".$item;

        if ($conn->query($sql) === TRUE) {
            $_SESSION['input']= "New record created successfully";
        } else {
            echo "Error update stock: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
}

function saveKlant()
{
  $ctrl=new IndexController();
$conn= $ctrl->getConnection();
    
    $naam=strip_tags($_SESSION ["client"]['naam']);    
    filter_var ( $naam, FILTER_SANITIZE_STRING);
    
    $tel=strip_tags($_SESSION ["client"]['tel']);  
    filter_var ( $tel, FILTER_SANITIZE_STRING);
    
    $email=strip_tags($_SESSION ["client"]['email']);    
    filter_var ( $email, FILTER_SANITIZE_EMAIL);
    
    $btw=strip_tags($_SESSION ["client"]['btw']);    
    filter_var ( $email, FILTER_SANITIZE_STRING);
   

    $sql = "INSERT INTO `clients`( `email`, `naam`, `voornaam`, `gsm`, `straat`, `city`,`BTW`) VALUES ('".$email."','".$naam."','".$naam."','".$tel."','"."GEEN"."','"."GEEN"."','".$btw."')";

    if ($conn->query($sql) === TRUE) {
        $last = $conn->insert_id;
    } 
    else
    {
        echo "FAILED";
        die();
    }
    $conn->close();
    return $last;
}


function saveBill($klant)
{
    $ctrl=new IndexController();
$conn= $ctrl->getConnection();


        $sql = "INSERT INTO `bill`(`btw`, `klant`, `pay`,`soort` ) VALUES ("."21".",".$klant.",'"."overschrijving"."','"."bon"."')";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['input']= "New record created successfully";
            $last = $conn->insert_id;


        } else {
            echo "Error SaveBill: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
        
        $_SESSION['factuur']=$last;
}


function savePosten()
{
   $ctrl=new IndexController();
   $conn= $ctrl->getConnection();
    
    $teller= $_SESSION['basket']['teller'];
    for ($i = 1; $i <= $teller; $i++) {
        $order= array();
        $order =getProds($_SESSION['basket'][$i]['id']);
        
         $ctrl=new IndexController();
   $conn= $ctrl->getConnection();
        
        
        $omschrijving=$order["naam"]." (".$_SESSION['basket'][$i]['amount'].")";
        $bedrag=$_SESSION['basket'][$i]['amount']*$order['prijs'];
        $sql = "INSERT INTO `bill_post`(`factuur`, `omschrijving`, `bedrag`) VALUES (".$_SESSION['factuur'].",'".$omschrijving."',".$bedrag.")";
        
        if ($conn->query($sql) === TRUE) {
               
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            die();
        }
    $conn->close();
    }
}

function sendMails(){
   sendMailClient(); 
   sendMailOwner();
}
function sendMailClient()
{
    $email=strip_tags($_SESSION ["client"]['email']);    
    filter_var ( $email, FILTER_SANITIZE_EMAIL);
    $to = "somebody@example.com, somebodyelse@example.com";
    $subject = "HTML email";
    $message = "<html><head><meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
<title>HTML email</title>
</head>
<body>
<p>Beste klant, \n We hebben uw bestelling ontvangen. U kan uw bestelbon hier bekijken: <a href='https://rafikitrade.be/billing/fpdf/docs/free.php?bill=".$_SESSION['factuur']."'>Bestelbon</a></p>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <info@webland.be>' . "\r\n";
$headers .= 'Cc: e.verdonckt@live.com' . "\r\n";
mail($email,"Uw bestelling van Rafikitrade",$message,$headers);
}

function sendMailOwner()
{
    $email=strip_tags("claude_mun@yahoo.fr");    
    filter_var ( $email, FILTER_SANITIZE_EMAIL);
    $to = "somebody@example.com, somebodyelse@example.com";
    $subject = "HTML email";
    $message = "<html><head><meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
<title>HTML email</title>
</head>
<body>
<p>Beste klant, \n U heeft een bestelling ontvangen. U kan uw bestelbon hier bekijken: <a href='https://electrozwaantjes.be/billing/fpdf/docs/free.php?bill=".$_SESSION['factuur']."'>Bestelbon</a></p>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <info@webland.be>' . "\r\n";
$headers .= 'Cc: e.verdonckt@live.com' . "\r\n";
mail($email,"Een bestelling van uw Webland website",$message,$headers);
}

function getProds($id)
{
    $ctrl=new IndexController();
    $conn= $ctrl->getConnection();
    
    $sql = "SELECT * FROM `product` where  id=".$id;
    $rij=array();
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
               $rij=$row;
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    return $rij;
}

function addOrder()
{
    $naam=strip_tags($_SESSION ["client"]['naam']);    
    filter_var ( $naam, FILTER_SANITIZE_STRING);
    
    $tel=strip_tags($_SESSION ["client"]['tel']);  
    filter_var ( $tel, FILTER_SANITIZE_STRING);
    
    $email=strip_tags($_SESSION ["client"]['email']);    
    filter_var ( $email, FILTER_SANITIZE_EMAIL);
    
   $ctrl=new IndexController();
    $conn= $ctrl->getConnection();
    $sql='INSERT INTO `bestelling`( `naam`, `email`, `tel`) VALUES ("'.$naam.'","'.$email.'","'.$tel.'")';
    if ($conn->query($sql) === TRUE) {
        $last = $conn->insert_id;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
    
    return $last;
}


function getItem(){
    $ctrl=new IndexController();
    $conn= $ctrl->getConnection();

    $sql = "SELECT * FROM `price_balance` where id=".$_GET['item'];
    $item=array();
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $item = $row;
        }

    } else {
        echo "item niet gevonden.";
        die();
    }

    $conn->close();
    return $item;
}
function print_chat()
{
	    echo '
	    
	    <div style=" position:fixed;right:5px; bottom: 0;">
            <div onclick="showChat()" id="chatbox" class="btn-info btn" style="border-color: black; background-color: black;">  <p style="color:white;"><i class="fa fa-commenting-o fa-2x"></i><span style="padding-left:8px;">Chat met ons.</span></p></div>
        </div>
	        <div  id="chatBox" style="float:right;display:none; position:fixed;right:1%; bottom: 0;">
	            <div class"btn btn-block btn-info" style="border-color: black; background-color: black;color:white;"><i class="fa fa-times" style="    padding-left: 90%;" onclick="hideChat()"></i></div>
                <div class="fb-page" data-href="https://www.facebook.com/Facefood-404004530056120/" data-tabs="messages" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"></div>    
            </div>
	        <script>
	            function showChat() {
                    document.getElementById("chatBox").style.display="initial" ;
                }
                function hideChat() {
                    document.getElementById("chatBox").style.display="none" ;
                }
	        </script>
	    ';
}
?>
