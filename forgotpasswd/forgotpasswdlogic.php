<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elfelejtett jelszó</title>
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
            $email = $_SESSION["email"];
            $activation = $_SESSION["activation"];
            $username = $_SESSION["username"];
            $beactivation = $_POST['activationcode'];
            $subjecttwo = "Sikeres jelszó változtatás";
            $bodytwo = "Sikeres jelszó változtatás.";
            $headerstwo = "From: support.wildemhu@wildem.hu";
            $forgotpasswd = $_POST['forgotpasswd'];
            $forgotpasswd2 = $_POST['forgotpasswd2'];
            $encryptedpass = base64_encode($forgotpasswd);
            $encryptedpass2 = base64_encode($forgotpasswd2);
  
            if(isset($_POST['activationbutton'])){
                if($encryptedpass == $encryptedpass2 && $activation == $beactivation){
                    mail($email, $subjecttwo, $bodytwo, $headerstwo);
                    echo "<script>window.location = '../index.php';</script>";
                    $passwdfel = "UPDATE registration SET password='$encryptedpass' WHERE email='$email'";
                    mysqli_query($conn, $passwdfel);
                }
            }
        }



?>