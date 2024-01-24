<?php 
session_start();

$path = getcwd();
define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/indexController.php"); 


$ctrl=new IndexController();
if($_POST)
{
     $ctrl=new IndexController();
    $conn=$ctrl->getConnection();
$b_id=addOrder();
$tot=0;
$teller= $_SESSION['basket']['teller'];
for ($i = 1; $i <= $teller; $i++) {
    $order= array();
    $order =getProds($_SESSION['basket'][$i]['id']);
        
    $conn=$ctrl->getConnection();
    $sql='INSERT INTO `orderline`( `item`, `aantal`, `bestelling`) VALUES ('.$_SESSION['basket'][$i]['id'].','.$_SESSION['basket'][$i]['amount'].','.$b_id.')';
    if ($conn->query($sql) === TRUE) {
    } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}



$klant=saveKlant();
saveBill($klant);
savePosten();

if(calcTot()<100)
{
    saveExtraKost();
}

sendMails();



for ($i = 1; $i <= $teller; $i++) {
    updateStock($_SESSION['basket'][$i]['id'],$_SESSION['basket'][$i]['amount']);
}

$_SESSION['basket']=null;
header("Location: comform.php");
die();

}
function updateStock($item,$aantal){
     $ctrl=new IndexController();
    $conn=$ctrl->getConnection();
        $sql= "UPDATE `product` SET `aantal`=`aantal`-".$aantal." WHERE id=".$item;

        if ($conn->query($sql) === TRUE) {
            $_SESSION['input']= "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
}
function calcTot(){
      $ctrl=new IndexController();
    $conn=$ctrl->getConnection();
    $sql = "SELECT * FROM `bill_post` where factuur=".$_SESSION['factuur'];
    $tot=0;
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
              $tot=$tot+$row['bedrag'];
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    return $tot;
}
function saveExtraKost()
{
       $ctrl=new IndexController();
    $conn=$ctrl->getConnection();
        
    $omschrijving="verzendkosten";
    $bedrag=6;
    $sql = "INSERT INTO `bill_post`(`factuur`, `omschrijving`, `bedrag`) VALUES (".$_SESSION['factuur'].",'".$omschrijving."',".$bedrag.")";
        
    if ($conn->query($sql) === TRUE) {
               
    } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            die();
    }
    $conn->close();
}


