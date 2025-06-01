<?php
session_start();

if (!isset($_SESSION['customer'])) {
    header("Location: Site_BL.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mode_paiement'])) {
    $mode = $_POST['mode_paiement'];
    $_SESSION['mode_paiement'] = $mode;

    // Modes qui passent par la page de carte bancaire simulée
    $carte_bancaire_modes = ['visa', 'mastercard', 'mir', 'union pay'];

    if (in_array($mode, $carte_bancaire_modes)) {
        header('Location: paiement_carte_unique.php');
    } elseif ($mode === 'paypal') {
        // Simulation PayPal (redirige vers confirmation directe)
        header('Location: valider_commande_unique.php?via=paypal');
    } else {
        // Sécurité : si mode inconnu ou vide
        header('Location: choisir_paiement_unique.php');
    }
    exit();
} else {
    header('Location: choisir_paiement_unique.php');
    exit();
}

