<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="kereses.css">
    <script src="../main.js"></script>
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
  <div class="egesz">
  <form method="post">
    <input class="kereses" type="search" autocomplete="off" placeholder="Szerver keresése" id="szerverkeresestext" name="szerverkeresestext">
    <button class="keresesgomb" type="submit" name="szerverkereses">Keresés</button>
    <h1 style="color: rgb(38, 42, 53); background-color: #ff8000; padding-bottom: 0.3%; ">Kategóriák:</h1>
    <div style="margin-bottom: 4%;">
    <ul style="list-style-type: none; color: #ff8000; font-weight: bold; float:left; display:inline; padding:0%; width:100%">
        <li class="li">
            <label>
                <input type="checkbox" <?php if (!empty($_POST['fivem'])): ?> checked="checked"<?php endif; ?>   name="fivem"/>Fivem
            </label>
        </li>
        <li class="li">
            <label>
                <input type="checkbox" <?php if (!empty($_POST['minecraft'])): ?> checked="checked"<?php endif; ?> name="minecraft"/>Minecraft
            </label>
        </li>
        <li class="li">
            <label>
                <input type="checkbox" <?php if (!empty($_POST['mta'])): ?> checked="checked"<?php endif; ?> name="mta"/>Multi Theft Auto
            </label>
        </li>
        <li class="li">
            <label>
                <input type="checkbox" <?php if (!empty($_POST['csgo'])): ?> checked="checked"<?php endif; ?> name="csgo"/>CSGO
            </label>
        </li>
        <li class="li">
            <label>
                <input type="checkbox" <?php if (!empty($_POST['rust'])): ?> checked="checked"<?php endif; ?> name="rust"/>Rust
            </label>
        </li>
        <li class="li">
            <label>
                <input type="checkbox" <?php if (!empty($_POST['redm'])): ?> checked="checked"<?php endif; ?> name="redm"/>Redm
            </label>
        </li>
        <li class="li">
            <label>
                <input type="checkbox" <?php if (!empty($_POST['css'])): ?> checked="checked"<?php endif; ?> name="css"/>Counter Strike Source
            </label>
        </li>
        <li class="li">
            <label>
                <input type="checkbox" <?php if (!empty($_POST['egyeb'])): ?> checked="checked"<?php endif; ?> name="egyeb"/>Egyéb
            </label>
        </li>
    </ul>
    </div>
  </form>
    <?php
    $connect = new mysqli('localhost','wildemhu_csgo','Kuglifej231','wildemhu_csgo');
    if(isset($_POST['szerverkereses'])) {
        ?>
        <style>
            .kezdocucc{
                display: none;
            }
        </style>
        <?php
      $szervertext = mysqli_real_escape_string($connect, $_POST['szerverkeresestext']);
      $sql_szervertext =  "SELECT * FROM servers WHERE servername LIKE '%$szervertext%' AND elfogadott=1";

      if(isset($_POST['egyeb'])) {
        ?>
        <style>
            .fodiv{
                display: none;
            }
        </style>
        <?php
        $sql_egyeb =  "SELECT * FROM servers WHERE servername LIKE '%$szervertext%' AND elfogadott=1 AND kategoria='0'";
        $result_egyeb = mysqli_query($connect, $sql_egyeb);
        $query_egyeb = mysqli_num_rows($result_egyeb);
        if ($query_egyeb > 0){
          while($row_egyeb = mysqli_fetch_assoc($result_egyeb)){
              echo" <div style='color: #ff8000;' class='divek'>
              <a href='../szerverek/".$row_egyeb['servername'].".php' style='text-decoration: none; color: #ff8000;'>
              <h1>".$row_egyeb['servername']."</h1>
              <p>".$row_egyeb['playername']."</p>
              <h3>".$row_egyeb['ipcim']."</h3>
              <div class='leirasdiv'>
                <p>".$row_egyeb['leiras']."</p>
              </div>
              </a>
              </div>";
          }
        }
        else{
            echo '<p style="color: red; margin-left: %">Nincs ilyen szerver a megadott kategóriá(k)ban!</p>';
        }
      }
      if(isset($_POST['fivem'])) {
        ?>
        <style>
            .fodiv{
                display: none;
            }
        </style>
        <?php
        $sql_fivem =  "SELECT * FROM servers WHERE servername LIKE '%$szervertext%' AND elfogadott=1 AND kategoria='1'";
        $result_fivem = mysqli_query($connect, $sql_fivem);
        $query_fivem = mysqli_num_rows($result_fivem);
        if ($query_fivem > 0){
          while($row_fivem= mysqli_fetch_assoc($result_fivem)){
              echo" <div style='color: #ff8000;' class='divek'>
              <a href='../szerverek/".$row_fivem['servername'].".php' style='text-decoration: none; color: #ff8000;'>
              <h1>".$row_fivem['servername']."</h1>
              <p>".$row_fivem['playername']."</p>
              <h3>".$row_fivem['ipcim']."</h3>
              <div class='leirasdiv'>
                <p>".$row_fivem['leiras']."</p>
              </div>
              </a>
              </div>";
          }
        }
        else{
            echo '<p style="color: red; margin-left: 50%">Nincs ilyen szerver a megadott kategóriá(k)ban!</p>';
        }
      }
      if(isset($_POST['minecraft'])) {
        ?>
        <style>
            .fodiv{
                display: none;
            }
        </style>
        <?php
        $sql_minecraft =  "SELECT * FROM servers WHERE servername LIKE '%$szervertext%' AND elfogadott=1 AND kategoria='2'";
        $result_minecraft = mysqli_query($connect, $sql_minecraft);
        $query_minecraft = mysqli_num_rows($result_minecraft);
        if ($query_minecraft > 0){
          while($row_minecraft= mysqli_fetch_assoc($result_minecraft)){
              echo" <div style='color: #ff8000;' class='divek'>
              <a href='../szerverek/".$row_fivem['servername'].".php' style='text-decoration: none; color: #ff8000;'>
              <h1>".$row_minecraft['servername']."</h1>
              <p>".$row_minecraft['playername']."</p>
              <h3>".$row_minecraft['ipcim']."</h3>
              <div class='leirasdiv'>
                <p>".$row_minecraft['leiras']."</p>
              </div>
              </a>
              </div>";
          }
        }
        else{
            echo '<p style="color: red; margin-left: 50%">Nincs ilyen szerver a megadott kategóriá(k)ban!</p>';
        }
      }
      if(isset($_POST['mta'])) {
        ?>
        <style>
            .fodiv{
                display: none;
            }
        </style>
        <?php
        $sql_mta =  "SELECT * FROM servers WHERE servername LIKE '%$szervertext%' AND elfogadott=1 AND kategoria='3'";
        $result_mta = mysqli_query($connect, $sql_mta);
        $query_mta = mysqli_num_rows($result_mta);
        if ($query_mta > 0){
          while($row_mta= mysqli_fetch_assoc($result_mta)){
              echo" <div style='color: #ff8000;' class='divek'>
              <a href='../szerverek/".$row_mta['servername'].".php' style='text-decoration: none; color: #ff8000;'>
              <h1>".$row_mta['servername']."</h1>
              <p>".$row_mta['playername']."</p>
              <h3>".$row_mta['ipcim']."</h3>
              <div class='leirasdiv'>
                <p>".$row_mta['leiras']."</p>
              </div>
              </a>
              </div>";
          }
        }
        else{
          echo '<p style="color: red; margin-left: 50%">Nincs ilyen szerver a megadott kategóriá(k)ban!</p>';
        }
      }
      if(isset($_POST['csgo'])) {
        ?>
        <style>
            .fodiv{
                display: none;
            }
        </style>
        <?php
        $sql_csgo =  "SELECT * FROM servers WHERE servername LIKE '%$szervertext%' AND elfogadott=1 AND kategoria='4'";
        $result_csgo = mysqli_query($connect, $sql_csgo);
        $query_csgo = mysqli_num_rows($result_csgo);
        if ($query_csgo > 0){
          while($row_csgo= mysqli_fetch_assoc($result_csgo)){
              echo" <div style='color: #ff8000;' class='divek'>
              <a href='../szerverek/".$row_csgo['servername'].".php' style='text-decoration: none; color: #ff8000;'>
              <h1>".$row_csgo['servername']."</h1>
              <p>".$row_csgo['playername']."</p>
              <h3>".$row_csgo['ipcim']."</h3>
              <div class='leirasdiv'>
                <p>".$row_csgo['leiras']."</p>
              </div>
              </a>
              </div>";
          }
        }
        else{
          echo '<p style="color: red; margin-left: 50%">Nincs ilyen szerver a megadott kategóriá(k)ban!</p>';
        }
      }
      if(isset($_POST['rust'])) {
        ?>
        <style>
            .fodiv{
                display: none;
            }
        </style>
        <?php
        $sql_rust =  "SELECT * FROM servers WHERE servername LIKE '%$szervertext%' AND elfogadott=1 AND kategoria='5'";
        $result_rust = mysqli_query($connect, $sql_rust);
        $query_rust = mysqli_num_rows($result_rust);
        if ($query_rust > 0){
          while($row_rust= mysqli_fetch_assoc($result_rust)){
              echo" <div style='color: #ff8000;' class='divek'>
              <a href='../szerverek/".$row_rust['servername'].".php' style='text-decoration: none; color: #ff8000;'>
              <h1>".$row_rust['servername']."</h1>
              <p>".$row_rust['playername']."</p>
              <h3>".$row_rust['ipcim']."</h3>
              <div class='leirasdiv'>
                <p>".$row_rust['leiras']."</p>
              </div>
              </a>
              </div>";
          }
        }
        else{
          echo '<p style="color: red; margin-left: 50%">Nincs ilyen szerver a megadott kategóriá(k)ban!</p>';
        }
      }
      if(isset($_POST['redm'])) {
        ?>
        <style>
            .fodiv{
                display: none;
            }
        </style>
        <?php
        $sql_redm =  "SELECT * FROM servers WHERE servername LIKE '%$szervertext%' AND elfogadott=1 AND kategoria='6'";
        $result_redm = mysqli_query($connect, $sql_redm);
        $query_redm = mysqli_num_rows($result_redm);
        if ($query_redm > 0){
          while($row_redm= mysqli_fetch_assoc($result_redm)){
              echo" <div style='color: #ff8000;' class='divek'>
              <a href='../szerverek/".$row_redm['servername'].".php' style='text-decoration: none; color: #ff8000;'>
              <h1>".$row_redm['servername']."</h1>
              <p>".$row_redm['playername']."</p>
              <h3>".$row_redm['ipcim']."</h3>
              <div class='leirasdiv'>
                <p>".$row_redm['leiras']."</p>
              </div>
              </a>
              </div>";
          }
        }
        else{
          echo '<p style="color: red; margin-left: 50%">Nincs ilyen szerver a megadott kategóriá(k)ban!</p>';
        }
      }
      if(isset($_POST['css'])) {
        ?>
        <style>
            .fodiv{
                display: none;
            }
        </style>
        <?php
        $sql_css =  "SELECT * FROM servers WHERE servername LIKE '%$szervertext%' AND elfogadott=1 AND kategoria='7'";
        $result_css = mysqli_query($connect, $sql_css);
        $query_css = mysqli_num_rows($result_css);
        if ($query_css > 0){
          while($row_css= mysqli_fetch_assoc($result_css)){
              echo" <div style='color: #ff8000;' class='divek'>
              <a href='../szerverek/".$row_css['servername'].".php' style='text-decoration: none; color: #ff8000;'>
              <h1>".$row_css['servername']."</h1>
              <p>".$row_css['playername']."</p>
              <h3>".$row_css['ipcim']."</h3>
              <div class='leirasdiv'>
                <p>".$row_css['leiras']."</p>
              </div>
              </a>
              </div>";
          }
        }
        else{
          echo '<p style="color: red; margin-left: 50%">Nincs ilyen szerver a megadott kategóriá(k)ban!</p>';
        }
      }

      $result_szervertext = mysqli_query($connect, $sql_szervertext);
      $query_szervertext = mysqli_num_rows($result_szervertext);
      if ($query_szervertext > 0){
        while($row = mysqli_fetch_assoc($result_szervertext)){
            echo" <div style='color: #ff8000;' class='divek fodiv'>
            <a href='../szerverek/".$row['servername'].".php' style='text-decoration: none; color: #ff8000;'>
            <h1>".$row['servername']."</h1>
            <p>".$row['playername']."</p>
            <h3>".$row['ipcim']."</h3>
            <div class='leirasdiv'>
              <p>".$row['leiras']."</p>
            </div>
            </a>
            </div>";
        }
      }
      else{
        echo '<p style="color: red; margin-left: 50%">Nincs ilyen szerver!</p>';
      }
    }
    $sql_kezdo =  "SELECT * FROM servers WHERE elfogadott='1'";
    $result_kezdo = mysqli_query($connect, $sql_kezdo);
           while($row_kezdo = mysqli_fetch_assoc($result_kezdo)){
            echo" <div style='color: #ff8000;' class='divek kezdocucc'>
            <a href='../szerverek/".$row_kezdo['servername'].".php' style='text-decoration: none; color: #ff8000;'>
            <h1>".$row_kezdo['servername']."</h1>
            <p>".$row_kezdo['playername']."</p>
            <h3>".$row_kezdo['ipcim']."</h3>
            <div class='leirasdiv'>
              <p>".$row_kezdo['leiras']."</p>
            </div>
            </a>
            </div>";
      }
    ?>
  </div>
</body>
</html>
