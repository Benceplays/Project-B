<!DOCTYPE html>
<html lang="hu">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Elfelejtett jelszó</title>
</head>
<body>
  <form action="forgotmintasend.php" method="post">
    <div>
      <?php 
        session_start();
        $conn = new mysqli('localhost','wildemhu_csgo','Kuglifej231','wildemhu_csgo');
        if($conn->connect_error){
          echo "$conn->connect_error";
          die("Connection Failed : ". $conn->connect_error);
        }
        else {
          include "forgotpasswd.php";
          include '../login.php'; 
          $email = $_POST['emailaddress'];
          $uname = "SELECT username FROM registration WHERE email='$email'";
          $result=mysqli_query($conn, $uname);
          $adatok = mysqli_fetch_assoc($result);
          $username = $adatok['username'];
          $subject = "Jelszó visszaállítás";
          $body = "Szia $username! Az imént kérelémezted a jelszavad visszaállítását, ezt itt teheted meg. \n http://wildem.hu/forgotsites/".$randvalt.".php";
          $headers = "From: wildemhu@wildem.hu";
          if(isset($_POST['kuldesgomb'])){
            mail($email, $subject, $body, $headers);
            echo "<script>window.location = '../index.php';</script>";
            $filePath = 'forgotminta.php';
				    $destinationFilePath = '../forgotsites/'.$randvalt.'.php';
				    copy($filePath, $destinationFilePath);
            $valtchange = "UPDATE registration SET randstr='$randvalt' WHERE username='$username'";
            mysqli_query($conn, $valtchange); 
          }
        }
      ?>
    </div>
    </form>
</body>
</html>