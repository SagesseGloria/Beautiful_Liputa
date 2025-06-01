<?php
require_once 'config_admin.php';
require_once 'functions.php';
session_start(); // Assure que la session est bien démarrée

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM Product WHERE Product_ID = ?");
    $stmt->execute([$id]);
    $produit = $stmt->fetch();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = $_POST['nom'];
    $categorie = $_POST['categorie'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $stock = $_POST['stock'];
    $materiau = $_POST['material'];
    $taille = $_POST['size'];
    $style = $_POST['style'];

    // Gestion de l'image
    if (!empty($_FILES['image']['name'])) {
        $image = "images/products/" . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $image);
    } else {
        $image = $_POST['ancienne_image'];
    }

    $stmt = $pdo->prepare("UPDATE Product SET Product_Name = ?, Category_ID = ?, Description_product = ?, Price = ?, Stock = ?, material = ?, size = ?, style = ?, Image = ? 
    WHERE Product_ID = ?");
    $stmt->execute([$nom, $categorie, $description, $prix, $stock, $materiau, $taille, $style, $image, $id]);

    // LOG de modification
    if (isset($_SESSION['admin_id'])) {
        $admin_id = $_SESSION['admin_id'];
        $action = "Modification du produit ID $id : $nom";
        log_action($pdo, 'admin', $admin_id, $action);
    }

    header("Location: produits.php");
    exit();
}
?>


<!-- Formulaire HTML -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Modifier le Produit</title>
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
    <h1>Manager - Modifier le produit</h1>
</header>
<div class="container">
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="nom" value="<?= htmlspecialchars($produit['Product_Name']) ?>" required><br>
        <input type="text" name="categorie" value="<?= htmlspecialchars($produit['Category_ID']) ?>" required><br>
        <textarea name="description"><?= htmlspecialchars($produit['Description_product']) ?></textarea><br>
        <input type="number" name="prix" value="<?= $produit['Price'] ?>" required><br>
        <input type="number" name="stock" value="<?= $produit['Stock'] ?>" required><br>
        <input type="text" name="material" value="<?= $produit['material'] ?>" required>
        <input type="text" name="size" value="<?= $produit['size'] ?>" required>
        <input type="text" name="style" value="<?= $produit['style'] ?>" required>
        <input type="file" name="image"><br>
        <input type="hidden" name="ancienne_image" value="<?= $produit['Image'] ?>">
        <button type="submit">Enregistrer</button>
    </form>
</div>
</body>
</html>
