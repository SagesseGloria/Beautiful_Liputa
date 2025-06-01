<?php
session_start();
require_once '../admin/config_admin.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Vérifier que le livreur existe et a le statut refusé
    $stmt = $pdo->prepare("SELECT * FROM delivery WHERE Delivery_ID = ? AND Status = 'refusé'");
    $stmt->execute([$id]);
    $livreur = $stmt->fetch();

    if ($livreur) {
        // Suppression du livreur
        $delete = $pdo->prepare("DELETE FROM delivery WHERE Delivery_ID = ?");
        $delete->execute([$id]);

        header("Location: livreurs.php?msg=supprimé");
        exit;
    } else {
        echo "❌ Livreur introuvable ou non refusé.";
    }
} else {
    echo "❌ ID du livreur manquant.";
}
?>
