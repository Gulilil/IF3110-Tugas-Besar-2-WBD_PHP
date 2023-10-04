<?php 

require_once(dirname(__DIR__,2).'/define.php');
require_once(BASE_DIR.'/views/includes/header.php');
require_once(BASE_DIR.'/models/Anime.php');
require_once(BASE_DIR.'/models/Studio.php');
require_once(BASE_DIR.'/models/Client.php');
require_once(BASE_DIR.'/models/Anime_List.php');

$a = new Anime();
$s = new Studio();
$c = new Client();
$al = new Anime_List();

$id = $data['id'];
$anime = $a->getAnimeById($id);
$studio = $s->getStudioByAnimeID($id);
$reviews = $a-> getReviewsByAnimeID($id);

$client_id = $c->getClientByUsername($_SESSION['username'])['client_id'];

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anime Page</title>
    <link rel="stylesheet" href="../../public/style/global.css">
    <link rel="stylesheet" href="../../public/style/anime.css">
    <script src='/public/handler/navbar.js'></script>
</head>


<body>
    <div class="anime-container">
        <div class="anime-header">
          <?php   
              echo "
              <div> $anime[title] </div> 
              ";
          ?>
        </div>

        <div class="anime-content">
            <div class="anime-image-box">
              <?php
                $image = $anime['image'] ?? "../../public/img/placeholder.jpg";
                echo "
                <img class='anime-image' src='$image' alt='Anime Cover Image'>
                ";
              ?>
            </div>

            <div class="anime-details">
              <h2 style='margin-bottom:20px;'>Details</h2>
              <?php
                $date = $anime['release_date'] ?? "No information";
                $episodes = $anime['episodes'] ?? "No information";
                echo " <div>Score: <span> $anime[score] </span></div> ";
                echo " <div>Type: <span> $anime[type] </span></div> ";
                echo " <div>Status: <span> $anime[status] </span></div> ";
                echo " <div>Genres: <span> Action, Drama, Thriller </span></div> ";
                echo " <div>Studios: <span> $studio[name] </span></div> ";
                echo " <div>Release Date: <span> $date </span></div> ";
                echo " <div>Episodes: <span> $episodes </span></div> ";
              ?>

              <center>
                <?php
                  if (!$al->getAnimeListByAnimeClientID($id, $client_id)){
                    echo'<button class="add-list-btn">Add to My List</button>';
                  } else {
                    echo'<button class="remove-list-btn">Remove from My List</button>';
                  }
                ?>
              </center>

            </div>
            
            <div class="anime-trailer">
                <h2 style='margin-bottom:20px;'>Trailer</h2>
                <?php
                  if ($anime['trailer']){
                    echo "<iframe class='anime-trailer-iframe' src='$anime[trailer]' autoplay='false' allowfullscreen></iframe>";
                  } else {
                    echo " <div class='anime-trailer-box'> No trailer yet </div> ";
                  }
                ?>
            </div>
        </div>
        
        <?php 
          echo "
          <div class='synopsis'>
            <h2>Sinopsis:</h2>
            <p> $anime[synopsis] </p> <!-- Add the synopsis content here -->
          </div>
          ";
        ?>

        
        <h2>Anime Review</h2>
        <!-- anime-review Item Loop -->
        <div class="anime-review-list">
            <?php
              if (count($reviews) != 0){
                foreach($reviews as $review){
                  
                  echo "
                    <div class='anime-review-item'>
                      <div class='user-info'>
                          <a href='/?client/detail/$review[client_id]'>
                            <span class='username'> $review[username] </span>
                          </a>
                          <small>Watch Status: $review[watch_status]</small>
                          <div class='rating'>Rating: $review[user_score]/10 ★</div>
                      </div>
                      <p> $review[review] </p>
                    </div>
                  ";
                };
              } else {
                echo 
                "
                  <div class='anime-review-item'> 
                    No reviews found.
                  </div>
                ";
              }

            ?>
        </div>
    </div>
</body>

<?php
require_once(BASE_DIR.'/views/includes/footer.php');
?>