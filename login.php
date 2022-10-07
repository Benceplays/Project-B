<?php
session_start();
$conn = new mysqli('localhost','wildemhu_csgo','Kuglifej231','wildemhu_csgo');

if($conn->connect_error){
    echo "$conn->connect_error";
    die("Connection Failed : ". $conn->connect_error);
} else {
    if(isset($_POST['usernamefirst'])){
        $uname = $_POST['usernamefirst'];
        $password = $_POST['passwordfirst'];
        $encryptedpass = base64_encode($password);
        $_SESSION['loginvaltozo'] = 0;
    
        $sql = "SELECT * FROM registration WHERE username='$uname' AND password='$encryptedpass'";
        $login_username = "SELECT * FROM registration WHERE username='$uname'";
        $login_password = "SELECT * FROM registration WHERE password='$encryptedpass'";
        $result2=mysqli_query($conn, $login_username);
        $result3=mysqli_query($conn, $login_password);
        $result=mysqli_query($conn, $sql);
    
            if(mysqli_num_rows($result)!==0){
                    $_SESSION['usernamefirst'] = $uname;
                    $_SESSION['loginvaltozo'] = 1;
                    $update = "UPDATE registration SET login='$_SESSION[loginvaltozo]' WHERE username='$uname'";
                    $result_update = mysqli_query($conn, $update);
                    echo "<script>window.location = 'index.php';</script>";
                    echo"Sikeresen bejelentkeztél";
                    header('Location: http://wildem.hu/profile/profile.php');
                }
            else{
                if(mysqli_num_rows($result2)!==1){
                    echo"A felhasználó név nem stimmel";
                }
                else{
                    echo"A jelszó nem stimmel";
                }
        }
            
    }
}

?>