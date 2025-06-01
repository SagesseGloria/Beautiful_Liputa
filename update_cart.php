<?php
/*session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['quantite'])) {
    foreach ($_POST['quantite'] as $index => $qty) {
        $qty = intval($qty);
        if ($qty <= 0) {
            unset($_SESSION['cart'][$index]);
        } else {
            $_SESSION['cart'][$index]['quantite'] = $qty;
        }
    }
}

header("Location: afficher_panier.php");
exit;*/

/*session_start();
require_once '../admin/config_admin.php'; // connexion à $pdo

if (!isset($_SESSION['customer'])) {
    header("Location: Site_BL.php");
    exit;
}

$user_id = $_SESSION['customer']['id'];

// Vérification des données POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['quantite']) && is_array($_POST['quantite'])) {
    foreach ($_POST['quantite'] as $cart_ID => $quantite) {
        $quantite = intval($quantite);

        if ($quantite < 1) {
            // Supprimer l'article si quantité = 0
            $delete = $pdo->prepare("DELETE FROM cart WHERE Customer_ID = ? AND cart_ID = ?");
            $delete->execute([$user_id, $cart_ID]);
        } else {
            // Mettre à jour la quantité
            $update = $pdo->prepare("UPDATE cart SET Quantity = ? WHERE Customer_ID = ? AND cart_ID = ?");
            $update->execute([$quantite, $user_id, $cart_ID]);
        }
    }
}

header("Location: afficher_panier.php");
exit;
?>*/

// update_cart.php
session_start();
require_once '../admin/config_admin.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cart_id'], $_POST['quantite'])) {
    $cart_id = $_POST['cart_id'];
    $quantite = (int) $_POST['quantite'];

    if ($quantite <= 0) {
        // Supprimer si quantité invalide
        $stmt = $pdo->prepare("DELETE FROM cart WHERE cart_ID = ?");
        $stmt->execute([$cart_id]);
    } else {
        $stmt = $pdo->prepare("UPDATE cart SET Quantity = ? WHERE cart_ID = ?");
        $stmt->execute([$quantite, $cart_id]);
    }
}

header("Location: afficher_panier.php");
exit;


