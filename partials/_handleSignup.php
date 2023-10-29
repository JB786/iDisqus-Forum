<?php
$exists = false;
$login = false;
$showErrorAlert = false;
$showSuccessAlert = false;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    include "./partials/_dbconnect.php";

    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    
    // Client side validation
    $checkQuery = "SELECT * FROM users WHERE username='$username' OR email='$email' ";
    $result1 = mysqli_query($conn, $checkQuery);
    
    if (mysqli_num_rows($result1) > 0) {
        // User with the same username or email already exists
        $exists = true;
        $showErrorAlert = " Either Username or Email already exists! Choose different Username or Email.";
        header("location: /Forum/index.php?signupsuccess=false&error=$showErrorAlert");
    }

    if ($password == $cpassword) {

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO `users`(`username`, `email`, `password`, `date_added`) VALUES ('$username', '$email', '$hashedPassword', current_timestamp())";

        $result2 = mysqli_query($conn, $sql);

        if ($result2) {
            $showSuccessAlert = true;
            $login = true;

            session_start();

            $_SESSION["loggedIn"] = true;
            $_SESSION["username"] = $username;

            header("location: /Forum/index.php?signupsuccess=true");
        }
    } else {
        $showErrorAlert = " Confirm Password is Incorrect!";
        header("location: /Forum/index.php?signupsuccess=false&error=$showErrorAlert");
    }
    // Close the database connection
    mysqli_close($conn);
}

?>