<?php
require_once(dirname(__DIR__,2).'/define.php');
require_once(BASE_DIR.'/models/Client.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $c = new Client(); 

    if ($c->deleteClient($id)) {
        header('Location: /?admin?message=Deleted successfully');
    } else {
        header('Location: /?admin?error=Failed to delete');
    }
}
?>
