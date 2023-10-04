<?php

require_once(dirname(__DIR__,2).'/define.php');
require_once(BASE_DIR.'/views/includes/header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ini Login </title>
  <link rel="stylesheet" type="text/css"" href="../../public/style/global.css">
  <link rel="stylesheet" type="text/css"" href="../../public/style/login.css">
  <script src='/public/handler/navbar.js'></script>
</head>
<body>


 <div class="menuLogin">
   <form action="/api/auth/login.php" method="post" class="form">
     <label class="form-label" for="username">Username</label>
     <input 
      type="text" 
      name="username"
      id="username"
      class="form_input" 
      placeholder="Enter your username"
      required>

     <label class="form-label" for="password">Password</label>
     <input 
     type="password" 
     name="password" 
     id="password"
     class="form_input" 
     placeholder="Enter your password"
     required>

     <input type="submit" class="login-btn" value="LOGIN">
   </form>


   <div class="form-label"> Does not have an account yet? </div>

   <a href='/?signup' style="width:100%; display:flex; justify-content:center; align-items:center">
      <button type="submit" class="signup-btn">
        SIGN UP 
      </button>
    </a>

 </div>
    
  <?php
    if (isset($_SESSION['error'])) {
      echo $_SESSION['error'];
      unset($_SESSION['error']);
    }
  ?>

</body>
</html>
