<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="login.css">
    <script src="../main.js"></script>
<title>ASD</title>
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
        echo '<li class="li" style="float: right;" ><a class="li-a" href="logincucc.php">Bejelentkezés</a></li>';
      }
      if(mysqli_num_rows($result_login)==1){
        if(isset($_POST['kilepes'])) {
          $logincucosvaltozo = 0;
          $update_login = "UPDATE registration SET login='$logincucosvaltozo' WHERE username='$_SESSION[usernamefirst]' ";
          $resultlogin_update = mysqli_query($conn, $update_login);
          echo "<script>window.location = '../index.php';</script>";
        }
        echo '<li class="li" style="float: right;" onmouseover="loginpanel()" onmouseout="loginoutpanel()"><ul style="padding: 0;"><a class="li-a" href="#">', $_SESSION["usernamefirst"], '</a><li id="login-menu2" style="list-style-type: none;display:none; "><a class="li-a" href="../profile/profile.php">Profilom</a></li>   
        <li id="login-menu1" style="list-style-type: none; display:none"><form method="post"><input type="submit" name="kilepes" class="kilepes" value="kilepes" /></form></li></ul></li>';
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


    <button onclick="login()" class="logbutton" style="margin-left: 37.5%; ">Bejelentkezés</button>
    <button onclick="registration()" class="logbutton" style="margin-left: 4.8%; ">Regisztráció</button>
    <form action="../login.php" method="post" >
    <div id="loginbut" class="loginpanel">
        <h1 class="loginh1">Bejelentkezés</h1>a
        <input class="loginobject" placeholder="Felhasználónév" type="text" name="usernamefirst" id="usernamefirst" style="margin-left: 7.5%; margin-right: 5%;"><br><br>
        
        <input class="loginobject psw-hide" placeholder="Jelszó" type="password" title="Jelszó" id="passwordfirst" name="passwordfirst" required><br><br>
          <img src="../password.png" width="30px" style="float: right; margin-right: 2%; margin-top: -60px;" onclick="jelszonezes()">
        <a class="forgotpasswd" href="../forgotpasswd/forgotpasswd.php" style="font-weight: bold;">Elfelejtetted a jelszavad?</a>
        <button class="logininbutton" style="margin-bottom: 5%;" id="logi">Bejelentkezés</button>
    </div>
    </form>
    <form action="../registration.php" method="post" >
    <div id="registerbut" class="loginpanel" style="display: none; height: 50%;">
        <h1 class="loginh1" >Regisztráció</h1>
        <input class="loginobject"  placeholder="Email cím" type="text" name="email" id="email">
        <input class="loginobject" autocomplete="off" placeholder="Felhasználónév" type="text" name="username" id="username">
        <input class="loginobject psw-hide" placeholder="Jelszó" type="password" name="password" id="passwd" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
        <img src="../password.png" width="30px" style="float: right; margin-right: 2%; margin-top: 9%;" onclick="jelszonezes2()">
        <div id="message" class="displaycucc" style="margin-left: 13%; margin-top: 2%;">
          <p id="letter" class="invalid">Kis betű</p>
          <p id="capital" class="invalid">Nagy betű</p>
          <p id="number" class="invalid">Egy szám</p>
          <p id="length" class="invalid">Minimum 8 karakter</b></p>
          
      </div>  
        <input class="loginobject psw-hide" placeholder="Jelszó még egyszer" type="password" name="password2" title="Jelszó" id="passwd2"  required>
        <div id="message2" class="displaycucc" style="margin-left: 13%; margin-top: 2%; color: red">
          <p>A jelszavak nem egyeznek</p>
      </div>  
        <button type="submit" class="logininbutton" style="margin-left: 60%; padding:1%; margin-bottom: 5%;" id="reg-button">Regisztráció</button>

  </div>       
</form>


</body>
</html>
