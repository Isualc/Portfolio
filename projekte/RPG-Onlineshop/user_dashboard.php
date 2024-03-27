<?php

include_once 'db.php';
include_once 'user.php';
include_once 'products.php';

session_start();

$db = (new Database())->getConnection();
$user = new User($db);
$productsClass = new Products($db);

if (!isset($_SESSION['user_id'])) {
    // If the user is not logged in, redirect to the login page
    header("Location: login.php");
    exit();
}

// Fetch products
$query = "SELECT * FROM products";
$stmt = $db->prepare($query);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Instantiate Products class and display products
$productsObj = new Products($db);

$previousUrl = $_SERVER['HTTP_REFERER'] ?? null;
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <title>Griswold's Schmiede</title>
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
                <?php if ($previousUrl) : ?>
                    <a href="<?php echo htmlspecialchars($previousUrl); ?>">Zurück</a>
                <?php endif; ?>
                <a href="logout.php">Logout</a>
            </div>
        </nav>
        <div class="content-wrap">
            <div class="dashboard-container">
                <h1>Höllisch viel Spaß im Shop, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
                <div class="product-container">
                    <?php 
                    if ($productsClass) {
                        $productsClass->displayProductCards($products);
                    }
                    ?>
                </div>
            </div>
        </div>
        <footer>
            <?php include 'footer.php'; ?>
        </footer>
    </div>
</body>

</html>