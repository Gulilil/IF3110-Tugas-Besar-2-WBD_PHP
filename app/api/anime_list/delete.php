<?php
require_once(dirname(__DIR__,2).'/define.php');
require_once(BASE_DIR.'/models/Anime_List.php');


$al = new Anime_List();

$aid = $_POST['anime_id'];
$cid = $_POST['client_id'];

$list_id = $al->getAnimeListByAnimeClientID($aid, $cid)['list_id'];

$al->deleteAnimeList($list_id);
header('Location: /?anime/detail/'.$aid);

?>