<?php
require_once(dirname(__DIR__,2).'/define.php');
require_once(BASE_DIR.'/models/Anime_List.php');

$al = new Anime_List();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['list_id']) || empty($_POST['list_id'])) {
        echo "No ID provided. Cannot proceed with edit.";
        exit();
    }
    $data = [
        'list_id' => $_POST['list_id'],
        'client_id' => $_POST['client_id'],
        'anime_id' => $_POST['anime_id']
    ];

    if (isset($_POST['user_score'])) {
        $data['user_score'] = $_POST['user_score'];
    } else {
        $data['user_score'] = null;
    }

    if (isset($_POST['progress'])) {
        $data['progress'] = $_POST['progress'];
    } else {
        $data['progress'] = null;
    }

    if (isset($_POST['watch_status'])) {
        $data['watch_status'] = $_POST['watch_status'];
    } else {
        $data['watch_status'] = null;
    }

    if (isset($_POST['review'])) {
        $data['review'] = $_POST['review'];
    } else {
        $data['review'] = null;
    }


    // Call the updateStudio method
    $result = $al->updateAnimeList($data);

    if ($result) {
        header("Location: /?client/detail/" . $_POST['client_id'] . "/?message=Edited Succesfully");
        exit();
    } else {
        header('Location: /?error=Failed to edit');  
    }
}
?>