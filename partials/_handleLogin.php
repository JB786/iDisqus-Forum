<?php

$login = false;
$showErrorAlert = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include "_dbconnect.php";

    $username = $_POST["username"];
    $password = $_POST["password"];
    
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);

    if($num == 1){
        while($row = mysqli_fetch_assoc($result)){
            if(password_verify($password, $row['password'])){
                $login = true;

                session_start();
        
                $_SESSION["loggedIn"] = true;
                $_SESSION["username"] = $username;
                $_SESSION['sno'] = $row['sno'];
                
                header("location: /Forum/index.php?successlogin=true");
            }
            else{
                $showErrorAlert = " Invalid Credentials!!";
                // header("location: /Forum/index.php?successlogin=false&error=$showErrorAlert");
            }
        }
        
    }
    // header("location: /Forum/index.php");

     
}


?>