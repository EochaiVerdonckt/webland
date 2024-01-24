<?php
session_start();
$path = getcwd();
$path = str_replace("bussiness/ganzenbord", "", $path);

define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/adminController.php"); 


$ctrl=new AdminController();
$ctrl->verify();
$title= "Business Booster Board";

function getFlag($id){
    $ctrl=new AdminController();
    $conn=$ctrl->getConnection();
    $sql = "SELECT * FROM `promo_balance` where id=".$id;
    $item=array();
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
           $item=$row;
        }

    } 

    $conn->close();
    return $item['promo'];
}

function showOptions($ctrl,$title){
    echo "<div class='row'>";
       
         $ctrl->side_nav();   
      
        
        echo "<div class='col-md-9' style=''>";
                echo '<div class="well text-center" style="width: 100%;margin-top:50px; padding:20px;">
                
                <h1>'.$title.'</h1>
                <hr /> 
        <div class="row">
        
            <div class="col-lg-2 col-md-2">
            <div class="thumbnail">
                    <span class="icon-strategy" style="font-size: 3em;"></span>
                    <div class="caption">              
                       <p>START</p>
                          
                    </div>
                 </div>
            </div>
            
            <div class="col-lg-1 col-md-1">
                <i class="fa fa-arrow-right" style="margin-top:60%;"></i>
            </div>
            
            
            <div class="col-lg-2 col-md-2">
            <div class="thumbnail">
                    <span class="icon-documents" style="font-size: 3em;"></span>
                    <div class="caption">              
                       <p>GEGEVENS</p>
                       <i class="fa fa-check"></i>
                    </div>
                 </div>
            </div>
            
            <div class="col-lg-1 col-md-1">
                <i class="fa fa-arrow-right" style="margin-top:60%;"></i>
            </div>
            
    
            
            <div class="col-lg-2 col-md-2">
            <div class="thumbnail">
                    <span class="icon-presentation" style="font-size: 3em;"></span>
                    <div class="caption">              
                       <p>Presentatie</a></p>
                       <i class="fa fa-check"></i>
                    </div>
                 </div>
            </div>
            
            <div class="col-lg-1 col-md-1">
                <i class="fa fa-arrow-right" style="margin-top:60%;"></i>
            </div>
            
            <div class="col-lg-2 col-md-2">
            <div class="thumbnail">
                    <span class="icon-documents" style="font-size: 3em;"></span>
                    <div class="caption">              
                       <p>Business Plan</p>
                    </div>
                 </div>
            </div>
        </div>
        <div class="row">
        
            <div class="col-lg-2 col-md-2">
                              
                <p><i class="fa fa-arrow-down" style=""></i></p>
            </div>
            
            <div class="col-lg-1 col-md-1">
            </div>
            
            
            <div class="col-lg-2 col-md-2">
            </div>
            
            <div class="col-lg-1 col-md-1">
            </div>
            <div class="col-lg-2 col-md-2">
            </div>
            
            <div class="col-lg-1 col-md-1">
                
            </div>
            
            <div class="col-lg-2 col-md-2">
                <p><i class="fa fa-arrow-up" style=""></i></p>
                <p><i class="fa fa-arrow-down" style=""></i></p>
            </div>
        </div>
        <div class="row">
        
            <div class="col-lg-2 col-md-2">
            <div class="thumbnail">
                    <span class="icon-paintbrush" style="font-size: 3em;"></span>
                    <div class="caption">              
                       <p>LOGO</p>
                    </div>
                 </div>
            </div>
            
            <div class="col-lg-1 col-md-1">
                <i class="fa fa-arrow-right" style="margin-top:60%;"></i>
            </div>
            
            
            <div class="col-lg-2 col-md-2">
            <div class="thumbnail">
                    <span class="icon-chat" style="font-size: 3em;"></span>
                    <div class="caption">              
                       <p>Business cards</p>
                    </div>
                 </div>
            </div>
            
            <div class="col-lg-1 col-md-1">
                <i class="fa fa-arrow-right" style="margin-top:60%;"></i>
            </div>
            
    
            
            <div class="col-lg-2 col-md-2">
            <div class="thumbnail">
                    <span class="icon-ribbon" style="font-size: 3em;"></span>
                    <div class="caption">              
                       <p>Flyers, Posters, Folders</p>
                    </div>
                 </div>
            </div>
            
            <div class="col-lg-1 col-md-1">
                <i class="fa fa-arrow-right" style="margin-top:60%;"></i>
            </div>
            
            <div class="col-lg-2 col-md-2">
                    <div class="thumbnail">
                    <span class="icon-megaphone" style="font-size: 3em;"></span>
                    <div class="caption">              
                       <p>Marketings campagne</p>
                    </div>
                 </div>
        </div></div>
        
        <div class="row">
        
            <div class="col-lg-2 col-md-2">
                      
                <p><i class="fa fa-arrow-down" style=""></i></p>
            </div>
            
            <div class="col-lg-1 col-md-1">
            </div>
            
            
            <div class="col-lg-2 col-md-2">
            </div>
            
            <div class="col-lg-1 col-md-1">
            </div>
            <div class="col-lg-2 col-md-2">
            </div>
            
            <div class="col-lg-1 col-md-1">
                
            </div>
            
            <div class="col-lg-2 col-md-2">
                <p><i class="fa fa-arrow-up" style=""></i></p>
                <p><i class="fa fa-arrow-down" style=""></i></p>
            </div>
        </div>
        
        
        <div class="row">
        
            <div class="col-lg-2 col-md-2">
            <div class="thumbnail">
                    <span class="icon-browser" style="font-size: 3em;"></span>
                    <div class="caption">              
                       <p>WEBSITE</p>
                       <p></p>
                    </div>
                 </div>
            </div>
            
            <div class="col-lg-1 col-md-1">
                <i class="fa fa-arrow-right" style="margin-top:60%;"></i>
            </div>
            
            
            <div class="col-lg-2 col-md-2">
            <div class="thumbnail">
                    <span class="icon-tools" style="font-size: 3em;"></span>
                    <div class="caption">              
                       <p>backoffice &amp; tools</p>
                    </div>
                 </div>
            </div>
            
            <div class="col-lg-1 col-md-1">
                <i class="fa fa-arrow-right" style="margin-top:60%;"></i>
            </div>
            
    
            
            <div class="col-lg-2 col-md-2">
            <div class="thumbnail">
                    <span class="icon-envelope" style="font-size: 3em;"></span>
                    <div class="caption">              
                       <p>Email accounts</p>
                    </div>
                 </div>
            </div>
            
            <div class="col-lg-1 col-md-1">
                <i class="fa fa-arrow-right" style="margin-top:60%;"></i>
            </div>
            
            <div class="col-lg-2 col-md-2">
                    <div class="thumbnail">
                    <span class="icon-browser" style="font-size: 3em;"></span>
                    <div class="caption">              
                       <p>Zoekmachines</p>
                    </div>
                 </div>
        </div>
        </div>
        <div class="row">
        
            <div class="col-lg-2 col-md-2">
                              
                <p><i class="fa fa-arrow-down" style=""></i></p>
            </div>
            
            <div class="col-lg-1 col-md-1">
            </div>
            
            
         <div class="col-lg-2 col-md-2">
                <p><i class="fa fa-arrow-up" style=""></i></p>
                <p><i class="fa fa-arrow-down" style=""></i></p>
            </div>
            
            <div class="col-lg-1 col-md-1">
            </div>
            <div class="col-lg-2 col-md-2">
                <p><i class="fa fa-arrow-up" style=""></i></p>
                <p><i class="fa fa-arrow-down" style=""></i></p>
            </div>
            
            <div class="col-lg-1 col-md-1">
                
            </div>
            
            <div class="col-lg-2 col-md-2">
                <p><i class="fa fa-arrow-up" style=""></i></p>
                <p><i class="fa fa-arrow-down" style=""></i></p>
            </div>
        </div>
        <div class="row" style="border-top: 1px dotted black;border-bottom: 1px dotted black;padding-top:8px;">
        
            <div class="col-lg-2 col-md-2">
            <div class="thumbnail">
                    <span class="icon-wine" style="font-size: 3em;"></span>
                    <div class="caption">              
                       <p>Restaurant?</p>
                          
                    </div>
                 </div>
            </div>
            
            <div class="col-lg-1 col-md-1">
                <i class="fa fa-arrow-right" style="margin-top:60%;"></i>
            </div>
            
            
            <div class="col-lg-2 col-md-2">
            <div class="thumbnail">
                    <span class="icon-documents" style="font-size: 3em;"></span>
                    <div class="caption">              
                       <p>Menu </p>
                     
                    </div>
                 </div>
            </div>
            
            <div class="col-lg-1 col-md-1">
                <i class="fa fa-arrow-right" style="margin-top:60%;"></i>
            </div>
            
    
            
            <div class="col-lg-2 col-md-2">
            <div class="thumbnail">
                    <span class="icon-calendar" style="font-size: 3em;"></span>
                    <div class="caption">              
                       <p>Reservaties</p>
                      
                    </div>
                 </div>
            </div>
            
            <div class="col-lg-1 col-md-1">
                <i class="fa fa-arrow-right" style="margin-top:60%;"></i>
            </div>
            
            <div class="col-lg-2 col-md-2">
            <div class="thumbnail">
                    <span class="icon-bike" style="font-size: 3em;"></span>
                    <div class="caption">              
                       <p>Online order</p>
                    </div>
                 </div>
            </div>
            
        </div>
        <div class="row">
        
            <div class="col-lg-2 col-md-2">
                      
                <p><i class="fa fa-arrow-down" style=""></i></p>
            </div>
            
            <div class="col-lg-1 col-md-1">
            </div>
            
            
          <div class="col-lg-2 col-md-2">
                <p><i class="fa fa-arrow-up" style=""></i></p>
                <p><i class="fa fa-arrow-down" style=""></i></p>
            </div>
            
            <div class="col-lg-1 col-md-1">
            </div>
           <div class="col-lg-2 col-md-2">
                <p><i class="fa fa-arrow-up" style=""></i></p>
                <p><i class="fa fa-arrow-down" style=""></i></p>
            </div>
            
            <div class="col-lg-1 col-md-1">
                
            </div>
            
            <div class="col-lg-2 col-md-2">
                <p><i class="fa fa-arrow-up" style=""></i></p>
                <p><i class="fa fa-arrow-down" style=""></i></p>
            </div>
        </div>
        
        <div class="row" style="border-top: 1px dotted black;border-bottom: 1px dotted black;padding-top:8px;">
        
            <div class="col-lg-2 col-md-2">
            <div class="thumbnail">
                    <span class="icon-gift" style="font-size: 3em;"></span>
                    <div class="caption">              
                       <p>Webshop?</p>
                          
                    </div>
                 </div>
            </div>
            
            <div class="col-lg-1 col-md-1">
                <i class="fa fa-arrow-right" style="margin-top:60%;"></i>
            </div>
            
            
            <div class="col-lg-2 col-md-2">
            <div class="thumbnail">
                    <span class="icon-pricetags" style="font-size: 3em;"></span>
                    <div class="caption">              
                       <p>Product Gamma </p>
                     
                    </div>
                 </div>
            </div>
            
            <div class="col-lg-1 col-md-1">
                <i class="fa fa-arrow-right" style="margin-top:60%;"></i>
            </div>
            
    
            
            <div class="col-lg-2 col-md-2">
            <div class="thumbnail">
                    <span class="icon-wallet" style="font-size: 3em;"></span>
                    <div class="caption">              
                       <p>Facturatie</p>
                      
                    </div>
                 </div>
            </div>
            
            <div class="col-lg-1 col-md-1">
                <i class="fa fa-arrow-right" style="margin-top:60%;"></i>
            </div>
            
            <div class="col-lg-2 col-md-2">
            <div class="thumbnail">
                    <span class="icon-bike" style="font-size: 3em;"></span>
                    <div class="caption">              
                       <p>Levering</p>
                    </div>
                 </div>
            </div>
            
        </div>
        <div class="row">
        
            <div class="col-lg-2 col-md-2">
                      
                <p><i class="fa fa-arrow-down" style=""></i></p>
            </div>
            
            <div class="col-lg-1 col-md-1">
            </div>
            
            
          <div class="col-lg-2 col-md-2">
                <p><i class="fa fa-arrow-up" style=""></i></p>
                <p><i class="fa fa-arrow-down" style=""></i></p>
            </div>
            
            <div class="col-lg-1 col-md-1">
            </div>
           <div class="col-lg-2 col-md-2">
                <p><i class="fa fa-arrow-up" style=""></i></p>
                <p><i class="fa fa-arrow-down" style=""></i></p>
            </div>
            
            <div class="col-lg-1 col-md-1">
                
            </div>
            
            <div class="col-lg-2 col-md-2">
                <p><i class="fa fa-arrow-up" style=""></i></p>
                <p><i class="fa fa-arrow-down" style=""></i></p>
            </div>
        </div>
        
        <div class="row" style="border-top: 1px dotted black;border-bottom: 1px dotted black;padding-top:8px;">
        
            <div class="col-lg-2 col-md-2">
            <div class="thumbnail">
                    <span class="icon-megaphone" style="font-size: 3em;"></span>
                    <div class="caption">              
                       <p>Muziek?</p>
                          
                    </div>
                 </div>
            </div>
            
            <div class="col-lg-1 col-md-1">
                <i class="fa fa-arrow-right" style="margin-top:60%;"></i>
            </div>
            
            
            <div class="col-lg-2 col-md-2">
            <div class="thumbnail">
                    <span class="icon-profile-male" style="font-size: 3em;"></span>
                    <div class="caption">              
                       <p>Leden </p>
                     
                    </div>
                 </div>
            </div>
            
            <div class="col-lg-1 col-md-1">
                <i class="fa fa-arrow-right" style="margin-top:60%;"></i>
            </div>
            
    
            
            <div class="col-lg-2 col-md-2">
            <div class="thumbnail">
                    <span class="icon-calendar" style="font-size: 3em;"></span>
                    <div class="caption">              
                       <p>Bookingstool</p>
                      
                    </div>
                 </div>
            </div>
            
            <div class="col-lg-1 col-md-1">
                <i class="fa fa-arrow-right" style="margin-top:60%;"></i>
            </div>
            
            <div class="col-lg-2 col-md-2">
            <div class="thumbnail">
                    <span class="icon-newspaper" style="font-size: 3em;"></span>
                    <div class="caption">              
                       <p>Blog+vlog</p>
                    </div>
                 </div>
            </div>
            
        </div>
        <div class="row">
        
            <div class="col-lg-2 col-md-2">
                      
                
            </div>
            
            <div class="col-lg-1 col-md-1">
            </div>
            
            
          <div class="col-lg-2 col-md-2">
                
            </div>
            
            <div class="col-lg-1 col-md-1">
            </div>
           <div class="col-lg-2 col-md-2">
             
            </div>
            
            <div class="col-lg-1 col-md-1">
                
            </div>
            
            <div class="col-lg-2 col-md-2">
                <p><i class="fa fa-arrow-up" style=""></i></p>
                <p><i class="fa fa-arrow-down" style=""></i></p>
            </div>
        </div>
        
        <div class="row">
        
            <div class="col-lg-2 col-md-2">
            </div>
            
            <div class="col-lg-1 col-md-1">
               
            </div>
            
            
            <div class="col-lg-2 col-md-2">
   
            </div>
            
            <div class="col-lg-1 col-md-1">
                
            </div>
            
    
            
            <div class="col-lg-2 col-md-2">
          
            </div>
            
            <div class="col-lg-1 col-md-1">
            
            </div>
            
            <div class="col-lg-2 col-md-2">
                   <div class="thumbnail">
                    <span class="icon-trophy" style="font-size: 3em;"></span>
                    <div class="caption">              
                       <p>Evaluatie &amp; feedback</p>
                    </div>
        </div>
        </div>
    </div>
                
                </div>';
        echo '</div>';
    
    echo "</div>";
}



