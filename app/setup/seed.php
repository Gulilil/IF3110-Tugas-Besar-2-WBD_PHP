<?php

require_once(dirname(__DIR__, 1).'/define.php');
require_once(BASE_DIR.'/models/Client.php');
require_once(BASE_DIR.'/models/Studio.php');
require_once(BASE_DIR.'/models/Genre.php');
require_once(BASE_DIR.'/models/Anime.php');
require_once(BASE_DIR.'/models/Anime_List.php');
require_once(BASE_DIR.'/models/Anime_Genre.php');
require_once(BASE_DIR.'/models/Relationship.php');

function getRandomWord($len = 10)
{
  // Hope that the result is unique
  $word = array_merge(range('a', 'z'), range('A', 'Z'));
  shuffle($word);
  return substr(implode($word), 0, $len);
}

function seedClientData(){
  $client = new Client();
  for ($i = 1; $i <= 10; $i++){
    $username = 'client'.$i;
    $email = getRandomWord().'@gmail.com';
    $password = 'password';
    if ($i % 4 == 1){
      $admin_status = true;
    } else {
      $admin_status = false;
    }
    $birthdate = null;
    $bio = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur sit amet tincidunt risus, nec dictum lectus. Cras vitae tempus elit. Maecenas nec lobortis lectus. Ut mollis neque sit amet nunc aliquet, a fermentum libero sodales. Praesent non magna suscipit dolor sagittis posuere. Proin tortor lorem, viverra tempor dignissim vel, euismod vel magna. Maecenas fermentum ultricies imperdiet. Donec sodales lacus id magna ultricies rhoncus.';
    $image = null;

    $clientTuple = array(
      'username' => $username, 
      'email' => $email, 
      'password' => $password, 
      'admin_status' => $admin_status, 
      'birthdate' => $birthdate, 
      'bio' => $bio, 
      'image' => $image);
    $client->insertClient($clientTuple);
  }
}

function seedStudioData() {
  $studio = new Studio();
  $desc = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur sit amet tincidunt risus, nec dictum lectus. Cras vitae tempus elit. Maecenas nec lobortis lectus. Ut mollis neque sit amet nunc aliquet, a fermentum libero sodales. Praesent non magna suscipit dolor sagittis posuere. Proin tortor lorem, viverra tempor dignissim vel, euismod vel magna. Maecenas fermentum ultricies imperdiet. Donec sodales lacus id magna ultricies rhoncus.';
  $studio1 = array (
    'name' => 'B-1 Pictures',
    'description' => $desc,
    'established_date' => '2020-01-01',
    'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d9/A-1_Pictures_Logo.svg/1200px-A-1_Pictures_Logo.svg.png'
  );
  $studio->insertStudio($studio1);
  $studio2 = array (
    'name' => 'NAPPA Studio',
    'description' => $desc,
    'established_date' => '2019-04-03',
    'image' => 'https://cdn.myanimelist.net/s/common/company_logos/e3a5163d-3b09-4e98-922b-79180a75539f_600x600_i?s=3289c478fd611569ebccd7ff076151df'
  );
  $studio->insertStudio($studio2);
  $studio3 = array (
    'name' => 'Hyoto Animation',
    'description' => $desc,
    'established_date' => '2018-05-10',
    'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQNl6a2_UXtDfM1YwueHQt_UeGrw9fBI4ImtK0mCBCbvnRcSuq4WqxPNDU5Zh-mZS0CAi0&usqp=CAU'
  );
  $studio->insertStudio($studio3);
}

function seedGenreData(){
  $genre = new Genre();
  $genreArr = array('Drama', 'Action', 'Horror', 'Fantasy', 'Comedy', 'Romance');
  foreach($genreArr as $gen){
    $genre->insertGenre($gen);
  }
}

