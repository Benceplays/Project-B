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
<ul class="ul">
    <li class="li" ><a class="li-a" href="../index.php">Kezdőlap</a></li>
    <li class="li">
      <ul style="padding: 0;"><a class="li-a" href="../elofizetesek/elofizetesek.php" id="subscriber">Előfizetések</a></ul>
    </li>
    
    <li class="li" onmouseover="beadol()" onmouseout="kiadol()">
    <script>
    function beadol() {
      let menu = [document.getElementById("ads-menu1"), document.getElementById("ads-menu2")];
      menu.forEach(elem =>{elem.style.display = "block"});
    }
    function kiadol() {
      let kiadolmenu = [document.getElementById("ads-menu1"), document.getElementById("ads-menu2")];
      kiadolmenu.forEach(elem =>{elem.style.display = "none"});
    }
    </script>
      <ul style="padding: 0;"><a class="li-a" href="#" >Hirdetések</a>
        <li id="ads-menu2"  style="list-style-type: none;display:none; "><a class="li-a">Keresés</a></li>   
        <li id="ads-menu1" style="list-style-type: none; display:none"><a class="li-a" href="../server/server.php">Készítés</a></li>                         
      </ul>
    </li>
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
        <textarea class="profileleiras" style="resize: none;" rows="4" name="leiras" id="leiras" placeholder="Leírás: " maxlength="500" style="max-width: 600px;"><?php         
        $profile_lekeres = "SELECT leiras FROM registration WHERE username='$_SESSION[usernamefirst]'";
        $profile_lekeres_result=mysqli_query($conn, $profile_lekeres);
        $profiles = mysqli_fetch_all($profile_lekeres_result, MYSQLI_ASSOC);
         foreach ($profiles as $leirasok) {
        echo $leirasok['leiras'];
        } 
        ?></textarea><input id="send" onclick="disablecucc()" type="submit"></form>
        <button id="szerkeszt" onclick="disableornot()">Szerkeszt</button>
        <script>
        document.getElementById("send").style.display = "none";  
        document.getElementById("leiras").disabled = true;
        function disableornot() {
                document.getElementById("szerkeszt").style.display = "none";  
                document.getElementById("leiras").disabled = false;      
                document.getElementById("send").style.display = "block";  
        }
        function disablcucc() {
            document.getElementById("szerkeszt").style.display = "block";  
        }
        </script>
    </div>
</body>
</html>