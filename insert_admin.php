<?php
/*$host = 'localhost';
$dbname = 'onlineshopbl_db';
$user = 'root';
$pass = 'LaulauJoy@2003'; // ou ton mot de passe MySQL

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $password = 'admin123';
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO Admin (Full_Name, Email, Admin_Password) VALUES (?, ?, ?)");
    $stmt->execute(['Admin Test', 'admin@example.com', $hash]);

    echo "Admin ajouté avec succès.";
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>*/

session_start();

// Connexion à la base de données
$host = 'localhost';
$dbname = 'onlineshopbl_db';
$user = 'root';
$pass = 'LaulauJoy@2003';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Traitement du formulaire
$success = false;
$error = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = trim($_POST['Full_Name']);
    $email = trim($_POST['Email']);
    $motdepasse = $_POST['Admin_Password'];

    if ($nom && $email && $motdepasse) {
        $hash = password_hash($motdepasse, PASSWORD_DEFAULT);

        try {
            $stmt = $pdo->prepare("INSERT INTO Admin (Full_Name, Email, Admin_Password) VALUES (?, ?, ?)");
            $stmt->execute([$nom, $email, $hash]);
            $success = true;
        } catch (PDOException $e) {
            $error = "Erreur : " . $e->getMessage();
        }
    } else {
        $error = "Veuillez remplir tous les champs.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un administrateur</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 30px;
        }
        .container {
            background: white;
            padding: 2rem;
            max-width: 500px;
            margin: auto;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        .message {
            text-align: center;
            margin-bottom: 1rem;
        }
        .success { color: green; }
        .error { color: red; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Ajouter un administrateur</h2>

        <?php if ($success): ?>
            <div class="message success">✅ Administrateur ajouté avec succès.</div>
        <?php elseif (!empty($error)): ?>
            <div class="message error">❌ <?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST">
            <label>Nom complet :</label>
            <input type="text" name="Full_Name" required>

            <label>Email :</label>
            <input type="email" name="Email" required>

            <label>Mot de passe :</label>
            <input type="password" name="Admin_Password" required>

            <button type="submit">Ajouter</button>
        </form>
    </div>
</body>
</html>

