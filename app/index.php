<?php


require_once 'models/Database.php';
require_once 'models/Controller.php';
require_once 'models/App.php';
require_once 'setup/setup.php';
require_once 'setup/seed.php';

if(!session_id()) session_start();
(new Database())->migrate();
$app = new App;

// // Ini fungsinya cukup dinyalain sekali ajaa
// // Abis itu buka /setup/seed.php di browser, kalo udah ada tulisan 'Seeding success', comment lagi
// seedAllData();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>InfoAnimeMasse</title>
</head>
<body>
</body>
</html>
