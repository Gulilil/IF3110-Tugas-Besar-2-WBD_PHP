<?php
require_once(dirname(__DIR__,2).'/define.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login </title>
  <link rel="stylesheet" type="text/css"" href="../../public/style/global.css">
  <link rel="stylesheet" type="text/css"" href="../../public/style/login.css">
  <script src='/public/handler/navbar.js'></script>
</head>
<body>
  <div class='background-container'>
    <img class='background' src='/public/img/login_bg.jpg' alt='Login Wallpaper'/>
  </div>
  <div class='page-container'>
    <div class="menu-login">
      <h2 class='header-subtitle'> Login to your account</h2>
      <form action="/api/auth/login.php" method="post" class="form">
          <div class='form-group'>
            <label class="form-label" for="username">Username:</label>
            <input 
              type="text" 
              name="username"
              id="username"
              class="form-input" 
              placeholder="Enter your username"
              required>
          </div>

          <div class='form-group'>
            <label class="form-label" for="password">Password:</label>
            <input 
            type="password" 
            name="password" 
            id="password"
            class="form-input" 
            placeholder="Enter your password"
            required>
          </div>

          <?php
            if (isset($_SESSION['error'])) {
              echo "
                <div class='err-message'> $_SESSION[error] </div>
              ";
              unset($_SESSION['error']);
            }
          ?>

        <input type="submit" class="login-button" value="LOGIN">
      </form>

      <div class="form-label"> Does not have an account yet? </div>
      <a href='/?signup' style="width:100%; display:flex; justify-content:center; align-items:center; margin:5px 0px;">
        <button type="submit" class="signup-button">
          SIGN UP 
        </button>
      </a>
      <a href='/' style="width:100%; display:flex; justify-content:center; align-items:center; margin:5px 0px;">
        <button type="submit" class="home-button">
          BACK TO HOME
        </button>
      </a>
    </div>
</body>
</html>
