<?php 
include '../login.php';
$query_szerkeszt= "SELECT * FROM registration WHERE username='$_SESSION[usernamefirst]'";
$result_szerkeszt = mysqli_query($conn, $query_szerkeszt);
$adatok_szerkeszt = mysqli_fetch_assoc($result_szerkeszt);
if($adatok_szerkeszt['login']==1 and  $adatok_szerkeszt['rang'] == "Admin"){
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Felhasználók kezelése</title>
    <link rel="stylesheet" href="serveraccept.css">
    <script src="../main.js"></script>
</head>
<body>
<ul class="ul">
    <li class="li" ><a class="li-a" href="../index.php">Kezdőlap</a></li>
    <li class="li">
      <ul style="padding: 0;"><a class="li-a" href="users.php" >Felhasználók kezelése</a></ul>
    </li>
    <li class="li">
      <ul style="padding: 0;"><a class="li-a" href="hibajelentesek.php" >Hiba jelentések</a></ul>
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
      <ul style="padding: 0;"><a class="li-a" href="#" >Szeverek kezelése</a>
        <li id="ads-menu2" style="list-style-type: none;display:none; "><a class="li-a" href="serveraccept.php">Szerverek elfogadása</a></li>   
        <li id="ads-menu1" style="list-style-type: none; display:none"><a class="li-a" href="servers.php">Meglévő szerverek</a></li>                         
      </ul>
    </li>
    <?php 

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
    $conn = new mysqli('localhost','wildemhu_csgo','Kuglifej231','wildemhu_csgo');
    if(isset($_POST['server_accept'])) {
        $idfel = $_POST['idcucc'];
        $elfogadott = 1;
        $update_elfogadott = "UPDATE servers SET elfogadott='$elfogadott' WHERE id='$idfel' ";
        $result_elfogadott = mysqli_query($conn, $update_elfogadott);
        $server_name = "SELECT * FROM servers WHERE id='$idfel' ";
        $result_server_name = mysqli_query($conn, $server_name);
        $servername = mysqli_fetch_assoc($result_server_name);
	      $filePath = '../server/minta.php';
        $destinationFilePath = '../szerverek/'.$servername['id'].'.php';
        copy($filePath, $destinationFilePath); 
        $tableconn = new mysqli('localhost','wildemhu_servercomments','Kuglifej231','wildemhu_servercomments');
				$table = "CREATE TABLE id_$servername[id] ( id INT NOT NULL AUTO_INCREMENT , username VARCHAR(16) NOT NULL , ertekeles INT(11) NOT NULL , date DATE NOT NULL , comment VARCHAR(1500) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL , PRIMARY KEY (id)) ENGINE = InnoDB;";
        $tableconn->query($table);
				$tableconn->close();
    }
    if(isset($_POST['server_decline'])) {
        $idfel = $_POST['idcucc'];
        $update_decline = "DELETE FROM servers WHERE id='$idfel' ";
        $result_decline = mysqli_query($conn, $update_decline);
    }
    $sql_maxid =  "SELECT * FROM servers where id=(select max(id) from servers)";
    $result_maxid = mysqli_query($conn, $sql_maxid);
    $adatok_maxid= mysqli_fetch_assoc($result_maxid);
    for ($a = 1; $a <= $adatok_maxid['id']; $a++){
        $query = "SELECT * FROM servers WHERE id = '$a'";
        $result = mysqli_query($conn, $query);
        $adatok = mysqli_fetch_assoc($result);
        if($adatok['id'] == $a and $adatok['elfogadott'] == 0){?>
            <div class="szerverek">
                <p class="server_name">Szerver név: <?php  echo $adatok['servername'];?></p>
                <p class="server_username">Felhasználónév: <?php  echo $adatok['playername'];?></p>
                <p class="server_ipcim">IP cím: <?php  echo $adatok['ipcim'];?></p>
                <p class="server_leiras">Leírás: <?php  echo $adatok['leiras'];?></p>
                <p class="server_boost">Boost szint: <?php echo $adatok['boosted'];?></p>
                <form method="POST"> 
                <input type="hidden" name="idcucc" value="<?php echo $adatok["id"];?>"> 
                <button class="server_accept" name="server_accept" >Elfogadás</button>  
                <button class="server_decline" name="server_decline" >Elutasítás</button>  
              </form>
            </div>
            
        <?php }
    }
  ?>
   
</body>
</html>
<?php }
else{
    echo "<script>window.location = '../index.php';</script>";
}?>