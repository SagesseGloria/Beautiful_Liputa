<?php
/*session_start();
?>

<h1>Mon Panier</h1>

<?php if (empty($_SESSION['cart'])): ?>
    <p>Votre panier est vide.</p>
<?php else: ?>
    <table border="1" cellpadding="10">
        <tr>
            <th>Image</th>
            <th>Produit</th>
            <th>Prix</th>
            <th>Quantité</th>
            <th>Total</th>
        </tr>
        <?php $total = 0; ?>
        <?php foreach ($_SESSION['cart'] as $id => $item): ?>
            <tr>
                <td><img src="/Beautiful Liputa/admin/<?= htmlspecialchars($item['image']) ?>" width="50"></td>
                <td><?= htmlspecialchars($item['name']) ?></td>
                <td><?= number_format($item['price'], 2) ?> FCFA</td>
                <td><?= $item['quantity'] ?></td>
                <td><?= number_format($item['price'] * $item['quantity'], 2) ?> FCFA</td>
            </tr>
            <?php $total += $item['price'] * $item['quantity']; ?>
        <?php endforeach; ?>
        <tr>
            <td colspan="4"><strong>Total général</strong></td>
            <td><strong><?= number_format($total, 2) ?> FCFA</strong></td>
        </tr>
    </table>
    <form method="post" action="update_cart.php" onsubmit="return confirm('Voulez-vous vraiment mettre à jour la quantité ?');">
  <input type="hidden" name="product_id" value="<?= $id ?>">
  <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="0" max="STOCK_MAX" style="width:60px;">
  <button type="submit" class="btn btn-warning">Modifier</button>
</form>

<form method="post" action="remove_from_cart.php" onsubmit="return confirm('Voulez-vous vraiment supprimer ce produit ?');" style="display:inline;">
  <input type="hidden" name="product_id" value="<?= $id ?>">
  <button type="submit" class="btn btn-danger">Supprimer</button>
</form>

<?php endif; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Panier</title>
<style>
  table {
    width: 90%;
    margin: 20px auto;
    border-collapse: collapse;
  }
  th, td {
    padding: 12px;
    text-align: center;
    border-bottom: 1px solid #ccc;
  }
  th {
    background-color: #003399;
    color: white;
  }
  tr:hover {
    background-color: #f5f5f5;
  }
  img {
    max-width: 60px;
    border-radius: 8px;
  }
  .btn {
    padding: 6px 12px;
    background-color: #003399;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }
  .btn-danger {
    background-color: #cc0000;
  }
  .btn-warning {
    background-color: #ff9900;
  }
  .error {
    color: red;
    font-weight: bold;
    margin: 15px auto;
    text-align: center;
  }
  .success {
    color: green;
    font-weight: bold;
    margin: 15px auto;
    text-align: center;
  }
</style>
</html>*/

