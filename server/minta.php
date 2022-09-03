<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <link rel="stylesheet" href="../server/serverminta.css">
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
  <div class="egesz">
<?php
$pathcucc = basename($_SERVER['SCRIPT_FILENAME']);
$username = pathinfo($pathcucc, PATHINFO_FILENAME);
$conn = new mysqli('localhost','wildemhu_csgo','Kuglifej231','wildemhu_csgo');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		$sql_szerverlekerdezes =  "SELECT * FROM servers WHERE servername='$username'";
		$result=mysqli_query($conn, $sql_szerverlekerdezes);
        $data = mysqli_fetch_assoc($result);
        $result_profile_img=mysqli_query($conn, "SELECT * FROM registration WHERE username='$data[playername]'");
        $data_profile_img=mysqli_fetch_assoc($result_profile_img);
    if (isset($_POST['toprofile'])) {
      $idfel2 = $_POST['idcucc2'];
      $lekeres = new mysqli('localhost','wildemhu_servercomments','Kuglifej231','wildemhu_servercomments');
      $sql_lekeres = "SELECT username FROM $username WHERE id='$idfel2'";
      $result_profile_lekeres = mysqli_query($lekeres, $sql_lekeres);
      $adatok_lekerdezve= mysqli_fetch_assoc($result_profile_lekeres); 
      echo '<script>window.location = "../profile/',$adatok_lekerdezve['username'],'.php";</script>';
    }
    if (isset($_POST['toprofile_own'])) {
      echo '<script>window.location = "../profile/',$data['playername'],'.php";</script>';
    }
        
		?>
		<div class="serverdatas">
    <p class="server_star"><?php if($data['ertekeles_szam'] != 0 or $data['ertekeles_fo'] != 0){echo '★'.round($data['ertekeles_szam'] / $data['ertekeles_fo'], 2).'('.$data['ertekeles_fo'].')';} else{echo '★0';}?></p>
    <form method="POST">
    <button name="toprofile_own" style="border: none; background-color: rgb(38, 42, 53);"><img class="hozzaszolasok_img" src="../profile/img/<?php if($data_profile_img['profile_img']=="default.png"){echo 'default.png';} else{echo $data_profile_img['username'];?>/<?php echo $data_profile_img['profile_img'];}?>"></button>
    <button name="toprofile_own" style="border: none; background-color: rgb(38, 42, 53); color: #ff8000; font-size: medium; font-weight:bold;"><p class="playernamenew"><?php echo $data['playername']; ?></p></button>
    </form>
        <h2 class="servernamenew"><?php echo $data['servername']; ?></h2>
        <h2 class="ipcimnew">IP cím:<?php echo $data['ipcim']; ?></h2>
        <div class="leirasdivtwo">
            <h2 class="leirasnew"><?php echo $data['leiras']; ?></h2>
        </div>

        <div class="commentiras">
           <div>
           <form method="post">
            <select name="ertekeles" required>
              <option value="">Válassz értékelést</option>
              <option value="1" require>1</option>
              <option value="2" require>2</option>
              <option value="3" require>3</option>
              <option value="4" require>4</option>
              <option value="5" require>5</option>
             </select>
           </div>
            <textarea class="comment_text" type="text" name="comment" placeholder="Írj hozzászólást..." style="resize: none;" rows="8" cols="50" required maxlength="500"></textarea>
            <input class="comment_send" type="submit" name="hozzaszolas" value="Hozzászólás elküldése" />
          </form>
        </div>
        <?php
         if (isset($_POST['hozzaszolas'])) {
          $sql_szerverlekerdezes =  "SELECT * FROM registration WHERE username='$_SESSION[usernamefirst]' AND login='$_SESSION[loginvaltozo]'";
          $result_szerverlekerdezes=mysqli_query($conn, $sql_szerverlekerdezes);
          $result_ertekeles = mysqli_query($conn, "SELECT * FROM servers WHERE servername='$username'");
          $data_ertekeles = mysqli_fetch_assoc($result_ertekeles);
          if(mysqli_num_rows($result_szerverlekerdezes)==1){
            $comment = $_POST['comment'];
            $date_comment = date('Y-m-d');
            $conn_comment  = new mysqli('localhost','wildemhu_servercomments','Kuglifej231','wildemhu_servercomments'); 
            $sql_comment = "INSERT INTO $username(username, comment, date, ertekeles) VALUES ('$_SESSION[usernamefirst]', '$comment', '$date_comment', '$_POST[ertekeles]')";
            $result_comment = mysqli_query($conn_comment, $sql_comment);
            mysqli_query($conn, "UPDATE servers SET ertekeles_fo= $data_ertekeles[ertekeles_fo] + 1 WHERE servername='$username'");
            mysqli_query($conn, "UPDATE servers SET ertekeles_szam= $data_ertekeles[ertekeles_szam] + $_POST[ertekeles] WHERE servername='$username'");
            echo "<script>window.location = '".$username.".php';</script>";
          }
          else{ 
            echo '<script>alert("Nem vagy bejelentkezve!");</script>';
          }
        }
        if (isset($_POST['hozzaszolasok_delete'])) {
          $idfel = $_POST['idcucc'];
          $torlesconn = new mysqli('localhost','wildemhu_servercomments','Kuglifej231','wildemhu_servercomments');
          $result_ertekeles_torles=mysqli_query($torlesconn, "SELECT * FROM $username WHERE id='$idfel'");
          $adatok_ertekeles_torles=mysqli_fetch_assoc($result_ertekeles_torles);
          $result_ertekeles_torles2=mysqli_query($conn, "SELECT * FROM servers WHERE servername='$username'");
          $adatok_ertekeles_torles2=mysqli_fetch_assoc($result_ertekeles_torles2);
          mysqli_query($conn, "UPDATE servers SET ertekeles_fo=$adatok_ertekeles_torles2[ertekeles_fo] - 1 WHERE servername='$username'");
          mysqli_query($conn, "UPDATE servers SET ertekeles_szam=$adatok_ertekeles_torles2[ertekeles_szam] - $adatok_ertekeles_torles[ertekeles] WHERE servername='$username'");
          $sql_torles = "DELETE FROM $username WHERE id='$idfel'";
          mysqli_query($torlesconn, $sql_torles); 
          echo "<script>window.location = '".$username.".php';</script>";
        }
        $conn_idlengths  = new mysqli('localhost','wildemhu_servercomments','Kuglifej231','wildemhu_servercomments');
        $query_idlengths= "SELECT id FROM $username where id=(select max(id) from $username)";
        $result_idlengths = mysqli_query($conn_idlengths, $query_idlengths);
        $adatok_idlengths= mysqli_fetch_assoc($result_idlengths);
        $query_szerkeszt= "SELECT * FROM registration WHERE username='$_SESSION[usernamefirst]'";
        $result_szerkeszt = mysqli_query($conn, $query_szerkeszt);
        $adatok_szerkeszt = mysqli_fetch_assoc($result_szerkeszt);
        for ($a = 1; $a <= $adatok_idlengths['id']; $a++){ 
          $image = new mysqli('localhost','wildemhu_csgo','Kuglifej231','wildemhu_csgo');
          $commentconn = new mysqli('localhost','wildemhu_servercomments','Kuglifej231','wildemhu_servercomments');
          $query_hozzaszolasok = "SELECT * FROM $username WHERE id = '$a'";
          $result_hozzaszolasok = mysqli_query($commentconn, $query_hozzaszolasok);
          $adatok_hozzaszolasok = mysqli_fetch_assoc($result_hozzaszolasok);
          $query_image = "SELECT * FROM registration WHERE username='$adatok_hozzaszolasok[username]'";
          $result_image = mysqli_query($image, $query_image);
          $adatok_image= mysqli_fetch_assoc($result_image);
          if($adatok_hozzaszolasok['id'] == $a){
          ?>
          <div class="hozzaszolasok">
          <form method="POST">
            <input type="hidden" name="idcucc2" value="<?php echo $adatok_hozzaszolasok["id"];?>">  
            <button name="toprofile" style="border: none; background-color: rgb(38, 42, 53); margin-top: 2%;"><img class="hozzaszolasok_img" src="../profile/img/<?php if($adatok_image['profile_img']=="default.png"){echo 'default.png';} else{echo $adatok_hozzaszolasok['username'];?>/<?php echo $adatok_image['profile_img'];}?>"></button>
            <button name="toprofile" style="border: none; background-color: rgb(38, 42, 53); color: #ff8000; font-size: medium; font-weight:bold; position:absolute; margin-top:0.7%;"><p class="hozzaszolasok_name"><?php echo $adatok_hozzaszolasok['username'];?></p></button>
            </form>
            <p class="hozzaszolasok_date"><?php echo $adatok_hozzaszolasok['date'];?></p>   
            <p class="hozzaszolasok_rang" <?php if($adatok_image['rang'] == "Tag"){ 
                echo "style='color: #808080 !important;'";
            }
            if($adatok_image['rang'] == "Admin"){
              echo "style='color: #00ff1a !important;'";
            }
            if($adatok_image['rang'] == "Elofizeto"){
              echo "style='color: #a600ff !important;'";
            }
            ?>><?php echo $adatok_image['rang'];?>
            </p>
            <p class="hozzaszolasok_star"><?php echo '★'.$adatok_hozzaszolasok['ertekeles'];?></p> 
            <textarea id="commentcucc" class="hozzaszolasok_text" rows="6" disabled style="resize: none;"><?php echo $adatok_hozzaszolasok['comment'];?></textarea> 
            <?php
            if($adatok_szerkeszt['login']==1 and $adatok_hozzaszolasok['username'] == $_SESSION['usernamefirst']){
              echo '
              <form method="post">
              <input type="hidden" name="idcucc" value="',$adatok_hozzaszolasok["id"],'">  
                <button class="torlesgomb" type="submit" name="hozzaszolasok_delete">Törlés</button>
              </form>';
            }?>
          </div>

          <?php }}?>   
    </div>
	<?php
	}?>
  </div>
</body>
</html>