<?php
class IndexController extends SuperController{ 
    
function getTitleSlide1(){
    $dwarf=new Opalus();
    $conn=$dwarf->makeConnection();
    $sql = "SELECT * FROM `slides_prop` where id=1";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $item=$row['value'];
        }

    } else {
        echo "0 results";
    }

    $conn->close();
    return $item;
}
function getTitleSlide2(){
    $dwarf=new Opalus();
    $conn=$dwarf->makeConnection();

    $sql = "SELECT * FROM `slides_prop` where id=2";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $item=$row['value'];
        }

    } else {
        echo "0 results";
    }

    $conn->close();
    return $item;
}
function getTitleSlide3(){
    $dwarf=new Opalus();
    $conn=$dwarf->makeConnection();

    $sql = "SELECT * FROM `slides_prop` where id=3";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $item=$row['value'];
        }

    } else {
        echo "0 results";
    }

    $conn->close();
    return $item;
}
function getFlagSlide1(){
    $dwarf=new Opalus();
    $conn=$dwarf->makeConnection();

    $sql = "SELECT * FROM `slides_prop` where id=4";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $item=$row['value'];
        }

    } else {
        echo "0 results";
    }

    $conn->close();
    return $item;
}
function getFlagSlide2(){
    $dwarf=new Opalus();
    $conn=$dwarf->makeConnection();

    $sql = "SELECT * FROM `slides_prop` where id=5";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $item=$row['value'];
        }

    } else {
        echo "0 results";
    }

    $conn->close();
    return $item;
}
function getFlagSlide3(){
    $dwarf=new Opalus();
    $conn=$dwarf->makeConnection();

    $sql = "SELECT * FROM `slides_prop` where id=6";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $item=$row['value'];
        }

    } else {
        echo "0 results";
    }

    $conn->close();
    return $item;
}
function getPromo(){
        $dwarf=new Opalus();
        $conn=$dwarf->makeConnection();
        $rij = array();

        $sql = "SELECT promo FROM promo_balance where id=1";
        $item='';
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $item = $row['promo'];
            }

        } 
        $conn->close();
        return $item;
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
    function getSeoById(){
        $dwarf=new Opalus();
        $conn=$dwarf->makeConnection();
        $rij = array();

        $sql = "SELECT * FROM Gegevens order by id";
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
function getKrijt(){
        $dwarf=new Opalus();
        $conn=$dwarf->makeConnection();
        $rij = array();

        $sql = "SELECT promo FROM promo_balance where id=2";
        $item='';
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
        
            while($row = mysqli_fetch_assoc($result)) {
                $item = $row['promo'];
            }
        } 
        $conn->close();
        return $item;
    }
function getKrijtVlag(){
        $dwarf=new Opalus();
        $conn=$dwarf->makeConnection();
        $rij = array();

        $sql = "SELECT promo FROM promo_balance where id=3";
        $item='';
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
        
            while($row = mysqli_fetch_assoc($result)) {
                $item = $row['promo'];
            }
        } 
        $conn->close();
        return $item;
    }
