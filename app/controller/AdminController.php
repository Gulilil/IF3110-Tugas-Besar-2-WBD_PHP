<?php

require_once(dirname(__DIR__,1).'/define.php');
require_once(BASE_DIR.'/models/Controller.php');

class AdminController extends Controller {
  public function client($path = "page=1"){
    if (isset($_SESSION['admin_status'])){
      if ($_SESSION['admin_status']){
        $this->view('Admin/client');
      } else {
        $this->view('Error/index');
      }
    } else {
      $this->view('Error/index');
    }
  }
  public function anime($path = "page=1"){
    if (isset($_SESSION['admin_status'])){
      if ($_SESSION['admin_status']){
        $this->view('Admin/anime');
      } else {
        $this->view('Error/index');
      }
    } else {
      $this->view('Error/index');
    }
  }

  public function studio($path = "page=1"){
    if (isset($_SESSION['admin_status'])){
      if ($_SESSION['admin_status']){
        $this->view('Admin/studio');
      } else {
        $this->view('Error/index');
      }
    } else {
      $this->view('Error/index');
    }
  }
}