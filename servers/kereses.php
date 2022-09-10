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

    <div class="container">
      <div class="row">
        <label>
        <input type="checkbox" <?php if (!empty($_POST['fivem'])): ?> checked="checked"<?php endif; ?>   name="fivem"/>
          <div class="icon-box">
            <span>Fivem</span>
          </div>
        </label>
        <label>
        <input type="checkbox" <?php if (!empty($_POST['minecraft'])): ?> checked="checked"<?php endif; ?> name="minecraft"/>
          <div class="icon-box">
            <span>Minecraft</span>
          </div>
        </label>
        <label>
        <input type="checkbox" <?php if (!empty($_POST['mta'])): ?> checked="checked"<?php endif; ?> name="mta"/>
          <div class="icon-box">
            <span>Multi Theft Auto</span>
          </div>
        </label>
        <label>
        <input type="checkbox" <?php if (!empty($_POST['csgo'])): ?> checked="checked"<?php endif; ?> name="csgo"/>
          <div class="icon-box">
            <span>CSGO</span>
          </div>
        </label>
        <label>
        <input type="checkbox" <?php if (!empty($_POST['rust'])): ?> checked="checked"<?php endif; ?> name="rust"/>
          <div class="icon-box">
            <span>Rust</span>
          </div>
        </label>
        <label>
        <input type="checkbox" <?php if (!empty($_POST['redm'])): ?> checked="checked"<?php endif; ?> name="redm"/>
          <div class="icon-box">
            <span>Redm</span>
          </div>
        </label>
        <label>
        <input type="checkbox" <?php if (!empty($_POST['css'])): ?> checked="checked"<?php endif; ?> name="css"/>
          <div class="icon-box">
            <span>Counter Strike Source</span>
          </div>
        </label>
        <label>
        <input type="checkbox" <?php if (!empty($_POST['egyeb'])): ?> checked="checked"<?php endif; ?> name="egyeb"/>
          <div class="icon-box">
            <span>Egyéb</span>
          </div>
        </label>
      </div>
    </div>
  </form>
  <table style="width: 100%;">
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
            $result_image_egyeb = mysqli_query($connect, "SELECT * FROM registration WHERE username='$row_egyeb[playername]'");
            $adatok_image_egyeb= mysqli_fetch_assoc($result_image_egyeb);
            ?>
            <tr style='color: #ff8000; width: 100%; height: 125px;  border-spacing: 30px;' class='divek'>
            <td style="width: 125px;"><a href="../profile/<?php echo $row_egyeb['playername'];?>.php" style=' margin:0%; text-decoration:none;'><img style="border-radius: 5px; border: #ff8000 2px solid;margin-left: 25%; margin-top: 2%;" width="75px" height="75px" src="../profile/img/<?php if($adatok_image_egyeb['profile_img']=="default.png"){echo 'default.png';} else{echo $row_egyeb['playername'];?>/<?php echo $adatok_image_egyeb['profile_img'];}?>"></a></td>
            <td style="width:70%;"><h4 style="margin: 0%;width: fit-content;" class="divek_servername"><a href="../szerverek/<?php echo $row_egyeb['servername'];?>.php" style=' padding: 0%; margin:0%; color: #ff8000; text-decoration:none;'><?php echo $row_egyeb['servername'];?></a></h4>
            <ul style="list-style: none; padding:0%; margin:0%;display: inline; width: 50%;">
              <li style="float:left;  margin-right: 0.7%; margin-top: 1%;">
              <a href="../profile/<?php echo $row_egyeb['playername'];?>.php" style='padding:0%;border: none; background-color: rgb(38, 42, 53); color: #ff8000; font-size: medium; text-decoration:none;'><p class='divek_name' style="margin: 0%; 
                <?php if($adatok_image_egyeb['rang'] == "Tag"){ 
                echo "color: #808080 !important;";
                }
                if($adatok_image_egyeb['rang'] == "Admin"){
                  echo "color: #00ff1a !important;";
                }
                if($adatok_image_egyeb['rang'] == "Elofizeto"){
                  echo "color: #a600ff !important;";
                }
                ?>"><?php echo $row_egyeb['playername'];?></p></a>
              </li>
              <li style="float:left; margin-top: 1%;"><p> - </p>
              </li>
              <li style="float:left; margin-left: 0.7%; margin-top: 1%;"> 
                <p><?php echo $row_egyeb['date'];?></p>
              </li>
              <li style="float:left; margin-left: 25%; margin-top: 1%;"> 
                <p><?php echo $row_egyeb['ipcim'];?></p>
              </li>
            </ul>
            <td style="border-left: #ff8000 1px solid; padding-left: 15px;">
            <p style="margin: 0%;">Vélemények: <?php echo $row_egyeb['ertekeles_fo'];?></p>
            <p style="margin: 0%;">Értékelés: <?php if($row_egyeb['ertekeles_szam'] != 0 or $row_egyeb['ertekeles_fo'] != 0){echo '★'.round($row_egyeb['ertekeles_szam'] / $row_egyeb['ertekeles_fo'], 2);} else{echo '★0';}?></p>
          </td>
          </tr>
            <?php
          }
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
            $result_image_fivem = mysqli_query($connect, "SELECT * FROM registration WHERE username='$row_fivem[playername]'");
            $adatok_image_fivem= mysqli_fetch_assoc($result_image_fivem);
            ?>
            <tr style='color: #ff8000; width: 100%; height: 125px;  border-spacing: 30px;' class='divek'>
            <td style="width: 125px;"><a href="../profile/<?php echo $row_fivem['playername'];?>.php" style=' margin:0%; text-decoration:none;'><img style="border-radius: 5px; border: #ff8000 2px solid;margin-left: 25%; margin-top: 2%;" width="75px" height="75px" src="../profile/img/<?php if($adatok_image_fivem['profile_img']=="default.png"){echo 'default.png';} else{echo $row_fivem['playername'];?>/<?php echo $adatok_image_fivem['profile_img'];}?>"></a></td>
            <td style="width:70%;"><h4 style="margin: 0%;width: fit-content;" class="divek_servername"><a href="../szerverek/<?php echo $row_fivem['servername'];?>.php" style=' padding: 0%; margin:0%; color: #ff8000; text-decoration:none;'><?php echo $row_fivem['servername'];?></a></h4>
            <ul style="list-style: none; padding:0%; margin:0%;display: inline; width: 50%;">
              <li style="float:left;  margin-right: 0.7%; margin-top: 1%;">
              <a href="../profile/<?php echo $row_fivem['playername'];?>.php" style='padding:0%;border: none; background-color: rgb(38, 42, 53); color: #ff8000; font-size: medium; text-decoration:none;'><p class='divek_name' style="margin: 0%; 
                <?php if($adatok_image_fivem['rang'] == "Tag"){ 
                echo "color: #808080 !important;";
                }
                if($adatok_image_fivem['rang'] == "Admin"){
                  echo "color: #00ff1a !important;";
                }
                if($adatok_image_fivem['rang'] == "Elofizeto"){
                  echo "color: #a600ff !important;";
                }
                ?>"><?php echo $row_fivem['playername'];?></p></a>
              </li>
              <li style="float:left; margin-top: 1%;"><p> - </p>
              </li>
              <li style="float:left; margin-left: 0.7%; margin-top: 1%;"> 
                <p><?php echo $row_fivem['date'];?></p>
              </li>
              <li style="float:left; margin-left: 25%; margin-top: 1%;"> 
                <p><?php echo $row_fivem['ipcim'];?></p>
              </li>
            </ul>
            <td style="border-left: #ff8000 1px solid; padding-left: 15px;">
            <p style="margin: 0%;">Vélemények: <?php echo $row_fivem['ertekeles_fo'];?></p>
            <p style="margin: 0%;">Értékelés: <?php if($row_fivem['ertekeles_szam'] != 0 or $row_fivem['ertekeles_fo'] != 0){echo '★'.round($row_fivem['ertekeles_szam'] / $row_fivem['ertekeles_fo'], 2);} else{echo '★0';}?></p>
          </td>
          </tr>
            <?php
          }
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
            $result_image_minecraft = mysqli_query($connect, "SELECT * FROM registration WHERE username='$row_minecraft[playername]'");
            $adatok_image_minecraft= mysqli_fetch_assoc($result_image_minecraft);
            ?>
            <tr style='color: #ff8000; width: 100%; height: 125px;  border-spacing: 30px;' class='divek'>
            <td style="width: 125px;"><a href="../profile/<?php echo $row_minecraft['playername'];?>.php" style=' margin:0%; text-decoration:none;'><img style="border-radius: 5px; border: #ff8000 2px solid;margin-left: 25%; margin-top: 2%;" width="75px" height="75px" src="../profile/img/<?php if($adatok_image_minecraft['profile_img']=="default.png"){echo 'default.png';} else{echo $row_minecraft['playername'];?>/<?php echo $adatok_image_minecraft['profile_img'];}?>"></a></td>
            <td style="width:70%;"><h4 style="margin: 0%;width: fit-content;" class="divek_servername"><a href="../szerverek/<?php echo $row_minecraft['servername'];?>.php" style=' padding: 0%; margin:0%; color: #ff8000; text-decoration:none;'><?php echo $row_minecraft['servername'];?></a></h4>
            <ul style="list-style: none; padding:0%; margin:0%;display: inline; width: 50%;">
              <li style="float:left;  margin-right: 0.7%; margin-top: 1%;">
              <a href="../profile/<?php echo $row_minecraft['playername'];?>.php" style='padding:0%;border: none; background-color: rgb(38, 42, 53); color: #ff8000; font-size: medium; text-decoration:none;'><p class='divek_name' style="margin: 0%; 
                <?php if($adatok_image_minecraft['rang'] == "Tag"){ 
                echo "color: #808080 !important;";
                }
                if($adatok_image_minecraft['rang'] == "Admin"){
                  echo "color: #00ff1a !important;";
                }
                if($adatok_image_minecraft['rang'] == "Elofizeto"){
                  echo "color: #a600ff !important;";
                }
                ?>"><?php echo $row_minecraft['playername'];?></p></a>
              </li>
              <li style="float:left; margin-top: 1%;"><p> - </p>
              </li>
              <li style="float:left; margin-left: 0.7%; margin-top: 1%;"> 
                <p><?php echo $row_minecraft['date'];?></p>
              </li>
              <li style="float:left; margin-left: 25%; margin-top: 1%;"> 
                <p><?php echo $row_minecraft['ipcim'];?></p>
              </li>
            </ul>
            <td style="border-left: #ff8000 1px solid; padding-left: 15px;">
            <p style="margin: 0%;">Vélemények: <?php echo $row_minecraft['ertekeles_fo'];?></p>
            <p style="margin: 0%;">Értékelés: <?php if($row_minecraft['ertekeles_szam'] != 0 or $row_minecraft['ertekeles_fo'] != 0){echo '★'.round($row_minecraft['ertekeles_szam'] / $row_minecraft['ertekeles_fo'], 2);} else{echo '★0';}?></p>
          </td>
          </tr>
            <?php
          }
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
            $result_image_mta = mysqli_query($connect, "SELECT * FROM registration WHERE username='$row_mta[playername]'");
            $adatok_image_mta= mysqli_fetch_assoc($result_image_mta);
            ?>
            <tr style='color: #ff8000; width: 100%; height: 125px;  border-spacing: 30px;' class='divek'>
            <td style="width: 125px;"><a href="../profile/<?php echo $row_mta['playername'];?>.php" style=' margin:0%; text-decoration:none;'><img style="border-radius: 5px; border: #ff8000 2px solid;margin-left: 25%; margin-top: 2%;" width="75px" height="75px" src="../profile/img/<?php if($adatok_image_mta['profile_img']=="default.png"){echo 'default.png';} else{echo $row_mta['playername'];?>/<?php echo $adatok_image_mta['profile_img'];}?>"></a></td>
            <td style="width:70%;"><h4 style="margin: 0%;width: fit-content;" class="divek_servername"><a href="../szerverek/<?php echo $row_mta['servername'];?>.php" style=' padding: 0%; margin:0%; color: #ff8000; text-decoration:none;'><?php echo $row_mta['servername'];?></a></h4>
            <ul style="list-style: none; padding:0%; margin:0%;display: inline; width: 50%;">
              <li style="float:left;  margin-right: 0.7%; margin-top: 1%;">
              <a href="../profile/<?php echo $row_mta['playername'];?>.php" style='padding:0%;border: none; background-color: rgb(38, 42, 53); color: #ff8000; font-size: medium; text-decoration:none;'><p class='divek_name' style="margin: 0%; 
                <?php if($adatok_image_mta['rang'] == "Tag"){ 
                echo "color: #808080 !important;";
                }
                if($adatok_image_mta['rang'] == "Admin"){
                  echo "color: #00ff1a !important;";
                }
                if($adatok_image_mta['rang'] == "Elofizeto"){
                  echo "color: #a600ff !important;";
                }
                ?>"><?php echo $row_mta['playername'];?></p></a>
              </li>
              <li style="float:left; margin-top: 1%;"><p> - </p>
              </li>
              <li style="float:left; margin-left: 0.7%; margin-top: 1%;"> 
                <p><?php echo $row_mta['date'];?></p>
              </li>
              <li style="float:left; margin-left: 25%; margin-top: 1%;"> 
                <p><?php echo $row_mta['ipcim'];?></p>
              </li>
            </ul>
            <td style="border-left: #ff8000 1px solid; padding-left: 15px;">
            <p style="margin: 0%;">Vélemények: <?php echo $row_mta['ertekeles_fo'];?></p>
            <p style="margin: 0%;">Értékelés: <?php if($row_mta['ertekeles_szam'] != 0 or $row_mta['ertekeles_fo'] != 0){echo '★'.round($row_mta['ertekeles_szam'] / $row_mta['ertekeles_fo'], 2);} else{echo '★0';}?></p>
          </td>
          </tr>
            <?php
          }
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
            $result_image_csgo = mysqli_query($connect, "SELECT * FROM registration WHERE username='$row_csgo[playername]'");
            $adatok_image_csgo= mysqli_fetch_assoc($result_image_csgo);
            ?>
            <tr style='color: #ff8000; width: 100%; height: 125px;  border-spacing: 30px;' class='divek'>
            <td style="width: 125px;"><a href="../profile/<?php echo $row_csgo['playername'];?>.php" style=' margin:0%; text-decoration:none;'><img style="border-radius: 5px; border: #ff8000 2px solid;margin-left: 25%; margin-top: 2%;" width="75px" height="75px" src="../profile/img/<?php if($adatok_image_csgo['profile_img']=="default.png"){echo 'default.png';} else{echo $row_csgo['playername'];?>/<?php echo $adatok_image_csgo['profile_img'];}?>"></a></td>
            <td style="width:70%;"><h4 style="margin: 0%;width: fit-content;" class="divek_servername"><a href="../szerverek/<?php echo $row_csgo['servername'];?>.php" style=' padding: 0%; margin:0%; color: #ff8000; text-decoration:none;'><?php echo $row_csgo['servername'];?></a></h4>
            <ul style="list-style: none; padding:0%; margin:0%;display: inline; width: 50%;">
              <li style="float:left;  margin-right: 0.7%; margin-top: 1%;">
              <a href="../profile/<?php echo $row_csgo['playername'];?>.php" style='padding:0%;border: none; background-color: rgb(38, 42, 53); color: #ff8000; font-size: medium; text-decoration:none;'><p class='divek_name' style="margin: 0%; 
                <?php if($adatok_image_csgo['rang'] == "Tag"){ 
                echo "color: #808080 !important;";
                }
                if($adatok_image_csgo['rang'] == "Admin"){
                  echo "color: #00ff1a !important;";
                }
                if($adatok_image_csgo['rang'] == "Elofizeto"){
                  echo "color: #a600ff !important;";
                }
                ?>"><?php echo $row_csgo['playername'];?></p></a>
              </li>
              <li style="float:left; margin-top: 1%;"><p> - </p>
              </li>
              <li style="float:left; margin-left: 0.7%; margin-top: 1%;"> 
                <p><?php echo $row_csgo['date'];?></p>
              </li>
              <li style="float:left; margin-left: 25%; margin-top: 1%;"> 
                <p><?php echo $row_csgo['ipcim'];?></p>
              </li>
            </ul>
            <td style="border-left: #ff8000 1px solid; padding-left: 15px;">
            <p style="margin: 0%;">Vélemények: <?php echo $row_csgo['ertekeles_fo'];?></p>
            <p style="margin: 0%;">Értékelés: <?php if($row_csgo['ertekeles_szam'] != 0 or $row_csgo['ertekeles_fo'] != 0){echo '★'.round($row_csgo['ertekeles_szam'] / $row_csgo['ertekeles_fo'], 2);} else{echo '★0';}?></p>
          </td>
          </tr>
            <?php
          }
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
            $result_image_rust = mysqli_query($connect, "SELECT * FROM registration WHERE username='$row_rust[playername]'");
            $adatok_image_rust= mysqli_fetch_assoc($result_image_rust);
            ?>
            <tr style='color: #ff8000; width: 100%; height: 125px;  border-spacing: 30px;' class='divek'>
            <td style="width: 125px;"><a href="../profile/<?php echo $row_rust['playername'];?>.php" style=' margin:0%; text-decoration:none;'><img style="border-radius: 5px; border: #ff8000 2px solid;margin-left: 25%; margin-top: 2%;" width="75px" height="75px" src="../profile/img/<?php if($adatok_image_rust['profile_img']=="default.png"){echo 'default.png';} else{echo $row_rust['playername'];?>/<?php echo $adatok_image_rust['profile_img'];}?>"></a></td>
            <td style="width:70%;"><h4 style="margin: 0%;width: fit-content;" class="divek_servername"><a href="../szerverek/<?php echo $row_rust['servername'];?>.php" style=' padding: 0%; margin:0%; color: #ff8000; text-decoration:none;'><?php echo $row_rust['servername'];?></a></h4>
            <ul style="list-style: none; padding:0%; margin:0%;display: inline; width: 50%;">
              <li style="float:left;  margin-right: 0.7%; margin-top: 1%;">
              <a href="../profile/<?php echo $row_rust['playername'];?>.php" style='padding:0%;border: none; background-color: rgb(38, 42, 53); color: #ff8000; font-size: medium; text-decoration:none;'><p class='divek_name' style="margin: 0%; 
                <?php if($adatok_image_rust['rang'] == "Tag"){ 
                echo "color: #808080 !important;";
                }
                if($adatok_image_rust['rang'] == "Admin"){
                  echo "color: #00ff1a !important;";
                }
                if($adatok_image_rust['rang'] == "Elofizeto"){
                  echo "color: #a600ff !important;";
                }
                ?>"><?php echo $row_rust['playername'];?></p></a>
              </li>
              <li style="float:left; margin-top: 1%;"><p> - </p>
              </li>
              <li style="float:left; margin-left: 0.7%; margin-top: 1%;"> 
                <p><?php echo $row_rust['date'];?></p>
              </li>
              <li style="float:left; margin-left: 25%; margin-top: 1%;"> 
                <p><?php echo $row_rust['ipcim'];?></p>
              </li>
            </ul>
            <td style="border-left: #ff8000 1px solid; padding-left: 15px;">
            <p style="margin: 0%;">Vélemények: <?php echo $row_rust['ertekeles_fo'];?></p>
            <p style="margin: 0%;">Értékelés: <?php if($row_rust['ertekeles_szam'] != 0 or $row_rust['ertekeles_fo'] != 0){echo '★'.round($row_rust['ertekeles_szam'] / $row_rust['ertekeles_fo'], 2);} else{echo '★0';}?></p>
          </td>
          </tr>
            <?php
          }
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
            $result_image_redm = mysqli_query($connect, "SELECT * FROM registration WHERE username='$row_redm[playername]'");
            $adatok_image_redm= mysqli_fetch_assoc($result_image_redm);
            ?>
            <tr style='color: #ff8000; width: 100%; height: 125px;  border-spacing: 30px;' class='divek'>
            <td style="width: 125px;"><a href="../profile/<?php echo $row_redm['playername'];?>.php" style=' margin:0%; text-decoration:none;'><img style="border-radius: 5px; border: #ff8000 2px solid;margin-left: 25%; margin-top: 2%;" width="75px" height="75px" src="../profile/img/<?php if($adatok_image_redm['profile_img']=="default.png"){echo 'default.png';} else{echo $row_redm['playername'];?>/<?php echo $adatok_image_redm['profile_img'];}?>"></a></td>
            <td style="width:70%;"><h4 style="margin: 0%;width: fit-content;" class="divek_servername"><a href="../szerverek/<?php echo $row_redm['servername'];?>.php" style=' padding: 0%; margin:0%; color: #ff8000; text-decoration:none;'><?php echo $row_redm['servername'];?></a></h4>
            <ul style="list-style: none; padding:0%; margin:0%;display: inline; width: 50%;">
              <li style="float:left;  margin-right: 0.7%; margin-top: 1%;">
              <a href="../profile/<?php echo $row_redm['playername'];?>.php" style='padding:0%;border: none; background-color: rgb(38, 42, 53); color: #ff8000; font-size: medium; text-decoration:none;'><p class='divek_name' style="margin: 0%; 
                <?php if($adatok_image_redm['rang'] == "Tag"){ 
                echo "color: #808080 !important;";
                }
                if($adatok_image_redm['rang'] == "Admin"){
                  echo "color: #00ff1a !important;";
                }
                if($adatok_image_redm['rang'] == "Elofizeto"){
                  echo "color: #a600ff !important;";
                }
                ?>"><?php echo $row_redm['playername'];?></p></a>
              </li>
              <li style="float:left; margin-top: 1%;"><p> - </p>
              </li>
              <li style="float:left; margin-left: 0.7%; margin-top: 1%;"> 
                <p><?php echo $row_redm['date'];?></p>
              </li>
              <li style="float:left; margin-left: 25%; margin-top: 1%;"> 
                <p><?php echo $row_redm['ipcim'];?></p>
              </li>
            </ul>
            <td style="border-left: #ff8000 1px solid; padding-left: 15px;">
            <p style="margin: 0%;">Vélemények: <?php echo $row_redm['ertekeles_fo'];?></p>
            <p style="margin: 0%;">Értékelés: <?php if($row_redm['ertekeles_szam'] != 0 or $row_redm['ertekeles_fo'] != 0){echo '★'.round($row_redm['ertekeles_szam'] / $row_redm['ertekeles_fo'], 2);} else{echo '★0';}?></p>
          </td>
          </tr>
            <?php
          }
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
            $result_image_css = mysqli_query($connect, "SELECT * FROM registration WHERE username='$row_css[playername]'");
            $adatok_image_css= mysqli_fetch_assoc($result_image_css);
            ?>
            <tr style='color: #ff8000; width: 100%; height: 125px;  border-spacing: 30px;' class='divek'>
            <td style="width: 125px;"><a href="../profile/<?php echo $row_css['playername'];?>.php" style=' margin:0%; text-decoration:none;'><img style="border-radius: 5px; border: #ff8000 2px solid;margin-left: 25%; margin-top: 2%;" width="75px" height="75px" src="../profile/img/<?php if($adatok_image_css['profile_img']=="default.png"){echo 'default.png';} else{echo $row_css['playername'];?>/<?php echo $adatok_image_css['profile_img'];}?>"></a></td>
            <td style="width:70%;"><h4 style="margin: 0%;width: fit-content;" class="divek_servername"><a href="../szerverek/<?php echo $row_css['servername'];?>.php" style=' padding: 0%; margin:0%; color: #ff8000; text-decoration:none;'><?php echo $row_css['servername'];?></a></h4>
            <ul style="list-style: none; padding:0%; margin:0%;display: inline; width: 50%;">
              <li style="float:left;  margin-right: 0.7%; margin-top: 1%;">
              <a href="../profile/<?php echo $row_css['playername'];?>.php" style='padding:0%;border: none; background-color: rgb(38, 42, 53); color: #ff8000; font-size: medium; text-decoration:none;'><p class='divek_name' style="margin: 0%; 
                <?php if($adatok_image_css['rang'] == "Tag"){ 
                echo "color: #808080 !important;";
                }
                if($adatok_image_css['rang'] == "Admin"){
                  echo "color: #00ff1a !important;";
                }
                if($adatok_image_css['rang'] == "Elofizeto"){
                  echo "color: #a600ff !important;";
                }
                ?>"><?php echo $row_css['playername'];?></p></a>
              </li>
              <li style="float:left; margin-top: 1%;"><p> - </p>
              </li>
              <li style="float:left; margin-left: 0.7%; margin-top: 1%;"> 
                <p><?php echo $row_css['date'];?></p>
              </li>
              <li style="float:left; margin-left: 25%; margin-top: 1%;"> 
                <p><?php echo $row_css['ipcim'];?></p>
              </li>
            </ul>
            <td style="border-left: #ff8000 1px solid; padding-left: 15px;">
            <p style="margin: 0%;">Vélemények: <?php echo $row_css['ertekeles_fo'];?></p>
            <p style="margin: 0%;">Értékelés: <?php if($row_css['ertekeles_szam'] != 0 or $row_css['ertekeles_fo'] != 0){echo '★'.round($row_css['ertekeles_szam'] / $row_css['ertekeles_fo'], 2);} else{echo '★0';}?></p>
          </td>
          </tr>
            <?php
          }
        }
      }

      $result_szervertext = mysqli_query($connect, $sql_szervertext);
      $query_szervertext = mysqli_num_rows($result_szervertext);
      if ($query_szervertext > 0){
        while($row = mysqli_fetch_assoc($result_szervertext)){
          $result_image_alap = mysqli_query($connect, "SELECT * FROM registration WHERE username='$row[playername]'");
          $adatok_image_alap= mysqli_fetch_assoc($result_image_alap);
          ?>
          <tr style='color: #ff8000; width: 100%; height: 125px;  border-spacing: 30px;' class='divek fodiv'>
          <td style="width: 125px;"><a href="../profile/<?php echo $row['playername'];?>.php" style=' margin:0%; text-decoration:none;'><img style="border-radius: 5px; border: #ff8000 2px solid;margin-left: 25%; margin-top: 2%;" width="75px" height="75px" src="../profile/img/<?php if($adatok_image_alap['profile_img']=="default.png"){echo 'default.png';} else{echo $row['playername'];?>/<?php echo $adatok_image_alap['profile_img'];}?>"></a></td>
          <td style="width:70%;"><h4 style="margin: 0%;width: fit-content;" class="divek_servername"><a href="../szerverek/<?php echo $row['servername'];?>.php" style=' padding: 0%; margin:0%; color: #ff8000; text-decoration:none;'><?php echo $row['servername'];?></a></h4>
          <ul style="list-style: none; padding:0%; margin:0%;display: inline; width: 50%;">
            <li style="float:left;  margin-right: 0.7%; margin-top: 1%;">
            <a href="../profile/<?php echo $row['playername'];?>.php" style='padding:0%;border: none; background-color: rgb(38, 42, 53); color: #ff8000; font-size: medium; text-decoration:none;'><p class='divek_name' style="margin: 0%; 
              <?php if($adatok_image_alap['rang'] == "Tag"){ 
              echo "color: #808080 !important;";
              }
              if($adatok_image_alap['rang'] == "Admin"){
                echo "color: #00ff1a !important;";
              }
              if($adatok_image_alap['rang'] == "Elofizeto"){
                echo "color: #a600ff !important;";
              }
              ?>"><?php echo $row['playername'];?></p></a>
            </li>
            <li style="float:left; margin-top: 1%;"><p> - </p>
            </li>
            <li style="float:left; margin-left: 0.7%; margin-top: 1%;"> 
              <p><?php echo $row['date'];?></p>
            </li>
            <li style="float:left; margin-left: 25%; margin-top: 1%;"> 
              <p><?php echo $row['ipcim'];?></p>
            </li>
          </ul>
          <td style="border-left: #ff8000 1px solid; padding-left: 15px;">
          <p style="margin: 0%;">Vélemények: <?php echo $row['ertekeles_fo'];?></p>
          <p style="margin: 0%;">Értékelés: <?php if($row['ertekeles_szam'] != 0 or $row['ertekeles_fo'] != 0){echo '★'.round($row['ertekeles_szam'] / $row['ertekeles_fo'], 2);} else{echo '★0';}?></p>
        </td>
        </tr>
          <?php
        }
      }
      else{
        echo '<p style="color: red;width: 100%; background-color:rgb(38, 42, 53); border: 2px solid red; font-size: 125%; padding: 0.2%; padding-left: 0.5%;">Nincs ilyen szerver!</p>';
      }
    }
    $sql_kezdo =  "SELECT * FROM servers WHERE elfogadott='1'";
    $result_kezdo = mysqli_query($connect, $sql_kezdo);
           while($row_kezdo = mysqli_fetch_assoc($result_kezdo)){
            $result_image = mysqli_query($connect, "SELECT * FROM registration WHERE username='$row_kezdo[playername]'");
            $adatok_image= mysqli_fetch_assoc($result_image);
            ?>
            <tr style='color: #ff8000; width: 100%; height: 125px;  border-spacing: 30px;' class='divek kezdocucc'>
            <td style="width: 125px;"><a href="../profile/<?php echo $row_kezdo['playername'];?>.php" style=' margin:0%; text-decoration:none;'><img style="border-radius: 5px; border: #ff8000 2px solid;margin-left: 25%; margin-top: 2%;" width="75px" height="75px" src="../profile/img/<?php if($adatok_image['profile_img']=="default.png"){echo 'default.png';} else{echo $row_kezdo['playername'];?>/<?php echo $adatok_image['profile_img'];}?>"></a></td>
            <td style="width:70%;"><h4 style="margin: 0%;width: fit-content;" class="divek_servername"><a href="../szerverek/<?php echo $row_kezdo['servername'];?>.php" style=' padding: 0%; margin:0%; color: #ff8000; text-decoration:none;'><?php echo $row_kezdo['servername'];?></a></h4>
            <ul style="list-style: none; padding:0%; margin:0%;display: inline; width: 50%;">
              <li style="float:left;  margin-right: 0.7%; margin-top: 1%;">
              <a href="../profile/<?php echo $row_kezdo['playername'];?>.php" style='padding:0%;border: none; background-color: rgb(38, 42, 53); color: #ff8000; font-size: medium; text-decoration:none;'><p class='divek_name' style="margin: 0%; 
                <?php if($adatok_image['rang'] == "Tag"){ 
                echo "color: #808080 !important;";
                }
                if($adatok_image['rang'] == "Admin"){
                  echo "color: #00ff1a !important;";
                }
                if($adatok_image['rang'] == "Elofizeto"){
                  echo "color: #a600ff !important;";
                }
                ?>"><?php echo $row_kezdo['playername'];?></p></a>
              </li>
              <li style="float:left; margin-top: 1%;"><p> - </p>
              </li>
              <li style="float:left; margin-left: 0.7%; margin-top: 1%;"> 
                <p><?php echo $row_kezdo['date'];?></p>
              </li>
              <li style="float:left; margin-left: 25%; margin-top: 1%;"> 
                <p><?php echo $row_kezdo['ipcim'];?></p>
              </li>
            </ul>
            <td style="border-left: #ff8000 1px solid; padding-left: 15px;">
            <p style="margin: 0%;">Vélemények: <?php echo $row_kezdo['ertekeles_fo'];?></p>
            <p style="margin: 0%;">Értékelés: <?php if($row_kezdo['ertekeles_szam'] != 0 or $row_kezdo['ertekeles_fo'] != 0){echo '★'.round($row_kezdo['ertekeles_szam'] / $row_kezdo['ertekeles_fo'], 2);} else{echo '★0';}?></p>
          </td>
          </tr>
            <?php
      }
    ?>
    </table>
  </div>
  <style>
  .divek_name:hover{
    text-decoration: underline;
  }
  .divek_servername:hover{
    text-decoration: underline;
  }
</style>
</body>
</html>
