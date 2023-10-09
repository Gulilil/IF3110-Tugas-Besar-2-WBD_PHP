<?php 

require_once(dirname(__DIR__,2).'/define.php');
require_once(BASE_DIR.'/views/includes/header.php');
require_once(BASE_DIR.'/models/Client.php');
require_once(BASE_DIR.'/models/Anime.php');
require_once(BASE_DIR.'/models/Anime_List.php');

$a = new Anime();
$c = new Client();
$al = new Anime_List();

$id = $data['id'];
$list = $al->getAnimeListByID($data['id']);
$client = $c->getClientByID($list['client_id']);
$anime = $a->getAnimeByID($list['anime_id']);
$cid = $client['client_id'];
$aid = $anime['anime_id'];

$isUserOwn = $list['client_id'] == $c->getClientByUsername($_SESSION['username'])['client_id'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anime List Page</title>
    <link rel="stylesheet" href="../../public/style/global.css">
    <link rel="stylesheet" href="../../public/style/list.css">
    <script src='/public/handler/navbar.js'></script>
    <script src='/public/handler/animeList.js'></script>
</head>

<body>
  <?php
  if ($isUserOwn){
    echo "
    <div class='container'> 
      <h1> Anime List ID $id </h1>
      <h2>
        Client: $client[username] <br>
        Anime: $anime[title]
      </h2>
      <form class='form-vertical' action='/api/anime_list/edit.php' method='post' enctype='multipart/form-data'>
          <input type='hidden' id='editListId' name='list_id' value=$id>
          <input type='hidden' id='editClientId' name='client_id' value=$client[client_id]>
          <input type='hidden' id='editAnimeId' name='anime_id' value=$anime[anime_id]>

          <label for='editUserScore'>User Score</label>
          <input type='number' id='editUserScore' name='user_score' min='1' max='10' value='$list[user_score]' required>

          <label for='editProgress'>Progress:</label>
          <input type='number' id='editProgress' name='progress' min='1' max=$anime[episodes] value='$list[progress]' required>

          <label for='editWatchStatus'>Watch Status:</label>
          <select id='editWatchStatus' name='watch_status'>
          <option value='WATCHING'" . ($list['watch_status'] == 'WATCHING' ? " selected" : "") . ">Watching</option>
          <option value='COMPLETED'" . ($list['watch_status'] == 'COMPLETED' ? " selected" : "") . ">Completed</option>
          <option value='ON-HOLD'" . ($list['watch_status'] == 'ON-HOLD' ? " selected" : "") . ">On Hold</option>
          <option value='DROPPED'" . ($list['watch_status'] == 'DROPPED' ? " selected" : "") . ">Dropped</option>
          <option value='PLAN TO WATCH'" . ($list['watch_status'] == 'PLAN TO WATCH' ? " selected" : "") . ">Plan to Watch</option>
          </select>

          <label for='editReview'>Review:</label>
          <textarea id='editReview' name='review' placeholder='Review'>$list[review]</textarea>

          <input type='submit' value='Update Client'>
      </form>
      <div class='button-container'>
        <a href='/?client/detail/$cid' >
          <button class='back-button' > Go Back </button>
        </a>
        <a href='/?anime/detail/$aid' >
          <button class='anime-button'> Anime Page </button>
        </a>
        <form action='/api/anime_list/delete.php' method='post' >
          <input type='hidden' id='anime_id' name='anime_id' value='$aid'>
          <input type='hidden' id='client_id' name='client_id' value='$cid'>
          <input type='hidden' id='source_page' name='source_page' value='profile'>
          <button type='submit' class='delete-button'> Delete List </button>
        </form>
      </div>
    </div>
    ";
  } else {
    echo "
    <div class='not-own'>
      <h2> The list is not your own </h2>
      <div style='color:#a2a2a2'> You can only edit the list of your own </div>
      <a href='/'>
      <div class='back-button'> Go back </div>
      </a>
    </div>
    ";
  }

  ?>
</body>
</html>

<?php
require_once(BASE_DIR.'/views/includes/footer.php');
?>

