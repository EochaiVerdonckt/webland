<?php session_start();
$path = getcwd();
$path=$path.'/';

define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/adminController.php"); 
include (FSPATH."Controllers/indexController.php"); 

$ctrl=new AdminController();
function getConnection(){
    $dwarf= new Opalus();
    $conn= $dwarf->makeConnection();
    return $conn;
}
function print_basket(){
    if(empty($_SESSION['basket']))
    {
        return;
    }
     $tot=0;
    $teller= $_SESSION['basket']['teller'];
    for ($i = 1; $i <= $teller; $i++) {
            $order =getItem($_SESSION['basket'][$i]['item']);
            $tot=$tot+$_SESSION['basket'][$i]['aantal']*$order['bedrag'];
       }
       $tot =  $bedrag=money_format('%.2n', $tot);
    echo '
    <div style="min-width:10%; position: fixed; top:10%;right: 2%;z-index:10000;">
    <a href="checkout.php"  role="button">
    <div class="thumbnail text-center" style="border:2px solid black;background: white;">
      <span class="badge" style="float:right;">'.$_SESSION['basket']["teller"].'</span>
      <div class="text-center" style="padding: 10px;">
      <i class="fa fa-shopping-basket fa-5x" style="color: black"></i>
      </div>
      <div class="caption">
      <h3>Totaal: '.$tot.'</h3>
        <p class="btn btn-danger btn-block"><i class=" fa fa-arrow-right"> </i></p>
      </div>
    </div>
    </a>
    </div>';

    
}
function getItem($id)
{
    $ctrl=new AdminController();
    $conn=$ctrl->getConnection();

    $sql = "SELECT * FROM `price_balance` where id=".$id;
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
function toonLijstEten(){
    
  $vlag=getFlag();
  echo '<div class="pagebreak"> </div>';
  echo '<div class="col-lg-12" style="padding: 2px;">';
  $conn=getConnection();
  $rij = array();
  $sql = "SELECT * FROM cat_balance  WHERE `DrankofEten`=1 AND id!=112 ORDER by sort";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
        // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        array_push($rij,$row);
    }

    } else {
        echo "0 results";
    }

    $conn->close();

    foreach ($rij as &$value) {
        
        echo '<img src="/prices/'.$value['img'].'" style="width:100%;margin-top:12px;" />';
        echo '<h3 class="text-center title-cat" style="font-size: 3em;font-weight: bolder;color: red;
}" id="'.$value['naam'].'">'.$value['naam'].'</h3>';
        echo '<h1 class="text-center" style="color: black;">'.$value['comment'].'</h1>';
        $conn=getConnection();
        $sql = "SELECT * FROM price_balance where cat=".$value['id']." ORDER BY sort";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $teller=0;
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                $teller=$teller+1;
                $vlag=1;
                if($vlag==0)
                {
                  echo '<div class="col-lg-12 kader02" style="padding-top:30px; padding-bottom:20px;border-bottom:1px solid black;">';
                  echo '<div style="text-align: left;">';
                  echo '<h2 class="title-cat" style="color: black; font-weight: 900;style="margin-bottom:0px;" ">'.$row['naam'];
                  echo ' <span style="color: red; font-weight: 900; ">'.$row['bedrag'].'&#8364;</span>';
                  echo '<i class="fa fa-plus" style="display:none;padding: 11px; float: right;margin-top:-31px;margin-right:-15px;"></i>';
                  echo '</h2>';
                   if(strlen ($row['comment'])>1)
                    {
                        echo '<h3 style="margin-top:0px;color:red;">'.$row['comment'].'</h3>';
                    }
                    echo '</div>';
                    echo '</div>';
                }
                else
                {
                    
                  echo '<a class="" href="add.php?item='.$row["id"].'" style="color: black;text-align: left;">';
                  echo '<div class="col-lg-12 kader02" style="border-bottom:1px solid black;">';
                  echo '<h2 class="title-cat" style="color: black; font-weight: 900;margin-bottom:0px; " class="item-name">'.$row['naam'];
                
                  echo ' <span style="color: red; font-weight: 900; ">'.$row['bedrag'].'&#8364;</span>';
                  echo '<i class="fa fa-plus" style="float: right;"></i>';
                  echo '</h2>';
                   if(strlen ($row['comment'])>1)
                    {
                         echo '<h3 style="margin-top:0px;color:#7f7f7f" class="item-comment">'.$row['comment'].'</h3>';
                    }
                    echo '</div>';
                    echo '</a>';
                }
            }
        } 
        $conn->close();
    }


    echo '</div>';
}
function toonlijst(){
    toonLijstEten();
}
function showOptions(){
    echo '<div class="row" style="" id="itemsRow">';
    toonlijst();
    echo "</div>";
}
function getSecundair(){
    $conn=getConnection();
    $sql = "SELECT * FROM `colors` WHERE id=3";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $item=$row['waarde'];
        }

    } 
    $conn->close();
    return $item;
}
function getVerlofState(){
  $conn=getConnection();
    $rij = array();

    $sql = "SELECT * FROM `order_params` where id=1";
    $item=array();
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $item = $row['vlag'];
        }

    } else {
        echo "item niet gevonden.";
        die();
    }
    $conn->close();
    return $item;
 }
