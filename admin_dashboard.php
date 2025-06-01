<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title> Admin dashboard</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: #f2f2f2;
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

    .btn {
      display: inline-block;
      padding: 10px 15px;
      background-color: #28a745;
      color: white;
      text-decoration: none;
      margin-bottom: 20px;
      border-radius: 5px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    table, th, td {
      border: 1px solid #ddd;
    }

    th, td {
      padding: 10px;
      text-align: center;
    }

    th {
      background-color: #f8f8f8;
    }

    td img {
      max-height: 50px;
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
    <h1>Manager - Dashboard</h1>
  <a class="logout" href="logout_admin.php">Déconnexion</a>
</header>

<div class="container">
  <nav>
    <a href="admin_dashboard.php">🏠 Tableau de bord</a>
    <a href="produits.php">📦 Produits</a>
    <a href="commandes.php">🧾 Commandes</a>
    <a href="clients.php">👤 Clients</a>
    <a href="fournisseurs.php">🏭 Fourniseurs</a>
    <a href="livreurs.php">🚚 Service de livraion</a>
  </nav>

  <main>
  <h2>Bienvenue, <?php echo htmlspecialchars($_SESSION['admin_name']); ?> !</h2>
  <p>*Sélectionnez une action dans le menu de gauche pour gérer la plateforme.</p>
  <!--<a href="logout_admin.php">Se déconnecter</a>-->
  </main>
</div>

</body>
</html>

