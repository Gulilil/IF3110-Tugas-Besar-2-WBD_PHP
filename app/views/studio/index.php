<?php 

require_once(dirname(__DIR__,2).'/define.php');
require_once(BASE_DIR.'/views/includes/header.php');
require_once(BASE_DIR.'/models/Studio.php');
require_once(BASE_DIR.'/models/Anime.php');

$s = new Studio();
$a = new Anime();

$page = 1;
$limitPerPage = 12;

$path = $data['path'];
$temp = explode('=', $path);
$page = $temp[1];

$count = count($s->getAllStudio());
$maxPage = ceil($count/$limitPerPage);
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
      $studios = $s->getAllStudioLimit($limitPerPage, ($page-1)*$limitPerPage);
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

  <div class='button-container'>
  <?php
    $prevPage = $page == 1? 'page=1' : 'page='.$page-1;
    $nextPage = $page == $maxPage ? 'page='.$maxPage : 'page='.$page+1;
    $new_url = '/?studio/';
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