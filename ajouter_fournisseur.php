<?php
session_start();
require_once 'config_admin.php';
require_once 'functions.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['Supplier_Name'] ?? '';
    $phone = $_POST['Phone'] ?? '';
    $email = $_POST['Email'] ?? '';
    $address = $_POST['Address'] ?? '';
    $country = $_POST['Country'] ?? '';
    $city = $_POST['City'] ?? '';


    if ($name && $phone && $email && $address && $country && $city) {
        $stmt = $pdo->prepare("INSERT INTO supplier (Supplier_Name, Phone, Email, Address, Country, City, statut) VALUES (?, ?, ?, ?, ?, ?, 'en attente')");
        if ($stmt->execute([$name, $phone, $email, $address, $country, $city])) {
            log_action($pdo, 'admin', $_SESSION['admin_id'], "Ajout d’un fournisseur : $name");
            $message = "✅ Fournisseur ajouté avec succès. En attente de validation.";
        } else {
            $message = "❌ Erreur lors de l'ajout du fournisseur.";
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
    <title>Ajouter un fournisseur</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 40px;
            background-color: #f9f9f9;
        }
        form {
            max-width: 400px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        input[type="text"], input[type="email"] {
            width: 80%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            padding: 10px 20px;
            background-color: #003399;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .message {
            margin-bottom: 15px;
            color: green;
        }
        .error {
            margin-bottom: 15px;
            color: red;
        }
    </style>
</head>
<body>

<h1>Manager - Ajouter un fournisseur</h1>

<?php if ($message): ?>
      <p><?= htmlspecialchars($message) ?></p>
  <?php endif; ?>

  <form method="post">
    <label>Nom du fournisseur :<br>
        <input type="text" name="Supplier_Name" required>
    </label><br><br>

    <label>Téléphone :<br>
        <input type="text" name="Phone" required>
    </label><br><br>

    <label>Email :<br>
        <input type="email" name="Email" required>
    </label><br><br>

    <label>Adresse :<br>
    <input type="text" name="Address" required>
    </label><br><br>
    
    <label>Pays :<br>
        <input type="text" name="Country" required>
    </label><br><br>
    
    <label>Ville :<br>
        <input type="text" name="City" required>
    </label><br><br>
    
    <button type="submit">Soumettre à validation</button>
</form>

</body>
</html>
