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
            <button class="menu-item active" onclick="showTable('client')">Client</button>
            <button class="menu-item" onclick="showTable('anime')">Anime</button>
            <button class="menu-item" onclick="showTable('studio')">Studio</button>
        </div>
            <button class="add-btn">Add</button>
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
                                $bio = $client['bio'] ?? '';
                                $image = $client['image'] ?? '-';
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
                                    <td class='actions'>
                                        <button class='edit-btn'>Edit</button>
                                        <button class='delete-btn'>Delete</button>
                                    </td>
                                </tr>
                                ";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div id="anime" class="table">
                    <!-- Anime table goes here -->
                    <table>
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>type</th>
                                <th>status</th>
                                <th>release_date</th>
                                <th>episodes</th>
                                <th>rating</th>
                                <th>score</th>
                                <th>image</th>
                                <th>trailer</th>
                                <th>studio_id</th>
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
                                $image = substr($anime['image'], 18) ?? '-';
                                $trailer = substr($anime['trailer'], 12) ?? '-';
                                echo "
                                <tr>
                                    <td>$anime[anime_id]</td>
                                    <td>$anime[type]</td>
                                    <td>$anime[status]</td>
                                    <td>$date</td>
                                    <td>$episodes</td>
                                    <td>$anime[rating]</td>
                                    <td>$score</td>
                                    <td>$image</td>
                                    <td>$trailer</td>
                                    <td>$anime[studio_id]</td>
                                    <td class='actions'>
                                        <button class='edit-btn'>Edit</button>
                                        <button class='delete-btn'>Delete</button>
                                    </td>
                                </tr>
                                ";
                            }
                            ?>
                        </tbody>
                    </table>
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
                                $desc = $studio['description'] ?? '';
                                $date = $studio['established_date'] ?? '-';
                                $image = substr($studio['image'], 19) ?? '-';
                                echo "
                                <tr>
                                    <td>$studio[studio_id]</td>
                                    <td>$studio[name]</td>
                                    <td>$desc</td>
                                    <td>$date</td>
                                    <td>$image</td>
                                    <td class='actions'>
                                        <button class='edit-btn'>Edit</button>
                                        <button class='delete-btn'>Delete</button>
                                    </td>
                                </tr>
                                ";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</body>
</html>

<?php
require_once(BASE_DIR.'/views/includes/footer.php');
?>