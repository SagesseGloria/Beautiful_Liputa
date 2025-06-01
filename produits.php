<?php
require_once('config_admin.php'); // Connexion BD
session_start();

// Vérifier que l'admin est connecté
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

// Récupérer les produits
$stmt = $pdo->prepare("SELECT * FROM product");
$stmt->execute();
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Produits - Admin</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: #f2f2f2;
    }

    header {
      background-color: #333;
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
      width: 200px;
      background-color: #444;
      height: 100vh;
      padding: 20px;
      box-sizing: border-box;
    }

    nav a {
      display: block;
      color: white;
      text-decoration: none;
      margin-bottom: 15px;
    }

    nav a:hover {
      text-decoration: underline;
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
  <main>
    <h2>Liste des Produits</h2>

    <a href="add_product.php" class="btn">➕ Ajouter un produit</a>

    <table>
      <thead>
        <tr>
          <th>Image</th>
          <th>Nom</th>
          <th>Catégorie</th>
          <th>Description</th>
          <th>Prix</th>
          <th>Stock</th>
          <th>Materiau</th>
          <th>Taille</th>
          <th>Style</th>
          <!--<th>Actions</th>-->
        </tr>
      </thead>
      <tbody>
        <?php foreach ($produits as $produit): ?>
        <tr>
          <td><img src="../admin/<?= htmlspecialchars($produit['Image']) ?>" alt=""></td>
          <td><?= htmlspecialchars($produit['Product_Name']) ?></td>
          <td><?= htmlspecialchars($produit['Category_ID']) ?></td>
          <td><?= htmlspecialchars($produit['Description_product']) ?></td>
          <td><?= htmlspecialchars($produit['Price']) ?> FCFA</td>
          <td><?= htmlspecialchars($produit['Stock']) ?></td>
          <td><?= htmlspecialchars($produit['material']) ?></td>
          <td><?= htmlspecialchars($produit['size']) ?></td>
          <td><?= htmlspecialchars($produit['style']) ?></td>
          <td>
            <a href="modifier_produit.php?id=<?= $produit['Product_ID'] ?>">✏️</a>
            <a href="supprimer_produit.php?id=<?= $produit['Product_ID'] ?>" onclick="return confirm('Supprimer ce produit ?')">❌</a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </main>
</div>

</body>
</html>