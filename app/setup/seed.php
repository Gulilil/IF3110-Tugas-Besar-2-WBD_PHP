<?php

require_once(dirname(__DIR__, 1).'/define.php');
require_once(BASE_DIR.'/models/client.php');

function getRandomWord($len = 10)
{
  // Hope that the result is unique
  $word = array_merge(range('a', 'z'), range('A', 'Z'));
  shuffle($word);
  return substr(implode($word), 0, $len);
}


function seedClientData(){
  $client = new Client();
  for ($i = 0; $i < 10; $i++){
    $username = 'client'.$i;
    $email = getRandomWord().'@gmail.com';
    $password = 'password';
    if ($i % 4 == 0){
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

// seedClientData(); // Ini cukup dinyalain sekali ajaa