<?php
require_once 'config_admin.php';
require_once 'functions.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Optionnel : Supprimer l’image du serveur si tu veux
    // $stmt = $pdo->prepare("SELECT Изображение FROM Product WHERE Product_ID = ?");
    // $stmt->execute([$id]);
    // $produit = $stmt->fetch();
    // unlink("uploads/" . $produit['Изображение']);

    $stmt = $pdo->prepare("DELETE FROM Product WHERE Product_ID = ?");
    $stmt->execute([$id]);

    log_action($pdo, 'admin', $_SESSION['admin_id'], "Suppression du produit : " . $produit['Product_Name']);


    header("Location: produits.php");
    exit();
} else {
    echo "ID de produit manquant.";
}
