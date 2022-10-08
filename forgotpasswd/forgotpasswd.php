<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="forgotpasswd.css">
    <script src="../main.js"></script>
<title>Elfelejtett jelszó</title>
</head>
<body>
  <form class="formok" action="forgotpasswd.php" method="post">
      <a href="../login/logincucc.php" class="backbutton">&#11013;Vissza a bejelentkezéshez</a>
      <div class="loginpanel">
          <h1 class="loginh1">Elfelejtett jelszó</h1>
          <input class="loginobject" type="text" name="emailaddress" id="emailaddress" placeholder="Email cím" type="text" require><br><br>
          <p class="forgotpasswdtext">Az itt megadott email címedre fogunk küldeni egy jelszó visszaállító email-t.</p>
          <button name="kuldesgomb" class="logininbutton" >Küldés</button>
      </div>
  </form>
</body>
</html>
<?php
$conn = new mysqli('localhost','wildemhu_csgo','Kuglifej231','wildemhu_csgo');
if($conn->connect_error){
  echo "$conn->connect_error";
  die("Connection Failed : ". $conn->connect_error);
}
else {
        session_start();
        $email = $_POST['emailaddress'];
        $activation = random_int(100000, 999999);
        $uname = "SELECT username FROM registration WHERE email='$email'";
        $result=mysqli_query($conn, $uname);
        $adatok = mysqli_fetch_assoc($result);
        $username = $adatok['username'];
        $subject = "Jelszó visszaállítás";
        $body = "Szia $username! Az imént kérelémezted a jelszavad visszaállítását. \nItt találod az aktivációs kódod: $activation";
        $headers = "From: support.wildemhu@wildem.hu";
        $_SESSION["email"] = $email;
        $_SESSION["activation"] = $activation;
        $_SESSION["username"] = $username;

        if(isset($_POST['kuldesgomb'])){
            mail($email, $subject, $body, $headers);
            echo "<script>window.location = '../forgotpasswd/forgotactivation.php';</script>";
            $valtchange = "UPDATE registration SET randstr='$activation' WHERE username='$username'";
            mysqli_query($conn, $valtchange);
        }
    }
?>
