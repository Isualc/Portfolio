<?php
include_once 'db.php';

try {
    $pdo = new PDO("mysql:host=localhost;dbname=onlineshop", 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Verbindung fehlgeschlagen: " . $e->getMessage());
}

$db = (new Database())->getConnection();
$search_query = '';
$result = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["search_query"])) {
        $search_query = $_POST["search_query"];
        $result = executeSearchQuery($pdo, $search_query); // Verwende $pdo statt $db
        // Rufe displayProducts auf, um die Ergebnisse anzuzeigen
    } else {
        echo "Keine Suchanfrage angegeben.";
    }
}

function executeSearchQuery($pdo, $search_query)
{
    $escaped_query = '%' . $search_query . '%';
    $sql = "SELECT * FROM products WHERE product_name LIKE ?";
    $stmt = $pdo->prepare($sql);

    if (!$stmt) {
        die("Error in SQL preparation: " . $pdo->errorInfo()[2]);
    }

    $stmt->execute([$escaped_query]);
    return $stmt;
}

function displayProducts($stmt)
{
    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<div class='product-card'>";
            echo "<div class='product-image'>";
            echo "<a href='show_details.php?id=" . htmlspecialchars($row['product_id']) . "'>";
            echo "<img src='" . htmlspecialchars($row['pfad_zum_bild']) . "' alt='" . htmlspecialchars($row['product_name']) . "' />";
            echo "</div>";
            echo "<h2>" . htmlspecialchars($row['product_name']) . "</h2>";
            echo "<p>" . htmlspecialchars($row['description']) . "</p>";
            echo "<p>Preis: " . htmlspecialchars($row['price']) . " €</p>";
            echo "</a></div>";
        }
    } else {
        echo "<p>Keine Produkte gefunden.</p>";
    }
}
$previousUrl = $_SERVER['HTTP_REFERER'] ?? null;
?>
<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <title>Suchergebnisse</title>
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
                <form action="search_results.php" method="post">
                    <input type="search" name="search_query" placeholder="Suche...">
                    <input type="submit" value="Suchen">
                </form>

            </div>
            <div class="navbar-links">
                <a href="login.php">Login</a>
                <a href="signup.php">Signup</a>
                <a href="user_dashboard.php">User</a>
                <?php if ($previousUrl) : ?>
                    <a href="<?php echo htmlspecialchars($previousUrl); ?>">Zurück</a>
                <?php endif; ?>
                <a href="logout.php">Logout</a>
            </div>
        </nav>
        <div class="content-wrap">
    <?php if ($_SERVER["REQUEST_METHOD"] == "POST") : ?>
        <h1>Suchergebnisse für: "<?php echo htmlspecialchars($search_query); ?>"</h1>
        <?php displayProducts($result); ?>
        <?php if ($result && $result->rowCount() > 0) : ?>
            <!-- Optionaler Code für zusätzliche Inhalte, falls Produkte gefunden wurden -->
        <?php else : ?>
            <div class="product-search-p">
                <p>Es wurden keine Produkte gefunden.</p>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>

        <footer>
            <?php include 'footer.php'; ?>
        </footer>
    </div>
</body>

</html>