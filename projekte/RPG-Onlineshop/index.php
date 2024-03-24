<?php
include_once 'db.php';
include_once 'user.php';
include_once 'products.php';

$db = (new Database())->getConnection();
$query = "SELECT * FROM products";
$stmt = $db->prepare($query);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

$productsObj = new Products($db);

$previousUrl = $_SERVER['HTTP_REFERER'] ?? null;
?>
<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <title>Startseite</title>
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
                <a href="signup.php">Signup</a>
            </div>
        </nav>
        <div class="content-wrap">
            <h1>Willkommen in Griswold's Online Schmiede!</h1>
            <div class="product-container">
                <?php $productsObj->displayProductCards($products); ?>
            </div>

        </div>

        <?php include 'footer.php'; ?>
    </div>
</body>

</html>