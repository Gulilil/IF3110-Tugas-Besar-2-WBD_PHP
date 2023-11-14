<?php
require_once(dirname(__DIR__,2).'/define.php');
require_once(BASE_DIR.'/models/Anime.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $page = floor($id/20)+1;

    $a = new Anime(); 

    if ($a->deleteAnime($id)) {
        header('Location: /?admin/anime/page='.$page.'?message=Deleted successfully');
    } else {
        header('Location: /?admin/anime/page='.$page.'?error=Failed to delete');
    }
}
?>