function getOrderState(){
    $rij = array();
  $conn=getConnection();
    $sql = "SELECT * FROM `order_params` where id=3";
    $item=array();
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $item = $row['vlag'];
        }

    } else {
        echo "item niet gevonden.";
        die();
    }
    $conn->close();
    return $item;
 }
function getWachttijd(){
   
    $rij = array();
  $conn=getConnection();
    $sql = "SELECT * FROM `order_params` where id=2";
    $item=array();
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $item = $row['vlag'];
        }

    } else {
        echo "item niet gevonden.";
        die();
    }
    $conn->close();
    return $item;
 }
function getFlag(){
    $verlof=getVerlofState();
    $state=getOrderState();
    $value=1;
    if(date("w")==2 || $verlof==1 || $state==0)
    {
        $value=0;
    }
    else{
        $value=1;
    }
  

    return $value;
}
function getCompanyData(){
    $conn=getConnection();
    $rij = array();
    $sql = "SELECT * FROM `Gegevens` order by id";
    $item=array();
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            array_push($item, $row);
        }

    } 

    $conn->close();
    return $item;
}
function getMessage(){
    $verlof=getVerlofState();
    $phone= getCompanyData();
    $phone= $phone[3]['waarde'];
    if(date("w")==3)
    {
        $verlof=1;
    }
    if($verlof==1)
    {
        return 'Het restaurant is momenteel gesloten.';
    }
    else
    {
      $state=getOrderState();
      if($state==0)
      {
          return 'Wegens drukte is bestellen momenteel niet mogelijk. Telefonisch bestellen kan op: '.$phone;
      }
      else
      {
          
           switch (getWachttijd()) {
    case 0:
        $wacht="15 min.";
        break;
    case 1:
       $wacht="30 min.";
        break;
    case 2:
        $wacht="45 min.";
        break;
     case 3:
        $wacht="60 min.";
        break;    
}
           return 'Gemiddelde wachttijd is '.$wacht;
      }
     
    }

}
function getCats(){
  $conn=getConnection();
  $rij = array();
  $sql = "SELECT * FROM cat_balance  WHERE `DrankofEten`=1 AND id!=112 ORDER by sort";
  $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            array_push($rij,$row);
        }
    } else {
        echo "0 results";
    }

    $conn->close();
    return $rij;
}
function getSideButtons(){
    $ctrl=new AdminController();
    $conn=$ctrl->getConnection();

    $sql = 'SELECT * FROM `slide_opt` WHERE naam="button"';
    $item=array();
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            array_push($item,$row);
        }

    } else {
        echo "0 results";
    }

    $conn->close();
    return $item;
}
function getServices(){
    $ctrl=new AdminController();
    $conn=$ctrl->getConnection();

    $sql = "SELECT * FROM services";
    $item=array();
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            array_push($item,$row);
        }

    } else {
        echo "0 results";
    }

    $conn->close();
    return $item;
}
function print_artikels(){

    $ctrl=new AdminController();
    $conn=$ctrl->getConnection();
    $sql = "SELECT * FROM artikel_balance where state=1";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $state =  trim($row['state']);
            $id= trim($row['id']);
            echo '<div class="col-lg-4">';
            echo '<div class="thumbnail" style="border: 10px double gray;background:yellow;    padding: 0;"><div style="background: white;">
                    <img src="/news/'.$row['foto'].'" width="100%;" alt="">
                    <div class="caption" style="background: black;padding-top: 2%;margin-top: 2%;">              
                       '.$row['info'].'
                       <p> 
                      ';
            echo '</p></div>
                 </div></div></div>';
        }
    }
    mysqli_close($conn);
}
function getPromo(){
    $ctrl=new AdminController();
    $conn=$ctrl->getConnection();

    $sql = "SELECT promo FROM promo_balance where id=1";
    $item='';
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $item = $row['promo'];
        }

    } else {
        echo "0 results";
    }

    $conn->close();
    return $item;
}
function getHours(){
    $ctrl=new AdminController();
    $conn=$ctrl->getConnection();
    
    $sql = "SELECT * FROM hours";
    $item=array();
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            array_push($item,$row);
        }

    }
    else
    {
        echo "LOAD HOURS FAILED;";
    }

    $conn->close();
    return $item;
}
$slide_buttons=getSideButtons();
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>BESTEL VANDAAG NOG</title>
  <meta name="description" content="BESTEL VANDAAG NOG">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta property="og:image"              content="logo.png" />
  <!-- Favicon -->
  <link rel="shortcut icon" type="image/png" href="img/favicon.png"/>
