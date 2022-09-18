<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aktiválás</title>
    <script src="../main.js"></script>
    <link rel="stylesheet" href="forgotpasswdlogic.css">
</head>
<body>
      <form action="forgotpasswdlogic.php" method="post">
    <div class="activationdiv">
        <h1  >Elfelejtett jelszó</h1>
        <h3>Aktivációs kódod:</h3>
        <input class="activationcode" type="text" name="activationcode" id="activationcode" placeholder="Aktivációs kód" type="text" require><br><br>
        <input class="loginobject" type="password" name="forgotpasswd" id="forgotpasswd" placeholder="Új jelszó" require><br><br>
        <input class="loginobject" type="password" name="forgotpasswd2" id="forgotpasswd2" placeholder="Új jelszó még egyszer" require><br><br>
        <button name="activationbutton" class="activationbutton">Küldés</button>
    </div>
    </form>
    <?php 
        $conn = new mysqli('localhost','wildemhu_csgo','Kuglifej231','wildemhu_csgo');
        if($conn->connect_error){
          echo "$conn->connect_error";
          die("Connection Failed : ". $conn->connect_error);
        }
        else {
          $email = $_POST['emailaddress'];
          $activation = random_int(100000, 999999);
          $uname = "SELECT username FROM registration WHERE email='$email'";
          $result=mysqli_query($conn, $uname);
          $adatok = mysqli_fetch_assoc($result);
          $username = $adatok['username'];
          $subject = "Jelszó visszaállítás";
          $body = "Szia $username! Az imént kérelémezted a jelszavad visszaállítását. \nItt találod az aktivációs kódod: $activation";
          $headers = "From: support.wildemhu@wildem.hu";
          if(isset($_POST['kuldesgomb'])){
            mail($email, $subject, $body, $headers);
            echo "<script>window.location = '../forgotpasswd/forgotpasswdlogic.php';</script>";
            $valtchange = "UPDATE registration SET randstr='$activation' WHERE username='$username'";
            mysqli_query($conn, $valtchange);
          }
          $subjecttwo = "Sikeres jelszó változtatás";
          $bodytwo = "Sikeres jelszó változtatás.";
          $headerstwo = "From: support.wildemhu@wildem.hu";
          $forgotpasswd = $_POST['forgotpasswd'];
          $forgotpasswd2 = $_POST['forgotpasswd2'];
          $encryptedpass = base64_encode($forgotpasswd);
          $encryptedpass2 = base64_encode($forgotpasswd2);

          if(isset($_POST['activationbutton'])){
                mail($email, $subjecttwo, $bodytwo, $headerstwo);
                echo "<script>window.location = '../index.php';</script>";
                $passwdfel = "UPDATE registration SET password='$encryptedpass' WHERE email='$email'";
                mysqli_query($conn, $passwdfel);
          }
        }
    ?>
</body>
</html>