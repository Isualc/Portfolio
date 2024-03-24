<?php 
include_once 'db.php';

class Products extends Database {
    public $con;
    public $product_id;
    
    public function __construct($db) {
        $this->con = $db; // Setzt die Datenbankverbindung
    }

    public function deleteProduct($product_id) {
        $sql = "DELETE FROM products WHERE product_id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->execute([$product_id]);
    }
    
    
    public function displayProductCards($products) {
        if (is_array($products)) {
            foreach ($products as $product) {
                echo '<div class="product-card">';
                echo '<img src="' . htmlspecialchars($product['pfad_zum_bild']) . '" alt="' . htmlspecialchars($product['product_name']) . '">';
                echo '<h2>' . htmlspecialchars($product['product_name']) . '</h2>';
                echo '<p class="price">' . htmlspecialchars($product['price']) . ' Gold</p>';
                echo '<p>' . htmlspecialchars($product['description']) . '</p>';
                echo '</div>';
            }
        } else {
            echo '<p>Keine Produkte gefunden.</p>';
        }
    }

    public function fetchProductDetails($product_id) {
        $sql = "SELECT product_id, product_name, price, changed_at, pfad_zum_bild, description FROM products WHERE product_id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->execute([$product_id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateProduct($product_id, $product_name, $price, $pfad_zum_bild, $description) {
        $update_sql = "UPDATE products SET product_name = ?, price = ?, pfad_zum_bild = ?, description = ? WHERE product_id = ?";
        $update_stmt = $this->con->prepare($update_sql);
        $update_stmt->execute([$product_name, $price, $pfad_zum_bild, $description, $product_id]);

        return $update_stmt->rowCount() > 0;
    }

}
?>
