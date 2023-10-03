<?php


require_once 'init.php';

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
