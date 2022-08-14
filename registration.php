<?php
	$email = $_POST['email'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$password2 = $_POST['password2'];

	// Database connection
	$conn = new mysqli('localhost','root','','teszt');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		$stmt = $conn->prepare("insert into registration(email, username, password, password2) values(?, ?, ?, ?)");
		$stmt->bind_param("sssi", $email, $username, $password, $password2);
		$execval = $stmt->execute();
		echo $execval;
		echo "Registration successfully...";
		$stmt->close();
		$conn->close();
	}
?>