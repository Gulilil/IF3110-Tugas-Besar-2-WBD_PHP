<?php
require_once(dirname(__DIR__,2).'/define.php');
require_once(BASE_DIR.'/models/Client.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $page = floor($id/20)+1;

    $c = new Client(); 

    $c->deleteClient($id);
    echo "<script src='/public/handler/reference.js'></script>
    <script type='text/javascript'> sendDelete($id, $page)
    </script>";
}
?>
