<?php 

require_once(dirname(__DIR__,2).'/define.php');
require_once(BASE_DIR.'/views/includes/header.php');
require_once(BASE_DIR.'/models/Studio.php');

$s = new Studio();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Studio Page</title>
    <link rel="stylesheet" href="../../public/style/global.css">
    <link rel="stylesheet" href="../../public/style/studio.css">    
    <script src='/public/handler/navbar.js'></script>
</head>

<body>
  <div class="flex-wrap">
    <?php
      $studios = $s->getAllStudio();
      foreach($studios as $studio){
        $year = $studio['established_date'] ?? '';
        $image = $studio['image'] ?? '../../public/img/placeholder.jpg';
        echo "
        <div class='container'>
          <div class='box-preview'>
            <img src='$image' class='image-preview'/>
          </div>
          <div class='description'>
            <div class='studio-name'> $studio[name] </div>
            <div> ($year) </div>
          </div>
        </div>

        ";
      }
    ?>
  </div>
</body>
</html>

<?php
require_once(BASE_DIR.'/views/includes/footer.php');
?>