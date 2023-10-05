<?php 

require_once(dirname(__DIR__,2).'/define.php');
require_once(BASE_DIR.'/views/includes/header.php');
require_once(BASE_DIR.'/models/Client.php');

$c = new Client();
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
  <div class='client-container'>
    <div class='image-box'>
    </div>
    <div class=''>
    </div>
  </div>
</body>
</html>

<?php
require_once(BASE_DIR.'/views/includes/footer.php');
?>