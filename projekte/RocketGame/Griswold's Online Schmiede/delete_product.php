<?php 
include_once 'db.php';
include_once 'products.php';

$db = (new Database())->getConnection();
$product = new Products($db);

if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $product->deleteProduct($product_id);
}

// Umleitung nach dem Löschen
header("Location: admin_dashboard.php");
exit();
?>