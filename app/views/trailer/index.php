<?php 

require_once(dirname(__DIR__,2).'/define.php');
require_once(BASE_DIR.'/views/includes/header.php');
require_once(BASE_DIR.'/models/Anime.php');

$a = new Anime();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trailer Page</title>
    <link rel="stylesheet" href="../../public/style/global.css">
    <link rel="stylesheet" href="../../public/style/trailer.css">
    <script src='/public/handler/navbar.js'></script>
    <script src='/public/handler/trailer.js'></script>
</head>

<body>
  <div class="trailer-container" id='trailer-div' onclick='hideTrailer()'>
  <iframe class='anime-trailer-iframe' id='anime-trailer-iframe' src='' autoplay='false' allowfullscreen></iframe>
  </div>

  <div class="flex-wrap">
    <?php
      $animes = $a->getAllAnimeWithTrailer();
      foreach($animes as $anime){
        $year = date('Y', strtotime($anime['release_date'])) ?? '';
        $image = $anime['image'] ?? '../../public/img/placeholder.jpg';
        $arr = explode('/', $anime['trailer']);
        $trailer = htmlspecialchars($anime['trailer']);
        echo "
        <div class='container'>
          <div class='box-preview' onclick=\"displayTrailer('$trailer')\">
            <img src='$image' class='image-preview' id='image-preview'/>
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
</html>

<?php
require_once(BASE_DIR.'/views/includes/footer.php');
?>

      <!-- <div>
        <iframe width='640' height='360' src='$trailer' frameborder='0' allowfullscreen/>
      </div> -->