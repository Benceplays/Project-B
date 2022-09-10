<?php
	$email = $_POST['email'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$password2 = $_POST['password2'];
	$date = date('Y-m-d');
	$encryptedpass = base64_encode($password);

	$mailto = $email;
	$subject = "Sikeres regisztráció";
	$body = "Szia $username! Köszönjük, hogy regisztráltál weboldalunkra, reméljük kellemesen fogod magad érezni.";
	$headers = "From: wildemhu@wildem.hu";

	$conn = new mysqli('localhost','wildemhu_csgo','Kuglifej231','wildemhu_csgo');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		if($email != "" and strpos($email, '@') !== false and $username != "" and $password != "" and $password != "" and $password == $password2){
		$query_all = "SELECT email, username FROM registration";
    	$result_all = mysqli_query($conn, $query_all);
    	$adatok_all= mysqli_fetch_assoc($result_all);
			if($adatok_all['email'] != $email){
				if($adatok_all['username'] != $username){
					$tableconn  = new mysqli('localhost','wildemhu_profile_comments','Kuglifej231','wildemhu_profile_comments');
					$table = "CREATE TABLE $username ( id INT NOT NULL AUTO_INCREMENT , username VARCHAR(16) NOT NULL , date DATE NOT NULL , comment VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL , PRIMARY KEY (id)) ENGINE = InnoDB;";
					$tableconn->query($table);
					$tableconn->close();
					$filePath = 'profile/minta.php';
					$destinationFilePath = 'profile/'.$username.'.php';
					copy($filePath, $destinationFilePath);
					$stmt = $conn->prepare("insert into registration(email, username, password, date, password2) values(?, ?, ?, ?, ?)");
					$stmt->bind_param("ssssi", $email, $username, $encryptedpass, $date, $password2);
					$execval = $stmt->execute();
					echo $execval;
					echo '<script>alert("Sikeres regisztráció!")</script>';
					echo "<script>window.location = 'profile/profile.php';</script>";
					$stmt->close();
					$conn->close();
					mail($mailto, $subject, $body, $headers);
				}
				else{
					echo '<script>alert("Sikertelen regisztráció: Ez a felhasználónév már foglalt!")</script>';
					echo "<script>window.location = 'login/logincucc.php';</script>";
				}
			}
			else{
				echo '<script>alert("Sikertelen regisztráció: Ezzel az email címmel már regisztráltak!")</script>';
				echo "<script>window.location = 'login/logincucc.php';</script>";
			}
	}
	else{
	echo '<script>alert("Sikertelen regisztráció!")</script>';
	echo "<script>window.location = 'login/logincucc.php';</script>";
	}
}
?>