<link href="https://fonts.googleapis.com/css?family=Dancing+Script&amp;display=swap" rel="stylesheet">
  <!-- Google Fonts -->
  <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:300italic,400italic,700italic,400,300,700' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,300,600,700' rel='stylesheet' type='text/css'>
  <link href="//cdn.rawgit.com/noelboss/featherlight/1.7.12/release/featherlight.min.css" type="text/css" rel="stylesheet" />
  <!-- Revolution css -->
  <link rel="stylesheet" type="text/css" href="vendor/rs-plugin/css/settings.css" media="screen"/>
  <link rel="stylesheet" href="vendor/rs-plugin/css/extralayer.css">
  
  <!-- Flat icon css -->
  <link rel="stylesheet" href="vendor/flat-icon/flaticon.css">
  
  <!-- Font awesome -->
  <link rel="stylesheet" type="text/css" media="screen" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Owl Carosel css -->
  <link rel="stylesheet" href="vendor/owl/css/owl.carousel.min.css">
  <link rel="stylesheet" href="vendor/owl/css/owl.theme.default.css">
  <link rel="stylesheet" href="vendor/owl/css/owl.theme.css">
  
  <!-- mmenu -->
  <link type="text/css" rel="stylesheet" href="vendor/mmenu/css/jquery.mmenu.css" />
      <link rel="stylesheet" type="text/css" href="/slick/slick/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="/slick/slick/slick/slick-theme.css"/>
  <!-- Bootstrap css -->
  <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.css">

  <!-- Animate css -->
  <link rel="stylesheet" href="css/animate.css">

  <!-- Custom Style css -->
  <link rel="stylesheet" href="css/hover.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/responsive.css">
  <link href="https://fonts.googleapis.com/css2?family=Rancho&display=swap" rel="stylesheet">
  
<style>
 #gototop {
    display: inline-block;
    width: 60px;
    height: 60px;
    background: black;
    position: fixed;
    margin-left: -30px;
    top: 90%;
    border-radius: 50%;
    right: 5%;
    z-index: 5;
    color: white;
    padding-top: 10px;
}
.menu-slide{
    font-size:2em;
}
.catogs{
    color: white;
    padding-top:12px;
    padding-bottom:12px;
}

