<?php

require_once(dirname(__DIR__,2).'/define.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
</head>
<body>
  <h2> Log into your account </h2>
  <form action="/api/auth/login.php" method="post">
    <div class="username-form">
      <label for="username">Username</label>
      <input
        class="login-input"
        type="text"
        name="username"
        id="username"
        placeholder="Enter your username"
        required
      /><br />
    </div>
    <div class="username-form">
      <label for="password">Password</label>
      <input
        class="login-input"
        type="password"
        name="password"
        id="password"
        placeholder="Enter your password"
        required
      />
    </div>
    <br />
    <button class="login-button" type="submit">Login</button>
  </form>

  <?php
    if (isset($_SESSION['error'])) {
      echo $_SESSION['error'];
      unset($_SESSION['error']);
    }
  ?>

  <p class="signup">Don't have an account?
    <span onclick="window.location.href='/?signup'"
      class="signup-text"
    >
      Sign Up
    </span>
  </p>
</body>
</html>