<?php
$projectFolder = $_GET['Rocket'] ?? '';

// Pfad zum Projektordner basierend auf dem Query-Parameter
// Wenn das Skript sich im Ordner 'html' befindet, müssen wir zwei Ebenen nach oben gehen
$projektPfad = __DIR__ . "/../projekte/$projectFolder";

// Überprüfen, ob der Ordner existiert und eine index.html enthält
if (!file_exists($projektPfad)) {
    die("Projekt nicht gefunden fehlt im Projektordner.");
}

// Den Inhalt der index.html-Datei lesen
$projektInhalt = file_get_contents("$projektPfad");
?>

<html lang="de">
<head>
    <title><?php echo htmlspecialchars($projekt['titel']); ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <header class="text-center p-3">
        <h1>Projektdetails</h1>
    </header>
    
    <main class="container mt-5">
        <?php echo $projektInhalt; // Hier wird der Inhalt der index.html angezeigt. ?>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>
