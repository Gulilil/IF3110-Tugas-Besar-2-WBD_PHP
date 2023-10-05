<?php 

require_once(dirname(__DIR__,2).'/define.php');
require_once(BASE_DIR.'/views/includes/header.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error Page</title>
    <link rel="stylesheet" href="../../public/style/global.css">
    <link rel="stylesheet" href="../../public/style/error.css">
    <script src='/public/handler/navbar.js'></script>
</head>

<body>
  <div class='container'>
    <div class='image-box'>
      <img class='image' src='/public/img/lost_icon.png' alt='Lost icon'/>
    </div>
    <div class='description'>
      <div style='font-size:24px; font-weight:bold'> Oh no! You have lost! </div>
      <div> The page you are searching for does not exist! </div>
      <a href='/'>
        <div class='back-button'> Go back </div>
      </a>
    </div>
  </div>
</body>
</html>

<?php
require_once(BASE_DIR.'/views/includes/footer.php');
?>