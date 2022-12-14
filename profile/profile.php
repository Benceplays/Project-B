<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="profile.css">
    <script src="../main.js"></script>
</head>
<body <?php
        include '../login.php';
        $conn = new mysqli('localhost','wildemhu_csgo','Kuglifej231','wildemhu_csgo');
        
        $query_background = "SELECT background_img FROM registration WHERE username='$_SESSION[usernamefirst]' ";
        $result_background = mysqli_query($conn, $query_background);
        $data_background = mysqli_fetch_assoc($result_background);
        ?>
        style="background-image: url('<?php echo "img/$data_background[background_img]";?>') !important;">
<ul class="ul">
    <li class="li" ><a class="li-a" href="../index.php">Kezdőlap</a></li>
    <li class="li">
      <ul style="padding: 0;"><a class="li-a" href="../elofizetes/elofizetesek.php" id="subscriber">Előfizetések</a></ul>
    </li>
    <li class="li">
      <ul style="padding: 0;"><a class="li-a" href="../report/report.php" id="subscriber">Hiba bejelentés</a></ul>
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
        include '../login.php'; 
        echo $_SESSION["usernamefirst"],'</p>';
        $conn = new mysqli('localhost','wildemhu_csgo','Kuglifej231','wildemhu_csgo');
        $query_rang = "SELECT rang FROM registration WHERE username='$_SESSION[usernamefirst]' ";
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
     if(isset($_POST['leiras'])){
        $leirascucc = $_POST['leiras'];
        $update_leiras = "UPDATE registration SET leiras='$leirascucc' WHERE username='$_SESSION[usernamefirst]'";
        $result_leiras = mysqli_query($conn, $update_leiras);
     }
      if (isset($_POST['upload'])) {
        mkdir("img/$_SESSION[usernamefirst]");
        $filename = $_FILES["uploadfile"]["name"];
        $tempname = $_FILES["uploadfile"]["tmp_name"];
        $folder = "./img/$_SESSION[usernamefirst]/" . $filename;
        $targetFilePath = $folder . $filename;
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
        $allowTypes = array('jpg','png','jpeg');
        if(in_array($fileType, $allowTypes)){
          $query_img = "SELECT profile_img FROM registration WHERE username='$_SESSION[usernamefirst]' ";
          $result_img = mysqli_query($conn, $query_img);
          $data = mysqli_fetch_assoc($result_img);
          if($data['profile_img'] != "default.png"){
            unlink( "./img/$_SESSION[usernamefirst]/".$data['profile_img']);
            }
          if(move_uploaded_file($tempname, $folder)){
            $sql_img = "UPDATE registration SET profile_img='$filename' WHERE username='$_SESSION[usernamefirst]'";
            mysqli_query($conn, $sql_img);
          }
        }
     }
    }
        ?>
        <?php
        $query_img = "SELECT profile_img FROM registration WHERE username='$_SESSION[usernamefirst]' ";
        $result_img = mysqli_query($conn, $query_img);
   
        while ($data = mysqli_fetch_assoc($result_img)) {
        ?>
            <img class="pfp" src="<?php
              if($data['profile_img'] == 'default.png'){
                echo "./img/default.png";
              }
              else{
                echo "./img/$_SESSION[usernamefirst]/$data[profile_img]";
            }
             ?>">
         
        <?php
        }
        $profile_sql = "SELECT date FROM registration WHERE username='$_SESSION[usernamefirst]'";
        $result_profile=mysqli_query($conn, $profile_sql);
        $registration = mysqli_fetch_all($result_profile, MYSQLI_ASSOC);
        foreach ($registration as $date) {
        echo '<p class="datum">Fiók létrehozásának dátuma: ',$date['date'],'</p>';
        }
        $query_serversc = "SELECT * FROM servers WHERE playername='$_SESSION[usernamefirst]'";
        $result_serversc = mysqli_query($conn, $query_serversc);
        $adatok_serversc = mysqli_fetch_assoc($result_serversc);
        if($adatok_serversc['servername'] != "" and $adatok_serversc['playername'] == $_SESSION['usernamefirst'] and $adatok_serversc['elfogadott'] == 1){
          echo "<div class='servermain'>";
        }
        $query_servers_idlength= "SELECT id FROM servers where id=(select max(id) from servers)";
        $result_servers_idlength = mysqli_query($conn, $query_servers_idlength);
        $adatok_servers_idlength= mysqli_fetch_assoc($result_servers_idlength);
        for ($i = 1; $i <= $adatok_servers_idlength['id']; $i++){
          $query_servers = "SELECT * FROM servers WHERE id='$i'";
          $result_servers = mysqli_query($conn, $query_servers);
          $adatok_servers = mysqli_fetch_assoc($result_servers);
          if($adatok_servers['id'] == $i and $adatok_servers['playername'] == $_SESSION['usernamefirst'] and $adatok_servers['elfogadott'] == 1){
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
          if($adatok_serversc['servername'] != "" and $adatok_serversc['playername'] == $_SESSION['usernamefirst'] and $adatok_serversc['elfogadott'] == 1){
            echo "</div>";
          }
          ?>
        <form action="profile.php" method="POST">
        <textarea class="profileleiras" style="resize: none;" rows="4" name="leiras" id="leiras" placeholder="Leírás: " maxlength="500" style="max-width: 600px;"><?php         
        $profile_lekeres = "SELECT leiras FROM registration WHERE username='$_SESSION[usernamefirst]'";
        $profile_lekeres_result=mysqli_query($conn, $profile_lekeres);
        $profiles = mysqli_fetch_all($profile_lekeres_result, MYSQLI_ASSOC);
         foreach ($profiles as $leirasok) {
        echo $leirasok['leiras'];
        } 
        ?></textarea><input class="button2" id="send" onclick="disablecucc()" type="submit"></form>
        <button class="button2" id="szerkeszt" onclick="disableornot()">Szerkeszt</button>
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
        <form method="POST" action="profile.php" enctype="multipart/form-data">
            <div>
                <input class="button4" title="" style="color:transparent" type="file" name="uploadfile"/>
            </div>
            <div >
                <button class="button3"  type="submit" name="upload">Feltöltés</button>
                <button class="buttonX" type="submit" name="background_clear">X</button>
            </div>
      </form>
      <script>
        function background_div(){
          document.getElementById('backgrounddiv').style.display = "block";
        }
      </script>
      <button class="button5" type="submit" onclick="background_div()">Háttérkép kiválasztása</button>

      <form method="POST" action="profile.php" enctype="multipart/form-data">
        <div id="backgrounddiv" style="display: none;">
         <button class="buttons" type="submit" name="background_cucc"><img class="images" src="img/background.jpg" ></button>
         <button class="buttons" type="submit" name="background_cucc2"><img class="images" src="img/background2.jpg" ></button>
         <button class="buttons" type="submit" name="background_cucc3"><img class="images" src="img/background3.jpeg" ></button>
         <button class="buttons" type="submit" name="background_cucc4"><img class="images" src="img/background4.jpeg" ></button>
         <button class="buttons" type="submit" name="background_cucc5"><img class="images" src="img/background5.jpeg" ></button>
        </div>
      </form>
      <?php
      if (isset($_POST['background_cucc'])) {
        $filename2 = "background.jpg";
        $sql_img2 = "UPDATE registration SET background_img='$filename2' WHERE username='$_SESSION[usernamefirst]'";
        mysqli_query($conn, $sql_img2); 
        echo "<script>window.location = 'profile.php';</script>";
      }
      if (isset($_POST['background_cucc2'])) {
        $filename3 = "background2.jpg";
        $sql_img3 = "UPDATE registration SET background_img='$filename3' WHERE username='$_SESSION[usernamefirst]'";
        mysqli_query($conn, $sql_img3); 
        echo "<script>window.location = 'profile.php';</script>";
      }
      if (isset($_POST['background_cucc3'])) {
        $filename4 = "background3.jpeg";
        $sql_img4 = "UPDATE registration SET background_img='$filename4' WHERE username='$_SESSION[usernamefirst]'";
        mysqli_query($conn, $sql_img4); 
        echo "<script>window.location = 'profile.php';</script>";
      }
      if (isset($_POST['background_cucc4'])) {
        $filename5 = "background4.jpeg";
        $sql_img5 = "UPDATE registration SET background_img='$filename5' WHERE username='$_SESSION[usernamefirst]'";
        mysqli_query($conn, $sql_img5); 
        echo "<script>window.location = 'profile.php';</script>";
      }
      if (isset($_POST['background_cucc5'])) {
        $filename6 = "background5.jpeg";
        $sql_img6 = "UPDATE registration SET background_img='$filename6' WHERE username='$_SESSION[usernamefirst]'";
        mysqli_query($conn, $sql_img6); 
        echo "<script>window.location = 'profile.php';</script>";
      }
      if (isset($_POST['background_clear'])) {
        $filename_clear = "";
        $sql_img_clear = "UPDATE registration SET background_img='$filename_clear' WHERE username='$_SESSION[usernamefirst]'";
        mysqli_query($conn, $sql_img_clear); 
        echo "<script>window.location = 'profile.php';</script>";
      }
    ?>

    </div>
</body>
</html>