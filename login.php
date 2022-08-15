<?php
$conn = new mysqli('localhost','wildemhu_csgo','Kuglifej231','wildemhu_csgo');

if($conn->connect_error){
    echo "$conn->connect_error";
    die("Connection Failed : ". $conn->connect_error);
} else {
    if(isset($_POST['usernamefirst'])){
        $uname = $_POST['usernamefirst'];
        $password = $_POST['passwordfirst'];
    
        $sql = "SELECT * FROM registration WHERE username='$uname' AND password='$password'";
    
        $result=mysqli_query($conn, $sql);
        if($uname != "" and $password != ""){
            if(mysqli_num_rows($result)==1){
                    echo"Sikeresen bejelentkeztél";
                }
        }
        else{
            echo "<script>window.location = 'login/login.html';</script>";
        }
    }
}

?>