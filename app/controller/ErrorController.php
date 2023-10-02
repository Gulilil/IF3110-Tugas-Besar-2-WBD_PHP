<?php

require_once(dirname(__DIR__,1).'/define.php');
require_once(BASE_DIR.'/models/Controller.php');

class ErrorController extends Controller {
  public function index(){
    http_response_code(404);
    $this->view('Error/index');
  }
}