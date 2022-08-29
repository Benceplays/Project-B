<?php 
    $conn = new mysqli('localhost','wildemhu_csgo','Kuglifej231','wildemhu_csgo');

    if($conn->connect_error){
        echo "$conn->connect_error";
        die("Connection Failed : ". $conn->connect_error);
    } else {
        include "forgotpasswd.php";
        $subject = "Jelszó megváltoztatás";
        $body = "Sikeresen megváltoztattad a jelszavad!";
        $headers = "From: wildemhu@wildem.hu";
        $email = $_POST['emailaddress'];
        echo '<script>alert($email);</script>';
        $valtle = "SELECT randstr FROM registration WHERE email='$email' ";
        $result_valt = mysqli_query($conn, $valtle);
        $data = mysqli_fetch_assoc($result_valt);
        if(isset($_POST['valtoztatasgomb'])){
          mail($email, $subject, $body, $headers);
          echo "<script>window.location = '../index.php';</script>";
          unlink("../forgotsites/".$data['randstr'].".php");
        }
      }
?>