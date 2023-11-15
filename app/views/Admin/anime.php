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
</head>

<body>      

    <div class="manage-header">
        <div class="menu">
          <a href="/?admin/client/page=1">
            <button class="menu-item">Client</button>
          </a>
          <a href="/?admin/anime/page=1">
            <button class="menu-item active">Anime</button>
          </a>
          <a href="/?admin/studio/page=1">
            <button class="menu-item">Studio</button>
          </a>
          <a href="/?admin/reference/page=1">
            <button class="menu-item">Reference</button>
          </a>
        </div>

        <button class="add-btn" onclick="openAddModal('anime')">Add</button>

        <div id="addAnimeModal" class="modal">
            <div class="modal-content">
                <span class="close-btn" onclick="closeAddModal('anime')">&times;</span>
                <h2>Add New Anime</h2>

                <form class="form-vertical" action="/api/anime/add.php" method="post" enctype="multipart/form-data">
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
                            $animes = $a->getAllAnimeLimitOffset(20, ($page-1)*20);
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
                                            data-score='$anime[score]'
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
                        <span class="close-btn" onclick="closeEditAnimeModal('anime')">&times;</span>
                        <h2>Edit Anime</h2>

                        <form class="form-vertical" action="/api/anime/edit.php" method="post" enctype="multipart/form-data">
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

                            <label for="editScore"> Score: </label>
                            <input type='number' id='editScore' name='score' required/>

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
            </div>
        </div>
    </div>

    <div class='button-container'>
  <?php
    $prevPage = $page == 1? 'page=1' : 'page='.$page-1;
    $nextPage = $page == $maxPage ? 'page='.$maxPage : 'page='.$page+1;
    $new_url = '/?admin/anime/';

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