<?php

require_once(dirname(__DIR__,1).'/define.php');
require_once(BASE_DIR.'/models/Controller.php');

class SignupController extends Controller {
  public function index(){
    $this->view('Signup/index');
  }
}