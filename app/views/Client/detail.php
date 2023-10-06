<?php 

require_once(dirname(__DIR__,2).'/define.php');
require_once(BASE_DIR.'/views/includes/header.php');
require_once(BASE_DIR.'/models/Client.php');
require_once(BASE_DIR.'/models/Anime_List.php');

$c = new Client();
$al = new Anime_List();
$id = $data['id'];
$client = $c->getClientByID($id);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error Page</title>
    <link rel="stylesheet" href="../../public/style/global.css">
    <link rel="stylesheet" href="../../public/style/client.css">
    <script src='/public/handler/navbar.js'></script>
</head>

<body>
  <div class='client-big-container'>
    <div class='client-left-container'>
      <div class='client-main-container'>
        <div class='client-image-box'>
          <?php
            $image = $client['image'] ?? '/public/img/placeholder.jpg';
            echo "
              <img class='client-image' src='$image' alt='Client Image'/>
            ";
          ?>
        </div>
        <div class='client-description'>
          <?php
            echo"
              <div class='client-username'> $client[username] </div>
              <div class='client-email'> $client[email]</div>
              <div class='client-id'> Client ID: $client[client_id] </div>
            ";
          ?>
        </div>
      </div>

      <div class='client-info-container'>
        <?php
        $clientType = $client['admin_status'] ? "Admin" : "User";
        $clientTypeColor = $client['admin_status'] ? "red" : "blue";
        $birthdate = $client['birthdate'] ?? "No information";
        $bio = $client['bio'] ?? "No information";
        $avgScore = $al->getAverageUserScoreByClientID($id)['avg']? $al->getAverageUserScoreByClientID($id)['avg'].' / 10 ★' : "Have not been scoring";
        echo "
          <div class='client-info-aspect'> Admin Status </div>
          <div style=\"color:$clientTypeColor; font-weight:bold\"> $clientType </div>
          <div class='client-info-aspect'> Birthdate </div>
          <div> $birthdate </div>
          <div class='client-info-aspect'> Anime List Amount </div>
          <div> 9 </div>
          <div class='client-info-aspect'> Average Anime Scoring </div>
          <div> $avgScore</div>
        ";
        ?>
      </div>
    </div>
  </div>  
</body>
</html>

<?php
require_once(BASE_DIR.'/views/includes/footer.php');
?>