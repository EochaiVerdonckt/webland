<?php session_start();
$path = getcwd();
$path = str_replace("shop", "", $path);

define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/indexController.php");
include (FSPATH."Controllers/adminController.php");
include (FSPATH."Controllers/blogController.php");
$ctrl=new indexController();
$blgCtrl=new BlogController();
$adminCtrl = new AdminController();
if(isset($_GET['merk']))
{
    if(!is_numeric($_GET['merk']))
    {
        echo "<h1>NO HAX ALLOWED</h1>";
        die();
    }    
}

if(isset($_GET['cat']))
{
    if(!is_numeric($_GET['cat']))
    {
        echo "<h1>NO HAX ALLOWED</h1>";
        die();
        
    }
}

if(isset($_GET['sort']))
{
    if(!is_numeric($_GET['sort']))
    {
        echo "<h1>NO HAX ALLOWED</h1>";
        die();
    }
}

function getstars($aantal){
    echo '<div class="text-center" style="text-align:center;">';
    for ($i = 1; $i <= $aantal; $i++) {
        echo '<i class="fa fa-star" style="color: yellow;"></i>';
    }
    echo '</div>';
    
}

function print_reviews(){
    $ctrl=new IndexController();
    $conn= $ctrl->getConnection();
    $sql = "SELECT * FROM reviews where publish=1";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $state =  trim($row['state']);
            $id= trim($row['id']);
            echo '<div class="dia">';
              echo '<div class="text-center">'.getstars($row['rating']).'</div>';
                echo '<h1 style="margin-left:25px;">'.$row['naam'].' '.$row['rating'].'/5</h1>';
                 echo '<div style="margin-left:25px;">'.$row['info'].'</div>';
            echo '</div>';
        }
    } else {
        
    }
    mysqli_close($conn);
}
    
function getPic($id){
    $ctrl=new IndexController();
    $conn= $ctrl->getConnection();
    $sql = "SELECT * FROM `product_afbeelding` where item=".$id." ORDER BY created DESC";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $picture= $row['foto'];
        }
    }
    $conn->close();

    return $picture;
}

function print_basket()
{

    if(empty($_SESSION['basket']))
    {
        return;
    }
    
    echo '
    <div style="position: fixed; top:2%;right:2%;z-index:9999; ">
    <a href="checkout.php">
    <div class="thumbnail" style="border: 1px solid black;    background: white;">
      <span class="badge" style="float:right;background:#1C79BE;">'.$_SESSION['basket']["teller"].'</span>
      <div class="text-center">
      <i class="fa fa-shopping-basket fa-3x" style="color:black"></i>
      </div>
    </div></a></div>';

    
}
function getProds()
{
    $ctrl=new IndexController();
    $conn = $ctrl->getConnection();
    
    $filer="";
    
    if(!empty($_GET['cat']))
        {
            if(isset($_GET['cat']))
            {
                if(is_numeric($_GET['cat']))
                {
                    $filter=" and catog=".$_GET['cat'];
                }            
            }
        }
     if(!empty($_GET['merk']))
        {
            if(isset($_GET['merk']))
            {
                if(is_numeric($_GET['merk']))
                {
                    $filter=$filter." and merk=".$_GET['merk'];
                }            
            }
        }
    if(!empty($_GET['sort']))
    {
        if(is_numeric($_GET['sort']))
        {
            if($_GET['sort']==1)
            {
                $filter=$filter." ORDER BY prijs";
            }
            if($_GET['sort']==2)
            {
                $filter=$filter." ORDER BY prijs DESC";
            }
            if($_GET['sort']==3)
            {
                $filter=$filter." ORDER BY naam";
            }
            if($_GET['sort']==4)
            {
                $filter=$filter." ORDER BY naam DESC";
            }
        }
    }
    if(empty($_GET['sort'])){
         $filter=$filter." ORDER BY id DESC";
     }
    $sql = "SELECT * FROM `product` where publish=1 ".$filter;
    if($_POST['zoek']){
        $sql = "SELECT * FROM `product` where publish=1  and naam LIKE  '%".$_POST['zoek']."%'".$filter;
    }
    
    $rij=array();
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
               array_push($rij,$row);
        }
    } else {
        
    }
    $conn->close();
    return $rij;
}

