<?php
session_start();
require_once 'config_admin.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

// Récupération des livreurs
$stmt = $pdo->query("SELECT * FROM delivery ORDER BY Status DESC");
$livreurs = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Services de livraison</title>
  <style>
     body { font-family: Arial, sans-serif; background: #f9f9f9; padding: 30px; }
        h2 { color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: center; }
        th {background-color: #f2f2f2; }
        .btn-disabled { background-color: #aaa; color: #fff; padding: 8px 12px; border: none; border-radius: 4px; cursor: not-allowed; }
        .badge { padding: 4px 10px; border-radius: 4px; font-size: 13px; }
        .badge.en_attente { background-color: orange; color: white; }
        .badge.en_test { background-color: #17a2b8; color: white; }
        .badge.actif { background-color: #28a745; color: white; }
        .badge.refusé { background-color: #dc3545; color: white; }
    .add_delivery {
      display: inline-block;
      padding: 10px 15px;
      background-color: #003399;
      color: white;
      text-decoration: none;
      border-radius: 5px;
    font-weight: bold;
    }
    .btn-delete {
    background-color: #dc3545;
    padding: 6px 10px;
    border: none;
    border-radius: 4px;
    color: white;
    text-decoration: none;
    margin: 2px;
}
  </style>
</head>
<body>

  <main>
    <h2>Liste des services de livraison</h2>
    <a href="ajouter_livreur.php" class="add_delivery">➕ Ajouter un service de livraison</a>
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
        <?php foreach ($livreurs as $livreur): ?>
          <tr>
            <td><?= htmlspecialchars($livreur['Delivery_Name']) ?></td>
            <td><?= htmlspecialchars($livreur['Email']) ?></td>
            <td><?= htmlspecialchars($livreur['Phone']) ?></td>
            <td><span class="badge <?= str_replace(' ', '_', strtolower($livreur['Status'])) ?>"><?= htmlspecialchars($livreur['Status']) ?></span></td>
            <td>
            <?php if ($livreur['Status'] === 'refusé'): ?>
                        <a href="supprimer_livreur.php?id=<?= $livreur['Delivery_ID'] ?>" class="btn-delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce fournisseur ?');">🗑️ Supprimer</a>
                    <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </main>
</div>

</body>
</html>
