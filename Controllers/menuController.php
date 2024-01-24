<?php session_start();


class MenuController extends SuperController{ 
 
 
 function getSeo()
    {
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
 
function print_basket()
{
    if(empty($_SESSION['basket']))
    {
        return;
    }
    
    echo '
    <div style="width:10%; position: fixed; top:8%;z-index:99; right:2%;background: white; border: 2px solid black;">
    <div class="card" style="position: relative;">
      <span class="badge" style="background: black;
    color: white;
    border-radius: 50%;
    width: 18px;
    position: absolute;
    right: 8px;
    top: 8px;">'.$_SESSION['basket']["teller"].'</span>
      <i class="fa fa-shopping-basket fa-5x" style="color: "></i>
      <div class="caption" style="margin: 4px;">
        <p><a href="checkout.php" class="btn btn-primary" role="button">Checkout</a></p>
      </div>
    </div></div>';

    
}

function toonLijstEten()
{
     echo '<div class="pagebreak"> </div>';
    echo '<div class="col-lg-12 text-center"><h1 style="text-decoration: underline;font-weight: bolder;color: white;">MENU</h1></div>';
    echo '<div class="col-lg-12 text-center">
    <h6 style="font-style: italic; font-size: 1.8em;text-align:center;color: white;" id="top">Al onze gerechten worden vers bereid.</h6></div>';
    
    
    
  
    echo '<div class="col-sm-12">';
    
    $dwarf=new Opalus();
    $conn=$dwarf->makeConnection();
    $rij = array();

  

    $sql = "SELECT * FROM cat_balance  WHERE `DrankofEten`=1 AND id!=112 ORDER by sort";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            array_push($rij,$row);
        }

    } else {
        echo "0 results";
    }

    $conn->close();

    foreach ($rij as &$value) {
        
        echo '<h3 class="text-center cat-title" style="font-size: 2em;text-decoration: underline;font-weight: bolder;" id="'.$value['naam'].'">'.$value['naam'].'</h3>';
        echo '<p class="text-center" style="color: white;">'.$value['comment'].'</p>';
        
        $conn=$dwarf->makeConnection();
        
        $sql = "SELECT * FROM price_balance where cat=".$value['id']." ORDER BY bedrag";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo '<table style="width: 100%; padding: 2%;font-size:1.5em;background: rgba(255,255,255,0.8); margin-top:25px;margin-bottom: 25px;">';
            $teller=0;
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                $teller=$teller+1;
                 if(strlen ($row['comment'])>1)
                {
                    if($teller%2==0)
                    {
                        echo '<tr class="odd" style="color: black">';    
                    }
                    else
                    {
                        echo '<tr class="even" style="color: black">';    
                    }
                }
                else
                {
                    if($teller%2==0)
                    {
                        echo '<tr class="odd" style="color: black">';    
                    }
                    else
                    {
                        echo '<tr class="even" style="color: black">';    
                    }
                }

                echo '<td style="text-align: left;padding: 8px;">'.$row['naam'].'</td>';
                echo '<td style="text-align: right;margin-right: 10px;padding: 8px;"><span style="margin-right: 12px;">&#8364;</span>'.$row['bedrag'].'</td>';
                
                if($value['id']==111 || $value['id']==110 || $value['id']==109 || $value['id']==107 || $value['id']==108 || $value['id']==113 || $value['id']==114 || $value['id']==115)
                {

                }
                else
                {
                   //  echo '<td style="text-align: right;padding: 8px;"><a class="" href="add.php?item='.$row["id"].'" style="color: black;"><i style="" class="fa fa-plus"></i></a></td>';
                }
                echo '</tr>';
                
                if(strlen ($row['comment'])>1)
                {
                    if($teller%2==0)
                    {
                        echo '<tr  class="odd">';  
                    }
                    else
                    {
                    echo '<tr  class="even">';
                    }
                
                    echo '<td style="padding-left: 2%;">'.$row['comment'].'</td><td></td><td></td>';
                    echo '</tr>';
                }
                
                


            }
            echo '</table>';
            

              
        } 
        $conn->close();
    }


    echo '</div>';
}


function showOptions()
{
    echo '<div class="row">
    <div class="col-lg-8 col-lg-offset-4">
       
    </div></div>';

    echo '<div class="row">';

    $this->toonLijstEten();
    echo "</div>";
    //END ROW 2

    echo '<div class="row">';
    echo '</div>';// END ROW 3
}

function getVerlofState()
 {
    $dwarf=new Opalus(); 
    $conn=$dwarf->makeConnection();
    $rij = array();

    $sql = "SELECT * FROM `order_params` where id=1";
    $item=array();
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $item = $row['vlag'];
        }

    } else {
        echo "item niet gevonden.";
        die();
    }
    $conn->close();
    return $item;
 }

function getWachttijd()
 {    
    $dwarf=new Opalus(); 
    $conn=$dwarf->makeConnection();
    $rij = array();

    $sql = "SELECT * FROM `order_params` where id=2";
    $item=array();
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $item = $row['vlag'];
        }

    } else {
        echo "item niet gevonden.";
        die();
    }
    $conn->close();
    return $item;
 }
 
 function getCats()
{
    $dwarf=new Opalus(); 
    $conn=$dwarf->makeConnection();
    $rij = array();
    $sql = "SELECT * FROM cat_balance  WHERE `DrankofEten`=1 AND id!=112 ORDER by sort";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            array_push($rij,$row);
        }

    } else {
        echo "0 results";
    }

    $conn->close();
    return $rij;
}

}

?>