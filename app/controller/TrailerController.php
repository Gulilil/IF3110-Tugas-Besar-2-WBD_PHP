<?php

require_once(dirname(__DIR__,1).'/define.php');
require_once(BASE_DIR.'/models/Controller.php');

class TrailerController extends Controller {
  public function index($path = "page=1"){
    $this->view('Trailer/index',
    array(
      'path' => $path
    ));
  }
}