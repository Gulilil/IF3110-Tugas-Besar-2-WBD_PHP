<?php 

require_once(dirname(__DIR__,2).'/define.php');
require_once(BASE_DIR.'/views/includes/header.php');
require_once(BASE_DIR.'/models/Anime.php');

$a = new Anime();
$limitPerPage = 12;
$path = $data['path'];
$temp = explode('=', $path);
$page = $temp[1];

$count = count($a->getAllAnimeWithTrailer());
$maxPage = ceil($count/$limitPerPage);
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
    <div class='trailer-box'> 
      <div class='trailer-title' id='trailer-title'> HEHEHE </div> 
      <!-- <video class='anime-trailer-iframe' controls>
        <source id='anime-trailer-iframe' src=''>
      </video>; -->
      <iframe class='anime-trailer-iframe' id='anime-trailer-iframe' src='' autoplay='false' allowfullscreen></iframe>
    </div>
  </div>

  <div class="flex-wrap">
    <?php
      $animes = $a->getAllAnimeWithTrailerLimit($limitPerPage, ($page-1)*$limitPerPage);
      foreach($animes as $anime){
        $year = date('Y', strtotime($anime['release_date'])) ?? '';
        $image = $anime['image'] ?? '../../public/img/placeholder.jpg';
        $arr = explode('/', $anime['trailer']);
        $trailer = htmlspecialchars($anime['trailer']);
        echo "
        <div class='container'>
          <div class='box-preview' onclick=\"displayTrailer('$trailer', '$anime[title]')\">
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

  <div class='button-container'>
  <?php
    $prevPage = $page == 1? 'page=1' : 'page='.$page-1;
    $nextPage = $page == $maxPage ? 'page='.$maxPage : 'page='.$page+1;
    $new_url = '/?trailer/';
    $prev_url = $new_url.$prevPage;
    $next_url = $new_url.$nextPage;
    echo "
      <a href='$prev_url'>
        <img class='page-arrow' id='left-arrow' src='/public/img/left_arrow_icon.png' alt='Left Arrow' />
      </a>
      <div class='page-number'> ".$page." / ".$maxPage." </div>
      <a href='$next_url'>
        <img class='page-arrow' id='right-arrow' src='/public/img/right_arrow_icon.png' alt='Right Arrow' />
      </a>
    ";
    
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