<?php

require_once(dirname(__DIR__,1).'/define.php');
require_once(BASE_DIR.'/models/Controller.php');

class ClientController extends Controller {
  public function detail($id){
    $this->view('Client/detail', array('id' => $id));
  }

  public function list($id){
    $this->view('Client/list', array('id' => $id));
  }
}