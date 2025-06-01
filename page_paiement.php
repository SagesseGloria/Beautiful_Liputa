<?php
/*session_start();

if (!isset($_SESSION['utilisateur'])) {
    header('Location: connexion.php');
    exit();
}

if (empty($_SESSION['cart'])) {
    echo "<p>Votre panier est vide.</p>";
    exit();
}

$utilisateur = $_SESSION['utilisateur'];
$cart = $_SESSION['cart'];
$total = 0;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Paiement</title>
    <style>
        /* Un peu de style rapide */
        /*.container { max-width: 600px; margin: auto; padding: 20px; }
        .box { border: 1px solid #ccc; padding: 15px; margin-bottom: 20px; border-radius: 8px; }
        .btn { background: #4CAF50; color: white; padding: 12px 20px; border: none; border-radius: 5px; font-size: 16px; cursor: pointer; }
        .btn:hover { background-color: #45a049; }
    </style>
</head>
<body>
    <div class="container">
        <h2>🧾 Confirmation de commande</h2>

        <!-- Infos utilisateur -->
        <div class="box">
            <h3>📍 Informations du destinataire</h3>
            <p>Nom : <?= htmlspecialchars($utilisateur['nom']) ?></p>
            <p>Téléphone : <?= htmlspecialchars($utilisateur['telephone']) ?></p>
            <p>Adresse : <?= htmlspecialchars($utilisateur['adresse']) ?></p>
        </div>

        <!-- Liste des articles -->
        <div class="box">
            <h3>🛒 Articles commandés</h3>
            <ul>
                <?php foreach ($cart as $item): ?>
                    <li>
                        <?= htmlspecialchars($item['nom']) ?> — <?= $item['quantite'] ?> × <?= number_format($item['prix'], 2) ?> €
                        <?php $total += $item['quantite'] * $item['prix']; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
            <p><strong>Total : <?= number_format($total, 2) ?> €</strong></p>
        </div>

        <!-- Paiement -->
        <form action="valider_commande.php" method="post">
            <input type="hidden" name="total" value="<?= $total ?>">
            <button type="submit" class="btn">✅ Payer maintenant</button>
        </form>
    </div>
</body>
</html>*/



session_start();
require_once '../admin/config_admin.php'; // Connexion à $pdo

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['customer'])) {
    header('Location: Site_BL.php?redirect=page_paiement.php');
    exit();
}

$customer = $_SESSION['customer'];
$user_id = $customer['id'];

// Récupération des infos du client
$stmt = $pdo->prepare("SELECT full_name, phone, address FROM customer WHERE Customer_ID = ?");
$stmt->execute([$user_id]);
$clientInfos = $stmt->fetch(PDO::FETCH_ASSOC);

// Mode achat unique
if (isset($_GET['mode']) && $_GET['mode'] === 'unique' && isset($_SESSION['achat_unique'])) {
    $achat = $_SESSION['achat_unique'];

    $cart = [[
        'nom' => $achat['nom'],
        'quantite' => $achat['quantite'],
        'taille' => $achat['taille'],
        'prix' => $achat['prix']
    ]];
} else {
    // Panier classique
    $stmt = $pdo->prepare("
        SELECT cart.Cart_ID, cart.Quantity AS quantite, cart.Size AS taille, 
               product.Product_Name AS nom, product.Price AS prix
        FROM cart
        JOIN product ON cart.Product_ID = product.Product_ID
        WHERE cart.Customer_ID = ?
    ");
    $stmt->execute([$user_id]);
    $cart = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Vérifie si le panier est vide
if (empty($cart)) {
    echo "<p>Votre panier est vide.</p>";
    exit();
}

// ✅ Calcul du sous-total
$total = 0;
foreach ($cart as $item) {
    $total += $item['quantite'] * $item['prix'];
}

// ✅ Calcul des frais de livraison
$livraison = 0;
if ($total <= 10000) {
    $livraison = 2500;
} elseif ($total <= 25000) {
    $livraison = 1500;
}

// ✅ Total final
$grandTotal = $total + $livraison;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Paiement</title>
    <style>
        .container { max-width: 600px; margin: auto; padding: 20px; }
        .box { border: 1px solid #ccc; padding: 15px; margin-bottom: 20px; border-radius: 8px; }
        .btn { background: #4CAF50; color: white; padding: 12px 20px; border: none; border-radius: 5px; font-size: 16px; cursor: pointer; }
        .btn:hover { background-color: #45a049; }
    </style>
</head>
<body>
    <div class="container">
        <h2>🧾 Confirmation de commande</h2>

        <!-- Infos utilisateur -->
        <div class="box">
            <h3>📍 Informations du destinataire</h3>
            <p>Nom : <?= htmlspecialchars($clientInfos['full_name']) ?></p>
            <p>Téléphone : <?= htmlspecialchars($clientInfos['phone']) ?></p>
            <p>Adresse : <?= htmlspecialchars($clientInfos['address']) ?></p>
        </div>

        <!-- Liste des articles -->
        <div class="box">
            <h3>🛒 Articles commandés</h3>
            <ul>
                <?php foreach ($cart as $item): ?>
                    <li>
                        <?= htmlspecialchars($item['nom']) ?> — <?= $item['quantite'] ?> × <?= number_format($item['prix'], 0, ',', ' ') ?> FCFA
                    </li>
                <?php endforeach; ?>
            </ul>
            <p>Sous-total : <?= number_format($total, 0, ',', ' ') ?> FCFA</p>
            <p>Frais de livraison : <?= number_format($livraison, 0, ',', ' ') ?> FCFA</p>
            <p><strong>Total à payer : <?= number_format($grandTotal, 0, ',', ' ') ?> FCFA</strong></p>
        </div>

        <!-- Bouton de paiement -->
        <form action="choisir_paiement.php" method="post">
            <input type="hidden" name="total" value="<?= $grandTotal ?>">
            <button type="submit" class="btn">✅ Payer maintenant</button>
        </form>
    </div>
</body>
</html>
