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

function setItemALL($item2)
{
    $conn=getConnection();
    $sql='UPDATE `price_balance` SET `sort` = "'.$item2['sort'].'" WHERE id='.$item2['id'];
    if ($conn->query($sql) === TRUE) {
        $last = $conn->insert_id;
    } 
    else
    {
         echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close(); 
}


function getItems()
{
    $conn=getConnection();
    $sql = "SELECT * FROM price_balance where 1 ORDER by sort;";
    $item=array();
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            array_push($item,$row);
        }

    }

    $conn->close();
    return $item;
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
    $sql = "SELECT * FROM price_balance where id=".$_GET['id'];
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
    $sql = "SELECT * FROM price_balance where sort=".$one;
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
    $sql='UPDATE `price_balance` SET `sort` = "'.$oneUp.'" WHERE id='.$_GET['id'];
    if ($conn->query($sql) === TRUE) {
        $last = $conn->insert_id;
        echo "setItem1 ok";
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
    $sql='UPDATE `price_balance` SET `sort` = "'.$item2['sort'].'" WHERE id='.$item2['id'];
    if ($conn->query($sql) === TRUE) {
        $last = $conn->insert_id;
    } 
    else
    {
         echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close(); 
}


function getLower($sort){
    $conn=getConnection();
    $sql='SELECT sort FROM `price_balance` WHERE sort>'.$sort.' ORDER BY sort LIMIT 1';
    echo $sql;
    die();
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $item=$row['sort'];
        }

    }
    $conn->close();
    return $item;
}



function checkHasItemForSort($one){
     $conn=getConnection();
    $sql = "SELECT count(id) as exsist FROM `price_balance` WHERE sort=".$one;
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

function setItemFinal($id,$sort)
{
    $conn=getConnection();
    $sql='UPDATE `price_balance` SET `sort` = "'.$sort.'" WHERE id='.$id;
    if ($conn->query($sql) === TRUE) {
        $last = $conn->insert_id;
    } 
    else
    {
         echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close(); 
}


//GET THIS ITEM.
$item= getItem();
$higher=$item['sort'];
//GET NEXT SORT
$lower=getLower($item['sort']);

//GET NEXT SORT ITEM.
$item2=getItem2($lower);
//SET SORT OF ITEM1
$item['sort']=$lower;
$item2['sort']=$higher;

//SET SORT OF ITEM2
//WRITE ITEM1
setItemFinal($item['id'],$item['sort']);
//WRITE ITEM2
setItemFinal($item2['id'],$item2['sort']);

header("Location: index.php");
die();
?>
