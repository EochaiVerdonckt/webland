<?php
session_start();
$path = getcwd();
$path = str_replace("fulgur", "", $path);

define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/adminController.php"); 
include (FSPATH."Controllers/indexController.php"); 

$ctrl=new AdminController();
$ctrl->verify();
$title= "Kies je template";


function getTemplate(){
      $ctrl=new IndexController();
    $conn=$ctrl->getConnection();

    $sql = "SELECT * FROM `promo_balance` where id=8";
    $item=array();
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
           $item=$row;
        }

    } else {
        echo "0 results";
    }

    $conn->close();
    return $item['promo'];
}

function print_templates(){
    $template=getTemplate();
    echo "<div class='row'>";
    echo '<div class="col-md-3">
	       <img src="/virgo.png" style="width:100%;"/>';
	       if($template==1){
	            echo '<a  style="color:white;" class="btn btn-warning" >KIES</a>';
	       }else{
	       echo '<a  href="update.php?id=1" style="color:white;" class="btn btn-dark" >KIES</a>';
	       }
	echo '</div>';
    echo '<div class="col-md-3">
	       <img src="/scorpio.png" style="width:100%;"/>';
	        if($template==2){
	            echo '<a  style="color:white;" class="btn btn-warning" >KIES</a>';
	       }else{
	       echo '<a  href="update.php?id=2" style="color:white;" class="btn btn-dark" >KIES</a>';
	       }
	echo '</div>';
	echo '<div class="col-md-3">
	        <img src="/sagittarius.png" style="width:100%;"/>';
	   if($template==3){
	       echo '<a  style="color:white;" class="btn btn-warning" >KIES</a>';
	   }else{
	       echo ' <a href="update.php?id=3" style="color:white;" class="btn btn-dark" >KIES</a>';
	   }       
	 echo '</div>';
	 echo '<div class="col-md-3">
	           <img src="/aquarius.jpg" style="width:100%;"/>';
	  if($template==4){
	       echo '<a  style="color:white;" class="btn btn-warning" >KIES</a>';
	   }else{
	       echo ' <a href="update.php?id=4" style="color:white;" class="btn btn-dark" >KIES</a>';
	   }                          
	   echo '</div>';
	   echo '<div class="col-md-3">
	           <img src="/pisces.png" style="width:100%;"/>';
	   if($template==5){
	       echo '<a  style="color:white;" class="btn btn-warning" >KIES</a>';
	   }else{
	       echo ' <a href="update.php?id=5" style="color:white;" class="btn btn-dark" >KIES</a>';
	   }          
	   echo '</div>';
	   echo '<div class="col-md-3">
	           <img src="/libra.png" style="width:100%;"/>';
	     if($template==6){
	       echo '<a  style="color:white;" class="btn btn-warning" >KIES</a>';
	   }else{
	       echo ' <a href="update.php?id=6" style="color:white;" class="btn btn-dark" >KIES</a>';
	   }        
	   echo '</div>';
	   echo '<div class="col-md-3">
	            <img src="/capricorn.png" style="width:100%;"/>';
	   if($template==7){
	       echo '<a  style="color:white;" class="btn btn-warning" >KIES</a>';
	   }else{
	       echo ' <a href="update.php?id=7" style="color:white;" class="btn btn-dark" >KIES</a>';
	   }         
	   echo '</div>';
	   echo '<div class="col-md-3">
	           <img src="/cancer.png" style="width:100%;"/>';
	   if($template==8){
	       echo '<a  style="color:white;" class="btn btn-warning" >KIES</a>';
	   }else{
	       echo ' <a href="update.php?id=8" style="color:white;" class="btn btn-dark" >KIES</a>';
	   }         
	   echo '</div>';
	   echo '<div class="col-md-3">
	           <img src="/ariers.png" style="width:100%;"/>';
	   if($template==9){
	       echo '<a  style="color:white;" class="btn btn-warning" >KIES</a>';
	   }else{
	       echo ' <a href="update.php?id=9" style="color:white;" class="btn btn-dark" >KIES</a>';
	   }          
	   echo '</div>';
	   echo '<div class="col-md-3">
	           <img src="/taurus.png" style="width:100%;"/>';
	   if($template==10){
	       echo '<a  style="color:white;" class="btn btn-warning" >KIES</a>';
	   }else{
	       echo ' <a href="update.php?id=10" style="color:white;" class="btn btn-dark" >KIES</a>';
	   }         
	   echo '</div>';
	   echo '<div class="col-md-3">
	           <img src="/leo.png" style="width:100%;"/>';
	   if($template==11){
	       echo '<a  style="color:white;" class="btn btn-warning" >KIES</a>';
	   }else{
	       echo ' <a href="update.php?id=11" style="color:white;" class="btn btn-dark" >KIES</a>';
	   }         
	   echo '</div>';
	   echo '<div class="col-md-3">
	           <img src="/gemini.png" style="width:100%;"/>';
	   if($template==12){
	       echo '<a  style="color:white;" class="btn btn-warning" >KIES</a>';
	   }else{
	       echo ' <a href="update.php?id=12" style="color:white;" class="btn btn-dark" >KIES</a>';
	   }         
	   echo '</div>';
	   
	   	   echo '<div class="col-md-3">
	           <img src="/slang.jpg" style="width:100%;"/>';
	   if($template==13){
	       echo '<a  style="color:white;" class="btn btn-warning" >KIES</a>';
	   }else{
	       echo ' <a href="update.php?id=13" style="color:white;" class="btn btn-dark" >KIES</a>';
	   }         
	   echo '</div>';
	   
	   
	   	   	   echo '<div class="col-md-3">
	           <img src="/rabbit.jpg" style="width:100%;"/>';
	   if($template==14){
	       echo '<a  style="color:white;" class="btn btn-warning" >KIES</a>';
	   }else{
	       echo ' <a href="update.php?id=14" style="color:white;" class="btn btn-dark" >KIES</a>';
	   }         
	   echo '</div>';
	   
	      echo '<div class="col-md-3">
	           <img src="/rooster.jpg" style="width:100%;"/>';
	   if($template==15){
	       echo '<a  style="color:white;" class="btn btn-warning" >KIES</a>';
	   }else{
	       echo ' <a href="update.php?id=15" style="color:white;" class="btn btn-dark" >KIES</a>';
	   }         
	   echo '</div>';
	   
	   
	      echo '<div class="col-md-3">
	           <img src="/ox.jpg" style="width:100%;"/>';
	   if($template==16){
	       echo '<a  style="color:white;" class="btn btn-warning" >KIES</a>';
	   }else{
	       echo ' <a href="update.php?id=16" style="color:white;" class="btn btn-dark" >KIES</a>';
	   }         
	   echo '</div>';
	   
	   	      echo '<div class="col-md-3">
	           <img src="/rat.webp" style="width:100%;"/>';
	   if($template==17){
	       echo '<a  style="color:white;" class="btn btn-warning" >KIES</a>';
	   }else{
	       echo ' <a href="update.php?id=17" style="color:white;" class="btn btn-dark" >KIES</a>';
	   }         
	   echo '</div>';
	   
	    echo '<div class="col-md-3">
	           <img src="/gold/services/service-82229.jpg" style="width:100%;"/>';
	   if($template==18){
	       echo '<a  style="color:white;" class="btn btn-warning" >KIES</a>';
	   }else{
	       echo ' <a href="update.php?id=18" style="color:white;" class="btn btn-dark" >KIES</a>';
	   }         
	   echo '</div>';
	   
	   	    echo '<div class="col-md-3">
	           <img src="/gold/services/service-82233.jpg" style="width:100%;"/>';
	   if($template==19){
	       echo '<a  style="color:white;" class="btn btn-warning" >KIES</a>';
	   }else{
	       echo ' <a href="update.php?id=19" style="color:white;" class="btn btn-dark" >KIES</a>';
	   }         
	   echo '</div>';
	   
	   echo '<div class="col-md-3">
	           <img src="/gold/services/service-82228.jpg" style="width:100%;"/>';
	   if($template==20){
	       echo '<a  style="color:white;" class="btn btn-warning" >KIES</a>';
	   }else{
	       echo ' <a href="update.php?id=20" style="color:white;" class="btn btn-dark" >KIES</a>';
	   }         
	   echo '</div>';
	   
	   //
	   echo '<div class="col-md-3">
	           <img src="/gold/services/service-82231.jpg" style="width:100%;"/>';
	   if($template==21){
	       echo '<a  style="color:white;" class="btn btn-warning" >KIES</a>';
	   }else{
	       echo ' <a href="update.php?id=21" style="color:white;" class="btn btn-dark" >KIES</a>';
	   }         
	   echo '</div>';
	   
	   
	   echo '</div>';
}
function showOptions($ctrl,$title){
    echo "<div class='row'>";
       
         $ctrl->side_nav();   
      
        
        echo "<div class='col-md-9' style='background:url(future.jpg);min-height: 150vh;background-size:cover;'>";
                echo '<div class="well text-center" style="width: 100%;margin-top:50px; padding:20px;">
                
                <h1>'.$title.'</h1>
                <hr />'; 
               print_templates();
                
            echo    '</div>';
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
<style>
    .thumbnail img{
        max-width:100%;
    }
</style>
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