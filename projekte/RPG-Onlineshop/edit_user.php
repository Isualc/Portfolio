<?php
include_once 'db.php';
include_once 'user.php';

$error = '';
$db = (new Database())->getConnection();
$userObj = new User($db);

$uuid = $_GET['uuid'] ?? null;
$userDetails = null;

if ($uuid) {
    $userDetails = $userObj->fetchUserDetails($uuid);
    if (!$userDetails) {
        $error = "Benutzer nicht gefunden.";
    }
} else {
    $error = "Keine User-ID angegeben.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_user'])) {
    // Überprüfen, ob die Felder gesetzt sind und Werte zuweisen
    $username = !empty($_POST['username']) ? $_POST['username'] : $userDetails['username'];
    $birthday = !empty($_POST['birthday']) ? $_POST['birthday'] : $userDetails['birthday'];
    $plz = !empty($_POST['plz']) ? $_POST['plz'] : $userDetails['plz'];
    $address = !empty($_POST['address']) ? $_POST['address'] : $userDetails['address'];
    $email = !empty($_POST['email']) ? $_POST['email'] : $userDetails['email'];
    $role = !empty($_POST['role']) ? $_POST['role'] : $userDetails['role'];

    // Aktualisierung nur durchführen, wenn das Passwort geändert wird
    $password = !empty($_POST['password']) ? $_POST['password'] : null;

    $updateResult = $userObj->updateUser($username, $birthday, $password, $address, $plz, $email, $role, $uuid);
    if ($updateResult) {
        $userDetails = $userObj->fetchUserDetails($uuid);
        header("Location: admin_dashboard.php");    
    } else {
        $error = "Fehler beim Aktualisieren des Benutzers.";
    }
}

$previousUrl = $_SERVER['HTTP_REFERER'] ?? null;
?>
<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Edit</title>
    <link rel="stylesheet" href="style.css">
</head>
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
        <a href="signup.php">Signup</a>
        <a href="admin_dashboard.php">Admin</a>
        <?php if ($previousUrl) : ?>
            <a href="<?php echo htmlspecialchars($previousUrl); ?>">Zurück</a>
        <?php endif; ?>
        <a href="logout.php">Logout</a>
    </div>
</nav>
<div class="content-wrap">
    <h1>Benutzer Bearbeiten</h1>
    <div class="update-user-container">
        <?php if ($error) : ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>

        <?php if ($uuid && $userDetails) : ?>
            <form action="edit_user.php?uuid=<?php echo htmlspecialchars($uuid); ?>" method="post">
                <label for="username">Benutzername:</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($userDetails['username']); ?>" required><br><br>

                <label for="birthday">Geburtstag:</label>
                <input type="date" id="birthday" name="birthday" value="<?php echo htmlspecialchars($userDetails['birthday']); ?>" required><br><br>

                <label for="plz">PLZ:</label>
                <input type="text" id="plz" name="plz" value="<?php echo htmlspecialchars($userDetails['plz']); ?>" required><br><br>

                <label for="address">Adresse:</label>
                <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($userDetails['address']); ?>" required><br><br>

                <label for="password">Passwort:</label>
                <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($userDetails['password']); ?>" required><br><br>

                <label for="role">Rolle:</label>
                <input type="text" id="role" name="role" value="<?php echo isset($userDetails['role']) ? htmlspecialchars($userDetails['role']) : ''; ?>" required><br><br>

                <input type="submit" name="update_user" value="Benutzer aktualisieren">
            </form>
        <?php endif; ?>

    </div>
</div>
<?php include 'footer.php'; ?>
</body>