<?php session_start();

$path = getcwd();
$path = str_replace("producten", "", $path);
define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/adminController.php"); 


$ctrl=new AdminController();
$ctrl->verify();
$title= "Product pagina - Detail.";

function getmerk($id=1)
{
    $ctrl=new AdminController();
    $conn= $ctrl->getConnection();
    $sql = "SELECT naam FROM `merk` where id=".$id;
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $brand= $row['naam'];
        }
    } else {
        echo "opgelet, product zonder merk";
    }
    $conn->close();
    return $brand;
}

function getPic($id){
    $ctrl=new AdminController();
    $conn= $ctrl->getConnection();
    $_SESSION['catog']=$_GET['id'];
    $sql = "SELECT * FROM `product_afbeelding` where item=".$id." ORDER BY created DESC";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $pic= $row['foto'];
        }
    }
    $conn->close();
    return $pic;
}

function toonProds()
{
	$ctrl=new AdminController();
    $conn= $ctrl->getConnection();
    $_SESSION['catog']=$_GET['id'];
    $sql = "SELECT * FROM `product` where catog=".$_GET['id']." and removed= 0 order by id desc";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
        $merk=getmerk($row['merk']);
        $catog=getcatog($_GET['id']);
        $row['foto']=getPic($row['id']);
            echo '<div class="col-lg-4 productThumb brand-'.$row['merk'].'">
                <div class="thumbnail " style="border: 2px solid black;">
                 <div class="snow-flake" style="background: url(\'/producten/uploads/'.$row['foto'].'\');background-size: cover;"></div>
      <div class="caption">
        <p> '.$row['naam'].' - '.$row['aantal'].'-'.$row['prijs'].'EUR</p>
        <p> '.$row['omschrijving'].'</p>
        <p>Merk: '.$merk.'</p>
        <p>'.$catog.'</p>';
        echo '<p><a class="btn btn-default" href="foto.php?id='.$row['id'].'"><i class="fa fa-camera-retro"></i></a>';
            if($row['publish']==0){
                echo '<a href="hideOrPublish.php?id='.$row['id'].'" class="btn btn-light" role="button"><i class="fa fa-eye"></i></a>';
            }
            else{
                echo '<a href="hideOrPublish.php?id='.$row['id'].'" class="btn btn-light" role="button"><i class="fa fa-eye-slash"></i></a>';
            }
                     

        echo '
         <a class="btn btn-dark" href="update.php?id='.$row['id'].'"><i class="fa fa-pen-fancy" style="color:white;"></i></a>
        <a class="btn btn-dark" href="add.php?id='.$row['id'].'">+</a>
        <a class="btn btn-dark" href="minus.php?id='.$row['id'].'">-</a>
        <a class="btn btn-dark" href="/billing/create.php?prod='.$row['id'].'"><i class="fa fa-bank" style="color:white;"></i></a>
        <a class="btn btn-dark" href="remove.php?id='.$row['id'].'"><i class="fa fa-times" style="color:red;"></i></a></p>
      </div>
    </div>';
                
                    
            echo '</div>';
        }
    } else {
        echo "Geen producten gevonden voor deze categorie.";
    }
    $conn->close();

}

function getcatog($id=1)
{
    $ctrl=new AdminController();
    $conn= $ctrl->getConnection();
    $sql = "SELECT naam FROM `catog` where id=".$id;
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $brand= $row['naam'];
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    return $brand;
}

function getCatogs(){
     $ctrl=new AdminController();
    $conn= $ctrl->getConnection();
    $sql = "SELECT * FROM `catog` ";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            echo '<a class="dropdown-item zip-item" href="/producten/detail.php?id='.$row['id'].'">'.$row['naam'].'</a>';
        }
    } else {
        echo "0 results";
    }
    $conn->close();

}

