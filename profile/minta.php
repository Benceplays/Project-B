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
        $query_serversc = "SELECT * FROM servers WHERE playername='$username'";
        $result_serversc = mysqli_query($conn, $query_serversc);
        $adatok_serversc = mysqli_fetch_assoc($result_serversc);
        if($adatok_serversc['servername'] != "" and $adatok_serversc['playername'] == $username){
          echo "<div class='servermain'>";
        }
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
          <?php }} 
          if($adatok_serversc['servername'] != "" and $adatok_serversc['playername'] == $username){
            echo "</div>";
          }
          ?>
         <textarea class="profileleiras" style="resize: none;" rows="4" name="leiras" id="leiras" disabled placeholder="Leírás: " maxlength="500" style="max-width: 600px;"><?php         
        $profile_lekeres = "SELECT leiras FROM registration WHERE username='$username'";
        $profile_lekeres_result=mysqli_query($conn, $profile_lekeres);
        $profiles = mysqli_fetch_all($profile_lekeres_result, MYSQLI_ASSOC);
         foreach ($profiles as $leirasok) {
        echo $leirasok['leiras'];
        } 
        ?></textarea>
        <?php 
        $query_szerkeszt= "SELECT * FROM registration WHERE username='$_SESSION[usernamefirst]'";
        $result_szerkeszt = mysqli_query($conn, $query_szerkeszt);
        $adatok_szerkeszt = mysqli_fetch_assoc($result_szerkeszt);
        if($adatok_szerkeszt['login']==1 and $username == $_SESSION['usernamefirst']){
          echo '<form method="post"><input class="szerkesztes" type="submit" name="szerkesztes" value="Profilom szerkesztése" /></form>';
        }
        if($adatok_szerkeszt['login']==1 and $username == $_SESSION['usernamefirst'] and $adatok_szerkeszt['rang'] == "Admin"){
          echo '<form method="post"><input class="adminfelirat" type="submit" name="admingomb" value="Admin rendszer"/></form>';
        }
        if (isset($_POST['szerkesztes'])) {
          echo "<script>window.location = 'profile.php';</script>";
        }
        if (isset($_POST['admingomb'])) {
          echo "<script>window.location = '../admin/admin.php';</script>";
        }
        ?>
        <div class="commentiras">
          <form method="post">
            <textarea class="comment_text" type="text" name="comment" placeholder="Írj hozzászólást..." style="resize: none;" rows="8" cols="50" required maxlength="500"></textarea>
            <input class="comment_send" type="submit" name="hozzaszolas" value="Hozzászólás elküldése" />
          </form>
        </div>
        <?php
         if (isset($_POST['hozzaszolasok_delete'])) {
           $idfel = $_POST['idcucc'];
           $torlesconn = new mysqli('localhost','wildemhu_profile_comments','Kuglifej231','wildemhu_profile_comments');
           $sql_torles = "DELETE FROM $username WHERE id='$idfel'";
           mysqli_query($torlesconn, $sql_torles); 
         }
         if (isset($_POST['toprofile_img'])) {
          $idfel2 = $_POST['idcucc2'];
          $lekeres = new mysqli('localhost','wildemhu_profile_comments','Kuglifej231','wildemhu_profile_comments');
          $sql_lekeres = "SELECT username FROM $username WHERE id='$idfel2'";
          $result_profile_lekeres = mysqli_query($lekeres, $sql_lekeres);
          $adatok_lekerdezve= mysqli_fetch_assoc($result_profile_lekeres); 
          echo '<script>window.location = "',$adatok_lekerdezve['username'],'.php";</script>';
        }
        if (isset($_POST['toprofile_name'])) {
          $idfel2 = $_POST['idcucc2'];
          $lekeres = new mysqli('localhost','wildemhu_profile_comments','Kuglifej231','wildemhu_profile_comments');
          $sql_lekeres = "SELECT username FROM $username WHERE id='$idfel2'";
          $result_profile_lekeres = mysqli_query($lekeres, $sql_lekeres);
          $adatok_lekerdezve= mysqli_fetch_assoc($result_profile_lekeres); 
          echo '<script>window.location = "',$adatok_lekerdezve['username'],'.php";</script>';
        }
        
        
        if (isset($_POST['hozzaszolas'])) {
          $sql_szerverlekerdezes =  "SELECT * FROM registration WHERE username='$_SESSION[usernamefirst]' AND login='$_SESSION[loginvaltozo]'";
          $result_szerverlekerdezes=mysqli_query($conn, $sql_szerverlekerdezes);
          if(mysqli_num_rows($result_szerverlekerdezes)==1){
            $comment = $_POST['comment'];
            $date_comment = date('Y-m-d');
            $conn_comment  = new mysqli('localhost','wildemhu_profile_comments','Kuglifej231','wildemhu_profile_comments');
            $sql_comment = "INSERT INTO $username(username, comment, date) VALUES ('$_SESSION[usernamefirst]', '$comment', '$date_comment')";
            $result_comment = mysqli_query($conn_comment, $sql_comment);
          }
          else{ 
            echo '<script>alert("Nem vagy bejelentkezve!");</script>';
          }
        }
        for ($a = 1; $a <= 750; $a++){
          $image = new mysqli('localhost','wildemhu_csgo','Kuglifej231','wildemhu_csgo');
          $commentconn = new mysqli('localhost','wildemhu_profile_comments','Kuglifej231','wildemhu_profile_comments');
          $query_hozzaszolasok = "SELECT * FROM $username WHERE id = '$a'";
          $result_hozzaszolasok = mysqli_query($commentconn, $query_hozzaszolasok);
          $adatok_hozzaszolasok = mysqli_fetch_assoc($result_hozzaszolasok);
          $query_image = "SELECT profile_img FROM registration WHERE username='$adatok_hozzaszolasok[username]'";
          $result_image = mysqli_query($image, $query_image);
          $adatok_image= mysqli_fetch_assoc($result_image);
          if($adatok_hozzaszolasok['id'] == $a){
          ?>
          <div class="hozzaszolasok">
            <form method="POST">
            <input type="hidden" name="idcucc2" value="<?php echo $adatok_hozzaszolasok["id"];?>">  
            <button name="toprofile_img" style="border: none; background-color: rgb(38, 42, 53); margin-top: 2%;"><img class="hozzaszolasok_img" onclick="toprofile()" src="img/<?php echo $adatok_hozzaszolasok['username'];?>/<?php echo $adatok_image['profile_img'];?>"></button>
            <button name="toprofile_name" style="border: none; background-color: rgb(38, 42, 53); color: #ff8000; font-size: medium; font-weight:bold; position:absolute; margin-top:0.7%;"><p class="hozzaszolasok_name"><?php echo $adatok_hozzaszolasok['username'];?></p></button>
            </form>
            <p class="hozzaszolasok_date"><?php echo $adatok_hozzaszolasok['date'];?></p>   
            <textarea id="commentcucc" class="hozzaszolasok_text" rows="6" disabled style="resize: none;"><?php echo $adatok_hozzaszolasok['comment'];?></textarea> 
            <?php
            if($adatok_szerkeszt['login']==1 and $adatok_hozzaszolasok['username'] == $_SESSION['usernamefirst']){
              echo '
              <form method="post">
              <input type="hidden" name="idcucc" value="',$adatok_hozzaszolasok["id"],'">  
                <button class="torlesgomb" type="submit" name="hozzaszolasok_delete">Törlés</button>
              </form>';
            }?>
          </div>

          <?php }}?>  


    </div>
</body>
</html>