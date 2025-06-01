<?php

session_start();
require_once '../admin/config_admin.php'; // fichier contenant ta connexion PDO

// Vérifie que l'utilisateur est connecté
if (!isset($_SESSION['customer'])) {
    // Rediriger vers login ou afficher un message
    header("Location: Site_BL.php"); // ou affichage d'un message
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['customer']['id'];
    $id = $_POST['product_id'];
    $nom = $_POST['product_name'];
    $prix = $_POST['product_price'];
    $taille = $_POST['product_size'];
    $image = $_POST['product_image'];

    // Connexion à la base de données (si config.php ne le fait pas)
    // $pdo = new PDO(...);

    // Vérifie si ce produit (avec taille) est déjà dans le panier de cet utilisateur
    $stmt = $pdo->prepare("SELECT * FROM cart WHERE customer_ID = ? AND Product_ID = ? AND Size = ?");
    $stmt->execute([$user_id, $id, $taille]);
    $item = $stmt->fetch();

    if ($item) {
        // Mettre à jour la quantité
        $stmt = $pdo->prepare("UPDATE cart SET Quantity = Quantity + 1 WHERE cart_ID = ?");
        $stmt->execute([$item['id']]);
    } else {
        // Ajouter l'article au panier
        $stmt = $pdo->prepare("INSERT INTO cart (Customer_ID, Product_ID, Quantity, Size, Date_add) VALUES (?, ?, 1, ?, ?)");
        $stmt->execute([$user_id, $id, $taille, date('Y-m-d H:i:s')]);

    }

    // Rediriger vers le panier
    header("Location: afficher_panier.php"); // ou afficher_panier.php
    exit;
}
?>

