<?php 

require_once(dirname(__DIR__,2).'/define.php');
require_once(BASE_DIR.'/views/includes/header.php');
require_once(BASE_DIR.'/models/Client.php');
require_once(BASE_DIR.'/models/Anime_List.php');

$c = new Client();
$al = new Anime_List();

$id = $data['id'];
$isUserOwn = $al->getAnimeListByID($id)['client_id'] == $c->getClientByUsername($_SESSION['username'])['client_id'];

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
</head>

<body>
  <?php
  if ($isUserOwn){
    echo "
      <h1> Anime List ID $id </h1>
      <form class='form-vertical' action='/api/anime_list/edit.php' method='post' enctype='multipart/form-data'>
          <!-- Hidden input for client_id -->
          <input type='hidden' id='editClientId' name='client_id'>

          <label for='editUserScore'>User Score</label>
          <input type='text' id='editUserScore' name='user_score'>

          <label for='editProgress'>Progress:</label>
          <input type='text' id='editProgress' name='progress'>

          <label for='editWatchStatus'>WatchStatus:</label>
          <input type='text' id='editWatchStatus' name='watch_status' required>

          <label for='editReview'>Review:</label>
          <input type='text' id='editReview' name='review'>


          <input type='submit' value='Update Client'>
      </form>
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