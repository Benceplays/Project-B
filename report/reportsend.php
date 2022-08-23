<?php
	$emailcim = $_POST['emailcim'];
    $problemdiv = $_POST['problemdiv'];
	$kategoriak = $_POST['kategoriak'];
    $megoldodott = TRUE;
	$boosted = 0;
    include 'report.php';
	$conn = new mysqli('localhost','wildemhu_csgo','Kuglifej231','wildemhu_csgo');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	}
    else {
			$stmt = $conn->prepare("insert into problem(emailcim, problem, kategoria, megoldodott) values(?, ?, ?, ?)");
			$stmt->bind_param("sssi", $emailcim, $problemdiv, $kategoriak, $megoldodott);
			$execval = $stmt->execute();
			echo $execval;
			echo '<script>alert("Sikeresen jelentve a probléma");</script>';
			echo "<script>window.location = 'report.php';</script>";
			$stmt->close();
			$conn->close();
	}
    ?>