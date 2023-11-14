<?php 

require_once(dirname(__DIR__,2).'/define.php');
require_once(BASE_DIR.'/views/includes/header.php');
require_once(BASE_DIR.'/models/Client.php');
require_once(BASE_DIR.'/models/Anime.php');
require_once(BASE_DIR.'/models/Studio.php');

$c = new Client();
$a = new Anime();
$s = new Studio();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page: Studio</title>
    <link rel="stylesheet" href="../../public/style/global.css">
    <link rel="stylesheet" href="../../public/style/admin.css">
    <script src='/public/handler/navbar.js'></script>
    <script src='/public/handler/admin.js'></script>
</head>

<body>      

    <div class="manage-header">
        <div class="menu">
          <a href="/?admin/client/page=1">
            <button class="menu-item " 
                onclick="showTable('client'); setActiveMenuItem('client')">Client</button>
          </a>
          <a href="/?admin/anime/page=1">
            <button class="menu-item" 
                onclick="showTable('anime'); setActiveMenuItem('anime')">Anime</button>
          </a>
          <a href="/?admin/studio/page=1">
            <button class="menu-item active" 
            onclick="showTable('studio'); setActiveMenuItem('studio')">Studio</button>
        </a>
        </div>

        <button class="add-btn" onclick="openAddModal('studio')">Add</button>

        <div id="addStudioModal" class="modal">
            <div class="modal-content">
                <span class="close-btn" onclick="closeAddModal('studio')">&times;</span>
                <h2>Add New Studio</h2>

                <form class="form-vertical" action="/api/studio/add.php" method="post" enctype="multipart/form-data">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" placeholder="Name" required>

                    <label for="description">Description:</label>
                    <textarea name="description" id="description" placeholder="Description"></textarea>

                    <label for="established_date">Established Date:</label>
                    <input type="date" id="established_date" name="established_date">

                    <label for="image">Picture:</label>
                    <input type="file" id="image" name="image">

                    <input type="submit" value="Add Studio">
                </form>

            </div>
        </div>

    </div>

    <div class="container">
        <div class="content">

            <div class="manage-section">

                
                <div id="studio" class="table active-table">
                    <!-- Studio table goes here -->
                    <table>
                        <thead>
                            <tr>
                                <th>studio_id</th>
                                <th>name</th>
                                <th>description</th>
                                <th>established_date</th>
                                <th>image</th>
                                <th>actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $studios = $s->getAllStudio();
                                foreach($studios as $studio){
                                    $desc = $studio['description'] === '' ? '-' : $studio['description'];
                                    $date = $studio['established_date'] ?? '-';
                                    $image = is_null($studio['image']) ? '-' : str_replace('/', '/<wbr>', $studio['image']);
                                    echo "
                                    <tr>
                                        <td>$studio[studio_id]</td>
                                        <td>$studio[name]</td>
                                        <td>$desc</td>
                                        <td>$date</td>
                                        <td>$image</td>
                                        <td>
                                            <div class='btn-container'>
                                                <button class='edit-btn'
                                                        data-studio-id=$studio[studio_id]
                                                        data-name='$studio[name]'
                                                        data-description='$studio[description]'
                                                        data-established-date='$studio[established_date]' ?? ''
                                                        data-image='$studio[image]'
                                                        onclick='openEditStudioModal(this)'>
                                                    Edit
                                                </button>
                                                <button class='delete-btn-studio' studio-id=$studio[studio_id]>Delete</button>
                                            </div>
                                        </td>
                                    </tr>";
                                }
                            ?>
                        </tbody>
                    </table>

                    <div id="editStudioModal" class="modal">
                        <div class="modal-content">
                            <span class="close-btn" onclick="closeEditStudioModal('studio')">&times;</span>
                            <h2>Edit Studio</h2>

                            <form class="form-vertical" action="/api/studio/edit.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" id="editStudioId" name="studio_id">

                                <label for="editName">Name:</label>
                                <input type="text" id="editName" name="name" placeholder="Name" required>

                                <label for="editDescription">Description:</label>
                                <textarea name="description" id="editDescription" placeholder="Description"></textarea>

                                <label for="editEstablishedDate">Established Date:</label>
                                <input type="date" id="editEstablishedDate" name="established_date">

                                <label for="currentStudioImage">Current Image:</label>
                                <img src="" alt="No image available." id="currentStudioImage" style="display: none;">

                                <label for="newImage">Update Image:</label>
                                <input type="file" id="newImage" name="newImage">

                                <input type="submit" value="Edit Studio">
                            </form>
                        </div>
                    </div>

                </div>

            </div>

            
        </div>
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