#smallScreen
{
    display:none;
}
h2, .h2 {
    font-size: 30px;
}
h3, .h3 {
    font-size: 24px;
}
@media only screen and (max-width: 800px) {
  #Bigscreen {
   display: none;
  }
  
  #smallScreen
{
    display:block !important;
}
}

@media only screen and (max-width: 600px) {
.order-box{
       display: none !important;
  }
}
.small-title {
    background: white;
    color: black;
}
.small-title:after {
    position            : absolute;
    content             : " ";
    top                 : 0;
    right               : 0;
    width               : 30px;
    height              : 38px;
    margin-right        : -20px;
    border-left         : 20px solid transparent;
    border-right        : 20px solid transparent;
    border-bottom       : 40px solid white;
}

.small-title:before {
    position            : absolute;
    content             : " ";
    top                 : 0;
    right               : 0;
    margin-right        : -28px;
    width               : 10px;
    height              : 39px;
     background         : white !important;
    -webkit-transform   : skew(27deg);
    -moz-transform      : skew(27deg);
    -o-transform        : skew(27deg);   
    -ms-transform       : skew(27deg);   
    -ms-filter          : "progid:DXImageTransform.Microsoft.Matrix(M11=0.7071067811865483, M12=0, M21=-0.7071067811865467, M22=1.4142135623730934, SizingMethod='auto expand')";
}

.kader02{
    border: 1px solid white;
    padding-top:30px;
    padding-bottom:20px;
}

@media only screen and (min-width : 480px) and (max-width : 767px) {

    .small-title:after {
    position     : absolute;
    content      : " ";
    top          : 0;
    right        : 0;
    width        : 30px;
	height       : 18px;
	margin-right : -20px;
	border-left  : 0px solid transparent;
	border-right : 15px solid transparent;
	border-bottom: 18px solid #000000;;
}

.small-title:before {
    position            : absolute;
    content             : " ";
    top                 : 0;
    right               : 0;
    margin-right        : -25px;
    width               : 7px;
    height              : 18px;
     background         : white !important;
    -webkit-transform   : skew(40deg);
    -moz-transform      : skew(40deg);
    -o-transform        : skew(40deg);   
    -ms-transform       : skew(40deg);   
    -ms-filter          : "progid:DXImageTransform.Microsoft.Matrix(M11=0.7071067811865483, M12=0, M21=-0.7071067811865467, M22=1.4142135623730934, SizingMethod='auto expand')";
}


}

/*Mobile */
@media only screen and (min-width : 320px) and (max-width : 479px) {
    .small-title{
	height     : 13px;
	font-size  : 10px !important;
	padding    : 5px 20px 3px 40px !important; 
	
	#logo
    {
        width: 40% !important;
        margin-top: -50px;
    }
}


     
.small-title:after {
    position        : absolute;
    content         : " ";
    top             : 0;
    right           : 0;
    width           : 20px;
	height          : 13px;
	margin-right    :  -20px;
	border-left     : 0px solid transparent;
	border-right    : 11px solid transparent;
	border-bottom   : 13px solid #000000;
}

.small-title:before {
    position            : absolute;
    content             : " ";
    top                 : 0;
    right               : 0;
    margin-right        : -25px;
    width               : 7px;
    height              : 13px;
     background         : white !important;
    -webkit-transform   : skew(40deg);
    -moz-transform      : skew(40deg);
    -o-transform        : skew(40deg);   
    -ms-transform       : skew(40deg);   
    -ms-filter          : "progid:DXImageTransform.Microsoft.Matrix(M11=0.7071067811865483, M12=0, M21=-0.7071067811865467, M22=1.4142135623730934, SizingMethod='auto expand')";
}
}

.dot {
    height: 100px;
    width: 100px;
    background-color: darkred;
    border-radius: 50%;
    display: inline-block;
    color: white;
    padding-top: 30px;
    text-align: center;
    position: absolute;
    z-index: 9;
    right: 8%;
    top: 5%;
}

.btn-slide
{
    background: #dc2123;
    background-color: #dc2123;
}

