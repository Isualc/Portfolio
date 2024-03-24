<?php
include_once 'db.php';
include_once 'products.php';

$error = '';
$db = (new Database())->getConnection();
$productObj = new Products($db);

$product_id = $_GET['product_id'] ?? null;
$productDetails = null;

if ($product_id) {
  $productDetails = $productObj->fetchProductDetails($product_id);

  if (!$productDetails) {
    $error = "Produkt nicht gefunden.";
  }
} else {
  $error = "Keine Produkt-ID angegeben.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_product'])) {
  $product_name = $_POST['product_name'];
  $price = $_POST['price'];
  $pfad_zum_bild = $_POST['pfad_zum_bild'];
  $description = $_POST['description'];
  $updateResult = $productObj->updateProduct($product_id, $product_name, $price, $pfad_zum_bild, $description);
  if ($updateResult) {
    header("Location: admin_dashboard.php");
    exit;
  } else {
    $error = "Fehler beim Aktualisieren des Produkts.";
  }
}


$previousUrl = $_SERVER['HTTP_REFERER'] ?? null;
?>

<!DOCTYPE html>
<html lang="de">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Edit</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
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
    <h1>Produkt Bearbeiten</h1>
    <div class="update-product-container">
      <?php if ($error) : ?>
        <p class="error"><?php echo $error; ?></p>
      <?php endif; ?>

      <?php if ($product_id && $productDetails) : ?>
        <form action="edit_product.php?product_id=<?php echo htmlspecialchars($product_id); ?>" method="post">
          <!-- Formularfelder, vorbefüllt mit $productDetails-Daten -->
          <label for="product_id">Produkt-ID:</label>
          <input type="text" id="product_id" name="product_id" value="<?php echo htmlspecialchars($productDetails['product_id']); ?>" required><br><br>
          <label for="product_name">Produktname:</label>
          <input type="text" id="product_name" name="product_name" value="<?php echo htmlspecialchars($productDetails['product_name']); ?>" required><br><br>
          <label for="price">Preis:</label>
          <input type="text" id="price" name="price" value="<?php echo htmlspecialchars($productDetails['price']); ?>" required><br><br>
          <label for="changed_at">Zuletzt Geändert:</label>
          <input type="text" id="changed_at" name="changed_at" value="<?php echo htmlspecialchars($productDetails['changed_at']); ?>" required><br><br>
          <label for="pfad_zum_bild">Pfad zum Bild:</label>
          <input type="text" id="pfad_zum_bild" name="pfad_zum_bild" value="<?php echo htmlspecialchars($productDetails['pfad_zum_bild']); ?>" required><br><br>
          <label for="description">Beschreibung:</label>
          <textarea id="description" name="description" required><?php echo htmlspecialchars($productDetails['description']); ?></textarea><br><br>
          <input type="submit" name="update_product" value="Produkt aktualisieren">
        </form>
      <?php endif; ?>
    </div>
  </div>

  <?php include 'footer.php'; ?>
</body>

</html>