<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="report.css">
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


    
  <form action="reportsend.php" method="post" >
    <div class="newproblem">
        <h2 class="orange-text" style="padding: 2%;">Probléma jelentése</h2>
        <input type="text" id="emailcim" name="emailcim" class="emailcim" placeholder="Add meg az email címed">
        <textarea name="problemdiv" id="problemdiv" class="problemdiv" style="resize:none; width: 70%; margin-left: 15%;" placeholder="A probléma pontos, részletes kifejtése..."></textarea>
        <div class="kategoriak">
            <select class="kategoriak" id="kategoriak" name="kategoriak">
                <option >Válassz egy kategóriát</option>
                <option require>Bejelentkezéssel vagy regisztrációval kapcsolatos hiba</option>
                <option require>A szerver létrehozásával vagy közzétételével való hiba</option>
                <option require>A profilom szerkesztésével való probléma</option>
                <option require>Az előfizetés vásárlásával való probléma</option>
                <option require>A szerencsekerékkel felmerülő hiba</option>
                <option require>A problémám nincs a felsorolt listában</option>
            </select>
        </div>
        <button class="problemabutton">Probléma jelentése</button>
    </div>
    </form>
    <form action="report.php" method="post">
    <div class="myproblem">
        <h2>Saját jelentéseim</h2>
        <input type="text" name="emailinput" placeholder="Email cím">
        <button name="problemgetbutton" class="problemgetbutton">Lekérdezés</button>
        <div>
    </form>
        <?php
        if(isset($_POST['problemgetbutton'])){
          $connect = new mysqli('localhost','wildemhu_csgo','Kuglifej231','wildemhu_csgo');
          $email = $_POST['emailinput'];
          $sql_servers =  "SELECT * FROM problem";
          $result_servers = mysqli_query($connect, $sql_servers);
             while($row = mysqli_fetch_assoc($result_servers)){
                $alldata = "SELECT * FROM problem WHERE emailcim='$email' && id='$row[id]'";
                $result_image = mysqli_query($connect, $alldata);
                $datas= mysqli_fetch_assoc($result_image);
              ?>
              <tr style='color: #ff8000; width: 100%; height: 125px;  border-spacing: 30px; border:2px solid #ff8000;' class='divek'>
              <form method="POST">
              <input type="hidden" name="idcucc2" value="<?php echo $row["id"];?>">
              </form>
              <!--Itt kezdődik a kinézete-->
              <div class="divek">
              <ul style="list-style: none; padding:0%; margin:0%;display: inline; width: 50%;">
                <li>
                    <p class="idid"><?php echo $datas['id'];?></p>
                </li>
                <li>
                    <p class="email"><?php echo $datas['emailcim'];?></p>
                </li>
                <li> 
                    <div class="problemadiv">
                    <p class="problema"><?php echo $datas['problem'];?></p>
                    </div>
                </li>
                <li> 
                    <p class="kategoria"><?php echo $datas['kategoria'];?></p>
                </li>
                <li> 
                    <?php 
                    $megoldott = "nincseldontve";
                    if ($datas['megoldodott'] == 1){
                        $megoldott = "Megoldódott";
                    }
                    else{
                        $megoldott = "Még nincs megoldva";
                    }
                    ?>
                    <p class="megoldodott"><?php echo "$megoldott";?></p>
                </li>
              </ul>
              </div>
              </tr>
             <?php }}?>
        </div>
      </div>
</body>
</html>
