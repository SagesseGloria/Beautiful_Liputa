<?php
session_start();

if (!isset($_SESSION['customer'])) {
    header("Location: Site_BL.php");
    exit();
}

/*$total = $_POST['total'] ?? 0;
$mode = $_POST['mode'] ?? 'panier'; // par défaut c’est un achat panier*/
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Choix du mode de paiement</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            background: white;
            margin: 60px auto;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        .options-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .payment-option {
            display: flex;
            align-items: center;
            padding: 15px;
            border: 2px solid #ddd;
            border-radius: 10px;
            background-color: #fafafa;
            transition: 0.3s;
            cursor: pointer;
        }

        .payment-option:hover {
            border-color: #007bff;
            background-color: #eef7ff;
        }

        .payment-option input {
            margin-right: 12px;
        }

        .payment-option img {
            height: 24px;
            margin-right: 10px;
        }

        .btn {
            display: block;
            width: 100%;
            background: #28a745;
            color: white;
            padding: 12px;
            margin-top: 30px;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        .btn:hover {
            background: #218838;
        }

        label {
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>💳 Choisissez votre mode de paiement</h2>

    <form action="traiter_paiement.php" method="post">
        <div class="options-grid">
        <label class="payment-option">
                <input type="radio" name="mode_paiement" value="visa" required>
                <img src="/Beautiful Liputa/Images/Visa.png" alt="Visa">
                Carte Bancaire (Visa)
            </label>

            <label class="payment-option">
                <input type="radio" name="mode_paiement" value="mastercard" required>
                <img src="/Beautiful Liputa/Images/MasterCard.png" alt="MasterCard">
                Carte Bancaire (MasterCard)
            </label>

            <label class="payment-option">
                <input type="radio" name="mode_paiement" value="paypal">
                <img src="/Beautiful Liputa/Images/Paypal.png" alt="PayPal">
                PayPal
            </label>

            <label class="payment-option">
                <input type="radio" name="mode_paiement" value="mir">
                <img src="/Beautiful Liputa/Images/MIR.png" alt="MIR">
                Carte Bancaire (MIR)
            </label>

            <label class="payment-option">
                <input type="radio" name="mode_paiement" value="union pay">
                <img src="/Beautiful Liputa/Images/UnionPay.png" alt="UnionPay">
                Carte Bancaire (Union Pay)
            </label>
        </div>

        <button type="submit" class="btn">Continuer</button>
    </form>
</div>

</body>
</html>
