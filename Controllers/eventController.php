<?php session_start();


class eventController extends SuperController{ 
 
 
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


function getDates()
{
        $dwarf=new Opalus();
        $conn=$dwarf->makeConnection();
        $rij = array();

    $sql = "SELECT datum FROM events WHERE datum >= CURDATE()";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $rij = array();
        while($row = mysqli_fetch_assoc($result)) {
            array_push ( $rij ,$row);
        }

        return $rij;
    }
    mysqli_close($conn);
    $conn->close();
}





function print_jobs()
{

          $dwarf=new Opalus();
        $conn=$dwarf->makeConnection();
        $rij = array();

    $sql = "SELECT * FROM events where state=1 order by id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $state =  trim($row['state']);
            $id= trim($row['id']);
            
            $date=$row['datum'];
            $date=explode(" ",$date);
            $date=$date[0];
            
            echo '<div class="row" style="margin-bottom: 8px;">';
                echo '<div class="col-lg-6">';
                    echo '<img src="/events/'.$row['foto'].'" width="100%;" alt="">';
                echo '</div>';        
                echo '<div class="col-lg-6">';
                    echo ' <h2 style="width:100%; color: white; background: black;padding:12px;"><i class="fa fa-calendar"></i> '.$date.'</h2>';        
                    echo '<div class="caption" style="color: black;">'.$row['info'].'';
                    echo '</div>';
                    
                echo '</div>';
            echo '</div>';
            
        }
    } else {
        echo "0 results";
    }
    mysqli_close($conn);
}



}

?>