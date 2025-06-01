<?php
session_start();

if (!isset($_SESSION['customer'])) {
    // Utilisateur non connecté : on redirige vers site_BL.php avec un paramètre pour savoir quoi faire ensuite
    header("Location: Site_BL.php?redirect=page_paiement.php");
    exit;
}

// Utilisateur connecté : on va directement au paiement
header("Location: page_paiement.php");
exit;
?>
