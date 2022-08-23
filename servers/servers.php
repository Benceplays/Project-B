<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="servers.css">
    <script src="main.js"></script>
<title>Szerver hirdetések</title>
</head>
<body>   
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
        <li id="ads-menu2" style="list-style-type: none;display:none; "><a class="li-a" href="servers.php">Keresés</a></li>    
        <li id="ads-menu1" style="list-style-type: none; display:none"><a class="li-a" href="../server/server.php">Készítés</a></li>                         
      </ul>
    </li>
    <?php 
    include '../login.php';
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
          echo "<script>window.location = '../index.php';</script>";
        }
        echo '<li class="li" style="float: right;" onmouseover="loginpanel()" onmouseout="loginoutpanel()"><ul style="padding: 0;"><a class="li-a" href="#">', $_SESSION["usernamefirst"], '</a><li id="login-menu2" style="list-style-type: none;display:none; "><a class="li-a" href="../profile/'.$_SESSION["usernamefirst"],'.php">Profilom</a></li>   
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
    <?php
    $connect = new mysqli('localhost','wildemhu_csgo','Kuglifej231','wildemhu_csgo');
    for ($i = 1; $i <= 25; $i++){
    $query = "SELECT boosted, playername, servername, ipcim, leiras, id FROM servers WHERE id = '$i'";
    $result = mysqli_query($connect, $query);
    $adatok = mysqli_fetch_assoc($result);
    if($adatok['id'] == $i and $adatok['boosted'] == 1) {
      ?>
      <div style="color: #ff8000;" class="divek">
      <h1><?php echo $adatok['servername'];?></h1>
      <p><?php echo $adatok['playername'];?></p>
      <h3><?php echo $adatok['ipcim'];?></h3>
      <div class="leirasdiv">
        <p><?php echo $adatok['leiras'];?></p>
      </div>
      <a class="nexttoserver" href="../szerverek/<?php echo $adatok_b['servername'];?>.php">Tovább a weboldalra →</a>
      </div>
      <?php 
    }} 
    for ($b = 1; $b <= 25; $b++){
    $query_b = "SELECT boosted, playername, servername, ipcim, leiras, id FROM servers WHERE id = '$b'";
    $result_b = mysqli_query($connect, $query_b);
    $adatok_b = mysqli_fetch_assoc($result_b);
    if($adatok_b['id'] == $b and $adatok_b['boosted'] == 0) {?>
      <div style="color: #ff8000;" class="divek">
      <div class="namediv">
          <h1><?php echo $adatok_b['servername'];?></h1>
          <p><?php echo $adatok_b['playername'];?></p>
          <h3><?php echo $adatok_b['ipcim'];?></h3>
    </div>
      <div class="leirasdiv">
        <p><?php echo $adatok_b['leiras'];?></p>
      </div>
      <a class="nexttoserver" href="../szerverek/<?php echo $adatok_b['servername'];?>.php">Tovább a weboldalra →</a>
      </div>
      <?php 
    }} 
    ?>
</body>
</html>
