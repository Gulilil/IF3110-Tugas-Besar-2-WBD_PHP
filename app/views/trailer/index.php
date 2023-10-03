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
</head>

<body>
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
</html>

<?php
require_once(BASE_DIR.'/views/includes/footer.php');
?>