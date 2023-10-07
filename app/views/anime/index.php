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
$animes = $a->getAllAnime();

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
            echo "<option value=null> Any </option>";
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
          <option value=null> Any </option>
          <option value="TV">TV</option>
          <option value="MOVIE">Movie</option>
          <option value="OVA">OVA</option>
        </select>
      </div>

      <div class="filter-block">
        <label class='filter-label' for='filter-status'>Status </label>
        <select class='filter-select' id='filter-status' name='filter-status' placeholder='Status'>
          <option value=null> Any </option>  
          <option value="ON-GOING">On Going</option>
          <option value="COMPLETED">Completed</option>
          <option value="HIATUS">Hiatus</option>
          <option value="UPCOMING">Upcoming</option>
        </select>
      </div>

      <div class="filter-block">
        <label class='filter-label' for='filter-rating'>Rating </label>
        <select class='filter-select' id='filter-rating' name='filter-rating' placeholder='Rating'>
          <option value=null> Any </option>  
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
              echo "<option value=null> Any </option>";
              foreach($studios as $studio){
                echo "
                  <option value=$studio[name]> $studio[name] </option>
                ";
              }
          ?>
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
</body>

<?php
require_once(BASE_DIR.'/views/includes/footer.php');
?>