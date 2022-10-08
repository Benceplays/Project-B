<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elfelejtett jelszó</title>
    <link rel="stylesheet" href="forgotpasswdlogic.css">
</head>
<body>
<form class="formok" action="forgotpasswdlogic.php" method="post">
    <a href="../login/logincucc.php" class="backbutton">&#11013;Vissza a bejelentkezéshez</a>
    <div class="activationdiv">
        <h1  >Elfelejtett jelszó</h1>
        <input type="password" name="forgotpasswd" id="forgotpasswd" placeholder="Új jelszó" require><br><br>
        <input type="password" name="forgotpasswd2" id="forgotpasswd2" placeholder="Új jelszó még egyszer" require><br><br>
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
            $subjecttwo = "Sikeres jelszó változtatás";
            $bodytwo = "Sikeres jelszó változtatás.";
            $headerstwo = "From: support.wildemhu@wildem.hu";
            $forgotpasswd = $_POST['forgotpasswd'];
            $forgotpasswd2 = $_POST['forgotpasswd2'];
            $encryptedpass = base64_encode($forgotpasswd);
            $encryptedpass2 = base64_encode($forgotpasswd2);
  
            if(isset($_POST['activationbutton'])){
                if($encryptedpass == $encryptedpass2){
                    mail($email, $subjecttwo, $bodytwo, $headerstwo);
                    echo "<script>window.location = '../login/logincucc.php';</script>";
                    $passwdfel = "UPDATE registration SET password='$encryptedpass' WHERE email='$email'";
                    mysqli_query($conn, $passwdfel);
                    $activationnew = random_int(100000, 999999);
                    $valtchange = "UPDATE registration SET randstr='$activationnew' WHERE username='$username'";
                    mysqli_query($conn, $valtchange);
                }
            }
        }

?>