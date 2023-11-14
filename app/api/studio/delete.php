<?php
require_once(dirname(__DIR__,2).'/define.php');
require_once(BASE_DIR.'/models/Studio.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $page = floor($id/20)+1;

    $s = new Studio(); 

    if ($s->deleteStudio($id)) {
        header('Location: /?admin/studio/page='.$page.'?message=Deleted successfully');
    } else {
        header('Location: /?admin/studio/page='.$page.'?error=Failed to delete');
    }
}
?>
