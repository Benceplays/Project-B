<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activation</title>
    <link rel="stylesheet" href="forgotactivation.css">
    <script src="forgot.js"></script>
</head>
<body>
    <form class="formok" action="forgotactivation.php" method="post">
        <a href="../login/logincucc.php" class="backbutton">&#11013;Vissza a bejelentkezéshez</a>
        <div class="maindiv">
            <p class="activationcode">Aktivációs kódod</p>
		    <input class="activationinput" type="number" pattern="[0-9]*"  value="" inputtype="numeric" autocomplete="one-time-code" id="activationcheck" name="activationcheck" required>
            <button name="activation-button" id="activation-button" class="activation-button">Aktiválás</button>
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
    $code = "SELECT randstr FROM registration WHERE email='$email'";
    $result=mysqli_query($conn, $code);
    $adatok = mysqli_fetch_assoc($result);
    $lecode = $adatok['randstr'];
    $username = $_SESSION["username"];
    $input = $_POST['activationcheck'];
    if(isset($_POST['activation-button'])){
        if($lecode == $input){
            echo "<script>window.location = 'forgotpasswdlogic.php';</script>";
        }
    }
}
?>