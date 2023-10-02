<?php

require_once(dirname(__DIR__,2).'/define.php');
require_once(BASE_DIR.'/models/Client.php');
session_start();

session_unset();
header('Location: /login');
