<?php

require_once(dirname(__DIR__,2).'/define.php');
require_once(BASE_DIR.'/models/Client.php');
session_start();

if (isset($_POST['username']) && isset($_POST['email'])){
  $c = new Client();
  $username = $c->getClientByUsername($_POST['username']);
  $email = $c->getClientByEmail($_POST['email']);
  // echo $username['client_id'];
  if (!$username || !$email){
    $_SESSION['error'] = 'Username or Email already exists';
    header('Location: /?signup');
  }
}

if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])){
  $username = $_POST['username'];
  $password = $_POST['password'];
  $email = $_POST['email'];
  $clientArr = array (
    'username' => $username,
    'email' => $email,
    'password' => $password,
    'admin_status' => false,
    'birthdate' => null,
    'bio' => null,
    'image' => null
  );
  if ($c->insertClient($clientArr)){
    header('Location: /?login');
    session_unset();
  } else {
    $_SESSION['error'] = 'Signup Failed';
    header('Location: /?signup');
  }
}