.page-scroll{
    color: #dc2123;
}
ul.nav.navbar-nav li a {
    color: white;
    padding:12px;
}

.navbar-default .navbar-nav > li > a:hover, .navbar-default .navbar-nav > li > a:focus, .navbar-default .navbar-nav > li.active > a, .navbar-default .navbar-nav>.active>a {
    color: white !important;
}

.party-title{
    font-size: 4em;
}



#main-navbar a{
    font-size:2em;
}

#krijtbord h1{
    color: red;
    text-decoration: underline;
}

#kader{
    position:absolute;
    top: 0%;
   width: 20%;
}
#karder-container{
    position: absolute;
    top: 40%;
    width:100%;
}


#bestelKnop{
    padding-top:100px;
}


#logoBanner{
    position: absolute;
    top: 5px;
    width: 9%;
    border-radius: 50%;
}


.page-scroll{
    color: white;
    background: black;
    padding:8px; 
    border-right:1px solid white;
    font-size:3em;
}
.blackboard {
    width: 640px;
    max-width: 86%;
    margin: 7% auto;
    border: silver solid 12px;
    border-top: silver solid 12px;
    border-left: silver solid 12px;
    border-bottom: silver solid 12px;
    box-shadow: 0px 0px 6px 5px rgba(58, 18, 13, 0), 0px 0px 0px 2px silver, 0px 0px 0px 4px silver, 3px 4px 8px 5px rgba(0, 0, 0, 0.5);
    background-image: radial-gradient( circle at left 30%, rgba(34, 34, 34, 0.3), rgba(34, 34, 34, 0.3) 80px, rgba(34, 34, 34, 0.5) 100px, rgba(51, 51, 51, 0.5) 160px, rgba(51, 51, 51, 0.5)), linear-gradient( 215deg, transparent, transparent 100px, #222 260px, #222 320px, transparent), radial-gradient( circle at right, #111, rgba(51, 51, 51, 1));
    background-color: #333;
}
.krijt {
    vertical-align: middle;
    font-family: 'Permanent Marker', cursive;
    font-size: 1.6em;
    color: rgba(238, 238, 238, 0.7);
    padding: 10px;
    min-height: 250px;
}

.krijt h2{
    color: white;
    
}
#restoState{
    color: red;
    font-size: 3em;
    width: fit-content;
    margin-left: auto;
    margin-right: auto;
    padding: 20px;
    text-transform: uppercase;
}

@media only screen and (max-width: 812px) {
     #submenuKader{
     padding-top: 0px;padding-bottom:0px;
    }
    #email-contact{
        font-size:10px;
    }
    #master-banner{
      background: url('/mysite/slide-1.jpg');
      background-size: cover;
      width:100%;
      background-repeat: no-repeat;
    }  
    #tafel{
        display:none;
    }
  .order-box {
    display:none !important;
  }
  
    #gratis-lev{
    display:none;
}

  .email-title{
      font-size: 15px;
  }
  .party-title{
    font-size: 2em;
    }
  #kader{
    position:absolute;
    top: 0%;
    width: 35%;
 }
 #karder-container{
    position: absolute; 
    top: 20%;
    width:100%;
}

  #main-navbar{
    background-color: transparent;
    border: 0;
    border-radius: 0;
  }
  #karder-container hr{
      display:none;
  }
  #bestelKnop{
    padding-top:75px;
}

#logoBanner{
    position: absolute;
    top: 5px;
    width: 20%;
    border-radius: 50%;
}
.item-comment{
    font-size: 20px;
}
.item-name{
    font-size: 12px;
}
.title-header{
    font-size: 20px;
}
#restoState{
    font-size:20px;
}
.title-cat{
    font-size: 20px;
}
.bigger-cat{
   font-size:40px;
}
}
@media only screen and (max-width: 812px) {
.bigger-cat{
   font-size:35px;
}
h3, .h3 {
    font-size: 20px;
}
#restoState {
    font-size: 25px !important;
}
}
@media only screen and (min-width: 812px) {
  #master-banner{
      background: url('/mysite/slide-1.jpg');
      background-size: cover;
      width:100%;
      background-repeat: no-repeat;
  }    
  #bs-example-navbar-collapse-1{
      padding-top:8px;
      
  }
  #main-navbar{
    margin-bottom: 0;
    background-color: transparent;
    border: 0;
    border-radius: 0;padding-bottom:75px;
  }
  #lev2{
    display:none;
 }
 #itemsRow{
     width: 90%;
     margin-left:5%;
 }
 #submenuKader{
     padding-top: 25px;padding-bottom:25px;
 }
}

