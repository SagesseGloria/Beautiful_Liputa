<?php
session_start();
require_once '../admin/config_admin.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Vérifie que le fournisseur existe et est refusé
    $stmt = $pdo->prepare("SELECT * FROM supplier WHERE Supplier_ID = ? AND statut = 'refusé'");
    $stmt->execute([$id]);
    $fournisseur = $stmt->fetch();

    if ($fournisseur) {
        // Optionnel : Vérifie qu’il n’est pas lié à des produits
        $checkProducts = $pdo->prepare("SELECT COUNT(*) FROM Product WHERE Supplier_ID = ?");
        $checkProducts->execute([$id]);
        $nbProduits = $checkProducts->fetchColumn();

        if ($nbProduits > 0) {
            echo "❌ Ce fournisseur est encore lié à des produits.";
        } else {
            // Suppression du fournisseur
            $delete = $pdo->prepare("DELETE FROM supplier WHERE Supplier_ID = ?");
            $delete->execute([$id]);
            header("Location: fournisseurs.php?msg=supprimé");
            exit;
        }
    } else {
        echo "❌ Fournisseur introuvable ou non refusé.";
    }
} else {
    echo "❌ ID manquant.";
}
?>
