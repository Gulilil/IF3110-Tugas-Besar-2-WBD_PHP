<?php
require_once(dirname(__DIR__,2).'/define.php');
require_once(BASE_DIR.'/models/Anime_List.php');

$al = new Anime_List();

if (isset($_GET['client_id']) && isset($_GET['anime_id'])) {
    $client_id = $_GET['client_id'];
    $anime_id = $_GET['anime_id'];  

    $data = [
        'client_id' => $client_id,
        'anime_id' => $anime_id,
        'user_score' => null,
        'progress' => null,
        'watch_status' => null,
        'review' => null
    ];  
    
    if ($al->insertAnimeList($data)) {
        if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']) {
            header("Location: " . $_SERVER['HTTP_REFERER'] . "/?message=Added Succesfully");
        } else {
            header("Location: /?message=Added Succesfully");
        }
        exit();
    } else {
        header('Location: /?error=Failed to add');  
    }
}
?>