.title-cat{
    font-family: 'Rancho', cursive;
}


</style>
<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<script>window.html5 || document.write('<script src="js/vendor/html5shiv.js"><\/script>')
</script>
<![endif]-->
</head>
<body data-spy="scroll" data-target="#main-navbar">
  <div class="main" id="home">
      	<div id="header" class="header-section">
		<!-- sticky-bar Starts-->
		<div class="sticky-bar-wrap" style="color:black;
    background: red;">
			<div class="sticky-section">
				<div id="topbar-hold" class="nav-hold container">
					<nav class="navbar" role="navigation">
						<div class="navbar-header" style="    width: 50%;">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-responsive-collapse">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
							</button>
							<!--=== Site Name ===-->
							
						</div>
						
						<!-- Main Navigation menu Starts -->
						<div class="collapse navbar-collapse navbar-responsive-collapse">
							<ul class="nav navbar-nav navbar-right">
						
								<li><a href="/">Home</a></li>
								<li><a href="/menu.pdf">Menu</a></li>
								<li><a href="menu.php" class="btn btn-warning">Bestel</a></li>
							    <li><a href="/fotopagina">Fotopagina</a></li>
                                <li><a href="/index.php#section-contact">Contact</a></li>
                                            
                                <li><a href="/GDPR.pdf">GDPR</a></li>
                                <li><a href="/tegels">Admin</a></li>
							</ul>
						</div>
						<!-- Main Navigation menu ends-->
					</nav>
				</div>
			</div>
		</div>
		<!-- sticky-bar Ends-->
		<!--=== Header section Ends ===-->
		
		<!--=== Home Section Starts ===-->
	
		<!--=== Home Section Ends ===-->
	</div>
      <div id="master-banner" style="">
              <!-- Begin Navbar -->
               
                <!-- End Navbar --> 
           <div style="width: 100%;height:100%; background: rgba(0,0,0,0.5);" id="info-shade">
       <h1 class="text-center" style="color: white" id="restoState"><?php echo getMessage();?></h1>
        <h1 class="text-center title-header" style="color: white; text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;padding: 10px;padding-bottom:25px;">GRATIS LEVERING AAN HUIS OF KANTOOR</h2>
        </div>
    </section>
    </div>
        <?php $items=getCats(); ?>
    <?php print_basket();?>
    <div id="submenu" style="width:100%;margin-top: -20px;">
          <div id="submenuKader"  style="background: red;padding-left:25px;padding-right:25px;">
                         <div class="submenu" >
                    <?php
                    foreach ($items as &$value) {
                        if(167==$value['id']){
                            echo "<div style='text-align: center;'><a style='' class='menu-slide catogs text-center title-cat bigger-cat' href='menu.php#".$value['naam']."'>".$value['naam']."</a></div>";
                        }
                        else{
                             echo "<div style='text-align: center;'><a style='' class='menu-slide catogs text-center title-cat bigger-cat' href='menu.php#".$value['naam']."'>".$value['naam']."</a></div>";
                        }
                           
                    }
                    ?>
</div>
                    
                        
                    </div>
    </div>
<div class="container-fluid" style="background: white;">
    <div class="text-center">
       <a href="#" id="gototop" class="gototop" ><i class="fa fa-angle-double-up fa-2x"></i></a>
    </div>
    <div class="text-center" id="fromHere">
    <?php
        showOptions();
    ?>
    <div style="margin-bottom: 10%;">
        
    </div>

