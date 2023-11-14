<?php
require_once(dirname(__DIR__,2).'/define.php');
require_once(BASE_DIR.'/models/Client.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $page = floor($id/20)+1;

    $c = new Client(); 

    if ($c->deleteClient($id)) {
        header('Location: /?admin/client/page='.$page.'?message=Deleted successfully');
    } else {
        header('Location: /?admin/client/page='.$page.'?error=Failed to delete');
    }
}
?>