function getCatogs()
{
     $ctrl=new IndexController();
    $conn = $ctrl->getConnection();
    $sql = "SELECT * FROM `catog`";
    $rij=array();
    $result = mysqli_query($conn, $sql);
    $extra1="";
    $extra="";
    if($_GET['sort'])
        {
            $extra1="&sort=".$_GET['sort'];
        }
    if($_GET['merk'])
    {
        $extra="&merk=".$_GET['merk'];
    }    
    $extra1=$extra1.$extra;
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
              
            $blauw="";  
            if($row['id']==$_GET['cat'])
            {
                $blauw= "blauw";
            }
            echo '
            
             <a class="list-group-item  '.$blauw.'" href="index.php?cat='.$row['id'].$extra1.'" style="font-weight: bolder;">'.$row['naam'].'</a>
            ';
            
            
        }
    } else {
       
    }
    $conn->close();
    return $rij;
}


function getCatogsHorizontaal()
{
    $ctrl=new IndexController();
    $conn = $ctrl->getConnection();
    $sql = "SELECT * FROM `catog`";
    $rij=array();
    $result = mysqli_query($conn, $sql);
    $extra1="";
    $extra="";
    if($_GET['sort'])
        {
            $extra1="&sort=".$_GET['sort'];
        }
    if($_GET['merk'])
    {
        $extra="&merk=".$_GET['merk'];
    }    
    $extra1=$extra1.$extra;
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
              
            $blauw="";  
            if($row['id']==$_GET['cat'])
            {
                $blauw= "blauw";
            }
            echo '
            
             <a class="btn btn-default '.$blauw.'" href="index.php?cat='.$row['id'].$extra1.'" style="font-weight: bolder;">'.$row['naam'].'</a>
            ';
            
            
        }
    } else {
       
    }
    $conn->close();
    return $rij;
}


function getMerken()
{
   $ctrl=new IndexController();
    $conn = $ctrl->getConnection();
    $sql = "SELECT * FROM `merk`";
    $rij=array();
    $result = mysqli_query($conn, $sql);
    $extra1="";
    $extra="";
      if($_GET['cat'])
    {
        $extra="&cat=".$_GET['cat'];
    }
    if($_GET['sort'])
        {
            $extra1="&sort=".$_GET['sort'];
        }
    $extra1=$extra1.$extra;    
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
              
              
            $blauw="";
            
            if($row['id']==$_GET['merk'])
            {
                $blauw=" blauw";    
            }
            
            echo '
            
             <a class="list-group-item  '.$blauw.'" href="index.php?merk='.$row['id'].$extra1.'" style="font-weight: bolder;">'.$row['naam'].'</a>
            ';
            
            
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    return $rij;
}


function getCatogName($id)
{
    $ctrl=new IndexController();
    $conn = $ctrl->getConnection();
    $sql = "SELECT * FROM `catog` where id=".$id;
    $rij=array();
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
              $naam=$row['naam'];
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    return $naam;
}

function getTitel()
{
    $title="";
    
    if($_GET['cat'])
    {
        if(is_numeric($_GET['cat']))
        {
            $title= "<h1 style='color:white;'>".getCatogName($_GET['cat'])."</h1>";    
        }
        else
        {
            $title= "<h1 style='color:white;'>NO HAX ALLOWED</h1>";    
        }
        
    }
    if($_POST['zoek'])
    {
        $title= "<h1 style='color:white;'>Zoekopdracht: ".$_POST['zoek']."</h1>";
    }
    else
    {
       $title="<h1 style='color:white;'>Onze producten</h1>";
    }
    echo $title;
}
?>

