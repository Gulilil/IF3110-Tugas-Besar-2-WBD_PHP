<?php 

require_once(dirname(__DIR__,2).'/define.php');
require_once(BASE_DIR.'/models/Client.php');

$c = new Client();

?>

<div class='both-navbar-appear' id='navbar'>
  <div class='upper-navbar'>
    <a href='/'>
      <div class='logo'> InfoAnimeMasse </div>
    </a>   
  </div>

  <div class='navbar'>
    <div class='nav-links'>
      <div><a href='/'>Home</a></div>
      <div><a href='/?anime/page=1'>Anime</a></div>
      <div><a href='/?studio/page=1'>Studio</a></div>
      <div><a href='/?trailer/page=1'>Trailer</a></div>
    </div>

    <?php
    if (!isset($_SESSION['username'])){
      echo 
      "
      <div class='navbar-buttons'>
        <a href='/?login' >
          <div class='navbar-icon-btn'>
            <img  src='../../public/img/login_icon.png' alt='Login Button' width='30' height='30'/>
            <div class='navbar-icon-desc'> Login </div>
          </div>
        </a>
        <a href='/?signup' >
          <div class='navbar-icon-btn'>
            <img  src='../../public/img/signup_icon.png' alt='Signup Button' width='30' height='30'/>
            <div class='navbar-icon-desc'> Signup </div>
          </div>
        </a>
      </div>
      ";
    } else {
      $client = $c->getClientByUsername($_SESSION['username']);
      $id = $client['client_id'];

      if ($_SESSION['admin_status']){
        // Has logged in and an admin
        echo 
        "
        <div class='navbar-buttons'>
          <a href='/?admin/client/page=1' >
            <button class='navbar-icon-btn'>
              <img  src='../../public/img/admin_icon.png' alt='Admin Button' width='30' height='30'/>
              <div class='navbar-icon-desc'> Admin </div>
            </button>
          </a>
          <a href='/?client/detail/$id' >
            <button class='navbar-icon-btn'>
              <img  src='../../public/img/client_icon.png' alt='Client Button' width='30' height='30'/>
              <div class='navbar-icon-desc'> Profile </div>
            </button>
          </a>
          <a href='/api/auth/logout.php' >
            <button class='navbar-icon-btn'>
              <img src='../../public/img/logout_icon.png' alt='Logout Button' width='30' height='30' />
              <div class='navbar-icon-desc'> Logout </div>
            </button>
          </a>
        </div>
        ";
      } else {
        // Has logged in but not an admin
        echo 
        "
        <div class='navbar-buttons'>
          <a href='/?client/detail/$id' >
            <button class='navbar-icon-btn'>
              <img  src='../../public/img/client_icon.png' alt='Client Button' width='30' height='30'/>
              <div class='navbar-icon-desc'> Profile </div>
            </button>
          </a>
          <a href='/api/auth/logout.php' >
            <button class='navbar-icon-btn'>
              <img src='../../public/img/logout_icon.png' alt='Logout Button' width='30' height='30' />
              <div class='navbar-icon-desc'> Logout </div>
            </button>
          </a>
        </div>
        ";
      }
    }
    ?>
  </div>
</div>

