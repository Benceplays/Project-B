<?php
	$email = $_POST['email'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$password2 = $_POST['password2'];
	$date = date('Y-m-d');

	$conn = new mysqli('localhost','wildemhu_csgo','Kuglifej231','wildemhu_csgo');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		if($email != "" and strpos($email, '@') !== false and $username != "" and $password != "" and $password != "" and $password == $password2){
		$stmt = $conn->prepare("insert into registration(email, username, password, date, password2) values(?, ?, ?, ?, ?)");
		$stmt->bind_param("ssssi", $email, $username, $password, $date, $password2);
		$execval = $stmt->execute();
		echo $execval;
		echo '<script>alert("Sikeres regisztráció")</script>';
		echo "<script>window.location = 'login/logincucc.php';</script>";
		$stmt->close();
		$conn->close();
	}
	else{
	echo '<script>alert("Sikertelen regisztráció")</script>';
	echo "<script>window.location = 'index.php';</script>";
	}
	}
?>