<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="profile.css">
    <script src="../main.js"></script>
</head>
<body>
    <div class="profilemain">
        <p class="pfname">
        <?php 
        include '../login.php'; 
        echo $_SESSION["usernamefirst"],'</p><p class="pfstar">4.5★</p>';
        $conn = new mysqli('localhost','wildemhu_csgo','Kuglifej231','wildemhu_csgo');

    if($conn->connect_error){
      echo "$conn->connect_error";
      die("Connection Failed : ". $conn->connect_error);
    } else {

        $profile_sql = "SELECT date FROM registration WHERE username='$_SESSION[usernamefirst]'";
        $result_profile=mysqli_query($conn, $profile_sql);
        $registration = mysqli_fetch_all($result_profile, MYSQLI_ASSOC);
      foreach ($registration as $date) {
        echo '<p style="font-size: large;">Fiók létrehozásának dátuma: ',$date['date'],'</p>';
     }
     if(isset($_POST['leiras'])){
        $leirascucc = $_POST['leiras'];
        $update_leiras = "UPDATE registration SET leiras='$leirascucc' WHERE username='$_SESSION[usernamefirst]'";
        $result_leiras = mysqli_query($conn, $update_leiras);
     }
    }
        
        ?>
        <img class="pfp" src="../img/upscale-245339439045212.png" alt="">
        <div class="servermain">
        <div onclick="szerverkatt()" class="firstserver">
            <p class="servernameinserver">Szerver neve</p>
            <p class="serverstarinserver">3.5★</p>
        </div>
        </div>
        <form action="profile.php" method="POST">
        <textarea class="profileleiras" style="resize: none;" rows="4" cols="50" name="leiras" id="leiras" <?php if(isset($_POST['szerkeszt'])) {
            $szerkeszt_valtozo = 1;
            echo "<script>alert('asd');</script>";
        } ?> 
        <?php if(isset($_POST['szerkeszt'])) {
            $szerkeszt_valtozo = 0;
            echo "<script>alert('nem');</script>";
        } ?>placeholder="Leírás: " maxlength="500" style="max-width: 600px;"><?php         
        $profile_lekeres = "SELECT leiras FROM registration WHERE username='$_SESSION[usernamefirst]'";
        $profile_lekeres_result=mysqli_query($conn, $profile_lekeres);
        $profiles = mysqli_fetch_all($profile_lekeres_result, MYSQLI_ASSOC);
         foreach ($profiles as $leirasok) {
        echo $leirasok['leiras'];
        } ?></textarea><input type="submit"  name="szerkeszt" value="szerkeszt" ><input type="submit"></form>
    </div>
</body>
</html>