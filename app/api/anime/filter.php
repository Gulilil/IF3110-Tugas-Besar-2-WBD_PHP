<?php

require_once(dirname(__DIR__,2).'/define.php');
require_once(BASE_DIR.'/models/Anime.php');


// $xml = file_get_contents('php://input');
// $data = json_decode($xml, true);

$url = '/?anime/';


// if (!$data) {
  $first = true;

  $a = new Anime();
  $genreFilter = $_POST['filter-genre'] != "Any" ? 'genre='.$_POST['filter-genre'] : "";
  $typeFilter = $_POST['filter-type'] != "Any" ? 'type='.$_POST['filter-type'] : "";
  $statusFilter = $_POST['filter-status'] != "Any" ? 'status='.$_POST['filter-status'] : "";
  $ratingFilter = $_POST['filter-rating'] != "Any" ? 'rating='.$_POST['filter-rating'] : "";
  $studioFilter = $_POST['filter-studio'] != "Any" ? 'studio='.$_POST['filter-studio'] : "";
  $sortFilter = $_POST['filter-sort'] != "Any" ? 'sort='.$_POST['filter-sort'] : "";
  $searchFilter = $_POST['filter-search'] != "" ? 'search='.strtolower($_POST['filter-search']) : "";
  
  $filterArray = array (
    $searchFilter, $genreFilter, $typeFilter, $statusFilter, $ratingFilter, $studioFilter, $sortFilter
  );

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
// } else {
//   $searchFilter = $data['filter-search'] != "Any" ? 'search='.$data['filter-search'] : "";
//   $genreFilter = $data['filter-genre'] != "Any" ? 'genre='.$data['filter-genre'] : "";
//   $typeFilter = $data['filter-type'] != "Any" ? 'type='.$data['filter-type'] : "";
//   $statusFilter = $data['filter-status'] != "Any" ? 'status='.$data['filter-status'] : "";
//   $ratingFilter = $data['filter-rating'] != "Any" ? 'rating='.$data['filter-rating'] : "";
//   $studioFilter = $data['filter-studio'] != "Any" ? 'studio='.$data['filter-studio'] : "";
//   $sortFilter = $data['filter-sort'] != "Any" ? 'sort='.$data['filter-sort'] : "";

//   $filterArray = array (
//     $searchFilter, $genreFilter, $typeFilter, $statusFilter, $ratingFilter, $studioFilter, $sortFilter
//   );

//   foreach($filterArray as $f){
//     if ($first){
//       if ($f != ""){
//         $url = $url.$f;
//         $first = false;
//       }
//     } else {
//       if ($f != ""){
//         $url = $url.'&'.$f;
//       }
//     }
//   }
//   $url = $first ? $url.'page=1' : $url.'&page=1';

//   http_response_code(200);
//   echo json_encode (
//     array (
//       'status' => 'success',
//       'url' => $url
//     )
//   );
// }



?>