<?php $ctrl->print_chat(); ?>
  <!-- footer -->
  <footer >
    <div class="footer-bottom">
      <div class="container">
        <div class="row">
          <div class="wow zoomIn col-xs-12">
            <p>© 2019 All rights reserved. <span>Webland</span> by <a href="http://webland.be">webland</a>   <a  href="/GDPR.pdf">GDPR</a> <a  href="/portaal" style=" color: white;"><i class="fa fa-lock "></i></a></p>
            <div class="backtop  pull-right">
              <i class="fa fa-angle-up back-to-top"></i>
            </div><!-- /.backtop -->
          </div><!-- /.col-xs-12 -->
        </div><!-- /.row -->
      </div><!-- /.container -->
    </div><!-- /.creditwrapper -->
  </footer><!-- /Footer -->


<!-- MMENU --> 
<nav id="menu">
  <ul>
    <li ><a class="page-scroll" href="#home">Home</a></li>
    <li> <a class="page-scroll" href="/tegels">Admin</a></li>
    <li><a class="page-scroll" href="#contact">Contact</a></li>
  </ul>
</nav><!-- /#menu -->

</div><!-- /.main -->

<!-- jQuery JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Modernizr JS --> 
<script src="js/modernizr-2.6.2.min.js"></script>

<!--Bootatrap JS-->
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- REVOLUTION Slider  -->
<script type="text/javascript" src="vendor/rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
<script type="text/javascript" src="vendor/rs-plugin/js/jquery.themepunch.revolution.js"></script>

<!-- Shuffle JS -->
<script src="js/jquery.shuffle.min.js"></script>

<!-- mmenu -->
<script type="text/javascript" src="vendor/mmenu/js/jquery.mmenu.min.js"></script>

<!-- Owl Carosel -->
<script src="vendor/owl/js/owl.carousel.min.js"></script>
<script src="js/wow.min.js"></script>

<!-- waypoints JS-->
<script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>

<!-- Counterup JS -->
<script src="js/jquery.counterup.min.js"></script>

<!-- Easing JS -->
<script src="js/jquery.easing.min.js"></script>

<!-- Smooth Scroll JS -->
<script src="js/scrolling-nav.js"></script>
<script src="js/smoothscroll.min.js"></script>

<!-- Custom Script JS -->
<script src="js/script.js"></script>

<!-- Email JS -->
<script src="js/email.js"></script>
<script src="release/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="/slick/slick/slick/slick.min.js"></script>
<script>
    var showNav=true;
        var elmnt = document.getElementById("main-navbar");
    var height = elmnt.offsetHeight+"px";
    var box= document.getElementById("slides-box");
    box.style.marginTop = height;
    function toggleClick()
    {
        if(showNav)
        {
            showNav=false;
            $("#bs-example-navbar-collapse-1").show();
            $("#nav-brand").hide();
            $("#logoBanner").hide();
        }
        else
        {
             $("#bs-example-navbar-collapse-1").hide();
             $("#nav-brand").show();
             $("#logoBanner").show();
             showNav=true;
        }
       
    }
</script>
<script>

$(window).on('scroll', function(){
    let targetOffset = $("#fromHere").offset().top;
    console.log(targetOffset);
  if( $(window).scrollTop()>targetOffset ){
    $('#submenu').addClass('navbar-fixed-top');
  } else {
    $('#submenu').removeClass('navbar-fixed-top');
  }
});
 $('.submenu').slick({
  dots: false,
  infinite: true,
  arrows:true,
  speed: 300,
    autoplay: true,
  autoplaySpeed: 3000,
  slidesToShow: 4,
  slidesToScroll: 4,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows:true,
        infinite: true,
        dots: false
      }
    },
    {
      breakpoint: 800,
      settings: {
        slidesToShow: 1,
        arrows:true,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        arrows:true,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        arrows:true,
        slidesToScroll: 1
      }
    }
  ]
});

</script>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/nl_NL/sdk.js#xfbml=1&version=v2.5&appId=138543326488158";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
	</script>
</body>
</html>