?>




<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Webland | Backoffice</title>
    
    <meta name="description" content=">Webland | " />
    <meta name="google-site-verification" content="ExQ89lGiGlXTIDoWcfx5CxMkRu-Wtubn8FYir2BJRU8" />
    <?php $ctrl->printStyles(); ?>
</head>
<body>
<div class="container-fluid ruimte-top">

    <div id="vliegerContent" style="padding-top: 4%; padding-bottom: 4%; border-bottom: 1px solid black;background: url('/portaal/bg.jpg'); background-size: cover;" class="text-center">
        <h1 style=" text-shadow: 3px 3px #000; color: white; margin-top: 0; margin-left: auto; margin-right: auto; padding-top: 5%; padding-bottom: 5%;"class="text-vertical-center" data-stellar-background-ratio="0.5">Beheerders Pagina</h1>
    </div>
<?php $ctrl->print_supernav(); ?> 

    <div class="row" style="padding-bottom: 1%; background-color: white;">

    </div>
<?php
    if($_SESSION['user']=="ok")
    {
    showOptions($ctrl,$title);
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
    <script>
        $("#businessList").hide();
        $("#mySiteList").hide();
        $("#horecaList").hide();
        $("#webshopList").hide();
        $("#futureList").hide();
        $("#whrList").hide();
        //
        $("#futurePanel").click(function() {
            $("#futureList").toggle();
        });
        $("#businessPanel").click(function() {
            $("#businessList").toggle();
        });
         $("#mySitePanel").click(function() {
             $("#mySiteList").toggle();
        });
        $("#horecaPanel").click(function() {
             $("#horecaList").toggle();
        });
         $("#webshopPanel").click(function() {
             $("#webshopList").toggle();
        });
         $("#whrPanel").click(function() {
             $("#whrList").toggle();
        });
    </script>

</body>
</html>
<!-- GELIEVE ZELF JE CODE TE SCHRIJVEN. 130EURO PER GEKOPIEERDE FUNCTIE VOOR VRAGEN CONTACTEER SABAM-->
<!-- (SOFTWARE VALT ONDER DE AUTEURSWETGEVING.)-->