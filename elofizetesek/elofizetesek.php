<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Előfizetések</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="elofizetesek.css">
    <script href="../main.js"></script>
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
        <li id="ads-menu2" style="list-style-type: none;display:none; "><a class="li-a" href="../servers/servers.php">Keresés</a></li>   
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
    
      <div class="container-sm d-flex justify-content-center">
          <div class="row d-flex justify-content-center">
            <div class="col-md col-md-4 d-flex justify-content-center">
            <div class="card" style="width: 18rem;">
            <img style="width: 25%;margin-left: 37.5%; margin-top: 5%;" src="gyozike.png" alt="">
            <h2 style="color: #ff8000; text-align:center;">Kezdő</h2>
            <div class="simplevonal"></div>
            <p class="kozosszoveg">Közzé tehető szerver(ek): 2db</p>
            <div class="simplevonal"></div>
            <p class="kozosszoveg">Kiemelhető szerver(ek): 1db</p>
            <div class="simplevonal"></div>
            <p class="kozosszoveg">Napi szerver szerencsekerékre jelölhető szerverek száma: 1db</p>
            <div class="simplevonal"></div>
            <p class="kozosszoveg" style="font-size: 25px; font-weight: bold;">3900Ft/Hónap</p>
            <button class="buybutton">Vásárlás</button>
        </div>
            </div>
            <div class="col-md col-md-4 d-flex justify-content-center">
            <div class="card" style="width: 18rem;">
            <img style="width: 25%;margin-left: 37.5%; margin-top: 5%;" src="gyozike.png" alt="">
            <h2 style="color: #ff8000; text-align:center;">Kezdő</h2>
            <div class="simplevonal"></div>
            <p class="kozosszoveg">Közzé tehető szerver(ek): 2db</p>
            <div class="simplevonal"></div>
            <p class="kozosszoveg">Kiemelhető szerver(ek): 1db</p>
            <div class="simplevonal"></div>
            <p class="kozosszoveg">Napi szerver szerencsekerékre jelölhető szerverek száma: 1db</p>
            <div class="simplevonal"></div>
            <p class="kozosszoveg" style="font-size: 25px; font-weight: bold;">3900Ft/Hónap</p>
            <button class="buybutton">Vásárlás</button>
        </div>
            </div>
            <div class="col-md col-md-4 d-flex justify-content-center">
            <div class="card" style="width: 18rem;">
            <img style="width: 25%;margin-left: 37.5%; margin-top: 5%;" src="gyozike.png" alt="">
            <h2 style="color: #ff8000; text-align:center;">Kezdő</h2>
            <div class="simplevonal"></div>
            <p class="kozosszoveg">Közzé tehető szerver(ek): 2db</p>
            <div class="simplevonal"></div>
            <p class="kozosszoveg">Kiemelhető szerver(ek): 1db</p>
            <div class="simplevonal"></div>
            <p class="kozosszoveg">Napi szerver szerencsekerékre jelölhető szerverek száma: 1db</p>
            <div class="simplevonal"></div>
            <p class="kozosszoveg" style="font-size: 25px; font-weight: bold;">3900Ft/Hónap</p>
            <button class="buybutton">Vásárlás</button>
        </div>
            </div>
          </div>
        </div>
        

       
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>