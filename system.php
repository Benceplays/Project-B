<?php 
$conn = new mysqli('localhost','wildemhu_csgo','Kuglifej231','wildemhu_csgo');
$stmt = $conn->prepare("insert into systemproblem(problem, kategoria) values(?, ?)");
$stmt->bind_param("si", $problemdiv, $kategoriak);
$stmt->close();
$conn->close();
?>