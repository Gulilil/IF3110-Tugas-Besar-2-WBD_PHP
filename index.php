<?php

require_once(dirname(__DIR__,2).'/define.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ini Login </title>
  <link rel="stylesheet" type="text/css"" href="style.css">
</head>
<body>
<h1 class="logo">InfoAnimeMasse</h1>

<nav class="navbar">
<ul>
<li class"nav"><a href="#">Home</a></li>
<li class"nav"><a href="#">Anime</a></li>
<li class"nav"><a href="#">Studio</a></li>
<li class"nav"><a href="#">Genre</a></li>
<li class"nav"><a href="#">Trailer</a></li>

<li class="search">
      <input type="text" name="search Anime" id="search_anime" placeholder="Search Anime"/>
      <input type="button" name="search_button" id="tombol" href="">
</li>

<li class="L"><a href="">Login</a></li>
<li class="L"> <a href="">Sign Up</a></li>
</ul>


</nav>

<h1 class="Log">Ini Login</h1>
 
 <div class="menuLogin">

   
   <form>
   <a href="" class="google">Google</a>
    <a href="" class="fb" >Facebook</a>
    <br>
    <br>
    <a href=""  class="X">Twitter</a>
    <a href="" class="Apple">Apple</a>
    <br>
    <br>
     <label>Username or E-mail</label>
     <input type="text" name="username-Email" class="form_login" placeholder="Username atau email ..">

     <label>Password</label>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
     <input type="checkbox" onclick="myFunction()">  Show Password
     <input type="text" name="password" class="form_logen" placeholder="Password ..">
     <input type="checkbox"  class="stay" >Stay logged in ?&emsp;&emsp;&emsp;&emsp;
     <a href="">Forget Password ?</a>

     <input type="submit" class="tombol_login" value="LOGIN">
   

     <br/>
     <br/>
     <center>
     <input type="submit" class="tombol_login" value="SIGN UP">
     </center>
   </form>
   
 </div>
    
  





  <!-- <form action="/api/auth/login.php" method="post">
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
  </form> -->

  <?php
    if (isset($_SESSION['error'])) {
      echo $_SESSION['error'];
      unset($_SESSION['error']);
    }
  ?>

  <!-- <p class="signup">Don't have an account?
    <span onclick="window.location.href='/signup'"
      class="signup-text"
    >
      Sign Up
    </span>
  </p>-->
</body>
</html>
