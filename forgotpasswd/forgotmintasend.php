<?php 
    $conn = new mysqli('localhost','wildemhu_csgo','Kuglifej231','wildemhu_csgo');

    if($conn->connect_error){
        echo "$conn->connect_error";
        die("Connection Failed : ". $conn->connect_error);
    } else {
        include "forgotpasswdsend.php";
        $randvaltozo = $randvalt;
        $mailto = $email;
        $subject = "Jelszó megváltoztatás";
        $body = "Sikeresen megváltoztattad a jelszavad!";
        $headers = "From: wildemhu@wildem.hu";
        $file_pointer = fopen("../forgotsites/".$randvaltozo.".php", 'w+');
        if(isset($_POST['valtoztatasgomb'])){
          mail($mailto, $subject, $body, $headers);
          echo "<script>window.location = '../index.php';</script>";
        }
        fclose($file_pointer);
      }
?>