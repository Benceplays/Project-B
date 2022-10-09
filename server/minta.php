<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <link rel="stylesheet" href="../server/serverminta.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body onload="comments();" >
<style>
.underline:hover{
  text-decoration: underline !important;
}
</style>
<script>
function comments()
{ 
  var elements = document.getElementsByClassName("comments_title");
  for(var i=0; i<elements.length; i++) {
      elements[i].style.height =  elements[i].scrollHeight +'px';
  }
}
</script>
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
    <div class="own_all" style="width: 100%; display: inline-block;">
<?php
$pathcucc = basename($_SERVER['SCRIPT_FILENAME']);
$idinfo = pathinfo($pathcucc, PATHINFO_FILENAME);
$conn = new mysqli('localhost','wildemhu_csgo','Kuglifej231','wildemhu_csgo');
$username_result=mysqli_query($conn, "SELECT * FROM servers WHERE id='$idinfo'");
$username_assoc = mysqli_fetch_assoc($username_result);
$username = $username_assoc['servername'];
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		$sql_szerverlekerdezes =  "SELECT * FROM servers WHERE servername='$username'";
		$result=mysqli_query($conn, $sql_szerverlekerdezes);
        $data = mysqli_fetch_assoc($result);
        $result_profile_img=mysqli_query($conn, "SELECT * FROM registration WHERE username='$data[playername]'");
        $data_profile_img=mysqli_fetch_assoc($result_profile_img);
        
		?>
  <div class="own_profile" style="width: 25%; float: right;">
		<div class="serverdatas">
    <div style="width: 100%; text-align:center">
      <a href="../profile/<?php echo $data['playername'];?>.php" style="margin:0%"  style="width: 100%;"><img class="hozzaszolasok_img" src="../profile/img/<?php if($data_profile_img['profile_img']=="default.png"){echo 'default.png';} else{echo $data_profile_img['username'];?>/<?php echo $data_profile_img['profile_img'];}?>"></a>
    </div>
    <div style="width: 100%; text-align:center">
      <a href="../profile/<?php echo $data['playername'];?>.php" class="underline" style="width: 100%; margin:0%;color: #ff8000; text-decoration: none;font-size:x-large: ; font-weight:bold;"><?php echo $data['playername'];?></a>
    </div>
    <div style="text-align:center">
    <p <?php if($data_profile_img['rang'] == "Tag"){ 
                echo "style='color: #808080 !important;'";
            }
            if($data_profile_img['rang'] == "Admin"){
              echo "style='color: #00ff1a !important;'";
            }
            if($data_profile_img['rang'] == "Elofizeto"){
              echo "style='color: #a600ff !important;'";
            }
            ?>><?php echo $data_profile_img['rang'];?>
            </p>
    </div>
    <div>
      <p style=" display: inline-block; margin-left:3%">Értékelés:</p>
      <p class="server_star" style="display: inline-block; float: right; margin-right:3%"><?php if($data['ertekeles_szam'] != 0 or $data['ertekeles_fo'] != 0){echo '★'.round($data['ertekeles_szam'] / $data['ertekeles_fo'], 2).'('.$data['ertekeles_fo'].')';} else{echo '★0';}?></p>
    </div>
    <div>
      <p style=" display: inline-block; margin-left:3%">Csatlakozott:</p>
      <p style="display: inline-block; float: right; margin-right:3%"><?php echo $data_profile_img['date']; ?></p>
    </div>
  </div>
  </div>
  <div class="own_description" style="width: 75%;">
        <p class="serverdate"><?php echo $data['date']; ?></p>
        <?php
        $files = glob("img/".$idinfo."/*.*");
        for ($i = 0; $i < count($files); $i++) {
            $image = $files[$i];
            echo '<img style="max-width: 95%;" src="'.$image .'"/>'."<br /><br />";
        
        }
        ?>
        <h2 class="servernamenew"><?php echo $data['servername']; ?></h2>
        <h2 class="ipcimnew">IP cím:<?php echo $data['ipcim']; ?></h2>
        <div class="leirasdivtwo" style="max-width: 50%;">
        <div style="height: auto;"><?php echo $data['leiras']; ?></div>
        </div>
    </div>
    </div>

        <div class="commentiras" style="padding: 10px;">
           <div>
           <form method="post">
            <?php 
            $result_comment_login=mysqli_query($conn, "SELECT * FROM registration WHERE username='$_SESSION[usernamefirst]' AND login='$_SESSION[loginvaltozo]'");
            $data_comment_profile = mysqli_fetch_assoc($result_comment_login);
            if(mysqli_num_rows($result_comment_login)==1){  
              ?>
              <img height="85px" width="85px" style="border: 2px solid #ff8000; border-radius:5px; float:left" src="../profile/img/<?php if($data_comment_profile['profile_img']=="default.png"){echo 'default.png';} else{echo $_SESSION['usernamefirst'];?>/<?php echo $data_comment_profile['profile_img'];}?>">
            <?php
            }
            else{
              echo '<img height="85px" width="85px" style="border: 2px solid #ff8000;border-radius:5px; float:left" src="../profile/img/default.png">'; 
            }
            ?>
            <select name="ertekeles" required>
              <option value="">Válassz értékelést</option>
              <option value="1" require>1</option>
              <option value="2" require>2</option>
              <option value="3" require>3</option>
              <option value="4" require>4</option>
              <option value="5" require>5</option>
             </select>
           </div>
            <textarea class="comment_text" type="text" name="comment" rows="1" placeholder="Írj hozzászólást..." style="resize: none;" required maxlength="1500" oninput="this.style.height = ''; this.style.height = this.scrollHeight +'px'"></textarea>
            <input class="comment_send" type="submit" name="hozzaszolas" value="Hozzászólás" />
          </form>
        </div>
        <?php
          $deleteconn = new mysqli('localhost','wildemhu_servercomments','Kuglifej231','wildemhu_servercomments');
         if (isset($_POST['hozzaszolas'])) {
          $result_comments_number=mysqli_query($deleteconn, "SELECT * FROM id_$idinfo WHERE username='$_SESSION[usernamefirst]'");
          $sql_szerverlekerdezes =  "SELECT * FROM registration WHERE username='$_SESSION[usernamefirst]' AND login='$_SESSION[loginvaltozo]'";
          $result_szerverlekerdezes=mysqli_query($conn, $sql_szerverlekerdezes);
          $result_ertekeles = mysqli_query($conn, "SELECT * FROM servers WHERE servername='$username'");
          $data_ertekeles = mysqli_fetch_assoc($result_ertekeles);
          $data_commentnumber = mysqli_fetch_assoc($result_szerverlekerdezes);
          if(mysqli_num_rows($result_szerverlekerdezes)==1){
            if(mysqli_num_rows($result_comments_number)!==1){
            $comment = $_POST['comment'];
            $date_comment = date('Y-m-d');
            $conn_comment  = new mysqli('localhost','wildemhu_servercomments','Kuglifej231','wildemhu_servercomments'); 
            $sql_comment = "INSERT INTO id_$idinfo(username, comment, date, ertekeles) VALUES ('$_SESSION[usernamefirst]', '$comment', '$date_comment', '$_POST[ertekeles]')";
            $result_comment = mysqli_query($conn_comment, $sql_comment);
            mysqli_query($conn, "UPDATE servers SET ertekeles_fo= $data_ertekeles[ertekeles_fo] + 1 WHERE servername='$username'");
            mysqli_query($conn, "UPDATE servers SET ertekeles_szam= $data_ertekeles[ertekeles_szam] + $_POST[ertekeles] WHERE servername='$username'");
            mysqli_query($conn, "UPDATE registration SET comment_number= $data_commentnumber[comment_number] + 1 WHERE username='$_SESSION[usernamefirst]'");
            echo "<script>window.location = '".$idinfo.".php';</script>";
            }
            else{ 
              echo '<script>alert("Már írtál hozzászólást!");</script>';
            }
          }
          else{ 
            echo '<script>alert("Nem vagy bejelentkezve!");</script>';
          }
        }
        if (isset($_POST['comment_edit'])) { 
          $id_from_comments = $_POST['idcucc'];
          $comments_texts = $_POST['comments_texts'];
          mysqli_query($deleteconn, "UPDATE id_$idinfo SET comment='$comments_texts' WHERE id=$id_from_comments"); 
        }
        if (isset($_POST['hozzaszolasok_delete'])) {
          $idfel = $_POST['idcucc'];
          $result_ertekeles_torles=mysqli_query($deleteconn, "SELECT * FROM id_$idinfo WHERE id='$idfel'");
          $adatok_ertekeles_torles=mysqli_fetch_assoc($result_ertekeles_torles);
          $result_ertekeles_torles2=mysqli_query($conn, "SELECT * FROM servers WHERE servername='$username'");
          $adatok_ertekeles_torles2=mysqli_fetch_assoc($result_ertekeles_torles2);
          $result_server_request2=mysqli_query($conn, "SELECT * FROM registration WHERE username='$_SESSION[usernamefirst]'");
          $data_comment_number_delete =mysqli_fetch_assoc($result_server_request2);
          mysqli_query($conn, "UPDATE servers SET ertekeles_fo=$adatok_ertekeles_torles2[ertekeles_fo] - 1 WHERE servername='$username'");
          mysqli_query($conn, "UPDATE servers SET ertekeles_szam=$adatok_ertekeles_torles2[ertekeles_szam] - $adatok_ertekeles_torles[ertekeles] WHERE servername='$username'");
          mysqli_query($conn, "UPDATE registration SET comment_number= $data_comment_number_delete[comment_number] - 1 WHERE username='$_SESSION[usernamefirst]'");
          mysqli_query($deleteconn, "DELETE FROM id_$idinfo WHERE id='$idfel'"); 
          echo "<script>window.location = '".$idinfo.".php';</script>";
        }
        $conn_idlengths  = new mysqli('localhost','wildemhu_servercomments','Kuglifej231','wildemhu_servercomments');
        $query_idlengths= "SELECT id FROM id_$idinfo where id=(select max(id) from id_$idinfo)";
        $result_idlengths = mysqli_query($conn_idlengths, $query_idlengths);
        $adatok_idlengths= mysqli_fetch_assoc($result_idlengths);
        $query_szerkeszt= "SELECT * FROM registration WHERE username='$_SESSION[usernamefirst]'";
        $result_szerkeszt = mysqli_query($conn, $query_szerkeszt);
        $adatok_szerkeszt = mysqli_fetch_assoc($result_szerkeszt);
        for ($a = 1; $a <= $adatok_idlengths['id']; $a++){ 
          $image = new mysqli('localhost','wildemhu_csgo','Kuglifej231','wildemhu_csgo');
          $commentconn = new mysqli('localhost','wildemhu_servercomments','Kuglifej231','wildemhu_servercomments');
          $result_hozzaszolasok = mysqli_query($commentconn, "SELECT * FROM id_$idinfo WHERE id = '$a'");
          $adatok_hozzaszolasok = mysqli_fetch_assoc($result_hozzaszolasok);
          $result_image = mysqli_query($image, "SELECT * FROM registration WHERE username='$adatok_hozzaszolasok[username]'");
          $adatok_image= mysqli_fetch_assoc($result_image);
          if($adatok_hozzaszolasok['id'] == $a){
          ?>
            <div class="hozzaszolasok">
              <div style="display:inline-block; width:100%"> 
                <div style="float:left">
                <a href="../profile/<?php echo $adatok_hozzaszolasok['username'];?>.php" style=" margin:0%;"><img class="hozzaszolasok_img2" src="../profile/img/<?php if($adatok_image['profile_img']=="default.png"){echo 'default.png';} else{echo $adatok_hozzaszolasok['username'];?>/<?php echo $adatok_image['profile_img'];}?>"></a> 
                </div>
                <div style="display:flex; padding-top: 8px"> 
                    <a href="../profile/<?php echo $adatok_hozzaszolasok['username'];?>.php" class="hozzaszolasok_name underline" style="margin 0%;font-size: medium; font-weight:bold;color:#ff8000;text-decoration:none"><?php echo $adatok_hozzaszolasok['username'];?></a>
                    <p class="hozzaszolasok_date" style="color: #808080 !important; margin-left: 1%;"><?php echo $adatok_hozzaszolasok['date'];?></p> 
                    <?php
                  if($adatok_szerkeszt['login']==1 and $adatok_hozzaszolasok['username'] == $_SESSION['usernamefirst']){
                    echo '
                    <form method="post" style="margin-left: auto;">
                    <input type="hidden" name="idcucc" value="',$adatok_hozzaszolasok["id"],'">
                    <button type="submit" class="torlesgomb" style="font-size:24px;color:#ff8000;" name="comment_edit">Edit</button>
                    <button type="submit" class="fa fa-trash-o torlesgomb" style="font-size:24px;color:#ff8000;" name="hozzaszolasok_delete"></button>';
                  }?>
                </div>
                <div style="display:flex;">
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
                </div> 
              </div>
              <textarea class="comments_title comments_text" name="comments_texts" style="resize: none;"><?php echo $adatok_hozzaszolasok['comment'];?></textarea>
              <?php if($adatok_szerkeszt['login']==1 and $adatok_hozzaszolasok['username'] == $_SESSION['usernamefirst']){echo '</form>';}?>
            </div>

        <?php }}}?>
</body>
</html>