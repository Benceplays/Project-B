<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="hibabejelentések.css">
    <title>Hiba bejelentések</title>
</head>
<body>
    <h1 style="text-align:center;">Hiba jelentések</h1>
    <button onclick="manualon()">Manuális problémák</button>
    <button onclick="autoon()">System problémák</button>
    <?php
    $connect = new mysqli('localhost','wildemhu_csgo','Kuglifej231','wildemhu_csgo');
      $sql_servers =  "SELECT * FROM problem";
      $result_servers = mysqli_query($connect, $sql_servers);
             while($row = mysqli_fetch_assoc($result_servers)){
                $alldata = "SELECT * FROM problem WHERE id='$row[id]'";
                $result_image = mysqli_query($connect, $alldata);
                $datas= mysqli_fetch_assoc($result_image);
              ?>
              <tr style='color: #ff8000; width: 100%; height: 125px;  border-spacing: 30px; border:2px solid #ff8000;' class='divek'>
              <form method="POST">
              <input type="hidden" name="idcucc2" value="<?php echo $row["id"];?>">  
              </form>
              <!--Itt kezdődik a kinézete-->
              <div class="divek" id="manual">
              <ul style="list-style: none; padding:0%; margin:0%;display: inline; width: 50%;">
                <li style="float:left;  margin-right: 0.7%; margin-top: 1%;">
                    <p><?php echo $datas['id'];?></p>
                </li>
                <li style="float:left; margin-top: 1%;">
                    <p><?php echo $datas['emailcim'];?></p>
                </li>
                <li style="float:left; margin-left: 0.7%; margin-top: 1%;"> 
                    <p><?php echo $datas['problem'];?></p>
                </li>
                <li style="float:left; margin-left: 25%; margin-top: 1%;"> 
                    <p><?php echo $datas['kategoria'];?></p>
                </li>
                <li style="float:left; margin-left: 25%; margin-top: 1%;"> 
                    <p><?php echo $datas['megoldodott'];?></p>
                </li>
              </ul>
              </div>
              </tr>
             <?php }?>
             <tr>
             <div class="divek" id="auto">
                    <p>asd</p>
              </div>
             </tr>
             <script>
                var i = document.getElemengById('manual');
                var l = document.getElementById('auto');
                function manualon(){
                    i.style.display = "block";
                    l.style.display = "none";
                }
                function autoon(){
                    i.style.display = "none";
                    l.style.display = "block";
                }
             </script>
</body>
</html>