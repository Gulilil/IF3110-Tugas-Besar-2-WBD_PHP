<?php

require_once(dirname(__DIR__,1).'/define.php');
require_once(BASE_DIR.'/models/controller.php');

class Home extends Controller {
  public function index(){
    $this->view('home/index');
  }
}