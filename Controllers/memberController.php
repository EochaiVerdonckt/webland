<?php session_start();


class MemberController extends SuperController{ 
 
 
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


function print_members()
{
    $dwarf=new Opalus();
    $conn=$dwarf->makeConnection();
    $sql = "SELECT * FROM members where state >0";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $state =  trim($row['state']);
            $id= trim($row['id']);
            echo '<div class="col-lg-12 col-md-12">
              <div class="text-center" style="padding-bottom: 80px;">
              <div style="margin-left:40%;background: url(\'/members/'.$row['foto'].'\'); border-radius: 50%;border-color: black;
    border: 2px solid black; width:200px;height: 200px;background-size:cover;"></div>
              <h1 style="color: #FF5228;">'.$row['info'].'</h1>
              <p>'.$row['omschrijving'].'</p>
              </div>
        </div>';
        }
    } else {
        echo "0 results";
    }
    mysqli_close($conn);
}





}

?>