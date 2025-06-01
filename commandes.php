<?php
require_once '../admin/config_admin.php';

$confirmation = '';

// Traitement si un statut est mis à jour
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'], $_POST['new_status'])) {
    $stmt = $pdo->prepare("UPDATE orders SET Order_Status = ? WHERE Order_ID = ?");
    if ($stmt->execute([$_POST['new_status'], $_POST['order_id']])) {
        $confirmation = "✅ Statut de la commande #" . $_POST['order_id'] . " mis à jour.";
    }
}

// Récupération des commandes
$stmt = $pdo->query("
    SELECT orders.Order_ID, customer.full_name, customer.address, orders.Order_Number, 
           orders.Total_Amount, orders.Order_Date, orders.Order_Status
    FROM orders
    JOIN customer ON orders.Customer_ID = customer.Customer_ID
    ORDER BY orders.Order_Date DESC
");

$commandes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des commandes</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        h2 { margin-bottom: 20px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; }
        .success { background-color: #d4edda; color: #155724; padding: 10px; border: 1px solid #c3e6cb; border-radius: 5px; margin-bottom: 20px; }
        select, button { padding: 6px; font-size: 14px; }
        form { display: flex; gap: 6px; align-items: center; }
        .update_btn{ background-color:rgb(94, 67, 229); border-radius: 5px; color: white; border: none;}
    </style>
</head>
<body>

<h2>📋 Liste des commandes</h2>

<?php if ($confirmation): ?>
    <div class="success"><?= $confirmation ?></div>
<?php endif; ?>

<table>
    <tr>
        <th>ID</th>
        <th>Client</th>
        <th>Adresse</th>
        <th>Numéro de commande</th>
        <th>Total</th>
        <th>Date</th>
        <th>Statut</th>
        <th>Action</th>
    </tr>

    <?php foreach ($commandes as $commande): ?>
        <tr>
            <td><?= $commande['Order_ID'] ?></td>
            <td><?= htmlspecialchars($commande['full_name']) ?></td>
            <td><?= htmlspecialchars($commande['address']) ?></td>
            <td><?= htmlspecialchars($commande['Order_Number']) ?></td>
            <td><?= number_format($commande['Total_Amount'], 0, ',', ' ') ?> FCFA</td>
            <td><?= $commande['Order_Date'] ?></td>
            <td><?= $commande['Order_Status'] ?></td>
            <td>
                <form method="post">
                    <input type="hidden" name="order_id" value="<?= $commande['Order_ID'] ?>">
                    <select name="new_status">
                        <option value="En attente" <?= $commande['Order_Status'] === 'En attente' ? 'selected' : '' ?>>En attente</option>
                        <option value="Validée" <?= $commande['Order_Status'] === 'Validée' ? 'selected' : '' ?>>Validée</option>
                        <option value="Livrée" <?= $commande['Order_Status'] === 'Livrée' ? 'selected' : '' ?>>Livrée</option>
                        <option value="Annulée" <?= $commande['Order_Status'] === 'Annulée' ? 'selected' : '' ?>>Annulée</option>
                    </select>
                    <button type="submit" class="update_btn">Mettre à jour</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
