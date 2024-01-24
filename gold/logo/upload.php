<?php
$target_dir = "";
$path = getcwd();
$path = str_replace("gold/logo", "", $path);

define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/adminController.php"); 


$ctrl=new AdminController();

$extensie = explode(".", $_FILES["fileToUpload"]["name"]);
$extensie = $extensie[1];
$_FILES["fileToUpload"]["name"]= "logo".".".$extensie;
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);




// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    unlink($target_file);
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 50000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {


    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $conn = $ctrl->getConnection();
        $logo=$_FILES["fileToUpload"]["name"];
        $sql = "UPDATE `Gegevens` SET waarde='".$logo."' WHERE id=18";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['input']= "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            die();
        }

        $conn->close();

        header("Location: /gold/logo/index.php");
        die();
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>