function getBrands(){
     $ctrl=new AdminController();
    $conn= $ctrl->getConnection();
    $sql = "SELECT * FROM `merk` ";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            echo '<a merk="brand-'.$row['id'].'" class="dropdown-item brand-link" >'.$row['naam'].'</a>';
        }
    } else {
        echo "0 results";
    }
    $conn->close();

}
function showOptions($ctrl,$title){
    echo "<div class='row'>";
       
         $ctrl->side_nav();   
        echo '<div class="col-md-9">';
        echo '<div class="btn-group">';
        echo '<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Categorie
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
  getCatogs();
  echo '</div></div>';
  
          echo '<div class="dropdown" style="margin-left:8px;">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Merk
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
  getBrands();
  echo '</div></div></div>';

                     echo '
                <form id="searchForm" method="post" class="form-inline my-2 my-lg-0 pull-right">
      <input style="border:1px solid black; "class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="zoek" id="searchBar">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fa fa-search"></i></button>
    </form>';
               
               echo ' <h1>'.$title.'</h1>';
               
                
               echo ' <hr />'; 
               echo "<div class='row' id='productContainer'>";
                               
             
               toonProds();
               echo "</div>";
               echo ' </div></div>';
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
    <style>
        .snow-flake {
            width: 100%;
            padding-bottom: 60%;
        }
    </style>
</head>
<body>
<div class="container-fluid ruimte-top">

    <div id="vliegerContent" style="padding-top: 4%; padding-bottom: 4%; border-bottom: 1px solid black;background: url('/tegels/bg.jpg'); background-size: cover;" class="text-center">
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
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
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


 $(".brand-link").click(function() {
    $(".productThumb").hide();
    var brand="."+$(this).attr('merk');
    $(brand).show();
});

$("#searchBar").keyup(function() {
    var jqxhr = $.post( "/shop/search.php", { zoek: $("#searchBar").val()}, function() {
})
  .done(function(data) {
     $("#productContainer").empty();  
     var row = jQuery.parseJSON( data );
  
     $.each( row, function( index, value ){
      
         var background="background: url('/producten/uploads/"+value.foto+"');";
         var box =' <div class="col-lg-4">';
           box =box +'<div class="thumbnail" style="border: 2px solid black;">';
           box = box+'<div class="snow-flake" style="'+background+'background-size: cover;">';
      
           box = box +'</div>';
                box = box + '<div class="caption">';
           box = box + "<p>"+value.naam+"-"+value.prijs+"</p>"
            box = box + "<p>"+value.omschrijving+"-"+value.prijs+"</p>";
            box = box + "<p>Merk: "+value.brand+"</p>";
             box = box + "<p>"+value.catog+"</p>";
             box = box + "<p>";
             box = box + '<a class="btn btn-default" href="foto.php?id=';
             box = box + value.id;
             box = box +'"><i class="fa fa-camera-retro"></i></a>';
            
             if(value.publish=="0"){
                 box = box + '<a href="hideOrPublish.php?id=';
                 box = box + value.id;
                 box = box + '" class="btn btn-light" role="button"><i class="fa fa-eye"></i></a>';
             }
             else{
                 box = box + '<a href="hideOrPublish.php?id=';
                 box = box + value.id;
                 box = box + '" class="btn btn-light" role="button"><i class="fa fa-eye-slash"></i></a>';
             }
             box = box + '<a class="btn btn-dark" href="update.php?id=';
             box = box + value.id;
             box = box + '"><i class="fa fa-pen-fancy" style="color:white;"></i></a>';
             box = box + '<a class="btn btn-dark" href="add.php?id=';
             box = box + '">+</a>';
             box = box + ' <a class="btn btn-dark" href="minus.php?id=';
             box = box + '">-</a>';
             box = box + '<a class="btn btn-dark" href="/billing/create.php?prod=';
             box = box +  value.id;
             box = box + '"><i class="fa fa-bank" style="color:white;"></i></a></p>';
           box = box + '</div>';
           box = box + '</div>';
         box = box + '</div>';
         
         $("#productContainer").append(box);
    });
  })
  .fail(function() {
    console.log( "error" );
  })
  .always(function() {
    console.log( "finished" );
  });
});
    </script>

</body>
</html>
<!-- GELIEVE ZELF JE CODE TE SCHRIJVEN. 130EURO PER GEKOPIEERDE FUNCTIE VOOR VRAGEN CONTACTEER SABAM-->
<!-- (SOFTWARE VALT ONDER DE AUTEURSWETGEVING.)-->