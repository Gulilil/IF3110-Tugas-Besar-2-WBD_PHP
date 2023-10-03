<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<div class="container">
      <div class="signup-container">
        <h2 class="header-subtitle">Sign up for free.</h2>
        <form action="/api/auth/signup.php" method="post">
          <div class="form-group">
            <label for="username">Create an username.</label>
            <input
              class="signup-input"
              type="text"
              name="username"
              id="username"
              onchange="checkUsername()"
              placeholder="Enter your desired username."
              required
            />
            <p id="username-error"></p>
          </div>
          <div class="form-group">
            <label for="email">What's your email?</label>
            <input
              class="signup-input"
              type="email"
              name="email"
              id="email"
              placeholder="Enter your email."
              onchange="checkEmail()"
              required
            />
            <p id="email-error"></p>
          </div>
          <div class="form-group">
            <label for="password">Create a password.</label>
            <input
              class="signup-input"
              type="password"
              name="password"
              id="password"
              onchange="checkPassword()"
              placeholder="Create a password."
              required
            />
            <p id="password-error"></p>
          </div>
          <div class="form-group">
            <label for="confirm-password">Confirm your password.</label>
            <input
              class="signup-input"
              type="password"
              name="confirm-password"
              id="confirm-password"
              onchange="checkPassword()"
              placeholder="Enter your password again."
            />
            <p id="confirm-password-error"></p>
          </div>

          <div class="button-container">
            <button type="submit" class="signup-button" id="signup-button" disabled>Sign up</button>
          </div>
          
        </form>
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