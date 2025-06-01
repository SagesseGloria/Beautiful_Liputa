<?php
session_start();
require_once '../admin/config_admin.php';

if (!isset($_SESSION['customer'])) {
    header("Location: connexion.php");
    exit;
}

$customer_id = $_SESSION['customer']['id'];

// Récupère les commandes du client
$stmt = $pdo->prepare("SELECT * FROM orders WHERE customer_ID = ? ORDER BY Order_Date DESC");
$stmt->execute([$customer_id]);
$commandes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Historique des commandes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 40px;
            background-color: #f5f5f5;
        }

        h1 {
            color: #003399;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 14px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #003399;
            color: white;
        }

        tr:hover {
            background-color: #f0f8ff;
        }

        .details-btn {
            padding: 6px 12px;
            background-color: #003399;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
        }

        .details-btn:hover {
            background-color: #002277;
        }
    </style>
</head>
<body>

    <h1>🕒 Historique des commandes</h1>

    <?php if (empty($commandes)): ?>
        <p>Vous n'avez passé aucune commande pour le moment.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Numéro de Commande</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th>Statut</th>
                    <th></th> <!-- Colonne pour le bouton -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($commandes as $commande): ?>
                    <tr>
                        <td><?= htmlspecialchars($commande['Order_Number']) ?></td>
                        <td><?= date('d/m/Y', strtotime($commande['Order_Date'])) ?></td>
                        <td><?= number_format($commande['Total_Amount'], 2, ',', ' ') ?> FCFA</td>
                        <td><?= htmlspecialchars($commande['Order_Status']) ?></td>
                        <td>
                            <a class="details-btn" href="details_commande.php?Order_ID=<?= $commande['Order_ID'] ?>">Détails</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

</body>
</html>
