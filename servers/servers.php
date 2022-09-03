<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../main.js"></script>
    <title>Szerver hirdetések</title>
    <link rel="stylesheet" href="servers.css">
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
        <li id="ads-menu2" style="list-style-type: none;display:none; "><a class="li-a" href="servers.php">Keresés</a></li>    
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
    <?php
    if (isset($_POST['toprofile'])) {
      $idfel2 = $_POST['idcucc2'];
      $result_profile_lekeres = mysqli_query($conn, "SELECT playername FROM servers WHERE id='$idfel2'");
      $adatok_lekerdezve= mysqli_fetch_assoc($result_profile_lekeres); 
      echo '<script>window.location = "../profile/',$adatok_lekerdezve['playername'],'.php";</script>';
    }
    ?>
    <div class="egesz">
    <input class="kereses" type="search" autocomplete="off" placeholder="Szerver keresése" id="search" name="search">
    <a href="kereses.php"><img src="filters.png" width="50px" style="margin-top: -0.5%;"></a>
    <div id="output"></div>
     <script type="text/javascript">
      $(document).ready(function(){
        $("#search").keyup(function(){
          $.ajax({
            type:'POST',
            url: 'search.php',
            data:{
              name:$("#search").val(),
            },
            success:function(data){
              $("#output").html(data);
            }
          });
        });
      });
     </script>
    <table style="width: 100%;" class="fodiv">
     <?php 
      $connect = new mysqli('localhost','wildemhu_csgo','Kuglifej231','wildemhu_csgo');
      $sql_servers =  "SELECT * FROM servers WHERE elfogadott='1'";
      $result_servers = mysqli_query($connect, $sql_servers);
             while($row = mysqli_fetch_assoc($result_servers)){
              $result_image = mysqli_query($connect, "SELECT * FROM registration WHERE username='$row[playername]'");
              $adatok_image= mysqli_fetch_assoc($result_image);
              ?>
              <tr style='color: #ff8000; width: 100%; height: 125px;  border-spacing: 30px;' class='divek'>
              <form method="POST">
              <input type="hidden" name="idcucc2" value="<?php echo $row["id"];?>">  
              <td style="width: 125px;"><button name='toprofile' style='border: none; background-color: rgb(38, 42, 53);'><img style="border-radius: 5px; border: #ff8000 2px solid;margin-left: 25%; margin-top: 2%;" width="75px" height="75px" src="../profile/img/<?php if($adatok_image['profile_img']=="default.png"){echo 'default.png';} else{echo $row['playername'];?>/<?php echo $adatok_image['profile_img'];}?>"></button></td>
              </form>
              <td style="width:70%;"><h4 style="margin: 0%;width: fit-content;" class="divek_servername"><a href="../szerverek/<?php echo $row['servername'];?>.php" style=' padding: 0%; margin:0%; color: #ff8000; text-decoration:none;'><?php echo $row['servername'];?></a></h4>
              <ul style="list-style: none; padding:0%; margin:0%;display: inline; width: 50%;">
                <li style="float:left;  margin-right: 0.7%; margin-top: 1%;">
                  <a href="../profile/<?php echo $row['playername'];?>.php" style='padding:0%;border: none; background-color: rgb(38, 42, 53); color: #ff8000; font-size: medium; text-decoration: none;'><p class='divek_name' style="margin: 0%; 
                  <?php if($adatok_image['rang'] == "Tag"){ 
                  echo "color: #808080 !important;";
                  }
                  if($adatok_image['rang'] == "Admin"){
                    echo "color: #00ff1a !important;";
                  }
                  if($adatok_image['rang'] == "Elofizeto"){
                    echo "color: #a600ff !important;";
                  }
                  ?>"><?php echo $row['playername'];?></p></a>
                </li>
                <li style="float:left; margin-top: 1%;"><p> - </p>
                </li>
                <li style="float:left; margin-left: 0.7%; margin-top: 1%;"> 
                  <p><?php echo $row['date'];?></p>
                </li>
                <li style="float:left; margin-left: 25%; margin-top: 1%;"> 
                  <p><?php echo $row['ipcim'];?></p>
                </li>
              </ul>
              <td style="border-left: #ff8000 1px solid; padding-left: 15px;">
              <p style="margin: 0%;">Vélemények: <?php echo $row['ertekeles_fo'];?></p>
              <p style="margin: 0%;">Értékelés: <?php if($row['ertekeles_szam'] != 0 or $row['ertekeles_fo'] != 0){echo '★'.round($row['ertekeles_szam'] / $row['ertekeles_fo'], 2);} else{echo '★0';}?></p>
            </td>
              </tr>
              <?php
        }
     ?>
     </table>
     </div>
     <style>
      .divek_name:hover{
        text-decoration: underline;
      }
      .divek_servername:hover{
        text-decoration: underline;
      }
    </style>
</body>
</html>
