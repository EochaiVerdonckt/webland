<?php 
session_start();
$path = getcwd();
$path = str_replace("prices", "", $path);
define ("FSPATH",$path);
include (FSPATH."Model/opalus.php");



if(!is_numeric($_GET['id']))
{
    echo "NOPE ITS SECURE";
    die();
}
function getConnection()
{
    $dwarf= new Opalus();
    $conn= $dwarf->makeConnection();
    return $conn;
}

function getItem()
{
    $conn=getConnection();
    $sql = "SELECT * FROM cat_balance where id=".$_GET['id'];
    $item=array();
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $item=$row;
        }

    }

    $conn->close();
    return $item;
}



function getItem2($one)
{
    $conn=getConnection();
    $sql = "SELECT * FROM cat_balance where sort=".$one;
    $item=array();
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $item=$row;
        }

    }

    $conn->close();
    return $item;
}


function setItem($oneUp)
{
    $conn=getConnection();
    $sql='UPDATE `cat_balance` SET `sort` = "'.$oneUp.'" WHERE id='.$_GET['id'];
    if ($conn->query($sql) === TRUE) {
        $last = $conn->insert_id;
    } 
    else
    {
         echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close(); 
}

function setItem2($item2)
{
    $conn=getConnection();
    $sql='UPDATE `cat_balance` SET `sort` = "'.$item2['sort'].'" WHERE id='.$item2['id'];
    if ($conn->query($sql) === TRUE) {
        $last = $conn->insert_id;
    } 
    else
    {
         echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close(); 
}

function checkHasItemForSort($one){
     $conn=getConnection();
    $sql = "SELECT count(id) as exsist FROM `cat_balance` WHERE sort=".$one;
    $item=array();
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $item=$row['exsist'];
        }

    }
    else
    {
        echo "getItem2: ".$one;
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    return $item;
    
}


$item=getItem();
$sort=$item['sort'];
$oneUp=$sort-1;


while(!checkHasItemForSort($oneUp))
    {
       $oneUp=$oneUp-1; 
    }

if(checkHasItemForSort($oneUp))
{


$item2=getItem2($oneUp);
$item2['sort']=$sort;
setItem($oneUp);
setItem2($item2);
}

header("Location: index.php");
die();
?>
