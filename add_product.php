<?php
// Connexion à la base de données
session_start();
require_once 'functions.php';
$host = "localhost";
$dbname = "onlineshopbl_db";
$username = "root";
$password = "LaulauJoy@2003";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_FILES['Image']) && $_FILES['Image']['error'] === 0) {
        $img_name = basename($_FILES['Image']['name']);
        $target_dir = "images/products/";
        $target_path = $target_dir . $img_name;

        // Crée le dossier s'il n'existe pas
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }

        // Déplace l'image dans le dossier
        if (move_uploaded_file($_FILES['Image']['tmp_name'], $target_path)) {
            try {
                // Préparation de la requête SQL
                $stmt = $pdo->prepare("INSERT INTO product 
                    (Product_Name, Category_ID, Description_product, Price, Stock, material, size, style, Image)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

                $stmt->execute([
                    $_POST['Product_Name'],
                    $_POST['Category_ID'],
                    $_POST['Description_product'],
                    $_POST['Price'],
                    $_POST['Stock'],
                    $_POST['material'],
                    $_POST['size'],
                    $_POST['style'],
                    $target_path
                ]);

                $nomProduit = htmlspecialchars($_POST['Product_Name']);
                log_action($pdo, 'admin', $_SESSION['admin_id'], "Ajout du produit : $nomProduit");

                echo "<p style='color:green;'>✅ Produit ajouté avec succès !</p>";
            } catch (PDOException $e) {
                echo "<p style='color:red;'>❌ Erreur lors de l'insertion : " . $e->getMessage() . "</p>";
            }
        } else {
            echo "<p style='color:red;'>❌ Échec du téléchargement de l'image.</p>";
        }
    } else {
        echo "<p style='color:red;'>❌ Veuillez sélectionner une image valide.</p>";
    }
}
?>

<!-- Formulaire HTML -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un produit</title>
    <style>
body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    margin: 0;
    padding: 0;
}
header {
    background-color: #333;
    color: white;
    padding: 1rem;
    text-align: center;
}
.container {
    background-color: white;
    max-width: 800px;
    margin: 2rem auto;
    padding: 2rem;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}
h2 {
    margin-bottom: 1.5rem;
    text-align: center;
}
form input, form textarea, form select {
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
}
button:hover {
    background-color: #555;
}
</style>
</head>
<body>
<header>
        <h2>Manager - Ajouter un produit</h2>
    </header>
    <div class="container">
    <form action="" method="POST" enctype="multipart/form-data">
        <label>Nom du produit:</label><br>
        <input type="text" name="Product_Name" required><br><br>

        <label>ID Catégorie:</label><br>
        <input type="number" name="Category_ID" required><br><br>

        <label>Description:</label><br>
        <textarea name="Description_product" required></textarea><br><br>

        <label>Prix:</label><br>
        <input type="number" step="0.01" name="Price" required><br><br>

        <label>Stock:</label><br>
        <input type="number" name="Stock" required><br><br>

        <label>Matériau :</label><br>
      <select name="material" required>
        <option value="">-- Sélectionnez --</option>
        <option value="wax">Wax</option>
        <option value="bogolan">Bogolan</option>
        <option value="vlisco">Vlisco</option>
        <option value="rafia">Rafia</option>
      </select><br><br>

      <label>Taille :</label><br>
      <select name="size" required>
        <option value="">-- Sélectionnez --</option>
        <option value="S">S</option>
        <option value="M">M</option>
        <option value="L">L</option>
        <option value="XL">XL</option>
        <option value="">Aucune</option>
      </select><br><br>

      <label>Style :</label><br>
      <select name="style" required>
        <option value="">-- Sélectionnez --</option>
        <option value="traditionnel">Traditionnel</option>
        <option value="moderne">Moderne</option>
        <option value="">Aucun</option>
      </select><br><br>

        <label>Image:</label><br>
        <input type="file" name="Image" accept="image/*" required><br><br>

        <button type="submit">Ajouter</button>
    </form>
</div>
</body>
</html>