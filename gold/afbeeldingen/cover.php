<?php session_start();

$path = getcwd();
$path = str_replace("gold/afbeeldingen", "", $path);

define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/adminController.php"); 


$ctrl=new AdminController();
function getIamge(){
    
    if(!is_numeric($_GET['product']))
    {
        echo 'this is not allowed';
        die();
    }
    $ctrl=new AdminController();
     $conn = $ctrl->getConnection();
    $sql = "SELECT * FROM artikel_balance where id=".$_GET['product'];
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $image =  $row;
        }
    } else {
        echo "0 results";
    }
    mysqli_close($conn);
    return $image;
}

$img=getIamge();
    $conn = $ctrl->getConnection();
    $sql = "UPDATE `albums` SET `cover`='".$img['id']."' WHERE id=".$img['album'];


    if ($conn->query($sql) === TRUE) {
        $_SESSION['input']= "New record created successfully";
        $last = $conn->insert_id;


    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    header("Location: /picV2/");
    die();
?>