<!DOCTYPE html>
<html lang="nl">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
     <title>WEBLAND | Onze modules.</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta name="description" content="Welkom op onze webshop, bestel vandaag nog uit onze catalogus.">
    <meta name="keywords" content="">
    <meta name="author" content="Eoghain Verdonckt">

    <!-- Bootstrap Css -->
   
     <link href="/css/bootstrap.min.css" rel="stylesheet">
    <!-- Icons Font -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Style -->
    <link href="/plugins/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="/plugins/owl-carousel/owl.theme.css" rel="stylesheet">
    <link href="/plugins/owl-carousel/owl.transitions.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Berkshire+Swash|Cinzel+Decorative|Megrim" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/slick/slick/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="/slick/slick/slick/slick-theme.css"/>
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
    .contact-wrapper .form-inline .form-control {
    display: inline-block;
    width: 100%;
    border-radius: 0;
    vertical-align: middle;
    margin:8px;
}
    .contact-wrapper {
    position: relative;
    background: url(../img/contact-back-img.jpg) center center / cover no-repeat fixed;
}
    
    .font-1
    {
        font-family: 'Berkshire Swash', cursive;
    }
    
    .font-2
    {
        font-family: 'Cinzel Decorative', cursive;
        padding-bottom: 2%;
    margin-bottom: 0%;
    padding-top: 2%;
    text-align: center;
    color: #B29600;
    }
    
    .font-3
    {
        font-family: 'Megrim', cursive;
    }
    
    a:hover, a:visited, a:link, a:active
    {
          text-decoration: none  !important;
    }
    
    
    .special-input
    {
        border: 2px solid black;
        border-radius: 0;
    }
    
    @media only screen and (max-width: 500px) {
        #artwork,  #artwork3, #bigScreen, #bigScreen2, #bigScreen3, #bigScreen4 {
            display:none;
        }
        .hideSmall
        {
            display:none;
        }
    }
    @media only screen and (min-width: 501px) {
        #artwork2, #smallScreen, #smallScreen2 {
            display:none;
        }
    }
    
    

    .link h1
    {
        margin-bottom: 0; padding: 4%;text-align: center;
    }
    
      .link a
    {
        border:0; color: black; padding: 5px;    text-shadow: 2px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
    }
     
    .nav-link
    {
        text-shadow: none !important;
        
    }
     
     .krijt {
    vertical-align: middle;
    font-family: 'Permanent Marker', cursive;
    font-size: 1.6em;
    color: rgba(238, 238, 238, 0.7);
    padding: 10px;
    min-height: 250px;
}

