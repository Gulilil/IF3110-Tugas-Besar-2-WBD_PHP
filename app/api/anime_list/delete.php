<?php
require_once(dirname(__DIR__,2).'/define.php');
require_once(BASE_DIR.'/models/Anime_List.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $al = new Anime_List();

    if ($al->deleteAnimeList($id)) {
        if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']) {
            header("Location: " . $_SERVER['HTTP_REFERER'] . "/?message=Deleted Succesfully");
        } else {
            header("Location: /?message=Deleted Succesfully");
        }
        exit();
    } else {
        header('Location: /?error=Failed to delete ' . $id);  
    }
}
?>