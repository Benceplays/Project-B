<?php
	include '../login.php';
	$servername = $_POST['servername'];
	session_start();
	$_SESSION['servernametwo'] = $servername;
	$serverip = $_POST['serverip'];
	$serverleiras = $_POST['serverleiras'];
	$boosted = 0;

	$conn = new mysqli('localhost','wildemhu_csgo','Kuglifej231','wildemhu_csgo');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		$sql_szerverlekerdezes =  "SELECT * FROM registration WHERE username='$_SESSION[usernamefirst]' AND login='$_SESSION[loginvaltozo]'";
		$result_szerverlekerdezes=mysqli_query($conn, $sql_szerverlekerdezes);
		if(mysqli_num_rows($result_szerverlekerdezes)==1){
			$stmt = $conn->prepare("insert into servers(servername, ipcim, leiras, playername, boosted) values(?, ?, ?, ?, ?)");
			$stmt->bind_param("ssssi", $servername, $serverip, $serverleiras, $_SESSION['usernamefirst'], $boosted);
			$execval = $stmt->execute();
			echo $execval;
			echo '<script>alert("Sikeresen létrehozva a hirdetés");</script>';
			echo "<script>window.location = '../profile/$_SESSION[usernamefirst].php';</script>";
			$stmt->close();
			$conn->close();

	    	$filePath = 'minta.php';
      		$destinationFilePath = '../szerverek/'.$servername.'.php';
      		copy($filePath, $destinationFilePath);
		}
		else{
			echo '<script>alert("Nem vagy bejelentkezve");</script>';
			echo "<script>window.location = '../server/server.php';</script>";
		}
	}


?>