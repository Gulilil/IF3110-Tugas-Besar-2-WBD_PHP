<?php

require_once(dirname(__DIR__,1).'/define.php');

class Controller {
  public function view($view, $data = []){
    if (file_exists(BASE_DIR.'/views/'.$view.'.php')){
      require_once(BASE_DIR.'/views/'.$view.'.php');
    } else {
      die('View does not exist');
    }
  }
}