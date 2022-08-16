<?php
	$servername = $_POST['servername'];
	$serverip = $_POST['serverip'];
	$serverleiras = $_POST['serverleiras'];

	// Database connection
	$conn = new mysqli('localhost','wildemhu_csgo','Kuglifej123','wildemhu_csgo');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
        $stmt = $conn->prepare("insert into szerverek(name, ipcim, leiras) values(?, ?, ?)");
		$stmt->bind_param("ssi", $servername, $serverip, $serverleiras);
		$execval = $stmt->execute();
		echo $execval;
		echo '<script>alert("Sikeresen létrehozva a hirdetés")</script>';
		echo "<script>window.location = 'profile/profile.html';</script>";
		$stmt->close();
		$conn->close();
	}
?>