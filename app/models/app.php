<?php

class App {
  protected $controller = 'home';
  protected $method = 'index';
  protected $params = [];

  public function __construct()
  {
    $url = $this->parse_url();
    if ((!isset($_SESSION['username']) && !isset($_COOKIE['GUEST']) && $url[0] != 'register'))
    {
      $this->controller = 'login';
    } 
    else {
      $path = explode("&", $url[0])[0];
      if (file_exists('controller/'.$path.'.php')) {
        $this->controller = $path;
        unset($url[0]);
      } else if ($url[0] == ''){
        $this->controller = 'home';
      } else {
        $this->ontroller = 'error';
      }
    }
  }

  public function parse_url()
  {
    if (isset($_SERVER['REQUEST_URI']))
    {
      $url = rtrim($_SERVER['REQUEST_URI'], '/');
      $url = ltrim($url, 'public/');
      $url = filter_var($url, FILTER_SANITIZE_URL);
      $url = ltrim($url, '?');
      $url = explode('/', $url);
      return $url;
    }
  }

}
