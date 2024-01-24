<?php 
session_start();
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
      <span class="badge" style="float:right;">'.$_SESSION['basket']["teller"].'</span>
      <div class="text-center">
      <i class="fa fa-shopping-basket fa-3x" style="color:black"></i>
      </div>
    </div></a></div>';

    
}
function getProds()
{
    $xml=simplexml_load_file("../db.xml") or die("Error: Cannot create object");
    $usernameDb = $xml->usernameDb;
    $passwordDb = $xml->passwordDb;
    $hostname = $xml->hostname;
    $dbname = $xml->dbname;

    // Create connection
    $conn = new mysqli($hostname, $usernameDb, $passwordDb, $dbname);
    // Check connection
    if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
    }
    
    
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
    
    $sql = "SELECT * FROM `product` where state=1 AND aantal>0".$filter;
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
    $xml=simplexml_load_file("../db.xml") or die("Error: Cannot create object");
    $usernameDb = $xml->usernameDb;
    $passwordDb = $xml->passwordDb;
    $hostname = $xml->hostname;
    $dbname = $xml->dbname;

    // Create connection
    $conn = new mysqli($hostname, $usernameDb, $passwordDb, $dbname);
    // Check connection
    if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
    }
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


function getMerken()
{
    $xml=simplexml_load_file("../db.xml") or die("Error: Cannot create object");
    $usernameDb = $xml->usernameDb;
    $passwordDb = $xml->passwordDb;
    $hostname = $xml->hostname;
    $dbname = $xml->dbname;

    // Create connection
    $conn = new mysqli($hostname, $usernameDb, $passwordDb, $dbname);
    // Check connection
    if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
    }
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
    $xml=simplexml_load_file("../db.xml") or die("Error: Cannot create object");
    $usernameDb = $xml->usernameDb;
    $passwordDb = $xml->passwordDb;
    $hostname = $xml->hostname;
    $dbname = $xml->dbname;

    // Create connection
    $conn = new mysqli($hostname, $usernameDb, $passwordDb, $dbname);
    // Check connection
    if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
    }
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
    
    if($_GET['cat'])
    {
        if(is_numeric($_GET['cat']))
        {
            echo "<h1>Producten met categorie ".getCatogName($_GET['cat'])."</h1>";    
        }
        else
        {
            echo "<h1>NO HAX ALLOWED</h1>";    
        }
        
    }
    else
    {
        echo "<h1>Onze producten</h1>";
    }
}

?>


<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <title>Ontdek onze webshop</title>
  <meta name="description" content="Ontdek onze webshop">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta property="og:image"              content="http://unit-leuven.eu/img/logo.png" />
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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  
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

</style>
</head>
<body>
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
  <div class="main" id="home">
<header  class="header-part">
  <div id="home" class="wrapper">
    <?php  
    
     echo '    <!-- Begin Navbar -->
                <nav id="main-navbar" class="navbar navbar-default navbar-fixed-top" role="navigation" style="    margin-bottom: 0;
    background-color: white;
    border: 0;
    border-radius: 0;"> <!-- Classes: navbar-default, navbar-inverse, navbar-fixed-top, navbar-fixed-bottom, navbar-transparent. Note: If you use non-transparent navbar, set "height: 98px;" to #header -->

                  <div class="container">

                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" onclick="toggleClick();">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                      <a class="navbar-brand page-scroll" href="index.php" style="color: black;"><img src="/logo.png" style="width:20%;"/></a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                             <li style="padding-left: 0;"><a style="black" class="page-scroll"  href="/index.php">Home</a></li>  
                            <li style="padding-left: 0;"><a  style="black" class="page-scroll"  href="/index.php#contact-section-2">Contact</a></li>
                           
                             <li style="padding-left: 0;"><a style="black" class="page-scroll"  href="/events.php">Events</a></li>
                            <li style="padding-left: 0;"><a style="black" class="page-scroll"  href="/blog.php">Blog</a></li>
                               <li style="padding-left: 0;"><a style="black"  class="page-scroll"  href="/member.php">Lesgevers</a></li>
                       <li style="padding-left: 0;"><a style="black" class="page-scroll"  href="/fotopagina/">Fotopagina</a></li>
                        <li style="padding-left: 0;"><a style="black" class="page-scroll"  href="/shop/">Webshop</a></li>
                         <li style="padding-left: 0;"><a style="black" class="page-scroll"  href="https://www.facebook.com/start2yoga"><i class="fa fa-facebook"></i></a></li>
                              <li style="padding-left: 0;"><a style="black" class="page-scroll"  href="/GDPR.pdf">GDPR</a></li>
                              <li style="padding-left: 0;"><a style="black" class="page-scroll"  href="/tegels"><i class="fa fa-lock "></i></a></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                  </div><!-- /.container -->
                </nav>
                <!-- End Navbar --> ';
    
    ?>
