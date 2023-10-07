<?php
require_once(dirname(__DIR__,2).'/define.php');
require_once(BASE_DIR.'/models/Studio.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $s = new Studio(); 

    if ($s->deleteStudio($id)) {
        header('Location: /?admin?message=Deleted successfully');
    } else {
        header('Location: /?admin?error=Failed to delete');
    }
}
?>
