<?php
require_once 'config_admin.php'; // ou le bon chemin vers ton fichier PDO

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['Full_Name'] ?? '';
    $email = $_POST['Email'] ?? '';
    $motdepasse = $_POST['SuperAdmin_Password'] ?? '';

    if ($nom && $email && $motdepasse) {
        $hashedPassword = password_hash($motdepasse, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO super_admin (Full_Name, Email, SuperAdmin_Password) VALUES (?, ?, ?)");
        if ($stmt->execute([$nom, $email, $hashedPassword])) {
            $message = "✅ Super administrateur ajouté avec succès.";
        } else {
            $message = "Erreur lors de l'ajout.";
        }
    } else {
        $message = "Tous les champs sont obligatoires.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter Super Admin</title>
</head>
<body>
    <h2>Ajouter un super administrateur</h2>

    <?php if ($message): ?>
        <p><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <form method="post">
        <label>Nom complet :<br>
            <input type="text" name="Full_Name" required>
        </label><br><br>

        <label>Email :<br>
            <input type="email" name="Email" required>
        </label><br><br>

        <label>Mot de passe :<br>
            <input type="password" name="SuperAdmin_Password" required>
        </label><br><br>

        <button type="submit">Créer le super admin</button>
    </form>
</body>
</html>
