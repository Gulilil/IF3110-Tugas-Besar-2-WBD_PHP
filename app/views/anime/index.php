<?php 

require_once(dirname(__DIR__,2).'/define.php');
require_once(BASE_DIR.'/views/includes/header.php');
require_once(BASE_DIR.'/models/Anime.php');
require_once(BASE_DIR.'/models/Genre.php');

$a = new Anime();
$g = new Genre();

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anime Page</title>
    <link rel="stylesheet" href="../../public/style/global.css">
    <link rel='stylesheet' href="../../public/style/anime.css">
    <script src='/public/handler/navbar.js'></script>
</head>


<body>
  <div class="genre-flex"> 
    <?php 
      $genres = $g->getAllGenre();
      foreach($genres as $genre){
        echo "
          <div class='genre-button'>
            $genre[name]
          </div>
        ";
      }
    ?>
  </div>

  <div class="flex-wrap">
    <?php
      $animes = $a->getAllAnime();
      foreach($animes as $anime){
        $year = date('Y', strtotime($anime['release_date'])) ?? '';
        $image = $anime['image'] ?? '../../public/img/placeholder.jpg';
        echo "
        <div class='container'>
          <div class='box-preview'>
            <img src='$image' class='image-preview'/>
          </div>
          <div class='description'>
            <div> $anime[title] </div>
            <div> ($year) </div>
          </div>
        </div>

        ";
      }
    ?>
  </div>
</body>

<?php
require_once(BASE_DIR.'/views/includes/footer.php');
?>