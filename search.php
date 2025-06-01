<?php
require_once("../admin/config_admin.php");

$q = isset($_GET['q']) ? trim($_GET['q']) : '';
$q = htmlspecialchars($q);

if (!empty($q)) {
    $sql = "SELECT * FROM product WHERE Product_Name LIKE :search OR Description_product LIKE :search";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['search' => "%$q%"]);
} else {
    // Requête pour tout afficher
    $sql = "SELECT * FROM product";
    $stmt = $pdo->query($sql);
}

$results = $stmt->fetchAll();

    if ($results) {
        foreach ($results as $product) {
            echo '<div class="product">';
            echo '<img src="/Beautiful Liputa/admin/' . htmlspecialchars($product['Image']) . '" alt="' . htmlspecialchars($product['Product_Name']) . '">';
            echo '<h3>' . htmlspecialchars($product['Product_Name']) . '</h3>';
            echo '<p>' . htmlspecialchars($product['Description_product']) . '</p>';
            echo '<p><strong>Prix: </strong>' . number_format($product['Price'], 2) . ' FCFA</p>';
            // Formulaire d'ajout au panier
            echo '<form method="post" action="panier.php">';
            echo '<input type="hidden" name="product_id" value="' . $product['Product_ID'] . '">';
            echo '<input type="hidden" name="product_name" value="' . htmlspecialchars($product['Product_Name']) . '">';
            echo '<input type="hidden" name="product_price" value="' . $product['Price'] . '">';
            echo '<input type="hidden" name="product_size" value="' . htmlspecialchars($product['size']) . '">';
            echo '<input type="hidden" name="product_image" value="' . htmlspecialchars($product['Image']) . '">';
            echo '<button type="submit" class="add-to-cart-btn">Ajouter au panier</button>';
            echo '</form>';

            echo '</div>';
        }
    } else {
        echo '<p>Aucun produit trouvé.</p>';
    }
?>






