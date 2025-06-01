<?php
session_start();
require_once '../admin/config_admin.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

// Récupération des fournisseurs
$stmt = $pdo->query("SELECT * FROM supplier ORDER BY Supplier_ID DESC");
$fournisseurs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des fournisseurs</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f9f9f9; padding: 30px; }
        h1 { color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: center; }
        th {background-color: #f2f2f2; }
        .btn-disabled { background-color: #aaa; color: #fff; padding: 8px 12px; border: none; border-radius: 4px; cursor: not-allowed; }
        .badge { padding: 4px 10px; border-radius: 4px; font-size: 13px; }
        .badge.en_attente { background-color: orange; color: white; }
        .badge.en_test { background-color: #17a2b8; color: white; }
        .badge.actif { background-color: #28a745; color: white; }
        .badge.refusé { background-color: #dc3545; color: white; }
        .add_supplier {
      display: inline-block;
      padding: 10px 15px;
      background-color: #003399;
      color: white;
      text-decoration: none;
      border-radius: 5px;
    font-weight: bold;
    }
    .btn-view, .btn-delete {
    padding: 6px 10px;
    border: none;
    border-radius: 4px;
    color: white;
    text-decoration: none;
    margin: 2px;
}

.btn-view {
    background-color: #007bff;
}

.btn-delete {
    background-color: #dc3545;
}

    </style>
</head>
<body>
    <h1>Fournisseurs</h1>
    <div >
  <a href="ajouter_fournisseur.php" class="add_supplier">➕ Ajouter un fournisseur</a>
</div>

    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Statut du partenariat</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($fournisseurs as $fournisseur): ?>
                <tr>
                    <td><?= htmlspecialchars($fournisseur['Supplier_Name']) ?></td>
                    <td><?= htmlspecialchars($fournisseur['Email']) ?></td>
                    <td><?= htmlspecialchars($fournisseur['Phone']) ?></td>
                    <td><span class="badge <?= str_replace(' ', '_', strtolower($fournisseur['statut'])) ?>"><?= htmlspecialchars($fournisseur['statut']) ?></span></td>
                    <td>
                    <a href="voir_produits_fournisseur.php?id=<?= $fournisseur['Supplier_ID'] ?>" class="btn-view">👁️ Voir</a>
                    
                    <?php if ($fournisseur['statut'] === 'refusé'): ?>
                        <a href="supprimer_fournisseur.php?id=<?= $fournisseur['Supplier_ID'] ?>" class="btn-delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce fournisseur ?');">🗑️ Supprimer</a>
                    <?php endif; ?>
                    </td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
