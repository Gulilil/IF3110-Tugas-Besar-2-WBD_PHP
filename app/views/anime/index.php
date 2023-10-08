<?php 

require_once(dirname(__DIR__,2).'/define.php');
require_once(BASE_DIR.'/views/includes/header.php');
require_once(BASE_DIR.'/models/Anime.php');
require_once(BASE_DIR.'/models/Genre.php');
require_once(BASE_DIR.'/models/Studio.php');

$a = new Anime();
$s = new Studio();
$g = new Genre();
$path = $data['path'];

$genreFilter = null;
$typeFilter = null;
$statusFilter = null;
$ratingFilter = null;
$studioFilter = null;
$sortColumn = null;
$desc = null;
$page = 1;
$limitPerPage = 12;

$filter = explode('&', $path);
foreach($filter as $f){
  $temp = explode('=', $f);
  if ($temp[0] == 'genre'){
    $genreFilter = $temp[1];
  }
  else if ($temp[0] == 'type'){
    $typeFilter = $temp[1];
  }
  else if ($temp[0] == 'status'){
    $statusFilter = $temp[1];
  }
  else if ($temp[0] == 'rating'){
    $ratingFilter = $temp[1];
  }
  else if ($temp[0] == 'studio'){
    $studioFilter = $temp[1];
  }
  else if ($temp[0] == 'page'){
    $page = (int) $temp[1];
  }
  else if ($temp[0] == 'sort'){
    $sortArr = explode('.', $temp[1]);
    $sortColumn = $sortArr[0];
    $desc = $sortArr[1] == 'desc' ? true : false;
  }
}


$animes = $a->getAllAnimeWithFilter(
  $genreFilter, 
  $typeFilter, 
  $statusFilter, 
  $ratingFilter, 
  $studioFilter, 
  $sortColumn, 
  $desc,
  $limitPerPage,
  ($page-1) * $limitPerPage
);

$totalAnime = 
count($a->getAllAnimeWithFilter(
  $genreFilter, 
  $typeFilter, 
  $statusFilter, 
  $ratingFilter, 
  $studioFilter, 
  $sortColumn, 
  $desc,
  null,
  null
));
$maxPage = ceil($totalAnime/$limitPerPage);

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anime List Page</title>
    <link rel="stylesheet" href="../../public/style/global.css">
    <link rel='stylesheet' href="../../public/style/anime.css">
    <script src='/public/handler/navbar.js'></script>
    <script src='/public/handler/anime.js'></script>
</head>

<body>
  <div class="filter-flex"> 
    <form action='/api/anime/filter.php' method='post' class='filter-part'> 
      <div class="filter-block">
        <label class='filter-label' for='filter-genre'>Genre </label>
        <select class='filter-select' id='filter-genre' name='filter-genre' placeholder='Genre'>
          <?php 
            $genres = $g->getAllGenre();
            echo "<option value='Any'> Any </option>";
            foreach($genres as $genre){
              echo "
                <option value=$genre[name]> $genre[name] </option>
              ";
            }
          ?>
        </select>
      </div>

      <div class="filter-block">
        <label class='filter-label' for='filter-type'>Type </label>
        <select class='filter-select' id='filter-type' name='filter-type' placeholder='Type'>
          <option value='Any'> Any </option>
          <option value="TV">TV</option>
          <option value="MOVIE">Movie</option>
          <option value="OVA">OVA</option>
        </select>
      </div>

      <div class="filter-block">
        <label class='filter-label' for='filter-status'>Status </label>
        <select class='filter-select' id='filter-status' name='filter-status' placeholder='Status'>
          <option value='Any'> Any </option>  
          <option value="ON-GOING">On Going</option>
          <option value="COMPLETED">Completed</option>
          <option value="HIATUS">Hiatus</option>
          <option value="UPCOMING">Upcoming</option>
        </select>
      </div>

      <div class="filter-block">
        <label class='filter-label' for='filter-rating'>Rating </label>
        <select class='filter-select' id='filter-rating' name='filter-rating' placeholder='Rating'>
          <option value='Any'> Any </option>  
          <option value="G">G</option>
          <option value="PG-13">PG-13</option>
          <option value="R(17+)">R(17+)</option>
          <option value="Rx">Rx</option>
        </select>
      </div>

      <div class="filter-block">
        <label class='filter-label' for='filter-studio'>Studio </label>
        <select class='filter-select' id='filter-studio' name='filter-studio' placeholder='Studio'>
          <?php 
              $studios = $s->getAllStudio();
              echo "<option value='Any'> Any </option>";
              // Special for studio, use Studio ID
              foreach($studios as $studio){
                echo "
                  <option value=$studio[studio_id]> $studio[name] </option>
                ";
              }
          ?>
        </select>
      </div>

      <div class="filter-block">
        <label class='filter-label' for='filter-sort'>Sort </label>
        <select class='filter-select' id='filter-sort' name='filter-sort' placeholder='Sort'>
          <option value='Any'> None </option>  
          <option value="title.asc">Title Ascending</option>
          <option value="title.desc">Title Descending</option>
          <option value="score.asc">Score Ascending</option>
          <option value="score.desc">Score Descending</option>
          <option value="release_date.asc">Release Date Ascending</option>
          <option value="release_date.desc">Release Date Descending</option>
        </select>
      </div>
      
      <input class='filter-submit-btn' type='submit' value='Submit Filter'>
    </form>
    <div class='search-part'> 
      <div class='search-bar'>
        <input class='search-bar' id='search-bar' type='text' onkeyup='handleSearch()' placeholder='Search...'>
      </div>
    </div>
  </div>

  <div class="flex-wrap">
    <?php
      foreach($animes as $anime){
        $year = date('Y', strtotime($anime['release_date'])) ?? '';
        $month = date('M', strtotime($anime['release_date'])) ?? '';
        $image = $anime['image'] ?? '../../public/img/placeholder.jpg';
        $score = ((float) $anime['score']) != 0.0 ? $anime['score'].' ★' : "Has not been scored";
        echo "
        <div class='container'>
          <a href='/?anime/detail/$anime[anime_id]'>
            <div class='box-preview'>
              <img src='$image' class='image-preview'/>
            </div>
          </a>
          <div class='description'>
            <a href='/?anime/detail/$anime[anime_id]'>
              <div class='preview-title'> $anime[title] </div>
            </a>
            <div> $score | $month $year </div>
            <div> $anime[type] | $anime[status] </div>
          </div>
        </div>

        ";
      }
    ?>
  </div>
  <div class='button-container'>
  <?php
    array_pop($filter);
    $prevPage = $page == 1? 'page=1' : 'page='.$page-1;
    $nextPage = $page == $maxPage ? 'page='.$maxPage : 'page='.$page+1;
    $new_url = '/?anime/';
    $first = true;
    foreach($filter as $f){
      if ($first){
        $first = false;
        $new_url = $new_url.$f;
      } else {
        $new_url = $new_url.'&'.$f;
      }
    }
    $prev_url = $first ? $new_url.$prevPage : $new_url.'&'.$prevPage;
    $next_url = $first ? $new_url.$nextPage : $new_url.'&'.$nextPage;
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

<?php
require_once(BASE_DIR.'/views/includes/footer.php');
?>