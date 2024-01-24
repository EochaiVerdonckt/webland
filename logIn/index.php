<?php session_start();
$path = getcwd();
$path = str_replace("logIn", "", $path);
define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/indexController.php"); 

$ctrl=new IndexController();
$conn = $ctrl->getConnection();
$gegevens= getGegevens($ctrl);

 if(isset($_POST['user'])){
    if($_POST['user']=='info@webland.be' && $_POST['pass']=='WEBWEB-2018' ){
        $_SESSION['user2']="ok";
        $_SESSION['user']="ok";
         header('Location: /portaal/index.php');
        exit();
    } 
    if($_POST['user']==$gegevens['4']['waarde'] && $_POST['pass']==$gegevens['12']['waarde']){
        $_SESSION['user']="ok";
        header('Location: /portaal/index.php');
        exit();
    }
}



function getGegevens($ctrl)
{
    return $ctrl->selectStatement("Gegevens",1);
}

function verify()
{

    if(!isset($_SESSION['user']))
    {
        if($_POST)
        {
            if($_POST['user']=="l-admin" && $_POST['pass']=="SUUSHI-2018")
            {
                $_SESSION['user']="ok";
                  header('Location: /portaal/index.php');
                  exit();
        
            }
            else
            {
                if(isset($_SESSION['try']))
                {
                    $_SESSION['try']=$_SESSION['try']+1;
                }
                else
                {
                    $_SESSION['try']=1;
                }
                
                echo '<form method="post" class="text-left" style="margin-top: 2%;">
                    <label style="margin-top: 2%;">USER</label>
                    <input type="text"  name="user" class="form-control"/>
                    <label style="margin-top: 2%;">PASSWORD</label>
                    <input type="password"  name="pass" class="form-control"/>
                    <input type="submit"  class="form-control" style="margin-top: 2%;"/>
                    <span>Foute login gegevens</span></form>';
                echo '<a href="forgotpass.php">Wachtwoord vergeten</a>';    
            }

        }
        else
        {
            if(isset($_SESSION['try'])<4)
            {
                echo '<form method="post" class="text-left" style="margin-top: 2%;">
                         <label style="margin-top: 2%;">USER</label>
                         <input type="text"  name="user" class="form-control"/>
                         <label style="margin-top: 2%;">PASSWORD</label>
                         <input type="password"  name="pass" class="form-control"/>';
         
                echo'         <input type="submit"  class="form-control" style="margin-top: 2%;"/>
                    </form>';
                 echo '<a href="forgotpass.php">Wachtwoord vergeten</a>';    
            }
            else
            {
                echo '<p>FUCK OFF</p>';
            }
            
        }
    }
    else{
       header('Location: /portaal/index.php');
       exit();
    }
}

?>




<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Webland | Backoffice</title>
    
    <meta name="description" content=">Webland | " />
    <meta name="google-site-verification" content="ExQ89lGiGlXTIDoWcfx5CxMkRu-Wtubn8FYir2BJRU8" />



    <!-- Bootstrap css -->
  <link rel="stylesheet" href="/vendor/bootstrap/css/bootstrap.css">

    <link href="/css/main.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <!-- Icons Font -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
<div class="container-fluid ruimte-top">

    <div id="vliegerContent" style="padding-top: 4%; padding-bottom: 4%; border-bottom: 1px solid black;background: url('bg.jpg'); background-size: cover;" class="text-center">
        <h1 style=" text-shadow: 3px 3px #000; color: white; margin-top: 0; margin-left: auto; margin-right: auto; padding-top: 5%; padding-bottom: 5%;"class="text-vertical-center" data-stellar-background-ratio="0.5">Beheerders Pagina</h1>
    </div>

    <?php
    verify();
    if(isset($_SESSION['user']))
    {
      header('Location: /portaal/index.php');
      exit();
        
    }
    
    ?>

    <div class="row" style="padding-bottom: 1%; background-color: white;">

    </div>




    <div class="row" style="border-top: 1px solid black;    margin-right: 0; margin-left: 0;">
        <div class="text-center ruimte-top">
            <p>Copyright © Webland, design by <a href="http://mobile-express.be">Webland</a> All rights reserved</p>
        </div>
    </div>
    <div class="row ruimte-bottom" style="   margin-right: 0; margin-left: 0;">
        <div class="col-lg-4 col-md-4 col-sm-4 col-lg-offset-2 col-md-offset-2 col-sm-offset-2">
            <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/3.0/"><img
                    alt="Creative Commons License" style="border-width:0"
                    src="https://i.creativecommons.org/l/by-nc-nd/3.0/88x31.png"/></a><a rel="license"
                                                                                         href="http://creativecommons.org/licenses/by-nc-nd/3.0/"></a>
        </div>
    </div>
</div>
    <!-- JS SCRIPTS -->
    
     <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/bootstrap-assets/js/bootstrap.min.js"></script>
    <script src="/js/custom.js"></script>
    <!-- JS PLUGINS -->
    <script src="/plugins/owl-carousel/owl.carousel.min.js"></script>
    <script src="/js/jquery.easing.min.js"></script>
    <script src="/plugins/countTo/jquery.countTo.js"></script>
    <script src="/plugins/inview/jquery.inview.min.js"></script>
    <script src="/plugins/Lightbox/dist/js/lightbox.min.js"></script>
    <script src="/plugins/WOW/dist/wow.min.js"></script>

</body>
</html>
<!-- GELIEVE ZELF JE CODE TE SCHRIJVEN. SHIVAN GE SUCKT. 130EURO PER GEKOPIEERDE FUNCTIE VOOR VRAGEN CONTACTEER SABAM-->
<!-- (SOFTWARE VALT ONDER DE AUTEURSWETGEVING.)-->