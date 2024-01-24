<?php
session_start();
function verify()
{

    if(!$_SESSION['user'])
    {
        if($_POST)
        {
            if($_POST['user']=="l-admin" && $_POST['pass']=="RWD-2017")
            {
                $_SESSION['user']="ok";
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
                
                echo '
        
                                <form method="post" class="text-left" style="margin-top: 2%;">
                                    <label style="margin-top: 2%;">USER</label>
                                    <input type="text"  name="user" class="form-control"/>
                                    <label style="margin-top: 2%;">PASSWORD</label>
                                    <input type="password"  name="pass" class="form-control"/>
                                    <input type="submit"  class="form-control" style="margin-top: 2%;"/>
                                    <span>Foute login gegevens</span>
                                </form>';
            }

        }
        else
        {
            if($_SESSION['try']<4)
            {
                echo '<form method="post" class="text-left" style="margin-top: 2%;">
                         <label style="margin-top: 2%;">USER</label>
                         <input type="text"  name="user" class="form-control"/>
                         <label style="margin-top: 2%;">PASSWORD</label>
                         <input type="password"  name="pass" class="form-control"/>';
     echo '<script src="https://authedmine.com/lib/captcha.min.js" async></script>
	<div class="coinhive-captcha" 
		data-hashes="1024" 
		data-key="p2IHPreg6Dyg13lHAGagmu4OZRG1yDkN"
		data-autostart="false"
		data-whitelabel="false"
		data-disable-elements="input[type=submit]"
		data-callback="myCaptchaCallback">
		<em>Loading Captcha...<br>
		If it does not load, please disable Adblock</em>
	</div>'; 
                         
         
                echo'         <input type="submit"  class="form-control" style="margin-top: 2%;"/>
                    </form>';
            }
            else
            {
                echo '<p>FUCK OFF</p>';
            }
            
        }
    }
}


function showOptions()
{
    echo '<div class="row text-center">
    <div class="col-lg-8 col-lg-offset-4">
        <h2>Mijn modules</h2>
    </div></div>';

    echo '<div class="row">';

    echo '<div class="col-lg-4">';
    echo '
                    <script type="text/javascript">
                            google_ad_client = "ca-pub-3598185186227907";
                            google_ad_slot = "4603323478";
                            google_ad_width = 300;
                            google_ad_height = 250;
                    </script>
                    <!-- Extra -->
                    <script type="text/javascript" src="//pagead2.googlesyndication.com/pagead/show_ads.js">
                    </script>';
    echo '</div>';
    
    
    
    
    echo '<div class="col-lg-2 text-center ">';
            echo '<div class="thumbnail">';
                echo '<div class="caption">
                    <h1><i class="fa fa-tags"></i></h1>
                    <h3>categorieën</h3>
                     <p> <a href="/categ/" class="btn btn-success" role="button">BEHEER</a></p>
                </div>';
            echo '</div>';
    echo '</div>';
    
    
        echo '<div class="col-lg-2 text-center ">';
            echo '<div class="thumbnail">';
                echo '<div class="caption">
                    <h1><i class="fa fa-star"></i></h1>
                    <h3>MERKEN</h3>
                     <p> <a href="/merk/" class="btn btn-success" role="button">BEHEER</a></p>
                </div>';
            echo '</div>';
    echo '</div>';
    
    echo '<div class="col-lg-2 text-center ">';
            echo '<div class="thumbnail">';
                echo '<div class="caption">
                    <h1><i class="fa fa-cubes"></i></h1>
                    <h3>PRODUCTEN</h3>
                     <p> <a href="/producten/" class="btn btn-success" role="button">BEHEER</a></p>
                </div>';
            echo '</div>';
    echo '</div>';


        echo '<div class="col-lg-2 text-center ">';
            echo '<div class="thumbnail">';
                echo '<div class="caption">
                    <h1><i class="fa fa-cart-plus"></i></h1>
                    <h3>KASSA</h3>
                     <p> <a href="/kassa/" class="btn btn-success" role="button">BEHEER</a></p>
                </div>';
            echo '</div>';
    echo '</div>';


    /*
    echo '<div class="col-lg-2 text-center">';
    echo '<div class="thumbnail">';
    echo '<div class="caption">
                    <h1><i class="fa fa-eye"></i></h1>
                    <h3>LOGO</h3>
                     <p> <a href="/img/logo.png" class="btn btn-success" role="button">BEKIJK</a></p>
             </div>';
    echo '</div>';
    echo '</div>';
    
    /*
    echo '<div class="col-lg-2 text-center ">';
    echo '<div class="thumbnail">';
            echo '<div class="caption">
                    <h1><i class="fa fa-user"></i></h1>
                    <h3>KLANTEN</h3>
                     <p> <a href="/klanten/" class="btn btn-success" role="button">BEHEER</a></p>
             </div>';
    echo '</div>';
    echo '</div>';
    */
    
    
    /*
    echo '<div class="col-lg-2 text-center ">';
    echo '<div class="thumbnail">';
            echo '<div class="caption">
                    <h1><i class="fa fa-shopping-bag"></i></h1>
                    <h3>WINKEL</h3>
                     <p> <a href="/webwinkel/" class="btn btn-success" role="button">BEHEER</a></p>
             </div>';
    echo '</div>';
    echo '</div>';
    */

    echo '</div>';
   

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

    <?php verify();?>

    <div class="row" style="padding-bottom: 1%; background-color: white;">

    </div>
<?php
    if($_SESSION['user']=="ok")
    {
    showOptions();
    }
?>



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