.blackboard {
    width: 640px;
    max-width: 100%;
    margin: 7% auto;
    border: silver solid 12px;
    border-top: silver solid 12px;
    border-left: silver solid 12px;
    border-bottom: silver solid 12px;
    box-shadow: 0px 0px 6px 5px rgba(58, 18, 13, 0), 0px 0px 0px 2px silver, 0px 0px 0px 4px silver, 3px 4px 8px 5px rgba(0, 0, 0, 0.5);
    background-image: radial-gradient( circle at left 30%, rgba(34, 34, 34, 0.3), rgba(34, 34, 34, 0.3) 80px, rgba(34, 34, 34, 0.5) 100px, rgba(51, 51, 51, 0.5) 160px, rgba(51, 51, 51, 0.5)), linear-gradient( 215deg, transparent, transparent 100px, #222 260px, #222 320px, transparent), radial-gradient( circle at right, #111, rgba(51, 51, 51, 1));
    background-color: #333;
}

.fa-star
{
     color: white;
    text-shadow: -1px 0 #B29600, 0 1px #B29600, 1px 0 #B29600, 0 -1px #B29600;
}

.snow-flake
{
    padding-bottom: 150px;
}

@media only screen and (max-width: 500px) {
  .blackboard {
   width: 640px;
    max-width: 100%;
  }
}


.navbar-default, .navbar-default.navbar-fixed-top.navbar-shrink {
    background-color: white;
}
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

#el-zwaan
{
    font-family: 'Roboto Slab', serif;
    color: #117CCA;
}

.blauw
{
    background: #117ECD;
    color: white !important;
}
.price-tag{
        position: absolute;
    z-index: 9;
    right:8%;
        top: 5%;
}
.dot {
    height: 100px;
    width: 100px;
    background-color: darkred;
    border-radius: 50%;
    display: inline-block;
    color: white;
    padding-top:30px;
    text-align: center;
    position: absolute;
    z-index: 9;
    right:8%;
        top: 5%;
}



#logo
{
    float: left;width: 25%;margin-right: 5px;
}


@media only screen and (max-width: 1250px) {
#logo
{
    float: left;width: 40%;margin-right: 5px;
}
}

@media only screen and (max-width: 800px) {
#logo
{
    float: left;width: 50%;margin-right: 5px;
}
}

@media only screen and (max-width: 750px) {
#logo
{
    float: left;width: 90%;margin-right: 5px;
}
}

.shop-item-pic
{
    padding-bottom:250px;
    width:250px;

}

@media only screen and (max-width: 1250px) {
.shop-item-pic
{
    padding-bottom: 125px;
    width: 125px;
}

}
@media only screen and (max-width: 925px) {
    .price-tag{
            right: 5%;
    }
}
#catogLijst{
    display:none;
}
@media only screen and (max-width: 750px) {
    .price-tag{
            right: 0%;
            position: initial;
    }
    .price-tag h2{
        padding:0;
    }
    #searchForm{
        width:75%;
    }
    #searchBar{
        width:50%;
        margin-right: 0;
        float: left;
    }
}
@media only screen and (max-width: 830px) {
    #catogKnop{
        display:none;
    }
    #searchForm{
        width: 60%;
    }
    #searchBar{
        width:80%;
        float: left;
    }
    #catogLijst{
        display:block;
    }
}
#main-navbar{
    margin-bottom: 0;
}
.btn-dark {
    color: #fff;
    background-color: #343a40;
    border-color: #343a40;
}

.dropdown-toggle{
    padding-top: 15px !important;
}

#brand {
    background: linear-gradient(to bottom, #cfc09f 22%,#634f2c 24%, #cfc09f 26%, #cfc09f 27%,#ffecb3 40%,#3a2c0f 78%); 
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    color: #fff;
font-family: 'Playfair Display', serif;
    position: relative;
	text-transform: uppercase;	
	font-size: 18vw;
	margin: 0;
	font-weight: 400;
}

#brand:after {
    background: none;
    content: attr(data-heading);
    left: 0;
	top: 0;
    z-index: -1;
    position: absolute;
    text-shadow: 
		-1px 0 1px #c6bb9f, 
		0 1px 1px #c6bb9f, 
		5px 5px 10px rgba(0, 0, 0, 0.4),
		-5px -5px 10px rgba(0, 0, 0, 0.4);
}
    </style>
</head>

<body style="background-color: white;">
    <?php $ctrl->print_nav();?>
      <?php
         print_basket();
                        $extra="";
                        $extra1="";
                        if($_GET['cat'])
                        {
                            $extra="&cat=".$_GET['cat'];
                        }
                        if($_GET['merk'])
                        {
                                $extra1="&merk=".$_GET['merk'];
                        }   
                        $extra=$extra.$extra1;
    ?>
    
