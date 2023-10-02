<?php

require_once(dirname(__DIR__,1).'/define.php');
require_once(BASE_DIR.'/models/Controller.php');

class AdminController extends Controller {
  public function index(){
    if (isset($_SESSION['admin_status']) && $_SESSION['admin_status']){
      $this->view('Admin/index');
    } else {
      $this->view('Home/index');
    }
  }
}