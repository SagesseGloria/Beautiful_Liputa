<?php
session_start();
require_once 'config_admin.php';
require_once 'functions.php';

if (!isset($_SESSION['super_admin_id'])) {
    header("Location: super_admin_login.php");
    exit;
}

// Traitement de la validation ou du refus
if (isset($_GET['action'], $_GET['id']) && in_array($_GET['action'], ['valider', 'refuser'])) {
    $id = intval($_GET['id']);
    $nouveauStatut = $_GET['action'] === 'valider' ? 'actif' : 'refusé';

    $stmt = $pdo->prepare("UPDATE supplier SET statut = ? WHERE Supplier_ID = ?");
    $stmt->execute([$nouveauStatut, $id]);

    // Récupère les infos du fournisseur avant la mise à jour pour les logs
$stmt = $pdo->prepare("SELECT Supplier_Name FROM supplier WHERE Supplier_ID = ?");
$stmt->execute([$id]);
$fournisseur = $stmt->fetch();

if ($fournisseur) {
    $action = ucfirst($_GET['action']) . " le fournisseur : " . $fournisseur['Supplier_Name'];
    log_action($pdo, 'super_admin', $_SESSION['super_admin_id'], $action);
}

    header("Location: valider_fournisseurs.php");
    exit;
}

// Récupération des fournisseurs en attente
$stmt = $pdo->query("SELECT * FROM supplier WHERE statut = 'en attente'");
$fournisseurs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Validation des Fournisseurs</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 30px;
            background-color: #f4f4f4;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: center;
        }
        th {
            background-color: #f0f0f0;
        }
        .btn {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            color: white;
            cursor: pointer;
            text-decoration: none;
        }
        .valider {
            background-color: #28a745;
        }
        .refuser {
            background-color: #dc3545;
        }
        .view {
    background-color: #007bff;
}
    </style>
</head>
<body>
    <h1>Fournisseurs en attente de validation</h1>

    <?php if (count($fournisseurs) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Adresse</th>
                    <th>Pays</th>
                    <th>Ville</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($fournisseurs as $fournisseur): ?>
                    <tr>
                        <td><?= htmlspecialchars($fournisseur['Supplier_Name']) ?></td>
                        <td><?= htmlspecialchars($fournisseur['Email']) ?></td>
                        <td><?= htmlspecialchars($fournisseur['Phone']) ?></td>
                        <td><?= htmlspecialchars($fournisseur['Address']) ?></td>
                        <td><?= htmlspecialchars($fournisseur['Country']) ?></td>
                        <td><?= htmlspecialchars($fournisseur['City']) ?></td>
                        <td>
                            <a class="btn valider" href="?action=valider&id=<?= $fournisseur['Supplier_ID'] ?>">Valider</a> |
                            <a class="btn refuser" href="?action=refuser&id=<?= $fournisseur['Supplier_ID'] ?>">Refuser</a> |
                            <a href="voir_produits_fournisseur.php?id=<?= $fournisseur['Supplier_ID'] ?>" class="btn view">Voir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucun fournisseur en attente.</p>
    <?php endif; ?>
</body>
</html>
