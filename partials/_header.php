<?php

require "_dbconnect.php";

session_start();

if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == true){
    $loggedIn = true; 
}

else{
    $loggedIn = false;
}


    echo '<nav class="navbar navbar-expand-lg bg-danger" data-bs-theme="light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/Forum">iDisqus</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">';
        
        if($loggedIn){
            
            echo '
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/Forum">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="about.php">About</a>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Top Categories
                </a>
                <ul class="dropdown-menu">';

                $sql = 'SELECT category_name, category_id FROM `category` LIMIT 5';
                $query = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($query)){

                    
                    echo '<li><a class="dropdown-item" href="threadlist.php?catid='.$row['category_id'].'">'.$row['category_name'].'</a></li>';
                    
                }
                
                echo '</ul>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="contact.php">Contact</a>
                </li>
                </ul>
                <form class="d-flex" role="search" method="get" action="results.php">
                <input class="form-control" name="search" type="search" placeholder="Search" aria-label="Search" style="transform: translate(-50px);">
                <button class="btn btn-sm btn-outline-warning me-5" type="submit" style="transform: translate(-45px);">Search</button>
                </form>
                <p class="mb-0 me-2 text-light fw-bold"><em>Welcome! ' .$_SESSION["username"].'</em></p>
                <a href="./partials/_logout.php" class="btn btn-sm btn-dark me-1">Logout</a>';
                
            }

            if(!$loggedIn){

                echo '<button class="btn btn-sm btn-dark me-1" type="submit" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
                <button class="btn btn-sm btn-dark" type="submit" data-bs-toggle="modal" data-bs-target="#signupModal">Sign Up</button>';
            }
                echo '</div>
                </div>
                </nav>';
    
    include "./partials/_loginModal.php"; 
    include "./partials/_signupModal.php"; 
    
    if(isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == true){
        echo '<div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
    <strong>Hurray!</strong> Account Created Successfully. You are logged in now.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    }
  if(isset($_GET['successlogin']) && $_GET['successlogin'] == true){
    echo '<div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
<strong>Welcome!</strong> You have logged in successfully.
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
  }

?>