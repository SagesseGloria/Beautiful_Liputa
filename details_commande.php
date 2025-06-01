<?php
/*session_start();
require_once '../admin/config_admin.php';

if (!isset($_SESSION['customer'])) {
    header("Location: connexion.php");
    exit;
}

$customer_id = $_SESSION['customer']['id'];
$commande_id = $_GET['Order_ID'] ?? null;

if (!$commande_id) {
    die("Aucune commande sélectionnée.");
}

// Vérifie que la commande appartient au client connecté
$stmt = $pdo->prepare("SELECT * FROM orders WHERE Order_ID = ? AND customer_ID = ?");
$stmt->execute([$commande_id, $customer_id]);
$commande = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$commande) {
    die("Commande introuvable ou non autorisée.");
}

// Récupère les articles de la commande avec les infos produits associées
$stmt = $pdo->prepare("
SELECT 
    order_items.*, 
    product.Product_Name, 
    product.Image
FROM order_items
INNER JOIN product ON order_items.Product_ID = product.Product_ID
WHERE order_items.Order_Item_ID = ?
");

$stmt->execute([$commande_id]);
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails de la commande</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 40px;
        }

        h1 {
            color: #003399;
        }

        .info {
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: center;
        }

        th {
            background-color: #003399;
            color: white;
        }

        img {
            height: 80px;
        }
    </style>
</head>
<body>

    <h1>Détails de la commande #<?= htmlspecialchars($commande_id) ?></h1>

    <div class="info">
        <p><strong>Date :</strong> <?= date('d/m/Y', strtotime($commande['Order_Date'])) ?></p>
        <p><strong>Total payé :</strong> <?= number_format($commande['Total_Amount'], 2, ',', ' ') ?> FCFA</p>
        <p><strong>Statut :</strong> <?= htmlspecialchars($commande['Order_Status']) ?></p>
    </div>

    <h2>Articles</h2>

    <table>
        <thead>
            <tr>
                <th>Photo</th>
                <th>Nom</th>
                <th>Taille</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Sous-total</th>
            </tr>
        </thead>
        <tbody>
    <?php foreach ($articles as $article): ?>
        <tr>
            <td>
                <img src="/Beautiful Liputa/admin/<?= htmlspecialchars($article['Image']) ?>" alt="<?= htmlspecialchars($article['Product_Name']) ?>">
            </td>
            <td><?= htmlspecialchars($article['Product_Name']) ?></td>
            <td><?= htmlspecialchars($article['Size'] ?? '-') ?></td><!-- Si tu n’as pas de colonne taille, mets un tiret ou adapte si tu l’as ailleurs -->
            <td><?= htmlspecialchars($article['Quantity']) ?></td>
            <td><?= number_format($article['Price'], 2, ',', ' ') ?> FCFA</td>
            <td><?= number_format($article['Quantity'] * $article['Price'], 2, ',', ' ') ?> FCFA</td>
        </tr>
    <?php endforeach; ?>
</tbody>

    </table>

    <p style="margin-top: 30px;">
        <a href="historique_commandes.php" style="text-decoration: none; color: #003399;">← Retour à l'historique</a>
    </p>

</body>
</html>*/


session_start();
require_once '../admin/config_admin.php';

if (!isset($_SESSION['customer'])) {
    header("Location: connexion.php");
    exit;
}

$customer_id = $_SESSION['customer']['id'];
$commande_id = $_GET['Order_ID'] ?? null;

if (!$commande_id) {
    die("Aucune commande sélectionnée.");
}

// Récupère les infos de la commande
$stmt = $pdo->prepare("SELECT * FROM orders WHERE Order_ID = ? AND customer_ID = ?");
$stmt->execute([$commande_id, $customer_id]);
$commande = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$commande) {
    die("Commande introuvable ou non autorisée.");
}

// Récupère les articles de la commande
$stmt = $pdo->prepare("
    SELECT 
        order_items.*, 
        product.Product_Name, product.Size, product.Image
    FROM order_items
    INNER JOIN product ON order_items.Product_ID = product.Product_ID
    WHERE order_items.Order_ID = ?
");
$stmt->execute([$commande_id]);
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails de la commande</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 40px;
        }

        h1 {
            color: #003399;
        }

        .info {
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: center;
        }

        th {
            background-color: #003399;
            color: white;
        }

        img {
            height: 80px;
        }
    </style>
</head>
<body>

    <h1>Détails de la commande #<?= htmlspecialchars($commande['Order_Number']) ?></h1>

    <div class="info">
        <p><strong>Date :</strong> <?= date('d/m/Y', strtotime($commande['Order_Date'])) ?></p>
        <p><strong>Total payé :</strong> <?= number_format($commande['Total_Amount'], 2, ',', ' ') ?> FCFA</p>
        <p><strong>Statut :</strong> <?= htmlspecialchars($commande['Order_Status']) ?></p>
    </div>

    <h2>Articles</h2>

    <?php if (empty($articles)): ?>
        <p>Aucun article trouvé pour cette commande.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Nom</th>
                    <th>Taille</th>
                    <th>Quantité</th>
                    <th>Prix unitaire</th>
                    <th>Sous-total</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($articles as $article): ?>
                <tr>
                    <td><img src="/Beautiful Liputa/admin/<?= htmlspecialchars($article['Image']) ?>" alt="<?= htmlspecialchars($article['Product_Name']) ?>"></td>
                    <td><?= htmlspecialchars($article['Product_Name']) ?></td>
                    <td><?= htmlspecialchars($article['Size'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($article['Quantity']) ?></td>
                    <td><?= number_format($article['Price'], 2, ',', ' ') ?> FCFA</td>
                    <td><?= number_format($article['Price'] * $article['Quantity'], 2, ',', ' ') ?> FCFA</td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <p style="margin-top: 30px;">
        <a href="historique_commandes.php" style="text-decoration: none; color: #003399;">← Retour à l'historique</a>
    </p>

</body>
</html>
