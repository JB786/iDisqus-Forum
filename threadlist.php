<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <style>
        #ques {
            min-height: 433px;
        }
    </style>
    <title>Welcome to iDiscuss - Coding Forums</title>
</head>

<body>

    <?php include './partials/_header.php'; ?>
    <?php include './partials/_dbconnect.php'; ?>
    <?php
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `category` WHERE category_id=$id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $CatName = $row['category_name'];
        $CatDesc = $row['category_description'];
    }

    ?>

    <?php
    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == 'POST') {
        //Insert into threads table
        $th_title = $_POST['title'];
        $th_desc = $_POST['desc'];

        $sql = "INSERT INTO threads (thread_title, thread_description, thread_cat_id, thread_user_id) VALUES ('$th_title', '$th_desc', '$id', 0)";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;

        if ($showAlert) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                         <strong>Success!</strong> Your thread has been posted!
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                   </div>';
        }
    }
    ?>

    <!-- Category container starts here -->
    <div class="container my-5">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $CatName; ?> Forums</h1>
            <p class="lead"> <?php echo $CatDesc; ?></p>
            <hr class="my-4">
            <p>This is a peer to peer forum. No Spam / Advertising / Self-promote in the forums is not allowed. Do not
                post copyright-infringing material. Do not post “offensive” posts, links or images. Do not cross post
                questions. Remain respectful of other members at all times.</p>
            <a class="btn btn-danger btn-lg" href="#" role="button">Learn More</a>
        </div>
    </div>

    <!-- <?php
            // if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            // echo '';
            // } else {
            //     echo '

            //     <div class="container my-5">
            //     <h1 class="py-2">Post a Comment</h1> 
            //        <p class="lead">You are not logged in. Please login to be able to post comments.</p>
            //     </div>
            //     ';
            // }

            ?> -->

    <div class="container my-5">
        <h1 class="py-2">Start a Discussion</h1>
        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
            <div class="form-group">
                <label for="title">Thread Title</label>
                <input class="form-control" type="text" name="title" id="title" aria-describedby="titleHelp">
                <small id="titleHelp" class="form-text text-muted">Keep your title short and crisp</small>
            </div>
            <div class="form-group">
                <label for="desc">Thread Statement</label>
                <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-danger">Post Thread</button>
        </form>
    </div>

    <div class="container mt-4" id="ques">
        <h1 class="py-2 mt-5">Browse Questions</h1>
        <?php
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        while ($row = mysqli_fetch_assoc($result)) {

            $noResult = false;

            $id = $row['thread_id'];
            $title = $row['thread_title'];
            $desc = $row['thread_description'];

            echo '<div class="media my-3">
            <img src="img/userdefault.png" width="54px" class="mr-3" alt="...">
            <div class="media-body">
              <h5 class "mt-0"><a class="text-dark" href="./thread.php?threadid= ' . $id . '">' . $title . '</a></h5>
              ' . $desc . '
            </div>
        </div>';
        }

        if ($noResult) {
            echo '<div class="jumbotron jumbotron-fluid">
            <div class="container">
                <p class="display-4">No Threads Found!</p>
                <p class="lead"> Be the first person to post your thread</p>
            </div>
         </div> ';
        }

        ?>

    </div>

    <?php include './partials/_footer.php'; ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script>
        let element = document.getElementById("two");
        setInterval(() => {
            let date = new Date();
            element.textContent = date.toLocaleString();
        }, 1000);
    </script>
</body>

</html>