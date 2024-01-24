<?php session_start();

$to = "benmezian@gmail.com";
//$to = "opkoper2000@gmail.com";
$todayis = date("l, F j, Y, g:i a") ;

$subject= "Bericht van uw webland website.";
$name = $_POST['name'];
$email = $_POST['email'];
$cmname = $_POST['subject'];
$add = $_POST['company'];
$city = $_POST['staat'];
$state = $_POST['merk'];
$zip = $_POST['model'];
$phone = $_POST['phone'];
$fax = $_POST['fax'];
$comments = $_POST['comment'];
$message = "

Name ------ $name
Email ----------- $email
Tel --------- $add
Staat ------------ $city
Merk ----------- $state
Model ------------- $zip
Message --------- $comments
";
  $mime_boundary="==Multipart_Boundary_x".md5(mt_rand())."x";
         $headers = "From: $email\r\n" .
         "MIME-Version: 1.0\r\n" .
            "Content-Type: multipart/mixed;\r\n" .
            " boundary=\"{$mime_boundary}\"";
         $message = "This is a multi-part message in MIME format.\n\n" .
            "--{$mime_boundary}\n" .
            "Content-Type: text/plain; charset=\"iso-8859-1\"\n" .
            "Content-Transfer-Encoding: 7bit\n\n" .
         $message . "\n\n";
         foreach($_FILES as $userfile)
         {
            $tmp_name = $userfile['tmp_name'];
            $type = $userfile['type'];
            $name = $userfile['name'];
            $size = $userfile['size'];
            if (file_exists($tmp_name))
            {
               if(is_uploaded_file($tmp_name))
               {
                  $file = fopen($tmp_name,'rb');
                  $data = fread($file,filesize($tmp_name));
                  fclose($file);
                  $data = chunk_split(base64_encode($data));
               }
               $message .= "--{$mime_boundary}\n" .
                  "Content-Type: {$type};\n" .
                  " name=\"{$name}\"\n" .
                  "Content-Disposition: attachment;\n" .
                  " filename=\"{$fileatt_name}\"\n" .
                  "Content-Transfer-Encoding: base64\n\n" .
               $data . "\n\n";
            }
         }
         $message.="--{$mime_boundary}--\n";
if (mail($to, $subject, $message, $headers))
{
      $_SESSION['mail']= "UW BERICHT IS VERSTUURD";
  header("Location: /aankoop.php#contact-form");
die();
}

else
   echo "Error in mail";
?>