<?php
require_once(dirname(__DIR__,2).'/define.php');
require_once(BASE_DIR.'/models/Anime.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $a = new Anime(); 

    if ($a->deleteAnime($id)) {
        header('Location: /?admin?message=Deleted successfully');
    } else {
        header('Location: /?admin?error=Failed to delete');
    }
}
?>
