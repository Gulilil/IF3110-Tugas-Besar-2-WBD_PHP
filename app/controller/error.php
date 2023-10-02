<?php

require_once(dirname(__DIR__,1).'/define.php');
require_once(BASE_DIR.'/models/controller.php');

class Error extends Controller {
  public function index(){
    http_response_code(404);
    $this->view('error/index');
  }
}