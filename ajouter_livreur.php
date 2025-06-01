<?php
session_start();
require_once 'config_admin.php';
require_once 'functions.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['Delivery_Name'] ?? '';
    $telephone = $_POST['Phone'] ?? '';
    $email = $_POST['Email'] ?? '';
    $adresse = $_POST['Address'] ?? '';
    $pays = $_POST['Country'] ?? '';
    $ville = $_POST['City'] ?? '';

    if ($nom && $telephone && $email && $adresse && $pays && $ville) {
        $stmt = $pdo->prepare("INSERT INTO delivery (Delivery_Name, Phone, Email, Address, Country, City, Status) VALUES (?, ?, ?, ?, ?, ?, 'en attente')");
        if ($stmt->execute([$nom, $telephone, $email, $adresse, $pays, $ville])) {
            log_action($pdo, 'admin', $_SESSION['admin_id'], "Ajout d’un service de livraison : $nom");
            $message = "✅ Service de livraison ajouté. En attente de validation.";
        } else {
            $message = "Erreur lors de l'ajout.";
        }
    } else {
        $message = "Tous les champs sont requis.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un livreur</title>
    <style>
        body { font-family: Arial; background-color: #f4f4f4; padding: 40px; }
        form {
            max-width: 500px;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            padding: 10px 20px;
            background-color: #0066cc;
            color: white;
            border: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .message { color: green; margin-bottom: 15px; }
    </style>
</head>
<body>

<h2>Manager - Ajouter un service de livraison</h2>

<?php if ($message): ?>
    <p class="message"><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<form method="post">
    <label>Nom du service :</label>
    <input type="text" name="Delivery_Name" required>

    <label>Téléphone :</label>
    <input type="text" name="Phone" required>

    <label>Email :</label>
    <input type="email" name="Email" required>

    <label>Adresse :</label>
    <input type="text" name="Address" required>

    <label>Pays :</label>
    <input type="text" name="Country" required>

    <label>Ville :</label>
    <input type="text" name="City" required>

    <button type="submit">Soumettre à validation</button>
</form>

</body>
</html>
