<?php
session_start();
require_once 'config_admin.php';
require_once 'functions.php';

if (isset($_GET['action'], $_GET['id']) && in_array($_GET['action'], ['valider', 'refuser'])) {
    $id = intval($_GET['id']);
    $nouveauStatut = $_GET['action'] === 'valider' ? 'actif' : 'refusé';

    // Récupérer les infos du livreur avant de modifier
    $stmt = $pdo->prepare("SELECT Delivery_Name FROM delivery WHERE Delivery_ID = ?");
    $stmt->execute([$id]);
    $livreur = $stmt->fetch();

    if ($livreur) {
        // Mise à jour du statut
        $stmt = $pdo->prepare("UPDATE delivery SET Status = ? WHERE Delivery_ID = ?");
        $stmt->execute([$nouveauStatut, $id]);

        // Journalisation
        log_action($pdo, 'super_admin', $_SESSION['super_admin_id'], ucfirst($nouveauStatut) . " du livreur : " . $livreur['Delivery_Name']);
    }

    header("Location: valider_livreurs.php");
    exit;
}


$stmt = $pdo->query("SELECT * FROM delivery WHERE Status = 'en attente'");
$livreurs = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Validation des livreurs</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f5f5f5; padding: 30px; }
        table { width: 100%; border-collapse: collapse; background: white; box-shadow: 0 0 5px #ccc; }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: center; }
        th { background: #f0f0f0; }
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
    </style>
</head>
<body>

<h1>Validation des services de livraison</h1>

<?php if (empty($livreurs)): ?>
    <p>Aucun service de livraison en attente.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Téléphone</th>
                <th>Email</th>
                <th>Adresse</th>
                <th>Pays</th>
                <th>Ville</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($livreurs as $livreur): ?>
                <tr>
                    <td><?= htmlspecialchars($livreur['Delivery_Name']) ?></td>
                    <td><?= htmlspecialchars($livreur['Phone']) ?></td>
                    <td><?= htmlspecialchars($livreur['Email']) ?></td>
                    <td><?= htmlspecialchars($livreur['Address']) ?></td>
                    <td><?= htmlspecialchars($livreur['Country']) ?></td>
                    <td><?= htmlspecialchars($livreur['City']) ?></td>
                    <td>
                    <a class="btn valider" href="?action=valider&id=<?= $livreur['Delivery_ID'] ?>">Valider</a> |
                    <a class="btn refuser" href="?action=refuser&id=<?= $livreur['Delivery_ID'] ?>">Refuser</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

</body>
</html>
