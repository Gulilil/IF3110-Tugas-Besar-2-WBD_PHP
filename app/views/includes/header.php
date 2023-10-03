
<div >
  <div class='upper-navbar'>
      <a href='/?home'>
        <div class="logo"> InfoAnimeMasse </div>
      </a>    
  </div>
  <div class="navbar">
      <ul class="nav-links">

      <?php 
      if (isset($_SESSION['admin_status'])){
        if ($_SESSION['admin_status']){
          echo '
          <li><a href="/?anime">Anime</a></li>
          <li><a href="/?genre">Genre</a></li>
          <li><a href="/?studio">Studio</a></li>
          <li><a href="/?trailer">Trailer</a></li>
          <li><a href="/?admin">Admin</a></li>
          ';
        } else {
          echo '
          <li><a href="/?anime">Anime</a></li>
          <li><a href="/?genre">Genre</a></li>
          <li><a href="/?studio">Studio</a></li>
          <li><a href="/?trailer">Trailer</a></li>
          ';
        }
      }

      ?>
      </ul>

      <div class="search-bar">
          <input type="text" placeholder="Search Anime/Genre/Studi/Trailer">
      </div>
      
      <div class='navbar-buttons'>
        <a href="/?client" >
          <button class="client-btn">
            <img  src="../../public/img/client_icon.png" alt="Client Button" width="30" height="30"/>
          </button>
        </a>
        <a href="/api/auth/logout.php" >
          <button class="logout-btn" type="submit">
            <img src="../../public/img/logout_icon.png" alt="Logout Button" width='30' height='30' />
          </button>
        </a>
      </div>

  </div>
</div>

