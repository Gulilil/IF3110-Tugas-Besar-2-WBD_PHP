<?php

require_once(dirname(__DIR__,2).'/define.php');
require_once(BASE_DIR.'/models/Client.php');

$c = new Client();
$clients = $c->getAllClient();
$lastData = end($clients);
$lastId = $lastData['client_id'];
$xml = file_get_contents('php://input');
$data = json_decode($xml, true);

if (isset($data['email'])){
  $email = $c->getClientByEmail($data['email']);
  if (!$email){
    http_response_code(200);
    echo json_encode(array(
      'status' => 'success',
      'message' => 'Email is allowed'
    ));
    // $_SESSION['error'] = 'Username or Email already exists';
    // header('Location: /?signup');
  } else {
    echo json_encode(array(
      'status' => 'error',
      'message' => 'Email already exists'
    ));
  }
}

if (isset($data['username'])){
  $username = $c->getClientByUsername($data['username']);
  if (!$username){
    http_response_code(200);
    echo json_encode(array(
      'status' => 'success',
      'message' => 'Username is allowed'
    ));
  } else {
    echo json_encode(array(
      'status' => 'error',
      'message' => 'Username already exists'
    ));
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

    echo "<script src='/public/handler/reference.js'></script>
    <script type='text/javascript'> sendInsert(".($lastId+1).", 'signup')
    </script>";
    // header('Location: /?login');
    session_unset();
  } else {
    $_SESSION['error'] = 'Signup Failed';
    header('Location: /?signup');
  }
}
