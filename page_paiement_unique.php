<?php
/*session_start();
require_once '../admin/config_admin.php';

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['customer'])) {
    header('Location: Site_BL.php?redirect=page_paiement_unique.php');
    exit();
}

// Vérifie que l'article à acheter est bien défini
if (!isset($_SESSION['achat_unique'])) {
    echo "<p>Aucun article sélectionné pour l'achat.</p>";
    exit();
}

// Récupère les infos de l'article unique
$achat = $_SESSION['achat_unique'];
$cart = [[
    'nom' => $achat['product_name'],
    'quantite' => $achat['quantite'],
    'taille' => $achat['taille'],
    'prix' => $achat['prix']
]];

$total = $achat['quantite'] * $achat['prix'];

// Récupère les infos du client
$customer = $_SESSION['customer'];
$user_id = $customer['id'];
$stmt = $pdo->prepare("SELECT full_name, phone, address FROM customer WHERE Customer_ID = ?");
$stmt->execute([$user_id]);
$clientInfos = $stmt->fetch(PDO::FETCH_ASSOC);
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

        <!-- Article commandé -->
        <div class="box">
            <h3>🛒 Article commandé</h3>
            <ul>
                <li>
                    <?= htmlspecialchars($achat['product_name']) ?>
                    — <?= $achat['quantite'] ?> × <?= number_format($achat['prix'], 0, ',', ' ') ?> FCFA
                    — Taille : <?= htmlspecialchars($achat['taille']) ?>
                </li>
            </ul>
            <p><strong>Total : <?= number_format($total, 0, ',', ' ') ?> FCFA</strong></p>
        </div>

        <!-- Bouton de paiement -->
        <form action="choisir_paiement.php" method="post">
            <input type="hidden" name="total" value="<?= $total ?>">
            <input type="hidden" name="mode" value="unique">
            <input type="hidden" name="nom" value="<?= htmlspecialchars($achat['product_name']) ?>">
            <input type="hidden" name="taille" value="<?= htmlspecialchars($achat['taille']) ?>">
            <input type="hidden" name="quantite" value="<?= $achat['quantite'] ?>">
            <input type="hidden" name="prix" value="<?= $achat['prix'] ?>">
            <button type="submit" class="btn">✅ Payer maintenant</button>
        </form>
    </div>
</body>
</html>
*/

session_start();
require_once '../admin/config_admin.php'; // Connexion à $pdo

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['customer'])) {
    header('Location: Site_BL.php?redirect=page_paiement_unique.php');
    exit();
}

// Vérifie si un achat unique est bien défini
if (!isset($_SESSION['achat_unique'])) {
    echo "<p>Aucun article sélectionné pour l'achat.</p>";
    exit();
}

$achat = $_SESSION['achat_unique'];
$cart = [[
    'nom' => $achat['nom'],
    'quantite' => $achat['quantite'],
    'taille' => $achat['taille'],
    'prix' => $achat['prix']
]];
$total = $achat['quantite'] * $achat['prix'];

$customer = $_SESSION['customer'];
$user_id = $customer['id'];

// Récupération des infos du client
$stmt = $pdo->prepare("SELECT full_name, phone, address FROM customer WHERE Customer_ID = ?");
$stmt->execute([$user_id]);
$clientInfos = $stmt->fetch(PDO::FETCH_ASSOC);

// Calcul des frais de livraison
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

        <!-- Article -->
        <div class="box">
            <h3>🛒 Article commandé</h3>
            <ul>
                <li>
                    <?= htmlspecialchars($achat['nom']) ?> — 
                    <?= $achat['quantite'] ?> × 
                    <?= number_format($achat['prix'], 0, ',', ' ') ?> FCFA
                </li>
            </ul>
            <p>Sous-total : <?= number_format($total, 0, ',', ' ') ?> FCFA</p>
            <p>Frais de livraison : <?= number_format($livraison, 0, ',', ' ') ?> FCFA</p>
            <p><strong>Total à payer : <?= number_format($grandTotal, 0, ',', ' ') ?> FCFA</strong></p>


        </div>

        <!-- Bouton vers paiement -->
        <form action="choisir_paiement_unique.php" method="post">
        <input type="hidden" name="total" value="<?= $grandTotal ?>">
            <button type="submit" class="btn">✅ Payer maintenant</button>
        </form>
    </div>
</body>
</html>
