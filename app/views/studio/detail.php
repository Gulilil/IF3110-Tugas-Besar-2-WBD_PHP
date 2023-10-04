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
$animes = $a->getAllAnimeByStudioID($id);
$studio = $s->getStudioByAnimeID($id);
$reviews = $a->getReviewsByAnimeID($id);
$anime_count = count($a->getAllAnimeByStudioID($id));
$avg_score = $a->getAverageAnimeScoresByStudioID($id);
$rounded_avg_score = round($avg_score['avg'], 2);

$studiooo = $s->getStudioByID($id);

$client_id = $c->getClientByUsername($_SESSION['username'])['client_id'];

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Studio Page</title>
    <link rel="stylesheet" href="../../public/style/global.css">
    <link rel="stylesheet" href="../../public/style/studio.css">
    <script src='/public/handler/navbar.js'></script>
</head>


<body>
    <div class="studio-container">
        <div class="studio-header">
          <?php   
              echo "
              <div> $studiooo[name] </div> 
              ";
          ?>
        </div>

        <div class="studio-content">
            <div class="studio-image-box">
              <?php
                $image = $studiooo['image'] ?? "../../public/img/placeholder.jpg";
                echo "
                <img class='studio-image' src='$image' alt='Studio Image'>
                ";
              ?>
            </div>

            <div class="studio-details">
              <h2>Details</h2>
              <?php
                $date = $studiooo['established_date'] ?? "No information";
                $desc = $studiooo['description'] ?? "No information";
                echo " <div>Established: <span> $date </span></div> ";
                echo " <div>Anime produced: <span> $anime_count </span></div> ";
                echo " <div>Average score: <span> $rounded_avg_score </span></div> ";
                echo " <div><span> $desc </span></div> ";
              ?>
            </div>
        </div>
                
        
        <div class="studio-header">
          <?php   
              echo "
              <div> Anime by $studiooo[name] </div> 
              ";
          ?>
        </div>
        <div class="flex-wrap">
          <?php
            foreach($animes as $anime){
              $year = date('Y', strtotime($anime['release_date'])) ?? '';
              $image = $anime['image'] ?? '../../public/img/placeholder.jpg';
              echo "
              <div class='anime-container'>
                <a href='/?anime/detail/$anime[anime_id]'>
                  <div class='anime-box-preview'>
                    <img src='$image' class='anime-image-preview'/>
                  </div>
                </a>
                <div class='anime-description'>
                  <div> $anime[title] </div>
                  <div> ($year) </div>
                </div>
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