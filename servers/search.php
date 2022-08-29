<style>
  .fodiv{
    display:none;
  }
</style>
<?php
    $connect = new mysqli('localhost','wildemhu_csgo','Kuglifej231','wildemhu_csgo');
    $sql =  "SELECT * FROM servers WHERE servername LIKE '%".$_POST['name']."%' AND elfogadott='1'";
    if($_POST['asd']==1) {
      $sql .= " AND kategoria='1'";
    }
      $result = mysqli_query($connect, $sql);
      if (mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
          echo" <div style='color: #ff8000;' class='divek'>
          <a href='../szerverek/".$row['servername'].".php' style='text-decoration: none; color: #ff8000;'>
          <h1>".$row['servername']."</h1>
          <p>".$row['playername']."</p>
          <h3>".$row['ipcim']."</h3>
          <div class='leirasdiv'>
            <p>".$row['leiras']."</p>
          </div>
          </a>
          </div>";
        }
      }
      else{
        echo '<p style="color: red; margin-left: 42%">Nincs ilyen szerver!</p>';
      }
?>