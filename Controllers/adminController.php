<?php session_start();


class AdminController extends SuperController{ 

public function getFlag($id){
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
public function printStyles(){
    echo '
    <!-- Bootstrap css -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
    <!-- Icons Font -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/font5/css/fontawesome.min.css">
    <link href="/font5/css/brands.css" rel="stylesheet">
    <link href="/font5/css/solid.css" rel="stylesheet">
     <link href="/vendor/Icons/et-line-font/style.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->';
}    
public function print_supernav(){
       echo '    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="/portaal/"><i class="fa fa-home" style="color:white;"></i></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>';
   echo '<div> <a type="button" class="btn btn-primary" href="/portaal-fr/">FR</a> </div>';
   echo '<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
     <li>
     <div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    My site CMS
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="/gold/logo/">logo</a> 
    <a class="dropdown-item" href="/gold/color/">Color</a> 
    <a class="dropdown-item" href="/gold/seo/">gegevens</a>';
    echo '<a class="dropdown-item" href="/gold/keywords/">keywords</a> 
    <a class="dropdown-item" href="/gold/about/">about</a>';
    if($this->getFlag(15)=='#FFF'){
      echo '<a class="dropdown-item" href="/gold/hours/">uurrooster</a> ';  
    } 
    if($this->getFlag(14)=='#FFF'){
      echo '<a class="dropdown-item" href="/gold/services/">diensten</a>';    
    }
    if($this->getFlag(9)=='#FFF'){
          echo '<a class="dropdown-item" href="/gold/krijtbord/">krijtbord</a>'; 
    }
     if($this->getFlag(10)=='#FFF'){
         echo '<a class="dropdown-item" href="/gold/blog/">blog</a>'; 
    }
    if($this->getFlag(11)=='#FFF'){
         echo '<a class="dropdown-item" href="/gold/vlog/">vlog</a>';   
    }
    if($this->getFlag(12)=='#FFF'){
        echo '<a class="dropdown-item" href="/gold/events/">events</a>';
    }
     if($this->getFlag(13)=='#FFF'){
         echo '<a class="dropdown-item" href="/gold/afbeeldingen/">fotopagina</a>';
     }
    echo '<a class="dropdown-item" href="/logIn/out.php">afmelden</a>'; 
    echo '
  </div>
</div>
     </li>';
      if($this->getFlag(18)=='#FFF'){
    echo '<li>
     <div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    BUSSINESS ERP
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
   if($this->getFlag(16)=='#FFF'){
        echo '<a class="dropdown-item" href="/bussiness/mission/">missie</a>';
   }
   if($this->getFlag(17)=='#FFF'){
       echo '<a class="dropdown-item" href="/bussiness/strenght/">sterktes</a>'; 
   }
   if($this->getFlag(19)=='#FFF'){
       echo '<a class="dropdown-item" href="/bussiness/zakenplan/">zakenplan</a>';
   }
   if($this->getFlag(20)=='#FFF'){
     echo '<a class="dropdown-item" href="/bussiness/slides/">bedrijfspresentatie</a>';  
   }
   if($this->getFlag(21)=='#FFF'){
    echo '<a class="dropdown-item" href="/bussiness/ganzenbord/">bordspel</a>';   
   }
   if($this->getFlag(22)=='#FFF'){
     echo '<a class="dropdown-item" href="/bussiness/reviews/">reviews</a>';  
   }
   if($this->getFlag(23)=='#FFF'){
    echo '<a class="dropdown-item" href="/bussiness/klanten/">klanten</a>';   
   }
   if($this->getFlag(24)=='#FFF'){
     echo '<a class="dropdown-item" href="/bussiness/agenda/">agenda</a>';   
   }
   if($this->getFlag(26)=='#FFF'){
     echo '<a class="dropdown-item" href="/bussiness/billing/">facturatie</a>';  
   }if($this->getFlag(25)=='#FFF'){
    echo '<a class="dropdown-item" href="/bussiness/vragen/">q&a</a>';   
   }
   if($this->getFlag(29)=='#FFF'){
    echo '<a class="dropdown-item" href="/bussiness/members/">leden</a>';   
   }
   if($this->getFlag(30)=='#FFF'){
    echo '<a class="dropdown-item" href="/bussiness/departments/">departementen</a>';   
   }
   if($this->getFlag(31)=='#FFF'){
    echo '<a class="dropdown-item" href="/bussiness/functies/">functies</a>';   
   }
   if($this->getFlag(32)=='#FFF'){
    echo '<a class="dropdown-item" href="/bussiness/vacatures/">vacatures</a>';   
   }
    echo '<a class="dropdown-item" href="/logIn/out.php">afmelden</a>'; 
    
    if(getFlag(42)=='#FFF'){
        echo '<li>
     <div class="dropdown">
  <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    WEBSHOP
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
      echo '<a class="dropdown-item" href="/webshop/categ/">categorie</a>';
      echo '<a class="dropdown-item" href="/webshop/merk/">merken</a>';
      echo '<a class="dropdown-item" href="/webshop/producten/">producten</a>';
      echo '<a class="dropdown-item" href="/webshop/kassa/">kassa</a>';
      echo '<a class="dropdown-item" href="/logIn/out.php">afmelden</a>';
  
    }   
    
    
    echo '
  </div>
</div>
     </li>';
      }
      
      if($this->getFlag(33)=='#FFF'){
    echo '<li>
     <div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    HORECA
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
   if($this->getFlag(34)=='#FFF'){
        echo '<a class="dropdown-item" href="/horeca/prices/">menu</a>';
   }
   if($this->getFlag(35)=='#FFF'){
        echo '<a class="dropdown-item" href="/horeca/orders/">bestellingen</a>';
   }
   if($this->getFlag(36)=='#FFF'){
        echo '<a class="dropdown-item" href="/horeca/orders/"> certain bestellingen</a>';
   }

   if($this->getFlag(38)=='#FFF'){
        echo '<a class="dropdown-item" href="/horeca/orders/">reservaties</a>';
   }
   if($this->getFlag(39)=='#FFF'){
        echo '<a class="dropdown-item" href="/horeca/orders/">z-rapportering</a>';
   }
   if($this->getFlag(40)=='#FFF'){
        echo '<a class="dropdown-item" href="/horeca/orders/">gangen</a>';
   }
    echo '<a class="dropdown-item" href="/logIn/out.php">afmelden</a>'; 
    
    echo '
  </div>
</div>
     </li>';
      }
     echo '
    </ul>
     <a href="/logIn/out.php" class="btn btn-danger">
    Afmelden
  </a>
    
  </div>
</nav>';
}
public function print_side_nav_webshop(){
    $onclick7= "onclick=$('#shopLinks').hide();$('#shopMinus').hide();$('#shopExpand').show();";
    $onclick8= "onclick=$('#shopLinks').show();$('#shopExpand').hide();$('#shopMinus').show();";
    echo "<p style='cursor:pointer;font-weight: bolder;color:black;border:0;padding:0;margin-bottom:0'><i class='fa-solid fa-basket-o'></i> Webshop <i id='shopMinus' ".$onclick7."  style='color:red;' class='fa fa-minus'></i> <i id='shopExpand' ".$onclick8."  style='color:green;display: none;' class='fa fa-plus'></i></p>";
    echo '<div id="shopLinks">';
     echo '<a class="list-group-item  " href="/webshop/categ/" style="font-weight: bolder;color: black;"><i class="fas fa-tags"></i> Categorie</a>';
     echo '<a class="list-group-item  " href="/webshop/merk/" style="font-weight: bolder;color: black;"><i class="fa fa-shopping-bag"></i> merken</a>';
     echo '<a class="list-group-item  " href="/webshop/producten/" style="font-weight: bolder;color: black;"><i class="fa fa-cubes"></i> producten</a>';
     echo '<a class="list-group-item  " href="/webshop/kassa/" style="font-weight: bolder;color: black;"><i class="fa fa-shopping-cart"></i> kassa</a>';
    
    echo "</div>";
}
public function print_side_nav_horeca(){
      $onclick5= "onclick=$('#horecaLinks').hide();$('#horecaMinus').hide();$('#horecaExpand').show();";
    $onclick6= "onclick=$('#horecaLinks').show();$('#horecaExpand').hide();$('#horecaMinus').show();";
    echo "<p style='cursor:pointer;font-weight: bolder;color:black;border:0;padding:0;margin-bottom:0'><i class='fa-solid fa-cutlery'></i> Horeca <i id='horecaMinus' ".$onclick5."  style='color:red;' class='fa fa-minus'></i> <i id='horecaExpand' ".$onclick6."  style='color:green;display: none;' class='fa fa-plus'></i></p>";
    echo '<div id="horecaLinks">';
    if($this->getFlag(34)=='#FFF'){
        echo '<a class="list-group-item  " href="/horeca/prices/" style="font-weight: bolder;color: black;"><i class="fas fa-map"></i> Menu</a>'; 
    }
    
    if($this->getFlag(35)=='#FFF'){
        echo '<a class="list-group-item  " href="/horeca/orders/" style="font-weight: bolder;color: black;"><i class="fas fa-bicycle"></i> bestellingen</a>'; 
    }
    
    if($this->getFlag(36)=='#FFF'){
        echo '<a class="list-group-item  " href="/horeca/orders/certain" style="font-weight: bolder;color: black;"><i class="fas fa-clock-o"></i> Periodieke bestellingen</a>'; 
    }
    
    if($this->getFlag(39)=='#FFF'){
        echo '<a class="list-group-item  " href="/horeca/reservaties" style="font-weight: bolder;color: black;"><i class="fas fa-pizza-slice"></i> Z rapporten </a>'; 
    }
    
    if($this->getFlag(36)=='#FFF'){
        echo '<a class="list-group-item  " href="/horeca/reservaties" style="font-weight: bolder;color: black;"><i class="fas fa-calendar"></i> Reservaties </a>'; 
    }
    
    if($this->getFlag(34)=='#FFF'){
        echo '<a class="list-group-item  " href="/horeca/prices/" style="font-weight: bolder;color: black;"><i class="fas fa-fish"></i> Gangen</a>'; 
    }
    
    echo '</div>';
}
public function print_side_nav_bussiness(){
     /*START BUSSINESS LINKS*/
       $onclick3= "onclick=$('#bussLinks').hide();$('#bussMinus').hide();$('#bussExpand').show();";
    $onclick4= "onclick=$('#bussLinks').show();$('#bussExpand').hide();$('#bussMinus').show();";
    echo "<p style='cursor:pointer;font-weight: bolder;color:black;border:0;padding:0;margin-bottom:0'><i class='fa-solid fa-mug-hot'></i> Bussiness ERP <i id='bussMinus' ".$onclick3."  style='color:red;' class='fa fa-minus'></i> <i id='bussExpand' ".$onclick4."  style='color:green;display: none;' class='fa fa-plus'></i></p>";
  
      
    echo '<div id="bussLinks">';
    if($this->getFlag(16)=='#FFF'){
    echo '<a class="list-group-item  " href="/bussiness/mission/" style="font-weight: bolder;color: black;"><i class="fa fa-trophy"></i> Missie</a>';
    }
    if($this->getFlag(17)=='#FFF'){
    echo '<a class="list-group-item  " href="/bussiness/strenght/" style="font-weight: bolder;color: black;"><i class="fa fa-star"></i> Sterktes</a>';
    }
    if($this->getFlag(19)=='#FFF'){
    echo '<a class="list-group-item  " href="/bussiness/zakenplan/" style="font-weight: bolder;color: black;"><i class="fa fa-plane"></i> Zakenplan</a>';
    }
    if($this->getFlag(20)=='#FFF'){
    echo '<a class="list-group-item  " href="/bussiness/slides/" style="font-weight: bolder;color: black;"><i class="fab fa-slideshare"></i> Bedrijfspresentatie</a>';
    }
    if($this->getFlag(21)=='#FFF'){
    echo '<a class="list-group-item  " href="/bussiness/ganzenbord/" style="font-weight: bolder;color: black;"><i class="fa fa-chess"></i> Bordspel</a>';
    }
    if($this->getFlag(22)=='#FFF'){
    echo '<a class="list-group-item  " href="/bussiness/reviews/" style="font-weight: bolder;color: black;"><i class="fa fa-heart"></i> Reviews</a>';
    }
    if($this->getFlag(23)=='#FFF'){
    echo '<a class="list-group-item  " href="/bussiness/klanten/" style="font-weight: bolder;color: black;"><i class="fa fa-users"></i> Klanten</a>';
    }
    if($this->getFlag(24)=='#FFF'){
     echo '<a class="list-group-item  " href="/bussiness/agenda/" style="font-weight: bolder;color: black;"><i class="fa fa-book"></i> Agenda</a>';
    }
    if($this->getFlag(26)=='#FFF'){
     echo '<a class="list-group-item  " href="/bussiness/billing/" style="font-weight: bolder;color: black;"><i class="fa fa-bank"></i> Facturatie</a>';
    }
    if($this->getFlag(25)=='#FFF'){
     echo '<a class="list-group-item  " href="/bussiness/vragen/" style="font-weight: bolder;color: black;"><i class="fa fa-question"></i> Q&A</a>';
    }
    if($this->getFlag(29)=='#FFF'){
     echo '<a class="list-group-item  " href="/bussiness/doelgroep/" style="font-weight: bolder;color: black;"><i class="fa fa-sun-o"></i> Doelgroep</a>';
    }
    if($this->getFlag(28)=='#FFF'){
     echo '<a class="list-group-item  " href="/bussiness/members/" style="font-weight: bolder;color: black;"><i class="fa fa-users"></i> Leden</a>';
    }
    if($this->getFlag(30)=='#FFF'){
     echo '<a class="list-group-item  " href="/bussiness/departments/" style="font-weight: bolder;color: black;"><i class="fa fa-building"></i> Departementen</a>';
    }
    if($this->getFlag(30)=='#FFF'){
     echo '<a class="list-group-item  " href="/bussiness/functies/" style="font-weight: bolder;color: black;"><i class="fa fa-network-wired"></i> Functies</a>';
    }
    if($this->getFlag(31)=='#FFF'){
     echo '<a class="list-group-item  " href="/bussiness/vacatures/" style="font-weight: bolder;color: black;"><i class="fa fa-wrench"></i> vacatures</a>';
    }
    echo '</div>';
    /*END BUSSINESS LINKS*/
}
public function print_side_nav_gold(){
    echo "<div class='col-lg-3' style='border-right: 1px solid black;'>";
    if(isset($_SESSION['user2'])){
         echo "<a href='/portaal/reset.php' style='cursor:pointer;    font-weight: bolder;color:black;border:0;padding:0;margin-bottom:0'><i class='fa fa-undo' style='color:red;'></i> Reset naar fabrieksinstellingen.</a>";
      
    echo '<a class="list-group-item" href="/fulgur/" style="border:0;font-weight: bolder;color: black;padding:0;margin-bottom:0;"font-weight: bolder;color: black;"><i class="fas fa-gem" style="color: lightblue;"></i> Fulgur</a>';
    echo '<a class="list-group-item" href="/config/" style="border:0;font-weight: bolder;color: black;padding:0;margin-bottom:0;"font-weight: bolder;color: black;"><i class="fas fa-cog" style="color: red;"></i> Configuratie</a>';
    }
   
    echo "<p style='cursor:pointer;font-weight: bolder;color:black;border:0;padding:0;margin-bottom:0'><i class='fab fa-bootstrap' style='color:#7952B3;'></i> v4.5</p>";
    echo "<p style='cursor:pointer;font-weight: bolder;color:black;border:0;padding:0;margin-bottom:0'><i class='fab fa-font-awesome'style='color: lightblue;'></i> v5</p>";
    echo "<p style='cursor:pointer;font-weight: bolder;color:black;border:0;padding:0;margin-bottom:0'><i class='fas fa-edit' style='color:green;'></i>CkEditor v5</p>";
      $onclick= "onclick=$('#goldLinks').hide();$('#goldMinus').hide();$('#goldexpand').show();";
       $onclick2= "onclick=$('#goldLinks').show();$('#goldexpand').hide();$('#goldMinus').show();";
      /*START OF GOLD LINKS*/
    echo "<p style='cursor:pointer;font-weight: bolder;color:black;border:0;padding:0;margin-bottom:0'>Je website aanpassen - CMS <i id='goldMinus' ".$onclick."  style='color:red;' class='fa fa-minus'></i> <i id='goldexpand' ".$onclick2."  style='color:green;display: none;' class='fa fa-plus'></i> </p>";
    echo '<div id="goldLinks">';
    echo '<a class="list-group-item  " href="/gold/logo/" style="font-weight: bolder;color: black;"><i class="fa fa-brush"></i> Logo</a>';
       echo '<a class="list-group-item  " href="/gold/color/" style="font-weight: bolder;color: black;"><i class="fa fa-brush"></i> Color</a>';
    echo '<a class="list-group-item  " href="/gold/hours/" style="font-weight: bolder;color: black;"><i class="fa fa-clock-o"></i> Openingsuren</a>'; 
    echo '<a class="list-group-item  " href="/gold/seo/" style="font-weight: bolder;color: black;"><i class="fas fa-user"></i> Gegevens</a>';
    if($this->getFlag(9)=='#FFF'){
        echo '<a class="list-group-item  " href="/gold/krijtbord/" style="font-weight: bolder;color: black;"><i class="fas fa-gift"></i> Krijtbord</a>'; 
    }
   
    echo '<a class="list-group-item  " href="/gold/about/" style="font-weight: bolder;color: black;"><i class="fa fa-comment"></i> About</a>'; 
    if($this->getFlag(10)=='#FFF'){
    echo '<a class="list-group-item  " href="/gold/blog/" style="font-weight: bolder;color: black;"><i class="fa fa-bullhorn"></i> Blog</a>';
    }
    if($this->getFlag(11)=='#FFF'){
       echo '<a class="list-group-item  " href="/gold/vlog/" style="font-weight: bolder;color: black;"><i class="fab fa-youtube" style="color:red;"></i> Vlog</a>'; 
    }
    if($this->getFlag(12)=='#FFF'){
       echo '<a class="list-group-item  " href="/gold/events/" style="font-weight: bolder;color: black;"><i class="fa fa-calendar"></i> Events</a>'; 
    }
    if($this->getFlag(13)=='#FFF'){
      echo '<a class="list-group-item  " href="/gold/afbeeldingen/" style="font-weight: bolder;color: black;"><i class="fa fa-camera-retro"></i> Fotopagina</a>';  
    }         
    if($this->getFlag(14)=='#FFF'){
        echo '<a class="list-group-item  " href="/gold/services/" style="font-weight: bolder;color: black;"><i class="fa fa-briefcase"></i> diensten</a>';
    }       
    echo '<a class="list-group-item  " href="/gold/keywords/" style="font-weight: bolder;color: black;"><i class="fa fa-key"></i> Kernwoorden</a>'; 
    echo '</div>';
    /*END GOLD LINKS*/
    
   
            

    
}   
public function side_nav_old(){
     echo "<div class='col-lg-3' style='border-right: 1px solid black;'>";
      echo "<a href='/portaal/reset.php' style='cursor:pointer;    font-weight: bolder;color:black;border:0;padding:0;margin-bottom:0'><i class='fa fa-undo' style='color:red;'></i> Reset naar fabrieksinstellingen.</a>";
      echo "<p style='cursor:pointer;    font-weight: bolder;color:black;border:0;padding:0;margin-bottom:0'><i class='fa fa-database'></i> Databank</p>";
       echo "<p style='cursor:pointer;font-weight: bolder;color:black;border:0;padding:0;margin-bottom:0'><i class='fa fa-file'></i> .htaccess</p>";
      echo "<p style='cursor:pointer;font-weight: bolder;color:black;border:0;padding:0;margin-bottom:0'><i class='fa fa-bolt' style='color: #f3da0b;'></i> Engine</p>";
      echo "<p style='cursor:pointer;font-weight: bolder;color:black;border:0;padding:0;margin-bottom:0'><i class='fab fa-expeditedssl'></i> SSL/HTTPS</p>";
      echo '<p style="font-weight: bolder;color: black;order:0;padding:0;margin-bottom:0;"><i class="fa fa-line-chart"></i> Stock API</p>';
      echo '<p style="font-weight: bolder;color: black;padding:0;margin-bottom:0;"><i class="fa fa-shopping-bag"></i> Online Payments</p>';
      echo '<a class="list-group-item" href="/fulgur/" style="border:0;font-weight: bolder;color: black;padding:0;margin-bottom:0;"font-weight: bolder;color: black;"><i class="fas fa-gem" style="color: lightblue;"></i> Fulgur</a>';
      echo "<p style='cursor:pointer;font-weight: bolder;color:black;border:0;padding:0;margin-bottom:0'><i class='fab fa-bootstrap' style='color:#7952B3;'></i> v4.5</p>";
      echo "<p style='cursor:pointer;font-weight: bolder;color:black;border:0;padding:0;margin-bottom:0'><i class='fab fa-font-awesome'style='color: lightblue;'></i> v5</p>";
      echo "<p style='cursor:pointer;font-weight: bolder;color:black;border:0;padding:0;margin-bottom:0'><i class='fas fa-edit' style='color:green;'></i>CkEditor v5</p>";
       
      
        echo "<div id='businessPanel'><a href='#' class='list-group-item disabled'  style='cursor:pointer;    font-weight: bolder;color:black;border:0;padding:0;'><i class='fa fa-folder'></i> Business - ERP</a></div>";
       echo "<div id='businessList'>";
       echo '<a class="list-group-item  " href="/logo/" style="font-weight: bolder;color: black;"><i class="fa fa-eye"></i> Logo</a>';
       echo '<a class="list-group-item  " href="/seo/" style="font-weight: bolder;color: black;"><i class="fa fa-legal"></i> Gegevens</a>';
       echo '<a class="list-group-item  " href="/hours/" style="font-weight: bolder;color: black;"><i class="fa fa-clock-o"></i> Openingsuren</a>';    
       echo '<a class="list-group-item  " href="/services/" style="font-weight: bolder;color: black;"><i class="fa fa-briefcase"></i> Diensten</a>';
       echo '<a class="list-group-item  " href="/mission/" style="font-weight: bolder;color: black;"><i class="fa fa-trophy"></i> Missie</a>';
       echo '<a class="list-group-item  " href="/strenght/" style="font-weight: bolder;color: black;"><i class="fa fa-star"></i> Sterktes</a>';
       echo '<a class="list-group-item  " href="/slides/" style="font-weight: bolder;color: black;"><i class="fab fa-slideshare"></i> Bedrijfspresentatie</a>';
       echo '<a class="list-group-item  " href="/zakenplan/" style="font-weight: bolder;color: black;"><i class="fa fa-plane"></i> Businessplan</a>';
       echo '<a class="list-group-item  " href="/doelgroep/" style="font-weight: bolder;color: black;"><i class="fa fa-bullseye"></i> Doelgroep</a>';
       echo '<a class="list-group-item  " href="/ganzenbord/" style="font-weight: bolder;color: black;"><i class="fa fa-puzzle-piece"></i> Bordspel</a>';
       echo '<a class="list-group-item  " href="/reviews/" style="font-weight: bolder;color: black;"><i class="fa fa-heart"></i> Reviews</a>';
     
     
       echo '<a class="list-group-item  " href="/klanten/" style="font-weight: bolder;color: black;"><i class="fa fa-users"></i> Klanten</a>';
       echo '<a class="list-group-item  " href="/agenda/" style="font-weight: bolder;color: black;"><i class="fa fa-book"></i> Agenda</a>';
       echo '<a class="list-group-item  " href="/billing/" style="font-weight: bolder;color: black;"><i class="fa fa-bank"></i> Facturatie</a>';
       echo '<a class="list-group-item  " href="/vragen/" style="font-weight: bolder;color: black;"><i class="fa fa-question"></i> Q&A</a>';
       echo "</div>";
        echo "<div id='mySitePanel'><a href='#' class='list-group-item disabled'  style='cursor:pointer;    font-weight: bolder;color:black;border:0;padding:0;'><i class='fa fa-folder'></i> MySite - CMS</a></div>";
           echo "<div id='mySiteList'>";
            echo '<a class="list-group-item  " href="/krijtbord/" style="font-weight: bolder;color: black;"><i class="fas fa-gift"></i> Krijtbord</a>';
             echo '<a class="list-group-item  " href="/about/" style="font-weight: bolder;color: black;"><i class="fa fa-comment"></i> About</a>'; 
            echo '<a class="list-group-item  " href="/blog/" style="font-weight: bolder;color: black;"><i class="fa fa-bullhorn"></i> Blog</a>';
             echo '<a class="list-group-item  " href="/vlog/" style="font-weight: bolder;color: black;"><i class="fab fa-youtube" style="color:red;"></i> Vlog</a>';
            echo '<a class="list-group-item  " href="/events/" style="font-weight: bolder;color: black;"><i class="fa fa-calendar"></i> Events</a>';
            echo '<a class="list-group-item  " href="/picV2/" style="font-weight: bolder;color: black;"><i class="fa fa-camera-retro"></i> Fotopagina</a>';
            echo '<a class="list-group-item  " href="/chat/" style="font-weight: bolder;color: black;"><i style="color: #3b5998;" class="fab fa-facebook-messenger"></i> Chat</a>';
            echo '<a class="list-group-item  " href="/contactForm/" style="font-weight: bolder;color: black;"><i class="fab fa-mailchimp"></i> Nieuwsbrief</a>';
            echo '<a class="list-group-item  " href="/contactForm/" style="font-weight: bolder;color: black;"><i class="fa fa-send"></i> Contactformulier</a>';
             echo '<a class="list-group-item  " href="/chat/" style="font-weight: bolder;color: black;"><i class="fa fa-globe"></i> Navigatie</a>'; 
              echo '<a class="list-group-item  " href="/chat/" style="font-weight: bolder;color: black;"><i class="fa fa-key"></i> Kernwoorden</a>'; 
           echo "</div>";
           
           echo "<div id='whrPanel'><a href='#' class='list-group-item disabled'  style='cursor:pointer;    font-weight: bolder;color:black;border:0;padding:0;'><i class='fa fa-folder'></i> Organisation - hr</a></div>";   
       echo "<div id='whrList'>";
               echo '<a class="list-group-item  " href="/members/" style="font-weight: bolder;color: black;"><i class="fa fa-users"></i> Leden</a>';
            echo '<a class="list-group-item  " href="/departments/" style="font-weight: bolder;color: black;"><i class="fas fa-building"></i> Departementen</a>';
             echo '<a class="list-group-item  " href="/functies/" style="font-weight: bolder;color: black;"><i class="fas fa-network-wired"></i> Functies</a>';
               echo '<a class="list-group-item  " href="/jobs/" style="font-weight: bolder;color: black;"><i class="fa fa-wrench"></i> Vacatures</a>';
           echo "</div>";
           
        
        echo "<div><a><i class='fa fa-folder'></i> Color - CMS</a></div>";
        
        
        echo "<div id='horecaPanel'><a href='#' class='list-group-item disabled'  style='cursor:pointer;    font-weight: bolder;color:black;border:0;padding:0;'><i class='fa fa-folder'></i> Horeca</a></div>";
         echo "<div id='horecaList'>";
            echo '<a class="list-group-item  " href="/reservaties/" style="font-weight: bolder;color: black;"><i class="fa fa-calendar"></i> Reservaties</a>';
            echo '<a class="list-group-item  " href="/prices/" style="font-weight: bolder;color: black;"><i class="fa fa-map"></i> Menu - prijzen</a>';
            echo '<a class="list-group-item  " href="/orders/" style="font-weight: bolder;color: black;"><i class="fas fa-pizza-slice"></i> Bestellingen</a>';
            
              echo '<a class="list-group-item  " href="/gangen/" style="font-weight: bolder;color: black;"><i class="fas fa-fish"></i> GangenMenu</a>';
            
           echo "</div>";
           
        echo "<div id='webshopPanel'><a href='#' class='list-group-item disabled'  style='cursor:pointer;    font-weight: bolder;color:black;border:0;padding:0;'><i class='fa fa-folder'></i> Webshop</a></div>";   
       echo "<div id='webshopList'>";
            echo '<a class="list-group-item  " href="/categ/" style="font-weight: bolder;color: black;"><i class="fa fa-tags"></i> Categoriëen</a>';
             echo '<a class="list-group-item  " href="/merk/" style="font-weight: bolder;color: black;"><i class="fa fa-shopping-bag"></i> Merken</a>'; 
            echo '<a class="list-group-item  " href="/producten/" style="font-weight: bolder;color: black;"><i class="fa fa-cubes"></i> Producten</a>';
             echo '<a class="list-group-item  " href="/vlog/" style="font-weight: bolder;color: black;"><i class="fa fa-shopping-cart"></i> Kassa</a>';
           echo "</div>";
           
           
           echo "<div id='futurePanel'><a href='#' class='list-group-item disabled'  style='cursor:pointer;    font-weight: bolder;color:black;border:0;padding:0;'><i class='fa fa-folder'></i> Comming soon</a></div>"; 
        echo "<div id='futureList'>";
            echo '<a class="list-group-item  " href="/krijtbord/" style="font-weight: bolder;color: black;"><i class="fa fa-font"></i> Fonts</a>';
             
           
             echo '<a class="list-group-item  " href="/about/" style="font-weight: bolder;color: black;"><i class="fab fa-medrt"></i> Support / Tasklist </a>';
            echo '<a class="list-group-item  " href="/about/" style="font-weight: bolder;color: black;"><i class="fas fa-business-time"></i> Realtime Dashboard </a>';
            echo '<a class="list-group-item  " href="/about/" style="font-weight: bolder;color: black;"><i class="fas fa-football-ball"></i> Scrum board </a>';
             echo '<a class="list-group-item  " href="/about/" style="font-weight: bolder;color: black;"><i class="fas fa-cloud-upload-alt"></i> File storage </a>';
             echo '<a class="list-group-item  " href="/about/" style="font-weight: bolder;color: black;"><i class="fas fa-glass-cheers"></i> TicketVerkoop - Events </a>';
              echo '<a class="list-group-item  " href="/about/" style="font-weight: bolder;color: black;"><i class="fa fa-magic"></i> Wizard</a>'; 
           echo "</div>";
           
            echo "<a href='/logIn/out.php' class='list-group-item'  style='cursor:pointer;    font-weight: bolder;color:black;border:0;padding:0;'><i class='fas fa-sign-out-alt' style='color:red;'></i> Afmelden</a>"; 
              echo "</div>";
}   
public function side_nav(){
   
    $this->print_side_nav_gold();
    if($this->getFlag(18)=='#FFF'){
       $this->print_side_nav_bussiness();
    }
    if($this->getFlag(33)=='#FFF'){
        $this->print_side_nav_horeca();
    }
    if($this->getFlag(42)=='#FFF'){
         $this->print_side_nav_webshop();
    }
   
    echo "<a href='/logIn/out.php' class='list-group-item'  style='cursor:pointer;    font-weight: bolder;color:black;border:0;padding:0;'><i class='fas fa-sign-out-alt' style='color:red;'></i> Afmelden</a>";
    echo "</div>";
     
}
public function verify(){
    if(!isset($_SESSION['user']))
    {
        header('Location: /logIn/index.php');
        exit();
    }
}
function getSeo(){
        $dwarf=new Opalus();
        $conn=$dwarf->makeConnection();
        $rij = array();

        $sql = "SELECT * FROM Gegevens";
        $item=array();
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                 array_push($item,$row);
            }

        } 
        $conn->close();
        return $item;
    } 
    
}

?>