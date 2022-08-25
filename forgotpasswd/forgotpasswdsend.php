<?php 
    $conn = new mysqli('localhost','wildemhu_csgo','Kuglifej231','wildemhu_csgo');

    if($conn->connect_error){
        echo "$conn->connect_error";
        die("Connection Failed : ". $conn->connect_error);
    } else {
        $email = $_POST['emailaddress'];
        $uname = "SELECT username FROM registration WHERE email='$email'";
        $result=mysqli_query($conn, $uname);
        $adatok = mysqli_fetch_assoc($result);
        $username = $adatok['username'];
        $mailto = $email;
        $subject = "Jelszó visszaállítás";
        $body = "Szia $username! Az imént kérelémezted a jelszavad visszaállítását, ezt itt teheted meg.";
        $headers = "From: wildemhu@wildem.hu";
        if(isset($_POST['kuldesgomb'])){
          mail($mailto, $subject, $body, $headers);
          echo "<script>window.location = '../index.php';</script>";
        }
      }
?>