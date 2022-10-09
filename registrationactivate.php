<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regisztráció érvényesítése</title>
    <link rel="stylesheet" href="registration.css">
</head>
<body>
<form class="formok" action="registration.php" method="post">
        <a href="../login/logincucc.php" class="backbutton">&#11013;Vissza a bejelentkezéshez</a>
        <div class="maindiv">
            <p class="registrationcode">Regisztrációs kódod:</p>
		    <input class="registrationinput" type="number" pattern="[0-9]*"  value="" inputtype="numeric" autocomplete="one-time-code" id="registrationcheck" name="registrationcheck" required>
            <button type="submit" name="registration-button" id="registration-button" class="registration-button">Regisztráció befejezése</button>
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
    $regactivation = random_int(100000, 999999);
    $email = $_SESSION['emailbe'];
    $subject = "Regisztráció hitelesítése";
    $body = "Szia! Az imént az email-ed felhasználásával létrehoztál egy fiókot. \nItt találod az aktivációs kódod: $regactivation";
    $headers = "From: support.wildemhu@wildem.hu";
    mail($email, $subject, $body, $headers);
    $_SESSION['emailbe'] = $_POST['email'];
    $_SESSION['usernamebe'] = $_POST['username'];
    $_SESSION['passwordbe'] = $_POST['password'];
    $_SESSION['password2be'] = $_POST['password2'];
    $_SESSION['regactivation'] = $regactivation;
    }
?>