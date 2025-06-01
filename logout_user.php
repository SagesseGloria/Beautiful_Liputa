<?php
session_start();

// Sauvegarder temporairement le panier
$cartBackup = $_SESSION['cart'] ?? [];

// Détruire la session utilisateur uniquement
unset($_SESSION['customer']); // Déconnexion de l'utilisateur

// Restaurer le panier
$_SESSION['cart'] = $cartBackup;

// Rediriger vers l'accueil ou autre
header("Location: Site_BL.php");
exit();
