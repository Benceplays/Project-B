<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Előfizetések</title>
    <link rel="stylesheet" href="elofizetesek.css">
    <script href="../main.js"></script>
</head>
<body>
    <ul class="ul">
    <li class="li" ><a class="li-a" href="../index.php">Kezdőlap</a></li>
    <li class="li">
      <ul style="padding: 0;"><a class="li-a" href="elofizetesek.php" id="subscriber">Előfizetések</a></ul>
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
        <li id="ads-menu2" style="list-style-type: none;display:none; "><a class="li-a" href="../servers/servers.php">Keresés</a></li>   
        <li id="ads-menu1" style="list-style-type: none; display:none"><a class="li-a" href="../server/server.php">Készítés</a></li>                         
      </ul>
    </li>
    <?php 
    include 'login.php';
    $conn = new mysqli('localhost','wildemhu_csgo','Kuglifej231','wildemhu_csgo');

    if($conn->connect_error){
      echo "$conn->connect_error";
      die("Connection Failed : ". $conn->connect_error);
    } else {
      $loginsql = "SELECT * FROM registration WHERE username='$_SESSION[usernamefirst]' AND login='$_SESSION[loginvaltozo]'";
      $result_login=mysqli_query($conn, $loginsql);
      if(mysqli_num_rows($result_login)==0){
        echo '<li class="li" style="float: right;" ><a class="li-a" href="../login/logincucc.php">Bejelentkezés</a></li>';
      }
      if(mysqli_num_rows($result_login)==1){
        if(isset($_POST['kilepes'])) {
          $logincucosvaltozo = 0;
          $update_login = "UPDATE registration SET login='$logincucosvaltozo' WHERE username='$_SESSION[usernamefirst]' ";
          $resultlogin_update = mysqli_query($conn, $update_login);
          echo "<script>window.location = 'index.php';</script>";
        }
        echo '<li class="li" style="float: right;" onmouseover="loginpanel()" onmouseout="loginoutpanel()"><ul style="padding: 0;"><a class="li-a" href="#">', $_SESSION["usernamefirst"], '</a><li id="login-menu2" style="list-style-type: none;display:none; "><a class="li-a" href="profile/profile.php">Profilom</a></li>   
        <li id="login-menu1" style="list-style-type: none; display:none"><form method="post"><input class="button" type="submit" name="kilepes" class="kilepes" value="Kilépés" /></form></li></ul></li>';
        echo '<script>
        function loginpanel() {
          let menu = [document.getElementById("login-menu1"), document.getElementById("login-menu2")];
          menu.forEach(elem =>{elem.style.display="block"});
        }
        function loginoutpanel() {
          let menu = [document.getElementById("login-menu1"), document.getElementById("login-menu2")];
          menu.forEach(elem =>{elem.style.display="none"});
        }
        </script>';
      }
    }
    ?>
  </ul>
    <div class="elofizetesekmain">
        <div class="kezdo kozos">
            <img style="width: 25%;margin-left: 37.5%; margin-top: 5%;" src="img/upscale-245339439045212.png" alt="">
            <h2 style="color: #ff8000; text-align:center;">Kezdő</h2>
            <div class="simplevonal"></div>
            <p class="kozosszoveg">Közzé tehető szerver(ek): 2db</p>
            <div class="simplevonal"></div>
            <p class="kozosszoveg">Kiemelhető szerver(ek): 1db</p>
            <div class="simplevonal"></div>
            <p class="kozosszoveg">Napi szerver szerencsekerékre jelölhető szerverek száma: 1db</p>
            <div class="simplevonal"></div>
            <p class="kozosszoveg" style="font-size: 25px; font-weight: bold;">390Ft/Hónap</p>
            <button class="buybutton">Vásárlás</button>
        </div>
        <div class="halado kozos">
            <img style="width: 25%;margin-left: 37.5%; margin-top: 5%;" src="img/upscale-245339439045212.png" alt="">
            <h2 style="color: #ff8000; text-align:center;">Haladó</h2>
            <div class="simplevonal"></div>
            <p class="kozosszoveg">Közzé tehető szerver(ek): 4db</p>
            <div class="simplevonal"></div>
            <p class="kozosszoveg">Kiemelhető szerver(ek): 3db</p>
            <div class="simplevonal"></div>
            <p class="kozosszoveg">Napi szerver szerencsekerékre jelölhető szerverek száma: 2db</p>
            <div class="simplevonal"></div>
            <p class="kozosszoveg" style="font-size: 25px; font-weight: bold;">690Ft/Hónap</p>
            <button class="buybutton">Vásárlás</button>
        </div>
        <div class="profi kozos">
            <img style="width: 25%;margin-left: 37.5%; margin-top: 5%;" src="img/upscale-245339439045212.png" alt="">
            <h2 style="color: #ff8000; text-align:center;">Profi</h2>
            <div class="simplevonal"></div>
            <p class="kozosszoveg">Kőzzé tehető szerver(ek): 6db</p>
            <div class="simplevonal"></div>
            <p class="kozosszoveg">Kiemelhető szerver(ek): 6db</p>
            <div class="simplevonal"></div>
            <p class="kozosszoveg">Napi szerver szerencsekerékre jelölhető szerverek száma: 3db</p>
            <div class="simplevonal"></div>
            <p class="kozosszoveg" style="font-size: 25px; font-weight: bold;">1090Ft/Hónap</p>
            <button class="buybutton">Vásárlás</button>
        </div>
    </div>
</body>
</html>