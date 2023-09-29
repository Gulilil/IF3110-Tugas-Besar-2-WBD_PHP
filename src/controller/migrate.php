<?php

// use PDOException;
function executeSQLFile($db, $file){
//     echo $file;
    try {
        $query = file_get_contents($file);
//         echo $query;
        $statement = $db->prepare($query);
        $statement->execute();
        echo "Execute success";
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }

}

function migrateDB() {
    $db_host = 'postgres_wbd';
    $db_name = 'wbd_db';
    $db_port = 5432;
    $db_user = 'postgres';
    $db_pass = 'password';

    $db = new PDO("pgsql:host=$db_host;port=$db_port;dbname=$db_name", $db_user, $db_pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $files = glob(dirname(__DIR__,1).'/database/*.sql');
    foreach($files as $file) {
        executeSQLFile($db, $file);
    }
}

migrateDB();

