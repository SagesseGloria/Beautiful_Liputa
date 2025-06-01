<?php
require_once '../admin/config_admin.php';
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

if (!isset($_GET['id'])) {
    echo "Fournisseur introuvable.";
    exit;
}

$id = intval($_GET['id']);

// Vérifier que le fournisseur existe
$stmt = $pdo->prepare("SELECT Supplier_Name FROM supplier WHERE Supplier_ID = ?");
$stmt->execute([$id]);
$fournisseur = $stmt->fetch();

if (!$fournisseur) {
    echo "Fournisseur non trouvé.";
    exit;
}

// Récupérer ses produits
$stmt = $pdo->prepare("SELECT * FROM Product WHERE Supplier_ID = ?");
$stmt->execute([$id]);
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Produits du fournisseur</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f9f9f9; padding: 30px; }
        h2 { margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; background: white; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        th { background-color: #eee; }
    </style>
</head>
<body>
    <h2>Produits de <?= htmlspecialchars($fournisseur['Supplier_Name']) ?></h2>

    <?php if (count($produits) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>ID du produit</th>
                    <th>Nom</th>
                    <th>Prix</th>
                    <th>Catégorie</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produits as $produit): ?>
                    <tr>
                        <td><?= htmlspecialchars($produit['Product_ID']) ?></td>
                        <td><?= htmlspecialchars($produit['Product_Name']) ?></td>
                        <td><?= htmlspecialchars($produit['Price']) ?> FCFA</td>
                        <td><?= htmlspecialchars($produit['Category_ID']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Ce fournisseur n'a pas encore proposé de produits.</p>
    <?php endif; ?>
</body>
</html>
