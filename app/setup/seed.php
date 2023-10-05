<?php

require_once(dirname(__DIR__, 1).'/define.php');
require_once(BASE_DIR.'/models/Client.php');
require_once(BASE_DIR.'/models/Studio.php');
require_once(BASE_DIR.'/models/Genre.php');
require_once(BASE_DIR.'/models/Anime.php');
require_once(BASE_DIR.'/models/Anime_List.php');
require_once(BASE_DIR.'/models/Anime_Genre.php');

$lorem_ipsum = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur sit amet tincidunt risus, nec dictum lectus. Cras vitae tempus elit. Maecenas nec lobortis lectus. Ut mollis neque sit amet nunc aliquet, a fermentum libero sodales. Praesent non magna suscipit dolor sagittis posuere. Proin tortor lorem, viverra tempor dignissim vel, euismod vel magna. Maecenas fermentum ultricies imperdiet. Donec sodales lacus id magna ultricies rhoncus.';

function getRandomWord($len = 10)
{
  // Hope that the result is unique
  $word = array_merge(range('a', 'z'), range('A', 'Z'));
  shuffle($word);
  return substr(implode($word), 0, $len);
}

function seedClientData(){
  global $lorem_ipsum;
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
    $image = null;

    $clientTuple = array(
      'username' => $username, 
      'email' => $email, 
      'password' => $password, 
      'admin_status' => $admin_status, 
      'birthdate' => $birthdate, 
      'bio' => $lorem_ipsum, 
      'image' => $image);
    $client->insertClient($clientTuple);
  }

  $client->insertClient(
    array (
    'username' => 'inijuan',
    'email' => 'juan@gmail.com',
    'password' => 'jujujuju',
    'admin_status' => true,
    'birthdate' => '2003-09-10',
    'bio' => 'Ini akun punya Juan iseng doang masukin biar beda soalnya kesannya kayak punya akun sendiri xixixixixixixi',
    'image' => '/public/img/admin_icon.png'
    )
  );
}

function seedStudioData() {
  global $lorem_ipsum;
  $studio = new Studio();
  $studio1 = array (
    'name' => 'B-1 Pictures',
    'description' => $lorem_ipsum,
    'established_date' => '2020-01-01',
    'image' => '/public/img/studio/studio1.png'
  );
  $studio->insertStudio($studio1);
  $studio2 = array (
    'name' => 'NAPPA Studio',
    'description' => $lorem_ipsum,
    'established_date' => '2019-04-03',
    'image' => '/public/img/studio/studio2.png'
  );
  $studio->insertStudio($studio2);
  $studio3 = array (
    'name' => 'Hyoto Animation',
    'description' => $lorem_ipsum,
    'established_date' => '2018-05-10',
    'image' => '/public/img/studio/studio3.png'
  );
  $studio->insertStudio($studio3);
  $studio4 = array (
    'name' => 'Bad House Studio',
    'description' => $lorem_ipsum,
    'established_date' => '2019-06-19',
    'image' => '/public/img/studio/studio4.png'
  );
  $studio->insertStudio($studio4);
  $studio5 = array (
    'name' => 'Khibli Animation',
    'description' => $lorem_ipsum,
    'established_date' => '2020-04-23',
    'image' => '/public/img/studio/studio5.png'
  );
  $studio->insertStudio($studio5);

  for($i = 6; $i <= 15; $i++){
    $other_studio = array (
      'name' => 'StudioAnime'.$i,
      'description' => $lorem_ipsum,
      'established_date' => null,
      'image' => '/public/img/placeholder.jpg'
    );
    $studio->insertStudio($other_studio);
  }
}

function seedGenreData(){
  $genre = new Genre();
  $genreArr = array('Drama', 'Action', 'Horror', 'Fantasy', 'Comedy', 'Romance');
  foreach($genreArr as $gen){
    $genre->insertGenre($gen);
  }
}

function seedAnimeData(){
  global $lorem_ipsum;
  $anime = new Anime();
  $typeArr = array ('TV','MOVIE', 'OVA');
  $statusArr = array ('ON-GOING', 'COMPLETED', 'HIATUS', 'UPCOMING');
  $ratingArr = array ('G', 'PG-13', 'R(17+)', 'Rx');
  $imageArr = array (null);
  for($i = 1; $i <=30; $i++){
    array_push($imageArr, '/public/img/anime/anime'.$i.'.jpg');
  }
  $trailerArr = array (
    '/public/vid/trailer1.mp4',
    '/public/vid/trailer2.mp4',
    '/public/vid/trailer3.mp4',
    null
  );

  for($i = 0; $i < 60; $i++){
    $title = getRandomWord(3).' '.getRandomWord(6).' '.getRandomWord(5).' '.getRandomWord(4);
    $type = $typeArr[rand(0,2)];
    $status = $statusArr[rand(0,3)];
    $release_date = rand(2000,2020).'-'.rand(1,12).'-'.rand(1,28);
    $episodes = 24;
    $rating = $ratingArr[rand(0,3)];
    $score = rand(1,9) + rand(1,10)/10;
    $image = $imageArr[rand(0,30)];
    $trailer = $trailerArr[rand(0,3)];
    $studio_id = rand(1,10);

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
      'synopsis' => $lorem_ipsum,
      'studio_id' => $studio_id
    );
    $anime->insertAnime($animeTuple);
  }
}

function seedAnimeListData(){
  global $lorem_ipsum;
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
    $review = $lorem_ipsum;

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

function seedAllData(){
  seedClientData(); 
  seedStudioData();
  seedGenreData();
  seedAnimeData();
  seedAnimeListData();
  seedAnimeGenreData();
  echo 'Seeding success';
}


