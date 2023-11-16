<?php 

require_once(dirname(__DIR__,2).'/define.php');
require_once(BASE_DIR.'/views/includes/header.php');
require_once(BASE_DIR.'/models/Client.php');
require_once(BASE_DIR.'/models/Anime.php');
require_once(BASE_DIR.'/models/Studio.php');

$c = new Client();
$a = new Anime();
$s = new Studio();
$path = $data['path'];
$arr = explode('/', $path)[0];
$page= explode('=', $arr)[1];
$limitPerPage = 20;
$totalAnime= count ($a->getAllAnime());
$maxPage = ceil($totalAnime/$limitPerPage);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page: Anime</title>
    <link rel="stylesheet" href="../../public/style/global.css">
    <link rel="stylesheet" href="../../public/style/admin.css">
    <script src='/public/handler/navbar.js'></script>
    <script src='/public/handler/admin.js'></script>
    <script src='/public/handler/reference.js'></script>
</head>

<body> 
  <?php  
    echo "<script type='text/javascript'> sendSelectAllLimit(".$limitPerPage.", ".($page-1)*$limitPerPage.") </script>";
  ?>     

    <div class="manage-header">
      
        <div class="menu">
          <a href="/?admin/client/page=1">
            <button class="menu-item">Client</button>
          </a>
          <a href="/?admin/anime/page=1">
            <button class="menu-item">Anime</button>
          </a>
          <a href="/?admin/studio/page=1">
            <button class="menu-item">Studio</button>
          </a>
          <a href="/?admin/reference/page=1">
            <button class="menu-item active">Reference</button>
          </a>
        </div>
    </div>

    <div class="container">
        <div class="content">
            <div class="manage-section">

                <div id="anime" class="table active-table">
                    <!-- Anime table goes here -->
                    <table>
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>anime_account_id</th>
                                <th>forum_account_id</th>
                                <th>referral_code</th>
                                <th>point</th>
                                <th>actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $animes = $a->getAllAnimeLimitOffset($limitPerPage, ($page-1)*$limitPerPage);
                            foreach($animes as $anime){
                                echo "
                                <tr>
                                    <td>$id</td>
                                    <td>$anime_account_id</td>
                                    <td>$forum_account_id</td>
                                    <td>$referral_code</td>
                                    <td>$point</td>
                                    <td>
                                        <div class='btn-container'>
                                        <button class='edit-btn'
                                            data-reference_id=$id
                                            data-anime-account-id=$anime_account_id
                                            data-forum-account-id=$forum_account_id
                                            data-referral-code='$referral_code'
                                            data-point'$point' ?? ''
                                            onclick='openEditReferenceModal(this)'>
                                            Edit
                                        </button>
                                        </div>
                                    </td>
                                </tr>
                                ";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div id="editReferenceModal" class="modal">
                    <div class="modal-content">
                        <span class="close-btn" onclick="closeEditReferenceModal('reference')">&times;</span>
                        <h2>Edit Reference</h2>

                        <form class="form-vertical" action="/api/reference/edit.php" method="post" enctype="multipart/form-data">
                            <!-- Hidden input for reference id -->
                            <input type="hidden" id="editReferenceId" name="referenceId">

                            <label for="editAnimeAccountID">Anime Account ID:</label>
                            <input type="number" id="editAnimeAccountId" name="animeAccountId" placeholder="AnimeAccountID" required>

                            <label for="editForumAccountID">Forum Account ID:</label>
                            <input type="number" id="editForumAccountId" name="forumAccountId" placeholder="DorumAccountID" required>

                            <input type="hidden" id="editReferralCode" name="referralCode">

                            <label for="editPoint">Point:</label>
                            <input type="number" id="editPoint" name="point" placeholder="Point">

                            <input type="submit" value="Update Reference">
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class='button-container'>
  <?php
    $prevPage = $page == 1? 'page=1' : 'page='.$page-1;
    $nextPage = $page == $maxPage ? 'page='.$maxPage : 'page='.$page+1;
    $new_url = '/?admin/reference/';

    $prev_url = $new_url.$prevPage;
    $next_url = $new_url.$nextPage;
    echo "
      <a href='$prev_url'>
        <img class='page-arrow' id='left-arrow' src='/public/img/left_arrow_icon.png' alt='Left Arrow' />
      </a>
      <div class='page-number'> ".$page." / ".$maxPage." </div>
      <a href='$next_url'>
        <img class='page-arrow' id='right-arrow' src='/public/img/right_arrow_icon.png' alt='Right Arrow' />
      </a>
    ";
    
    ?>
  </div>

</body>
</html>

<script>
    <?php if (isset($_SESSION['error_message'])): ?>
        window.onload = function() {
            alert('<?php echo $_SESSION['error_message']; ?>');
        };
        <?php unset($_SESSION['error_message']); // Clear the message so it doesn't persist ?>
    <?php endif; ?>
</script>

<?php
require_once(BASE_DIR.'/views/includes/footer.php');
?>