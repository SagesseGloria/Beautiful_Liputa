<?php
session_start();
require_once '../admin/config_admin.php';

if (!isset($_SESSION['customer'])) {
    header("Location: Site_BL.php");
    exit();
}

$customer_id = $_SESSION['customer']['id'];

if (isset($_GET['id'])) {
    $cart_id = $_GET['id'];

    $stmt = $pdo->prepare("DELETE FROM cart WHERE Cart_ID = ? AND Customer_ID = ?");
    $stmt->execute([$cart_id, $customer_id]);
}

header("Location: afficher_panier.php");
exit();
