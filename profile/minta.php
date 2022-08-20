<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="minta.css">
    <script src="../main.js"></script>
</head>
<body <?php
        $pathcucc = basename($_SERVER['SCRIPT_FILENAME']);
        $username = pathinfo($pathcucc, PATHINFO_FILENAME);
        include '../login.php'; 
        $conn = new mysqli('localhost','wildemhu_csgo','Kuglifej231','wildemhu_csgo');
        
        $query_background = "SELECT background_img FROM registration WHERE username='$username' ";
        $result_background = mysqli_query($conn, $query_background);
        $data_background = mysqli_fetch_assoc($result_background);
        ?>
        style="background-image: url('<?php echo "img/$data_background[background_img]";?>') !important;">
<ul class="ul">
    <li class="li" ><a class="li-a" href="../index.php">Kezdőlap</a></li>
    <li class="li">
      <ul style="padding: 0;"><a class="li-a" href="../elofizetes/elofizetesek.php" id="subscriber">Előfizetések</a></ul>
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
          echo "<script>window.location = '../index.php';</script>";
        }
        echo '<li class="li" style="float: right;" onmouseover="loginpanel()" onmouseout="loginoutpanel()"><ul style="padding: 0;"><a class="li-a" href="#">', $_SESSION["usernamefirst"], '</a><li id="login-menu2" style="list-style-type: none;display:none; "><a class="li-a" href="'.$_SESSION["usernamefirst"],'.php">Profilom</a></li>   
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
    <div class="profilemain">
        <p class="pfname">
        <?php 
        echo $username,'</p>';
        $query_rang = "SELECT rang FROM registration WHERE username='$username' ";
        $result_rang = mysqli_query($conn, $query_rang);
        $data_rang= mysqli_fetch_assoc($result_rang);
        ?>
        <p class="pfrang" <?php 
        if($data_rang['rang'] == "Tag"){
            echo "style='color: #808080 !important;'";
        }
        if($data_rang['rang'] == "Admin"){
          echo "style='color: #00ff1a !important;'";
        }
        if($data_rang['rang'] == "Elofizeto"){
          echo "style='color: #a600ff !important;'";
        }
        ?>>
          <?php 
          echo $data_rang['rang'];
          ?>
        </p>
    <?php

    if($conn->connect_error){
      echo "$conn->connect_error";
      die("Connection Failed : ". $conn->connect_error);
    } else {
        $profile_sql = "SELECT date FROM registration WHERE username='$username'";
        $result_profile=mysqli_query($conn, $profile_sql);
        $registration = mysqli_fetch_all($result_profile, MYSQLI_ASSOC);
      foreach ($registration as $date) {
        echo '<p class="datum" style="font-size: large;">Fiók létrehozásának dátuma: ',$date['date'],'</p>';
     }
    }
        ?>
        <?php
        $query_img = "SELECT profile_img FROM registration WHERE username='$username' ";
        $result_img = mysqli_query($conn, $query_img);
   
        while ($data = mysqli_fetch_assoc($result_img)) {
        ?>
            <img class="pfp" src="<?php
              if(file_exists("./img/$username")){
                echo "./img/$username/$data[profile_img]";
              }
              else{
                echo "./img/default.png";
            }
             ?>">
         
        <?php
        }
        ?>
        <!-- <div class="servermain">
        <div onclick="szerverkatt()" class="firstserver">
            <p class="servernameinserver">Szerver neve</p>
            <p class="serverstarinserver">3.5★</p>
        </div>
        </div>-->
         <div class="servermain">
        <?php
        for ($i = 1; $i <= 25; $i++){
          $query_servers = "SELECT * FROM servers WHERE id='$i'";
          $result_servers = mysqli_query($conn, $query_servers);
          $adatok_servers = mysqli_fetch_assoc($result_servers);
          if($adatok_servers['id'] == $i and $adatok_servers['playername'] == $username){
          ?>
          <script>
          function szerveratdobas<?php echo $i;?>(){
            window.location = '../szerverek/<?php echo $adatok_servers['servername']; ?>.php';
          }
         </script>
          <div onclick="szerveratdobas<?php echo$i;?>()" class="firstserver">
              <p class="servernameinserver" ><?php echo $adatok_servers['servername']; ?></p>
              <p class="serverstarinserver">Ertekeles</p>
          </div>
          <?php }} ?>
         </div>
         <textarea class="profileleiras" style="resize: none;" rows="4" name="leiras" id="leiras" disabled placeholder="Leírás: " maxlength="500" style="max-width: 600px;"><?php         
        $profile_lekeres = "SELECT leiras FROM registration WHERE username='$username'";
        $profile_lekeres_result=mysqli_query($conn, $profile_lekeres);
        $profiles = mysqli_fetch_all($profile_lekeres_result, MYSQLI_ASSOC);
         foreach ($profiles as $leirasok) {
        echo $leirasok['leiras'];
        } 
        ?></textarea>
        <?php 
        $query_szerkeszt= "SELECT login FROM registration WHERE username='$_SESSION[usernamefirst]'";
        $result_szerkeszt = mysqli_query($conn, $query_szerkeszt);
        $adatok_szerkeszt = mysqli_fetch_assoc($result_szerkeszt);
        if($adatok_szerkeszt['login']==1 and $username == $_SESSION['usernamefirst']){
          echo '<form method="post"><input class="szerkesztes" type="submit" name="szerkesztes" value="Profilom szerkesztése" /></form>';
        }
        if (isset($_POST['szerkesztes'])) {
          echo "<script>window.location = 'profile.php';</script>";
        }
        ?>

        

    </div>
</body>
</html>