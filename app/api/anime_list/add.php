<?php
require_once(dirname(__DIR__,2).'/define.php');
require_once(BASE_DIR.'/models/Anime_List.php');

$al = new Anime_List();

$aid = $_POST['anime_id'];
$cid = $_POST['client_id'];


$animeListArr = array (
  'client_id' => $cid,
  'anime_id' => $aid,
  'user_score'=> null,
  'progress' => null,
  'watch_status' => 'PLAN TO WATCH',
  'review' => null
);

$al->insertAnimeList($animeListArr);

$point = 20;
echo "<script src='/public/handler/reference.js'></script>
<script type='text/javascript'> sendUpdatePoint($cid, $aid, $point) 
</script>";
?>