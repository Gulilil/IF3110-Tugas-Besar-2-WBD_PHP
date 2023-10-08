<?php
require_once(dirname(__DIR__,2).'/define.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>
  <link rel="stylesheet" type="text/css"" href="../../public/style/global.css">
  <link rel="stylesheet" type="text/css"" href="../../public/style/login.css">
  <script src="/public/handler/signup.js" ></script> 
  <script src='/public/handler/navbar.js'></script>
</head>
<body>
    <div class='background-container'>
      <img class='background' src='/public/img/signup_bg.jpg' alt='Signup Wallpaper'/>
    </div>
    <div class='page-container'>
      <div class="menu-signup">
          <h2 class="header-subtitle"> Sign up for free </h2>
          <form action="/api/auth/signup.php" method="post" class='form'>
            <div class="form-group">
              <label  class='form-label' for="email">E-mail</label>
                <input
                class='form-input'
                type='email'
                id='email'
                name='email'
                placeholder='Enter your email.'
                onkeyup='checkEmail()'
                required
              />


              <div id="email-errmsg" class='form-err-message'></div>
            </div>

            <div class="form-group">
              <label class='form-label' for="username">Username</label>
              <input
                class="form-input"
                type="text"
                id="username"
                name="username"
                onkeyup="checkUsername()"
                placeholder="Enter your username."
                required
              />
              <div id="username-errmsg" class='form-err-message'></div>
            </div>

            <div class="form-group">
              <label class='form-label' for="password">Password</label>
              <input
                class="form-input"
                type="password"
                id="password"
                name="password"
                onkeyup="checkPassword()"
                placeholder="Create a password."
                required
              />
              <div id="password-errmsg" class='form-err-message'></div>
            </div>

            <?php
              if (isset($_SESSION['error'])) {
                echo "
                  <div class='err-message'> $_SESSION[error] </div>
                ";
                unset($_SESSION['error']);
              }
            ?>

            <button type="submit" class="signup-button" id="signup-button" disabled>SIGN UP</button>          
          </form>

          <div class="form-label"> Already have an account? </div>
          <a href='/?login' style="width:100%; display:flex; justify-content:center; align-items:center">
            <button type="submit" class="login-button">
              LOGIN
            </button>
          </a>
          <a href='/' style="width:100%; display:flex; justify-content:center; align-items:center; margin:5px 0px;">
          <button type="submit" class="home-button">
            BACK TO HOME
          </button>
        </a>
      </div>
    </div>
</body>
</html>