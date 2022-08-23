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
    <link rel="stylesheet" href="users.css">
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
    if(isset($_POST['profile_remove'])) {
      $idfel = $_POST['idcucc'];
      $sql_profile =  "SELECT * FROM registration WHERE id='$idfel'";
      $result_profile = mysqli_query($conn, $sql_profile);
      $adatok_profile = mysqli_fetch_assoc($result_profile);
      unlink( "../profile/img/".$adatok_profile['username']."/".$adatok_profile['profile_img']);
      $update_profile_img = "UPDATE registration SET profile_img='default.png' WHERE id='$idfel' ";
      $result_profile_img = mysqli_query($conn, $update_profile_img);
      $adatok_profile_img = mysqli_fetch_assoc($result_profile_img);
    }
    $sql_maxid =  "SELECT * FROM registration where id=(select max(id) from registration)";
    $result_maxid = mysqli_query($conn, $sql_maxid);
    $adatok_maxid= mysqli_fetch_assoc($result_maxid);
    for ($a = 1; $a <= $adatok_maxid['id']; $a++){
        $query = "SELECT * FROM registration WHERE id = '$a'";
        $result = mysqli_query($conn, $query);
        $adatok = mysqli_fetch_assoc($result);
        if($adatok['id'] == $a){?>
            <div class="felhasznalok">
                <form method="POST"> 
                <button name="toprofile_img" style="border: none; background-color: rgb(38, 42, 53);"><img class="adatok_img" onclick="toprofile()" src="../profile/img/<?php if($adatok['profile_img']=="default.png"){echo 'default.png';} else{echo $adatok['username'];?>/<?php echo $adatok['profile_img'];}?>"></button>
                <button name="toprofile_name" style="border: none; background-color: rgb(38, 42, 53); color: #ff8000; font-size: medium; font-weight:bold; position:absolute; margin-top:0.7%;"><p class="adatok_name"><?php echo $adatok['username'];?></p></button>
                <input type="hidden" name="idcucc" value="<?php echo $adatok["id"];?>"> 
                <button name="profile_remove" >Profilkép törlése</button>  
              </form>
                <p class="adatok_date"><?php echo $adatok['date'];?></p> 
                <p class="adatok_rang" <?php 
                if($adatok['rang'] == "Tag"){
                    echo "style='color: #808080 !important;'";
                }
                if($adatok['rang'] == "Admin"){
                  echo "style='color: #00ff1a !important;'";
                }
                if($adatok['rang'] == "Elofizeto"){
                  echo "style='color: #a600ff !important;'";
                }
                ?>><?php echo $adatok['rang'];?></p> 
                <p>ASD</p> 
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