<div style="background: url('/shop/banner.jpg');background-size:cover;">
        <div style="background:rgba(0,0,0,0.5);width:100%;height:100%;">
              <div class="text-center" style="padding-top:100px;padding-bottom:100px;">
                <h1 id="brandé" style="font-size:4em;color:white;">WEBLAND</h1>
                <h1 style="color:white;font-weight: 400;">Modules waar andere enkel over kunnen dromen.</h1>
		<div style="width:40%;margin-left:30%;">
		   
		</div>
		<div style="width:100%;padding-top:18px;">
		    <hr style="width: 50%;margin-left:25%;color:#C0C0C0;text-shadow: 0px 0px 5px rgba(0, 0, 0, 1); margin-top:10px; margin-bottom:10px;"/>
		</div>
                
		
		 <h1 style="color:white;">Tel  +32 (0) 485 86 59 70</h1>
                    <a class="btn btn-info" href="tel:0485865970" style="background:#1C79BE;"><i class="fa fa-mobile"></i> BEL NU </a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
    <div class="row" style="background:url('/img/more.png');background-size:cover;padding-top:2%;padding-bottom:2%;padding-right:2%;">
        <div>
        <div id="catogKnop" style="float: left;margin-right:5px;">
             <a class="btn btn-default" href="index.php" style="font-weight: bolder;">Alle</a>
       <?php 
                        getCatogsHorizontaal();
                    ?>
             
        </div>
        
           <div class="list-group" style="font-weight: bolder;float: left;">
                    <div class="btn btn-default" id="sortPanel" style="cursor:pointer;font-weight: bolder;background: transparent; background:#1C79BE;color:white;font-size: 1em;">
                        Sorteer
                    </div>
 <div id="sortList">
    <a class="list-group-item" href="index.php?sort=1<?php echo $extra;?>" style="font-weight: bolder;">Prijs oplopend</a>
    <a class="list-group-item" href="index.php?sort=2<?php echo $extra;?>" style="font-weight: bolder;">Prijs Aflopend</a>
    <a class="list-group-item"  href="index.php?sort=3<?php echo $extra;?>" style="font-weight: bolder;">Naam aflopend</a>    
    <a class="list-group-item" href="index.php?sort=4<?php echo $extra;?>" style="font-weight: bolder;">Naam oplopend</a>   
 </div> 
        </div>  
        
        </div>
        
           
     <form id="searchForm" method="post" class="form-inline my-2 my-lg-0 pull-right" >
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="zoek" id="searchBar">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fa fa-search"></i></button>
    </form>
    </div>
</div>
    <div class="container-fluid">
        <div class="row" style="margin-top: 2%;" >
            <div class="col-md-12" id="prodLijst">
                <?php
                    $aanta=0;
                    foreach (getProds() as &$value) {
                    $value['foto']=getPic($value['id']);
                        
                        echo '<div class="wow zoomIn col-md-6  animated" style="visibility: visible; animation-name: zoomIn;border:1px solid #d7d7d7;margin-bottom: 12px;padding-left:0;">
                        
                     <div class="shop-item-pic" style="background:url(\'/producten/uploads/'.$value['foto'].'\');float:left;margin-right: 50px;    background-size: cover;margin-left:8px;"></div>
         
          <div class="blog-container" style="margin-left: 12px; padding:11px; padding-bottom: 21px;">
            <h3><a style="" href="item.php?id='.$value['id'].'">'.$value['naam'].'</a></h3>';
                echo "<p id='premie-".$value['prijs']."' style='display:none;'>".$value['premie']."</p>";
                
                 //echo '<div class="price-tag"><h3 style="color: black;" id="'.$value['prijs'].'"><i style="color:green;" class="fa fa-check"></i></h3></div>';
                
            echo '
            <p style="margin-bottom: 10px;">'.$value['omschrijving'].'</p>';
            
            if($value['aantal']>0){
                echo' <a class="btn btn-info" style="background: white;color: black;" >STANDAARD PAKKET</a>';
            }
            else{
                 echo' <a class="btn btn-danger" style="background:white; color: black;">Uitbreiding </a>';
            }
             if($value['aantal']>0){
            echo'
            <a class="btn btn-default" href="item.php?id='.$value['id'].'">Informatie <i class="fa fa-angle-right"></i></a>';
             }
             else{
                  echo'
            <a class="btn btn-default" >Bestel <i class="fa fa-angle-right"></i></a>';
             }
            echo '</div></div>';
                }
                ?>
            </div>
        </div>
    </div>

<?php $gegevens=$adminCtrl->getSeo();
        $ctrl->print_chat();
