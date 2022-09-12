<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="forgotpasswd.css">
    <script src="../main.js"></script>
<title>ASD</title>
</head>
<body>
<ul class="ul">
    <li class="li" ><a class="li-a" href="../index.php">Kezdőlap</a></li>
    <li class="li">
      <ul style="padding: 0;"><a class="li-a" href="../elofizetesek/elofizetesek.php" id="subscriber">Előfizetések</a></ul>
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

  <form action="forgotmintasend.php" method="post">
   <div class="loginpanel">
        <h1 class="loginh1">Elfelejtett jelszó</h1>
          <input class="loginobject" type="text" name="emailaddress" id="emailaddress" placeholder="Email cím" type="text" require><br><br>
        <p class="forgotpasswdtext">Az itt megadott email címedre fogunk küldeni egy jelszó visszaállító email-t.</p>
        <button name="kuldesgomb" class="logininbutton" >Küldés</button>
        <?php
        $str=rand();
        $randvalt = md5($str);
        session_start();
        $conn = new mysqli('localhost','wildemhu_csgo','Kuglifej231','wildemhu_csgo');
        if($conn->connect_error){
          echo "$conn->connect_error";
          die("Connection Failed : ". $conn->connect_error);
        }
        else {
          include '../login.php'; 
          $email = $_POST['emailaddress'];
          $mailto = $email;
          $uname = "SELECT username FROM registration WHERE email='$email'";
          $result=mysqli_query($conn, $uname);
          $adatok = mysqli_fetch_assoc($result);
          $username = $adatok['username'];
          $subject = "Jelszó visszaállítás";
          $body = "Szia $username! Az imént kérelémezted a jelszavad visszaállítását, ezt itt teheted meg. \n http://wildem.hu/forgotsites/".$randvalt.".php";
          $headers = "From: wildemhu@wildem.hu";
          if(isset($_POST['kuldesgomb'])){
            mail($email, $subject, $body, $headers);
            echo "<script>window.location = '../index.php';</script>";
            $filePath = 'forgotminta.php';
				    $destinationFilePath = '../forgotsites/'.$randvalt.'.php';
				    copy($filePath, $destinationFilePath);
            $valtchange = "UPDATE registration SET randstr='$randvalt' WHERE username='$username'";
            mysqli_query($conn, $valtchange); 
          }
        }
      ?>
    </div>
  </form>
</body>
</html>
