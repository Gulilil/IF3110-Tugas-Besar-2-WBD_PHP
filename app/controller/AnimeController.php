<?php

require_once(dirname(__DIR__,1).'/define.php');
require_once(BASE_DIR.'/models/Controller.php');

class AnimeController extends Controller {
  public function index($path = "page=1"){
    $this->view('Anime/index', 
    array(
      'path' => $path
    ));
  }
  public function detail($id) {
    $this->view('Anime/detail', array('id' => $id));
  }
}