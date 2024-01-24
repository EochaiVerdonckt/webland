<?php session_start();

class SlidesController extends SuperController{ 
    
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

function getSlide($number){
   return $this->selectStatement('slides',"id=".$number);
}

function getWpFlag($wp,$slide){
    $slide= $this->getSlide($ctrl,$slide);
    $flag="wp-".$wp."-flag";
    return $slide[$flag];
    
}


}?>