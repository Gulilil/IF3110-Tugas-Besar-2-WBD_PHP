<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>
  <script src="/public/handler/signup.js" ></script> 
  <script src='/public/handler/navbar.js'></script>
</head>
<body>
<div class="container">
      <div class="signup-container">
        <h2 class="header-subtitle">Sign up for free.</h2>
        <form action="/api/auth/signup.php" method="post">
          <div class="form-group">
            <label for="email">E-mail</label>
            <input
              class="signup-input"
              type="email"
              id="email"
              name="email"
              placeholder="Enter your email."
              onkeyup="checkEmail()"
              required
            />
            <p id="email-errmsg"></p>
          </div>

          <div class="form-group">
            <label for="username">Username</label>
            <input
              class="signup-input"
              type="text"
              id="username"
              name="username"
              onkeyup="checkUsername()"
              placeholder="Enter your username."
              required
            />
            <p id="username-errmsg"></p>
          </div>

          <div class="form-group">
            <label for="password">Password</label>
            <input
              class="signup-input"
              type="password"
              id="password"
              name="password"
              onkeyup="checkPassword()"
              placeholder="Create a password."
              required
            />
            <p id="password-errmsg"></p>
          </div>

          <button type="submit" class="signup-button" id="signup-button" disabled>Sign up</button>          
        </form>
        <?php
            if (isset($_SESSION['error'])) {
              echo $_SESSION['error'];
              unset($_SESSION['error']);
            }
          ?>
        <p class="login">Have an account?
          <span
            class="login-text"
            onclick="window.location.href='/?login'"
          >
            Login
          </span>
        </p>
        <!-- <button class="login-button" onclick="window.location.href='/?login'">
          Log in
        </button> -->
      </div>
    </div>
</body>
</html>