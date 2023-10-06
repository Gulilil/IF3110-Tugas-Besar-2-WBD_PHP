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
    <title>Admin Page</title>
    <link rel="stylesheet" href="../../public/style/global.css">
    <link rel="stylesheet" href="../../public/style/admin.css">
    <script src='/public/handler/navbar.js'></script>
    <script src='/public/handler/admin.js'></script>
</head>

<body>      

    <div class="manage-header">
        <div class="menu">
            <button class="menu-item active" 
                onclick="showTable('client'); setActiveMenuItem('client')">Client</button>
            <button class="menu-item" 
                onclick="showTable('anime'); setActiveMenuItem('anime')">Anime</button>
            <button class="menu-item" 
            onclick="showTable('studio'); setActiveMenuItem('studio')">Studio</button>
        </div>

        <button class="add-btn" onclick="openAddModal()">Add</button>

        <div id="addClientModal" class="modal">
            <div class="modal-content">
                <span class="close-btn" onclick="closeAddModal()">&times;</span>
                <h2>Add New Client</h2>

                <form class="form-vertical" action="/public/actions/addClient.php" method="post" enctype="multipart/form-data">
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

        <div id="addAnimeModal" class="modal">
            <div class="modal-content">
                <span class="close-btn" onclick="closeAddModal()">&times;</span>
                <h2>Add New Anime</h2>

                <form class="form-vertical" action="/public/actions/addAnime.php" method="post" enctype="multipart/form-data">
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" placeholder="Title" required>

                    <label for="type">Type:</label>
                    <select id="type" name="type" placeholder="Type" required>
                        <option value="TV">TV</option>
                        <option value="MOVIE">Movie</option>
                        <option value="OVA">OVA</option>
                    </select>

                    <label for="status">Status:</label>
                    <select id="status" name="status" placeholder="Status" required>
                        <option value="ON-GOING">On Going</option>
                        <option value="COMPLETED">Completed</option>
                        <option value="HIATUS">Hiatus</option>
                        <option value="UPCOMING">Upcoming</option>
                    </select>

                    <label for="release_date">Release Date:</label>
                    <input type="date" id="release_date" name="release_date" placeholder="Release Date">

                    <label for="episodes">Episodes:</label>
                    <input type="number" id="episodes" name="episodes" min="0">

                    <label for="rating">Rating:</label>
                    <select id="rating" name="rating" placeholder="Rating" required>
                        <option value="G">G</option>
                        <option value="PG-13">PG-13</option>
                        <option value="R(17+)">R(17+)</option>
                        <option value="Rx">Rx</option>
                    </select>

                    <label for="image">Cover Picture:</label>
                    <input type="file" id="image" name="image">

                    <label for="trailer">Trailer:</label>
                    <input type="file" id="trailer" name="trailer">

                    <label for="synopsis">Synopsis:</label>
                    <textarea id="synopsis" name="synopsis" placeholder="Synopsis"></textarea>

                    <label for="studio_id">Studio:</label>
                    <select id="studio_id" name="studio_id" placeholder="Studio" required>
                        <?php
                            $studios = $s->getAllStudio();
                            foreach($studios as $studio){
                                echo " <option value=$studio[studio_id]>$studio[name]</option>";
                            }
                        ?>
                    </select>
                    <input type="submit" value="Add Anime">
                </form>

            </div>
        </div>

        <div id="addStudioModal" class="modal">
            <div class="modal-content">
                <span class="close-btn" onclick="closeAddModal()">&times;</span>
                <h2>Add New Studio</h2>

                <form class="form-vertical" action="/public/actions/addStudio.php" method="post" enctype="multipart/form-data">
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
                            $clients = $c->getAllClient();
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
                        <span class="close-btn" onclick="closeEditClientModal()">&times;</span>
                        <h2>Edit Client</h2>

                        <form class="form-vertical" action="/public/actions/editClient.php" method="post" enctype="multipart/form-data">
                            <!-- Hidden input for client_id -->
                            <input type="hidden" id="editClientId" name="client_id">

                            <label for="editUsername">Username:</label>
                            <input type="text" id="editUsername" name="username" required>

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


                <div id="anime" class="table">
                    <!-- Anime table goes here -->
                    <table>
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>title</th>
                                <th>type</th>
                                <th>status</th>
                                <th>release</th>
                                <th>eps</th>
                                <th>rating</th>
                                <th>score</th>
                                <th>image</th>
                                <th>trailer</th>
                                <th>synopsis</th>
                                <th>studio</th>
                                <th>actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $animes = $a->getAllAnime();
                            foreach($animes as $anime){
                                $date = $anime['release_date'] ?? '-';
                                $episodes = $anime['episodes'] ?? '';
                                $score = $anime['score'] ?? '-';
                                $image = is_null($anime['image']) ? '-' : str_replace('/', '/<wbr>', $anime['image']);
                                $trailer = is_null($anime['trailer']) ? '-' : str_replace('/', '/<wbr>', $anime['trailer']);
                                $synopsis = $anime['synopsis'] === '' ? '-' : $anime['synopsis'];
                                echo "
                                <tr>
                                    <td>$anime[anime_id]</td>
                                    <td>$anime[title]</td>
                                    <td>$anime[type]</td>
                                    <td>$anime[status]</td>
                                    <td>$date</td>
                                    <td>$episodes</td>
                                    <td>$anime[rating]</td>
                                    <td>$score</td>
                                    <td>$image</td>
                                    <td>$trailer</td>
                                    <td>$synopsis</td>
                                    <td>$anime[studio_id]</td>
                                    <td>
                                        <div class='btn-container'>
                                        <button class='edit-btn'
                                            data-anime-id=$anime[anime_id]
                                            data-title='$anime[title]'
                                            data-type='$anime[type]'
                                            data-status='$anime[status]'
                                            data-release-date='$anime[release_date]' ?? ''
                                            data-episodes=$anime[episodes]
                                            data-rating='$anime[rating]'
                                            data-image='$anime[image]'
                                            data-trailer='$anime[trailer]'
                                            data-synopsis='$anime[synopsis]'
                                            data-studio-id=$anime[studio_id]
                                            onclick='openEditAnimeModal(this)'>
                                            Edit
                                        </button>
                                            <button class='delete-btn-anime' anime-id=$anime[anime_id]>Delete</button>
                                        </div>
                                    </td>
                                </tr>
                                ";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div id="editAnimeModal" class="modal">
                    <div class="modal-content">
                        <span class="close-btn" onclick="closeEditAnimeModal()">&times;</span>
                        <h2>Edit Anime</h2>

                        <form class="form-vertical" action="/public/actions/editAnime.php" method="post" enctype="multipart/form-data">
                            <!-- Hidden input for anime_id -->
                            <input type="hidden" id="editAnimeId" name="anime_id">

                            <label for="editTitle">Title:</label>
                            <input type="text" id="editTitle" name="title" placeholder="Title" required>

                            <label for="editType">Type:</label>
                            <select id="editType" name="type" placeholder="Type" required>
                                <option value="TV">TV</option>
                                <option value="MOVIE">Movie</option>
                                <option value="OVA">OVA</option>
                            </select>

                            <label for="editStatus">Status:</label>
                            <select id="editStatus" name="status" placeholder="Status" required>
                                <option value="ON-GOING">On Going</option>
                                <option value="COMPLETED">Completed</option>
                                <option value="HIATUS">Hiatus</option>
                                <option value="UPCOMING">Upcoming</option>
                            </select>

                            <label for="editRelease_date">Release Date:</label>
                            <input type="date" id="editRelease_date" name="release_date" placeholder="Release Date">

                            <label for="editEpisodes">Episodes:</label>
                            <input type="number" id="editEpisodes" name="episodes" min="0">

                            <label for="editRating">Rating:</label>
                            <select id="editRating" name="rating" placeholder="Rating" required>
                                <option value="G">G</option>
                                <option value="PG-13">PG-13</option>
                                <option value="R(17+)">R(17+)</option>
                                <option value="Rx">Rx</option>
                            </select>

                            <label for="currentAnimeImage">Current Image:</label>
                            <img src="" alt="No image available." id="currentAnimeImage" style="display: none;">

                            <label for="newImage">Update Image:</label>
                            <input type="file" id="newImage" name="newImage">

                            <label for="currentTrailer">Current Trailer:</label>
                            <video width="320" height="240" controls id="currentTrailer" style="display: none;">
                                <source src="" type="video/mp4" id="currentTrailer">
                                Your browser does not support the video tag.
                            </video>

                            <label for="newTrailer">Update Trailer:</label>
                            <input type="file" id="newTrailer" name="newTrailer">

                            <label for="editSynopsis">Synopsis:</label>
                            <textarea id="editSynopsis" name="synopsis" placeholder="Synopsis"></textarea>

                            <label for="editStudio_id">Studio:</label>
                            <select id="editStudio_id" name="studio_id" placeholder="Studio" required>
                                <?php
                                    $studios = $s->getAllStudio();
                                    foreach($studios as $studio){
                                        echo " <option value=$studio[studio_id]>$studio[name]</option>";
                                    }
                                ?>
                            </select>
                            <input type="submit" value="Update Anime">
                        </form>

                    </div>
                </div>


                <div id="studio" class="table">
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
                            <span class="close-btn" onclick="closeEditStudioModal()">&times;</span>
                            <h2>Edit Studio</h2>

                            <form class="form-vertical" action="/public/actions/editStudio.php" method="post" enctype="multipart/form-data">
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