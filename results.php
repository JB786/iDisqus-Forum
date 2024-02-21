<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iDisqus | Search Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        #resultContainer{
            height: 100vh;
        }
    </style>
</head>

<body>
    <?php include "./partials/_dbconnect.php"; ?>
    <?php include "./partials/_header.php"; ?>

    
    <div class="container my-3" id="resultContainer">
        <div class="result-heading">
            <h1 class="py-3">Search Results For : <em>"<?= $_GET['search'] ?>"</em></h1>
        </div>

        <?php
    // Now for enable searching in 2 columns of threads table we use 2 queries:
        // 1) Alter table threads add FULLTEXT(`thread_title`, `thread_description`);
        // 2) Select * from threads where match (thread_title, thread_description) against('words_to_search');

        $noResults = true;
        $sql = 'SELECT * FROM `threads` WHERE Match(thread_title, thread_description) against("'.$_GET["search"].'")';
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
            $title = $row['thread_title'];
            $desc = $row['thread_description'];
            $thread_id = $row['thread_id'];
            $noResults = false;

            echo '<div class="result-title">
            <h3><a href="thread.php?threadid='.$thread_id.'" class="text-dark">'.$title.'</a></h3>
        </div>
        <div class="result-desc">
            <p>'.$desc.'</p>
        </div>';
        }

        if($noResults){

            echo '<div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <p class="display-4">No Results Found!</p>
                        <p class="lead">Your search did not match any documents. Suggestions:</p>
                        <ul>
                            <li>Make sure that all words are spelled correctly.</li>
                            <li>Try different keywords.</li>
                            <li>Try more general keywords.</li>
                        </ul>
                    </div>
                 </div> ';
        }
    
    ?>
        
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