function seedAnimeData(){
  $anime = new Anime();
  $typeArr = array ('TV','MOVIE', 'OVA');
  $statusArr = array ('ON-GOING', 'COMPLETED', 'HIATUS', 'UPCOMING');
  $ratingArr = array ('G', 'PG-13', 'R(17+)', 'Rx');
  $imageArr = array (null);
  for($i = 1; $i <=30; $i++){
    array_push($imageArr, '/public/img/anime/anime'.$i.'.jpg');
  }
  $trailerArr = array (
    'https://youtu.be/30Dy3GERCqQ',
    'https://youtu.be/O6qVieflwqs',
    'https://youtu.be/0CJeDetA45Q',
    'https://youtu.be/rq1tllAUS1I',
    'https://youtu.be/72av7VTBE_8',
    null
  );

  for($i = 0; $i < 60; $i++){
    $title = getRandomWord(15);
    $type = $typeArr[rand(0,2)];
    $status = $statusArr[rand(0,3)];
    $release_date = rand(2000,2020).'-'.rand(1,12).'-'.rand(1,28);
    $episodes = 24;
    $rating = $ratingArr[rand(0,3)];
    $score = rand(1,9) + rand(1,10)/10;
    $image = $imageArr[rand(0,30)];
    $trailer = $trailerArr[rand(0,5)];
    $studio_id = rand(1,3);

    $animeTuple = array(
      'title' => $title,
      'type' => $type, 
      'status' => $status, 
      'release_date' => $release_date,
      'episodes' => $episodes, 
      'rating' => $rating, 
      'score' => $score, 
      'image' => $image,
      'trailer' => $trailer, 
      'studio_id' => $studio_id
    );
    $anime->insertAnime($animeTuple);
  }
}

function seedAnimeListData(){
  $anime_list = new Anime_List();
  $watch_statusArr = array ('WATCHING', 'COMPLETED', 'ON-HOLD', 'DROPPED', 'PLAN TO WATCH');

  for($i = 0; $i < 5; $i++){
    $client_id = rand(1,10);
    $anime_id = rand(1,10);
    $user_score = rand(1,10);
    $watch_status = $watch_statusArr[rand(0,4)];

    if ($watch_status == 'COMPLETED'){
      $progress = 24;
    } else if ($watch_status == 'PLAN TO WATCH'){
      $progress = null;
    } else {
      $progress = rand(1,24);
    }
    $review = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur sit amet tincidunt risus, nec dictum lectus. Cras vitae tempus elit. Maecenas nec lobortis lectus. Ut mollis neque sit amet nunc aliquet, a fermentum libero sodales. Praesent non magna suscipit dolor sagittis posuere. Proin tortor lorem, viverra tempor dignissim vel, euismod vel magna. Maecenas fermentum ultricies imperdiet. Donec sodales lacus id magna ultricies rhoncus.';

    $anime_listTuple = array (
      'client_id' => $client_id,
      'anime_id' => $anime_id,
      'user_score' => $user_score,
      'progress' => $progress,
      'watch_status' => $watch_status,
      'review' => $review
    );
    $anime_list->insertAnimeList($anime_listTuple);
  }
}

function seedAnimeGenreData(){
  $anime_genre = new Anime_Genre();
  for($i = 1; $i <= 10; $i++){
    if ($i % 3 == 0){
      $genre_id1 = 1;
      $genre_id2 = 1;
      while ($genre_id1 == $genre_id2){
        $genre_id1 = rand(1,6);
        $genre_id2 = rand(1,6);
      }

      $anime_genreTuple = array ('anime_id' => $i, 'genre_id' => $genre_id1);
      $anime_genre->insertAnimeGenre($anime_genreTuple);
      $anime_genreTuple = array ('anime_id' => $i, 'genre_id' => $genre_id2);
      $anime_genre->insertAnimeGenre($anime_genreTuple);      
    }
    else {
      $genre_id = rand(1,6);
      $anime_genreTuple = array ('anime_id' => $i, 'genre_id' => $genre_id);
      $anime_genre->insertAnimeGenre($anime_genreTuple);
    }
  }
}

function seedRelationshipData(){
  $relationship = new Relationship();
  $typeArr = array('FRIEND', 'PENDING', 'BLOCKED');
  for ($i = 0; $i < 10; $i++){
    $id1 = rand(1,10);
    $id2 = rand(1,10);
    $type = $typeArr[rand(0,2)];
    while ($relationship->getMutualRelationship($id1, $id2)){
      $id1 = rand(1,10);
      $id2 = rand(1,10);
      $type = $typeArr[rand(0,2)];
    }

    $relationshipTuple = array (
      'client_id_1' => $id1,
      'client_id_2' => $id2,
      'type' => $type
    );
    $relationship->insertRelationship($relationshipTuple);
  }
}

function seedAllData(){
  seedClientData(); 
  seedStudioData();
  seedGenreData();
  seedAnimeData();
  seedAnimeListData();
  seedAnimeGenreData();
  seedRelationshipData();
  echo 'Seeding success';
}


