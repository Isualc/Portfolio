<?php
// Einbinden der notwendigen PHP-Dateien
include_once 'db.php';  // Datenbankverbindung
include_once 'user.php'; // User-Klasse

session_start();

// Erstellt ein neues Datenbankobjekt und stellt eine Verbindung zur Datenbank her
$db = (new Database())->getConnection();
// Erstellt ein neues User-Objekt mit der Datenbankverbindung
$user = new User($db);

// Initialisiert eine Variable für Fehlermeldungen
$error = '';

// Überprüft, ob die Anfrage eine POST-Anfrage ist
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Liest Benutzername und Passwort aus der POST-Anfrage und entfernt unnötige Leerzeichen
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Setzt Benutzername und Passwort im User-Objekt
    $user->username = $username;
    $user->setPassword($password);

    // Ruft die Login-Funktion des User-Objekts auf
    if ($user->login()) {
        // Speichert die Benutzer-ID und den Benutzernamen in der Session
        $_SESSION['user_id'] = $user->getUuid();
        $_SESSION['username'] = $username;

        // Leitet den Benutzer abhängig von seiner Rolle auf eine andere Seite weiter
        if ($user->getRole() == Database::ADMIN) {
            header("Location: admin_dashboard.php");
            exit;
        } else {
            header("Location: user_dashboard.php");
            exit;
        }
    } else {
        // Setzt die Fehlermeldung, falls die Anmeldung fehlschlägt
        $error = "Invalid username or password.";
    }
}
$previousUrl = $_SERVER['HTTP_REFERER'] ?? null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="page-container">
        <header>
            
        </header>
        <nav class="navbar">
    <div class="navbar-logo">
        <a href="index.php">
            <img src="img/logo2.png" alt="Website-Logo">
        </a>
    </div>
    <div class="navbar-search">
        <form action="search_results.php" method="get">
            <input type="search" name="search" placeholder="Suche...">
            <input type="submit" value="Suchen">
        </form>
    </div>
    <div class="navbar-links">
    <a href="signup.php">Signup</a>
    <?php if ($previousUrl): ?>
            <a href="<?php echo htmlspecialchars($previousUrl); ?>">Zurück</a>
        <?php endif; ?>
     </div>
        </nav>
        <div class="content-wrap">
            <div class="login-container">
                <?php if (!empty($error)) : ?>
                    <p style='color: red;'><?php echo htmlspecialchars($error); ?></p>
                <?php endif; ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" required>

                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" required>

                    <input type="submit" value="Login">
                </form>
            </div>

        </div>
        <footer>
            <?php include 'footer.php'; ?>
        </footer>
    </div>
</body>

</html>