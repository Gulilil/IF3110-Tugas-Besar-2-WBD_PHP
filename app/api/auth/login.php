<?php

require_once(dirname(__DIR__,2).'/define.php');
require_once(BASE_DIR.'/models/Client.php');
session_start();

if (isset($_POST['username'])){
  $c = new Client();
  $username = $_POST['username'];
  $password = $_POST['password'];

  $res = $c->getClientByUsername($username);
  if (!$res){
    $_SESSION['error'] = 'Username Not Found';
    header('Location: /?login');
  } else {
    if ($password == $res['password']){
      $_SESSION['username'] = $username;
      $_SESSION['admin_status'] = $res['admin_status'];
      $_SESSION['client_id'] = $res['client_id'];
      header('Location: /?home');
    } else {
      $_SESSION['error'] = 'Incorrect Password';
      header('Location: /?login');
    }
  }
}