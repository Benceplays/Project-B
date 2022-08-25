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
  <form method="post">
    <input class="kereses" type="search" autocomplete="off" placeholder="Szerver keresése" id="szerverkeresestext" name="szerverkeresestext">
    <button class="keresessubmit" type="submit" name="szerverkereses" >Keresés</button>
  </form>
    <?php
    $connect = new mysqli('localhost','wildemhu_csgo','Kuglifej231','wildemhu_csgo');
    if(isset($_POST['szerverkereses'])) {
      ?>
      <style>
        .fodiv{
          display: none;
        }
      </style>
      <?php
      $szervertext = mysqli_real_escape_string($connect, $_POST['szerverkeresestext']);
      $sql_szervertext =  "SELECT * FROM servers WHERE servername LIKE '%$szervertext%' AND elfogadott=1";
      $result_szervertext = mysqli_query($connect, $sql_szervertext);
      $query_szervertext = mysqli_num_rows($result_szervertext);
      if ($query_szervertext > 0){
        while($adatok_szervertext = mysqli_fetch_assoc($result_szervertext)){
              ?>
              <a href="../szerverek/<?php echo $adatok_szervertext['servername'];?>.php" style="text-decoration: none;">
              <div style="color: #ff8000;" class="divek">
              <h1><?php echo $adatok_szervertext['servername'];?></h1>
              <p><?php echo $adatok_szervertext['playername'];?></p>
              <h3><?php echo $adatok_szervertext['ipcim'];?></h3>
              <div class="leirasdiv">
                <p><?php echo $adatok_szervertext['leiras'];?></p>
              </div>
              </div>
              </a>
              <?php 
        }
      }
      else{
        echo '<p style="color: red; margin-left: 42%">Nincs ilyen szerver!</p>';
      }
    }

    $sql_maxid =  "SELECT * FROM servers where id=(select max(id) from servers)";
    $result_maxid = mysqli_query($connect, $sql_maxid);
    $adatok_maxid= mysqli_fetch_assoc($result_maxid);
    for ($i = 1; $i <= $adatok_maxid['id']; $i++){
    $query = "SELECT * FROM servers WHERE id = '$i'";
    $result = mysqli_query($connect, $query);
    $adatok = mysqli_fetch_assoc($result);
    if($adatok['id'] == $i and $adatok['boosted'] == 1 and $adatok['elfogadott'] == 1 ) {
      ?>
      <a class="fodiv" href="../szerverek/<?php echo $adatok['servername'];?>.php" style="text-decoration: none;">
      <div style="color: #ff8000;" class="divek">
      <h1><?php echo $adatok['servername'];?></h1>
      <p><?php echo $adatok['playername'];?></p>
      <h3><?php echo $adatok['ipcim'];?></h3>
      <div class="leirasdiv">
        <p><?php echo $adatok['leiras'];?></p>
      </div>
      </div>
      </a>
      <?php 
    }}     
    for ($a = 1; $a <= $adatok_maxid['id']; $a++){
      $query_a = "SELECT * FROM servers WHERE id = '$a'";
      $result_a = mysqli_query($connect, $query_a);
      $adatok_a = mysqli_fetch_assoc($result_a);
      if($adatok_a['id'] == $a and $adatok_a['boosted'] == 0 and $adatok_a['elfogadott'] == 1 ) {
        ?>
        <a class="fodiv" href="../szerverek/<?php echo $adatok_a['servername'];?>.php" style="text-decoration: none;">
        <div style="color: #ff8000;" class="divek">
        <h1><?php echo $adatok_a['servername'];?></h1>
        <p><?php echo $adatok_a['playername'];?></p>
        <h3><?php echo $adatok_a['ipcim'];?></h3>
        <div class="leirasdiv">
          <p><?php echo $adatok_a['leiras'];?></p>
        </div>
        </div>
        </a>
        <?php 
      }} ?>
</body>
</html>
