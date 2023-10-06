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
    <title>Error Page</title>
    <link rel="stylesheet" href="../../public/style/global.css">
    <link rel="stylesheet" href="../../public/style/list.css">
    <script src='/public/handler/navbar.js'></script>
</head>

<body>
  <?php
  if ($isUserOwn){
    echo "
      <h1> Anime List ID $id </h1>
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