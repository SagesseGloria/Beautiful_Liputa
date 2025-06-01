<?php
session_start();

if (!isset($_SESSION['customer']) || !isset($_SESSION['mode_paiement'])) {
    header("Location: choisir_paiement.php");
    exit();
}

$mode = ucfirst($_SESSION['mode_paiement']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Paiement par carte - <?= htmlspecialchars($mode) ?></title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f4f4f4;
            padding: 0;
            margin: 0;
        }

        .container {
            max-width: 500px;
            margin: 60px auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #444;
            font-weight: 600;
        }

        input[type="text"], input[type="number"], input[type="submit"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            cursor: pointer;
            border: none;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .card-icons {
            text-align: center;
            margin-bottom: 20px;
        }

        .card-icons img {
            height: 28px;
            margin: 0 8px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>💳 Paiement par <?= htmlspecialchars($mode) ?></h2>

    <div class="card-icons">
        <?php if ($mode === "Visa"): ?>
            <img src="/Beautiful Liputa/Images/Visa.png" alt="Visa">
        <?php elseif ($mode === "Mastercard"): ?>
            <img src="/Beautiful Liputa/Images/MasterCard.png" alt="MasterCard">
        <?php elseif ($mode === "Mir"): ?>
            <img src="/Beautiful Liputa/Images/MIR.png" alt="MIR">
        <?php elseif ($mode === "Union pay"): ?>
            <img src="/Beautiful Liputa/Images/UnionPay.png" alt="UnionPay">
        <?php endif; ?>
    </div>

    <form action="valider_commande_unique.php" method="post">
        <label>Numéro de carte</label>
        <input type="text" name="numero_carte" required placeholder="1234 5678 9012 3456">

        <label>Date d'expiration (MM/AA)</label>
        <input type="text" name="expiration" required placeholder="12/25">

        <label>Code de sécurité (CVV)</label>
        <input type="number" name="cvv" required placeholder="123">

        <input type="submit" value="Valider le paiement">
    </form>
</div>

</body>
</html>
