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
$totalClient= count ($c->getAllClient());
$maxPage = ceil($totalClient/$limitPerPage);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page: Client</title>
    <link rel="stylesheet" href="../../public/style/global.css">
    <link rel="stylesheet" href="../../public/style/admin.css">
    <script src='/public/handler/navbar.js'></script>
    <script src='/public/handler/admin.js'></script>
</head>

<body>      

    <div class="manage-header">
        <div class="menu">
          <a href="/?admin/client/page=1">
            <button class="menu-item active" 
                onclick="showTable('client'); setActiveMenuItem('client')">Client</button>
          </a>
          <a href="/?admin/anime/page=1">
            <button class="menu-item" 
                onclick="showTable('anime'); setActiveMenuItem('anime')">Anime</button>
          </a>
          <a href="/?admin/studio/page=1">
            <button class="menu-item" 
            onclick="showTable('studio'); setActiveMenuItem('studio')">Studio</button>
          </a>
        </div>

        <button class="add-btn" onclick="openAddModal('client')">Add</button>

        <div id="addClientModal" class="modal">
            <div class="modal-content">
                <span class="close-btn" onclick="closeAddModal('client')">&times;</span>
                <h2>Add New Client</h2>

                <form class="form-vertical" action="/api/client/add.php" method="post" enctype="multipart/form-data">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" placeholder="Username" required>

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" placeholder="Email" required>

                    <label for="password">Password:</label>
                    <input type="text" id="password" name="password" placeholder="Password" required>

                    <label for="admin_status">Status:</label>
                    <select id="admin_status" name="admin_status">
                        <option value="false">Client</option>
                        <option value="true">Admin</option>
                    </select>

                    <label for="birthdate">Birthdate:</label>
                    <input type="date" id="birthdate" name="birthdate">

                    <label for="bio">Biography:</label>
                    <textarea name="bio" id="bio" placeholder="Biography"></textarea>

                    <label for="image">Picture:</label>
                    <input type="file" id="image" name="image">

                    <input type="submit" value="Add Client">
                </form>

            </div>
        </div>

    </div>

    <div class="container">
        <div class="content">

            <div class="manage-section">
                <div id="client" class="table active-table">
                    <!-- Client table goes here -->
                    <table>
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>username</th>
                                <th>email</th>
                                <th>password</th>
                                <th>admin</th>
                                <th>birthdate</th>
                                <th>biography</th>
                                <th>image</th>
                                <th>actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $clients = $c->getAllClientLimitOffset(20,($page-1)*20);
                            foreach($clients as $client){
                                $date = $client['birthdate'] ?? '-';
                                $bio = $client['bio'] === '' ? '-' : $client['bio'];
                                $image = is_null($client['image']) ? '-' : str_replace('/', '/<wbr>', $client['image']);
                                $admin_status = ($client['admin_status']) ? 'true' : 'false';
                                echo "
                                <tr>
                                    <td>$client[client_id]</td>
                                    <td>$client[username]</td>
                                    <td>$client[email]</td>
                                    <td>$client[password]</td>
                                    <td>$admin_status</td>
                                    <td>$date</td>
                                    <td>$bio</td>
                                    <td>$image</td>
                                    <td>
                                        <div class='btn-container'>
                                        <button class='edit-btn'
                                            data-client-id=$client[client_id]
                                            data-username='$client[username]'
                                            data-email='$client[email]'
                                            data-password='$client[password]'
                                            data-admin-status='$admin_status'
                                            data-birthdate='$client[birthdate]' ?? ''
                                            data-bio='$client[bio]'
                                            data-image='$client[image]'
                                            onclick='openEditClientModal(this)'>
                                            Edit
                                        </button>
                                            <button class='delete-btn-client' client-id=$client[client_id]>Delete</button>
                                        </div>
                                    </td>
                                </tr>
                                ";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div id="editClientModal" class="modal">
                    <div class="modal-content">
                        <span class="close-btn" onclick="closeEditClientModal('client')">&times;</span>
                        <h2>Edit Client</h2>

                        <form class="form-vertical" action="/api/client/edit.php" method="post" enctype="multipart/form-data">
                            <!-- Hidden input for client_id -->
                            <input type="hidden" id="editClientId" name="client_id">

                            <label for="editUsername" hidden>Username:</label>
                            <input type="text" id="editUsername" name="username" hidden>

                            <label for="editEmail">Email:</label>
                            <input type="email" id="editEmail" name="email" required>

                            <label for="editBirthdate">Established Date:</label>
                            <input type="date" id="editBirthdate" name="birthdate">

                            <!-- Note: Consider if you really want to show and edit passwords this way -->
                            <label for="editPassword">Password:</label>
                            <input type="text" id="editPassword" name="password" required>

                            <label for="editAdminStatus">Status:</label>
                            <select id="editAdminStatus" name="admin_status">
                                <option value="false">Client</option>
                                <option value="true">Admin</option>
                            </select>
                            
                            <label for="editBio">Bio:</label>
                            <textarea id="editBio" name="bio"></textarea>

                            <label for="currentImage">Current Image:</label>
                            <img src="" alt="No image available." id="currentImage" style="display: none;">

                            <label for="newImage">Update Image:</label>
                            <input type="file" id="newImage" name="newImage">

                            <input type="submit" value="Update Client">
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
    $new_url = '/?admin/client/';

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