<?php

require_once(dirname(__DIR__,1).'/define.php');
require_once(BASE_DIR.'/models/Controller.php');

class StudioController extends Controller {
  public function index($path = "page=1"){
    $this->view('Studio/index',    
    array(
      'path' => $path
    ));
  }
  public function detail($id) {
    $this->view('Studio/detail', array('id' => $id));
  }
}