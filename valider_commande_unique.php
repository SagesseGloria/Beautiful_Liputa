<?php
/*$achat = $_SESSION['achat_unique'];

$stmt = $pdo->prepare("SELECT Product_ID FROM product WHERE Product_Name = ?");
$stmt->execute([$achat['nom']]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

$produit_id = $product['Product_ID'];
$quantite = $achat['quantite'];
$prix = $achat['prix'];
$total = $quantite * $prix;

// Insertion commande...
// Insertion item...
// Suppression de CE produit du panier
$delete = $pdo->prepare("
    DELETE FROM cart 
    WHERE Customer_ID = ? 
      AND Product_ID = ? 
      AND Size = ? 
    LIMIT 1
");
$delete->execute([$customer_id, $produit_id, $achat['taille']]);
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
</html>*/


session_start();
require_once '../admin/config_admin.php'; // Connexion à $pdo

if (!isset($_SESSION['customer'])) {
    header("Location: Site_BL.php");
    exit();
}

$customer = $_SESSION['customer'];
$customer_id = $customer['id'];

if (!isset($_SESSION['achat_unique'])) {
    echo "Achat introuvable.";
    exit();
}

$achat = $_SESSION['achat_unique'];
$order_number = strtoupper(uniqid("CMD"));
$mode_paiement = $_SESSION['mode_paiement'] ?? 'inconnu';

$stmt = $pdo->prepare("SELECT Product_ID FROM product WHERE Product_Name = ?");
$stmt->execute([$achat['nom']]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    echo "Produit non trouvé.";
    exit();
}

$produit_id = $product['Product_ID'];
$quantite = $achat['quantite'];
$prix = $achat['prix'];
$total = $quantite * $prix;
$livraison = 0;
if ($total <= 10000) {
    $livraison = 2500;
} elseif ($total <= 25000) {
    $livraison = 1500;
}
$grandTotal = $total + $livraison;

// Insertion commande
$insertOrder = $pdo->prepare("
    INSERT INTO orders (Order_Number, Order_Date, Order_Status, Total_Amount, Customer_ID)
    VALUES (?, NOW(), 'En attente', ?, ?)
");
$insertOrder->execute([$order_number, $grandTotal, $customer_id]);
$order_id = $pdo->lastInsertId();

// Insertion produit dans order_items
$insertItem = $pdo->prepare("
    INSERT INTO order_items (Order_ID, Product_ID, Quantity, Price)
    VALUES (?, ?, ?, ?)
");
$insertItem->execute([$order_id, $produit_id, $quantite, $prix]);

// Suppression du panier
$delete = $pdo->prepare("
    DELETE FROM cart 
    WHERE Customer_ID = ? 
      AND Product_ID = ? 
      AND Size = ? 
    LIMIT 1
");
$delete->execute([$customer_id, $produit_id, $achat['taille']]);

unset($_SESSION['achat_unique'], $_SESSION['mode_paiement']);
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
    <p>Montant total : <strong><?= number_format($grandTotal, 0, ',', ' ') ?> FCFA</strong></p>
    <p>Mode de paiement : <strong><?= ucfirst($mode_paiement) ?></strong></p>

    <a href="Site_BL.php" class="btn">Retour à l'accueil</a>
</div>

</body>
</html>
