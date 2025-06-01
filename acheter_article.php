<?php
/*session_start();

if (!isset($_SESSION['customer'])) {
    header("Location: Site_BL.php");
    exit();
}

// Stocke l'article à acheter seul dans la session
$_SESSION['achat_unique'] = [
    'Product_ID' => $_POST['product_id'],
    'nom' => $_POST['product_name'],
    'quantite' => $_POST['quantite'],
    'taille' => $_POST['taille'],
    'prix' => $_POST['prix']
];

header("Location: page_paiement.php?mode=unique");
exit();*/

/*session_start();
require_once '../admin/config_admin.php';

if (!isset($_SESSION['customer'])) {
    header("Location: Site_BL.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $quantite = $_POST['quantite'];
    $taille = $_POST['taille'];
    $prix = $_POST['prix'];

    // Ici tu peux passer à la page de paiement avec ces données (session ou formulaire)
    $_SESSION['achat_unique'] = [
        'product_id' => $product_id,
        'product_name' => $product_name,
        'quantite' => $quantite,
        'taille' => $taille,
        'prix' => $prix
    ];

    header("Location: page_paiement_unique.php");
    exit;
}*/


session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['achat_unique'] = [
        'product_id' => $_POST['product_id'],
        'nom'        => $_POST['product_name'],
        'quantite'   => $_POST['quantite'],
        'taille'     => $_POST['taille'],
        'prix'       => $_POST['prix']
    ];

    header('Location: page_paiement_unique.php');
    exit();
} else {
    echo "Accès interdit.";
    exit();
}


