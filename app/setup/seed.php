<?php

require_once(dirname(__DIR__, 1).'/define.php');
require_once(BASE_DIR.'/models/client.php');
require_once(BASE_DIR.'/models/studio.php');
require_once(BASE_DIR.'/models/genre.php');
require_once(BASE_DIR.'/models/anime.php');
require_once(BASE_DIR.'/models/anime_list.php');
require_once(BASE_DIR.'/models/anime_genre.php');
require_once(BASE_DIR.'/models/relationship.php');

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
    $bio = 'Account number '.$i;
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
  echo 'Client Data Seeding Successful';
}

function seedStudioData() {
  $studio = new Studio();
  $studio1 = array (
    'name' => 'B-1 Pictures',
    'description' => 'Ini studio 1',
    'established_date' => '2020-01-01',
    'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d9/A-1_Pictures_Logo.svg/1200px-A-1_Pictures_Logo.svg.png'
  );
  $studio->insertStudio($studio1);
  $studio2 = array (
    'name' => 'NAPPA Studio',
    'description' => 'Ini studio 2',
    'established_date' => '2019-04-03',
    'image' => 'https://cdn.myanimelist.net/s/common/company_logos/e3a5163d-3b09-4e98-922b-79180a75539f_600x600_i?s=3289c478fd611569ebccd7ff076151df'
  );
  $studio->insertStudio($studio2);
  $studio3 = array (
    'name' => 'Hyoto Animation',
    'description' => 'Ini studio 3',
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
  $status = array ('Completed', 'On Going', 'Coming Soon');
  $rating = array ('G', 'PG', 'PG-13', 'R', 'NC-17');

  for($i = 0; $i < 10; $i++){
    $title = getRandomWord(12);
    

  }
}

// seedClientData(); // Ini cukup dinyalain sekali ajaa
seedStudioData();
seetGenreData();
