<?php


 echo dirname(__DIR__);

$files = glob(__DIR__.'/database/*.sql');
foreach($files as $file){
    echo $file;
}