function print_basket(){
    if(empty($_SESSION['basket']))
    {
        return;
    }
    
    echo '
    <div style="width:10%; position: fixed; top:15%;z-index:9999; right:2%;">
    <div class="thumbnail" style="background: white; border: 1px solid black; padding: 5px;">
      <span class="badge" style="float:right; background: black;color: white;">'.$_SESSION['basket']["teller"].'</span>
      <i class="fa fa-shopping-basket fa-5x" style="color: "></i>
      <div class="caption">
        <p><a href="checkout.php" class="btn btn-primary" role="button">Checkout</a></p>
      </div>
    </div></div>';

    
}
function getServices(){
    $dwarf=new Opalus();
    $conn=$dwarf->makeConnection();
    $rij = array();

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
function getBrands(){
    $dwarf=new Opalus();
    $conn=$dwarf->makeConnection();
    $rij = array();

    $sql = "SELECT * FROM merk";
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
function getCatogs(){
    $dwarf=new Opalus();
    $conn=$dwarf->makeConnection();
    $rij = array();

    $sql = "SELECT * FROM catog";
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
function getSterk(){
    $dwarf=new Opalus();
    $conn=$dwarf->makeConnection();
    $rij = array();
    $sql = "SELECT * FROM sterk order by id";
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

    $dwarf=new Opalus();
    $conn=$dwarf->makeConnection();
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
function getHours(){
    $dwarf=new Opalus();
    $conn=$dwarf->makeConnection();
    $sql = "SELECT * FROM hours order by id";
    $item=array();
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            array_push($item,$row);
        }

    }
    else{
        echo "Uurrooster niet gevonden";
    }

    $conn->close();
    return $item;
}
function print_ShopCatogs(){

    $dwarf=new Opalus();
    $conn=$dwarf->makeConnection();
    $sql = "SELECT * FROM `catog`";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
     
        while($row = mysqli_fetch_assoc($result)) {
            echo '<div class="col-lg-4">';
            echo '<div class="thumbnail" ><div style="background: white;">';
            if($_SESSION['user']){
        echo        ' <a href="/categ/foto-edit.php?id='.$row['id'].'" class="wl-config"><span class="fa-stack fa-lg">
  <i class="fa fa-circle fa-stack-2x"></i>
  <i class="fa fa-magic fa-stack-1x fa-inverse"></i>
</span></a>';
}
echo '
            <div  class="snow-flake"  style="background: url(\'/categ/'.$row['foto'].'\');background-size: cover;"></div>
                   
                    <img src="" width="100%;" alt="">
                    <div class="caption" style="padding-top: 2%;margin-top: 2%;"> 
                    <p class="text-center"><a href="/shop/index.php?cat='.$row['id'].'" class="btn btn-default" role="button"><i class="fa fa-leaf"></i> '.$row['naam'].'</a></p>
                       
                      
                      ';
            echo '</div>
                 </div></div></div>';
        }
    }
     else
      { 
          echo  'SOMETHING WENT WRONG' ;die(); 
      }
    mysqli_close($conn);
}
function getAboutColor(){
    $dwarf=new Opalus();
    $conn=$dwarf->makeConnection();
   
     $sql = "SELECT value FROM `about_config` where id=2";
    $item='';
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $item = $row['value'];
        }

    } else {
        echo "0 results";
    }

    $conn->close();
    return $item;
}
function getTitleColor(){
    $dwarf=new Opalus();
    $conn=$dwarf->makeConnection();

     $sql = "SELECT value FROM `about_config` where id=3";
    $item='';
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $item = $row['value'];
        }

    } else {
        echo "0 results";
    }

    $conn->close();
    return $item;
}
function getBg(){
    $dwarf=new Opalus();
    $conn=$dwarf->makeConnection();



    $sql = "SELECT value FROM `about_config` where id=1";
    $item='';
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $item = $row['value'];
        }

    } else {
        echo "0 results";
    }

    $conn->close();
    return $item;
}
function getWpVal($wp,$slide){
       $dwarf=new Opalus();
    $conn=$dwarf->makeConnection();

    $sql = "SELECT *  FROM `slides_wp_config`  WHERE `slide`=".$slide." and `waypoint`=".$wp;

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $item=$row['value'];
        }

    } else {
        echo "0 results";
    }

    $conn->close();
    return $item;
}
function getWpFlag($wp,$slide){
       $dwarf=new Opalus();
    $conn=$dwarf->makeConnection();

    $sql = "SELECT flag FROM `slides_wp_config` WHERE `slide`=".$slide." and `waypoint`=".$wp;

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $item=$row['flag'];
        }

    } else {
        echo "0 results";
    }

    $conn->close();
    return $item;
}
function getWpColor(){
     $dwarf=new Opalus();
    $conn=$dwarf->makeConnection();
    $rij = array();

    
     $sql = "SELECT value FROM  `slides_color` where id=2";
    $item='';
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $item = $row['value'];
        }

    } else {
        echo "0 results";
    }

    $conn->close();
    return $item;
}
function getWpBorder(){
      $dwarf=new Opalus();
    $conn=$dwarf->makeConnection();
    $rij = array();

    
     $sql = "SELECT value FROM  `slides_color` where id=3";
    $item='';
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $item = $row['value'];
        }

    } else {
        echo "0 results";
    }

    $conn->close();
    return $item;
}
function getWpBg(){
        $dwarf=new Opalus();
    $conn=$dwarf->makeConnection();
    $rij = array();

   

    $sql = "SELECT value FROM  `slides_color` where id=1";
    $item='';
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $item = $row['value'];
        }

    } else {
        echo "0 results";
    }

    $conn->close();
    return $item;
}

function getCompanyData()
{

    $dwarf=new Opalus();
    $conn=$dwarf->makeConnection();
    $rij = array();
    $sql = "SELECT * FROM `Gegevens`";
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
}

?>