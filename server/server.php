<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="server.css">
    <script src="../main.js"></script>
<title>Szerver hirdetés készítés</title>
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
        <li id="ads-menu1" style="list-style-type: none; display:none"><a class="li-a" href="server.php">Készítés</a></li>                         
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

  <form method="POST" enctype="multipart/form-data" action="server.php" >
    <div class="newhirdetes">
        <h2 class="orange-text" style="padding: 2%;">Hirdetés létrehozása</h2>
        <input class="newhirdetesinput orange-text" autocomplete="off" placeholder="A szerver neve" type="text" name="servername" style="width: 30%; margin-left:17.5% ;" required>
        <input class="newhirdetesinput orange-text" autocomplete="off" placeholder="A szever IP címe" type="text" name="serverip" id="" style="width: 30%; margin-left:5%;" required>
        <textarea class="newhirdetesinput orange-text" required autocomplete="off" placeholder="A szerver leírása" type="text" name="serverleiras" maxlength="2500" style="resize:none; width: 80%; height: 50%; margin-left: 10%; margin-top: -2%; margin-top: 5%;"></textarea>
        <div class="kategoriak">
            <select name="servers" class="kategoria" required>
                <option value="">Válassz egy kategóriát</option>
                <option value="1" require>Fivem</option>
                <option value="2" require>Minecraft</option>
                <option value="3" require>Multi Theft Auto</option>
                <option value="4" require>Counter Strike Global Offensive</option>
                <option value="5" require>Rust</option>
                <option value="6" require>Redm</option>
                <option value="7" require>Counter Strike Source</option>
                <option value="0" require>Nincs a listában</option>
            </select>
            </div>
        <ul style="list-style: none;display:inline-block; width: 100%; padding:0%">
          <li style="float:left; width:40%">
            <p style="color:#ff8000; margin-left:25%; margin-top: 0%; ">Weboldal/Discord szerver link:</p>
          </li>
          <li style="float:left; width:60%">
            <input class="newhirdetesinput" style="color:#ff8000; width: 32.5%;" autocomplete="off" type="url" placeholder="URL"  name="links"/>
          </li>
        </ul>
        <ul style="list-style: none;display:inline-block; width: 100%; padding:0%">
          <li style="float:left; width:40%">
            <p style="color:#ff8000; margin-left:25%; margin-top: 0%; ">A szerverhez kapcsolódó képeket itt csatolhatod:</p>
          </li>
          <li style="float:left; width:60%"> 
            <input class="buttonfile" style="color:#ff8000; width: 32.5%;" type="file" name="uploadfile[]" multiple/>
          </li>
        </ul>
        <button class="hirdetesbutton" name="submithirdetes">Hirdetés létrehozása</button>
    </form>
    </div>
  </div>
  
  <?php
  if (isset($_POST['submithirdetes'])) {
	include '../login.php';
	$servername = $_POST['servername'];
	session_start();
	$_SESSION['servernametwo'] = $servername;
	$serverip = $_POST['serverip'];
	$serverleiras = $_POST['serverleiras'];
	$kategoria = $_POST['servers'];
	$url = $_POST['links']; 
	$boosted = 0;
  $filename = $_FILES['uploadfile']['name'];
  $tempname = $_FILES['uploadfile']['tmp_name'];
  $countfiles = count($_FILES['uploadfile']['name']);
 

	$conn = new mysqli('localhost','wildemhu_csgo','Kuglifej231','wildemhu_csgo');
		$sql_szerverlekerdezes =  "SELECT * FROM registration WHERE username='$_SESSION[usernamefirst]' AND login='$_SESSION[loginvaltozo]'";
		$result_szerverlekerdezes=mysqli_query($conn, $sql_szerverlekerdezes);
		if(mysqli_num_rows($result_szerverlekerdezes)==1){
      if($filename != ""){
        mkdir("../szerverek/img/$servername");
        for($i=0;$i<$countfiles;$i++){
          $files = $filename[$i];
          move_uploaded_file($tempname[$i],'../szerverek/img/'.$servername.'/'.$files);
        }
       }  
			$stmt = $conn->prepare("insert into servers(servername, ipcim, leiras, playername, kategoria, url, boosted) values(?, ?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("ssssssi", $servername, $serverip, $serverleiras, $_SESSION['usernamefirst'], $kategoria, $url, $boosted);
			$execval = $stmt->execute();
			echo $execval;
			echo '<script>alert("Sikeresen létrehozva a hirdetés");</script>';
			echo "<script>window.location = '../profile/$_SESSION[usernamefirst].php';</script>";
			$stmt->close();
			$conn->close();
    }
		else{
			echo '<script>alert("Nem vagy bejelentkezve");</script>';
			echo "<script>window.location = '../server/server.php';</script>";
		}
  }
?>

</body>
</html>
