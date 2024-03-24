<?php
// PHP-Codeblock Anfang

include_once 'db.php';
include_once 'user.php';



$db = (new Database())->getConnection(); // Stellt die Datenbankverbindung her
$user = new User($db); // Erstellt ein neues User-Objekt
$user->generateUuid(); // Stellt sicher, dass diese Zeile vor $user->register() aufgerufen wird

$registrationError = ''; // Initialisiert die Variable für Registrierungsfehler

// Überprüft, ob die Anfrage vom Typ POST ist
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Überprüft, ob alle erwarteten POST-Variablen gesetzt und nicht leer sind
    if (
        isset($_POST['username']) && isset($_POST['email']) && isset($_POST['address']) &&
        isset($_POST['postalCode']) && isset($_POST['password'])
    ) {

        // Bereinigt die Daten aus dem Formular
        $username = trim($_POST['username']);
        $birthday = trim($_POST['birthday']);
        $email = trim($_POST['email']);
        $address = trim($_POST['address']);
        $postalCode = trim($_POST['postalCode']);
        $password = trim($_POST['password']);

        // Setzt die Werte im User-Objekt
        $user->setName($username); // Nimmt an, dass es eine setName-Methode gibt
        $user->setBirthday($birthday);
        $user->setEmail($email);
        $user->setAddress($address);
        $user->setPostalCode($postalCode);
        $user->setPassword($password); // Stellt sicher, dass das Passwort in dieser Methode sicher gehasht wird

        // Versucht, den Benutzer in der Datenbank zu speichern
        if ($user->register()) { // Stellt sicher, dass die Methode register() in der User-Klasse existiert
            $registrationSuccess = "Registrierung erfolgreich! Sie werden in 2 Sekunden zum Login weitergeleitet.";
            // Setze den Refresh-Header für die verzögerte Weiterleitung
            header("Refresh: 2; url=login.php"); // Leitet nach erfolgreicher Registrierung zum Login weiter
            exit;
        } else {
            $registrationError = "Registrierung fehlgeschlagen. Bitte versuchen Sie es erneut.";
        }
    } else {
        $registrationError = "Alle Felder sind erforderlich."; // Fehlermeldung, wenn nicht alle Formularfelder gesetzt sind
    }
}
$previousUrl = $_SERVER['HTTP_REFERER'] ?? null;
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <title>Registrierung</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="page-container">
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
                <a href="login.php">Login</a>
                <?php if ($previousUrl) : ?>
                    <a href="<?php echo htmlspecialchars($previousUrl); ?>">Zurück</a>
                <?php endif; ?>
            </div>
        </nav>
        <div class="content-wrap">
            <div class="registration-container">
                <?php if (!empty($registrationError)) : ?>
                    <p class="error-message"><?php echo htmlspecialchars($registrationError); ?></p>
                <?php endif; ?>
                <?php if (!empty($registrationSuccess)) : ?>
                    <p class="success-message"><?php echo htmlspecialchars($registrationSuccess); ?></p>
                <?php endif; ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label for="username">Benutzername:</label>
                        <input type="text" name="username" id="username" required>
                    </div>

                    <div class="form-group">
                        <label for="birthday">Geburtsdatum:</label>
                        <input type="date" name="birthday" id="birthday" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" required>
                    </div>

                    <div class="form-group">
                        <label for="address">Adresse:</label>
                        <input type="text" name="address" id="address" required>
                    </div>

                    <div class="form-group">
                        <label for="postalCode">PLZ:</label>
                        <input type="text" name="postalCode" id="postalCode" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Passwort:</label>
                        <input type="password" name="password" id="password" required>
                    </div>

                    <input type="submit" value="Registrieren">
                </form>
            </div>
        </div>
        <?php include 'footer.php'; ?>
    </div>
</body>

</html>