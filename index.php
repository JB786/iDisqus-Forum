<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iDisqus | Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .card-img-top {
            height: 200px;
        }

        .card-text {
            overflow: hidden;
        }
    </style>
</head>

<body>
    <?php include "./partials/_dbconnect.php"; ?>
    <?php include "./partials/_header.php"; ?>

    <!-- Slider Starts Here -->
    <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="./img/slide1.avif" width="1373" height="600" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="./img/slide2.avif" width="1373" height="600" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="./img/slide3.avif" width="1373" height="600" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Card Container Starts Here -->
    <div class="container my-3">
        <h1 class="text-center mb-3">iDisqus - Browse Categories</h1>
        <div class="row">

            <!-- Fetch all the Categories -->
            <?php
            $query = 'SELECT * FROM `category` ';
            $result = mysqli_query($conn, $query);

            // Use a for loop to iterate through categories

            while ($row = mysqli_fetch_assoc($result)) {
                // echo $row['category_id'];
                // echo $row['category_name'];

                $cat_id = $row['category_id'];
                $cat_name = $row['category_name'];
                $cat_desc = $row['category_description'];


                // Make a request to Unsplash API for images related to the category
                $unsplash_url = 'https://api.unsplash.com/search/photos?client_id=-FkR849JDC1BLLW4UMuYp9IVtQ_KkZ2oyyQx0knTBqI&page=1&query=' . urlencode($cat_name);
                $unsplash_response = @file_get_contents($unsplash_url);

                

                $unsplash_data = json_decode($unsplash_response, true);
                // Use true to convert objects to associative arrays

                


                // // Check if the API request was successful
                if ($unsplash_data && isset($unsplash_data['results'][0]['urls']['regular'])) {
                    $image_url = $unsplash_data['results'][0]['urls']['regular'];
                } else {
                    // Use a default image if API request fails
                    $image_url = './img/default.avif';
                }


                echo '<div class="col-md-4 my-3">
            <div class="card text-center" style="width: 18rem; height: 420px;">
                <img src="' . $image_url . '" class="card-img-top"  alt="...">
                <div class="card-body">
                    <h5 class="card-title"><a class="text-dark" href="./threadlist.php?catid='.$cat_id.'" style="text-decoration:none;">' . $cat_name . '</a></h5>
                    <p class="card-text" style="height: 100px;">' . $cat_desc . '</p>
                    <a href="./threadlist.php?catid='.$cat_id.'" class="btn btn-dark">View Threads</a>
                </div>
            </div>
        </div>';
            }

            ?>

        </div>
    </div>


    <?php include "./partials/_footer.php"; ?>
    
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