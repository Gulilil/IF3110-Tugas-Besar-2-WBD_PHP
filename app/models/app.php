<?php

require_once(dirname(__DIR__,1).'/define.php');
require_once(BASE_DIR.'/models/Controller.php');
require_once(BASE_DIR.'/controller/ErrorController.php');

class App {
  protected $controller = 'HomeController';
  protected $method = 'index';
  protected $params = [];


  public function __construct()
  {
    $url = $this->parse_url();
    if (!isset($_SESSION['username']) ){
      if ($url[0] == 'signup'){
        $this->controller = 'SignupController';
      } else {
        $this->controller = 'LoginController';
      }
    }
    else {
      $path = explode("?", $url[0])[0];
      if ($url[0] == '' || $url[0] == 'login' || $url[0] == 'signup') {
        $this->controller = 'HomeController';
      }
      else if (file_exists(BASE_DIR.'/controller/' . $path . 'Controller.php')) {
        $this->controller = $path.'Controller';
        unset($url[0]);
      }
      else {
        $this->controller = 'ErrorController';
      }
    }
    require_once BASE_DIR.'/controller/' . $this->controller . '.php';
    $this->controller = new $this->controller;
    if (isset($url[1])) {
      if (method_exists($this->controller, $url[1])) {
        $this->method = $url[1];
        unset($url[1]);
      }
    }
    if ($url) {
      $this->params = array_values($url);
    }
    call_user_func_array([$this->controller, $this->method], $this->params);

  }

  public function parse_url()
  {
    if (isset($_SERVER['REQUEST_URI'])) {
      $url = rtrim($_SERVER['REQUEST_URI'], '/');
      $url = ltrim($url, 'public/');
      $url = filter_var($url, FILTER_SANITIZE_URL);
      $url = ltrim($url, '?');
      $url = explode('/', $url);
      return $url;
    }
  }

}
