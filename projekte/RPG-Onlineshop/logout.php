<?php
// Beginn der PHP-Sitzung
include_once 'navbar.php';

// Löschen aller Session-Variablen
$_SESSION = array();

// Löschen des Session-Cookies
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Zerstören der Session
session_destroy();

// Weiterleitung zur Login-Seite oder zur Startseite
header("Location: index.php");
exit;
?>
