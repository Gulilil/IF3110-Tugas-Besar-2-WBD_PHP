<?php
require_once 'setup/setup.php';
require_once 'models/database.php';
require_once 'models/app.php';
(new Database())->migrate();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Basepage</title>
</head>
<body>
  <h1> Ini Basepage </h1>
</body>
</html>
