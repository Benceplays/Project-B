<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="speak.css">
    <script src="../main.js"></script>
<title>Bejelentések</title>
</head>
<body>

      
<ul class="ul">
    <li class="li" ><a class="li-a" href="../index.php">Kezdőlap</a></li>
    <li class="li">
      <ul style="padding: 0;"><a class="li-a" href="../elofizetes/elofizetesek.php" id="subscriber">Előfizetések</a></ul>
    </li>
    <li class="li">
      <ul style="padding: 0;"><a class="li-a" href="report.php" id="subscriber">Hiba bejelentés</a></ul>
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
    <li class="li">
      <ul style="padding: 0;"><a class="li-a" href="speak/speak.php" id="subscriber">Beszélgetések</a></ul>
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
        echo '<li class="li" style="float: right;" onmouseover="loginpanel()" onmouseout="loginoutpanel()"><ul style="padding: 0;"><a class="li-a" href="#">', $_SESSION["usernamefirst"], '</a><li id="login-menu2" style="list-style-type: none;display:none; "><a class="li-a" href="../profile/profile.php">Profilom</a></li>   
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
    <div class="chat_main">
        <div class="chat_messages">
            <?php print($datas['username']); ?>
        </div>
        <form action="" method="post">
        <div class="chat_input_main">
            <input type="chat_input" class="chat_input" name="chat_input" id="chat_button">
            <button class="chat_button" name="chat_button" id="chat_button">Küldés</button>
        </div>
        </form>
    </div>
    <div class="friends_main">

    </div>
    <?php
    $conn = new mysqli('localhost','wildemhu_globalchat','Kuglifej231','wildemhu_globalchat');

    if($conn->connect_error){
        echo "$conn->connect_error";
        die("Connection Failed : ". $conn->connect_error);
    } else {
        $alldata = "SELECT username FROM sessionone";
        $chatrow = mysqli_query($conn, $alldata);
        $datas= mysqli_fetch_assoc($chatrow);
        $message = $_POST['chat_input'];
        $username = $_SESSION['usernamefirst'];
        $csakugy = "asdas";
        if(isset($_POST['chat_button'])) {
            $stmt = $conn->prepare("insert into sessionone(username, text, valamiremajdjolewsz) values(?, ?, ?)");
            $stmt->bind_param("ssi", $username, $message, $csakugy);
            $stmt->close();
        }
    }
  ?>
</body>
</html>