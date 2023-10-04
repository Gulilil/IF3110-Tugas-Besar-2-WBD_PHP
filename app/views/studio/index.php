<?php 

require_once(dirname(__DIR__,2).'/define.php');
require_once(BASE_DIR.'/views/includes/header.php');
require_once(BASE_DIR.'/models/Studio.php');
require_once(BASE_DIR.'/models/Anime.php');

$s = new Studio();
$a = new Anime();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Studio List Page</title>
    <link rel="stylesheet" href="../../public/style/global.css">
    <link rel="stylesheet" href="../../public/style/studio.css">    
    <script src='/public/handler/navbar.js'></script>
</head>

<body>
  <div class="flex-wrap">
    <?php
      $studios = $s->getAllStudio();
      foreach($studios as $studio){
        $anime_count = count($a->getAllAnimeByStudioID($studio['studio_id']));
        $year = $studio['established_date'] ?? 'No information';
        $image = $studio['image'] ?? '../../public/img/placeholder.jpg';
        echo "
        <a href='/?studio/detail/$studio[studio_id]'>
          <div class='container'>
            <div class='box-preview'>
              <img src='$image' class='image-preview'/>
            </div>
            <div class='description'>
              <div class='studio-name'> $studio[name] </div>
              <div> ($year) </div>
              <div> Anime produced: $anime_count </div>
            </div>
          </div>
        </a>

        ";
      }
    ?>
  </div>
</body>
</html>

<?php
require_once(BASE_DIR.'/views/includes/footer.php');
?>