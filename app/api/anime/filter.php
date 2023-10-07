<?php

require_once(dirname(__DIR__,2).'/define.php');
require_once(BASE_DIR.'/models/Anime.php');

$first = true;

$a = new Anime();
$genreFilter = $_POST['filter-genre'] != "Any" ? 'genre='.$_POST['filter-genre'] : "";
$typeFilter = $_POST['filter-type'] != "Any" ? 'type='.$_POST['filter-type'] : "";
$statusFilter = $_POST['filter-status'] != "Any" ? 'status='.$_POST['filter-status'] : "";
$ratingFilter = $_POST['filter-rating'] != "Any" ? 'rating='.$_POST['filter-rating'] : "";
$studioFilter = $_POST['filter-studio'] != "Any" ? 'studio='.$_POST['filter-studio'] : "";
$sortFilter = $_POST['filter-sort'] != "Any" ? 'sort='.$_POST['filter-sort'] : "";

$filterArray = array (
  $genreFilter, $typeFilter, $statusFilter, $ratingFilter, $studioFilter, $sortFilter
);
$url = '/?anime/';

foreach($filterArray as $f){
  if ($first){
    if ($f != ""){
      $url = $url.$f;
      $first = false;
    }
  } else {
    if ($f != ""){
      $url = $url.'&'.$f;
    }
  }
}
$url = $first ? $url.'page=1' : $url.'&page=1';

header("Location: ".$url);
?>