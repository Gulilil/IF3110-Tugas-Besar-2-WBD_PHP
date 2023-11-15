<?php

require_once('env_loader.php');
(new Env_Loader(__DIR__.'/.env'))->load();
define('POSTGRES_USER', getenv('POSTGRES_USER'));
define('POSTGRES_PASSWORD', getenv('POSTGRES_PASSWORD'));
define('POSTGRES_DB', getenv('POSTGRES_DB'));
define('POSTGRES_HOST', getenv('POSTGRES_HOST'));
define('SOAP_API_KEY', getenv('SOAP_API_KEY'));
define('SOAP_URL', getenv('SOAP_URL'));