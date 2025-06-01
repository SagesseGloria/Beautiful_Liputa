<?php
session_start();
require_once 'config_admin.php';

// Vérifie que le manager est connecté
/*if (!isset($_SESSION['manager'])) {
    header("Location: login.php");
    exit;
}*/

// Récupération de l'ID client depuis l'URL
$client_id = $_GET['id'] ?? null;
if (!$client_id) {
    die("Aucun client sélectionné.");
}

// Récupération des infos client
$stmt = $pdo->prepare("SELECT * FROM customer WHERE customer_ID = ?");
$stmt->execute([$client_id]);
$client = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$client) {
    die("Client introuvable.");
}

// Récupération des commandes du client
$stmt = $pdo->prepare("SELECT * FROM orders WHERE customer_ID = ? ORDER BY Order_Date DESC");
$stmt->execute([$client_id]);
$commandes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Commandes de <?= htmlspecialchars($client['name']) ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 30px;
            background-color: #f9f9f9;
        }

        h1 {
            color: #003399;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #003399;
            color: white;
        }

        a {
            color: #003399;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .back-link {
            margin-top: 20px;
            display: inline-block;
        }
    </style>
</head>
<body>

    <h1>Commandes de <?= htmlspecialchars($client['Full_Name']) ?></h1>

    <?php if (count($commandes) === 0): ?>
        <p>Aucune commande trouvée pour ce client.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Numéro</th>
                    <th>Date</th>
                    <th>Montant</th>
                    <th>Statut</th>
                    <th>Détails</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($commandes as $commande): ?>
                    <tr>
                        <td>#<?= htmlspecialchars($commande['Order_ID']) ?></td>
                        <td><?= date('d/m/Y', strtotime($commande['Order_Date'])) ?></td>
                        <td><?= number_format($commande['Total_Amount'], 2, ',', ' ') ?> FCFA</td>
                        <td><?= htmlspecialchars($commande['Order_Status']) ?></td>
                        <td>
                            <a href="../public/details_commande.php?Order_ID=<?= $commande['Order_ID'] ?>">Voir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <a href="clients.php" class="back-link">← Retour à la liste des clients</a>

</body>
</html>
