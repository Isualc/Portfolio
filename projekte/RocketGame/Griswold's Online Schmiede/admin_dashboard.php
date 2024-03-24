<?php
ob_start();
include_once 'db.php';
include_once 'user.php';
include_once 'products.php';

session_start();

$db = (new Database())->getConnection();
$user = new User($db);
$user->deleteUser('$uuid');
$product = new Products($db);
$product->deleteProduct('$productId');

if (!isset($_SESSION['user_id'])) {
    // If the user is not logged in, redirect to the login page
    header("Location: login.php");
    exit();
}


// Abfrage für User-Tabelle
$query = "SELECT * FROM users";
$stmt = $db->prepare($query);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Abfrage für Products-Tabelle
$query = "SELECT * FROM products";
$stmt = $db->prepare($query);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

ob_end_flush();

$previousUrl = $_SERVER['HTTP_REFERER'] ?? null;
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="page-container">
        <div class="content-wrap">
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
                    <a href="user_dashboard.php">User</a>
                    <?php if ($previousUrl) : ?>
                        <a href="<?php echo htmlspecialchars($previousUrl); ?>">Zurück</a>
                    <?php endif; ?>
                    <a href="logout.php">Logout</a>
                </div>
            </nav>
            <div class="dashboard-container">
                <h1>Willkommen Höllen-Admin <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
                <h2>User-Tabelle</h2>
                <table border="1">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>PLZ</th>
                        <th>Adresse</th>
                        <th>Rolle</th>
                        <th>Aktionen</th>
                    </tr>
                    <?php foreach ($users as $user) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['uuid']); ?></td>
                            <td><?php echo htmlspecialchars($user['username']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td><?php echo htmlspecialchars($user['plz']); ?></td>
                            <td><?php echo htmlspecialchars($user['address']); ?></td>
                            <td><?php echo htmlspecialchars($user['role']); ?></td>
                            <td>
                                <div class="action-buttons">
                                <a href="edit_user.php?uuid=<?php echo htmlspecialchars($user['uuid']); ?>">Bearbeiten</a>
                                      
                                    <form action="delete_user.php" method="post">
                                        <input type="hidden" name="uuid" value="<?php echo $user['uuid']; ?>">
                                        <input type="submit" value="Löschen">
                                    </form>

                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>

                <h2>Products-Tabelle</h2>
                <table border="1">
                    <tr>
                        <th>Product ID</th>
                        <th>Name</th>
                        <th>Preis</th>
                        <th>Geändert am</th>
                        <th>Aktionen</th>
                    </tr>
                    <?php foreach ($products as $product) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($product['product_id']); ?></td>
                            <td><?php echo htmlspecialchars($product['product_name']); ?></td>
                            <td><?php echo htmlspecialchars($product['price']); ?></td>
                            <td><?php echo htmlspecialchars($product['changed_at']); ?></td>
                            <td>
                                <div class="action-buttons">
                                <a href="edit_product.php?product_id=<?php echo htmlspecialchars($product['product_id']); ?>">Bearbeiten</a>
                                    <form action="delete_product.php" method="post">
                                        <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                                        <input type="submit" value="Löschen">
                                    </form </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>

        </div>

        <footer>
            <?php include 'footer.php'; ?>
        </footer>
    </div>
</body>

</html>