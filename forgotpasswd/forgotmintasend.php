<?php 
    $conn = new mysqli('localhost','wildemhu_csgo','Kuglifej231','wildemhu_csgo');

    if($conn->connect_error){
        echo "$conn->connect_error";
        die("Connection Failed : ". $conn->connect_error);
    } else {
        include "forgotpasswdsend.php";
        $namenow = $_POST['namenow'];
        $forgotpasswd = $_POST['forgotpasswd'];
        $forgotpasswd2 = $_POST['forgotpasswd2'];
        $encryptedpass = base64_encode($forgotpasswd);
        $encryptedpass2 = base64_encode($forgotpasswd2);
        $subject = "Jelszó megváltoztatás";
        $body = "Sikeresen megváltoztattad a jelszavad!";
        $headers = "From: wildemhu@wildem.hu";
        $valtle = "SELECT randstr, email FROM registration WHERE username='$namenow' ";
        $result_valt = mysqli_query($conn, $valtle);
        $data = mysqli_fetch_assoc($result_valt);
        $mailto = $data['email'];
        if ($encryptedpass == $encryptedpass2 && $encryptedpass != ""){
          if(isset($_POST['valtoztatasgomb'])){
            mail($mailto, $subject, $body, $headers);
            echo "<script>window.location = '../index.php';</script>";
            unlink("../forgotsites/".$data['randstr'].".php");
            $passwdfel = "UPDATE registration SET password='$encryptedpass' WHERE username='$namenow'";
            mysqli_query($conn, $passwdfel); 
          }
        }
      else{
        echo "<script>window.location = '$data[randstr].php';</script>";
      }
      }
?>