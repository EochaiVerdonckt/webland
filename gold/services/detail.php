<?php session_start();

$path = getcwd();

define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/indexController.php");
include (FSPATH."Controllers/blogController.php");
$ctrl=new indexController();
$blgCtrl=new BlogController();
$seo=$ctrl->getSeo();
function get_service(){
    if(!is_numeric($_GET['id'])){
        echo "THIS IS NOT ALLOWED";
        die();
    }
    $ctrl=new indexController();
    $conn = $ctrl->getConnection();
      $sql = "SELECT * FROM services where publish=1 and id=".$_GET['id'];
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
           $resultaat= $row;
        }
    } else {
        echo "<h1>We hebben momenteel geen nieuws</h1>";
    }
    mysqli_close($conn);
    return $resultaat;
}
?>

<!DOCTYPE html>
<html lang="nl">

<he<title><?php echo $seo['0']['waarde']?></title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta property="og:image"              content="/logo.png" />
  <meta property="og:description" content="<?php echo $seo['1']['waarde']?>" />
  <meta name="description" content="<?php echo $seo['1']['waarde']?>">
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

.dropdown-toggle{
    padding-top:15px !important;
}

    </style>
</head>

<body style="background-color: white;">
    <?php
        $ctrl->print_nav();
        $service= get_service();
    ?>
   <section style="padding-bottom:150px;padding-top:150px; background-image: url('/mysite/slide-1.jpg'); background-repeat: no-repeat;background-position: cover;  background-size: cover; " data-stellar-background-ratio="0.5" style="background-position: 50% 0px;">
        <div data-stellar-ratio="-1" class="ratio--1">
              <div style="padding-top: 2%;
    width: 100%;
    text-align: center;">
                    <div style="background: rgba(0,0,0,0.6);padding:12px;width: fit-content;
    margin-left: auto;
    margin-right: auto;">
                        <div style="width:fit-content;">
                
            </div>
            <h2 style="color:white;"><?php echo $service['naam'];?></h2>
               <a href="tel:0486856610" class="btn btn-warning" style="margin-top:12px;;background:black;border-color:white;"><i class="fa fa-phone"></i>&nbsp; 0486/85.66.10</a>
                    </div>
               
                </div>
       </div>
   </section>
     <div style="width:100%;background: #285e60;;padding: 50px 0;padding-left:25px;padding-bottom: 75px;" id="banner-shop">
        <h2 class="pull-left" style="color:white;margin:0"></h2>
        
    </div>
    <div class="container-fluid">
        <div class="row">
         
           
            <?php echo $service['omschrijving'];?>
        </div>
    </div>

  <?php $ctrl->print_chat();?>
    
    <!-- Footer
	============================================= -->
    <footer>
        <div class="container-fluid">
            <div class="row" style="padding-top:2%; padding-bottom:2%; background-color:white;">
                <h4 style="margin-bottom: 0; padding: 4%;    width: 100%;" class="text-center font-2">  © 2019 Comet Web OS - Libra edition All rights reserved by <a href="http://webland.be">webland</a> <a href="/GDPR.pdf"  style="color: black" class="nav-link"> GDPR</a> <a href="/portaal/"  style="color: black" class="nav-link"> <i class="fa fa-lock "></i></a> </h4>
            </div>

        </div>
        <div class="container-fluid">
            <div class="row" style="background-color: black;">
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
    	<div id="fb-root"></div>
	<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/nl_NL/sdk.js#xfbml=1&version=v2.5&appId=138543326488158";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
	</script>
    <script>
        $(window).stellar();
        $(".fa-star").hover(
  function () {
    $(this).addClass('fa-spin');
  }, 
  function () {
    $(this).removeClass('fa-spin');
  }
  );

    </script>
</body>

</html>