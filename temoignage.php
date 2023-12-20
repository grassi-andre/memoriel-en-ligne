<!DOCTYPE html>
<html lang="fr">

<head>

    <link rel="stylesheet" type="text/css" href="styles/temoignage.css" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thèmes de recherche</title>
</head>

<body id="temoignage">
    <?php
    include 'header.php';
    // Inclure la classe PostManager
    ?>
    <h2 class="temoignage">Témoignage</h2>
    <?php
    require_once 'PostManager.php';

    // Create an instance of the class PostManager by passing the connection information
    require_once 'PostManager.php';

    // Create an instance of the class PostManager by passing the connection information
    $postManager = new PostManager("localhost", "root", "root", "philo");

    // Define the number of posts to display per page and the current page
    $postsPerPage = 5; // Adjust this to your desired number of posts per page
    $paginationInterval = 3; // Adjust this to your desired pagination interval
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;

    // Fetch posts for the current page
    $postsData = $postManager->getPostsByPage($page, $postsPerPage, $paginationInterval);
    $posts = $postsData['posts'];
    ?>

    <?php
    foreach ($posts as $post) {
        echo '<div class="card">';
        echo '<p>Poster par: ' . $post['nom'] . '</p>';
        echo '<p>Promos: ' . $post['promos'] . '</p>';
        echo '<p>' . $post['post'] . '</p>';
        echo '</div>';
    }
    ?>
    <button class="post-button">Make a Post</button>

    <!-- Hidden popup container -->
    <div id="post-popup" class="popup">
        <div class="popup-content">
            <!-- Your popup content goes here -->
            <h2>Create a Post</h2>
            <input type="text" name="" id="" placeholder="Nom : ">
            <input type="text" placeholder="Promos : ">
            <textarea placeholder="Écrivez votre témoignage"></textarea>
            <input type="submit" value="Valider">
            <button class="close-button">Close</button>
        </div>
    </div>

    <?php
    // Calculate the total number of posts
    $totalPosts = $postsData['totalPosts'];

    // Display pagination links
    $totalPages = ceil($totalPosts / $postsPerPage);

    echo '<div class="pagination">';
    // Previous button
    if ($page > 1) {
        echo '<a href="?page=' . ($page - 1) . '" class="prev">&lt;</a>';
    }

    for ($i = 1; $i <= $totalPages; $i++) {
        $activeClass = ($i === $page) ? 'active' : '';
        echo '<a href="?page=' . $i . '" class="' . $activeClass . '">' . $i . '</a>';

        // Add a separator every $paginationInterval pages
        if ($i % $paginationInterval === 0 && $i !== $totalPages) {
            echo ' | ';
        }
    }

    // Next button
    if ($page < $totalPages) {
        echo '<a href="?page=' . ($page + 1) . '" class="next">&gt;</a>';
    }

    echo '</div>';
    ?>


    <script>
        // JavaScript to show the popup
        document.querySelector(".post-button").addEventListener("click", function() {
            document.getElementById("post-popup").style.display = "block";
        });

        // JavaScript to close the popup
        document.querySelector(".close-button").addEventListener("click", function() {
            document.getElementById("post-popup").style.display = "none";
        });
    </script>

</body>

</html>