function saveKlant()
{

    
    $naam=strip_tags($_SESSION ["client"]['naam']);    
    filter_var ( $naam, FILTER_SANITIZE_STRING);
    
    $tel=strip_tags($_SESSION ["client"]['tel']);  
    filter_var ( $tel, FILTER_SANITIZE_STRING);
    
    $email=strip_tags($_SESSION ["client"]['email']);    
    filter_var ( $email, FILTER_SANITIZE_EMAIL);
    
    $btw=strip_tags($_SESSION ["client"]['btw']);    
    filter_var ( $email, FILTER_SANITIZE_STRING);
    
   $ctrl=new IndexController();
    $conn=$ctrl->getConnection();

    if(empty($_POST['bus']))
    {
        $_POST['bus']="-";
    }
    $straat=$_POST["straat"]." ".$_POST["nummer"]." ".$_POST['bus'];
    $city=$_POST['postal']." ".$_POST['city'];

    $sql = "INSERT INTO `clients`( `email`, `naam`, `voornaam`, `gsm`, `straat`, `city`,`BTW`) VALUES ('".$email."','".$naam."','".$naam."','".$tel."','".$straat."','".$city."','".$btw."')";

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
{    $ctrl=new IndexController();
    $conn=$ctrl->getConnection();

        $sql = "INSERT INTO `bill`(`btw`, `klant`, `pay`,`soort` ) VALUES ("."21".",".$klant.",'"."overschrijving"."','"."bon"."')";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['input']= "New record created successfully";
            $last = $conn->insert_id;


        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
        
        $_SESSION['factuur']=$last;
}


function savePosten()
{
     $ctrl=new IndexController();
    $conn=$ctrl->getConnection();
    
    $teller= $_SESSION['basket']['teller'];
    for ($i = 1; $i <= $teller; $i++) {
        $order= array();
        $order =getProds($_SESSION['basket'][$i]['id']);
        
        $ctrl=new IndexController();
    $conn=$ctrl->getConnection();
        
        
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
<p>Beste klant, \n U heeft een bestelling ontvangen. U kan uw bestelbon hier bekijken: <a href='https://rafikitrade.be/billing/fpdf/docs/free.php?bill=".$_SESSION['factuur']."'>Bestelbon</a></p>
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
    $conn=$ctrl->getConnection();
    $sql = "SELECT * FROM `product` where aantal>0 and id=".$id;
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
    
    $straat=$_POST["straat"]." ".$_POST["nummer"]." ".$_POST['bus'];
    $city=$_POST['postal']." ".$_POST['city'];
    
    $adres=$straat." ".$city;
     $ctrl=new IndexController();
    $conn=$ctrl->getConnection();
    $sql='INSERT INTO `bestelling`( `naam`, `email`, `tel`, `leveringsaddres`) VALUES ("'.$naam.'","'.$email.'","'.$tel.'","'.$adres.'")';
    if ($conn->query($sql) === TRUE) {
        $last = $conn->insert_id;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
    
    return $last;
}


function getItem()
{
       $ctrl=new IndexController();
    $conn=$ctrl->getConnection();
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


<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
  
  <title>WEBLAND WEBSHOP</title>
  <meta name="description" content=" ">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta property="og:image" content="el-brand.png" />
  <!-- Favicon -->
  <link rel="shortcut icon" type="image/png" href="/img/favicon.png"/>

  <!-- Google Fonts -->
  <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300italic,400italic,700italic,400,300,700' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,300,600,700' rel='stylesheet' type='text/css'>

  <!-- Revolution css -->
  <link rel="stylesheet" type="text/css" href="/vendor/rs-plugin/css/settings.css" media="screen"/>
  <link rel="stylesheet" href="/vendor/rs-plugin/css/extralayer.css">
  
  <!-- Flat icon css -->
  <link rel="stylesheet" href="/vendor/flat-icon/flaticon.css">
  
  <!-- Font awesome -->
  <link rel="stylesheet" href="/vendor/font-awesome/css/font-awesome.min.css">
  
  <!-- Owl Carosel css -->
  <link rel="stylesheet" href="/vendor/owl/css/owl.carousel.css">
  <link rel="stylesheet" href="/vendor/owl/css/owl.theme.default.css">
  <link rel="stylesheet" href="/vendor/owl/css/owl.theme.css">
  
  <!-- mmenu -->
  <link type="text/css" rel="stylesheet" href="/vendor/mmenu/css/jquery.mmenu.css" />
  
  <!-- Bootstrap css -->
  <link rel="stylesheet" href="/vendor/bootstrap/css/bootstrap.css">

  <!-- Animate css -->
  <link rel="stylesheet" href="/css/animate.css">

  <!-- Custom Style css -->
  <link rel="stylesheet" href="/css/hover.css">
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="/css/responsive.css">
  <link href="//cdn.rawgit.com/noelboss/featherlight/1.7.12/release/featherlight.min.css" type="text/css" rel="stylesheet" />
<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<script>window.html5 || document.write('<script src="js/vendor/html5shiv.js"><\/script>')
</script>
<![endif]-->


<style>
     .custom-button {
    padding: 8px 20px;
    border-color: #d7d7d7;
    border-style: solid;
    border-width: 1px;
    color: #929292;
    font-size: 14px;
    font-family: 'Roboto Condensed', sans-serif;
    font-style: italic;
    text-transform: uppercase;
    font-weight: 300;
    letter-spacing: 1.3px;
}

.blog-wrapper .blog-container, .blog-wrapper .blog-date-wrapper {
    padding: 15px;
    border-color: #d7d7d7;
    border-style: solid;
    border-width: 0px 1px 1px 1px;
    padding-bottom: 21px;
}

.frame img {
  border:solid 2px;
  border-bottom-color:#ffe;
  border-left-color:#eed;
  border-right-color:#eed;
  border-top-color:#ccb;
  max-height:100%;
  max-width:100%;
}

.frame {
  background-color:#ddc;
  border:solid 5vmin #eee;
  border-bottom-color:#fff;
  border-left-color:#eee;
  border-radius:2px;
  border-right-color:#eee;
  border-top-color:#ddd;
  box-shadow:0 0 5px 0 rgba(0,0,0,.25) inset, 0 5px 10px 5px rgba(0,0,0,.25);
  box-sizing:border-box;
  display:inline-block;
  margin:10vh 10vw;
  height:80vh;
  padding:8vmin;
  position:relative;
  text-align:center;
  &:before {
    border-radius:2px;
    bottom:-2vmin;
    box-shadow:0 2px 5px 0 rgba(0,0,0,.25) inset;
    content:"";
    left:-2vmin;
    position:absolute;
    right:-2vmin;
    top:-2vmin;
  }
  &:after {
    border-radius:2px;
    bottom:-2.5vmin;
    box-shadow: 0 2px 5px 0 rgba(0,0,0,.25);
    content:"";
    left:-2.5vmin;
    position:absolute;
    right:-2.5vmin;
    top:-2.5vmin;
  }
}

.module {
  background: #f06d06;
  position: relative;
  border: 5px solid black;  
  margin: 20px;
}
.module:after {
  content: '';
  position: absolute;
  top: -15px;
  left: -15px;
  right: -15px;
  bottom: -15px;
  background: white;
  z-index: -1;
}
</style>
</head>
<body>

  <div class="main" id="home">
<header  class="header-part">
  <div id="home" class="wrapper">
      <?php  
        $ctrl->print_nav();
    ?>
</div>
</header>

    <div class="container-fluid" style="padding-top: 150px;">
 <div class="more-area" style="background: #1C79BE;">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <h2 class="text-center">VERZENDADRES</h2>
      </div>
    </div><!-- row -->
  </div><!-- container -->
</div>
        
        <div class="row" style="margin-top:2%;">
            
            <div class="col-md-12">
              
                <form method="post" />
                <label>Straat</label>
                <input type="text" name="straat" class="form-control" />
                <label>Nummer</label>
                <input type="text" name="nummer" class="form-control" />
                <label>Bus</label>
                <input type="text" name="bus" class="form-control" />
                <label>POSTCODE</label>
                <input type="text" name="postal" class="form-control"/>
                <label>GEMEENTE</label>
                <input type="text" name="city" class="form-control"/>
                <input type="submit"  class="btn btn-block" style="margin-top:25px;background: #1C79BE;color:white;"/>
                <p>Wij respecteren uw privacy</p>
                </form>
            </div>
        </div>
        <div classs="row">
            <div style="margin-left: 15%; margin-right: 15%;margin-bottom: 2%">
            </div>
        </div>
    </div>




  <!-- footer -->
  <footer >
    <div class="footer-bottom">
      <div class="container">
        <div class="row">
          <div class="wow zoomIn col-xs-12">
            <p>© 2019 All rights reserved. <span>Webland</span> by <a href="http://webland.be">webland</a> | <a href="http://cogitatio.be/"> Met de steun van Cogitatio</a></p>
            <div class="backtop  pull-right">
              <i class="fa fa-angle-up back-to-top"></i>
            </div><!-- /.backtop -->
          </div><!-- /.col-xs-12 -->
        </div><!-- /.row -->
      </div><!-- /.container -->
    </div><!-- /.creditwrapper -->
  </footer><!-- /Footer -->

</div><!-- /.main -->



<!-- jQuery JS -->
<script src="/js/jquery-1.11.1.js"></script>

<!-- Modernizr JS --> 
<script src="/js/modernizr-2.6.2.min.js"></script>

<!--Bootatrap JS-->
<script src="/vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- REVOLUTION Slider  -->
<script type="text/javascript" src="/vendor/rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
<script type="text/javascript" src="/vendor/rs-plugin/js/jquery.themepunch.revolution.js"></script>

<!-- Shuffle JS -->
<script src="/js/jquery.shuffle.min.js"></script>

<!-- mmenu -->
<script type="text/javascript" src="/vendor/mmenu/js/jquery.mmenu.min.js"></script>

<!-- Owl Carosel -->
<script src="/vendor/owl/js/owl.carousel.min.js"></script>
<script src="/js/wow.min.js"></script>

<!-- waypoints JS-->
<script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>

<!-- Counterup JS -->
<script src="/js/jquery.counterup.min.js"></script>

<!-- Easing JS -->
<script src="/js/jquery.easing.min.js"></script>

<!-- Smooth Scroll JS -->
<script src="/js/scrolling-nav.js"></script>
<script src="/js/smoothscroll.min.js"></script>

<!-- Custom Script JS -->
<script src="/js/script.js"></script>

<!-- Email JS -->
<script src="/js/email.js"></script>

<script src="//code.jquery.com/jquery-latest.js"></script>
<script src="//cdn.rawgit.com/noelboss/featherlight/1.7.12/release/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>

