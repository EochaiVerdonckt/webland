<?php session_start();


class BlogController extends SuperController{ 
 
 
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


function getDates()
{

    $dwarf=new Opalus();
    $conn=$dwarf->makeConnection();
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

function getBlogs(){
    $dwarf=new Opalus();
    $conn=$dwarf->makeConnection();
    $sql = "SELECT * FROM news where state=1";
    $result = mysqli_query($conn, $sql);
    $rij=array();
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
          array_push($rij,$row);
          }
    } else {
        
    }
    mysqli_close($conn);
    return $rij;
}


function print_blogs()
{

    $dwarf=new Opalus();
    $conn=$dwarf->makeConnection();
    $sql = "SELECT * FROM news where state=1";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $state =  trim($row['state']);
            $id= trim($row['id']);
            echo '<div class="col-lg-12">';
            echo '<div class="thumbnail">
                    <img src="/blog/'.$row['foto'].'" width="100%;" alt="">
                    <div class="caption" style="color: black!important;">              
                       '.$row['info'].'
                      ';

          


            echo '
                    </div>
                 </div></div>';
        }
    } else {
        echo "<h1>We hebben momenteel geen nieuws</h1>";
    }
    mysqli_close($conn);
}
}

?>