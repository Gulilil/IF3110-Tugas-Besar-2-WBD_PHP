<?php

require_once(dirname(__DIR__,2).'/define.php');
require_once(BASE_DIR.'/models/Anime.php');

$a = new Anime();
$animes = $a->getTop7Anime();

$data = "{ \"data\" : [";
$count = 1;
foreach($animes as $anime){
  $data = $data.'{ ';
  $data = $data.' "title" : '.$data['title'].', ';
  $data = $data.' "type" : '.$data['type'].', ';
  $data = $data.' "rating" : '.$data['rating'].', ';
  $data = $data.' "scoretitle" : '.$data['score'].', ';
  $data = $data.' "synopsis" : '.$data['synopsis'].', ';
  $data = $data.' "episodes" : '.$data['episodes'];
  $data = $data.'} ';
  if ($count < 7){
    $data = $data.', ';
  }
}
$data = $data.']}';

echo json_encode(array(
  'status' => 'success',
  'message' => $data
))

?>