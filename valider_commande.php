<?php
session_start();
require_once '../admin/config_admin.php'; // Connexion à $pdo

// Vérifie que le client est connecté
if (!isset($_SESSION['customer'])) {
    header("Location: Site_BL.php");
    exit();
}

$customer = $_SESSION['customer'];
$customer_id = $customer['id'];
$mode_paiement = $_SESSION['mode_paiement'] ?? 'inconnu';

// Vérifie que le panier n'est pas vide
$stmt = $pdo->prepare("
    SELECT cart.Cart_ID, cart.Quantity AS quantite, cart.Size AS taille, 
           product.Product_ID, product.Product_Name AS nom, product.Price AS prix
    FROM cart
    JOIN product ON cart.Product_ID = product.Product_ID
    WHERE cart.Customer_ID = ?
");
$stmt->execute([$customer_id]);
$cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($cart_items)) {
    echo "<p>Votre panier est vide.</p>";
    exit();
}

// 1. Génère un numéro de commande unique
$order_number = strtoupper(uniqid("CMD"));

// 2. Calcule le total
$total = 0;
foreach ($cart_items as $item) {
    $total += $item['quantite'] * $item['prix'];
}

// 3. Insère dans la table `orders`
$insertOrder = $pdo->prepare("
    INSERT INTO orders (Order_Number, Order_Date, Order_Status, Total_Amount, Customer_ID)
    VALUES (?, NOW(), 'En attente', ?, ?)
");
$insertOrder->execute([$order_number, $total, $customer_id]);

$order_id = $pdo->lastInsertId(); // Récupère l'ID de la commande insérée

// 4. Insère chaque produit dans `order_items`
$insertItem = $pdo->prepare("
    INSERT INTO order_items (Order_ID, Product_ID, Quantity, Price)
    VALUES (?, ?, ?, ?)
");

foreach ($cart_items as $item) {
    $insertItem->execute([
        $order_id,
        $item['Product_ID'],
        $item['quantite'],
        $item['prix']
    ]);
}

// 5. Vide le panier
$deleteCart = $pdo->prepare("DELETE FROM cart WHERE Customer_ID = ?");
$deleteCart->execute([$customer_id]);

// 6. Supprime le mode de paiement pour éviter la répétition
unset($_SESSION['mode_paiement']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Commande confirmée</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .confirmation {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.1);
            text-align: center;
        }

        h2 {
            color: #28a745;
            margin-bottom: 20px;
        }

        p {
            color: #333;
            font-size: 18px;
        }

        .btn {
            margin-top: 30px;
            padding: 12px 24px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="confirmation">
    <h2>🎉 Commande confirmée !</h2>
    <p>Merci pour votre achat.</p>
    <p>Numéro de commande : <strong><?= htmlspecialchars($order_number) ?></strong></p>
    <p>Montant total : <strong><?= number_format($total, 0, ',', ' ') ?> FCFA</strong></p>
    <p>Mode de paiement : <strong><?= ucfirst($mode_paiement) ?></strong></p>

    <a href="Site_BL.php" class="btn">Retour à l'accueil</a>
</div>

</body>
</html>