</div>
</header>

 <div class="container-fluid">
             <div class="row" style="margin-top: 2%;">
      
            <div class="text-center">
            <?php 
                getTitel();
            ?>
            </div>
        </div>
        <div class="row" style="margin-top: 2%;">
              <div class="col-md-3">
                
            </div>
            <div class="col-md-3">
                 <div class="list-group" style="font-weight: bolder;">
                    <a href="#" class="list-group-item disabled" id="sortPanel" style="cursor:pointer;    font-weight: bolder;background: transparent; ">
                        Sorteer
                    </a>
 <div id="sortList">
       <a class="list-group-item" href="index.php?sort=1<?php echo $extra;?>" style="font-weight: bolder;">Prijs oplopend</a>
    <a class="list-group-item" href="index.php?sort=2<?php echo $extra;?>" style="font-weight: bolder;">Prijs Aflopend</a>
  <a class="list-group-item"  href="index.php?sort=3<?php echo $extra;?>" style="font-weight: bolder;">A->Z</a>    
  <a class="list-group-item" href="index.php?sort=4<?php echo $extra;?>" style="font-weight: bolder;">Z->A</a>   
 </div> 
        </div>
            </div>
          
            <div class="col-md-3">
                
    <a href="#" class="list-group-item disabled" id="sortCateg" style="cursor:pointer;font-weight: bolder;background: transparent;">Categorie</a>
    <div id="catogList">
        <a class="list-group-item" href="index.php" style="font-weight: bolder;">Alle</a>
       <?php 
                        getCatogs();
                    ?>
    </div>
            </div>
            
            
            
</div>        
    <div class="container-fluid">


            <div class="col-md-12" >
                <?php
                    $aanta=0;
                    foreach (getProds() as &$value) {
                    
                        
                        echo '<div class="wow zoomIn col-md-12  animated" style="visibility: visible; animation-name: zoomIn;border:1px solid #d7d7d7;margin-bottom: 12px;">
          <img class="img-responsive" src="/producten/'.$value['foto'].'" alt="Image" style="width:30%;float:left;margin-right: 2%;">
          <div class="blog-container" style="margin-left: 12px; padding:11px; padding-bottom: 21px;">
            <h1><a style="" href="item.php?id='.$value['id'].'">'.$value['naam'].'</a></h1>';
              
                
                 echo '<div class="dot"><h1 style="color: white;">&#8364;'.$value['prijs'].'</h1><h5></h5></div>';
                
            echo '
            <p style="margin-bottom: 10px;">'.$value['omschrijving'].'</p>
            <a class="custom-button" href="item.php?id='.$value['id'].'">Bestel <i class="fa fa-angle-right"></i></a>
          </div>
        </div>';
                }
                ?>
            </div>
        </div>
    </div>




  <!-- footer -->
  <footer style="margin-top: 4%;" >
    <div class="footer-bottom">
      <div class="container">
        <div class="row">
          <div class="wow zoomIn col-xs-12">
            <p>© <?php echo date("Y"); ?> All rights reserved. <span>Webland</span> by <a href="http://webland.be">webland</a></p>
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

<script>
  $("#sortList").toggle();
  $("#catogList").toggle();
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


</script>

</body>
</html>
