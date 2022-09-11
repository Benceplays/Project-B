<style>
  .fodiv{
    display:none;
  }
  .divek_name:hover{
    text-decoration: underline;
  }
  .divek_servername:hover{
    text-decoration: underline;
  }
</style>
<table style="width: 100%;">
<?php
    $connect = new mysqli('localhost','wildemhu_csgo','Kuglifej231','wildemhu_csgo');
    $sql =  "SELECT * FROM servers WHERE servername LIKE '%".$_POST['name']."%' AND elfogadott='1'";
      $result = mysqli_query($connect, $sql);
      if (mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
              $result_image = mysqli_query($connect, "SELECT * FROM registration WHERE username='$row[playername]'");
              $adatok_image= mysqli_fetch_assoc($result_image);
              ?>
              <tr style='color: #ff8000; width: 100%; height: 125px;  border-spacing: 30px;' class='divek'>
              <form method="POST">
              <input type="hidden" name="idcucc2" value="<?php echo $row["id"];?>">  
              <td style="width: 125px;"><button name='toprofile' style='border: none; background-color: rgb(38, 42, 53);'><img style="border-radius: 5px; border: #ff8000 2px solid;margin-left: 25%; margin-top: 2%;" width="75px" height="75px" src="../profile/img/<?php if($adatok_image['profile_img']=="default.png"){echo 'default.png';} else{echo $row['playername'];?>/<?php echo $adatok_image['profile_img'];}?>"></button></td>
              </form>
              <td style="width:70%;"><h4 style="margin: 0%;width: fit-content;" class="divek_servername"><a href="../szerverek/<?php echo $row['id'];?>.php" style=' padding: 0%; margin:0%; color: #ff8000; text-decoration:none;'><?php echo $row['servername'];?></a></h4>
              <ul style="list-style: none; padding:0%; margin:0%;display: inline; width: 50%;">
                <li style="float:left;  margin-right: 0.7%; margin-top: 1%;">
                <a href="../profile/<?php echo $row['playername'];?>.php" style='padding:0%;border: none; background-color: rgb(38, 42, 53); color: #ff8000; font-size: medium; text-decoration:none;'><p class='divek_name' style="margin: 0%; 
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
      }
      else{
        echo '<p style="color: red; margin-left: 42%">Nincs ilyen szerver!</p>';
      }
?>
</table>