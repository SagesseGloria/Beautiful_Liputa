<?php
session_start();
require_once 'config_admin.php';

// Vérifie que l'utilisateur est un manager connecté
/*if (!isset($_SESSION['manager'])) {
    header('Location: admin_login.php');
    exit;
}*/

// Récupération des clients
$stmt = $pdo->query("SELECT * FROM customer ORDER BY Full_Name DESC");
$clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des clients</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 30px;
            background-color: #f9f9f9;
        }

        h1 {
            color: #003399;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #003399;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .actions a {
            margin-right: 10px;
            text-decoration: none;
            color: #003399;
        }

        .actions a.delete {
            color: red;
        }
    </style>
</head>
<body>

    <h1>Liste des clients</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <!--<th>Date d'inscription</th>-->
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($clients) === 0): ?>
                <tr><td colspan="6">Aucun client trouvé.</td></tr>
            <?php else: ?>
                <?php foreach ($clients as $client): ?>
                    <tr>
                        <td><?= htmlspecialchars($client['Customer_ID']) ?></td>
                        <td><?= htmlspecialchars($client['Full_Name']) ?></td>
                        <td><?= htmlspecialchars($client['Email']) ?></td>
                        <td><?= htmlspecialchars($client['Phone']) ?></td>
                        <!--<td><?= date('d/m/Y', strtotime($client['created_at'])) ?></td>-->
                        <td class="actions">
                            <a href="client_commandes.php?id=<?= $client['Customer_ID'] ?>">Voir commandes</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>
