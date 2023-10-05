<?php 
require_once(dirname(__DIR__,2).'/define.php');
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="../../public/style/global.css">
    <script src='/public/handler/navbar.js'></script>
</head>

<?php
    require_once(BASE_DIR.'/views/includes/header.php');
    require_once(BASE_DIR.'/models/Anime.php');
    require_once(BASE_DIR.'/models/Studio.php');

    $a = new Anime();
    $recommended = $a->get4RandomAnimeRecommendation();
    $latest = $a->getTop4AnimeLatest();
    $upcoming = $a->getTop4AnimeUpcoming();
    $reviews = $a->get5LatestAnimeReview();
    $top_score = $a->getTop5AnimeScore();

    $s = new Studio();
    $top_studios = $s->getTop5Studio();
?>


<body>
    <div class="content">
        <div class="left-content">
            <!-- Recommendation Anime Section -->
            <section>
                <h2>Recommendation Anime</h2>
                <!-- Anime Card Loop -->
                <div class="anime-cards">
                    <!-- This is a placeholder; repeat this for each anime -->
                    <?php
                    foreach ($recommended as $anime) {
                        $image = $anime['image'] ?? '../../public/img/placeholder.jpg';
                        echo "<a href='/?anime/detail/$anime[anime_id]' class='anime-card'>";
                        echo "<img src='" . htmlspecialchars($image) . "' alt='Anime Image'>";
                        echo "<span class='anime-title'>" . htmlspecialchars($anime['title']) . "</span>";
                        echo "</a>";
                    }
                    ?>
                </div>
            </section>

            <!-- Latest Updated Anime Trailer Section -->
            <section>
                <h2>Latest Updated Anime</h2>
                <div class="anime-cards">
                    <!-- This is a placeholder; repeat this for each anime -->
                    <?php
                    foreach ($latest as $anime) {
                        $image = $anime['image'] ?? '../../public/img/placeholder.jpg';
                        echo "<a href='/?anime/detail/$anime[anime_id]' class='anime-card'>";
                        echo "<img src='" . htmlspecialchars($image) . "' alt='Anime Image'>";
                        echo "<span class='anime-title'>" . htmlspecialchars($anime['title']) . "</span>";
                        echo "</a>";
                    }
                    ?>
                </div>
            </section>

            <!-- Upcoming Anime Section -->
            <section>
                <h2>Upcoming Anime</h2>
                <div class="anime-cards">
                    <!-- This is a placeholder; repeat this for each anime -->
                    <?php
                    foreach ($upcoming as $anime) {
                        $image = $anime['image'] ?? '../../public/img/placeholder.jpg';
                        echo "<a href='/?anime/detail/$anime[anime_id]' class='anime-card'>";
                        echo "<img src='" . htmlspecialchars($image) . "' alt='Anime Image'>";
                        echo "<span class='anime-title'>" . htmlspecialchars($anime['title']) . "</span>";
                        echo "</a>";
                    }
                    ?>
                </div>
            </section>

            <section>
                <h2>Latest Anime Review</h2>
                <!-- anime-review Item Loop -->
                <div class="anime-review-list">
                    <!-- This is a placeholder; repeat this for each anime -->
                    <?php
                    foreach ($reviews as $review) {
                        echo "<div class='anime-review-item'>";
                        echo "<h3>" . htmlspecialchars($review['title']) . "<h3>";
                        echo "<div class='user-info'>";
                        echo "<a href='/?client/detail/$review[client_id]'>";
                        echo "<span class='username'>" . htmlspecialchars($review['username']) . "</span>";
                        echo "</a>";
                        echo "<div class='rating'>Score: " . htmlspecialchars($review['user_score']) . "/10 ★</div>";
                        echo "</div>";
                        echo "<p>" . htmlspecialchars($review['review']) . "</p>";
                        echo "</div>";
                    }
                    ?>
                </div>
            </section>
        </div>

        <div class="right-content">
            <!-- Top Popular Anime Section -->
            <section>
                <h2>Top Popular Anime</h2>
                <!-- Anime List Loop -->
                <div class="popular-list">
                    <!-- This is a placeholder; repeat this for each top anime -->
                    <?php
                    foreach($top_score as $anime){
                        $image = $anime['image'] ?? '../../public/img/placeholder.jpg';
                        echo "<a href='/?anime/detail/$anime[anime_id]' class='popular-link'>";
                        echo "<div class='popular-item'>";
                        echo "<img class='popular-item-anime' src='" . htmlspecialchars($image) . "' alt='Top Anime Image'>";
                        echo "<div class='popular-details'>";
                        echo "<h3>" . htmlspecialchars($anime['title']) . "</h3>";
                        echo "<p>Score: " . htmlspecialchars($anime['score']) . "/10★</p>";
                        echo "<p>" . htmlspecialchars($anime['release_date']) . "</p>";
                        echo "<p>" . htmlspecialchars($anime['type']) . "</p>";
                        echo "</div>";
                        echo "</div>";
                        echo "</a>";
                    }
                    ?>
                </div>
            </section>
            
            <section>
                <h2>Top Studio</h2>
                <!-- Top Studio List Loop -->
                <div class="popular-list">
                    <?php
                    foreach ($top_studios as $studio) {
                        $image = $studio['image'] ?? '../../public/img/placeholder.jpg';
                        $date = $studio['established_date'] ?? 'No information';
                        echo "<a href='/?studio/detail/$studio[studio_id]' class='popular-link'>";
                        echo "<div class='popular-item'>";
                        echo "<img class='popular-item-studio' src='" . htmlspecialchars($image) . "' alt='Studio Image'>";
                        echo "<div class='popular-details'>";
                        echo "<h3>" . htmlspecialchars($studio['name']) . "</h3>";
                        echo "<p>Established: " . htmlspecialchars($date) . "</p>";
                        echo "<p>Average anime score: " . htmlspecialchars(substr($studio['avg'], 0, 4)) . "</p>";
                        echo "<p>" . htmlspecialchars(substr($studio['description'], 0, 40)) . "</p>";
                        echo "</div>";
                        echo "</div>";
                        echo "</a>";
                    }
                    ?>
                </div>
            </section>
        </div>
    </div>


</body>

<?php
require_once(BASE_DIR.'/views/includes/footer.php');
?>