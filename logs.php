<?php
session_start();
require_once 'config_admin.php';

// Initialisation des filtres
$userType = $_GET['user_type'] ?? '';
$startDate = $_GET['start_date'] ?? '';
$endDate = $_GET['end_date'] ?? '';
$keyword = $_GET['keyword'] ?? '';

$sql = "SELECT * FROM logs WHERE 1=1";
$params = [];

// Filtres dynamiques
if (!empty($userType)) {
    $sql .= " AND user_type = ?";
    $params[] = $userType;
}
if (!empty($startDate) && !empty($endDate)) {
    $sql .= " AND timestamp BETWEEN ? AND ?";
    $params[] = $startDate . " 00:00:00";
    $params[] = $endDate . " 23:59:59";
}
if (!empty($keyword)) {
    $sql .= " AND action LIKE ?";
    $params[] = "%" . $keyword . "%";
}

$sql .= " ORDER BY timestamp DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$logs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Logs / Historique</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; padding: 30px; }
        h2 { color: #333; }
        form, table {
            background: white; padding: 20px; margin-top: 20px;
            border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        input, select {
            padding: 8px; margin-right: 10px; margin-bottom: 10px;
            border: 1px solid #ccc; border-radius: 5px;
        }
        button {
            padding: 8px 15px;
            background: #0066cc;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { padding: 10px; border-bottom: 1px solid #ccc; }
        th { background: #eee; text-align: left; }
    </style>
</head>
<body>

<h2>📜 Logs / Historique des actions</h2>

<form method="get">
    <label>Utilisateur :
        <select name="user_type">
            <option value="">Tous</option>
            <option value="super_admin" <?= $userType === 'super_admin' ? 'selected' : '' ?>>Super Admin</option>
            <option value="admin" <?= $userType === 'admin' ? 'selected' : '' ?>>Manager</option>
        </select>
    </label>

    <label>Du :
        <input type="date" name="start_date" value="<?= htmlspecialchars($startDate) ?>">
    </label>

    <label>Au :
        <input type="date" name="end_date" value="<?= htmlspecialchars($endDate) ?>">
    </label>

    <label>Mot-clé :
        <input type="text" name="keyword" value="<?= htmlspecialchars($keyword) ?>">
    </label>

    <button type="submit">🔍 Filtrer</button>
</form>

<?php if ($logs): ?>
    <table>
        <tr>
            <th>Type</th>
            <th>Utilisateur ID</th>
            <th>Action</th>
            <th>Date</th>
        </tr>
        <?php foreach ($logs as $log): ?>
            <tr>
                <td><?= htmlspecialchars($log['user_type']) ?></td>
                <td><?= htmlspecialchars($log['user_id']) ?></td>
                <td><?= htmlspecialchars($log['action']) ?></td>
                <td><?= htmlspecialchars($log['timestamp']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>Aucun log trouvé pour les critères sélectionnés.</p>
<?php endif; ?>

</body>
</html>