/*session_start();

// Nettoyer les produits avec quantité 0
foreach ($_SESSION['cart'] ?? [] as $key => $item) {
  if (!isset($item['quantite']) || $item['quantite'] < 1) {
      unset($_SESSION['cart'][$key]);
  }
}

$cart = $_SESSION['cart'] ?? [];
$total = 0;

// Calculer total
foreach ($cart as $item) {
    $total += $item['prix'] * $item['quantite'];
}

// Calcul livraison
$livraison = 0;
if ($total <= 10000) {
    $livraison = 2500;
} elseif ($total <= 25000) {
    $livraison = 1500;
} // au-delà : gratuit

$grandTotal = $total + $livraison;
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Panier</title>
    <style>
        .cart-wrapper {
    max-width: 800px;
    margin: 40px auto;
    padding: 20px;
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.cart-wrapper h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #222;
}

.cart-item {
    display: flex;
    align-items: center;
    gap: 16px;
    border-bottom: 1px solid #eee;
    padding: 16px 0;
}

.cart-item:last-child {
    border-bottom: none;
}

.cart-item img {
    width: 100px;
    height: auto;
    border-radius: 12px;
    object-fit: cover;
}

.item-details {
    flex: 1;
}

.item-details h3 {
    margin: 0;
    font-size: 18px;
}

.item-details p {
    margin: 4px 0;
    font-size: 14px;
}
.buy-btn { background-color: #003399; color: white; padding: 10px 20px; border: none; border-radius: 8px; cursor: pointer; font-size: 16px; }
.update-btn { background-color: #003399; color: white; padding: 10px 20px; border: none; border-radius: 8px; cursor: pointer; font-size: 16px; }
.quantity-delete {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 8px;
}

.delete-form {
    margin: 0;
}

.delete-btn {
    background-color: #003399;
    color: white;
    border: none;
    padding: 6px 12px;
    border-radius: 8px;
    cursor: pointer;
    font-size: 14px;
}

.delete-btn:hover{ background-color: #c0392b;}  .buy-btn:hover {background-color:rgb(4, 96, 45);} 

    </style>
</head>
<body>
<div class="cart-wrapper">
    <h1>Votre panier</h1>

    <?php if (empty($cart)): ?>
        <p>Votre panier est vide.</p>
    <?php else: ?>
        <form method="post" action="update_cart.php">
            <?php foreach ($cart as $index => $item): ?>
                <div class="cart-item">
                    <img src="/Beautiful Liputa/admin/<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['nom']) ?>">
                    <div>
                        <p><strong><?= htmlspecialchars($item['nom']) ?></strong></p>
                        <p>Taille : <?= htmlspecialchars($item['taille']) ?></p>
                        <p>Prix : <?= number_format($item['prix'], 0, ',', ' ') ?> FCFA</p>
                        <label>Quantité :
                            <input type="number" name="quantite[<?= $index ?>]" value="<?= $item['quantite'] ?>" min="0">
                        </label>
                    </div>
                </div>
            <?php endforeach; ?>

            <button type="submit" class="update-btn">Mettre à jour</button>
        </form>

        <div class="cart-summary">
            <p>Sous-total : <?= number_format($total, 0, ',', ' ') ?> FCFA</p>
            <p>Livraison : <?= number_format($livraison, 0, ',', ' ') ?> FCFA</p>
            <p><strong>Total à payer : <?= number_format($grandTotal, 0, ',', ' ') ?> FCFA</strong></p>
        </div>

        <?php if (!empty($_SESSION['cart'])): ?>
    <form action="check_user.php" method="post">
        <button type="submit" class="buy-btn">Acheter maintenant</button>
    </form>
<?php endif; ?>
    <?php endif; ?>
</div>
</body>
</html>*/

session_start();
require_once '../admin/config_admin.php'; // Connexion PDO

if (!isset($_SESSION['customer'])) {
    header("Location: Site_BL.php");
    exit;
}

$user_id = $_SESSION['customer']['id'];

