<?php
include_once 'db.php';
include_once 'user.php';

$db = (new Database())->getConnection();
$user = new User($db);

if (isset($_POST['uuid'])) {
    $uuid = $_POST['uuid'];
    $user->deleteUser($uuid);
}

// Umleitung nach dem Löschen
header("Location: admin_dashboard.php");
exit();

?>
