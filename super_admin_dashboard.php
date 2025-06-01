<?php
session_start();

if (!isset($_SESSION['super_admin_id'])) {
    header("Location: super_admin_login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Super Admin - Tableau de bord</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        header {
            background-color: #222;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            margin: 0;
            font-size: 22px;
        }

        .logout {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        .container {
            display: flex;
        }

        nav {
            width: 220px;
            background-color: #333;
            height: 100vh;
            padding: 20px;
            box-sizing: border-box;
        }

        nav a {
            display: block;
            color: white;
            text-decoration: none;
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 5px;
        }

        nav a:hover {
            background-color: #444;
        }

        main {
            flex: 1;
            padding: 30px;
            background-color: #fff;
            min-height: 100vh;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo img {
            width: 150px;
        }
    </style>
</head>
<body>

<header>
    <div class="logo">
        <img src="/Beautiful Liputa/Images/Remove_LogoBL.png" alt="Beautiful Liputa Logo">
    </div>
    <h1>Super Admin - Dashboard</h1>
    <a class="logout" href="super_admin_logout.php">Déconnexion</a>
</header>

<div class="container">
    <nav>
        <a href="super_admin_dashboard.php">🏠 Tableau de bord</a>
        <a href="valider_fournisseurs.php">✅ Valider Fournisseurs</a>
        <a href="valider_livreurs.php">✅ Valider Service de Livraison</a>
        <a href="insert_admin.php">👥 Gestion des comptes</a>
        <a href="logs.php">🧾 Logs / Historique</a>
        <a href="sauvegarde.php">💾 Sauvegarde</a>
    </nav>

    <main>
        <h2>Bienvenue, <?= htmlspecialchars($_SESSION['super_admin_name']) ?> !</h2>
        
        <p>*Sélectionnez une action dans le menu de gauche pour gérer la plateforme.</p>
    </main>
</div>

</body>
</html>