?>
    <footer>
        <div class="container-fluid">
            <div class="row" style="padding-top:2%; padding-bottom:2%; background-color:white;">
                <h4 style="margin-bottom: 0; padding: 4%; padding-bottom:0;   width: 100%;" class="text-center">IBAN: <?php echo $gegevens[14]['waarde']?> BTW-NUMMER: <?php echo $gegevens[13]['waarde']?></h4>
                <h4 style="margin-bottom: 0; padding: 4%;padding-top:1%;    width: 100%;" class="text-center font-2">  © 2019 Comet Web OS - Libra edition All rights reserved by <a href="http://webland.be">webland</a> <a href="/GDPR.pdf"  style="color: black" class="nav-link"> GDPR</a> <a href="/portaal/"  style="color: black" class="nav-link"> <i class="fa fa-lock "></i></a> </h4>
            </div>

        </div>
    </footer>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="/jquery.stellar.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/bootstrap-assets/js/bootstrap.min.js"></script>
    <!-- JS PLUGINS -->
    <script src="/plugins/owl-carousel/owl.carousel.min.js"></script>
     <script type="text/javascript" src="/slick/slick/slick/slick.min.js"></script>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/nl_NL/sdk.js#xfbml=1&version=v2.5&appId=138543326488158";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
	
 $("#sortList").toggle();
 
$(window).on('scroll', function(){
  if( $(window).scrollTop()>670 ){
    $('.navbar-default').addClass('navbar-fixed-top');
  } else {
    $('.navbar-default').removeClass('navbar-fixed-top');
  }
});


$("#sortPanel").click(function() {
  $("#sortList").toggle();
});


$("#sortCateg").click(function() {
  $("#catogList").toggle();
});



$("#merkPanel").click(function() {
  $("#merkList").toggle();
});


$("#searchBar").keyup(function() {
   
    var jqxhr = $.post( "search.php", { zoek: $("#searchBar").val()}, function() {
})
  .done(function(data) {
     console.log(data);
     $("#prodLijst").empty();  
     var row = jQuery.parseJSON( data );
  
     $.each( row, function( index, value ){
         console.log();
         var box =' <div class="wow zoomIn col-md-6  animated" style="visibility: visible; animation-name: zoomIn;border:1px solid #d7d7d7;margin-bottom: 12px;padding-left:0;">';
            var box = box+'<div class="shop-item-pic" style="background:url(';
            var box = box+"'/producten/uploads/"+value.foto+"');margin-right: 50px;    background-size: cover;margin-left:8px;float:left;";
            var box = box + '"></div>';
            var box = box+ ' <div class="blog-container" style="margin-left: 12px; padding:11px; padding-bottom: 21px;">';
                
                var box = box+ '<h2><a href="item.php?id=';
                    var box = box + value.id + '">';
                    var box = box + value.naam;
                var box = box+ '</a></h2>';
                var box = box + '<div class="price-tag"><h2 style="color: black;" id="'+ value.prijs +'">';
                var box = box + '<i class="fa fa-spinner fa-spin"></i></h2></div>';
                var box = box + '<p style="margin-bottom: 10px;">'+value.omschrijving+'</p>';
                
                if(value.aantal>0)
                {
                    var box =box+'<a class="btn btn-info" >Op voorraad </a>';
                    var box = box +' <a class="btn btn-default" href="item.php?id='+value.id+'">Bestel <i class="fa fa-angle-right"></i></a>';
                }
                else{
                    var box =box+'<a class="btn btn-danger" >Uitverkocht </a>';
                    var box = box + '<a class="btn btn-default" >Bestel <i class="fa fa-angle-right"></i></a>';
                }
            var box= box+ '</div>';
         var box = box + '</div>';
         $("#prodLijst").append(box);  
      
  
  
  
    });
  })
  .fail(function() {
    console.log( "error" );
  })
  .always(function() {
   
  });
 
// Perform other work here ...
 
// Set another completion function for the request above
jqxhr.always(function() {
  console.log( "second finished" );
});
});
     $('.reviews').slick({
  dots: false,
  infinite: true,
  speed: 300,
  autoplay: true,
  autoplaySpeed: 5000,
  slidesToShow: 1,
  slidesToScroll: 1,
      prevArrow: false,
    nextArrow: false,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
        dots: false
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
});	

 $("#toolBox").css({'margin-top':'0px'});

</script>                            
</body>

</html>