// Récupérer les éléments du panier depuis la base, avec les infos produits
$stmt = $pdo->prepare("
    SELECT cart.cart_ID, cart.Quantity as quantite, cart.Size as taille, 
           product.Product_Name, product.Price, product.image, product.Product_ID as Product_ID
    FROM cart
    JOIN product ON cart.Product_ID = product.Product_ID
    WHERE cart.Customer_ID = ?
");
$stmt->execute([$user_id]);
$cart = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Calcul du total
$total = 0;
foreach ($cart as $item) {
    $total += $item['Price'] * $item['quantite'];
}

// Livraison
$livraison = 0;
if ($total <= 10000) {
    $livraison = 2500;
} elseif ($total <= 25000) {
    $livraison = 1500;
}

$grandTotal = $total + $livraison;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Panier</title>
    <style>
        .cart-wrapper {
    max-width: 800px;
    margin: 40px auto;
    padding: 20px;
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.cart-wrapper h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #222;
}

.cart-item {
    display: flex;
    align-items: center;
    gap: 16px;
    border-bottom: 1px solid #eee;
    padding: 16px 0;
}

.cart-item:last-child {
    border-bottom: none;
}

.cart-item img {
    width: 100px;
    height: auto;
    border-radius: 12px;
    object-fit: cover;
}

.item-details {
    flex: 1;
}

.item-details h3 {
    margin: 0;
    font-size: 18px;
}

.item-details p {
    margin: 4px 0;
    font-size: 14px;
}
.buy-btn { background-color: #003399; color: white; padding: 10px 20px; border: none; border-radius: 8px; cursor: pointer; font-size: 16px; }
.update-btn { background-color: #003399; color: white; padding: 10px 20px; border: none; border-radius: 8px; cursor: pointer; font-size: 16px; }
.quantity-delete {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 8px;
}

.delete-form {margin: 0;}
.actions {
    margin-top: 8px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.delete-btn {
    background-color: #003399;
    color: white;
    border: none;
    padding: 6px 12px;
    border-radius: 8px;
    cursor: pointer;
    font-size: 14px;
}
.buy-btn:hover {background-color:rgb(4, 96, 45);}

.btn-delete:hover{ background-color: #c0392b;}  .btn-buy:hover {background-color:rgb(4, 96, 45);}
.actions form, .actions a { margin-left: 10px; display: inline-block; text-decoration: none; }
        .btn { padding: 6px 12px; border: none; border-radius: 5px; cursor: pointer; font-size: 14px; }
        .btn-delete { background: #dc3545; background-color: #003399;  color: white; }
        .btn-buy { background-color: #003399; color: white; }

    </style>
</head>
<body>
<div class="cart-wrapper">
    <h1>Votre panier</h1>

    <?php if (empty($cart)): ?>
        <p>Votre panier est vide.</p>
    <?php else: ?>
        <?php foreach ($cart as $item): ?>
    <div class="cart-item">
        <img src="/Beautiful Liputa/admin/<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['Product_Name']) ?>">
        <div class="item-details">
            <p><strong><?= htmlspecialchars($item['Product_Name']) ?></strong></p>
            <p>Taille : <?= htmlspecialchars($item['taille']) ?></p>
            <p>Prix : <?= number_format($item['Price'], 0, ',', ' ') ?> FCFA</p>

            <!-- Formulaire de mise à jour de quantité -->
            <form method="post" action="update_cart.php" style="display:inline;">
                <label>Quantité :
                    <input type="number" name="quantite" value="<?= $item['quantite'] ?>" min="1">
                </label>
                <input type="hidden" name="cart_id" value="<?= $item['cart_ID'] ?>">
                <button type="submit" class="update-btn">Mettre à jour</button>
            </form>

            <div class="actions">
                <!-- Supprimer -->
                <a href="supprimer_article.php?id=<?= $item['cart_ID'] ?>" class="btn btn-delete">🗑️ Supprimer</a>

                <!-- Acheter ce seul article -->
                <form action="acheter_article.php" method="post" style="display:inline;">
                    <input type="hidden" name="product_id" value="<?= $item['Product_ID'] ?>">
                    <input type="hidden" name="product_name" value="<?= $item['Product_Name'] ?>">
                    <input type="hidden" name="quantite" value="<?= $item['quantite'] ?>">
                    <input type="hidden" name="taille" value="<?= $item['taille'] ?>">
                    <input type="hidden" name="prix" value="<?= $item['Price'] ?>">
                    <button type="submit" class="btn btn-buy">🛍️ Acheter</button>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

            <!--<button type="submit" class="update-btn">Mettre à jour</button>-->

        <div class="cart-summary">
            <p>Sous-total : <?= number_format($total, 0, ',', ' ') ?> FCFA</p>
            <p>Livraison : <?= number_format($livraison, 0, ',', ' ') ?> FCFA</p>
            <p><strong>Total à payer : <?= number_format($grandTotal, 0, ',', ' ') ?> FCFA</strong></p>
        </div>

        <form action="page_paiement.php" method="post">
            <button type="submit" class="buy-btn">Acheter maintenant</button>
        </form>
    <?php endif; ?>
</div>
</body>
</html>